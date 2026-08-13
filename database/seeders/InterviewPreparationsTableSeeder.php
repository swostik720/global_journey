<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class InterviewPreparationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('interview_preparations')->delete();
        
        \DB::table('interview_preparations')->insert(array (
            0 => 
            array (
                'id' => 1,
                'title' => 'Interview Preparation for Australia',
                'slug' => 'australia',
                'description' => 'Interview preparation for Australia student visa.',
                'image' => '1761544304_7a44bcfc16deb6f115fbd35e4f5df1d9.jpg',
                'image_alt' => 'Interview Preparation for Australia interview preparation image',
                'status' => 1,
                'visa_conditions' => '["You must maintain enrollment in a registered course.", "You must meet satisfactory attendance and academic progress.", "You must have health insurance during your stay.", "You can only work limited hours while studying.", "You must comply with Australian visa regulations and reporting requirements."]',
                'interview_questions' => '[{"question":"What is your full name, date of birth, and passport number?","answer":null},{"question":"Please describe your complete academic background, including your courses, GPA, year of completion, college\\/university name, and location.","answer":null},{"question":"Have you previously applied for or held a visa for Australia or any other country?","answer":null},{"question":"Is the course you have applied for related to your previous studies?","answer":null},{"question":"Why did you choose to study in Australia instead of Nepal or other countries?","answer":null},{"question":"Which other countries did you research, and why did you not choose to study there?","answer":null},{"question":"Why did you select this particular university or college in Australia?","answer":null},{"question":"What is the name and duration of your chosen course?","answer":null},{"question":"What specialization options are available in this course, and which one do you plan to pursue?","answer":null},{"question":"What career opportunities are available after completing your course?","answer":null},{"question":"What specific skills and knowledge do you expect to gain from this program?","answer":null},{"question":"What are your short-term and long-term career goals after completing your studies?","answer":null},{"question":"What is the approximate travel cost per person to Australia in AUD?","answer":null},{"question":"Do you have any relatives or family in Australia?","answer":null},{"question":"Do you know if there are any rules and regulations for international students?","answer":null}]',
            'faqs' => '[{"question":"Can you work while studying in Australia?","answer":"Yes, international students can work part-time for up to 24 hours per week during study periods."},{"question":"Do I need health insurance in Australia?","answer":"Yes, you must have Overseas Student Health Cover (OSHC) for the entire duration of your stay."},{"question":"What documents are required for the interview?","answer":"You need your passport, acceptance letter, financial documents, and health insurance proof."},{"question":"Can I extend my visa if needed?","answer":"Yes, you can apply for a visa extension if your course duration changes."},{"question":"Is English proficiency required?","answer":"Yes, you need to demonstrate English proficiency through tests like IELTS or TOEFL."}]',
                'country_id' => 2,
                'created_at' => '2025-10-08 09:14:05',
                'updated_at' => '2025-10-29 11:20:13',
            ),
            1 => 
            array (
                'id' => 2,
                'title' => 'Interview Preparation for UK',
                'slug' => 'uk',
                'description' => 'Interview preparation for UK student visa.',
                'image' => '1761544344_c41bcbf9c717147c712086e1ead13700.jpg',
                'image_alt' => 'Interview Preparation for UK interview preparation image',
                'status' => 1,
                'visa_conditions' => '["You must attend your course regularly.", "You must not access public funds.", "You must register with the police if required.", "You must maintain sufficient funds to cover your tuition and living costs.", "You must comply with all UK visa conditions."]',
            'interview_questions' => '[{"question":"What is your Full name, DOB, and passport number?","answer":"My name is [Your Name], my date of birth is [Your DOB] and my passport number is [Your Passport No.]"},{"question":"Spell the name of your father and mother?","answer":"My father\\u2019s name is [FATHER\'S NAME]\\r\\nMy mother\\u2019s name is [MOTHER\'S NAME]"},{"question":"What is the date of Birth of your Father and Mother?","answer":"My father was born on [Date], and my mother was born on [Date]"},{"question":"Your place of Birth?","answer":"I was born in [Your Birth Place]"},{"question":"Your address as per Passport?","answer":"My address is Lakeside-06, Pokhara, Kaski, Nepal."},{"question":"How many members are financially dependent  on your parents?","answer":"There are three members ; my father, my mother, and me."},{"question":"Are you using any agent for your visa process?","answer":"Yes, I used a registered education consultancy to guide me through the process."},{"question":"How did your agent assist you with your visa application process?","answer":"My agent helped me with  document preparation, and visa application submission."},{"question":"What is the name of your counsellor?","answer":"My counsellor\\u2019s name is Ms. Roshni Adhikari from Global Journey Education, Kathmandu."},{"question":"Did you apply for your visa yourself?","answer":"Yes, I applied for my visa myself."},{"question":"What is your GWF number?","answer":"My GWF number is GWF123456789."},{"question":"Did you create your email account yourself?","answer":"Yes, I created and manage my email by myself."},{"question":"Do you have any prepared script for this interview?","answer":"No, I don\\u2019t have any script. I have prepared by understanding my course and university details."},{"question":"Do you have any friends or relatives in the UK?","answer":"No, I don\\u2019t have any friends or relatives in the UK. I\\u2019m the first person from my family going there."},{"question":"What course have you applied for, or what is the title of your program?","answer":"I have applied for MSc in Data Science at the University of Hertfordshire."},{"question":"What is the total tuition fee for your course? How much have you paid so far, and when did you make the payment?","answer":"The total tuition fee is \\u00a315,000 per year. I have already paid \\u00a36,000"},{"question":"Why did you choose to study this course?","answer":"Data Science is one of the most in-demand fields globally. It combines my interest in programming and analytics and offers excellent career prospects in Nepal and abroad."},{"question":"Is the course you have applied for related to your previous studies?","answer":null},{"question":"What are the modules included in your course?","answer":"My course includes:\\r\\nData Analytics and Visualization\\r\\nMachine Learning and Artificial Intelligence\\r\\nBig Data Management\\r\\nStatistical Methods\\r\\nResearch Methods and Dissertation"},{"question":"Can you explain two of your favorite course modules?","answer":"I like Machine Learning, where I can learn predictive algorithms and AI, and Data Visualization, which focuses on tools like Tableau and Power BI for presenting complex data."},{"question":"Which course module do you find most challenging, and why?","answer":"Big Data Management may be challenging because it involves handling large-scale data and cloud computing, but I\\u2019m ready to work hard."},{"question":"How will this course help you in your future career?","answer":"It will improve my analytical and technical skills, preparing me to work as a Data Analyst or Machine Learning Engineer in Nepal\\u2019s IT industry."},{"question":"What are your plans after graduation?","answer":"After completing my studies, I plan to return to Nepal and work in the IT or analytics field, possibly at Deerwalk, or CloudFactory."},{"question":"What is the scope of this course in your home country?","answer":"The scope of Data Science is huge , it\\u2019s used in banking, e-commerce, healthcare, and government sectors for decision-making and business insights."},{"question":"Have you booked accommodation in the UK?","answer":"No. I have researched about the accommodation from different website. I will booked my accommodation once my visa has been granted."},{"question":"Do you plan to work while studying in the UK?","answer":"No, my first priority will be studying."},{"question":"What is your marital status?","answer":"I am single."},{"question":"Are you planning to get married within the next 12 months?","answer":"No, I am focused on my studies at this moment."},{"question":"Are you sure you will not bring any dependents with you to the UK?","answer":"No. I am applying single."},{"question":"How did you research or find information about this university?","answer":"I searched through online website, and consulted with my counsellor."},{"question":"What is the teaching method used in your course?","answer":"The teaching includes lectures, seminars, lab sessions, and group projects."},{"question":"What is the assessment method for your course?","answer":"Assessment is done through assignments, presentations, group projects, and coursework."},{"question":"Since when have you been researching this university?","answer":"I started my research around August 2024 during my final semester of bachelor\\u2019s degree."},{"question":"How many days or hours per week will you have classes?","answer":"I will attend classes around 4\\u20135 days per week, about 12\\u201315 hours per week, with additional self-study time."},{"question":"Why did you choose to study in the UK? (Or: How will studying in the UK be beneficial for your future career?)","answer":"The UK offers high-quality education, globally recognized degrees, and a one-year master\\u2019s program. It also provides practical learning and international exposure, which is ideal for my career growth."},{"question":"Why not study in your home country? (Or: How is studying in the UK more beneficial compared to studying in your home country?)","answer":"In Nepal, Data Science is still an emerging field. The UK has advanced teaching facilities, research opportunities, and updated curriculum aligned with global industries."},{"question":"Why did you not choose other English-speaking countries for your studies?","answer":"The UK\\u2019s master\\u2019s degree duration is shorter (1 year) and more cost-effective compared to countries like the USA or Australia."},{"question":"Have you considered universities in other countries?","answer":"I briefly looked at universities in Australia and Canada, but I found that the UK offers a one-year master\\u2019s degree, globally recognized qualifications, and better post-study opportunities. It\\u2019s also more time-efficient and cost-effective for me."},{"question":"Why did you choose this particular university?","answer":"I chose the University of Hertfordshire because of its strong computing department, employability-focused teaching, and supportive international student services."},{"question":"Where is your university located?","answer":"It is located in Hatfield, Hertfordshire, around 25 minutes north of London."},{"question":"What is the official website of your university?","answer":"The official website is www.herts.ac.uk"},{"question":"What facilities are available at your university?","answer":"The university has modern computer labs, a large library, career counseling services, student societies, and on-campus accommodation."},{"question":"What motivated you to choose this course?","answer":"My passion for working with data, solving real-world problems, and building a career in analytics motivated me to study Data Science."},{"question":"What is the name of the company and position you plan to work for after returning to your home country?","answer":"I plan to work as a Data Analyst at ABC Pvt. Ltd. in Kathmandu."},{"question":"How will studying this course help you become a suitable candidate for that position?","answer":"The course will provide me with technical skills in data management, machine learning, and visualization tools that are directly relevant to the Data Analyst role."},{"question":"What have you been doing during your academic gap period (if any)?","answer":"After completing my bachelor\\u2019s in 2024, I did a 6-month internship at Leapfrog Technology as a Junior Data Analyst, where I worked on Python and Excel-based data reports."},{"question":"Have you considered applying to other universities?","answer":"Yes, I also considered University of Portsmouth and Teesside University, but Hertfordshire offered better ranking and location advantages."},{"question":"Why did you choose to study in this specific city? (Or: What do you know about the city where you will be studying?)","answer":"Hatfield is a safe, peaceful, and student-friendly city, with easy access to London for academic and professional networking."},{"question":"Who is sponsoring your education?","answer":"My parents are my financial sponsors."},{"question":"Have you taken an education loan?","answer":"Yes, I have taken an education loan from a Nepali bank."},{"question":"What is the loan amount, interest rate, EMI, and repayment period of your education loan?","answer":"The loan is of NPR 20 lakhs from Nabil Bank at 10% interest rate, with a 7-year repayment period after completing my degree."},{"question":"What are your travel (flying) plans? How will you travel from the airport to your university?","answer":"I plan to fly in January 2025. From Heathrow Airport, I will take the National Express coach directly to Hatfield."},{"question":"What is the average living cost in the UK?","answer":"As per UKVI guidelines, my living cost is around \\u00a31,023 per month, which covers accommodation, food, travel, and personal expenses."}]',
                'faqs' => '[{"question":"Can you work while studying in the UK?","answer":"Yes, students can work part-time during term and full-time during holidays."},{"question":"What is the minimum attendance required?","answer":"You must maintain satisfactory attendance as per your institution\\u2019s policy."},{"question":"Do I need a visa for an internship?","answer":"Yes, you must ensure your visa allows internships or work placements."},{"question":"How long does the visa process take?","answer":"It typically takes 3-6 weeks to get a student visa approved."},{"question":"Do I need health insurance?","answer":"Yes, you must pay the healthcare surcharge to access the NHS during your stay."}]',
                'country_id' => 4,
                'created_at' => '2025-10-08 09:14:05',
                'updated_at' => '2025-10-28 17:03:13',
            ),
            2 => 
            array (
                'id' => 3,
                'title' => 'Interview Preparation for USA',
                'slug' => 'usa',
                'description' => 'Interview preparation for USA student visa.',
                'image' => '1761544425_9bfc68e5abb7ce9bd1cb4af2543947ee.jpg',
                'image_alt' => 'Interview Preparation for USA interview preparation image',
                'status' => 1,
                'visa_conditions' => '["Maintain full-time enrollment.", "Do not work off-campus without authorization.", "Keep your address updated with your school.", "Maintain SEVIS registration.", "Comply with US visa regulations."]',
                'interview_questions' => '[{"question":"Why did you choose the USA for your studies?","answer":null},{"question":"Which university and course have you applied for?","answer":null},{"question":"How will you pay for your education?","answer":null},{"question":"Do you have relatives in the USA?","answer":null},{"question":"What are your plans after graduation?","answer":null}]',
                'faqs' => '[{"question":"Can you work while studying in the USA?","answer":"Yes, on-campus or with special authorization."},{"question":"What is SEVIS?","answer":"SEVIS tracks students and exchange visitors in the USA."},{"question":"Do I need health insurance?","answer":"Yes, all international students must have health insurance."},{"question":"What documents are required for the visa interview?","answer":"Passport, I-20, financial proof, acceptance letter."},{"question":"Can I extend my visa?","answer":"Yes, by applying for an extension before it expires."}]',
                'country_id' => 1,
                'created_at' => '2025-10-08 09:14:05',
                'updated_at' => '2025-10-29 11:22:02',
            ),
            3 => 
            array (
                'id' => 4,
                'title' => 'Interview Preparation for Canada',
                'slug' => 'canada',
                'description' => 'Interview preparation for Canada student visa.',
                'image' => '1761544475_434b8d0e7e7c239f3389549c5b2d23fa.jpg',
                'image_alt' => 'Interview Preparation for Canada interview preparation image',
                'status' => 1,
                'visa_conditions' => '["Remain enrolled at a designated learning institution.", "Make progress towards program completion.", "Respect study permit conditions.", "Have sufficient financial support.", "Comply with Canadian immigration rules."]',
                'interview_questions' => '[{"question":"Why did you choose Canada for your studies?","answer":"Canada offers quality education and a welcoming environment."},{"question":"Which college\\/university and program have you applied for?","answer":"University of Toronto, Bachelor of Computer Science."},{"question":"How will you support yourself financially?","answer":"Through family support and scholarships."},{"question":"Do you have any relatives in Canada?","answer":"No relatives in Canada."},{"question":"What are your plans after graduation?","answer":"Work in Canada or return home with experience."}]',
                'faqs' => '[{"question":"Can you work while studying in Canada?","answer":"Yes, up to 20 hours\\/week during sessions."},{"question":"What is a designated learning institution?","answer":"A school approved to host international students."},{"question":"Do I need health insurance?","answer":"Yes, mandatory for the entire study period."},{"question":"How long can I stay after graduation?","answer":"You may apply for a post-graduation work permit."},{"question":"What documents are required for the interview?","answer":"Passport, acceptance letter, financial proof, insurance documents."}]',
                'country_id' => 3,
                'created_at' => '2025-10-08 09:14:05',
                'updated_at' => '2025-10-27 11:39:35',
            ),
            4 => 
            array (
                'id' => 5,
                'title' => 'Interview Preparation for New Zealand',
                'slug' => 'new-zealand',
                'description' => 'Interview preparation for New Zealand student visa.',
                'image' => '1761544572_d06778c66b5a87d497d7df6cb4987e5d.jpg',
                'image_alt' => 'Interview Preparation for New Zealand interview preparation image',
                'status' => 1,
                'visa_conditions' => '["Attend course regularly.", "Make satisfactory progress.", "Have appropriate insurance.", "Do not work more than allowed by visa.", "Comply with New Zealand immigration rules."]',
                'interview_questions' => '[{"question":"Why did you choose New Zealand for your studies?","answer":"Safe environment and quality education."},{"question":"Which institution and course have you applied for?","answer":"University of Auckland, Bachelor of Computer Science."},{"question":"How will you pay for your studies?","answer":"Family support and part-time work."},{"question":"Do you have relatives in New Zealand?","answer":"No relatives."},{"question":"What are your plans after graduation?","answer":"Gain experience and return home."}]',
                'faqs' => '[{"question":"Can you work while studying?","answer":"Yes, up to 20 hours\\/week during term."},{"question":"Do you need insurance?","answer":"Yes, mandatory for your stay."},{"question":"What documents are needed?","answer":"Passport, acceptance letter, financial proof, insurance."},{"question":"Can I extend my student visa?","answer":"Yes, before it expires."},{"question":"Are part-time jobs allowed?","answer":"Yes, within visa limits."}]',
                'country_id' => 5,
                'created_at' => '2025-10-08 09:14:05',
                'updated_at' => '2025-10-27 11:41:12',
            ),
            5 => 
            array (
                'id' => 6,
                'title' => 'Interview Preparation for Japan',
                'slug' => 'japan',
                'description' => 'Interview preparation for Japan student visa.',
                'image' => NULL,
                'image_alt' => NULL,
                'status' => 1,
            'visa_conditions' => '["You must maintain enrollment in your Japanese language school or university.","You must maintain satisfactory attendance and academic progress.","You can only work part-time up to 28 hours per week with proper permission (Shikaku-gai Katsudo).","You must have proof of sufficient funds or a financial guarantor for your stay.","You must comply with Japanese immigration and residence card regulations."]',
                'interview_questions' => '[{"question":"What is your full name, date of birth, and passport number?","answer":null},{"question":"Please describe your complete academic background, including your courses, GPA, and institutions attended.","answer":null},{"question":"Why did you choose to study in Japan instead of Nepal or other countries?","answer":null},{"question":"Why did you select this particular university or language school in Japan?","answer":null},{"question":"What is the name and duration of your chosen course?","answer":null},{"question":"Do you have any knowledge of the Japanese language? What is your JLPT level?","answer":null},{"question":"What career opportunities are available after completing your course?","answer":null},{"question":"Who is sponsoring your education, and what is your financial plan?","answer":null},{"question":"Do you have any relatives or acquaintances in Japan?","answer":null},{"question":"What are your plans after completing your studies in Japan?","answer":null}]',
            'faqs' => '[{"question":"Can you work while studying in Japan?","answer":"Yes, international students can work up to 28 hours per week with a part-time work permit (Shikaku-gai Katsudo)."},{"question":"What is a Certificate of Eligibility (CoE)?","answer":"A CoE is issued by Japanese immigration confirming you meet the requirements to study in Japan; it is required before applying for your student visa."},{"question":"Do I need to know Japanese to study in Japan?","answer":"Not always. Many language schools accept beginners, though JLPT N5 or higher is recommended, and some university programs require higher levels."},{"question":"What documents are required for the interview?","answer":"Passport, Certificate of Eligibility, acceptance letter, and financial or guarantor documents."},{"question":"How long does the Japan student visa process take?","answer":"Typically 1 to 3 months after the Certificate of Eligibility is issued."}]',
                'country_id' => 6,
                'created_at' => '2026-08-13 15:56:07',
                'updated_at' => '2026-08-13 15:56:07',
            ),
        ));
        
        
    }
}