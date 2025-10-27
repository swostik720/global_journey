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
            'Australia',
            'Newzerland',
            'United State',
            'UK',
            'Canada'
        ];

        $countryIds = Country::whereIn('name', $countries)->pluck('id', 'name');

        // Updated array with name + description structure
        $documents = [
            [
                'name' => 'If Salary',
                'description' => "
- Appointment Letter (Niyukti Patra)
- Salary Certificate
- Bank Statement (Last 1 Year)
- Tax Clearance (Last 3 Years if possible)
- Personal PAN Card
"
            ],
            [
                'name' => 'If Business',
                'description' => "
- PAN Card
- Business Registration
- Business Bank Statement (Last 1 Year)
- Tax Clearance (Last 3 Years if possible)
"
            ],
            [
                'name' => 'If Vehicle',
                'description' => "
- Blue Book Photocopy
- Certificate from Organization (Agreement)
- Vehicle Insurance
- Tax Clearance (Last 3 Years)
- Bank Statement (Last 1 Year)
"
            ],
            [
                'name' => 'If Pension',
                'description' => "
- Pension Patta
- Pension Statement (Last 1 Year)
"
            ],
            [
                'name' => 'If Agriculture',
                'description' => "
- Tax-Free Certificate from Ward Office
- Certificate from Organization/Firm
- Bill Receipts (If Available)
- Land Ownership Certificate
- Land Tax Receipt (Last 3 Years)
- Bank Statement (Last 1 Year)
"
            ],
            [
                'name' => 'If Foreign Income',
                'description' => "
- Passport
- Employment Contract Paper
- Visa Copy
- Salary Certificate
- Pay Slips
- Bank Statement (Last 1 Year)
- Remittance Receipts (If Available)
- Affidavit
"
            ],
            [
                'name' => 'If House Rent / Land Lease',
                'description' => "
- Agreement Papers
- Citizenship of Tenant
- Rent or Land Lease Tax from Ward
- Land Ownership Certificate
- Land Tax Receipt (Last 3 Years)
- House Completion Certificate (if applicable)
- Bank Statement (Last 1 Year)
"
            ],

        ];

        foreach ($countryIds as $countryName => $countryId) {
            DocumentChecklist::create([
                'country_id' => $countryId,
                'documents' => $documents,
            ]);
        }
    }
}
