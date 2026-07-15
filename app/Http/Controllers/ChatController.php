<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{
    private const FAQ = [
        ['question' => 'What services does Global Journey offer?', 'answer' => 'We offer free counselling, university applications, visa processing, IELTS/PTE/TOEFL test prep, and interview preparation for UK, Australia, Canada, USA, and New Zealand.'],
        ['question' => 'Which countries can I study in?', 'answer' => 'We support study abroad destinations including the UK, Australia, Canada, USA, and New Zealand.'],
        ['question' => 'What are the visa success rates?', 'answer' => 'We have a 98% visa success rate with 5,000+ students successfully placed across 20+ countries.'],
        ['question' => 'How can I book a consultation?', 'answer' => 'You can book a free consultation by visiting https://www.globaljourneyedu.com.np/contact-us or calling 01-4168345 / +977-9843215204.'],
        ['question' => 'What are the offices locations?', 'answer' => 'We have offices in Putalisadak Kathmandu, Birtamod, Kupendole Lalitpur, and a Sydney support office in Australia.'],
        ['question' => 'Is there test preparation available?', 'answer' => 'Yes, we provide expert IELTS and PTE coaching to help you hit your target score fast.'],
        ['question' => 'Do you help with visa interviews?', 'answer' => 'Absolutely. We provide personalized visa interview preparation, mock sessions, and document review to improve confidence and response quality.'],
        ['question' => 'How long does the admission process take?', 'answer' => 'Timelines vary by country and intake, but most applications take a few weeks to a few months from profile review to final offer and visa documentation.'],
        ['question' => 'What are the key team members?', 'answer' => 'Our team includes Yagya Raj Poudel (Managing Director), Rajya Limbu (Documentation Officer), Janak Bhul (Application Officer), Kishan Khatri (Counselor), Deepa Tandukar (Senior Counselor), and Aashma Maharjan (Application Officer).'],
        ['question' => 'Is the consultation free?', 'answer' => 'Yes, browsing destinations, programs, and guidance content is free. You can book a one-on-one counseling session to discuss program selection, financial planning, documentation, and application strategy.'],
    ];

    private const SYSTEM_PROMPT = <<<'PROMPT'
You are a helpful, friendly study-abroad advisor for Global Journey Education Services, Nepal's #1 study abroad consultancy.

ABOUT THE COMPANY:
- Name: Global Journey Education Services
- Based in: Putalisadak, Kathmandu, Nepal
- Founded by: Bishal Neupane (Founder & CEO, QEAC/PIER Certified Education Counselor, 13+ years experience)
- 5,000+ students successfully placed across 20+ countries
- 98% visa success rate
- 15+ years of expertise
- Nepal's #1 Study Abroad Consultancy

SERVICES OFFERED:
- Free counselling and profile evaluation
- University applications and admissions guidance
- Visa processing and documentation
- IELTS/PTE/TOEFL/SAT/GRE test preparation
- Interview preparation and mock sessions
- Career and country planning
- University and course selection

DESTINATIONS SUPPORTED:
1. United Kingdom (UK) - 3-year degrees, globally recognized
2. Australia - World-class universities, post-study work rights
3. Canada - Affordable tuition, PR pathway
4. United States (USA) - Ivy League to state universities
5. New Zealand - Globally accredited degrees

OFFICE LOCATIONS:
- Kathmandu: Putalisadak, Kathmandu, Nepal | 01-4168345
- Birtamod: Birtamod, Nepal | +977-9843215204
- Lalitpur: Kupendole, Lalitpur | +977-9843215204
- Sydney: Sydney, Australia | +977-9843215204

CONTACT INFO:
- Phone: 01-4168345 / +977-9843215204 / +977 9705427840
- Email: info@globaljourneyedu.com.np
- Website: https://www.globaljourneyedu.com.np

KEY TEAM MEMBERS:
- Bishal Neupane - Founder & CEO (QEAC Certified, 13+ years)
- Yagya Raj Poudel - Managing Director
- Rajya Limbu - Documentation Officer
- Janak Bhul - Application Officer
- Kishan Khatri - Counselor
- Deepa Tandukar - Senior Counselor
- Aashma Maharjan - Application Officer

TESTIMONIAL HIGHLIGHTS:
- Vishma Acharya: Grateful for UK processing, transparency, quick response
- Amrit Kc: Knowledgeable, responsive, results-driven team
- Roshan Ghising: Friendly team, smooth visa process
- Maneesh Chaudhari: Helped with UK visa, document gathering, interview prep

Tone: Warm, knowledgeable, encouraging. Keep responses to 2-4 sentences max. Use simple clear English for Nepali students. Suggest booking a free consultation at https://www.globaljourneyedu.com.np/contact-us or calling 01-4168345 when relevant.

Do NOT make up specific visa fees, processing times, or university cut-offs. Tell users to contact the team for accurate info. Never discuss competitors.
PROMPT;

    public function reply(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:500',
            'history' => 'sometimes|array',
        ]);

        $userMessage = $request->input('message');
        $history = $request->input('history', []);

        $messages = [['role' => 'system', 'content' => self::SYSTEM_PROMPT]];

        foreach ($history as $entry) {
            $messages[] = [
                'role' => $entry['role'],
                'content' => $entry['content'],
            ];
        }

        $messages[] = ['role' => 'user', 'content' => $userMessage];

        $apiKey = config('services.openrouter.api_key');

        try {
            $payload = json_encode([
                'model' => 'openrouter/free',
                'messages' => $messages,
                'temperature' => 0.7,
                'max_tokens' => 400,
            ]);

            $url = 'https://openrouter.ai/api/v1/chat/completions';
            $headers = [
                'Authorization: Bearer ' . $apiKey,
                'Content-Type: application/json',
            ];

            $result = $this->executeCurl($url, $payload, $headers);

            if ($result['success']) {
                $data = json_decode($result['body'], true);
                $reply = $data['choices'][0]['message']['content'] ?? null;

                if ($reply) {
                    return response()->json([
                        'reply' => $reply,
                        'faq' => self::FAQ,
                    ]);
                }
            }

            Log::error('OpenRouter API error', [
                'status' => $result['status'],
                'body' => substr($result['body'] ?? '', 0, 500),
                'curl_error' => $result['error'],
                'attempt' => $result['attempt'],
            ]);
        } catch (\Exception $e) {
            Log::error('OpenRouter API exception: ' . $e->getMessage());
        }

        return response()->json([
            'reply' => "Sorry, I'm having trouble connecting right now. Please call us at 01-4168345 or book a free consultation.",
            'faq' => self::FAQ,
        ]);
    }

    private function executeCurl(string $url, string $payload, array $headers): array
    {
        $escapedPayload = escapeshellarg($payload);

        $headerFlags = '';
        foreach ($headers as $header) {
            $headerFlags .= ' -H ' . escapeshellarg($header);
        }

        $command = sprintf(
            'curl -s -X POST --max-time 30 %s -d %s %s 2>&1',
            $headerFlags,
            $escapedPayload,
            escapeshellarg($url)
        );

        $body = null;
        $statusCode = 0;

        if (function_exists('exec')) {
            exec($command, $output, $exitCode);
            $body = implode("\n", $output);

            if ($exitCode !== 0) {
                Log::warning('ChatBot system curl failed', [
                    'exit_code' => $exitCode,
                    'output'    => $body,
                ]);

                return [
                    'success' => false,
                    'status'  => 0,
                    'body'    => '',
                    'error'   => 'System curl exit code: ' . $exitCode,
                    'attempt' => 'exec',
                ];
            }
        } elseif (function_exists('shell_exec')) {
            $body = shell_exec($command);

            if ($body === null) {
                return [
                    'success' => false,
                    'status'  => 0,
                    'body'    => '',
                    'error'   => 'shell_exec returned null',
                    'attempt' => 'shell_exec',
                ];
            }
        } else {
            return [
                'success' => false,
                'status'  => 0,
                'body'    => '',
                'error'   => 'exec and shell_exec are disabled',
                'attempt' => 'none',
            ];
        }

        $data = json_decode($body, true);

        if ($data && isset($data['choices'][0]['message']['content'])) {
            return [
                'success' => true,
                'status'  => 200,
                'body'    => $body,
                'error'   => '',
                'attempt' => 'system_curl',
            ];
        }

        Log::warning('ChatBot system curl returned unexpected response', [
            'body' => substr($body, 0, 500),
        ]);

        return [
            'success' => false,
            'status'  => 0,
            'body'    => $body ?? '',
            'error'   => 'Unexpected response from system curl',
            'attempt' => 'system_curl',
        ];
    }
}
