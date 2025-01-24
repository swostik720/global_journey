<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->delete();

        DB::table('categories')->insert(array(
            0 =>
            array(
                'id' => 1,
                'name' => 'Consulting',
                'status' => 1,
                'created_at' => '2025-01-19 16:52:37',
                'updated_at' => '2025-01-19 16:52:37',
            ),
            1 =>
            array(
                'id' => 2,
                'name' => 'Education',
                'status' => 1,
                'created_at' => '2025-01-19 16:52:49',
                'updated_at' => '2025-01-19 16:52:49',
            ),
            2 =>
            array(
                'id' => 3,
                'name' => 'Travel and Tours',
                'status' => 1,
                'created_at' => '2025-01-19 16:53:42',
                'updated_at' => '2025-01-19 16:53:42',
            ),
        ));
    }
}
