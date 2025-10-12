<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\InterviewPreparation;

class InterviewPreparationTableSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'title' => 'Interview Preparation for Australia',
                'slug' => 'australia',
                'description' => 'Interview preparation for Australia student visa.',
                'image' => 'interview_aus.png',
                'status' => true,
                'country_id' => 2,
                'visa_conditions' => [
                    'You must maintain enrollment in a registered course.',
                    'You must meet satisfactory attendance and academic progress.',
                    'You must have health insurance during your stay.',
                    'You can only work limited hours while studying.',
                    'You must comply with Australian visa regulations and reporting requirements.'
                ],
                'interview_questions' => [
                    [
                        'question' => 'Why did you choose Australia for your studies?',
                        'answer' => 'Because Australia has world-class universities and a multicultural environment.'
                    ],
                    [
                        'question' => 'Which university and course have you applied for?',
                        'answer' => 'I applied for the University of Melbourne, Bachelor of Computer Science.'
                    ],
                    [
                        'question' => 'Who will be financing your studies?',
                        'answer' => 'My parents will finance my tuition and living expenses.'
                    ],
                    [
                        'question' => 'Do you have relatives in Australia?',
                        'answer' => 'No, I do not have any relatives in Australia.'
                    ],
                    [
                        'question' => 'What are your plans after graduation?',
                        'answer' => 'I plan to gain work experience and then return to my home country to build my career.'
                    ]
                ],
                'faqs' => [
                    [
                        'question' => 'Can you work while studying in Australia?',
                        'answer' => 'Yes, international students can work part-time for up to 24 hours per week during study periods.'
                    ],
                    [
                        'question' => 'Do I need health insurance in Australia?',
                        'answer' => 'Yes, you must have Overseas Student Health Cover (OSHC) for the entire duration of your stay.'
                    ],
                    [
                        'question' => 'What documents are required for the interview?',
                        'answer' => 'You need your passport, acceptance letter, financial documents, and health insurance proof.'
                    ],
                    [
                        'question' => 'Can I extend my visa if needed?',
                        'answer' => 'Yes, you can apply for a visa extension if your course duration changes.'
                    ],
                    [
                        'question' => 'Is English proficiency required?',
                        'answer' => 'Yes, you need to demonstrate English proficiency through tests like IELTS or TOEFL.'
                    ]
                ]
            ],
            [
                'title' => 'Interview Preparation for UK',
                'slug' => 'uk',
                'description' => 'Interview preparation for UK student visa.',
                'image' => 'interview_uk.jpg',
                'status' => true,
                'country_id' => 4,
                'visa_conditions' => [
                    'You must attend your course regularly.',
                    'You must not access public funds.',
                    'You must register with the police if required.',
                    'You must maintain sufficient funds to cover your tuition and living costs.',
                    'You must comply with all UK visa conditions.'
                ],
                'interview_questions' => [
                    [
                        'question' => 'Why did you choose the UK for your studies?',
                        'answer' => 'The UK offers world-class education and recognized qualifications.'
                    ],
                    [
                        'question' => 'Which university and course have you applied for?',
                        'answer' => 'I applied for the University of Oxford, MSc in Computer Science.'
                    ],
                    [
                        'question' => 'How will you fund your studies?',
                        'answer' => 'My parents will cover tuition and living expenses.'
                    ],
                    [
                        'question' => 'Do you have any relatives in the UK?',
                        'answer' => 'No, I do not have relatives in the UK.'
                    ],
                    [
                        'question' => 'What are your plans after graduation?',
                        'answer' => 'I plan to work in the tech industry in the UK or return home with valuable experience.'
                    ]
                ],
                'faqs' => [
                    [
                        'question' => 'Can you work while studying in the UK?',
                        'answer' => 'Yes, students can work part-time during term and full-time during holidays.'
                    ],
                    [
                        'question' => 'What is the minimum attendance required?',
                        'answer' => 'You must maintain satisfactory attendance as per your institution’s policy.'
                    ],
                    [
                        'question' => 'Do I need a visa for an internship?',
                        'answer' => 'Yes, you must ensure your visa allows internships or work placements.'
                    ],
                    [
                        'question' => 'How long does the visa process take?',
                        'answer' => 'It typically takes 3-6 weeks to get a student visa approved.'
                    ],
                    [
                        'question' => 'Do I need health insurance?',
                        'answer' => 'Yes, you must pay the healthcare surcharge to access the NHS during your stay.'
                    ]
                ]
            ],
            // Similarly for USA, Canada, New Zealand with 5 visa conditions, 5 interview questions, and 5 FAQs
            [
                'title' => 'Interview Preparation for USA',
                'slug' => 'usa',
                'description' => 'Interview preparation for USA student visa.',
                'image' => 'interview_usa.jpeg',
                'status' => true,
                'country_id' => 1,
                'visa_conditions' => [
                    'Maintain full-time enrollment.',
                    'Do not work off-campus without authorization.',
                    'Keep your address updated with your school.',
                    'Maintain SEVIS registration.',
                    'Comply with US visa regulations.'
                ],
                'interview_questions' => [
                    ['question'=>'Why did you choose the USA for your studies?','answer'=>'Because USA has top-ranked universities and diverse learning opportunities.'],
                    ['question'=>'Which university and course have you applied for?','answer'=>'I applied for MIT, Bachelor of Computer Science.'],
                    ['question'=>'How will you pay for your education?','answer'=>'My parents and a scholarship will fund my education.'],
                    ['question'=>'Do you have relatives in the USA?','answer'=>'No, I do not have relatives in the USA.'],
                    ['question'=>'What are your plans after graduation?','answer'=>'I plan to gain work experience and then return to my country.']
                ],
                'faqs' => [
                    ['question'=>'Can you work while studying in the USA?','answer'=>'Yes, on-campus or with special authorization.'],
                    ['question'=>'What is SEVIS?','answer'=>'SEVIS tracks students and exchange visitors in the USA.'],
                    ['question'=>'Do I need health insurance?','answer'=>'Yes, all international students must have health insurance.'],
                    ['question'=>'What documents are required for the visa interview?','answer'=>'Passport, I-20, financial proof, acceptance letter.'],
                    ['question'=>'Can I extend my visa?','answer'=>'Yes, by applying for an extension before it expires.']
                ]
            ],
            [
                'title' => 'Interview Preparation for Canada',
                'slug' => 'canada',
                'description' => 'Interview preparation for Canada student visa.',
                'image' => 'interview_canada.jpeg',
                'status' => true,
                'country_id' => 3,
                'visa_conditions' => [
                    'Remain enrolled at a designated learning institution.',
                    'Make progress towards program completion.',
                    'Respect study permit conditions.',
                    'Have sufficient financial support.',
                    'Comply with Canadian immigration rules.'
                ],
                'interview_questions' => [
                    ['question'=>'Why did you choose Canada for your studies?','answer'=>'Canada offers quality education and a welcoming environment.'],
                    ['question'=>'Which college/university and program have you applied for?','answer'=>'University of Toronto, Bachelor of Computer Science.'],
                    ['question'=>'How will you support yourself financially?','answer'=>'Through family support and scholarships.'],
                    ['question'=>'Do you have any relatives in Canada?','answer'=>'No relatives in Canada.'],
                    ['question'=>'What are your plans after graduation?','answer'=>'Work in Canada or return home with experience.']
                ],
                'faqs' => [
                    ['question'=>'Can you work while studying in Canada?','answer'=>'Yes, up to 20 hours/week during sessions.'],
                    ['question'=>'What is a designated learning institution?','answer'=>'A school approved to host international students.'],
                    ['question'=>'Do I need health insurance?','answer'=>'Yes, mandatory for the entire study period.'],
                    ['question'=>'How long can I stay after graduation?','answer'=>'You may apply for a post-graduation work permit.'],
                    ['question'=>'What documents are required for the interview?','answer'=>'Passport, acceptance letter, financial proof, insurance documents.']
                ]
            ],
            [
                'title' => 'Interview Preparation for New Zealand',
                'slug' => 'new-zealand',
                'description' => 'Interview preparation for New Zealand student visa.',
                'image' => 'interview_nz.jpeg',
                'status' => true,
                'country_id' => 5,
                'visa_conditions' => [
                    'Attend course regularly.',
                    'Make satisfactory progress.',
                    'Have appropriate insurance.',
                    'Do not work more than allowed by visa.',
                    'Comply with New Zealand immigration rules.'
                ],
                'interview_questions' => [
                    ['question'=>'Why did you choose New Zealand for your studies?','answer'=>'Safe environment and quality education.'],
                    ['question'=>'Which institution and course have you applied for?','answer'=>'University of Auckland, Bachelor of Computer Science.'],
                    ['question'=>'How will you pay for your studies?','answer'=>'Family support and part-time work.'],
                    ['question'=>'Do you have relatives in New Zealand?','answer'=>'No relatives.'],
                    ['question'=>'What are your plans after graduation?','answer'=>'Gain experience and return home.']
                ],
                'faqs' => [
                    ['question'=>'Can you work while studying?','answer'=>'Yes, up to 20 hours/week during term.'],
                    ['question'=>'Do you need insurance?','answer'=>'Yes, mandatory for your stay.'],
                    ['question'=>'What documents are needed?','answer'=>'Passport, acceptance letter, financial proof, insurance.'],
                    ['question'=>'Can I extend my student visa?','answer'=>'Yes, before it expires.'],
                    ['question'=>'Are part-time jobs allowed?','answer'=>'Yes, within visa limits.']
                ]
            ]
        ];

        foreach ($data as $item) {
            InterviewPreparation::create($item);
        }
    }
}
