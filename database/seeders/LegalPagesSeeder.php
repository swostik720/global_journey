<?php

namespace Database\Seeders;

use App\Models\LegalPage;
use Illuminate\Database\Seeder;

class LegalPagesSeeder extends Seeder
{
    public function run(): void
    {
        $termsHtml = <<<'HTML'
<section>
    <h3>1) Acceptance of Terms</h3>
    <p>By accessing or using globaljourney.edu.np (the "Website") or engaging with Global Journey Education Services ("Global Journey", "we", "our", "us"), you agree to be bound by these Terms and Conditions. If you do not agree, please discontinue use of our Website and services.</p>

    <h3>2) About Our Services</h3>
    <p>Global Journey provides study-abroad counseling services, including program selection, admissions guidance, documentation support, interview preparation, visa guidance, and pre-departure assistance. Global Journey is not a visa-granting authority or an immigration agent. Decisions on admissions and visas are solely made by the respective institutions and government authorities.</p>

    <h3>3) Eligibility</h3>
    <p>To use our services, you must be at least 16 years old or use our services under the supervision and consent of a parent or legal guardian.</p>

    <h3>4) Use of Website Content</h3>
    <p>All content on globaljourney.edu.np, including text, graphics, logos, layout, articles, blog posts, images, and videos, is the intellectual property of Global Journey or its content providers. Unauthorized reproduction, distribution, modification, or commercial use is strictly prohibited without written permission.</p>
    <ul>
        <li>You may view, download, or print content for personal and non-commercial use only.</li>
        <li>You may not copy or republish any content for public or commercial purposes without permission.</li>
    </ul>

    <h3>5) Accuracy of Information</h3>
    <p>We strive to provide accurate and updated information related to countries, programs, requirements, and processes. However:</p>
    <ul>
        <li>Study-abroad rules, visa regulations, and institutional requirements can change without notice.</li>
        <li>Global Journey does not guarantee the accuracy, completeness, or timeliness of external information.</li>
        <li>Users are encouraged to verify critical information directly with institutions or official government sources.</li>
    </ul>

    <h3>6) Counseling and Advisory Limitations</h3>
    <p>Our recommendations are based on your academic profile, financial background, goals, and available opportunities. By using our services, you acknowledge and agree that:</p>
    <ul>
        <li>Global Journey does not guarantee admission to any institution.</li>
        <li>Global Journey does not guarantee visa approval.</li>
        <li>Outcomes depend on multiple factors beyond our control, including government policies, institutional decisions, and your submitted documents.</li>
    </ul>

    <h3>7) User Responsibilities</h3>
    <p>You agree to:</p>
    <ul>
        <li>Provide accurate, truthful, and complete information for counseling or applications.</li>
        <li>Ensure all documents submitted are genuine and legally obtained.</li>
        <li>Follow instructions and timelines provided by Global Journey for application processing.</li>
        <li>Use the Website in accordance with applicable laws and not engage in misuse, fraud, or abuse of services.</li>
    </ul>

    <h3>8) Fees, Payments and Refunds</h3>
    <p>Global Journey may charge service fees for counseling, application processing, documentation support, or events. Specific fees vary by selected services.</p>
    <ul>
        <li>All fees will be communicated transparently before service initiation.</li>
        <li>Payments made for completed or ongoing services are non-refundable.</li>
        <li>Refunds (if any) are provided only under written agreements or exceptional cases reviewed by management.</li>
    </ul>

    <h3>9) Third-Party Services and Links</h3>
    <p>Our Website may contain links to external websites, partner institutions, scholarship portals, or government resources for convenience.</p>
    <ul>
        <li>We do not endorse or control third-party sites.</li>
        <li>Your use of third-party websites is governed by their respective terms and policies.</li>
        <li>We are not responsible for content, accuracy, or availability of third-party resources.</li>
    </ul>

    <h3>10) Communications and Consent</h3>
    <p>By contacting us through web forms, phone, WhatsApp, email, or social media channels listed on our site, you consent to receive replies, updates, and essential service-related communication. Marketing communication will be sent only with your explicit consent.</p>

    <h3>11) Privacy and Data Protection</h3>
    <p>Your data is handled according to our Privacy Policy. By using our Website or submitting information, you acknowledge that you have reviewed and agreed to our Privacy Policy.</p>

    <h3>12) Limitation of Liability</h3>
    <p>To the maximum extent permitted by law, Global Journey shall not be liable for:</p>
    <ul>
        <li>Losses arising from decisions made based on our counseling.</li>
        <li>Delays or rejections by educational institutions, test bodies, or visa authorities.</li>
        <li>Issues arising due to incorrect, incomplete, or fraudulent information provided by users.</li>
        <li>Technical issues, interruptions, or downtime of the Website.</li>
    </ul>
    <p>In no event shall Global Journey be liable for indirect, incidental, punitive, exemplary, or consequential damages.</p>

    <h3>13) Indemnification</h3>
    <p>You agree to indemnify and hold harmless Global Journey, its employees, counselors, directors, and partners from any claims, liabilities, damage, losses, or expenses arising from:</p>
    <ul>
        <li>Your breach of these Terms and Conditions.</li>
        <li>Your misuse of our Website or services.</li>
        <li>Submission of false or misleading information.</li>
    </ul>

    <h3>14) Intellectual Property Rights</h3>
    <p>The Global Journey name, logo, graphics, service descriptions, and digital assets are protected trademarks or intellectual property of Global Journey Education Services. Misuse or unauthorized reproduction is strictly prohibited.</p>

    <h3>15) Termination of Services</h3>
    <p>Global Journey reserves the right to terminate or refuse service to any user who provides fraudulent or misleading information, abuses staff, engages in illegal or unethical activities, or violates these Terms and Conditions.</p>

    <h3>16) Changes to Terms</h3>
    <p>We may update these Terms and Conditions periodically. The "Last updated" date indicates the latest revision. Continued use of the Website or our services after changes constitutes acceptance of updated Terms.</p>

    <h3>17) Governing Law</h3>
    <p>These Terms and Conditions are governed by the laws of Nepal. Any disputes shall be subject to the exclusive jurisdiction of the courts of Kathmandu, Nepal.</p>

    <h3>18) Contact Information</h3>
    <p>If you have questions regarding these Terms and Conditions, contact us at: <strong>info@globaljourney.edu.np</strong></p>
