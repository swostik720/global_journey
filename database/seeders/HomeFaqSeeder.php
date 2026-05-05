<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class HomeFaqSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [
            [
                'question' => 'How can I apply to colleges?',
                'answer' => 'You can browse colleges, shortlist your preferred institutions, prepare required documents, and submit applications through official portals with counselor guidance.',
                'sort_order' => 1,
                'status' => 1,
            ],
            [
                'question' => 'Is this platform free to use?',
                'answer' => 'Yes, browsing destinations, programs, and guidance content is free. Consultation and application support services are shared clearly before any paid step.',
                'sort_order' => 2,
                'status' => 1,
            ],
            [
                'question' => 'Which countries do you support for study abroad?',
                'answer' => 'We support multiple destinations including Australia, Canada, the UK, the USA, and more. Counselors help you choose the best fit based on budget, goals, and profile.',
                'sort_order' => 3,
                'status' => 1,
            ],
            [
                'question' => 'Do you help with visa interview preparation?',
                'answer' => 'Yes. We provide personalized visa interview preparation, mock sessions, and document review to improve confidence and response quality.',
                'sort_order' => 4,
                'status' => 1,
            ],
            [
                'question' => 'How long does the admission process usually take?',
                'answer' => 'Timelines vary by country and intake, but most applications take a few weeks to a few months from profile review to final offer and visa documentation.',
                'sort_order' => 5,
                'status' => 1,
            ],
            [
                'question' => 'Can I get one-on-one counseling before applying?',
                'answer' => 'Absolutely. You can book a one-on-one counseling session to discuss program selection, financial planning, documentation, and application strategy.',
                'sort_order' => 6,
                'status' => 1,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::updateOrCreate(
                ['question' => $faq['question']],
                $faq
            );
        }
    }
}
