<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class WhyCountriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('why_countries')->delete();
        
        \DB::table('why_countries')->insert(array (
            0 => 
            array (
                'id' => 1,
                'country_id' => 1,
                'description' => '["Excellent education and resources with high-ranking universities.","Rich and inclusive academic environment with multicultural exposure.","Strong ties with top industries, providing job opportunities worldwide.","Scholarships and financial assistance for international students.","A diverse range of programs and majors to choose from.","Home to some of the best research institutions in the world."]',
                'created_at' => '2025-10-08 09:14:05',
                'updated_at' => '2025-10-17 13:17:38',
            ),
            1 => 
            array (
                'id' => 2,
                'country_id' => 2,
                'description' => '["High-quality education and degrees that are globally recognized and respected.","Safe and welcoming environment for international students.","A multicultural and diverse country with exposure to cross-cultural practices.","Part-time work opportunities for international students and full-time roles after graduation.","Strong research and practical learning facilities.","Strong and stable economy with a diverse job market."]',
                'created_at' => '2025-10-08 09:14:05',
                'updated_at' => '2025-10-17 12:40:18',
            ),
            2 => 
            array (
                'id' => 3,
                'country_id' => 3,
                'description' => '["Safe country with low crime rates and political stability.","High-quality and research-driven education and programs.","Affordable tuition fees and cost of living compared to other top study destinations.","Provides attractive post-study immigration and career options.","Offers scholarships to international students to help with the expenses.","Easier for international students to connect due to a diverse and inclusive environment."]',
                'created_at' => '2025-10-08 09:14:05',
                'updated_at' => '2025-10-17 13:32:41',
            ),
            3 => 
            array (
                'id' => 4,
                'country_id' => 4,
                'description' => '["World-class education and home to top universities.","Rich History and a vibrant mix of various cultures.","Scholarships and Financial Aid for international students.","UK Graduates are highly sought after worldwide.","Vibrant College Life with various clubs and activities.","Outstanding Research Opportunities with access to top facilities."]',
                'created_at' => '2025-10-08 09:14:05',
                'updated_at' => '2025-10-17 13:02:54',
            ),
            4 => 
            array (
                'id' => 5,
                'country_id' => 5,
                'description' => '["Universally accepted top-notch education system.","Lower cost of living and studying compared to other top countries.","A multicultural and diverse country that welcomes students from all over the world.","Beautiful landscapes accompanied by prestigious universities.","Supports graduates with post-study work options.","Plenty of scholarship opportunities for international students."]',
                'created_at' => '2025-10-08 09:14:05',
                'updated_at' => '2025-10-17 13:48:16',
            ),
            5 => 
            array (
                'id' => 6,
                'country_id' => 6,
                'description' => '["World-class education in technology, engineering, and business with globally respected universities.","Affordable tuition fees and living costs compared to the UK, USA, and Australia.","MEXT and university scholarships that significantly reduce financial burden for international students.","Safe, disciplined, and welcoming society with one of the lowest crime rates in the world.","Strong part-time work opportunities and a growing demand for skilled foreign workers after graduation.","Rich culture, modern infrastructure, and easy access to the rest of Asia."]',
                'created_at' => '2026-08-13 15:56:07',
                'updated_at' => '2026-08-13 15:56:07',
            ),
        ));
        
        
    }
}