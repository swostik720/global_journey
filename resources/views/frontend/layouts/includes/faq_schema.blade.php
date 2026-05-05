@php
    $faqSchemaItems = collect($faqs ?? [])
        ->map(function ($faq) {
            $question = trim(strip_tags((string) ($faq['question'] ?? '')));
            $answer = trim(preg_replace('/\s+/', ' ', strip_tags((string) ($faq['answer'] ?? ''))));

            if ($question === '' || $answer === '') {
                return null;
            }

            return [
                '@type' => 'Question',
                'name' => $question,
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => $answer,
                ],
            ];
        })
        ->filter()
        ->values();
@endphp

@if ($faqSchemaItems->isNotEmpty())
    <script type="application/ld+json">
        {!! json_encode(
            [
                '@context' => 'https://schema.org',
                '@type' => 'FAQPage',
                'mainEntity' => $faqSchemaItems,
            ],
            JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT,
        ) !!}
    </script>
@endif
