<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudyAbroadsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::table('study_abroads')->delete();

        DB::table('study_abroads')->insert(array(
            array(
                'id' => 1,
                'image' => 'DYXlYpgvEplNzsI6gGttzXGKaYnyhVt7aEJ1H9FX.jpg',
                'title' => 'Study in Australia',
                'slug' => 'study-in-australia',
                'short_description' => 'Universities consistently has wide range of programs that cater to diverse academic interests.',
                'description' => 'Australia has emerged as a top destination for Nepali students seeking high-quality education, a multicultural environment, and diverse career opportunities.',
                'country_id' => 2,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ),
            array(
                'id' => 2,
                'image' => 'Fr4PCMLfJYvV4zELpqlKmCenvxYWQWqjnCcNMcYT.jpg',
                'title' => 'Study in United Kingdom',
                'slug' => 'study-in-united-kingdom',
                'short_description' => 'Offering a wide range of programs that cater to diverse academic interests.',
                'description' => 'UK has emerged as a top destination for Nepali students seeking high-quality education, a multicultural environment, and diverse career opportunities.',
                'country_id' => 4,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ),
            array(
                'id' => 3,
                'image' => 'P9UofKvRiLWDZKx67UdFy1ejoScjZYOlSApHmdk6.jpg',
                'title' => 'Australia Study Course',
                'slug' => 'australia-study-course',
                'short_description' => 'Universities consistently rank among the best globally, offering a wide range of programs that cater to diverse academic interests.',
                'description' => 'Australia has emerged as a top destination for Nepali students seeking high-quality education, a multicultural environment, and diverse career opportunities.',
                'country_id' => 2,
                'status' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ),
            array(
                'id' => 4,
                'image' => 'Gh9wHopQEpvecvaDu1jaNh5gDljrzp5KKmgITbfe.jpg',
                'title' => 'Study in Canada',
                'slug' => 'study-in-canada',
                'short_description' => 'Universities consistently rank among the best globally, offering a wide range of programs that cater to diverse academic interests.',
                'description' => 'Canada has emerged as a top destination for Nepali students seeking high-quality education, a multicultural environment, and diverse career opportunities.',
                'country_id' => 3,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ),
            array(
                'id' => 5,
                'image' => 'NZImage.jpg',
                'title' => 'Study in New Zealand',
                'slug' => 'study-in-new-zealand',
                'short_description' => 'New Zealand universities offer a wide range of programs and a welcoming environment for international students.',
                'description' => 'New Zealand is a popular destination for Nepali students due to its quality education and beautiful landscapes.',
                'country_id' => 5,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ),
            array(
                'id' => 6,
                'image' => 'USAImage.jpg',
                'title' => 'Study in USA',
                'slug' => 'study-in-usa',
                'short_description' => 'USA offers world-class universities and diverse academic opportunities for international students.',
                'description' => 'USA is a top choice for Nepali students seeking advanced education and research opportunities.',
                'country_id' => 1,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ),
        ));
    }
}
