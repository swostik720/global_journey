@extends('frontend.layouts.includes.master')
@section('meta_title', ($study->title ?? 'Study Abroad Details') . ' | ' . ($setting->name ?? config('app.name')))
@section('meta_description', html_entity_decode(strip_tags($study->short_description ?? ''), ENT_QUOTES | ENT_HTML5, 'UTF-8'))
@section('maincontent')
    @php
        $parts = explode(' ', $study->title ?? '', 3);
        $firstPart = isset($parts[0], $parts[1]) ? $parts[0] . ' ' . $parts[1] : $parts[0] ?? '';
        $secondPart = $parts[2] ?? '';

        $descriptionHtml = $study->description ?? '';
        $headingTocItems = [];
        $usedIds = [];
        $generatedHeadingIndex = 0;
        $quickInfoItems = collect($study->quick_info_items ?? [])
            ->map(function ($item) {
                return [
                    'icon' => trim((string) ($item['icon'] ?? 'bi bi-info-circle')),
                    'title' => trim((string) ($item['title'] ?? '')),
                    'value' => trim((string) ($item['value'] ?? '')),
                ];
            })
            ->filter(function ($item) {
                return $item['title'] !== '' || $item['value'] !== '';
            })
            ->values();

        $keyHighlights = collect($study->key_highlights ?? [])
            ->map(function ($item) {
                return trim((string) ($item['text'] ?? ''));
            })
            ->filter()
            ->values();

        $hasCta =
            filled($study->cta_title) ||
            filled($study->cta_description) ||
            (filled($study->cta_button_text) && filled($study->cta_button_url));

        $descriptionWithAnchors = preg_replace_callback(
            '/<h([1-6])([^>]*)>(.*?)<\/h\1>/is',
            function ($matches) use (&$headingTocItems, &$usedIds, &$generatedHeadingIndex) {
                $level = (int) $matches[1];
                $attributes = $matches[2] ?? '';
                $innerHtml = $matches[3] ?? '';
                $text = trim(strip_tags($innerHtml));

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
                    $baseId = 'study-section-' . $generatedHeadingIndex;
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

                $headingTocItems[] = ['id' => $id, 'text' => $text, 'level' => $level];

                return '<h' . $level . $attributes . '>' . $innerHtml . '</h' . $level . '>';
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
                    'text' => trim(strip_tags($headingMatch[3])),
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
                'id' => 'study-abroad-cta',
                'text' => filled($study->cta_title) ? $study->cta_title : 'Next Step',
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
                if ($headingMeta['level'] <= 2) {
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
    @endphp

    @include('frontend.layouts.includes.page_hero', [
        'eyebrow' => 'Study Abroad Details',
        'title' => trim($firstPart) . ' ',
        'accent' => $secondPart ?: null,
        'subtitle' => \Illuminate\Support\Str::words(html_entity_decode(strip_tags($study->short_description ?? ''), ENT_QUOTES | ENT_HTML5, 'UTF-8'), 24, '...'),
        'meta' => ['Global Admissions Guidance', 'Destination Planning', 'Visa & Documentation Support'],
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
                        <span class="sa-chip"><i class="bi bi-globe-central-south-asia"></i>
                            {{ $study->country->name ?? 'Study Destination' }}</span>
                        <span class="sa-chip"><i class="bi bi-mortarboard-fill"></i> Study Abroad Guide</span>
                    </div>

                    <div class="sa-voice" id="saVoicePlayer">
                        <div class="sa-voice__title">Listen to Article <span>Audio</span></div>
                        <div class="sa-voice__controls">
                            <button type="button" class="sa-voice__play" id="saVoicePlay" aria-label="Play audio">
                                <i class="bi bi-play-fill" id="saVoicePlayIcon"></i>
                            </button>
                            <div class="sa-voice__time" id="saVoiceTime">0:00</div>
                            <input type="range" id="saVoiceProgress" class="sa-voice__progress" min="0"
                                max="100" value="0">
                            <select id="saVoiceRate" class="sa-voice__rate" aria-label="Speech speed">
                                <option value="0.5">0.5x</option>
                                <option value="0.75">0.75x</option>
                                <option value="1" selected>1x</option>
                                <option value="1.25">1.25x</option>
                                <option value="1.5">1.5x</option>
                            </select>
                            <i class="bi bi-volume-up-fill sa-voice__vol-icon"></i>
                            <input type="range" id="saVoiceVolume" class="sa-voice__volume" min="0" max="1"
                                step="0.1" value="1">
                            <div class="sa-voice__total" id="saVoiceTotal">0:00</div>
                        </div>
                    </div>

                    <div class="sa-heroimg">
                        <img src="{{ $study->image_path ?? '' }}" alt="{{ $study->title }}" loading="eager">
                    </div>

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

                    <div class="sa-prose" id="saArticleProse">
                        @forelse ($articleSections as $sectionIndex => $articleSection)
                            {!! implode("\n", $articleSection['blocks']) !!}

                            @foreach ($dynamicSectionPositions[$sectionIndex + 1] ?? [] as $dynamicSection)
                                @if ($dynamicSection === 'cta')
                                    <section class="sa-mid-section bds-cta" id="study-abroad-cta">
                                        <div class="bds-cta__tag">Expert Guidance</div>
                                        @if (filled($study->cta_title))
                                            <h2 class="bds-cta__title">{{ $study->cta_title }}</h2>
                                        @endif
                                        @if (filled($study->cta_description))
                                            <p class="bds-cta__body">{{ $study->cta_description }}</p>
                                        @endif
                                        <div class="bds-cta__actions">
                                            @if (filled($study->cta_button_text) && filled($study->cta_button_url))
                                                <a href="{{ $study->cta_button_url }}" target="_blank"
                                                    rel="noopener noreferrer" class="bds-cta__btn bds-cta__btn--primary">
                                                    {{ $study->cta_button_text }} <i
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
                                    <section class="sa-mid-section bds-cta" id="study-abroad-cta">
                                        <div class="bds-cta__tag">Expert Guidance</div>
                                        @if (filled($study->cta_title))
                                            <h2 class="bds-cta__title">{{ $study->cta_title }}</h2>
                                        @endif
                                        @if (filled($study->cta_description))
                                            <p class="bds-cta__body">{{ $study->cta_description }}</p>
                                        @endif
                                        <div class="bds-cta__actions">
                                            @if (filled($study->cta_button_text) && filled($study->cta_button_url))
                                                <a href="{{ $study->cta_button_url }}" target="_blank"
                                                    rel="noopener noreferrer" class="bds-cta__btn bds-cta__btn--primary">
                                                    {{ $study->cta_button_text }} <i
                                                        class="bi bi-arrow-up-right-circle ms-1"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </section>
                                @endif
                            @endforeach
                        @endforelse
                    </div>
                </article>

            </div>
        </div>
    </section>

    @if (!empty($study->faqs))
        <section data-aos="fade-up" class="sa-faq-section">
            <div class="container">
                <div data-aos="zoom-in-up" data-aos-delay="140" class="sa-faq-wrap">
                    <div data-aos="fade-up" data-aos-delay="100" class="heading mb-4 text-center text-md-start">
                        <h6 class="text-primary">Common Questions</h6>
                        <h2 class="fw-bold">Study Abroad FAQs</h2>
                        <img alt="line" src="{{ asset('frontend/assets/img/headingline.png') }}"
                            class="img-fluid mt-2">
                    </div>

                    <div class="accordion sa-faq" id="studyAbroadFaqAccordion">
                        @foreach ($study->faqs as $index => $faq)
                            <div data-aos="zoom-in-up" data-aos-delay="140" class="accordion-item sa-faq__item">
                                <h2 class="accordion-header" id="studyFaqHead{{ $index }}">
                                    <button class="accordion-button collapsed sa-faq__btn" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#studyFaqBody{{ $index }}"
                                        aria-expanded="false" aria-controls="studyFaqBody{{ $index }}">
                                        {{ $faq['question'] ?? 'Question' }}
                                    </button>
                                </h2>
                                <div id="studyFaqBody{{ $index }}" class="accordion-collapse collapse"
                                    aria-labelledby="studyFaqHead{{ $index }}"
                                    data-bs-parent="#studyAbroadFaqAccordion">
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

    @include('frontend.layouts.includes.faq_schema', ['faqs' => $study->faqs ?? []])

    <section data-aos="fade-up" class="gap review-section" style="background: #f9f9f9; padding: 80px 0;">
        <div class="container">
            <div data-aos="fade-up" data-aos-delay="100" class="heading mb-5 text-center">
                <h6 class="text-secondary">Explore Your Study Abroad Journey</h6>
                <h2 class="fw-bold">Essential Steps & Resources</h2>
                <img alt="line" src="{{ asset('frontend/assets/img/headingline.png') }}" class="img-fluid mt-2">
            </div>

            @php
                $slides = [
                    [
                        'tag' => 'Checklist',
                        'title' => 'Document Checklist',
                        'location' => $country->name ?? 'Global Journey',
                        'image' => asset('assets/img/study_abroad_sliders/document_checklist.avif'),
                        'link' => route('frontend.study_abroad.document_checklist', $country->id),
                    ],
                    [
                        'tag' => 'Interview',
                        'title' => 'Interview Preparation',
                        'location' => $country->name ?? 'Global Journey',
                        'image' => asset('assets/img/study_abroad_sliders/interview_preperation.webp'),
                        'link' => !empty($interviewPreparationSlug)
                            ? route('interview-preparation.details', $interviewPreparationSlug)
                            : '#',
                        'disabled' => empty($interviewPreparationSlug),
                    ],
                    [
                        'tag' => 'Why Choose',
                        'title' => 'Why ' . ($country->name ?? 'Country'),
                        'location' => $country->name ?? 'Global Journey',
                        'image' => asset('assets/img/study_abroad_sliders/why_abroad.webp'),
                        'link' => route('frontend.study_abroad.why_country', $country->id),
                    ],
                    [
                        'tag' => 'Universities',
                        'title' => 'Colleges & Universities',
                        'location' => $country->name ?? 'Global Journey',
                        'image' => asset('assets/img/study_abroad_sliders/colleges_universities.png'),
                        'link' => route('frontend.study_abroad.college_and_university', $country->id),
                    ],
                    [
                        'tag' => 'Guide',
                        'title' => 'Country Guide',
                        'location' => $country->name ?? 'Global Journey',
                        'image' => asset('assets/img/study_abroad_sliders/guide.avif'),
                        'link' => route('frontend.study_abroad.country_guide', $country->id),
                    ],
                ];

                $defaultSlideIndex = 2;
            @endphp

            <div class="swiper studyAbroadSwiper sa-coverflow">
                <div class="swiper-wrapper">
                    @foreach ($slides as $slide)
                        <div class="swiper-slide">
                            <a href="{{ isset($slide['disabled']) && $slide['disabled'] ? '#' : $slide['link'] }}"
                                class="sa-slide-card {{ isset($slide['disabled']) && $slide['disabled'] ? 'sa-slide-card--disabled' : '' }}"
                                style="background-image: linear-gradient(to top, rgba(15, 32, 39, 0.92), rgba(15, 32, 39, 0.15), rgba(15, 32, 39, 0.0)), url('{{ $slide['image'] }}');">
                                <span class="sa-slide-card__tag">{{ $slide['tag'] }}</span>
                                <div class="sa-slide-card__body">
                                    <h4>{{ $slide['title'] }}</h4>
                                    <p>
                                        <i class="bi bi-geo-alt"></i>
                                        {{ $slide['location'] }}
                                    </p>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>

                <div class="sa-slider-controls">
                    <button type="button" class="sa-slider-btn sa-slider-btn--prev" aria-label="Previous slide">
                        <i class="bi bi-arrow-left"></i>
                    </button>
                    <div class="swiper-pagination mt-0"></div>
                    <button type="button" class="sa-slider-btn sa-slider-btn--next" aria-label="Next slide">
                        <i class="bi bi-arrow-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </section>

    @include('frontend.layouts.includes.contact_band', [
        'eyebrow' => 'Start Your Project With Us',
        'title' => "Let's Plan Your Next Move",
        'subtitle' => 'Ask about ' . $study->title . ' and get destination-specific guidance on admissions, documentation, and your study plan.',
        'default_country' => optional($study->country)->name,
    ])

        {{-- ============================================================
                 EXTRA CTAs
            ============================================================ --}}
    @include('frontend.layouts.take_next_step')

        {{-- ============================================================
                 STAY UPDATED
            ============================================================ --}}
    @include('frontend.layouts.stay_updated')


    <style>
        .splash-title {
            font-size: 70px;
            line-height: 1.1;
            margin: 0;
            padding-left: 50px;
            white-space: nowrap;
            font-family: "Poppins", sans-serif;
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

        .sa-main,
        .sa-faq-section,
        .review-section,
        .sa-main *,
        .sa-faq-section *,
        .review-section * {
            font-family: "Poppins", sans-serif !important;
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
            width: 100%;
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

        .sa-toc__item--l3 .sa-toc__index,
        .sa-toc__item--l4 .sa-toc__index,
        .sa-toc__item--l5 .sa-toc__index,
        .sa-toc__item--l6 .sa-toc__index {
            min-width: 20px;
            height: 20px;
            font-size: 9px;
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

        .sa-voice {
            border-radius: 12px;
            padding: 14px 16px;
            background: linear-gradient(110deg, #12306f 0%, #1d4ed8 100%);
            margin-bottom: 18px;
            color: #fff;
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

        .sa-mid-section {
            margin: 1.75rem 0 1.9rem;
            border: 1px solid #d3deef;
            border-radius: 14px;
            background: linear-gradient(180deg, #eef4ff 0%, #e8effb 100%);
            padding: 18px 18px;
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
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 10px;
        }

        .sa-quickinfo__card {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            background: #f7f9ff;
            border: 1px solid #dbe4f5;
            border-radius: 10px;
            padding: 10px 10px;
            min-height: 100%;
            transition: all 0.2s ease;
        }

        .sa-quickinfo__card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(29, 78, 216, 0.12);
        }

        .sa-quickinfo__icon {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            background: linear-gradient(135deg, #2349b7, #4458d8);
            color: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
            flex-shrink: 0;
        }

        .sa-quickinfo__content h3 {
            font-size: 0.9rem;
            line-height: 1.25;
            margin: 0 0 3px;
            color: #334155;
            font-weight: 600;
        }

        .sa-quickinfo__content p {
            margin: 0;
            color: #0f172a;
            line-height: 1.32;
            font-size: 0.95rem;
            font-weight: 600;
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
            backdrop-filter: blur(12px);
            color: #fff;
            box-shadow: 0 12px 30px rgba(15, 36, 96, 0.25);
            border: 1px solid rgba(255, 255, 255, 0.22);
            transition: transform 0.24s ease, box-shadow 0.24s ease;
            overflow: hidden;
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

        .bds-cta__title {
            color: #ffffff;
            font-size: 1.2rem;
            font-weight: 700;
            line-height: 1.3;
            margin-bottom: 10px;
            text-shadow: 0 2px 8px rgba(15, 36, 96, 0.28);
        }

        .sa-prose .bds-cta__title {
            color: #ffffff !important;
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

        .bds-cta__btn i {
            font-size: 1rem;
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

        #quick-information-guide,
        #key-highlights,
        #study-abroad-cta {
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

        .sa-contact {
            border-radius: 16px;
            background: #ffffff;
            border: 1px solid #dbe6f6;
            padding: 22px;
            box-shadow: none;
        }

        .sa-contact-section {
            padding: 0 0 58px;
            background: #f4f7fb;
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

        .sa-contact-wrap__intro {
            padding: 0;
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

        .sa-contact__sub {
            color: #64748b;
            font-size: 0.9rem;
            line-height: 1.7;
            margin-bottom: 14px;
        }

        .sa-contact-section {
            --grad: linear-gradient(135deg, #0038A6, #0046C4, #0058E8, #003070, #001F50);
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

        .sa-contact-section .details-card h5 {
            font-size: 1.15rem;
            font-weight: 700;
            margin: 14px 0 10px;
            color: #1f2937;
        }

        .sa-contact-section .details-card hr {
            border-color: #e5eaf2;
            margin: 16px 0;
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
            justify-content: center;
        }

        .sa-contact-section .contact-list li:hover i {
            background: var(--grad);
            color: #fff;
            box-shadow: 0 0 12px rgba(0, 56, 166, 0.5);
        }

        .sa-contact-section .social-links {
            list-style: none;
            display: flex;
            gap: 12px;
            padding: 0;
            margin: 12px 0 0 0;
        }

        .sa-contact-section .social-links li {
            list-style: none;
        }

        .sa-contact-section .social-links a {
            display: grid;
            place-content: center;
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: #f3f3f3;
            color: #333;
            font-size: 16px;
            transition: all .5s ease;
            background-size: 200% auto;
        }

        .sa-contact-section .social-links a:hover {
            background: var(--grad);
            color: #fff;
            transform: rotate(10deg) scale(1.1);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.2);
        }

        .sa-contact .contact-form__form {
            border: none;
            border-radius: 0;
            padding: 0;
            background: transparent;
            box-shadow: none;
            width: 100%;
        }

        .sa-contact input,
        .sa-contact select,
        .sa-contact textarea {
            border-radius: 10px;
            border: 1px solid #d6e1f3;
            background: #ffffff;
            padding: 10px 12px;
        }

        .sa-contact button.themebtu,
        .sa-contact .themebtu {
            width: 100%;
            text-align: center;
            margin-top: 6px;
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

        .sa-coverflow {
            width: 100%;
            padding-top: 20px;
            padding-bottom: 36px;
            overflow: visible;
        }

        .sa-coverflow .swiper-slide {
            width: 300px;
            height: 400px;
            filter: blur(1px);
            transition: filter 0.3s ease;
        }

        .sa-coverflow .swiper-slide-active {
            filter: blur(0);
        }

        .sa-slide-card {
            height: 100%;
            width: 100%;
            border-radius: 14px;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            align-items: flex-start;
            text-decoration: none;
            color: #fff;
            background-size: cover;
            background-position: center;
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }

        .sa-slide-card--disabled {
            pointer-events: none;
            opacity: 0.65;
        }

        .sa-slide-card__tag {
            text-transform: uppercase;
            color: #fff;
            background: rgba(59, 130, 246, 0.85);
            padding: 7px 18px 7px 20px;
            display: inline-block;
            border-radius: 0 20px 20px 0;
            letter-spacing: 1.5px;
            font-size: 0.72rem;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .sa-slide-card__body h4 {
            color: #fff;
            font-weight: 600;
            font-size: 1.25rem;
            line-height: 1.4;
            margin-bottom: 12px;
            padding: 0 22px;
        }

        .sa-slide-card__body p {
            color: rgba(255, 255, 255, 0.95);
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 0 22px 28px;
            margin: 0;
            font-size: 0.95rem;
        }

        .sa-coverflow .swiper-pagination-bullet,
        .sa-coverflow .swiper-pagination-bullet-active {
            background: #fff;
        }

        .sa-coverflow .swiper-pagination-bullet {
            opacity: 0.55;
        }

        .sa-coverflow .swiper-pagination-bullet-active {
            opacity: 1;
        }

        .sa-slider-controls {
            margin-top: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
        }

        .sa-slider-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 1px solid #cbdaf8;
            background: #fff;
            color: #1e3a8a;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
        }

        .sa-slider-btn:hover {
            background: #1e3a8a;
            color: #fff;
            border-color: #1e3a8a;
        }

        @media (max-width: 1100px) {
            .sa-layout {
                grid-template-columns: 300px 1fr;
            }
        }

        @media (max-width: 992px) {
            .sa-layout {
                grid-template-columns: 1fr;
            }

            .sa-quickinfo__grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .sa-toc-col {
                position: static;
                max-height: none;
                overflow-y: visible;
            }

            .sa-toc {
                max-height: none;
                overflow-y: visible;
            }

            .sa-toc-col {
                order: -1;
            }

            .sa-article {
                order: 0;
            }

            .sa-contact-wrap {
                grid-template-columns: 1fr;
            }

            .sa-contact-section .details-card h4 {
                font-size: 1.45rem;
            }

            .sa-contact-section .details-card {
                margin-top: 0;
            }

            section.review-section {
                padding: 60px 0 !important;
            }
        }

        @media (max-width: 576px) {
            .splash-title {
                font-size: 52px;
                padding-left: 10px;
                white-space: normal;
            }

            .heading h2 {
                font-size: 1.6rem;
            }

            .heading h6 {
                font-size: 0.9rem;
            }

            .sa-main {
                padding: 28px 0 20px;
            }

            .sa-article {
                padding: 18px;
            }

            .sa-toc {
                border-radius: 14px;
            }

            .sa-faq-wrap {
                padding: 18px;
            }

            .sa-heroimg img {
                height: 240px;
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

            .sa-coverflow .swiper-slide {
                width: 260px;
                height: 360px;
            }

            .sa-quickinfo__grid {
                grid-template-columns: 1fr;
            }

            .sa-quickinfo__icon {
                font-size: 24px;
            }

            .sa-quickinfo__content p {
                font-size: 1.05rem;
            }

            .sa-mid-section,
            .sa-cta {
                padding: 16px;
            }

            .sa-contact-wrap {
                padding: 16px;
                border-radius: 16px;
            }
        }
    </style>

    @push('custom_js')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var slideCount = document.querySelectorAll('.studyAbroadSwiper .swiper-slide').length;

                new Swiper('.studyAbroadSwiper', {
                    effect: 'coverflow',
                    centeredSlides: true,
                    slidesPerView: 'auto',
                    spaceBetween: 60,
                    grabCursor: true,
                    loop: false,
                    initialSlide: {{ $defaultSlideIndex }},
                    watchSlidesProgress: true,
                    allowTouchMove: true,
                    simulateTouch: true,
                    touchStartPreventDefault: false,
                    coverflowEffect: {
                        rotate: 0,
                        stretch: 0,
                        depth: 100,
                        modifier: 2,
                        slideShadows: true
                    },
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true
                    },
                    navigation: {
                        nextEl: '.sa-slider-btn--next',
                        prevEl: '.sa-slider-btn--prev'
                    }
                });

                var tocLinks = document.querySelectorAll('.sa-toc__link');
                if (tocLinks.length) {
                    var headings = Array.from(document.querySelectorAll(
                        '.sa-prose h1, .sa-prose h2, .sa-prose h3, .sa-prose h4, .sa-prose h5, .sa-prose h6, #quick-information-guide, #key-highlights, #study-abroad-cta'
                    ));

                    function updateTocActive(id) {
                        tocLinks.forEach(function(l) {
                            l.classList.remove('is-active');
                        });
                        var active = document.querySelector('.sa-toc__link[data-toc-id="' + id + '"]');
                        if (!active) {
                            return;
                        }
                        active.classList.add('is-active');
                    }

                    var observer = new IntersectionObserver(function(entries) {
                        entries.forEach(function(entry) {
                            if (entry.isIntersecting) {
                                updateTocActive(entry.target.id);
                            }
                        });
                    }, {
                        rootMargin: '0px 0px -60% 0px',
                        threshold: 0
                    });
                    headings.forEach(function(h) {
                        if (h.id) {
                            observer.observe(h);
                        }
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

                    updateTocActive(tocLinks[0].getAttribute('data-toc-id'));
                }

                initVoicePlayer('saVoice', '#saArticleProse');

                function initVoicePlayer(prefix, textSelector) {
                    var synth = window.speechSynthesis;
                    if (!synth) {
                        return;
                    }

                    var textEl = document.querySelector(textSelector);
                    var playBtn = document.getElementById(prefix + 'Play');
                    var playIcon = document.getElementById(prefix + 'PlayIcon');
                    var progress = document.getElementById(prefix + 'Progress');
                    var timeEl = document.getElementById(prefix + 'Time');
                    var totalEl = document.getElementById(prefix + 'Total');
                    var rateEl = document.getElementById(prefix + 'Rate');
                    var volumeEl = document.getElementById(prefix + 'Volume');

                    if (!textEl || !playBtn || !playIcon || !progress || !timeEl || !totalEl || !rateEl || !volumeEl) {
                        return;
                    }

                    var text = (textEl.innerText || '').trim();
                    if (!text) {
                        return;
                    }

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
                            if (!event || typeof event.charIndex !== 'number') {
                                return;
                            }

                            currentCharIndex = Math.min(text.length, charIndex + event.charIndex);

                            var pct = Math.min(100, (currentCharIndex / text.length) * 100);
                            progress.value = pct;
                            var elapsed = Math.floor((pct / 100) * totalSeconds);
                            timeEl.textContent = formatTime(elapsed);
                        };

                        utterance.onend = function() {
                            if (isRestarting) {
                                return;
                            }

                            playIcon.className = 'bi bi-play-fill';
                            progress.value = 100;
                            timeEl.textContent = totalEl.textContent;
                            isPaused = false;
                            currentCharIndex = text.length;
                        };

                        utterance.onerror = function() {
                            if (isRestarting) {
                                return;
                            }

                            playIcon.className = 'bi bi-play-fill';
                            isPaused = false;
                        };

                        synth.speak(utterance);
                    }

                    function restartFromCurrentPosition() {
                        if ((!synth.speaking && !isPaused) || currentCharIndex >= text.length) {
                            return;
                        }

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

                        if (currentCharIndex >= text.length) {
                            currentCharIndex = 0;
                        }

                        progress.value = 0;
                        timeEl.textContent = formatTime(Math.floor((currentCharIndex / text.length) *
                            totalSeconds));
                        speakFrom(currentCharIndex);
                    });

                    rateEl.addEventListener('change', function() {
                        restartFromCurrentPosition();
                    });

                    volumeEl.addEventListener('input', function() {
                        restartFromCurrentPosition();
                    });

                    function formatTime(seconds) {
                        var m = Math.floor(seconds / 60);
                        var s = seconds % 60;
                        return m + ':' + String(s).padStart(2, '0');
                    }
                }
            });
        </script>
    @endpush
@endsection

