<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DocumentChecklist;
use App\Models\Country;

class DocumentChecklistTableSeeder extends Seeder
{
    public function run(): void
    {
        $countries = [
            'Australia', 'Newzerland', 'United State', 'UK', 'Canada'
        ];

        $countryIds = Country::whereIn('name', $countries)->pluck('id', 'name');

        // Updated array with name + description structure
        $documents = [
            [
                'name' => 'Offer/Acceptance Letter',
                'description' => 'Formal proof of admission from the educational institution.'
            ],
            [
                'name' => 'Academic Records',
                'description' => 'Includes transcripts, certificates, and degrees.'
            ],
            [
                'name' => 'Passport',
                'description' => 'Must be valid for minimum 6 months from travel date.'
            ],
            [
                'name' => 'English Test',
                'description' => 'IELTS, TOEFL, PTE or equivalent language proficiency score.'
            ],
            [
                'name' => 'Statement of Purpose / SOP',
                'description' => 'Explains academic goals and why you chose this country.'
            ],
            [
                'name' => 'Work Experience / Training',
                'description' => 'If applicable, includes certificates, experience letters.'
            ],
            [
                'name' => 'Financial Documents',
                'description' => 'Proof of funds like bank statements and sponsor letters.'
            ],
            [
                'name' => 'Visa Fee / Government Proof',
                'description' => 'Proof of visa application fee payment.'
            ],
            [
                'name' => 'Health / Medical',
                'description' => 'Mandatory medical and health insurance requirements.'
            ],
            [
                'name' => 'Biometrics / Interview',
                'description' => 'May require in-person interview or fingerprint scanning.'
            ],
            [
                'name' => 'Travel Documents',
                'description' => 'Flight booking details, itinerary, etc.'
            ]
        ];

        foreach ($countryIds as $countryName => $countryId) {
            DocumentChecklist::create([
                'country_id' => $countryId,
                'documents' => $documents,
            ]);
        }
    }
}
