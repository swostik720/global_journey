<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CountryGuidesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('country_guides')->delete();
        
        \DB::table('country_guides')->insert(array (
            0 => 
            array (
                'id' => 1,
                'country_id' => 1,
            'guides' => '["Top universities: Harvard University, Massachusetts Institute of Technology (MIT), Stanford University, Yale University, Princeton University.", "Visa requirements: F1 Student Visa is required for full-time study. SEVIS fee must be paid before applying.", "Cost of living: $1,200–$1,800 per month depending on the city and lifestyle.", "Scholarships: Available for high-achieving students, specific programs, and international students. Check university websites for eligibility.", "Work while studying: On-campus jobs allowed up to 20 hours per week during term and full-time during breaks.", "Post-study opportunities: Optional Practical Training (OPT) allows graduates to work in the USA for 12–36 months depending on the program."]',
                'created_at' => '2025-10-08 09:14:05',
                'updated_at' => '2025-10-08 09:14:05',
            ),
            1 => 
            array (
                'id' => 2,
                'country_id' => 2,
            'guides' => '["Top universities: University of Melbourne, University of Sydney, Australian National University (ANU), University of Queensland.", "Visa requirements: Subclass 500 Student Visa is required for international students.", "Cost of living: AUD 1,200–1,800 per month depending on city.", "Scholarships: Offered by universities, government programs (e.g., Australia Awards), and private organizations.", "Work while studying: Up to 40 hours per fortnight during study periods, unlimited during official breaks.", "Post-study opportunities: Temporary Graduate Visa (subclass 485) allows graduates to work in Australia for 18 months to 4 years depending on qualification."]',
                'created_at' => '2025-10-08 09:14:05',
                'updated_at' => '2025-10-08 09:14:05',
            ),
            2 => 
            array (
                'id' => 3,
                'country_id' => 3,
            'guides' => '["Top universities: University of Toronto, University of British Columbia (UBC), McGill University, University of Alberta.", "Visa requirements: Study Permit required before arrival. Temporary Resident Visa (TRV) may also be required depending on nationality.", "Cost of living: $900–$1,500 per month depending on city.", "Scholarships: Offered by universities and government programs such as Vanier Canada Graduate Scholarships.", "Work while studying: Up to 20 hours per week during the semester, full-time during scheduled breaks.", "Post-study work: Post-Graduation Work Permit (PGWP) allows international graduates to work for 1–3 years in Canada."]',
                'created_at' => '2025-10-08 09:14:05',
                'updated_at' => '2025-10-08 09:14:05',
            ),
            3 => 
            array (
                'id' => 4,
                'country_id' => 4,
            'guides' => '["Top universities: University of Oxford, University of Cambridge, Imperial College London, University College London (UCL).", "Visa requirements: Student Visa (formerly Tier 4) required for full-time courses.", "Cost of living: £1,200–£1,800 per month depending on city and lifestyle.", "Scholarships: Chevening Scholarships, Commonwealth Scholarships, and university-specific funding.", "Work while studying: Part-time work allowed up to 20 hours per week during term, full-time during vacations.", "Post-study opportunities: Graduate visa allows staying in the UK for 2 years after completing an eligible course."]',
                'created_at' => '2025-10-08 09:14:05',
                'updated_at' => '2025-10-08 09:14:05',
            ),
            4 => 
            array (
                'id' => 5,
                'country_id' => 5,
                'guides' => '["Top universities: University of Auckland, University of Otago, Victoria University of Wellington, University of Canterbury.", "Visa requirements: Student Visa required for courses longer than 3 months.", "Cost of living: NZD 1,000–1,600 per month depending on city.", "Scholarships: Offered by universities and government programs, including New Zealand Scholarships for international students.", "Work while studying: Up to 20 hours per week during the term, full-time during holidays.", "Post-study opportunities: Post-study work visas allow graduates to work for 1–3 years depending on qualification."]',
                'created_at' => '2025-10-08 09:14:05',
                'updated_at' => '2025-10-08 09:14:05',
            ),
            5 => 
            array (
                'id' => 6,
                'country_id' => 6,
            'guides' => '["Top universities: University of Tokyo, Kyoto University, Osaka University, Waseda University, Ritsumeikan Asia Pacific University.","Visa requirements: Certificate of Eligibility (CoE) issued by Japanese immigration, followed by a Student Visa application at the Japanese Embassy.","Cost of living: JPY 90,000-140,000 per month depending on the city and lifestyle.","Scholarships: MEXT Scholarship, JASSO Scholarship, and university-specific tuition waivers for international students.","Work while studying: Up to 28 hours per week with a part-time work permit (Shikaku-gai Katsudo), full-time during long breaks.","Post-study opportunities: Specified Skilled Worker (SSW) and Engineer\\/Specialist in Humanities visas allow graduates to work in Japan long-term."]',
                'created_at' => '2026-08-13 15:56:07',
                'updated_at' => '2026-08-13 15:56:07',
            ),
        ));
        
        
    }
}