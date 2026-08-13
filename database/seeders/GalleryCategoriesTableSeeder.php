<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class GalleryCategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('gallery_categories')->delete();
        
        \DB::table('gallery_categories')->insert(array (
            0 => 
            array (
                'id' => 5,
                'title' => 'Visa',
                'description' => 'Images of the student whose visa have been approved',
                'created_at' => '2025-10-15 10:58:22',
                'updated_at' => '2025-10-15 11:08:49',
            ),
        ));
        
        
    }
}