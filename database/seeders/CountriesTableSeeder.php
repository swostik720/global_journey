<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('countries')->delete();
        
        \DB::table('countries')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'United States',
                'status' => 1,
                'created_at' => '2025-01-18 15:53:52',
                'updated_at' => '2025-10-13 15:07:22',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Australia',
                'status' => 1,
                'created_at' => '2025-01-18 15:53:57',
                'updated_at' => '2025-01-18 15:53:57',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Canada',
                'status' => 1,
                'created_at' => '2025-01-18 15:54:00',
                'updated_at' => '2025-01-18 15:54:00',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'UK',
                'status' => 1,
                'created_at' => '2025-01-18 15:54:03',
                'updated_at' => '2025-01-18 15:54:03',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'New Zealand',
                'status' => 1,
                'created_at' => '2025-01-18 15:54:09',
                'updated_at' => '2025-10-13 15:06:54',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Japan',
                'status' => 1,
                'created_at' => '2026-07-17 16:50:53',
                'updated_at' => '2026-07-17 16:50:53',
            ),
        ));
        
        
    }
}