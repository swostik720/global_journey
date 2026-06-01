<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DocumentChecklist;
use App\Models\Country;
use RuntimeException;

class DocumentChecklistTableSeeder extends Seeder
{
    public function run(): void
    {
        $datasetPath = database_path('seeders/data/document_checklists.json');

        if (!file_exists($datasetPath)) {
            throw new RuntimeException("Checklist dataset not found at {$datasetPath}");
        }

        $raw = file_get_contents($datasetPath);
        $dataset = json_decode((string) $raw, true);

        if (!is_array($dataset) || !isset($dataset['countries']) || !is_array($dataset['countries'])) {
            throw new RuntimeException('Invalid checklist dataset format. Expected countries array.');
        }

        $lookup = [];
        foreach ($dataset['countries'] as $countryConfig) {
            if (!is_array($countryConfig) || empty($countryConfig['name'])) {
                continue;
            }

            $normalizedPayload = [
                'documents' => $this->normalizeDocuments($countryConfig['documents'] ?? []),
                'pdf_path' => trim((string) ($countryConfig['pdf_path'] ?? '')),
            ];

            $aliases = $countryConfig['aliases'] ?? [];
            if (!is_array($aliases)) {
                $aliases = [];
            }

            $allNames = array_merge([$countryConfig['name']], $aliases);
            foreach ($allNames as $name) {
                $lookup[$this->normalizeName((string) $name)] = $normalizedPayload;
            }
        }

        $countries = Country::select(['id', 'name'])->get();
        $syncedCountryIds = [];

        foreach ($countries as $country) {
            $key = $this->normalizeName((string) $country->name);
            $payload = $lookup[$key] ?? null;

            if (!is_array($payload)) {
                continue;
            }

            $syncedCountryIds[] = $country->id;

            $primary = DocumentChecklist::where('country_id', $country->id)
                ->orderBy('id')
                ->first();

            if ($primary) {
                $primary->update([
                    'documents' => $payload['documents'],
                    'pdf_path' => $payload['pdf_path'],
                ]);

                DocumentChecklist::where('country_id', $country->id)
                    ->where('id', '!=', $primary->id)
                    ->delete();

                continue;
            }

            DocumentChecklist::create([
                'country_id' => $country->id,
                'documents' => $payload['documents'],
                'pdf_path' => $payload['pdf_path'],
            ]);
        }

        DocumentChecklist::query()
            ->when(!empty($syncedCountryIds), function ($query) use ($syncedCountryIds) {
                $query->whereNotIn('country_id', $syncedCountryIds);
            })
            ->when(empty($syncedCountryIds), function ($query) {
                $query->whereRaw('1 = 1');
            })
            ->delete();
    }

    private function normalizeDocuments(mixed $documents): array
    {
        if (!is_array($documents)) {
            return [];
        }

        $normalized = [];

        foreach ($documents as $document) {
            if (!is_array($document)) {
                continue;
            }

            $name = trim((string) ($document['name'] ?? ''));
            $description = trim((string) ($document['description'] ?? ''));

            if ($name === '' && $description === '') {
                continue;
            }

            $normalized[] = [
                'name' => $name,
                'description' => $description,
            ];
        }

        return array_values($normalized);
    }

    private function normalizeName(string $name): string
    {
        $name = strtolower(trim($name));
        $name = preg_replace('/[^a-z0-9\s]/', ' ', $name);
        $name = preg_replace('/\s+/', ' ', (string) $name);

        return trim((string) $name);
    }
}
