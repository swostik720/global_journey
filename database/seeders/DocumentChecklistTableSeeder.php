<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DocumentChecklist;
use App\Models\Country;
use App\Enums\DocumentChecklistType;

class DocumentChecklistTableSeeder extends Seeder
{
    public function run(): void
    {
        $countries = [
            'Australia', 'Newzerland', 'United State', 'UK', 'Canada'
        ];
        $countryIds = Country::whereIn('name', $countries)->pluck('id', 'name');

        $documents = [
            'Offer/Acceptance Letter',
            'Academic Records',
            'Passport',
            'English Test',
            'Statement of Purpose / SOP',
            'Work Experience / Training',
            'Financial Documents',
            'Visa Fee / Government Proof',
            'Health / Medical',
            'Biometrics / Interview',
            'Travel Documents',
        ];

        foreach ($countryIds as $countryName => $countryId) {
            DocumentChecklist::create([
                'country_id' => $countryId,
                'documents' => $documents,
            ]);
        }
    }
}
