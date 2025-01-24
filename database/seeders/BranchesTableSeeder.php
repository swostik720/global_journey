<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BranchesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::table('branches')->delete();

        DB::table('branches')->insert(array(
            0 =>
            array(
                'id' => 1,
                'name' => 'Kathmandu Office',
                'slug' => NULL,
                'email' => 'globaljourneyktm@info.com.np',
                'phone' => '+01-84856938',
                'mobile' => NULL,
                'contact_address' => 'Putalisadak, Kathmandu Nepal',
                'map_url' => NULL,
                'working_hours' => 'Mon-Fri: 10am – 5pm',
                'status' => 1,
                'created_at' => '2025-01-24 11:56:01',
                'updated_at' => '2025-01-24 11:57:29',
            ),
            1 =>
            array(
                'id' => 2,
                'name' => 'Birtamod Office',
                'slug' => NULL,
                'email' => 'globaljourneybirtamod@gmail.com',
                'phone' => '+977-9843215204',
                'mobile' => NULL,
                'contact_address' => 'Birtamod, Nepal',
                'map_url' => NULL,
                'working_hours' => 'Mon-Fri: 10am – 5pm',
                'status' => 1,
                'created_at' => '2025-01-24 11:57:06',
                'updated_at' => '2025-01-24 11:57:06',
            ),
        ));
    }
}
