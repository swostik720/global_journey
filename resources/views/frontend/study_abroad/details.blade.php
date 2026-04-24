@extends('frontend.layouts.includes.master')
@section('maincontent')
    <section data-aos="fade-up" class="splash-area-section" style="background-image: url({{ asset('frontend/assets/img/background.jpg') }});">
        <div class="container">
            <div class="splash-area">
                @php
                    $parts = explode(' ', $study->title ?? '', 3);
                    $firstPart = isset($parts[0], $parts[1]) ? $parts[0] . ' ' . $parts[1] : $parts[0] ?? '';
                    $secondPart = $parts[2] ?? '';

                    $descriptionHtml = $study->description ?? '';
                    $tocItems = [];
                    $usedIds = [];
                    $generatedHeadingIndex = 0;

                    $descriptionWithAnchors = preg_replace_callback(
                        '/<h([1-6])([^>]*)>(.*?)<\/h\1>/is',
                        function ($matches) use (&$tocItems, &$usedIds, &$generatedHeadingIndex) {
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

                            $tocItems[] = ['id' => $id, 'text' => $text, 'level' => $level];

                            return '<h' . $level . $attributes . '>' . $innerHtml . '</h' . $level . '>';
                        },
                        $descriptionHtml
                    );
                @endphp

                <h1 class="splash-title">
                    {{ $firstPart }}@if ($secondPart) <span class="gradient-text">{{ $secondPart }}</span>@endif
                </h1>
            </div>
        </div>
    </section>

    <section data-aos="fade-up" class="sa-main">
        <div class="container">
            <div class="sa-layout {{ empty($tocItems) ? 'sa-layout--no-toc' : '' }}">
                @if (!empty($tocItems))
                    <aside class="sa-toc-col">
                        <div class="sa-toc">
                            <div class="sa-toc__head">
                                <div class="sa-toc__icon"><i class="bi bi-journal-bookmark-fill"></i></div>
                                <div>
                                    <div class="sa-toc__title">Contents</div>
                                    <div class="sa-toc__sub">Jump to section</div>
                                </div>
                            </div>
                            <ul class="sa-toc__list">
                                @foreach ($tocItems as $i => $tocItem)
                                    <li class="sa-toc__item sa-toc__item--l{{ $tocItem['level'] }}">
                                        <a href="#{{ $tocItem['id'] }}" class="sa-toc__link" data-toc-id="{{ $tocItem['id'] }}">
                                            <span class="sa-toc__dot sa-toc__dot--{{ ($i % 3) + 1 }}"></span>
                                            <span>{{ $tocItem['text'] }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </aside>
                @endif

                <article class="sa-article">
                    <div data-aos="zoom-in-up" data-aos-delay="140" class="sa-meta">
                        <span class="sa-chip"><i class="bi bi-globe-central-south-asia"></i> {{ $study->country->name ?? 'Study Destination' }}</span>
                        <span class="sa-chip"><i class="bi bi-mortarboard-fill"></i> Study Abroad Guide</span>
                    </div>

                    <div class="sa-voice" id="saVoicePlayer">
                        <div class="sa-voice__title">Listen to Article <span>Audio</span></div>
                        <div class="sa-voice__controls">
                            <button type="button" class="sa-voice__play" id="saVoicePlay" aria-label="Play audio">
                                <i class="bi bi-play-fill" id="saVoicePlayIcon"></i>
                            </button>
                            <div class="sa-voice__time" id="saVoiceTime">0:00</div>
                            <input type="range" id="saVoiceProgress" class="sa-voice__progress" min="0" max="100" value="0">
                            <select id="saVoiceRate" class="sa-voice__rate" aria-label="Speech speed">
                                <option value="0.8">0.8x</option>
                                <option value="1" selected>1x</option>
                                <option value="1.2">1.2x</option>
                                <option value="1.5">1.5x</option>
                            </select>
                            <i class="bi bi-volume-up-fill sa-voice__vol-icon"></i>
                            <input type="range" id="saVoiceVolume" class="sa-voice__volume" min="0" max="1" step="0.1" value="1">
                            <div class="sa-voice__total" id="saVoiceTotal">0:00</div>
                        </div>
                    </div>

                    <div class="sa-heroimg">
                        <img src="{{ $study->image_path ?? '' }}" alt="{{ $study->title }}" loading="eager">
                    </div>

                    <h1 class="sa-title">Why Study in {{ $study->country->name ?? '' }}?</h1>
                    <p class="sa-lead">{!! $study->short_description ?? '' !!}</p>

                    <div class="sa-prose" id="saArticleProse">{!! $descriptionWithAnchors !!}</div>
                </article>

                <aside class="sa-sidebar-col">
                    <div data-aos="zoom-in-up" data-aos-delay="140" class="sa-contact">
                        <div class="sa-contact__badge">Start Abroad Journey</div>
                        <h3 class="sa-contact__title">Let's Talk</h3>
                        <p class="sa-contact__sub">Get a personalized roadmap for admissions, documentation, and visa preparation.</p>
                        @if ($study->country)
                            @include('frontend.layouts.contact_form', ['default_country' => $study->country->name])
                        @else
                            @include('frontend.layouts.contact_form')
                        @endif
                    </div>
                </aside>
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
                        <img alt="line" src="{{ asset('frontend/assets/img/headingline.png') }}" class="img-fluid mt-2">
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
                                    aria-labelledby="studyFaqHead{{ $index }}" data-bs-parent="#studyAbroadFaqAccordion">
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

                <div class="swiper-pagination mt-4"></div>
            </div>
        </div>
    </section>

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
            padding: 48px 0 28px;
            background: #f4f7fb;
        }

        .sa-layout {
            display: grid;
            grid-template-columns: 240px minmax(0, 1fr) 300px;
            gap: 28px;
            align-items: start;
        }

        .sa-layout--no-toc {
            grid-template-columns: minmax(0, 1fr) 300px;
        }

        .sa-toc-col,
        .sa-sidebar-col {
            position: sticky;
            top: 24px;
            max-height: calc(100vh - 48px);
            overflow-y: auto;
            scrollbar-width: none;
        }

        .sa-toc-col::-webkit-scrollbar,
        .sa-sidebar-col::-webkit-scrollbar {
            display: none;
        }

        .sa-toc {
            background: #fff;
            border: 1px solid #e2e8f3;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 2px 14px rgba(10, 30, 80, 0.07);
        }

        .sa-toc__head {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 16px;
            background: #f7faff;
            border-bottom: 1px solid #e9eef8;
        }

        .sa-toc__icon {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: linear-gradient(135deg, #1e40af, #4f46e5);
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
            color: #1e293b;
            line-height: 1;
        }

        .sa-toc__sub {
            font-size: 11px;
            color: #94a3b8;
            margin-top: 3px;
        }

        .sa-toc__list {
            list-style: none;
            margin: 0;
            padding: 10px 0;
        }

        .sa-toc__link {
            display: flex;
            align-items: flex-start;
            gap: 9px;
            padding: 7px 16px;
            font-size: 12.5px;
            font-weight: 500;
            color: #64748b;
            text-decoration: none;
            border-left: 2px solid transparent;
            transition: all 0.18s ease;
            line-height: 1.4;
        }

        .sa-toc__link:hover,
        .sa-toc__link.is-active {
            color: #1e3a8a;
            border-left-color: #3b82f6;
            background: #f0f6ff;
        }

        .sa-toc__dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            margin-top: 4px;
            flex-shrink: 0;
        }

        .sa-toc__dot--1 { background: #3b82f6; }
        .sa-toc__dot--2 { background: #7c3aed; }
        .sa-toc__dot--3 { background: #db2777; }

        .sa-toc__item--l3 .sa-toc__link,
        .sa-toc__item--l4 .sa-toc__link,
        .sa-toc__item--l5 .sa-toc__link,
        .sa-toc__item--l6 .sa-toc__link {
            padding-left: 28px;
            font-size: 11.5px;
            font-weight: 400;
        }

        .sa-article {
            background: #fff;
            border: 1px solid #e2e8f3;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(10, 30, 80, 0.07);
            padding: 22px 24px 24px;
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
            background: #eff6ff;
            border: 1px solid #bfdbfe;
            padding: 5px 11px;
            border-radius: 20px;
            font-weight: 500;
        }

        .sa-voice {
            border-radius: 12px;
            padding: 16px;
            background: linear-gradient(105deg, #b80f44 0%, #7a145f 45%, #1e22be 100%);
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

        .sa-voice__progress { flex: 1; }
        .sa-voice__volume { width: 90px; }

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
        }

        .sa-voice__vol-icon {
            color: rgba(255, 255, 255, 0.95);
        }

        .sa-heroimg img {
            width: 100%;
            height: 360px;
            object-fit: cover;
            border-radius: 14px;
            border: 1px solid #e5eaf4;
            margin-bottom: 18px;
        }

        .sa-title {
            color: #0f172a;
            line-height: 1.25;
            margin-bottom: 12px;
            font-size: clamp(1.5rem, 2.2vw, 2rem);
            font-weight: 700;
        }

        .sa-lead {
            font-size: 1.03rem;
            line-height: 1.8;
            color: #475569;
            margin-bottom: 1rem;
        }

        .sa-prose {
            font-size: 1rem;
            line-height: 1.9;
            color: #334155;
        }

        .sa-prose h1,
        .sa-prose h2 {
            font-size: 1.2rem;
            font-weight: 700;
            color: #0f172a;
            margin: 2rem 0 0.85rem;
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
            margin-bottom: 1.2rem;
            text-align: justify;
        }

        .sa-prose ul,
        .sa-prose ol {
            padding-left: 1.5rem !important;
            margin-bottom: 1.2rem;
            color: #374151;
            list-style-position: outside;
        }

        .sa-prose ul { list-style-type: disc !important; }
        .sa-prose ol { list-style-type: decimal !important; }
        .sa-prose li { margin-bottom: 0.5rem; }

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

        .sa-prose table tr:last-child td { border-bottom: none; }

        .sa-contact {
            border-radius: 16px;
            background: #fff;
            border: 1px solid #e2e8f3;
            padding: 20px;
            box-shadow: 0 10px 28px rgba(10, 30, 80, 0.09);
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
            font-size: 1.35rem;
            margin-bottom: 8px;
            font-weight: 700;
            color: #0f172a;
        }

        .sa-contact__sub {
            color: #64748b;
            font-size: 0.9rem;
            line-height: 1.7;
            margin-bottom: 14px;
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
            border: 1px solid #dbe7ff;
            background: #f8fbff;
            padding: 10px 12px;
        }

        .sa-contact button.themebtu,
        .sa-contact .themebtu {
            width: 100%;
            text-align: center;
            margin-top: 6px;
        }

        .sa-faq-section {
            padding: 8px 0 52px;
            background: #f4f7fb;
        }

        .sa-faq-wrap {
            border: 1px solid #e2e8f3;
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 8px 28px rgba(10, 30, 80, 0.08);
            padding: 24px;
        }

        .sa-faq__item {
            border: 1px solid #e2e8f3;
            border-radius: 12px !important;
            overflow: hidden;
            margin-bottom: 12px;
            background: #fff;
        }

        .sa-faq__item:last-child { margin-bottom: 0; }

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

        @media (max-width: 1100px) {
            .sa-layout {
                grid-template-columns: 210px minmax(0, 1fr) 280px;
            }
        }

        @media (max-width: 992px) {
            .sa-layout {
                grid-template-columns: 1fr;
            }

            .sa-toc-col,
            .sa-sidebar-col {
                position: static;
                max-height: none;
                overflow-y: visible;
            }

            .sa-toc-col { order: -1; }
            .sa-article { order: 0; }
            .sa-sidebar-col { order: 1; }

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
                    loop: slideCount > 6,
                    loopAdditionalSlides: slideCount,
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
                    autoplay: {
                        delay: 3200,
                        disableOnInteraction: false
                    }
                });

                var tocLinks = document.querySelectorAll('.sa-toc__link');
                if (tocLinks.length) {
                    var headings = Array.from(document.querySelectorAll('.sa-prose h1, .sa-prose h2, .sa-prose h3, .sa-prose h4, .sa-prose h5, .sa-prose h6'));
                    var observer = new IntersectionObserver(function(entries) {
                        entries.forEach(function(entry) {
                            if (entry.isIntersecting) {
                                tocLinks.forEach(function(l) { l.classList.remove('is-active'); });
                                var active = document.querySelector('.sa-toc__link[data-toc-id="' + entry.target.id + '"]');
                                if (active) {
                                    active.classList.add('is-active');
                                }
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
                                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                            }
                        });
                    });
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
                    var totalSeconds = Math.max(30, Math.ceil(text.split(/\s+/).length / 160 * 60));
                    totalEl.textContent = formatTime(totalSeconds);

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

                        synth.cancel();
                        utterance = new SpeechSynthesisUtterance(text);
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
                            var pct = Math.min(100, (event.charIndex / text.length) * 100);
                            progress.value = pct;
                            var elapsed = Math.floor((pct / 100) * totalSeconds);
                            timeEl.textContent = formatTime(elapsed);
                        };

                        utterance.onend = function() {
                            playIcon.className = 'bi bi-play-fill';
                            progress.value = 100;
                            timeEl.textContent = totalEl.textContent;
                            isPaused = false;
                        };

                        utterance.onerror = function() {
                            playIcon.className = 'bi bi-play-fill';
                            isPaused = false;
                        };

                        progress.value = 0;
                        timeEl.textContent = '0:00';
                        synth.speak(utterance);
                    });

                    rateEl.addEventListener('change', function() {
                        if (utterance) {
                            utterance.rate = parseFloat(rateEl.value || '1');
                        }
                    });

                    volumeEl.addEventListener('input', function() {
                        if (utterance) {
                            utterance.volume = parseFloat(volumeEl.value || '1');
                        }
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
