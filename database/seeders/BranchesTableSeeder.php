<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BranchesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('branches')->delete();
        
        \DB::table('branches')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Kathmandu Office',
                'slug' => NULL,
                'email' => 'info@globaljourneyedu.com.np',
                'phone' => '01-4168345',
                'mobile' => NULL,
                'contact_address' => 'Putalisadak, Kathmandu, Nepal',
                'map_url' => NULL,
                'working_hours' => 'Mon-Fri: 9am – 5pm',
                'status' => 1,
                'created_at' => '2025-01-24 11:56:01',
                'updated_at' => '2025-10-13 13:34:55',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Birtamod Office',
                'slug' => NULL,
                'email' => 'info@globaljourneyedu.com.np',
                'phone' => '+977-9843215204',
                'mobile' => NULL,
                'contact_address' => 'Birtamod, Nepal',
                'map_url' => NULL,
                'working_hours' => 'Mon-Fri: 9am – 5pm',
                'status' => 1,
                'created_at' => '2025-01-24 11:57:06',
                'updated_at' => '2025-10-29 11:50:38',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Lalitpur Office',
                'slug' => NULL,
                'email' => 'info@globaljourneyedu.com.np',
                'phone' => '+977-9843215204',
                'mobile' => NULL,
                'contact_address' => 'Kupendole, Lalitpur',
                'map_url' => NULL,
                'working_hours' => 'Mon-Fri: 9am – 5pm',
                'status' => 1,
                'created_at' => '2025-10-09 09:20:29',
                'updated_at' => '2026-04-30 14:30:41',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Sydney Support Office',
                'slug' => NULL,
                'email' => 'info@globaljourneyedu.com.np',
                'phone' => '+977-9843215204',
                'mobile' => NULL,
                'contact_address' => 'Sydney, Australia',
                'map_url' => NULL,
                'working_hours' => 'Mon-Fri: 9am – 5pm',
                'status' => 1,
                'created_at' => '2026-04-30 14:30:22',
                'updated_at' => '2026-04-30 14:30:53',
            ),
        ));
        
        
    }
}