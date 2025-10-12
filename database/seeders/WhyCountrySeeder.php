<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WhyCountry;
use App\Models\Country;

class WhyCountrySeeder extends Seeder
{
    public function run(): void
    {
        $countries = Country::all();

        foreach ($countries as $country) {
            $points = match (strtolower($country->name)) {
                'uk' => [
                    'World-class education and historic universities.',
                    'Diverse and inclusive culture.',
                    'Excellent research opportunities.',
                    'Strong career prospects for international students.',
                    'Vibrant campus life with clubs and activities.',
                ],
                'united state', 'usa' => [
                    'Cutting-edge education in top-ranked universities.',
                    'Vibrant and diverse campus life.',
                    'Wide range of programs and majors.',
                    'Innovation-driven research opportunities.',
                    'Extensive networking and career growth opportunities.',
                ],
                'australia' => [
                    'High-quality education recognized worldwide.',
                    'Safe and welcoming environment for students.',
                    'Multicultural campuses and diverse community.',
                    'Strong research and practical learning facilities.',
                    'Opportunities for post-study work and immigration.',
                ],
                'canada' => [
                    'Excellent education system and global recognition.',
                    'Multicultural society with inclusive campuses.',
                    'Affordable tuition compared to other countries.',
                    'Post-study work and career opportunities.',
                    'High quality of life and safety for students.',
                ],
                'new zealand', 'newzealand' => [
                    'Quality education and recognized institutions.',
                    'Stunning natural landscapes and safe environment.',
                    'Inclusive communities and welcoming culture.',
                    'Hands-on learning and practical experience.',
                    'Pathways to work and stay after studies.',
                ],
                default => [
                    'Quality education.',
                    'Cultural diversity and global exposure.',
                    'Wide range of academic programs.',
                    'Opportunities for career growth.',
                    'Safe and supportive learning environment.',
                ],
            };

            WhyCountry::create([
                'country_id' => $country->id,
                'description' => $points,
            ]);
        }
    }
}
