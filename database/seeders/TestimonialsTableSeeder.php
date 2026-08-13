<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TestimonialsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('testimonials')->delete();
        
        \DB::table('testimonials')->insert(array (
            0 => 
            array (
                'id' => 6,
                'image' => 'rIUixhFxz070TMol10HGPHoL7xu4elRdgHFNF2ge.webp',
                'image_alt' => 'Maneesh Chaudhari testimonial photo',
                'name' => 'Maneesh Chaudhari',
                'address' => 'Kathmandu, Nepal',
                'description' => 'I want to thank the Global Journey Education for all their help with my UK visa application. They made the process so much easier by guiding me through every step, from gathering documents to preparing for the interview. Their support and advice were really valuable, and I’m grateful for their hard work in helping me get my visa.',
                'rating' => 5,
                'status' => 1,
                'created_at' => '2025-10-14 14:14:49',
                'updated_at' => '2026-04-30 10:13:41',
            ),
            1 => 
            array (
                'id' => 10,
                'image' => 'AGTvyPEmJBdXlOy3sw7CdwozMXGzgej9H1vm9GvI.webp',
                'image_alt' => 'Roshan Ghising testimonial photo',
                'name' => 'Roshan Ghising',
                'address' => 'Kathmandu, Nepal',
                'description' => 'I highly recommend Global Journey Consultancy because of their friendly and supportive team. The staff members are very welcoming and professional, making the entire visa and application process smooth and stress-free.
What I appreciate the most is how they assisted me throughout the processing time, ensuring that all my documents were correctly submitted and answering all my questions promptly. Their positive and helpful attitude made a big difference in my experience.',
                'rating' => 5,
                'status' => 1,
                'created_at' => '2025-10-14 14:24:41',
                'updated_at' => '2026-04-30 10:13:26',
            ),
            2 => 
            array (
                'id' => 13,
                'image' => 'C48ubbIUG9ofKf32vxXDAr5GuwKrVw6pACJvwMZD.webp',
                'image_alt' => 'Amrit Kc testimonial photo',
                'name' => 'Amrit Kc',
                'address' => 'Kathmandu, Nepal',
                'description' => 'I am very satisfied with the consultancy’s work. The team was knowledgeable, responsive, and results-driven. Their support added real value to our project.
Overall, the consultancy delivered excellent insights and actionable recommendations. Communication was clear, and the team showed great professionalism. A bit more focus on timelines would make the experience even. Thank you to the entire team for your support, special thanks to Janak Sir ( SUNDERLAND KING) and Yagya Sir for your guidance.',
                'rating' => 5,
                'status' => 1,
                'created_at' => '2025-10-14 16:53:39',
                'updated_at' => '2026-04-30 10:13:10',
            ),
            3 => 
            array (
                'id' => 15,
                'image' => 'aYRkBtCKAsv6xzjVHvZFa9oS5BB5QOX26GnhFa6Z.webp',
                'image_alt' => 'Vishma Acharya testimonial photo',
                'name' => 'Vishma Acharya',
                'address' => 'Kathmandu, Nepal',
                'description' => 'I am really grateful to whole Global Journey team for guiding me throughout my UK processing. Their support, transparency, and quick response made the whole journey smooth and stress-free. Highly recommended!',
                'rating' => 5,
                'status' => 1,
                'created_at' => '2025-10-14 17:07:37',
                'updated_at' => '2026-04-30 10:12:51',
            ),
        ));
        
        
    }
}