</section>
HTML;

        $privacyHtml = <<<'HTML'
<section>
    <h3>1) Who we are</h3>
    <p>Global Journey Education Services ("Global Journey", "we", "our", "us") provides study-abroad counseling and related services, including program shortlisting, application guidance, events, and pre-departure support. This Privacy Policy explains how we handle personal information collected through our website and channels listed on it.</p>

    <h3>2) Scope of this policy</h3>
    <p>This policy applies when you visit or interact with globaljourney.edu.np, submit website forms, communicate with us via phone/email/WhatsApp/social channels, or receive service updates and permitted marketing communications.</p>

    <h3>3) What personal data we collect</h3>
    <ul>
        <li><strong>Information you provide directly:</strong> name, email, phone/WhatsApp, preferred branch, preferred destination, and message details.</li>
        <li><strong>Counseling context:</strong> academic history, intended intake, test scores, budget notes, and information required to assess your case.</li>
        <li><strong>Communication data:</strong> contact details, message content, and channel metadata required to respond.</li>
        <li><strong>Automatically collected data:</strong> IP, browser/device details, pages viewed, referrer/UTM parameters, and coarse location.</li>
        <li><strong>Partner/public sources:</strong> where lawful and relevant, we may verify limited information with institutions or public sources.</li>
    </ul>

    <h3>4) Why we collect your data</h3>
    <ul>
        <li>Respond to inquiries and provide counseling.</li>
        <li>Support applications and documentation workflows.</li>
        <li>Manage events and seminar registrations.</li>
        <li>Operate, secure, and improve the website.</li>
        <li>Send optional marketing communications with consent.</li>
    </ul>

    <h3>5) Legal bases for processing</h3>
    <ul>
        <li>Consent</li>
        <li>Contract or pre-contractual necessity</li>
        <li>Legitimate interests</li>
        <li>Legal obligation</li>
    </ul>

    <h3>6) Special categories and children</h3>
    <p>We do not intentionally request sensitive personal data through public web forms. If your process requires sensitive data, we handle it with enhanced confidentiality and only when necessary. If you are under 16, please involve a parent or guardian.</p>

    <h3>7) Who we share data with</h3>
    <ul>
        <li>Education providers/partners for admissions workflows.</li>
        <li>Technology vendors for hosting, CRM, analytics, communication, and security.</li>
        <li>Professional advisors or legal authorities where required.</li>
        <li>Business transfer entities under equivalent protections if restructuring occurs.</li>
    </ul>
    <p>We do not sell your personal information.</p>

    <h3>8) International transfers</h3>
    <p>Because counseling and applications involve institutions abroad, data may be transferred internationally. We apply safeguards such as contractual controls, minimum necessary disclosure, and role-based access.</p>

    <h3>9) Messaging specifics (email, phone, WhatsApp)</h3>
    <p>By contacting us via listed channels, you authorize us to reply through those channels. If you prefer a specific channel, inform us and we will honor your preference where possible.</p>

    <h3>10) Cookies, analytics and ads</h3>
    <p>Cookies may be used for functionality, analytics, and attribution where enabled. You can manage cookie preferences through browser settings or banner controls where deployed.</p>

    <h3>11) Data security</h3>
    <ul>
        <li>Need-to-know access controls</li>
        <li>Secure website and communication configurations</li>
        <li>Periodic vendor and security reviews</li>
        <li>Internal awareness and response processes</li>
    </ul>
    <p>No system is 100% secure, but we actively reduce risk and address incidents promptly.</p>

    <h3>12) Data retention</h3>
    <ul>
        <li>Inquiries/consultations: generally 12-24 months of inactivity unless deletion is requested earlier.</li>
        <li>Active applications: during service period and a reasonable post-service window.</li>
        <li>Legal records: retained as required by law or dispute defense requirements.</li>
    </ul>

    <h3>13) Your rights</h3>
    <ul>
        <li>Access and copy your personal data</li>
        <li>Correct inaccurate data</li>
        <li>Delete data in applicable circumstances</li>
        <li>Restrict or object to specific processing</li>
        <li>Withdraw consent where consent is the legal basis</li>
        <li>Opt out of marketing at any time</li>
    </ul>

    <h3>14) Marketing preferences</h3>
    <p>Marketing messages are sent only with consent or where law permits. You may opt out anytime; service and transactional messages may still be sent when necessary.</p>

    <h3>15) Region-specific notices</h3>
    <p>We align with applicable laws in Nepal and apply practical safeguards for cross-border student mobility data handling.</p>

    <h3>16) Children's privacy</h3>
    <p>Our services are intended for students and families. If data is collected from children without appropriate consent, we will delete it upon verification.</p>

    <h3>17) Third-party links and social channels</h3>
    <p>Our website may link to external platforms such as WhatsApp, Facebook, Instagram, or YouTube. Their privacy practices are governed by their own policies.</p>

    <h3>18) Changes to this policy</h3>
    <p>We may update this policy over time. The "Last updated" date indicates the latest revision.</p>

    <h3>19) Contact us</h3>
    <p>For privacy-related questions, contact: <strong>info@globaljourney.edu.np</strong></p>
</section>
HTML;

        LegalPage::query()->updateOrCreate(
            ['key' => 'terms-and-conditions'],
            [
                'title' => ['en' => 'Terms and Conditions'],
                'description' => ['en' => $termsHtml],
                'last_updated' => '16 November 2025 (Asia/Kathmandu)',
            ]
        );

        LegalPage::query()->updateOrCreate(
            ['key' => 'privacy-policy'],
            [
                'title' => ['en' => 'Privacy Policy'],
                'description' => ['en' => $privacyHtml],
                'last_updated' => '16 November 2025 (Asia/Kathmandu)',
            ]
        );
    }
}
