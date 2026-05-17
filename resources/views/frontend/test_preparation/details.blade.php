@extends('frontend.layouts.includes.master')
@section('meta_title', ($testpreparation->title ?? 'Test Preparation Details') . ' | ' . ($setting->name ?? config('app.name')))
@section('meta_description', strip_tags($testpreparation->short_description ?? ''))
@section('maincontent')

    @php
        $parts = explode(' ', $testpreparation->title ?? '', 3);
        $firstPart = isset($parts[0], $parts[1]) ? $parts[0] . ' ' . $parts[1] : $parts[0] ?? '';
        $secondPart = $parts[2] ?? '';

        $descriptionHtml = $testpreparation->description ?? '';
        $headingTocItems = [];
        $usedIds = [];
        $generatedHeadingIndex = 0;
        $sanitizeHeadingText = static function ($value) {
            $text = strip_tags((string) $value);
            $text = preg_replace('/\x{00A0}/u', ' ', $text);
            $text = preg_replace('/\s+/u', ' ', $text);

            return trim((string) $text);
        };
        $titleForComparison = \Illuminate\Support\Str::lower($sanitizeHeadingText($testpreparation->title ?? ''));

        $quickInfoItems = collect($testpreparation->quick_info_items ?? [])
            ->map(function ($item) {
                return [
                    'icon' => trim((string) ($item['icon'] ?? 'bi bi-info-circle')),
                    'title' => trim((string) ($item['title'] ?? '')),
                    'value' => trim((string) ($item['value'] ?? '')),
                ];
            })
            ->filter(fn($item) => $item['title'] !== '' || $item['value'] !== '')
            ->values();

        $keyHighlights = collect($testpreparation->key_highlights ?? [])
            ->map(fn($item) => trim((string) ($item['text'] ?? '')))
            ->filter()
            ->values();

        $hasCta =
            filled($testpreparation->cta_title) ||
            filled($testpreparation->cta_description) ||
            (filled($testpreparation->cta_button_text) && filled($testpreparation->cta_button_url));

        $descriptionWithAnchors = preg_replace_callback(
            '/<h([1-6])([^>]*)>(.*?)<\/h\1>/is',
            function ($matches) use (&$headingTocItems, &$usedIds, &$generatedHeadingIndex, $sanitizeHeadingText) {
                $level = (int) $matches[1];
                $renderLevel = $level === 1 ? 2 : $level;
                $attributes = $matches[2] ?? '';
                $innerHtml = $matches[3] ?? '';
                $text = $sanitizeHeadingText(strip_tags($innerHtml));

                if ($text === '') {
                    return $matches[0];
                }

                $existingId = null;
                if (preg_match('/\sid=["\']([^"\']+)["\']/i', $attributes, $idMatch)) {
                    $existingId = $idMatch[1];
                }

                $baseId = $existingId ?: \Illuminate\Support\Str::slug($text);
                if ($baseId === '') {
                    $generatedHeadingIndex++;
                    $baseId = 'test-preparation-section-' . $generatedHeadingIndex;
                }

                $id = $baseId;
                $suffix = 2;
                while (in_array($id, $usedIds, true)) {
                    $id = $baseId . '-' . $suffix++;
                }
                $usedIds[] = $id;

                if (!$existingId) {
                    $attributes .= ' id="' . $id . '"';
                }

                $headingTocItems[] = ['id' => $id, 'text' => $text, 'level' => $renderLevel];

                return '<h' . $renderLevel . $attributes . '>' . $innerHtml . '</h' . $renderLevel . '>';
            },
            $descriptionHtml,
        );

        $contentBlocks = [];
        if (
            preg_match_all(
                '/(<h[1-6][^>]*>.*?<\/h[1-6]>.*?)(?=<h[1-6][^>]*>|$)/is',
                $descriptionWithAnchors,
                $headingBlocks,
            ) &&
            !empty($headingBlocks[1])
        ) {
            $contentBlocks = array_values(array_filter(array_map('trim', $headingBlocks[1])));
        } elseif (
            preg_match_all(
                '/(<p\b[^>]*>.*?<\/p>|<ul\b[^>]*>.*?<\/ul>|<ol\b[^>]*>.*?<\/ol>|<table\b[^>]*>.*?<\/table>|<blockquote\b[^>]*>.*?<\/blockquote>)/is',
                $descriptionWithAnchors,
                $genericBlocks,
            ) &&
            !empty($genericBlocks[1])
        ) {
            $contentBlocks = array_values(array_filter(array_map('trim', $genericBlocks[1])));
        } elseif (trim(strip_tags($descriptionWithAnchors)) !== '') {
            $contentBlocks = [trim($descriptionWithAnchors)];
        }

        $articleSections = [];
        $currentSection = null;

        foreach ($contentBlocks as $contentBlock) {
            $headingMeta = null;
            if (
                preg_match('/<h([1-6])[^>]*\sid=["\']([^"\']+)["\'][^>]*>(.*?)<\/h\1>/is', $contentBlock, $headingMatch)
            ) {
                $headingMeta = [
                    'id' => $headingMatch[2],
                    'text' => $sanitizeHeadingText(strip_tags($headingMatch[3])),
                    'level' => (int) $headingMatch[1],
                ];
            }

            $startsTopLevelSection = $headingMeta && $headingMeta['level'] <= 2;

            if ($currentSection === null || $startsTopLevelSection) {
                if ($currentSection !== null) {
                    $articleSections[] = $currentSection;
                }
                $currentSection = [
                    'blocks' => [$contentBlock],
                    'headings' => $headingMeta ? [$headingMeta] : [],
                ];
            } else {
                $currentSection['blocks'][] = $contentBlock;
                if ($headingMeta) {
                    $currentSection['headings'][] = $headingMeta;
                }
            }
        }

        if ($currentSection !== null) {
            $articleSections[] = $currentSection;
        }

        $dynamicSections = array_values(
            array_filter([
                $hasCta ? 'cta' : null,
            ]),
        );

        $dynamicSectionPositions = [];
        $sectionCountBase = count($articleSections);
        $ctaInsertPosition = min(2, max($sectionCountBase, 1));

        if ($hasCta) {
            $dynamicSectionPositions[$ctaInsertPosition][] = 'cta';
        }

        $dynamicSectionTocLabels = [
            'quick-info' => [
                'id' => 'quick-information-guide',
                'text' => 'Quick Information Guide',
                'level' => 2,
            ],
            'highlights' => ['id' => 'key-highlights', 'text' => 'Key Highlights', 'level' => 2],
            'cta' => [
                'id' => 'blog-cta',
                'text' => filled($testpreparation->cta_title) ? $testpreparation->cta_title : 'Next Step',
                'level' => 2,
            ],
        ];

        $tocItems = [];

        if ($quickInfoItems->isNotEmpty()) {
            $tocItems[] = $dynamicSectionTocLabels['quick-info'];
        }

        if ($keyHighlights->isNotEmpty()) {
            $tocItems[] = $dynamicSectionTocLabels['highlights'];
        }

        foreach ($articleSections as $sectionIndex => $articleSection) {
            foreach ($articleSection['headings'] as $headingMeta) {
                $headingText = $headingMeta['text'] ?? '';
                $isDuplicateTitle =
                    $titleForComparison !== '' && \Illuminate\Support\Str::lower($headingText) === $titleForComparison;
                $isLikelyParagraph =
                    \Illuminate\Support\Str::length($headingText) > 90 || str_word_count($headingText) > 14;

                if ($headingMeta['level'] <= 2 && $headingText !== '' && !$isDuplicateTitle && !$isLikelyParagraph) {
                    $tocItems[] = $headingMeta;
                }
            }
            foreach ($dynamicSectionPositions[$sectionIndex + 1] ?? [] as $dynamicSection) {
                $tocItems[] = $dynamicSectionTocLabels[$dynamicSection];
            }
        }
        if (empty($tocItems) && $hasCta) {
            $tocItems[] = $dynamicSectionTocLabels['cta'];
        }
        $tocItems = array_values($tocItems);

        $highlightCount = $keyHighlights->count();
        $bookNowUrl = route('test-preparation.details', $testpreparation->slug) . '#test-preparation-enroll';

        $testSlug = strtolower((string) ($testpreparation->slug ?? ''));
        $isPte = str_contains($testSlug, 'pte');

        $ctaPrimary = [
            'title' => $isPte ? 'PTE Course' : 'IELTS Course',
            'points' => $isPte
                ? [
                    'Complete sessions with certified PTE trainers',
                    'AI-backed practice tests with score analytics',
                    'Section-wise feedback for speaking, reading, listening, and writing',
                ]
                : [
                    'Complete classes with expert trainers',
                    'Weekly mock tests and progress tracking',
                    'Personalized feedback and doubt support',
                ],
            'button' => 'Book Now',
            'url' => $bookNowUrl,
        ];

        $ctaSecondary = [
            'title' => $isPte ? 'Curious about PTE' : 'Curious about IELTS',
            'body' => $isPte
                ? 'Learn about official PTE format, question types, scoring logic, and latest Pearson updates.'
                : 'Learn about official IELTS guidelines, modules, scoring, and current test updates.',
            'button' => $isPte ? 'Visit Official PTE Website' : 'Visit Official IELTS Website',
            'url' => $isPte ? 'https://www.pearsonpte.com/' : 'https://ielts.org/',
        ];
    @endphp

    @include('frontend.layouts.includes.page_hero', [
        'eyebrow' => 'Test Preparation Details',
        'title' => trim($firstPart) . ' ',
        'accent' => $secondPart ?: null,
        'subtitle' => \Illuminate\Support\Str::words(
            strip_tags($testpreparation->short_description ?? ''),
            24,
            '...'),
        'meta' => ['Score Strategy', 'Structured Preparation', 'Guided Support'],
    ])

    <section data-aos="fade-up" class="sa-main mt-10">
        <div class="container">
            <div class="sa-layout {{ empty($tocItems) ? 'sa-layout--no-toc' : '' }}">

                @if (!empty($tocItems))
                    <aside class="sa-toc-col">
                        <div class="sa-toc" id="saToc">
                            <div class="sa-toc__head">
                                <div class="sa-toc__icon">
                                    <i class="bi bi-journal-bookmark-fill"></i>
                                </div>
                                <div>
                                    <div class="sa-toc__title">Contents</div>
                                    <div class="sa-toc__sub">Jump to section</div>
                                </div>
                            </div>
                            <ul class="sa-toc__list">
                                @foreach ($tocItems as $i => $tocItem)
                                    <li class="sa-toc__item sa-toc__item--l{{ $tocItem['level'] }}">
                                        <a href="#{{ $tocItem['id'] }}" class="sa-toc__link"
                                            data-toc-id="{{ $tocItem['id'] }}">
                                            <span class="sa-toc__dot sa-toc__dot--{{ ($i % 3) + 1 }}"></span>
                                            <span class="sa-toc__text">{{ $tocItem['text'] }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </aside>
                @endif

                <article class="sa-article">
                    <div data-aos="zoom-in-up" data-aos-delay="140" class="sa-meta">
                        <span class="sa-chip sa-chip--cat">
                            <i class="bi bi-journal-text"></i>
                            {{ strtoupper($testpreparation->slug ?? 'IELTS') }}
                        </span>
                        <span class="sa-chip">
                            <i class="bi bi-mortarboard-fill"></i>
                            Test Preparation
                        </span>
                    </div>

                    <div class="bds-progress-wrap">
                        <div class="bds-progress-fill" id="bdsProgress"></div>
                    </div>

                    <div class="sa-voice" id="bdsVoicePlayer">
                        <div class="sa-voice__title">Listen to Article <span>Audio</span></div>
                        <div class="sa-voice__controls">
                            <button type="button" class="sa-voice__play" id="bdsVoicePlay" aria-label="Play audio">
                                <i class="bi bi-play-fill" id="bdsVoicePlayIcon"></i>
                            </button>
                            <div class="sa-voice__time" id="bdsVoiceTime">0:00</div>
                            <input type="range" id="bdsVoiceProgress" class="sa-voice__progress" min="0"
                                max="100" value="0">
                            <select id="bdsVoiceRate" class="sa-voice__rate" aria-label="Speech speed">
                                <option value="0.5">0.5x</option>
                                <option value="0.75">0.75x</option>
                                <option value="1" selected>1x</option>
                                <option value="1.25">1.25x</option>
                                <option value="1.5">1.5x</option>
                            </select>
                            <i class="bi bi-volume-up-fill sa-voice__vol-icon"></i>
                            <input type="range" id="bdsVoiceVolume" class="sa-voice__volume" min="0" max="1"
                                step="0.1" value="1">
                            <div class="sa-voice__total" id="bdsVoiceTotal">0:00</div>
                        </div>
                    </div>

                    @if ($testpreparation->image_path)
                        <div class="sa-heroimg">
                            <img src="{{ $testpreparation->image_path }}" alt="{{ $testpreparation->title }}"
                                loading="eager">
                        </div>
                    @endif

                    @if ($quickInfoItems->isNotEmpty())
                        <section class="sa-mid-section sa-quickinfo" id="quick-information-guide">
                            <h2 class="sa-mid-section__title">Quick Information Guide</h2>
                            <div class="sa-quickinfo__grid">
                                @foreach ($quickInfoItems as $item)
                                    <div class="sa-quickinfo__card">
                                        <div class="sa-quickinfo__icon">
                                            <i class="{{ $item['icon'] ?: 'bi bi-info-circle' }}"></i>
                                        </div>
                                        <div class="sa-quickinfo__content">
                                            <h3>{{ $item['title'] }}</h3>
                                            <p>{{ $item['value'] }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </section>
                    @endif

                    @if ($keyHighlights->isNotEmpty())
                        <section class="sa-mid-section sa-highlights" id="key-highlights">
                            <h2 class="sa-mid-section__title">Key Highlights</h2>
                            <ul class="sa-highlights__list">
                                @foreach ($keyHighlights as $highlight)
                                    <li>
                                        <span class="sa-highlights__icon"><i class="bi bi-check2-circle"></i></span>
                                        <span>{{ $highlight }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </section>
                    @endif

                    <div class="sa-prose" id="bdsArticleProse">
                        @forelse ($articleSections as $sectionIndex => $articleSection)
                            {!! implode("\n", $articleSection['blocks']) !!}

                            @foreach ($dynamicSectionPositions[$sectionIndex + 1] ?? [] as $dynamicSection)
                                @if ($dynamicSection === 'cta')
                                    <section class="sa-mid-section bds-cta" id="blog-cta">
                                        <div class="bds-cta__tag">Expert Guidance</div>
                                        @if (filled($testpreparation->cta_title))
                                            <h2 class="bds-cta__title">{{ $testpreparation->cta_title }}</h2>
                                        @endif
                                        @if (filled($testpreparation->cta_description))
                                            <p class="bds-cta__body">{{ $testpreparation->cta_description }}</p>
                                        @endif
                                        <div class="bds-cta__actions">
                                            @if (filled($testpreparation->cta_button_text) && filled($testpreparation->cta_button_url))
                                                <a href="{{ $testpreparation->cta_button_url }}" target="_blank"
                                                    rel="noopener noreferrer" class="bds-cta__btn bds-cta__btn--primary">
                                                    {{ $testpreparation->cta_button_text }} <i
                                                        class="bi bi-arrow-up-right-circle ms-1"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </section>
                                @endif
                            @endforeach
                        @empty
                            @foreach ($dynamicSections as $dynamicSection)
                                @if ($dynamicSection === 'cta')
                                    <section class="sa-mid-section bds-cta" id="blog-cta">
                                        <div class="bds-cta__tag">Expert Guidance</div>
                                        @if (filled($testpreparation->cta_title))
                                            <h2 class="bds-cta__title">{{ $testpreparation->cta_title }}</h2>
                                        @endif
                                        @if (filled($testpreparation->cta_description))
                                            <p class="bds-cta__body">{{ $testpreparation->cta_description }}</p>
                                        @endif
                                        <div class="bds-cta__actions">
                                            @if (filled($testpreparation->cta_button_text) && filled($testpreparation->cta_button_url))
                                                <a href="{{ $testpreparation->cta_button_url }}" target="_blank"
                                                    rel="noopener noreferrer" class="bds-cta__btn bds-cta__btn--primary">
                                                    {{ $testpreparation->cta_button_text }} <i
                                                        class="bi bi-arrow-up-right-circle ms-1"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </section>
                                @endif
                            @endforeach
                        @endforelse
                    </div>

                    {{-- <div class="bds-stats">
                        <div class="bds-stats__cell">
                            <div class="bds-stats__num">{{ number_format((int) $highlightCount) }}</div>
                            <div class="bds-stats__lbl">Highlights</div>
                        </div>
                        <button type="button" class="bds-stats__cell bds-stats__cell--btn" id="bdsShareBtn"
                            title="Share this page">
                            <i class="bi bi-share bds-stats__icon"></i>
                            <div class="bds-stats__lbl">Share</div>
                        </button>
                        <button type="button" class="bds-stats__cell bds-stats__cell--btn" onclick="bdsPrintArticle()"
                            title="Print this page">
                            <i class="bi bi-printer bds-stats__icon"></i>
                            <div class="bds-stats__lbl">Print</div>
                        </button>
                    </div> --}}

                    <div class="bds-back">
                        <a href="{{ route('test-preparation') }}" class="themebtu">
                            <i class="bi bi-arrow-left"></i> Back to Test Preparation
                        </a>
                    </div>
                </article>
            </div>
        </div>
    </section>

    @if (!empty($testpreparation->faqs))
        <section data-aos="fade-up" class="sa-faq-section">
            <div class="container">
                <div data-aos="zoom-in-up" data-aos-delay="140" class="sa-faq-wrap">
                    <div data-aos="fade-up" data-aos-delay="100" class="heading mb-4 text-center text-md-start">
                        <h6 class="text-primary">Common Questions</h6>
                        <h2 class="fw-bold">Test Preparation FAQs</h2>
                        <img alt="line" src="{{ asset('frontend/assets/img/headingline.png') }}"
                            class="img-fluid mt-2">
                    </div>
                    <div class="accordion sa-faq" id="testPreparationFaqAccordion">
                        @foreach ($testpreparation->faqs as $index => $faq)
                            <div data-aos="zoom-in-up" data-aos-delay="140" class="accordion-item sa-faq__item">
                                <h2 class="accordion-header" id="testFaqHead{{ $index }}">
                                    <button class="accordion-button collapsed sa-faq__btn" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#testFaqBody{{ $index }}"
                                        aria-expanded="false" aria-controls="testFaqBody{{ $index }}">
                                        {{ $faq['question'] ?? 'Question' }}
                                    </button>
                                </h2>
                                <div id="testFaqBody{{ $index }}" class="accordion-collapse collapse"
                                    aria-labelledby="testFaqHead{{ $index }}"
                                    data-bs-parent="#testPreparationFaqAccordion">
                                    <div class="accordion-body sa-faq__body">
                                        {!! $faq['answer'] ?? '' !!}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif

    @include('frontend.layouts.includes.faq_schema', ['faqs' => $testpreparation->faqs ?? []])

    <section data-aos="fade-up" class="tp-cta-section">
        <div class="container">
            <div data-aos="fade-up" data-aos-delay="100" class="heading text-center mb-5">
                <h6>Take the Next Step</h6>
                <h2>How We Can Help You</h2>
                <img src="{{ asset('frontend/assets/img/headingline.png') }}" alt="line" class="img-fluid mt-2">
            </div>

            <div class="tp-cta-grid">
                <article data-aos="zoom-in-up" data-aos-delay="140" class="tp-cta-card tp-cta-card--primary">
                    <div class="tp-cta-card__icon"><i class="bi bi-journal-check"></i></div>
                    <h3>{{ $ctaPrimary['title'] }}</h3>
                    <ul class="tp-cta-card__list">
                        @foreach ($ctaPrimary['points'] as $point)
                            <li>{{ $point }}</li>
                        @endforeach
                    </ul>
                    <a href="{{ $ctaPrimary['url'] }}"
                        class="tp-cta-card__btn tp-cta-card__btn--light">{{ $ctaPrimary['button'] }} <i
                            class="bi bi-arrow-right ms-1"></i></a>
                </article>

                <article data-aos="zoom-in-up" data-aos-delay="180" class="tp-cta-card tp-cta-card--outline">
                    <div class="tp-cta-card__icon"><i class="bi bi-box-arrow-up-right"></i></div>
                    <h3>{{ $ctaSecondary['title'] }}</h3>
                    <p>{{ $ctaSecondary['body'] }}</p>
                    <a href="{{ $ctaSecondary['url'] }}" target="_blank" rel="noopener noreferrer"
                        class="tp-cta-card__btn tp-cta-card__btn--solid">{{ $ctaSecondary['button'] }} <i
                            class="bi bi-box-arrow-up-right ms-1"></i></a>
                </article>
            </div>
        </div>
    </section>

    <section data-aos="fade-up" class="sa-contact-section" id="test-preparation-enroll">
        <div class="container">
            <div class="sa-contact-wrap">
                <div class="sa-contact-form-col">
                    <div class="sa-contact-wrap__intro">
                        <div class="sa-contact__badge">Start Your Test Journey</div>
                        <h3 class="sa-contact__title">Enroll Now</h3>
                        <img alt="line" src="{{ asset('frontend/assets/img/headingline.png') }}"
                            class="sa-contact__line">
                    </div>
                    <div class="sa-contact bds-contact-form-wrap">
                        @include('frontend.layouts.enrollNow_form', [
                            'default_test_preparation_id' => $testpreparation->id ?? null,
                            'testPreparationsOptions' => $testPreparationsOptions ?? [],
                        ])
                    </div>
                </div>

                <aside class="details-card" data-aos="zoom-in-up" data-aos-delay="120">
                    <h4>Need Personal Guidance</h4>
                    <p class="tp-guidance-copy">Our counselors can help you choose the right study plan, timeline, and
                        mock-test strategy for your target IELTS score.</p>
                    <ul class="contact-list tp-guidance-list">
                        <li>
                            <a href="javascript:void(0)">
                                <i class="bi bi-check2-circle"></i>
                                <span>Personalized study roadmap</span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <i class="bi bi-check2-circle"></i>
                                <span>Weekly progress tracking</span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <i class="bi bi-check2-circle"></i>
                                <span>Mentor-led mock analysis</span>
                            </a>
                        </li>
                    </ul>
                </aside>
            </div>
        </div>
    </section>

    {{-- ════════════════════════════════════════════════════════════
                 STAY UPDATED
            ════════════════════════════════════════════════════════════ --}}
    @include('frontend.layouts.stay_updated')


    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        .splash-area-section *,
        .sa-main *,
        .sa-faq-section *,
        .sa-contact-section *,
        .tp-cta-section * {
            font-family: "Poppins", sans-serif !important;
        }

        .tp-cta-section {
            padding: 8px 0 58px;
            background: #f4f7fb;
        }

        .tp-cta-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 20px;
        }

        .tp-cta-card {
            border-radius: 18px;
            padding: 24px;
            position: relative;
            overflow: hidden;
            border: 1px solid #d9e4f7;
            box-shadow: 0 12px 30px rgba(15, 41, 95, 0.08);
            transition: transform 0.25s ease, box-shadow 0.25s ease;
            min-height: 100%;
        }

        .tp-cta-card:hover {
            transform: translateY(-8px) scale(1.01);
            box-shadow: 0 22px 40px rgba(15, 41, 95, 0.19);
        }

        .tp-cta-card--primary {
            background: linear-gradient(135deg, #0038A6, #0046C4, #0058E8, #003070, #001F50);
            color: #fff;
            border-color: rgba(255, 255, 255, 0.22);
        }

        .tp-cta-card--primary::before {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(120deg, rgba(255, 255, 255, 0.28), rgba(255, 255, 255, 0) 55%);
            pointer-events: none;
        }

        .tp-cta-card--outline {
            background: #fff;
        }

        .tp-cta-card--outline::after {
            content: "";
            position: absolute;
            left: 0;
            right: 0;
            top: 0;
            height: 4px;
            background: linear-gradient(135deg, #0038A6, #0046C4, #0058E8, #003070, #001F50);
        }

        .tp-cta-card__icon,
        .tp-cta-card h3,
        .tp-cta-card__list,
        .tp-cta-card p,
        .tp-cta-card__btn {
            position: relative;
            z-index: 1;
        }

        .tp-cta-card__icon {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            margin-bottom: 14px;
        }

        .tp-cta-card--primary .tp-cta-card__icon {
            background: rgba(255, 255, 255, 0.2);
            color: #fff;
        }

        .tp-cta-card--outline .tp-cta-card__icon {
            background: #e8f0ff;
            color: #1e40af;
        }

        .tp-cta-card h3 {
            font-size: 1.35rem;
            margin-bottom: 10px;
            font-weight: 700;
        }

        .tp-cta-card--primary h3 {
            color: #fff;
        }

        .tp-cta-card--outline h3 {
            color: #0f2460;
        }

        .tp-cta-card p {
            font-size: 0.97rem;
            line-height: 1.75;
            margin-bottom: 18px;
        }

        .tp-cta-card--primary p {
            color: rgba(255, 255, 255, 0.9);
        }

        .tp-cta-card--outline p {
            color: #475569;
        }

        .tp-cta-card__list {
            margin: 0 0 18px;
            padding: 0;
            list-style: none;
            display: grid;
            gap: 9px;
        }

        .tp-cta-card__list li {
            display: flex;
            align-items: flex-start;
            gap: 9px;
            font-size: 0.94rem;
            line-height: 1.6;
        }

        .tp-cta-card__list li::before {
            content: "";
            width: 7px;
            height: 7px;
            border-radius: 50%;
            margin-top: 8px;
            flex-shrink: 0;
            background: currentColor;
            opacity: 0.9;
        }

        .tp-cta-card--primary .tp-cta-card__list li {
            color: rgba(255, 255, 255, 0.92);
        }

        .tp-cta-card--outline .tp-cta-card__list li {
            color: #475569;
        }

        .tp-cta-card__btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            border-radius: 10px;
            padding: 10px 16px;
            text-decoration: none;
            font-size: 0.88rem;
            font-weight: 700;
            transition: transform 0.2s ease, background-color 0.2s ease, color 0.2s ease;
        }

        .tp-cta-card__btn:hover {
            transform: translateY(-1px);
        }

        .tp-cta-card:hover .tp-cta-card__icon {
            transform: translateY(-2px) scale(1.07);
            box-shadow: 0 12px 24px rgba(15, 41, 95, 0.18);
        }

        .tp-cta-card:hover .tp-cta-card__btn i {
            transform: translateX(3px);
        }

        .tp-cta-card__icon,
        .tp-cta-card__btn i {
            transition: transform 0.22s ease, box-shadow 0.22s ease;
        }

        .tp-cta-card__btn--light {
            background: #fff;
            color: #1d4ed8;
        }

        .tp-cta-card__btn--light:hover {
            background: #eff6ff;
            color: #1e40af;
        }

        .tp-cta-card__btn--solid {
            background: linear-gradient(135deg, #0038A6, #0046C4, #0058E8, #003070, #001F50);
            color: #fff;
        }

        .tp-cta-card__btn--solid:hover {
            color: #fff;
            filter: brightness(1.06);
        }

        .splash-title {
            font-size: 70px;
            line-height: 1.1;
            margin: 0;
            padding-left: 50px;
            white-space: nowrap;
        }

        .gradient-text {
            background: linear-gradient(90deg, #0026cc, #001a80, #000d40);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .splash-area-section .container {
            max-width: 100%;
            padding: 0 15px;
        }

        .sa-main {
            padding: 52px 0 36px;
            background: #f4f7fb;
        }

        .sa-layout {
            display: grid;
            grid-template-columns: 340px 1fr;
            gap: 32px;
            align-items: start;
        }

        .sa-layout--no-toc {
            grid-template-columns: minmax(0, 1fr);
        }

        .sa-toc-col {
            position: sticky;
            top: 120px;
            width: 100%;
            z-index: 10;
        }

        .sa-toc {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(15, 36, 96, 0.08);
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 6px 20px rgba(15, 36, 96, 0.1);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .sa-toc:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(15, 36, 96, 0.12);
        }

        .sa-toc__head {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 16px;
            background: linear-gradient(135deg, #0f2460 0%, #1d4ed8 100%);
            border-bottom: 1px solid rgba(29, 78, 216, 0.2);
        }

        .sa-toc__icon {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.25);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 15px;
            flex-shrink: 0;
        }

        .sa-toc__title {
            font-size: 14px;
            font-weight: 700;
            color: #fff;
            line-height: 1.2;
        }

        .sa-toc__sub {
            font-size: 11px;
            color: rgba(255, 255, 255, 0.8);
            margin-top: 2px;
        }

        .sa-toc__list {
            list-style: none;
            margin: 0;
            padding: 10px 0;
        }

        .sa-toc__item {
            margin: 0;
        }

        .sa-toc__link {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            padding: 9px 18px;
            font-size: 13px;
            font-weight: 500;
            color: #475569;
            text-decoration: none;
            border-left: 3px solid transparent;
            transition: all 0.15s ease;
            line-height: 1.35;
        }

        .sa-toc__link:hover,
        .sa-toc__link.is-active {
            color: #0f2460;
            border-left-color: #1d4ed8;
            background: rgba(29, 78, 216, 0.08);
        }

        .sa-toc__dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            flex-shrink: 0;
            margin-top: 4px;
            border: 1px solid rgba(255, 255, 255, 0.8);
            box-shadow: 0 0 0 2px rgba(29, 78, 216, 0.18);
        }

        .sa-toc__dot--1 {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
        }

        .sa-toc__dot--2 {
            background: linear-gradient(135deg, #2563eb, #1e40af);
        }

        .sa-toc__dot--3 {
            background: linear-gradient(135deg, #1d4ed8, #0f2460);
        }

        .sa-toc__link.is-active .sa-toc__dot {
            box-shadow: 0 0 0 3px rgba(29, 78, 216, 0.25), 0 0 10px rgba(29, 78, 216, 0.22);
        }

        .sa-toc__text {
            display: block;
        }

        .sa-toc__item--l3,
        .sa-toc__item--l4,
        .sa-toc__item--l5,
        .sa-toc__item--l6 {
            display: none;
        }

        .sa-article {
            background: #fff;
            border: 1px solid #e4ebf7;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 26px rgba(15, 41, 95, 0.08);
            padding: 28px 30px;
        }

        .sa-meta {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
            margin-bottom: 16px;
            align-items: center;
        }

        .sa-chip {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 12px;
            color: #1e3a8a;
            background: #f2f7ff;
            border: 1px solid #d6e5ff;
            padding: 5px 11px;
            border-radius: 20px;
            font-weight: 500;
        }

        .sa-chip--cat {
            color: #1e40af;
            background: #eff6ff;
            border-color: #bfdbfe;
        }

        .bds-progress-wrap {
            height: 3px;
            background: #eef2ff;
            margin: 0 -30px 0;
        }

        .bds-progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #0f2460, #1d4ed8);
            width: 0%;
            transition: width 0.15s linear;
        }

        .sa-voice {
            border-radius: 12px;
            padding: 14px 16px;
            background: linear-gradient(110deg, #12306f 0%, #1d4ed8 100%);
            margin-bottom: 18px;
            color: #fff;
            margin-top: 18px;
        }

        .sa-voice__title {
            font-size: 1.05rem;
            font-weight: 700;
            margin-bottom: 12px;
        }

        .sa-voice__title span {
            font-weight: 500;
            color: rgba(255, 255, 255, 0.9);
            margin-left: 6px;
        }

        .sa-voice__controls {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sa-voice__play {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            border: none;
            background: #4f8dff;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            flex-shrink: 0;
            cursor: pointer;
        }

        .sa-voice__time,
        .sa-voice__total {
            font-size: 12px;
            min-width: 36px;
            color: #fff;
            font-weight: 500;
        }

        .sa-voice__progress,
        .sa-voice__volume {
            -webkit-appearance: none;
            appearance: none;
            height: 4px;
            background: rgba(255, 255, 255, 0.4);
            border-radius: 999px;
            outline: none;
        }

        .sa-voice__progress {
            flex: 1;
        }

        .sa-voice__volume {
            width: 90px;
        }

        .sa-voice__progress::-webkit-slider-thumb,
        .sa-voice__volume::-webkit-slider-thumb {
            -webkit-appearance: none;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background: #ff3b30;
            cursor: pointer;
        }

        .sa-voice__rate {
            border: none;
            border-radius: 8px;
            padding: 6px 8px;
            background: rgba(255, 255, 255, 0.24);
            color: #fff;
            font-weight: 600;
            font-size: 13px;
            min-width: 70px;
        }

        .sa-voice__rate option {
            background: #15306d;
            color: #fff;
        }

        .sa-voice__vol-icon {
            color: rgba(255, 255, 255, 0.95);
        }

        .sa-heroimg img {
            width: 100%;
            height: 360px;
            object-fit: cover;
            border-radius: 14px;
            border: 1px solid #d7e3f6;
            margin-bottom: 20px;
            box-shadow: 0 10px 22px rgba(15, 41, 95, 0.1);
        }

        .sa-prose {
            font-size: 1.03rem;
            line-height: 1.95;
            color: #334155;
        }

        .sa-prose h1,
        .sa-prose h2 {
            font-size: 1.28rem;
            font-weight: 700;
            color: #0f172a;
            margin: 2.2rem 0 0.85rem;
            padding-bottom: 8px;
            border-bottom: 1px solid #f1f5f9;
            scroll-margin-top: 30px;
        }

        .sa-prose h3 {
            font-size: 1.06rem;
            font-weight: 700;
            color: #1e293b;
            margin: 1.6rem 0 0.75rem;
            scroll-margin-top: 30px;
        }

        .sa-prose h4,
        .sa-prose h5,
        .sa-prose h6 {
            font-size: 0.95rem;
            font-weight: 700;
            color: #334155;
            margin: 1.3rem 0 0.6rem;
            scroll-margin-top: 30px;
        }

        .sa-prose p {
            margin-bottom: 1.35rem;
            text-align: left;
        }

        .sa-prose ul,
        .sa-prose ol {
            padding-left: 1.5rem !important;
            margin-bottom: 1.2rem;
            color: #374151;
            list-style-position: outside;
        }

        .sa-prose ul {
            list-style-type: disc !important;
        }

        .sa-prose ol {
            list-style-type: decimal !important;
        }

        .sa-prose li {
            margin-bottom: 0.5rem;
        }

        .sa-prose blockquote {
            background: #f8faff;
            border-left: 3px solid #3b82f6;
            border-radius: 0 10px 10px 0;
            padding: 14px 20px;
            margin: 1.8rem 0;
            font-style: italic;
            color: #475569;
            font-size: 0.98rem;
            line-height: 1.7;
        }

        .sa-prose img {
            max-width: 100%;
            height: auto;
            border-radius: 12px;
            margin: 1.5rem 0;
            box-shadow: 0 6px 20px rgba(10, 30, 80, 0.1);
            border: 1px solid #e2e8f3;
        }

        .sa-prose a {
            color: #1d4ed8;
            text-decoration: underline;
            text-underline-offset: 3px;
        }

        .sa-prose table {
            width: 100%;
            border-collapse: collapse;
            margin: 1.5rem 0;
            border: 1px solid #e2eaf8;
            border-radius: 10px;
            overflow: hidden;
            font-size: 14px;
            display: block;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .sa-prose table th {
            background: #f0f6ff;
            font-weight: 700;
            color: #1e3a8a;
            padding: 10px 14px;
            text-align: left;
            border-bottom: 1px solid #dde9f8;
        }

        .sa-prose table td {
            padding: 9px 14px;
            border-bottom: 1px solid #eef2fb;
            color: #374151;
        }

        .sa-prose table tr:last-child td {
            border-bottom: none;
        }

        .sa-prose code {
            background: #eff6ff;
            color: #1d4ed8;
            font-size: 0.88em;
            padding: 2px 7px;
            border-radius: 5px;
        }

        .sa-mid-section {
            margin: 1.75rem 0 1.9rem;
            border: 1px solid #d3deef;
            border-radius: 14px;
            background: linear-gradient(180deg, #eef4ff 0%, #e8effb 100%);
            padding: 18px;
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.9);
        }

        .sa-mid-section__title {
            font-size: 1.08rem;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 14px;
        }

        .sa-quickinfo__grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 16px;
        }

        .sa-quickinfo__card {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            background: linear-gradient(180deg, #ffffff 0%, #f7faff 100%);
            border: 1px solid #dbe4f5;
            border-radius: 14px;
            padding: 16px;
            transition: all 0.2s ease;
        }

        .sa-quickinfo__card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(29, 78, 216, 0.12);
        }

        .sa-quickinfo__icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: linear-gradient(135deg, #2349b7, #4458d8);
            color: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            flex-shrink: 0;
        }

        .sa-quickinfo__content {
            min-width: 0;
        }

        .sa-quickinfo__content h3 {
            font-size: 0.84rem;
            line-height: 1.35;
            margin: 0 0 6px;
            color: #64748b;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }

        .sa-quickinfo__content p {
            margin: 0;
            color: #0f172a;
            line-height: 1.55;
            font-size: 1rem;
            font-weight: 700;
            word-break: break-word;
        }

        .sa-highlights__list {
            list-style: none;
            margin: 0;
            padding: 0;
            display: grid;
            gap: 10px;
        }

        .sa-highlights__list li {
            display: flex;
            gap: 10px;
            align-items: flex-start;
            color: #1e293b;
            line-height: 1.7;
            padding: 12px 14px;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.92);
            border: 1px solid #dde6f5;
        }

        .sa-highlights__icon {
            color: #2563eb;
            font-size: 20px;
            line-height: 1;
            margin-top: 2px;
            flex-shrink: 0;
        }

        .bds-cta {
            position: relative;
            border-radius: 16px;
            padding: 22px 20px;
            background: linear-gradient(135deg, #0f2460 0%, #1d4ed8 100%);
            color: #fff;
            box-shadow: 0 12px 30px rgba(15, 36, 96, 0.25);
            border: 1px solid rgba(255, 255, 255, 0.22);
            overflow: hidden;
            transition: transform 0.24s ease, box-shadow 0.24s ease;
        }

        .bds-cta::before {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(120deg, rgba(255, 255, 255, 0.22) 0%, rgba(255, 255, 255, 0.06) 38%, rgba(255, 255, 255, 0) 70%);
            pointer-events: none;
        }

        .bds-cta:hover {
            transform: translateY(-3px);
            box-shadow: 0 16px 36px rgba(15, 36, 96, 0.33);
        }

        .bds-cta>* {
            position: relative;
            z-index: 1;
        }

        .bds-cta__tag {
            display: inline-block;
            font-size: 10px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            padding: 4px 12px;
            margin-bottom: 14px;
            color: rgba(255, 255, 255, 0.9);
        }

        .bds-cta__title,
        .sa-prose .bds-cta__title {
            color: #ffffff !important;
            font-size: 1.2rem;
            font-weight: 700;
            line-height: 1.3;
            margin-bottom: 10px;
            text-shadow: 0 2px 8px rgba(15, 36, 96, 0.28);
        }

        .bds-cta__body {
            font-size: 12.5px;
            line-height: 1.65;
            color: rgba(255, 255, 255, 0.85);
            margin-bottom: 18px;
        }

        .bds-cta__actions {
            display: flex;
            flex-direction: column;
            gap: 9px;
        }

        .bds-cta__btn {
            display: block;
            text-align: center;
            border-radius: 10px;
            padding: 11px 12px;
            font-size: 12.5px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.18s;
        }

        .bds-cta__btn--primary {
            background: #ffffff;
            color: #1e3a8a;
        }

        .bds-cta__btn--primary:hover {
            background: #eff6ff;
            color: #1e3a8a;
        }

        .bds-stats {
            display: flex;
            border-top: 1px solid #f1f5f9;
            border-bottom: 1px solid #f1f5f9;
            margin: 0 -30px;
        }

        .bds-stats__cell {
            flex: 1;
            padding: 13px 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 4px;
            border-right: 1px solid #f1f5f9;
            background: none;
            cursor: default;
        }

        .bds-stats__cell:last-child {
            border-right: none;
        }

        .bds-stats__cell--btn {
            cursor: pointer;
            border: none;
            transition: background 0.18s;
        }

        .bds-stats__cell--btn:hover {
            background: #f0f6ff;
        }

        .bds-stats__cell--btn:hover .bds-stats__icon {
            color: #1d4ed8;
        }

        .bds-stats__num {
            font-size: 15px;
            font-weight: 700;
            color: #1e293b;
        }

        .bds-stats__icon {
            font-size: 17px;
            color: #64748b;
        }

        .bds-stats__lbl {
            font-size: 11px;
            color: #94a3b8;
        }

        .bds-back {
            padding: 18px 0 4px;
        }

        .sa-faq-section {
            padding: 8px 0 30px;
            background: #f4f7fb;
        }

        .sa-faq-wrap {
            border: 1px solid #e2e8f3;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 8px 20px rgba(10, 30, 80, 0.07);
            padding: 24px;
        }

        .sa-faq__item {
            border: 1px solid #e2e8f3;
            border-radius: 12px !important;
            overflow: hidden;
            margin-bottom: 12px;
            background: #fff;
        }

        .sa-faq__item:last-child {
            margin-bottom: 0;
        }

        .sa-faq__btn {
            font-weight: 600;
            color: #1e3a8a;
            background: #fff;
            padding: 16px 18px;
            box-shadow: none !important;
        }

        .sa-faq__btn:not(.collapsed) {
            color: #1d4ed8;
            background: #eff6ff;
        }

        .sa-faq__body {
            color: #475569;
            line-height: 1.75;
            background: #f8fbff;
            padding: 16px 18px;
        }

        .sa-contact-section {
            padding: 0 0 58px;
            background: #f4f7fb;
            --grad: linear-gradient(135deg, #0038A6, #0046C4, #0058E8, #003070, #001F50);
        }

        .sa-contact-wrap {
            border-radius: 16px;
            border: 1px solid #dde7f5;
            background: #f6f8fc;
            box-shadow: 0 10px 28px rgba(15, 41, 95, 0.08);
            display: grid;
            grid-template-columns: minmax(0, 1.2fr) minmax(0, 0.95fr);
            gap: 28px;
            padding: 26px;
        }

        .sa-contact-form-col {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .sa-contact__line {
            max-width: 80px;
            margin-top: 2px;
        }

        .sa-contact__badge {
            display: inline-block;
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: #1e40af;
            background: #eff6ff;
            border: 1px solid #bfdbfe;
            border-radius: 20px;
            padding: 4px 10px;
            margin-bottom: 10px;
        }

        .sa-contact__title {
            font-size: 2.2rem;
            margin-bottom: 10px;
            font-weight: 700;
            color: #1f2937;
        }

        .sa-contact {
            border-radius: 16px;
            background: #ffffff;
            border: 1px solid #dbe6f6;
            padding: 22px;
        }

        .bds-contact-form-wrap .enrollNow-form__form {
            border: none;
            border-radius: 0;
            padding: 0;
            background: transparent;
            box-shadow: none;
            width: 100%;
        }

        .bds-contact-form-wrap input,
        .bds-contact-form-wrap select,
        .bds-contact-form-wrap textarea {
            border-radius: 10px;
            border: 1px solid #d6e1f3;
            background: #ffffff;
            padding: 10px 12px;
        }

        .bds-contact-form-wrap button.themebtu,
        .bds-contact-form-wrap .themebtu {
            width: 100%;
            text-align: center;
            margin-top: 6px;
        }

        .sa-contact-section .details-card {
            background: #fff;
            border-radius: 14px;
            padding: 25px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
            transition: all .3s ease;
            align-self: flex-start;
            margin-top: 96px;
        }

        .sa-contact-section .details-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 28px rgba(0, 0, 0, 0.15);
        }

        .sa-contact-section .details-card h4 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 16px;
            color: #1f2937;
        }

        .tp-guidance-copy {
            color: #64748b;
            font-size: 0.95rem;
            line-height: 1.75;
            margin-bottom: 16px;
        }

        .sa-contact-section .contact-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sa-contact-section .contact-list li a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 0;
            text-decoration: none;
            color: #333;
            font-size: 15px;
            transition: all .3s ease;
        }

        .sa-contact-section .contact-list li a:hover {
            color: #0038A6;
        }

        .sa-contact-section .contact-list i {
            width: 40px;
            height: 40px;
            background: #f3f3f3;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
            transition: all .4s ease;
        }

        .sa-contact-section .contact-list li:hover i {
            background: var(--grad);
            color: #fff;
            box-shadow: 0 0 12px rgba(0, 56, 166, 0.5);
        }

        @media print {

            .bds-progress-wrap,
            .bds-stats,
            .bds-back,
            .sa-voice {
                display: none !important;
            }
        }

        #quick-information-guide,
        #key-highlights,
        #blog-cta {
            scroll-margin-top: 30px;
        }

        @media (max-width: 1100px) {
            .sa-layout {
                grid-template-columns: 300px 1fr;
            }

            .sa-quickinfo__grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 992px) {
            .sa-layout {
                grid-template-columns: 1fr;
            }

            .tp-cta-grid {
                grid-template-columns: 1fr;
            }

            .sa-toc-col {
                position: static;
                order: -1;
            }

            .sa-article {
                order: 0;
            }

            .sa-contact-wrap {
                grid-template-columns: 1fr;
            }

            .sa-contact-section .details-card {
                margin-top: 0;
            }
        }

        @media (max-width: 576px) {
            .splash-title {
                font-size: 52px;
                padding-left: 10px;
                white-space: normal;
            }

            .sa-main {
                padding: 28px 0 20px;
            }

            .sa-article {
                padding: 18px;
            }

            .sa-heroimg img {
                height: 240px;
            }

            .sa-quickinfo__grid {
                grid-template-columns: 1fr;
            }

            .bds-stats {
                margin: 0 -18px;
            }

            .bds-progress-wrap {
                margin: 0 -18px 0;
            }

            .sa-voice__controls {
                flex-wrap: wrap;
                gap: 8px;
            }

            .sa-voice__progress {
                order: 3;
                width: calc(100% - 56px);
                flex: none;
            }
        }
    </style>

    @push('custom_js')
        <script>
            document.addEventListener('DOMContentLoaded', function() {

                var progressFill = document.getElementById('bdsProgress');
                var articleEl = document.querySelector('.sa-article');
                if (progressFill && articleEl) {
                    window.addEventListener('scroll', function() {
                        var rect = articleEl.getBoundingClientRect();
                        var total = articleEl.offsetHeight - window.innerHeight;
                        if (total <= 0) {
                            progressFill.style.width = '100%';
                            return;
                        }
                        var done = Math.max(0, -rect.top);
                        progressFill.style.width = Math.min(100, (done / total) * 100) + '%';
                    }, {
                        passive: true
                    });
                }

                var tocLinks = document.querySelectorAll('.sa-toc__link');
                if (tocLinks.length) {
                    var headings = Array.from(document.querySelectorAll(
                        '.sa-prose h1, .sa-prose h2, .sa-prose h3, #quick-information-guide, #key-highlights, #blog-cta'
                    ));

                    function updateTocActive(id) {
                        tocLinks.forEach(function(link) {
                            link.classList.remove('is-active');
                        });
                        var active = document.querySelector('.sa-toc__link[data-toc-id="' + id + '"]');
                        if (active) active.classList.add('is-active');
                    }

                    var observer = new IntersectionObserver(function(entries) {
                        entries.forEach(function(entry) {
                            if (entry.isIntersecting) updateTocActive(entry.target.id);
                        });
                    }, {
                        rootMargin: '0px 0px -60% 0px',
                        threshold: 0
                    });

                    headings.forEach(function(heading) {
                        if (heading.id) observer.observe(heading);
                    });

                    tocLinks.forEach(function(link) {
                        link.addEventListener('click', function(e) {
                            var id = this.getAttribute('data-toc-id');
                            var target = document.getElementById(id);
                            if (target) {
                                e.preventDefault();
                                updateTocActive(id);
                                target.scrollIntoView({
                                    behavior: 'smooth',
                                    block: 'start'
                                });
                            }
                        });
                    });

                    if (tocLinks[0]) updateTocActive(tocLinks[0].getAttribute('data-toc-id'));
                }

                var shareBtn = document.getElementById('bdsShareBtn');
                if (shareBtn) {
                    shareBtn.addEventListener('click', function() {
                        if (navigator.share) {
                            navigator.share({
                                title: document.title,
                                url: window.location.href
                            });
                        } else if (navigator.clipboard) {
                            navigator.clipboard.writeText(window.location.href).then(function() {
                                var lbl = shareBtn.querySelector('.bds-stats__lbl');
                                lbl.textContent = 'Copied!';
                                setTimeout(function() {
                                    lbl.textContent = 'Share';
                                }, 2000);
                            });
                        }
                    });
                }

                window.bdsPrintArticle = function() {
                    var article = document.querySelector('.sa-article');
                    if (!article) {
                        window.print();
                        return;
                    }
                    var printArticle = article.cloneNode(true);
                    printArticle.querySelectorAll('.bds-progress-wrap, .bds-stats, .bds-back, .sa-voice')
                        .forEach(function(node) {
                            node.remove();
                        });
                    var pw = window.open('', '_blank', 'width=900,height=700');
                    var styles = Array.from(document.querySelectorAll('link[rel="stylesheet"], style'))
                        .map(function(el) {
                            return el.outerHTML;
                        }).join('\n');
                    pw.document.write(
                        '<!DOCTYPE html><html><head><title>' + document.title + '</title>' +
                        styles + '</head><body style="padding:30px;font-family:Poppins,sans-serif">' +
                        printArticle.outerHTML + '</body></html>'
                    );
                    pw.document.close();
                    pw.focus();
                    pw.onload = function() {
                        pw.print();
                        pw.close();
                    };
                };

                initVoicePlayer('bdsVoice', '#bdsArticleProse');

                function initVoicePlayer(prefix, textSelector) {
                    var synth = window.speechSynthesis;
                    if (!synth) return;

                    var textEl = document.querySelector(textSelector);
                    var playBtn = document.getElementById(prefix + 'Play');
                    var playIcon = document.getElementById(prefix + 'PlayIcon');
                    var progress = document.getElementById(prefix + 'Progress');
                    var timeEl = document.getElementById(prefix + 'Time');
                    var totalEl = document.getElementById(prefix + 'Total');
                    var rateEl = document.getElementById(prefix + 'Rate');
                    var volumeEl = document.getElementById(prefix + 'Volume');

                    if (!textEl || !playBtn || !playIcon || !progress || !timeEl || !totalEl || !rateEl || !volumeEl)
                        return;

                    var text = (textEl.innerText || '').trim();
                    if (!text) return;

                    var utterance = null;
                    var isPaused = false;
                    var currentCharIndex = 0;
                    var isRestarting = false;
                    var totalSeconds = Math.max(30, Math.ceil(text.split(/\s+/).length / 160 * 60));
                    totalEl.textContent = formatTime(totalSeconds);

                    function speakFrom(charIndex) {
                        synth.cancel();
                        utterance = new SpeechSynthesisUtterance(text.slice(charIndex));
                        utterance.rate = parseFloat(rateEl.value || '1');
                        utterance.volume = parseFloat(volumeEl.value || '1');

                        utterance.onstart = function() {
                            playIcon.className = 'bi bi-pause-fill';
                            isPaused = false;
                        };
                        utterance.onboundary = function(event) {
                            if (!event || typeof event.charIndex !== 'number') return;
                            currentCharIndex = Math.min(text.length, charIndex + event.charIndex);
                            var pct = Math.min(100, (currentCharIndex / text.length) * 100);
                            progress.value = pct;
                            timeEl.textContent = formatTime(Math.floor((pct / 100) * totalSeconds));
                        };
                        utterance.onend = function() {
                            if (isRestarting) return;
                            playIcon.className = 'bi bi-play-fill';
                            progress.value = 100;
                            timeEl.textContent = totalEl.textContent;
                            isPaused = false;
                            currentCharIndex = text.length;
                        };
                        utterance.onerror = function() {
                            if (isRestarting) return;
                            playIcon.className = 'bi bi-play-fill';
                            isPaused = false;
                        };
                        synth.speak(utterance);
                    }

                    function restartFromCurrentPosition() {
                        if ((!synth.speaking && !isPaused) || currentCharIndex >= text.length) return;
                        isRestarting = true;
                        var resumeIndex = currentCharIndex;
                        synth.cancel();
                        window.setTimeout(function() {
                            isRestarting = false;
                            speakFrom(resumeIndex);
                        }, 40);
                    }

                    playBtn.addEventListener('click', function() {
                        if (synth.speaking && !isPaused) {
                            synth.pause();
                            isPaused = true;
                            playIcon.className = 'bi bi-play-fill';
                            return;
                        }
                        if (synth.speaking && isPaused) {
                            synth.resume();
                            isPaused = false;
                            playIcon.className = 'bi bi-pause-fill';
                            return;
                        }
                        if (currentCharIndex >= text.length) currentCharIndex = 0;
                        progress.value = 0;
                        timeEl.textContent = formatTime(Math.floor((currentCharIndex / text.length) *
                            totalSeconds));
                        speakFrom(currentCharIndex);
                    });

                    rateEl.addEventListener('change', restartFromCurrentPosition);
                    volumeEl.addEventListener('input', restartFromCurrentPosition);

                    function formatTime(seconds) {
                        return Math.floor(seconds / 60) + ':' + String(seconds % 60).padStart(2, '0');
                    }
                }
            });
        </script>
    @endpush
@endsection
