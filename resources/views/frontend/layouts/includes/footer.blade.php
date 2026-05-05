<footer class="gj-footer">
    @php
        $countries = collect($footerCountries ?? collect());
        if ($countries->isEmpty()) {
            $countries = collect($studyabroads ?? collect())
                ->pluck('country')
                ->filter()
                ->unique('id')
                ->values();
        }
        $countryCount = $countries->count();

        $interviewByCountry = collect($interviewPreparations ?? collect())
            ->filter(fn($item) => !empty($item->country_id))
            ->keyBy('country_id');

        $studyAbroadQuickLinks = [
            ['label' => 'Explore Countries', 'url' => route('study-abroad')],
            ['label' => 'Test Preparation', 'url' => route('test-preparation')],
            ['label' => 'Interview Preparation', 'url' => route('interview-preparation')],
            ['label' => 'Contact Us', 'url' => route('contact-us')],
        ];

        $countryLinkLabels = [
            'why' => 'Why :country?',
            'guide' => 'Country Guide',
            'docs' => 'Document Checklist',
            'interview' => 'Interview Preparation',
            'college' => 'Colleges & Universities',
        ];
    @endphp

    <style>
        .gj-footer {
            position: relative;
            background: linear-gradient(180deg, #f8fbff 0%, #f3f7ff 100%);
            color: #334155;
            overflow: hidden;
            padding-top: 22px;
            min-height: 82vh;
            min-height: 82svh;
            border-top: 1px solid #dbe6f7;
        }

        .gj-footer::before {
            content: "";
            position: absolute;
            inset: 0;
            background-image:
                radial-gradient(circle at 88% 100%, rgba(59, 130, 246, 0.09), transparent 45%),
                radial-gradient(circle at 8% 0%, rgba(56, 98, 255, 0.08), transparent 40%);
            pointer-events: none;
        }

        .gj-footer::after {
            content: "";
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 140px;
            background: repeating-linear-gradient(-10deg,
                    rgba(148, 163, 184, 0.13) 0,
                    rgba(148, 163, 184, 0.13) 1px,
                    transparent 1px,
                    transparent 14px);
            opacity: 0.22;
            pointer-events: none;
        }

        .gj-footer__shell {
            position: relative;
            z-index: 1;
            min-height: calc(82svh - 22px);
            display: flex;
            flex-direction: column;
        }

        .gj-footer__top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            padding-bottom: 14px;
            border-bottom: 1px solid #dbe6f7;
            margin-bottom: 14px;
        }

        .gj-footer__logo img {
            width: 200px;
            max-width: 100%;
            height: auto;
        }

        .gj-footer__socials {
            list-style: none;
            display: flex;
            gap: 10px;
            margin: 0;
            padding: 0;
        }

        .gj-footer__socials a {
            width: 32px;
            height: 32px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            color: #1e3a8a;
            border: 1px solid #c9d9f8;
            background: #ffffff;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .gj-footer__socials a:hover {
            border-color: #93c5fd;
            background: #eff6ff;
            color: #1d4ed8;
            transform: translateY(-2px);
        }

        .gj-footer__quick {
            margin-bottom: 14px;
            border: 1px solid #dbe6f7;
            background: #ffffff;
            border-radius: 12px;
            padding: 12px 14px;
        }

        .gj-footer__quick h4 {
            font-size: 16px;
            line-height: 1.25;
            margin: 0 0 8px;
            color: #0f172a;
            font-weight: 700;
        }

        .gj-footer__quick-links {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            flex-wrap: wrap;
            gap: 8px 14px;
        }

        .gj-footer__quick-links a {
            color: #1e3a8a;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            transition: color 0.2s ease;
        }

        .gj-footer__quick-links a:hover {
            color: #1d4ed8;
        }

        .gj-footer__countries {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 12px;
            padding-bottom: 14px;
        }

        /* .gj-footer__countries.gj-footer__countries--five {
            grid-template-columns: repeat(6, minmax(0, 1fr));
        }

        .gj-footer__countries.gj-footer__countries--five .gj-footer__country {
            grid-column: span 2;
        }

        .gj-footer__countries.gj-footer__countries--five .gj-footer__country:nth-child(4) {
            grid-column: 2 / span 2;
        }

        .gj-footer__countries.gj-footer__countries--five .gj-footer__country:nth-child(5) {
            grid-column: 4 / span 2;
        } */

        .gj-footer__country {
            border: 1px solid #dbe6f7;
            background: linear-gradient(180deg, #f8fbff 0%, #f3f7ff 100%);
            border-radius: 12px;
            padding: 12px;
        }

        .gj-footer__country h4 {
            color: #0f172a;
            font-size: 15px;
            margin-bottom: 8px;
            font-weight: 700;
            line-height: 1.25;
        }

        .gj-footer__links {
            list-style: none;
            margin: 0;
            padding: 0;
            display: grid;
            gap: 5px;
        }

        .gj-footer__links a {
            color: #475569;
            text-decoration: none;
            font-size: 12px;
            line-height: 1.35;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: color 0.2s ease, transform 0.2s ease;
        }

        .gj-footer__links a::before {
            content: "\f061";
            font-family: "Font Awesome 6 Free";
            font-weight: 900;
            font-size: 9px;
            color: #ff4d5d;
        }

        .gj-footer__links a:hover {
            color: #1d4ed8;
            transform: translateX(2px);
        }

        .gj-footer__meta {
            text-align: center;
            padding: 10px 0 6px;
            padding-top: 50px;
        }

        .gj-footer__policy {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 14px;
            list-style: none;
            margin: 0 0 8px;
            padding: 0;
        }

        .gj-footer__policy a {
            color: #1e3a8a;
            text-decoration: none;
            font-weight: 600;
            font-size: 13px;
            transition: color 0.2s ease;
        }

        .gj-footer__policy a:hover {
            color: #1d4ed8;
        }

        .gj-footer__about {
            padding-top: 20px;
            margin: 0 auto;
            max-width: 960px;
            color: #64748b;
            font-size: 13px;
            line-height: 1.6;
        }

        .gj-footer__bottom {
            margin-top: auto;
            border-top: 1px solid #dbe6f7;
            padding: 10px 0;
            text-align: center;
            color: #64748b;
            font-size: 12px;
        }

        @media (max-width: 1199px) {
            .gj-footer__countries {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 767px) {
            .gj-footer__top {
                flex-direction: column;
                align-items: flex-start;
            }

            .gj-footer__quick-links {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .gj-footer__countries {
                grid-template-columns: 1fr;
                gap: 10px;
            }

            .gj-footer {
                padding-top: 18px;
            }

            .gj-footer__shell {
                min-height: calc(82svh - 18px);
            }
        }
    </style>

    <div class="container gj-footer__shell">
        <div class="gj-footer__top">
            <div class="gj-footer__logo">
                @if (is_object($setting) && isset($setting->logo))
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('uploaded-images/site-setting-images/' . $setting->logo) }}"
                            alt="Global Journey Logo">
                    </a>
                @else
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('frontend/assets/img/logo.png') }}" alt="Global Journey Logo">
                    </a>
                @endif
            </div>

            <ul class="gj-footer__socials">
                @if (!empty($setting->fb_link))
                    <li><a href="{{ $setting->fb_link }}" target="_blank" rel="noopener noreferrer"
                            aria-label="Facebook"><i class="bi bi-facebook"></i></a></li>
                @endif
                @if (!empty($setting->instagram_link))
                    <li><a href="{{ $setting->instagram_link }}" target="_blank" rel="noopener noreferrer"
                            aria-label="Instagram"><i class="bi bi-instagram"></i></a></li>
                @endif
                @if (!empty($setting->linkedIn_link))
                    <li><a href="{{ $setting->linkedIn_link }}" target="_blank" rel="noopener noreferrer"
                            aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a></li>
                @endif
                @if (!empty($setting->twitter_link))
                    <li><a href="{{ $setting->twitter_link }}" target="_blank" rel="noopener noreferrer"
                            aria-label="X"><i class="bi bi-twitter-x"></i></a></li>
                @endif
            </ul>
        </div>

        {{-- <div class="gj-footer__quick">
            <h4>Study Abroad</h4>
            <ul class="gj-footer__quick-links">
                @foreach ($studyAbroadQuickLinks as $quickLink)
                    <li><a href="{{ $quickLink['url'] }}">{{ $quickLink['label'] }}</a></li>
                @endforeach
            </ul>
        </div> --}}

        <div class="gj-footer__countries{{ $countryCount === 5 ? ' gj-footer__countries--five' : '' }}">
            @foreach ($countries as $country)
                @php
                    $interviewItem = $interviewByCountry->get($country->id ?? null);
                    $interviewUrl = $interviewItem
                        ? route('interview-preparation.details', $interviewItem->slug)
                        : route('interview-preparation');
                    $countryName = $country->name ?? 'Country';
                    $countryLinks = [
                        [
                            'label' => str_replace(':country', $countryName, $countryLinkLabels['why']),
                            'url' => route('frontend.study_abroad.why_country', $country->id),
                        ],
                        [
                            'label' => $countryLinkLabels['guide'],
                            'url' => route('frontend.study_abroad.country_guide', $country->id),
                        ],
                        [
                            'label' => $countryLinkLabels['docs'],
                            'url' => route('frontend.study_abroad.document_checklist', $country->id),
                        ],
                        ['label' => $countryLinkLabels['interview'], 'url' => $interviewUrl],
                        [
                            'label' => $countryLinkLabels['college'],
                            'url' => route('frontend.study_abroad.college_and_university', $country->id),
                        ],
                    ];
                @endphp
                <div class="gj-footer__country">
                    <h4>Study in {{ $countryName }}</h4>
                    <ul class="gj-footer__links">
                        @foreach ($countryLinks as $countryLink)
                            <li><a href="{{ $countryLink['url'] }}">{{ $countryLink['label'] }}</a></li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>

        <div class="gj-footer__meta">
            <ul class="gj-footer__policy">
                <li><a href="{{ route('terms-and-conditions') }}">Terms & Condition</a></li>
                <li><a href="{{ route('privacy-policy') }}">Privacy Policy</a></li>
                <li><a href="{{ route('contact-us') }}">Contact Us</a></li>
            </ul>
            <p class="gj-footer__about">
                Based in Nepal, Global Journey Education Services is a leading education consultant committed to helping
                professionals and students fulfill their academic and professional goals.
            </p>
        </div>

        <div class="gj-footer__bottom">
            Â© 2024 Global journeys - All Rights Reserved | Maintained by ideagen
        </div>
    </div>
</footer>

<a id="button"></a>

