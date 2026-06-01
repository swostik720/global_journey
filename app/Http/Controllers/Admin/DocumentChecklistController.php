<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DocumentChecklist;
use App\Models\Country;
use App\Http\Requests\DocumentChecklistRequest;
use Illuminate\Http\Request;
use App\Enums\DocumentChecklistType;
use Illuminate\Support\Str;

class DocumentChecklistController extends Controller
{
    public function index()
    {
        $items = DocumentChecklist::with('country')->paginate(20);
        return view('admin.document_checklist.index', compact('items'));
    }

    public function create()
    {
        $countries = Country::all();
        $types = DocumentChecklistType::cases();
        return view('admin.document_checklist.create', compact('countries', 'types'));
    }

    // public function store(DocumentChecklistRequest $request)
    // {
    //     $data = $request->validated();
    //     if (isset($data['documents']) && is_string($data['documents'])) {
    //         $docs = preg_split('/\r\n|\r|\n/', $data['documents']);
    //         $data['documents'] = array_filter(array_map('trim', $docs));
    //     }
    //     DocumentChecklist::create($data);
    //     return redirect()->route('admin.document_checklist.index')->with('success', 'Document checklist created.');
    // }

    public function store(DocumentChecklistRequest $request)
    {
        $data = $request->validated();
        $data['documents'] = $this->normalizeDocumentsInput($request->input('documents', []));

        if ($request->hasFile('pdf_file')) {
            $data['pdf_path'] = $this->storePdfFile(
                $request->file('pdf_file'),
                (int) $data['country_id']
            );
        }

        DocumentChecklist::create($data);

        return redirect()->route('admin.document_checklist.index')
            ->with('success', 'Document checklist created.');
    }


    public function edit($id)
    {
        $item = DocumentChecklist::findOrFail($id);
        $countries = Country::all();
        $types = DocumentChecklistType::cases();

        return view('admin.document_checklist.edit', compact('item', 'countries', 'types'));
    }

    // public function update(DocumentChecklistRequest $request, $id)
    // {
    //     $item = DocumentChecklist::findOrFail($id);
    //     $data = $request->validated();

    //     // Convert textarea string into array
    //     if (!empty($data['documents']) && is_string($data['documents'])) {
    //         $data['documents'] = array_values(array_filter(
    //             array_map('trim', preg_split("/\r\n|\r|\n/", $data['documents']))
    //         ));
    //     }

    //     $item->update($data);

    //     return redirect()
    //         ->route('admin.document_checklist.index')
    //         ->with('success', 'Document checklist updated successfully.');
    // }

    public function update(DocumentChecklistRequest $request, $id)
    {
        $item = DocumentChecklist::findOrFail($id);
        $data = $request->validated();
        $data['documents'] = $this->normalizeDocumentsInput($request->input('documents', []));

        if ($request->hasFile('pdf_file')) {
            $data['pdf_path'] = $this->storePdfFile(
                $request->file('pdf_file'),
                (int) $data['country_id']
            );
        }

        $item->update($data);

        return redirect()->route('admin.document_checklist.index')
            ->with('success', 'Document checklist updated successfully.');
    }

    public function show($id)
    {
        $item = DocumentChecklist::with('country')->findOrFail($id);
        return view('admin.document_checklist.show', compact('item'));
    }
    public function destroy($id)
    {
        $item = DocumentChecklist::findOrFail($id);
        $item->delete();
        return redirect()->route('admin.document_checklist.index')->with('success', 'Document checklist deleted.');
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids', []);
        if (!empty($ids)) {
            DocumentChecklist::whereIn('id', $ids)->delete();
            return response()->json(['success' => true, 'message' => 'Selected document checklists deleted.']);
        }
        return response()->json(['success' => false, 'message' => 'No items selected.']);
    }

    private function storePdfFile($file, int $countryId): string
    {
        $country = Country::find($countryId);
        $countryName = $country?->name ?? 'country';
        $baseName = Str::slug($countryName, '_') . '_document_checklist.pdf';

        $targetDirectory = public_path('frontend/assets/pdf');
        if (!is_dir($targetDirectory)) {
            mkdir($targetDirectory, 0755, true);
        }

        $file->move($targetDirectory, $baseName);

        return 'frontend/assets/pdf/' . $baseName;
    }

    private function normalizeDocumentsInput(mixed $input): array
    {
        if (is_string($input)) {
            $decoded = json_decode($input, true);
            $input = is_array($decoded) ? $decoded : [];
        }

        if (!is_array($input)) {
            return [];
        }

        $normalized = [];

        foreach ($input as $row) {
            if (is_string($row)) {
                $name = trim($row);
                if ($name !== '') {
                    $normalized[] = [
                        'name' => $name,
                        'description' => '',
                    ];
                }
                continue;
            }

            if (!is_array($row)) {
                continue;
            }

            $name = trim((string) ($row['name'] ?? ''));
            $description = trim((string) ($row['description'] ?? ''));

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
}
