                                <section data-aos="fade-up" class="gap no-bottom gj-consultancy-intro">
                                    <div class="container">
                                        @php
                                            $studyItems = collect($studyabroads ?? []);
                                            $normalizeCountryString = static function (?string $value): string {
                                                $value = strtolower(trim((string) $value));
                                                $value = str_replace(['-', '_'], ' ', $value);
                                                $value = preg_replace('/[^a-z\s]/u', ' ', $value);
                                                $value = preg_replace('/\s+/u', ' ', (string) $value);
                                                $value = trim((string) preg_replace('/^study\s+in\s+/u', '', (string) $value));

                                                return trim((string) preg_replace('/\s+/u', ' ', (string) $value));
                                            };

                                            $findCountryUrl = function (array $keywords) use ($studyItems, $normalizeCountryString) {
                                                $normalizedKeywords = collect($keywords)
                                                    ->map(fn($keyword) => $normalizeCountryString((string) $keyword))
                                                    ->filter()
                                                    ->values()
                                                    ->all();

                                                $match = $studyItems->first(function ($item) use ($normalizeCountryString, $normalizedKeywords) {
                                                    $countryName = $normalizeCountryString((string) optional($item->country)->name);
                                                    $title = $normalizeCountryString((string) ($item->title ?? ''));
                                                    $slug = $normalizeCountryString((string) ($item->slug ?? ''));

                                                    foreach ($normalizedKeywords as $keyword) {
                                                        $isShortKeyword = strlen(str_replace(' ', '', (string) $keyword)) < 4;

                                                        if ($isShortKeyword) {
                                                            if ($countryName === $keyword || $title === $keyword || $slug === $keyword) {
                                                                return true;
                                                            }

                                                            continue;
                                                        }

                                                        if (
                                                            ($countryName !== '' && str_contains($countryName, $keyword)) ||
                                                            ($title !== '' && str_contains($title, $keyword)) ||
                                                            ($slug !== '' && str_contains($slug, $keyword))
                                                        ) {
                                                            return true;
                                                        }
                                                    }

                                                    return false;
                                                });

                                                return !empty($match?->slug) ? route('study-abroad.details', $match->slug) : route('study-abroad');
                                            };

                                            $countryUrls = [
                                                'usa' => $findCountryUrl(['usa', 'united states', 'america']),
                                                'uk' => $findCountryUrl(['uk', 'united kingdom', 'england', 'britain']),
                                                'new_zealand' => $findCountryUrl(['new zealand', 'newzealand']),
                                                'australia' => $findCountryUrl(['australia']),
                                                'canada' => $findCountryUrl(['canada']),
                                            ];
                                        @endphp

                                        <div class="tp-hero__shapes gj-consultancy-intro__shapes">
                                            <div class="style-shapes-1"></div>
                                            <div class="style-shapes-2">
                                                <img alt="shape" src="{{ asset('frontend/assets/img/shap-4.png') }}">
                                            </div>
                                            <div class="style-shapes-5">
                                                <img alt="shape" src="{{ asset('frontend/assets/img/shap-1.png') }}">
                                            </div>
                                        </div>

                                        <div class="row align-items-center justify-content-center g-lg-5 g-4 gj-consultancy-intro__row">
                                            <div class="col-xl-5 col-lg-6 order-2 order-lg-1">
                                                <div data-aos="fade-right" data-aos-delay="120" class="gj-consultancy-intro__content">
                                                    <div class="gj-consultancy-intro__eyebrow">Trusted Education Consultancy in Nepal</div>
                                                    <h2>THE BRIDGE TO <span>GLOBAL SUCCESS</span></h2>
                                                    <div class="gj-consultancy-intro__subline">From Nepal to the World. We Are With You Every Step.</div>
                                                    <p>
                                                        Global Journey Education Services is a trusted study abroad consultancy in <strong>Putalisadak, Kathmandu, Nepal</strong>, helping students choose the right destination, university, and course with honest and personalized guidance.
                                                    </p>
                                                    <p>
                                                        We provide complete support for counseling, applications, test preparation, and visa processing for students planning for
                                                        <a href="{{ $countryUrls['usa'] }}" class="gj-country-link">USA</a>,
                                                        <a href="{{ $countryUrls['uk'] }}" class="gj-country-link">UK</a>,
                                                        <a href="{{ $countryUrls['new_zealand'] }}" class="gj-country-link">New Zealand</a>,
                                                        <a href="{{ $countryUrls['australia'] }}" class="gj-country-link">Australia</a>, and
                                                        <a href="{{ $countryUrls['canada'] }}" class="gj-country-link">Canada</a>.
                                                    </p>
                                                    <a href="{{ route('contact-us') }}" class="themebtu gj-consultancy-intro__btn">Book A Free Consultation <i class="bi bi-arrow-right"></i></a>
                                                </div>
                                            </div>

                                            <div class="col-xl-5 col-lg-6 order-1 order-lg-2">
                                                <div data-aos="zoom-in-up" data-aos-delay="180" class="gj-consultancy-intro__visual">
                                                    <div class="gj-consultancy-intro__frame">
                                                        <img src="{{ asset('frontend/assets/img/best_consultancy.png') }}" alt="Global Journey Study Abroad Guidance">
                                                    </div>

                                                    <a href="{{ $countryUrls['usa'] }}" class="gj-country-tag gj-country-tag--usa"><span class="gj-country-flag" aria-hidden="true">🇺🇸</span><span>USA</span></a>
                                                    <a href="{{ $countryUrls['new_zealand'] }}" class="gj-country-tag gj-country-tag--newzealand"><span class="gj-country-flag" aria-hidden="true">🇳🇿</span><span>New Zealand</span></a>
                                                    <a href="{{ $countryUrls['canada'] }}" class="gj-country-tag gj-country-tag--canada"><span class="gj-country-flag" aria-hidden="true">🇨🇦</span><span>Canada</span></a>
                                                    <a href="{{ $countryUrls['australia'] }}" class="gj-country-tag gj-country-tag--australia"><span class="gj-country-flag" aria-hidden="true">🇦🇺</span><span>Australia</span></a>
                                                    <a href="{{ $countryUrls['uk'] }}" class="gj-country-tag gj-country-tag--uk"><span class="gj-country-flag" aria-hidden="true">🇬🇧</span><span>UK</span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>

                                <style>
                                    .gj-consultancy-intro {
                                        background: linear-gradient(180deg, #ffffff 0%, #f7faff 100%);
                                        padding: 64px 0 34px;
                                        position: relative;
                                        overflow: hidden;
                                    }

                                    .gj-consultancy-intro .container {
                                        position: relative;
                                        z-index: 1;
                                    }

                                    .gj-consultancy-intro__shapes {
                                        pointer-events: none;
                                    }

                                    .gj-consultancy-intro__row {
                                        max-width: 1160px;
                                        margin-inline: auto;
                                    }

                                    .gj-consultancy-intro__content {
                                        max-width: 520px;
                                        border: 1px solid transparent;
                                        border-radius: 20px;
                                        padding: 14px 16px;
                                        transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
                                    }

                                    .gj-consultancy-intro__content:hover {
                                        transform: translateY(-5px);
                                        border-color: rgba(23, 67, 150, 0.14);
                                        box-shadow: 0 14px 30px rgba(10, 39, 96, 0.1);
                                    }

                                    .gj-consultancy-intro__eyebrow {
                                        font-size: 0.82rem;
                                        font-weight: 700;
                                        text-transform: uppercase;
                                        letter-spacing: 0.08em;
                                        color: #1f2f69;
                                        margin-bottom: 10px;
                                    }

                                    .gj-consultancy-intro__content h2 {
                                        font-size: clamp(2rem, 4vw, 3.35rem);
                                        line-height: 1.02;
                                        color: #031252;
                                        font-weight: 800;
                                        margin-bottom: 10px;
                                        letter-spacing: -0.03em;
                                    }

                                    .gj-consultancy-intro__content h2 span {
                                        display: block;
                                        font-size: 1.12em;
                                    }

                                    .gj-consultancy-intro__subline {
                                        position: relative;
                                        color: #20427d;
                                        font-size: 1.02rem;
                                        font-weight: 600;
                                        line-height: 1.5;
                                        margin-bottom: 16px;
                                        max-width: 420px;
                                        padding-left: 18px;
                                    }

                                    .gj-consultancy-intro__subline::before {
                                        content: '';
                                        position: absolute;
                                        left: 0;
                                        top: 50%;
                                        transform: translateY(-50%);
                                        width: 4px;
                                        height: 70%;
                                        border-radius: 999px;
                                        background: linear-gradient(135deg, #0038A6, #0046C4, #0058E8, #003070, #001F50);
                                    }

                                    .gj-consultancy-intro__content p {
                                        color: #46556f;
                                        line-height: 1.72;
                                        font-size: 0.98rem;
                                        margin-bottom: 12px;
                                        max-width: 500px;
                                    }

                                    .gj-country-link {
                                        color: #154fa6;
                                        font-weight: 700;
                                        text-decoration: none;
                                        border-bottom: 2px solid rgba(21, 79, 166, 0.35);
                                        transition: color 0.2s ease, border-color 0.2s ease;
                                    }

                                    .gj-country-link:hover {
                                        color: #1d4ed8;
                                        border-color: rgba(29, 78, 216, 0.42);
                                    }

                                    .gj-consultancy-intro__btn {
                                        margin-top: 14px;
                                        display: inline-flex;
                                        align-items: center;
                                        gap: 8px;
                                    }

                                    .gj-consultancy-intro__visual {
                                        position: relative;
                                        max-width: 560px;
                                        margin-inline: auto;
                                        padding: 10px;
                                    }

                                    .gj-consultancy-intro__frame {
                                        border: 1px solid rgba(15, 36, 96, 0.08);
                                        border-radius: 28px;
                                        overflow: hidden;
                                        background: #ffffff;
                                        box-shadow: 0 24px 52px rgba(15, 36, 96, 0.14);
                                        transition: transform 0.35s ease, box-shadow 0.35s ease;
                                    }

                                    .gj-consultancy-intro__visual:hover .gj-consultancy-intro__frame {
                                        transform: translateY(-6px);
                                        box-shadow: 0 30px 56px rgba(15, 36, 96, 0.2);
                                    }

                                    .gj-consultancy-intro__frame img {
                                        width: 100%;
                                        height: auto;
                                        object-fit: contain;
                                        display: block;
                                        transition: transform 0.45s ease;
                                    }

                                    .gj-consultancy-intro__visual:hover .gj-consultancy-intro__frame img {
                                        transform: scale(1.03);
                                    }

                                    .gj-country-tag {
                                        position: absolute;
                                        z-index: 3;
                                        background: rgba(255, 255, 255, 0.96);
                                        border: 1px solid #e6e9f0;
                                        border-radius: 14px;
                                        box-shadow: 0 12px 24px rgba(15, 36, 96, 0.12);
                                        padding: 9px 14px;
                                        min-width: 132px;
                                        display: inline-flex;
                                        align-items: center;
                                        gap: 8px;
                                        text-decoration: none;
                                        transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease;
                                    }

                                    .gj-country-flag {
                                        display: inline-block;
                                        font-size: 0.92rem;
                                        line-height: 1;
                                    }

                                    .gj-country-tag:hover {
                                        transform: translateY(-4px) scale(1.02);
                                        border-color: rgba(21, 79, 166, 0.3);
                                        box-shadow: 0 16px 30px rgba(15, 36, 96, 0.16);
                                    }

                                    .gj-country-tag--australia:hover,
                                    .gj-country-tag--uk:hover {
                                        transform: translateY(calc(-50% - 4px)) scale(1.02);
                                    }

                                    .gj-country-tag span {
                                        color: #3f4f76;
                                        font-size: 0.95rem;
                                        font-weight: 600;
                                    }

                                    .gj-country-tag--usa { top: 22px; right: 0; }
                                    .gj-country-tag--newzealand { top: 84px; right: 0; }
                                    .gj-country-tag--canada { top: 146px; left: 0; }
                                    .gj-country-tag--australia { top: 50%; left: 0; transform: translateY(-50%); }
                                    .gj-country-tag--uk { top: 70%; right: 0; transform: translateY(-50%); }

                                    @media (max-width: 1399px) {
                                        .gj-country-tag--newzealand { right: -12px; }
                                    }

                                    @media (max-width: 991px) {
                                        .gj-consultancy-intro {
                                            padding: 50px 0 24px;
                                        }

                                        .gj-consultancy-intro__content {
                                            max-width: 100%;
                                            text-align: center;
                                            margin-inline: auto;
                                        }

                                        .gj-consultancy-intro__content:hover {
                                            transform: translateY(-3px);
                                        }

                                        .gj-consultancy-intro__subline,
                                        .gj-consultancy-intro__content p {
                                            max-width: 100%;
                                        }

                                        .gj-consultancy-intro__subline {
                                            display: inline-block;
                                            text-align: left;
                                        }

                                        .gj-country-tag {
                                            min-width: auto;
                                            padding: 8px 11px;
                                            max-width: 44%;
                                        }

                                        .gj-country-tag span {
                                            font-size: 0.86rem;
                                        }

                                        .gj-country-tag--usa { top: 18px; right: 0; }
                                        .gj-country-tag--newzealand { top: 58px; right: 0; }
                                        .gj-country-tag--canada { top: 98px; left: 0; }
                                        .gj-country-tag--australia { top: 50%; left: 0; transform: translateY(-50%); }
                                        .gj-country-tag--uk { top: 70%; right: 0; transform: translateY(-50%); }
                                        .gj-consultancy-intro__btn {
                                            justify-content: center;
                                        }
                                    }

                                    @media (max-width: 576px) {
                                        .gj-consultancy-intro__content h2 {
                                            font-size: clamp(1.7rem, 10vw, 2.35rem);
                                        }

                                        .gj-consultancy-intro__content p {
                                            font-size: 0.93rem;
                                            line-height: 1.7;
                                        }

                                        .gj-consultancy-intro__subline {
                                            font-size: 0.92rem;
                                        }

                                        .gj-consultancy-intro__frame {
                                            border-radius: 18px;
                                        }

                                        .gj-country-tag {
                                            min-width: auto;
                                            border-radius: 12px;
                                            padding: 6px 8px;
                                            max-width: 47%;
                                            line-height: 1.2;
                                        }

                                        .gj-country-tag span {
                                            font-size: 0.78rem;
                                        }

                                        .gj-country-flag {
                                            font-size: 0.78rem;
                                        }

                                        .gj-country-tag--usa { top: 12px; right: 0; }
                                        .gj-country-tag--newzealand { top: 40px; right: 0; }
                                        .gj-country-tag--canada { top: 68px; left: 0; }
                                        .gj-country-tag--australia { top: 50%; left: 0; transform: translateY(-50%); }
                                        .gj-country-tag--uk { top: 70%; right: 0; transform: translateY(-50%); }
                                    }

                                    @media (max-width: 420px) {
                                        .gj-country-tag {
                                            padding: 5px 7px;
                                            max-width: 49%;
                                            gap: 6px;
                                            border-radius: 10px;
                                        }

                                        .gj-country-tag span {
                                            font-size: 0.72rem;
                                        }

                                        .gj-country-flag {
                                            font-size: 0.7rem;
                                        }

                                        .gj-country-tag--usa { top: 8px; right: 0; }
                                        .gj-country-tag--newzealand { top: 34px; right: 0; }
                                        .gj-country-tag--canada { top: 58px; left: 0; }
                                        .gj-country-tag--australia { top: 50%; left: 0; transform: translateY(-50%); }
                                        .gj-country-tag--uk { top: 70%; right: 0; transform: translateY(-50%); }
                                    }
                                </style>

