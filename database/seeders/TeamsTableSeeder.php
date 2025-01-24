<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeamsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::table('teams')->delete();

        DB::table('teams')->insert(array(
            0 =>
            array(
                'id' => 1,
                'image' => 'l6P6YF9MCVeZcjaojiVUJHPOv9lR5XWj3AUYV9SI.jpg',
                'name' => 'Charlie Doe',
                'slug' => 'charlie-doe-dbT1RN4e4d',
                'email' => NULL,
                'phone' => NULL,
                'responsibility' => 'HR',
                'experience' => NULL,
                'fb_link' => 'https://www.facebook.com/charlie-doe',
                'twitter_link' => 'https://www.twitter.com/charlie-doe',
                'linkedin_link' => 'https://www.linkedin.com/charlie-doe',
                'instagram_link' => 'https://www.instagram.com/charlie-doe',
                'details' => NULL,
                'rank' => 3,
                'status' => 1,
                'created_at' => '2025-01-17 10:47:13',
                'updated_at' => '2025-01-17 10:48:27',
            ),
            1 =>
            array(
                'id' => 2,
                'image' => 'eyWzU2Pre2TzDtMEIKe9ipWtv9Qjukknn4SNnisr.jpg',
                'name' => 'Ram Thapa',
                'slug' => 'ram-thapa-LmDVmkqyvq',
                'email' => NULL,
                'phone' => NULL,
                'responsibility' => 'Director',
                'experience' => NULL,
                'fb_link' => 'https://www.facebook.com/ramthapa',
                'twitter_link' => 'https://www.twitter.com/ramthapa',
                'linkedin_link' => 'https://www.linkedin.com/ramthapa',
                'instagram_link' => 'https://www.instagram.com/ramthapa',
                'details' => NULL,
                'rank' => 2,
                'status' => 1,
                'created_at' => '2025-01-17 10:49:54',
                'updated_at' => '2025-01-17 10:49:54',
            ),
            2 =>
            array(
                'id' => 3,
                'image' => 'uNQo4MooU9kplC4ijaBxgxhXygdbxSd6ZQ86C4Zc.jpg',
                'name' => 'Abrabab Mohamad',
                'slug' => 'abrabab-mohamad-7iRGx8zAAI',
                'email' => NULL,
                'phone' => NULL,
                'responsibility' => 'Managing Director',
                'experience' => NULL,
                'fb_link' => 'https://www.facebook.com/abrabab',
                'twitter_link' => 'https://www.twitter.com/abrabab',
                'linkedin_link' => 'https://www.linkedin.com/abrabab',
                'instagram_link' => 'https://www.instagram.com/abrabab',
                'details' => NULL,
                'rank' => 1,
                'status' => 1,
                'created_at' => '2025-01-17 10:51:14',
                'updated_at' => '2025-01-17 10:51:14',
            ),
        ));
    }
}
