<?php

namespace Database\Seeders;

use App\Models\CollegeAndUniversity;
use App\Models\Country;
use App\Models\CountryGuide;
use App\Models\DocumentChecklist;
use App\Models\InterviewPreparation;
use App\Models\WhyCountry;
use Illuminate\Database\Seeder;
use RuntimeException;

/**
 * Adds the Japan reference content that is not part of the raw SQL
 * production dump (Interview Preparation, Why Country, Country Guide,
 * Colleges & Universities, Document Checklist).
 *
 * Unlike the *TableSeeder classes (which delete() then reinsert every row
 * in the table), this seeder is additive-only: it uses updateOrCreate()
 * keyed on natural identifiers, so it never touches any other country's
 * rows. Safe to run against a live production database.
 *
 * It does NOT touch the `countries`, `study_abroads`, `blogs`, or `teams`
 * tables — those already have real Japan content in the SQL dump/staging
 * database and are left alone here.
 */
class JapanContentSeeder extends Seeder
{
    public function run(): void
    {
        $japan = Country::where('name', 'Japan')->first();

        if (!$japan) {
            throw new RuntimeException(
                'Country "Japan" was not found. Run the countries import/seeder first.'
            );
        }

        $this->seedInterviewPreparation($japan->id);
        $this->seedWhyCountry($japan->id);
        $this->seedCountryGuide($japan->id);
        $this->seedColleges($japan->id);
        $this->seedDocumentChecklist($japan->id);
    }

    private function seedInterviewPreparation(int $countryId): void
    {
        $visaConditions = [
            'You must maintain enrollment in your Japanese language school or university.',
            'You must maintain satisfactory attendance and academic progress.',
            'You can only work part-time up to 28 hours per week with proper permission (Shikaku-gai Katsudo).',
            'You must have proof of sufficient funds or a financial guarantor for your stay.',
            'You must comply with Japanese immigration and residence card regulations.',
        ];

        $interviewQuestions = [
            ['question' => 'What is your full name, date of birth, and passport number?', 'answer' => null],
            ['question' => 'Please describe your complete academic background, including your courses, GPA, and institutions attended.', 'answer' => null],
            ['question' => 'Why did you choose to study in Japan instead of Nepal or other countries?', 'answer' => null],
            ['question' => 'Why did you select this particular university or language school in Japan?', 'answer' => null],
            ['question' => 'What is the name and duration of your chosen course?', 'answer' => null],
            ['question' => 'Do you have any knowledge of the Japanese language? What is your JLPT level?', 'answer' => null],
            ['question' => 'What career opportunities are available after completing your course?', 'answer' => null],
            ['question' => 'Who is sponsoring your education, and what is your financial plan?', 'answer' => null],
            ['question' => 'Do you have any relatives or acquaintances in Japan?', 'answer' => null],
            ['question' => 'What are your plans after completing your studies in Japan?', 'answer' => null],
        ];

        $faqs = [
            ['question' => 'Can you work while studying in Japan?', 'answer' => 'Yes, international students can work up to 28 hours per week with a part-time work permit (Shikaku-gai Katsudo).'],
            ['question' => 'What is a Certificate of Eligibility (CoE)?', 'answer' => 'A CoE is issued by Japanese immigration confirming you meet the requirements to study in Japan; it is required before applying for your student visa.'],
            ['question' => 'Do I need to know Japanese to study in Japan?', 'answer' => 'Not always. Many language schools accept beginners, though JLPT N5 or higher is recommended, and some university programs require higher levels.'],
            ['question' => 'What documents are required for the interview?', 'answer' => 'Passport, Certificate of Eligibility, acceptance letter, and financial or guarantor documents.'],
            ['question' => 'How long does the Japan student visa process take?', 'answer' => 'Typically 1 to 3 months after the Certificate of Eligibility is issued.'],
        ];

        InterviewPreparation::updateOrCreate(
            ['slug' => 'japan'],
            [
                'title' => 'Interview Preparation for Japan',
                'description' => 'Interview preparation for Japan student visa.',
                'status' => 1,
                'visa_conditions' => $visaConditions,
                'interview_questions' => $interviewQuestions,
                'faqs' => $faqs,
                'country_id' => $countryId,
            ]
        );
    }

