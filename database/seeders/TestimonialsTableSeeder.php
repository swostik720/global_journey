<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestimonialsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::table('testimonials')->delete();

        DB::table('testimonials')->insert(array(
            0 =>
            array(
                'id' => 1,
                'image' => 'yFxlEs2u9gb9Nb4c4b72daegYZcSUAnQo1Ila5mS.jpg',
                'name' => 'Ram Thapa',
                'address' => 'Kathmandu, Nepal',
                'description' => 'I able to prove potential employers that i have a solid understanding of computers & hardware- and started to receive real, viable job offers',
                'rating' => 4,
                'status' => 1,
                'created_at' => '2025-01-17 09:15:08',
                'updated_at' => '2025-01-17 09:15:08',
            ),
            1 =>
            array(
                'id' => 2,
                'image' => 'MJzyJnHqCtyfwBOCibsIjRnULAzcK52sjws7kWX2.jpg',
                'name' => 'John Doe',
                'address' => 'Kathmandu, Nepal',
                'description' => 'I able to prove potential employers that i have a solid understanding of computers & hardware- and started to receive real, viable job offers',
                'rating' => 5,
                'status' => 1,
                'created_at' => '2025-01-17 09:15:25',
                'updated_at' => '2025-01-17 09:15:25',
            ),
            2 =>
            array(
                'id' => 3,
                'image' => 'wa0lCjNxFUpVAKvXqbB4icXs9BE6FqSrzMDY5cDI.jpg',
                'name' => 'Charlie Shah',
                'address' => 'Birtnagar, Nepal',
                'description' => 'I able to prove potential employers that i have a solid understanding of computers & hardware- and started to receive real, viable job offers',
                'rating' => 5,
                'status' => 1,
                'created_at' => '2025-01-17 09:16:01',
                'updated_at' => '2025-01-17 09:17:02',
            ),
            3 =>
            array(
                'id' => 4,
                'image' => 'HNZx4aEwvrtd8LOHjB0g9FZQmcZToGhDX78lLfkR.jpg',
                'name' => 'Raman Sigdel',
                'address' => 'Kathmandu, Nepal',
                'description' => 'I able to prove potential employers that i have a solid understanding of computers & hardware- and started to receive real, viable job offers',
                'rating' => 5,
                'status' => 1,
                'created_at' => '2025-01-17 09:16:20',
                'updated_at' => '2025-01-17 09:16:20',
            ),
            4 =>
            array(
                'id' => 5,
                'image' => 'R0O0R7KoA52e8we6ILWCOA1Ns8qEE2zSTcJbaJEs.jpg',
                'name' => 'Abhishek Dhital',
                'address' => 'Nepal',
                'description' => 'I able to prove potential employers that i have a solid understanding of computers & hardware- and started to receive real, viable job offers',
                'rating' => 5,
                'status' => 1,
                'created_at' => '2025-01-17 09:16:43',
                'updated_at' => '2025-01-17 09:16:43',
            ),
        ));
    }
}
