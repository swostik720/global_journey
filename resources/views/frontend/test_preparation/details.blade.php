@extends('frontend.layouts.includes.master')
@section('maincontent')
    <section data-aos="fade-up" class="splash-area-section" style="background-image: url({{ asset('frontend/assets/img/background.jpg') }});">
        <div class="container">
            <div class="splash-area">
                @php
                    $parts = explode(' ', $testpreparation->title ?? '', 3);
                    $firstPart = isset($parts[0], $parts[1]) ? $parts[0] . ' ' . $parts[1] : $parts[0] ?? '';
                    $secondPart = $parts[2] ?? 'Preparation';

                    $descriptionHtml = $testpreparation->description ?? '';
                    $tocItems = [];
                    $usedIds = [];
                    $generatedHeadingIndex = 0;

                    $descriptionWithAnchors = preg_replace_callback(
                        '/<h([1-6])([^>]*)>(.*?)<\/h\1>/is',
                        function ($matches) use (&$tocItems, &$usedIds, &$generatedHeadingIndex) {
                            $level = (int) $matches[1];
                            $attributes = $matches[2] ?? '';
                            $innerHtml = $matches[3] ?? '';
                            $text = trim(html_entity_decode(strip_tags($innerHtml), ENT_QUOTES | ENT_HTML5, 'UTF-8'));
                            $text = preg_replace('/\x{00A0}/u', ' ', $text);
                            $text = preg_replace('/\s+/u', ' ', $text ?? '');

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

    <section data-aos="fade-up" class="tp-main">
        <div class="container">
            <div class="tp-layout {{ empty($tocItems) ? 'tp-layout--no-toc' : '' }}">
                @if (!empty($tocItems))
                    <aside class="tp-toc-col">
                        <div class="tp-toc">
                            <div class="tp-toc__head">
                                <div class="tp-toc__icon"><i class="bi bi-journal-bookmark-fill"></i></div>
                                <div>
                                    <div class="tp-toc__title">Contents</div>
                                    <div class="tp-toc__sub">Jump to section</div>
                                </div>
                            </div>
                            <ul class="tp-toc__list">
                                @foreach ($tocItems as $i => $tocItem)
                                    <li class="tp-toc__item tp-toc__item--l{{ $tocItem['level'] }}">
                                        <a href="#{{ $tocItem['id'] }}" class="tp-toc__link" data-toc-id="{{ $tocItem['id'] }}">
                                            <span class="tp-toc__dot tp-toc__dot--{{ ($i % 3) + 1 }}"></span>
                                            <span>{{ $tocItem['text'] }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </aside>
                @endif

                <article class="tp-article">
                    <div data-aos="zoom-in-up" data-aos-delay="140" class="tp-meta">
                        <span class="tp-chip"><i class="bi bi-journal-text"></i> {{ strtoupper($testpreparation->slug ?? 'TEST') }}</span>
                        <span class="tp-chip"><i class="bi bi-mortarboard-fill"></i> Test Preparation</span>
                    </div>

                    <div class="tp-voice" id="tpVoicePlayer">
                        <div class="tp-voice__title">Listen to Article <span>Audio</span></div>
                        <div class="tp-voice__controls">
                            <button type="button" class="tp-voice__play" id="tpVoicePlay" aria-label="Play audio">
                                <i class="bi bi-play-fill" id="tpVoicePlayIcon"></i>
                            </button>
                            <div class="tp-voice__time" id="tpVoiceTime">0:00</div>
                            <input type="range" id="tpVoiceProgress" class="tp-voice__progress" min="0" max="100" value="0">
                            <select id="tpVoiceRate" class="tp-voice__rate" aria-label="Speech speed">
                                <option value="0.8">0.8x</option>
                                <option value="1" selected>1x</option>
                                <option value="1.2">1.2x</option>
                                <option value="1.5">1.5x</option>
                            </select>
                            <i class="bi bi-volume-up-fill tp-voice__vol-icon"></i>
                            <input type="range" id="tpVoiceVolume" class="tp-voice__volume" min="0" max="1" step="0.1" value="1">
                            <div class="tp-voice__total" id="tpVoiceTotal">0:00</div>
                        </div>
                    </div>

                    <div class="tp-heroimg">
                        <img src="{{ $testpreparation->image_path ?? '' }}" alt="{{ $testpreparation->title }}" loading="eager">
                    </div>

                    <h1 class="tp-title">{{ $testpreparation->title }}</h1>
                    <p class="tp-lead">{!! $testpreparation->short_description ?? '' !!}</p>

                    <div class="tp-prose" id="tpArticleProse">{!! $descriptionWithAnchors !!}</div>
                </article>

                <aside class="tp-sidebar-col">
                    <div data-aos="zoom-in-up" data-aos-delay="140" class="tp-contact">
                        <div class="tp-contact__badge">Get Started</div>
                        <h3 class="tp-contact__title">Enroll Now</h3>
                        <p class="tp-contact__sub">Talk to our mentors and build a personalized study plan for your test date.</p>
                        @include('frontend.layouts.enrollNow_form', [
                            'default_title' => $testpreparation->title ?? null,
                            'testPreparationsOptions' => [1 => 'IELTS', 2 => 'PTE'],
                        ])
                    </div>

                    <div class="tp-course">
                        <h5>{{ strtoupper($testpreparation->slug ?? 'TEST') }} Course</h5>
                        <ul>
                            <li><i class="bi bi-check2-circle"></i> Complete classes with expert trainers</li>
                            <li><i class="bi bi-check2-circle"></i> Weekly mock tests and progress tracking</li>
                            <li><i class="bi bi-check2-circle"></i> Personalized feedback and doubt support</li>
                        </ul>
                        <a href="#" class="themebtu w-100 text-center">Book Now</a>
                    </div>

                    <div class="tp-explore">
                        <div class="tp-explore__head">
                            <i class="bi bi-mortarboard-fill"></i>
                            <div>
                                <h6>Curious about</h6>
                                <h4>{{ strtoupper($testpreparation->slug ?? 'TEST') }}</h4>
                            </div>
                        </div>
                        <p>
                            @if (($testpreparation->slug ?? '') === 'pte')
                                Explore the official PTE exam format, requirements, and latest updates directly from the source.
                            @else
                                Learn about official IELTS guidelines, modules, scoring, and current test updates.
                            @endif
                        </p>
                        <a href="{{ ($testpreparation->slug ?? '') === 'pte' ? 'https://pearsonpte.com/' : 'https://ielts.org/' }}" target="_blank"
                            rel="noopener" class="themebtu w-100 text-center">
                            Visit Official Website <i class="bi bi-box-arrow-up-right ms-2"></i>
                        </a>
                    </div>
                </aside>
            </div>
        </div>
    </section>

    @if (!empty($testpreparation->faqs))
        <section data-aos="fade-up" class="tp-faq-section">
            <div class="container">
            <div data-aos="zoom-in-up" data-aos-delay="140" class="tp-faq-wrap">
                    <div data-aos="fade-up" data-aos-delay="100" class="heading mb-4 text-center text-md-start">
                        <h6 class="text-primary">Common Questions</h6>
                        <h2 class="fw-bold">Test Preparation FAQs</h2>
                        <img alt="line" src="{{ asset('frontend/assets/img/headingline.png') }}" class="img-fluid mt-2">
                    </div>

                    <div class="accordion tp-faq" id="testPreparationFaqAccordion">
                        @foreach ($testpreparation->faqs as $index => $faq)
                            <div data-aos="zoom-in-up" data-aos-delay="140" class="accordion-item tp-faq__item">
                                <h2 class="accordion-header" id="testFaqHead{{ $index }}">
                                    <button class="accordion-button collapsed tp-faq__btn" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#testFaqBody{{ $index }}"
                                        aria-expanded="false" aria-controls="testFaqBody{{ $index }}">
                                        {{ $faq['question'] ?? 'Question' }}
                                    </button>
                                </h2>
                                <div id="testFaqBody{{ $index }}" class="accordion-collapse collapse"
                                    aria-labelledby="testFaqHead{{ $index }}" data-bs-parent="#testPreparationFaqAccordion">
                                    <div class="accordion-body tp-faq__body">
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
@endsection

@push('custom_css')
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

        .tp-main,
        .tp-faq-section,
        .tp-main *,
        .tp-faq-section * {
            font-family: "Poppins", sans-serif !important;
        }

        .tp-main {
            padding: 48px 0 28px;
            background: #f4f7fb;
        }

        .tp-layout {
            display: grid;
            grid-template-columns: 240px minmax(0, 1fr) 320px;
            gap: 28px;
            align-items: start;
        }

        .tp-layout--no-toc {
            grid-template-columns: minmax(0, 1fr) 320px;
        }

        .tp-toc-col,
        .tp-sidebar-col {
            position: sticky;
            top: 24px;
            max-height: calc(100vh - 48px);
            overflow-y: auto;
            scrollbar-width: none;
        }

        .tp-toc-col::-webkit-scrollbar,
        .tp-sidebar-col::-webkit-scrollbar {
            display: none;
        }

        .tp-toc {
            background: #fff;
            border: 1px solid #e2e8f3;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 2px 14px rgba(10, 30, 80, 0.07);
        }

        .tp-toc__head {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 16px;
            background: #f7faff;
            border-bottom: 1px solid #e9eef8;
        }

        .tp-toc__icon {
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

        .tp-toc__title {
            font-size: 14px;
            font-weight: 700;
            color: #1e293b;
            line-height: 1;
        }

        .tp-toc__sub {
            font-size: 11px;
            color: #94a3b8;
            margin-top: 3px;
        }

        .tp-toc__list {
            list-style: none;
            margin: 0;
            padding: 10px 0;
        }

        .tp-toc__link {
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

        .tp-toc__link:hover,
        .tp-toc__link.is-active {
            color: #1e3a8a;
            border-left-color: #3b82f6;
            background: #f0f6ff;
        }

        .tp-toc__dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            margin-top: 4px;
            flex-shrink: 0;
        }

        .tp-toc__dot--1 { background: #3b82f6; }
        .tp-toc__dot--2 { background: #7c3aed; }
        .tp-toc__dot--3 { background: #db2777; }

        .tp-toc__item--l3 .tp-toc__link,
        .tp-toc__item--l4 .tp-toc__link,
        .tp-toc__item--l5 .tp-toc__link,
        .tp-toc__item--l6 .tp-toc__link {
            padding-left: 28px;
            font-size: 11.5px;
            font-weight: 400;
        }

        .tp-article {
            background: #fff;
            border: 1px solid #e2e8f3;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(10, 30, 80, 0.07);
            padding: 22px 24px 24px;
        }

        .tp-meta {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
            margin-bottom: 16px;
        }

        .tp-chip {
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

        .tp-voice {
            border-radius: 12px;
            padding: 16px;
            background: linear-gradient(105deg, #b80f44 0%, #7a145f 45%, #1e22be 100%);
            margin-bottom: 18px;
            color: #fff;
        }

        .tp-voice__title {
            font-size: 1.05rem;
            font-weight: 700;
            margin-bottom: 12px;
        }

        .tp-voice__title span {
            font-weight: 500;
            color: rgba(255, 255, 255, 0.9);
            margin-left: 6px;
        }

        .tp-voice__controls {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .tp-voice__play {
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

        .tp-voice__time,
        .tp-voice__total {
            font-size: 12px;
            min-width: 36px;
            color: #fff;
            font-weight: 500;
        }

        .tp-voice__progress,
        .tp-voice__volume {
            -webkit-appearance: none;
            appearance: none;
            height: 4px;
            background: rgba(255, 255, 255, 0.4);
            border-radius: 999px;
            outline: none;
        }

        .tp-voice__progress { flex: 1; }
        .tp-voice__volume { width: 90px; }

        .tp-voice__progress::-webkit-slider-thumb,
        .tp-voice__volume::-webkit-slider-thumb {
            -webkit-appearance: none;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background: #ff3b30;
            cursor: pointer;
        }

        .tp-voice__rate {
            border: none;
            border-radius: 8px;
            padding: 6px 8px;
            background: rgba(255, 255, 255, 0.24);
            color: #fff;
            font-weight: 600;
            font-size: 13px;
        }

        .tp-voice__vol-icon {
            color: rgba(255, 255, 255, 0.95);
        }

        .tp-heroimg img {
            width: 100%;
            max-height: 460px;
            object-fit: cover;
            border-radius: 14px;
            margin-bottom: 18px;
            border: 1px solid #e2e8f3;
        }

        .tp-title {
            font-size: clamp(1.7rem, 1.45rem + 0.7vw, 2.2rem);
            line-height: 1.2;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 10px;
        }

        .tp-lead {
            color: #475569;
            font-size: 15px;
            line-height: 1.75;
            margin-bottom: 18px;
        }

        .tp-prose {
            color: #1f2937;
            font-size: 15px;
            line-height: 1.85;
        }

        .tp-prose ul,
        .tp-prose ol {
            margin: 0 0 1rem 1.3rem;
            padding-left: 1rem;
            list-style-position: outside;
        }

        .tp-prose li {
            margin-bottom: 0.45rem;
            display: list-item;
        }

        .tp-prose h2,
        .tp-prose h3,
        .tp-prose h4 {
            margin-top: 1.6rem;
            margin-bottom: 0.8rem;
            color: #0f172a;
            line-height: 1.3;
        }

        .tp-sidebar-col {
            display: grid;
            gap: 16px;
        }

        .tp-contact,
        .tp-course,
        .tp-explore {
            background: #fff;
            border: 1px solid #e2e8f3;
            border-radius: 16px;
            box-shadow: 0 2px 14px rgba(10, 30, 80, 0.07);
            padding: 18px;
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }

        .tp-contact:hover,
        .tp-course:hover,
        .tp-explore:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 26px rgba(30, 64, 175, 0.12);
        }

        .tp-contact__badge {
            display: inline-block;
            padding: 5px 10px;
            font-size: 11px;
            font-weight: 600;
            color: #1e3a8a;
            background: #e8f0ff;
            border-radius: 999px;
            margin-bottom: 8px;
        }

        .tp-contact__title {
            font-size: 1.25rem;
            margin: 0;
            color: #0f172a;
            font-weight: 700;
        }

        .tp-contact__sub {
            margin: 8px 0 14px;
            font-size: 13px;
            color: #64748b;
            line-height: 1.6;
        }

        .tp-contact .enrollNow-form__form .themebtu {
            width: 100%;
            display: inline-block;
            text-align: center;
        }

        .tp-course h5 {
            font-size: 1.03rem;
            font-weight: 700;
            color: #1e3a8a;
            margin-bottom: 12px;
        }

        .tp-course ul {
            list-style: none;
            padding: 0;
            margin: 0 0 14px;
            display: grid;
            gap: 10px;
        }

        .tp-course li {
            display: flex;
            align-items: flex-start;
            gap: 8px;
            color: #334155;
            font-size: 14px;
        }

        .tp-course li i {
            color: #2563eb;
            margin-top: 2px;
        }

        .tp-explore__head {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 10px;
        }

        .tp-explore__head i {
            font-size: 20px;
            color: #4f46e5;
            background: #ede9fe;
            width: 38px;
            height: 38px;
            border-radius: 50%;
            display: grid;
            place-items: center;
        }

        .tp-explore__head h6 {
            margin: 0;
            font-size: 12px;
            color: #64748b;
            font-weight: 500;
        }

        .tp-explore__head h4 {
            margin: 2px 0 0;
            font-size: 1.1rem;
            color: #0f172a;
            font-weight: 700;
        }

        .tp-explore p {
            margin: 0 0 14px;
            color: #475569;
            font-size: 14px;
            line-height: 1.7;
        }

        .tp-faq-section {
            background: #fff;
            padding: 24px 0 64px;
        }

        .tp-faq-wrap {
            background: #f8fbff;
            border: 1px solid #e2e8f3;
            border-radius: 18px;
            padding: 24px;
        }

        .tp-faq__item {
            border: 1px solid #dbe5f2;
            border-radius: 12px !important;
            overflow: hidden;
            margin-bottom: 10px;
        }

        .tp-faq__btn {
            font-weight: 600;
            color: #0f172a;
            background: #fff;
            box-shadow: none !important;
        }

        .tp-faq__btn:not(.collapsed) {
            color: #1e3a8a;
            background: #eff6ff;
        }

        .tp-faq__body {
            color: #334155;
            line-height: 1.8;
            font-size: 14px;
            background: #fff;
        }

        @media (max-width: 1199.98px) {
            .tp-layout,
            .tp-layout--no-toc {
                grid-template-columns: minmax(0, 1fr);
            }

            .tp-toc-col,
            .tp-sidebar-col {
                position: static;
                max-height: none;
                overflow: visible;
            }

            .tp-sidebar-col {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 767.98px) {
            .splash-title {
                font-size: 40px;
                padding-left: 10px;
                white-space: normal;
            }

            .tp-main {
                padding-top: 28px;
            }

            .tp-article {
                padding: 14px;
            }

            .tp-sidebar-col {
                grid-template-columns: minmax(0, 1fr);
            }

            .tp-voice__controls {
                flex-wrap: wrap;
                gap: 8px;
            }

            .tp-voice__progress {
                order: 5;
                width: 100%;
                flex: 0 0 100%;
            }
        }
    </style>
@endpush

@push('custom_js')
    <script>
        (function() {
            const tocLinks = Array.from(document.querySelectorAll('.tp-toc__link'));
            const sections = tocLinks
                .map(link => document.getElementById(link.dataset.tocId))
                .filter(Boolean);

            tocLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    const target = document.getElementById(this.dataset.tocId);
                    if (!target) {
                        return;
                    }

                    e.preventDefault();
                    const y = target.getBoundingClientRect().top + window.scrollY - 90;
                    window.scrollTo({
                        top: y,
                        behavior: 'smooth'
                    });
                });
            });

            const highlightToc = () => {
                if (!sections.length) {
                    return;
                }

                const scrollY = window.scrollY + 120;
                let current = sections[0];
                sections.forEach(sec => {
                    if (sec.offsetTop <= scrollY) {
                        current = sec;
                    }
                });

                tocLinks.forEach(link => {
                    link.classList.toggle('is-active', link.dataset.tocId === current.id);
                });
            };

            window.addEventListener('scroll', highlightToc, {
                passive: true
            });
            highlightToc();
        })();

        (function initVoicePlayer() {
            const article = document.getElementById('tpArticleProse');
            if (!article || !('speechSynthesis' in window)) {
                return;
            }

            const playBtn = document.getElementById('tpVoicePlay');
            const playIcon = document.getElementById('tpVoicePlayIcon');
            const progress = document.getElementById('tpVoiceProgress');
            const currentTimeEl = document.getElementById('tpVoiceTime');
            const totalTimeEl = document.getElementById('tpVoiceTotal');
            const rateEl = document.getElementById('tpVoiceRate');
            const volumeEl = document.getElementById('tpVoiceVolume');

            const fullText = article.innerText.replace(/\s+/g, ' ').trim();
            if (!fullText) {
                playBtn.disabled = true;
                return;
            }

            let utterance = null;
            let startTime = 0;
            let elapsed = 0;
            let timer = null;
            let isPlaying = false;
            const estimatedDuration = Math.max(10, Math.round(fullText.split(' ').length / 2.5));

            const formatTime = sec => {
                const s = Math.max(0, Math.floor(sec));
                const m = Math.floor(s / 60);
                const r = s % 60;
                return `${m}:${String(r).padStart(2, '0')}`;
            };

            const updateProgress = () => {
                if (!isPlaying) {
                    return;
                }

                elapsed = (Date.now() - startTime) / 1000;
                const pct = Math.min(100, (elapsed / estimatedDuration) * 100);
                progress.value = pct;
                currentTimeEl.textContent = formatTime(elapsed);
                totalTimeEl.textContent = formatTime(estimatedDuration);
            };

            const cleanup = () => {
                isPlaying = false;
                window.speechSynthesis.cancel();
                clearInterval(timer);
                timer = null;
                progress.value = 0;
                currentTimeEl.textContent = '0:00';
                totalTimeEl.textContent = formatTime(estimatedDuration);
                playIcon.className = 'bi bi-play-fill';
            };

            const speak = () => {
                utterance = new SpeechSynthesisUtterance(fullText);
                utterance.rate = parseFloat(rateEl.value) || 1;
                utterance.volume = parseFloat(volumeEl.value) || 1;

                utterance.onstart = () => {
                    isPlaying = true;
                    startTime = Date.now();
                    playIcon.className = 'bi bi-pause-fill';
                    clearInterval(timer);
                    timer = setInterval(updateProgress, 250);
                };

                utterance.onend = () => {
                    cleanup();
                };

                utterance.onerror = () => {
                    cleanup();
                };

                window.speechSynthesis.speak(utterance);
            };

            totalTimeEl.textContent = formatTime(estimatedDuration);

            playBtn.addEventListener('click', () => {
                if (isPlaying) {
                    cleanup();
                    return;
                }
                cleanup();
                speak();
            });

            rateEl.addEventListener('change', () => {
                if (isPlaying) {
                    cleanup();
                    speak();
                }
            });

            volumeEl.addEventListener('input', () => {
                if (utterance) {
                    utterance.volume = parseFloat(volumeEl.value) || 1;
                }
            });

            progress.addEventListener('input', () => {
                if (!isPlaying) {
                    return;
                }

                const seekTime = (parseFloat(progress.value) / 100) * estimatedDuration;
                cleanup();
                speak();

                setTimeout(() => {
                    startTime = Date.now() - seekTime * 1000;
                }, 200);
            });

            window.addEventListener('beforeunload', cleanup);
        })();
    </script>
@endpush
