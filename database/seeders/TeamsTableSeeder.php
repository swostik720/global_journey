<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TeamsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('teams')->delete();
        
        \DB::table('teams')->insert(array (
            0 => 
            array (
                'id' => 6,
                'image' => 'nSIUcVH3nd24Jv7FMdEBXx34DSz57FJEWEuCVUjy.jpg',
                'image_alt' => 'Rajya Limbu team profile image',
                'name' => 'Rajya Limbu',
                'slug' => 'rajya-limbu-aHWHEZ1s5c',
                'email' => 'rajya.globaljourney1@gmail.com',
                'phone' => '9869556302',
                'responsibility' => 'Documentation Officer',
                'experience' => NULL,
                'fb_link' => NULL,
                'twitter_link' => NULL,
                'linkedin_link' => NULL,
                'instagram_link' => NULL,
                'details' => NULL,
                'rank' => 2,
                'status' => 1,
                'created_at' => '2025-10-16 10:30:31',
                'updated_at' => '2026-04-30 17:48:25',
            ),
            1 => 
            array (
                'id' => 8,
                'image' => 'BKaOP8S2t90nmH7Vk3K1E52AElJAwcKNTi36m7wI.jpg',
                'image_alt' => 'Janak Bhul team profile image',
                'name' => 'Janak Bhul',
                'slug' => 'janak-bhul-iFbhMj8OkZ',
                'email' => 'janak.globaljourney@gmail.com',
                'phone' => '9860315775',
                'responsibility' => 'Counselor',
                'experience' => NULL,
                'fb_link' => NULL,
                'twitter_link' => NULL,
                'linkedin_link' => NULL,
                'instagram_link' => NULL,
                'details' => NULL,
                'rank' => 3,
                'status' => 1,
                'created_at' => '2025-10-16 11:10:08',
                'updated_at' => '2026-07-16 11:25:28',
            ),
            2 => 
            array (
                'id' => 9,
                'image' => 'C9Cu0nfz8PN4iWbsKxiXRopTKgHAyHexCxzVHnO8.jpg',
                'image_alt' => 'Kishan Khatri team profile image',
                'name' => 'Kishan Khatri',
                'slug' => 'kishan-khatri-Js442AY8Ao',
                'email' => 'kishanglobaljourney@gmail.com',
                'phone' => '9705427847',
                'responsibility' => 'Counselor',
                'experience' => NULL,
                'fb_link' => NULL,
                'twitter_link' => NULL,
                'linkedin_link' => NULL,
                'instagram_link' => NULL,
                'details' => NULL,
                'rank' => 4,
                'status' => 1,
                'created_at' => '2025-10-16 12:14:20',
                'updated_at' => '2026-04-30 17:48:58',
            ),
            3 => 
            array (
                'id' => 10,
                'image' => '3leSOGpHK9iGVmfHjRR6x9V5NNHeDyXHjb9NzHOG.jpg',
                'image_alt' => 'Deepa Tandukar team profile image',
                'name' => 'Deepa Tandukar',
                'slug' => 'deepa-tandukar-f7yRGJk3NI',
                'email' => 'globaljourney.au@gmail.com',
                'phone' => '9705427841',
                'responsibility' => 'Senior Counselor',
                'experience' => NULL,
                'fb_link' => NULL,
                'twitter_link' => NULL,
                'linkedin_link' => NULL,
                'instagram_link' => NULL,
                'details' => NULL,
                'rank' => 5,
                'status' => 1,
                'created_at' => '2025-10-16 12:21:49',
                'updated_at' => '2026-04-30 17:49:15',
            ),
            4 => 
            array (
                'id' => 11,
                'image' => 'bsDgfD6UgcqUua7UpuErcxj3Suh5dOf7jmRNMSDw.jpg',
                'image_alt' => 'Aashma Maharjan team profile image',
                'name' => 'Aashma Maharjan',
                'slug' => 'aashma-maharjan-ch6bS2JUFB',
                'email' => 'aashmaglobaljourney@gmail.com',
                'phone' => '9705427842',
                'responsibility' => 'Application Officer',
                'experience' => NULL,
                'fb_link' => NULL,
                'twitter_link' => NULL,
                'linkedin_link' => NULL,
                'instagram_link' => NULL,
                'details' => NULL,
                'rank' => 7,
                'status' => 1,
                'created_at' => '2025-10-16 12:23:36',
                'updated_at' => '2026-07-16 14:06:48',
            ),
            5 => 
            array (
                'id' => 12,
                'image' => 'ktuTSznqOVvXEv1t7OZ34UQxT9rsJwkvS5UM336n.jpg',
                'image_alt' => 'Yagya Raj Poudel team profile image',
                'name' => 'Yagya Raj Poudel',
                'slug' => 'yagya-raj-poudel-Its0yQdJF3',
                'email' => 'info@globaljourneyedu.com.np',
                'phone' => '9856032344',
                'responsibility' => 'Managing Director',
                'experience' => NULL,
                'fb_link' => NULL,
                'twitter_link' => NULL,
                'linkedin_link' => NULL,
                'instagram_link' => NULL,
                'details' => NULL,
                'rank' => 1,
                'status' => 1,
                'created_at' => '2025-10-30 13:09:00',
                'updated_at' => '2026-04-30 17:48:08',
            ),
            6 => 
            array (
                'id' => 15,
                'image' => 'IG4B9xZUoFVpkUCZxiYpu3zLk24bpXbTkGTrS8BE.jpg',
                'image_alt' => NULL,
                'name' => 'Susmita Shahi',
                'slug' => 'susmita-shahi-WRri8uTdVK',
                'email' => 'susmita.globaljourney@gmail.com',
                'phone' => '9705427840',
                'responsibility' => 'Application Officer',
                'experience' => NULL,
                'fb_link' => NULL,
                'twitter_link' => NULL,
                'linkedin_link' => NULL,
                'instagram_link' => NULL,
                'details' => NULL,
                'rank' => 6,
                'status' => 1,
                'created_at' => '2026-07-16 11:38:33',
                'updated_at' => '2026-07-16 14:09:36',
            ),
            7 => 
            array (
                'id' => 16,
                'image' => 'Mwe28hjolIoDOnY1ZMUkiXzeCRQO5Th09e5jb42t.jpg',
                'image_alt' => NULL,
                'name' => 'Ram Chandra Bhandari',
                'slug' => 'ram-chandra-bhandari-ADCcGclSFM',
                'email' => 'japan@globaljourneyedu.com.np',
                'phone' => '9846880181',
                'responsibility' => 'Principal',
                'experience' => NULL,
                'fb_link' => NULL,
                'twitter_link' => NULL,
                'linkedin_link' => NULL,
                'instagram_link' => NULL,
                'details' => NULL,
                'rank' => 8,
                'status' => 1,
                'created_at' => '2026-07-21 14:56:56',
                'updated_at' => '2026-07-21 14:56:56',
            ),
            8 => 
            array (
                'id' => 17,
                'image' => 'ajcvUR9mWszYHZAPZnWcEPzYtUziXUDO9ANde5O9.jpg',
                'image_alt' => NULL,
                'name' => 'Ishwor Thapa',
                'slug' => 'ishwor-thapa-iRV17Zyxbz',
                'email' => 'japan@globaljourneyedu.com.np',
                'phone' => '+81 90-9269-9104',
                'responsibility' => 'Director',
                'experience' => NULL,
                'fb_link' => NULL,
                'twitter_link' => NULL,
                'linkedin_link' => NULL,
                'instagram_link' => NULL,
                'details' => NULL,
                'rank' => 9,
                'status' => 1,
                'created_at' => '2026-07-21 15:31:33',
                'updated_at' => '2026-07-21 15:31:33',
            ),
        ));
        
        
    }
}