    private function seedWhyCountry(int $countryId): void
    {
        WhyCountry::updateOrCreate(
            ['country_id' => $countryId],
            [
                'description' => [
                    'World-class education in technology, engineering, and business with globally respected universities.',
                    'Affordable tuition fees and living costs compared to the UK, USA, and Australia.',
                    'MEXT and university scholarships that significantly reduce financial burden for international students.',
                    'Safe, disciplined, and welcoming society with one of the lowest crime rates in the world.',
                    'Strong part-time work opportunities and a growing demand for skilled foreign workers after graduation.',
                    'Rich culture, modern infrastructure, and easy access to the rest of Asia.',
                ],
            ]
        );
    }

    private function seedCountryGuide(int $countryId): void
    {
        CountryGuide::updateOrCreate(
            ['country_id' => $countryId],
            [
                'guides' => [
                    'Top universities: University of Tokyo, Kyoto University, Osaka University, Waseda University, Ritsumeikan Asia Pacific University.',
                    'Visa requirements: Certificate of Eligibility (CoE) issued by Japanese immigration, followed by a Student Visa application at the Japanese Embassy.',
                    'Cost of living: JPY 90,000-140,000 per month depending on the city and lifestyle.',
                    'Scholarships: MEXT Scholarship, JASSO Scholarship, and university-specific tuition waivers for international students.',
                    'Work while studying: Up to 28 hours per week with a part-time work permit (Shikaku-gai Katsudo), full-time during long breaks.',
                    'Post-study opportunities: Specified Skilled Worker (SSW) and Engineer/Specialist in Humanities visas allow graduates to work in Japan long-term.',
                ],
            ]
        );
    }

    private function seedColleges(int $countryId): void
    {
        $universities = [
            ['name' => 'University of Tokyo', 'description' => "Japan's top-ranked national university, located in Bunkyo, Tokyo", 'link' => 'https://www.u-tokyo.ac.jp/en/'],
            ['name' => 'Kyoto University', 'description' => "One of Japan's most prestigious research universities, located in Kyoto", 'link' => 'https://www.kyoto-u.ac.jp/en'],
            ['name' => 'Osaka University', 'description' => 'A leading national university known for engineering and medicine, located in Osaka', 'link' => 'https://www.osaka-u.ac.jp/en'],
            ['name' => 'Waseda University', 'description' => "One of Japan's most respected private universities, located in Shinjuku, Tokyo", 'link' => 'https://www.waseda.jp/top/en'],
            ['name' => 'Ritsumeikan Asia Pacific University', 'description' => 'A highly international campus located in Beppu, Oita', 'link' => 'https://en.apu.ac.jp/home/'],
            ['name' => 'Tokyo University of Science', 'description' => 'A leading science and engineering university located in Tokyo', 'link' => 'https://www.tus.ac.jp/en/'],
        ];

        foreach ($universities as $uni) {
            CollegeAndUniversity::updateOrCreate(
                ['country_id' => $countryId, 'name' => $uni['name']],
                [
                    'description' => $uni['description'],
                    'link' => $uni['link'],
                ]
            );
        }
    }

    private function seedDocumentChecklist(int $countryId): void
    {
        // Reuse the shared Nepal financial-document template already used
        // for the other countries so it matches the rest of the system.
        $templateRow = DocumentChecklist::whereHas('country', function ($q) {
            $q->where('name', 'Australia');
        })->first();

        if (!$templateRow) {
            throw new RuntimeException('Could not find an existing document checklist template to reuse for Japan.');
        }

        DocumentChecklist::updateOrCreate(
            ['country_id' => $countryId],
            [
                'documents' => $templateRow->documents,
                'pdf_path' => 'frontend/assets/pdf/japan_document_checklist.pdf',
            ]
        );
    }
}
