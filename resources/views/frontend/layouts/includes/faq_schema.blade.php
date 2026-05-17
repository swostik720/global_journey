@php
    $faqSchemaItems = collect($faqs ?? [])
        ->map(function ($faq) {
            $question = trim(html_entity_decode(strip_tags((string) ($faq['question'] ?? '')), ENT_QUOTES | ENT_HTML5, 'UTF-8'));
            $answer = trim(preg_replace('/\s+/', ' ', html_entity_decode(strip_tags((string) ($faq['answer'] ?? '')), ENT_QUOTES | ENT_HTML5, 'UTF-8')));

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
