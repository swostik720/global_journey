<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CollegeAndUniversity;
use App\Models\Country;

class CollegeAndUniversitySeeder extends Seeder
{
    public function run(): void
    {
        $countries = Country::all();

        foreach ($countries as $country) {
            // Seed a College
            CollegeAndUniversity::create([
                'country_id'  => $country->id,
                'name'        => 'Sample College of ' . $country->name,
                'description' => 'This is a sample college in ' . $country->name . ' providing quality education.',
                'link'        => 'https://example.com/college-' . strtolower(str_replace(' ', '-', $country->name)),
                // 'image'       => 'sample-college.png', // optional placeholder
            ]);

            // Seed a University
            CollegeAndUniversity::create([
                'country_id'  => $country->id,
                'name'        => 'Sample University of ' . $country->name,
                'description' => 'This is a sample university in ' . $country->name . ' offering higher education programs.',
                'link'        => 'https://example.com/university-' . strtolower(str_replace(' ', '-', $country->name)),
                // 'image'       => 'sample-university.png', // optional placeholder
            ]);
        }
    }
}
