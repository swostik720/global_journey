<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FaqsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('faqs')->delete();
        
        \DB::table('faqs')->insert(array (
            0 => 
            array (
                'id' => 1,
                'question' => 'How can I apply to colleges?',
                'answer' => 'You can browse colleges, shortlist your preferred institutions, prepare required documents, and submit applications through official portals with counselor guidances.',
                'status' => 1,
                'sort_order' => 1,
                'created_at' => '2026-05-03 15:44:07',
                'updated_at' => '2026-05-03 15:47:21',
            ),
            1 => 
            array (
                'id' => 2,
                'question' => 'Is this platform free to use?',
                'answer' => 'Yes, browsing destinations, programs, and guidance content is free. Consultation and application support services are shared clearly before any paid step.',
                'status' => 1,
                'sort_order' => 2,
                'created_at' => '2026-05-03 15:44:07',
                'updated_at' => '2026-05-03 15:44:07',
            ),
            2 => 
            array (
                'id' => 3,
                'question' => 'Which countries do you support for study abroad?',
                'answer' => 'We support multiple destinations including Australia, Canada, the UK, the USA, and more. Counselors help you choose the best fit based on budget, goals, and profile.',
                'status' => 1,
                'sort_order' => 3,
                'created_at' => '2026-05-03 15:44:07',
                'updated_at' => '2026-05-03 15:44:07',
            ),
            3 => 
            array (
                'id' => 4,
                'question' => 'Do you help with visa interview preparation?',
                'answer' => 'Yes. We provide personalized visa interview preparation, mock sessions, and document review to improve confidence and response quality.',
                'status' => 1,
                'sort_order' => 4,
                'created_at' => '2026-05-03 15:44:07',
                'updated_at' => '2026-05-03 15:44:07',
            ),
            4 => 
            array (
                'id' => 5,
                'question' => 'How long does the admission process usually take?',
                'answer' => 'Timelines vary by country and intake, but most applications take a few weeks to a few months from profile review to final offer and visa documentation.',
                'status' => 1,
                'sort_order' => 5,
                'created_at' => '2026-05-03 15:44:07',
                'updated_at' => '2026-05-03 15:44:07',
            ),
            5 => 
            array (
                'id' => 6,
                'question' => 'Can I get one-on-one counseling before applying?',
                'answer' => 'Absolutely. You can book a one-on-one counseling session to discuss program selection, financial planning, documentation, and application strategy.',
                'status' => 1,
                'sort_order' => 6,
                'created_at' => '2026-05-03 15:44:07',
                'updated_at' => '2026-05-03 15:44:07',
            ),
        ));
        
        
    }
}