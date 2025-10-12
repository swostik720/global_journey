@extends('frontend.layouts.includes.master')
@section('maincontent')
    {{-- Splash area --}}
    <section class="splash-area-section" style="background-image: url({{ asset('frontend/assets/img/background.jpg') }})">
        <div class="container">
            <div class="splash-area">
                @php
                    $parts = explode(' ', $study->title ?? '', 3); // split into max 3 parts
                    $firstPart = isset($parts[0], $parts[1]) ? $parts[0] . ' ' . $parts[1] : $parts[0] ?? '';
                    $secondPart = $parts[2] ?? '';
                @endphp

                <h2 style="font-size: 70px;">{{ $firstPart }}</h2>
                @if ($secondPart)
                    <h2
                        style="
    font-size: 70px;
    background: linear-gradient(90deg, #0026cc, #001a80, #000d40);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
  ">
                        {{ $secondPart }}</h2>
                @endif
            </div>
        </div>
    </section>

    {{-- Content Section --}}
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
                        <h1 class="mb-4 fw-bold animate__animated animate__fadeInUp">Why Study in
                            {{ $study->country->name ?? '' }}?</h1>
                        <p class="text-muted">{!! $study->short_description ?? '' !!}</p>
                        <figure class="my-4 text-center">
                            <img alt="img" class="img-fluid rounded-4 shadow-sm animate__animated animate__zoomIn"
                                src="{{ $study->image_path ?? '' }}">
                        </figure>
                        <p class="text-muted">{!! $study->description ?? '' !!}</p>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm rounded-4 p-4 animate__animated animate__fadeInRight">
                        <div class="heading mb-4 text-center">
                            <h6 class="text-primary">Start Abroad Journey</h6>
                            <h2 class="fw-bold">Let's Talk</h2>
                            <img alt="line" src="{{ asset('frontend/assets/img/headingline.png') }}"
                                class="img-fluid mt-2">
                        </div>
                        @if ($study->country)
                            @include('frontend.layouts.contact_form', [
                                'default_country' => $study->country->name,
                            ])
                        @else
                            @include('frontend.layouts.contact_form')
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <style>
            /* Content Section Cards Hover */
            .card:hover {
                transform: translateY(-5px);
                box-shadow: 0 16px 40px rgba(0, 0, 0, 0.15);
                transition: transform 0.4s ease, box-shadow 0.4s ease;
            }

            /* Optional: add a gentle gradient background on hover for the content card */
            .card:hover {
                background: linear-gradient(135deg, #f9f9ff, #e8e8ff);
            }

            /* Smooth transition for inner elements (images, text) */
            .card img {
                transition: transform 0.4s ease;
            }

            .card:hover img {
                transform: scale(1.02);
            }

            /* Contact Form Card */
            .card .contact-form__form {
                transition: all 0.3s ease;
            }

            .card .contact-form__form:hover {
                transform: translateY(-3px);
                box-shadow: 0 12px 25px rgba(108, 99, 255, 0.15);
            }

            /* Optional: subtle background change on hover for contact card */
            .card .contact-form__form:hover {
                background: #fffefc;
            }
        </style>

    </section>

    {{-- Study Abroad Feature Slider --}}
    <section class="gap review-section" style="background: #f9f9f9; padding: 80px 0;">
        <div class="container">
            <div class="heading mb-5 text-center">
                <h6 class="text-secondary">Explore Your Study Abroad Journey</h6>
                <h2 class="fw-bold">Essential Steps & Resources</h2>
                <img alt="line" src="{{ asset('frontend/assets/img/headingline.png') }}" class="img-fluid mt-2">
            </div>

            @php
                $slides = [
                    [
                        'icon' => '📑',
                        'title' => 'Document Checklist',
                        'desc' => 'Complete list of documents for admission and visa.',
                        'link' => route('frontend.study_abroad.document_checklist', $country->id),
                    ],
                    [
                        'icon' => '🎤',
                        'title' => 'Interview Preparation',
                        'desc' => 'Practice with expert tips to ace your visa interview.',
                        'link' => !empty($interviewPreparationSlug)
                            ? route('interview-preparation.details', $interviewPreparationSlug)
                            : '#',
                        'disabled' => empty($interviewPreparationSlug),
                    ],
                    [
                        'icon' => '🌍',
                        'title' => 'Why ' . ($country->name ?? 'Country'),
                        'desc' =>
                            'Discover why ' . ($country->name ?? 'this country') . ' is perfect for your studies.',
                        'link' => route('frontend.study_abroad.why_country', $country->id),
                    ],
                    [
                        'icon' => '🏫',
                        'title' => 'Colleges & Universities',
                        'desc' =>
                            'Learn about top colleges and universities in ' . ($country->name ?? 'this country') . '.',
                        'link' => route('frontend.study_abroad.college_and_university', $country->id),
                    ],
                    [
                        'icon' => '🗺️',
                        'title' => 'Country Guide',
                        'desc' =>
                            'Comprehensive guide to living and studying in ' . ($country->name ?? 'this country') . '.',
                        'link' => route('frontend.study_abroad.country_guide', $country->id),
                    ],
                ];
            @endphp

            <div class="swiper studyAbroadSwiper" style="overflow: visible;">
                <div class="swiper-wrapper">
                    @foreach ($slides as $slide)
                        <div class="swiper-slide">
                            <div class="card feature-card p-4 text-center h-100 position-relative" style="cursor:pointer;">
                                <div class="icon mb-3 fs-1">{{ $slide['icon'] }}</div>
                                <h4 class="fw-bold mb-2">{{ $slide['title'] }}</h4>
                                <p class="mb-3 text-muted">{{ $slide['desc'] }}</p>
                                @if (isset($slide['disabled']) && $slide['disabled'])
                                    <a href="#" class="btn btn-secondary btn-sm disabled">Not Available</a>
                                @else
                                    <a href="{{ $slide['link'] }}" class="themebtu">Learn More</a>
                                @endif
                                <div class="progress-hover"></div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Navigation -->
                <div class="swiper-button-next"><i class="fa fa-arrow-right"></i></div>
                <div class="swiper-button-prev"><i class="fa fa-arrow-left"></i></div>

                <!-- Pagination -->
                <div class="swiper-pagination mt-4"></div>
            </div>
        </div>

        <style>
            /* Feature Card */
            .feature-card {
                border-radius: 15px;
                box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
                transition: transform 0.4s ease, box-shadow 0.4s ease;
                background: linear-gradient(135deg, #f6f8ff, #e3e9ff);
            }

            .feature-card:hover {
                transform: translateY(-8px) scale(1.03);
                box-shadow: 0 16px 40px rgba(0, 0, 0, 0.18);
            }

            /* Progress hover bar */
            .progress-hover {
                position: absolute;
                bottom: 0;
                left: 0;
                height: 5px;
                width: 0%;
                background: linear-gradient(90deg, #feda75, #fa7e1e, #d62976, #962fbf, #4f5bd5);
                border-bottom-left-radius: 15px;
                border-bottom-right-radius: 15px;
                transition: width 0.6s ease-in-out;
            }

            .feature-card:hover .progress-hover {
                width: 100%;
            }

            /* Swiper buttons */
            .swiper-button-next,
            .swiper-button-prev {
                background: #fff;
                border-radius: 50%;
                width: 50px;
                height: 50px;
                color: #444 !important;
                display: flex;
                align-items: center;
                justify-content: center;
                position: absolute;
                top: 50%;
                z-index: 10;
                transform: translateY(-50%);
                box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
                transition: all 0.3s ease;
            }

            .swiper-button-next:hover,
            .swiper-button-prev:hover {
                background: linear-gradient(45deg, #667eea, #764ba2);
                color: #fff !important;
                transform: scale(1.1);
                box-shadow: 0 0 15px rgba(118, 75, 162, 0.4);
            }

            .swiper-pagination-bullet {
                width: 12px;
                height: 12px;
                border-radius: 6px;
                background: #c9d1d9;
                opacity: 1;
                transition: all 0.3s ease;
            }

            .swiper-pagination-bullet-active {
                width: 35px;
                background: linear-gradient(45deg, #667eea, #764ba2);
                border-radius: 6px;
            }

            /* Animate icons slightly */
            .feature-card .icon {
                transition: transform 0.3s ease;
            }

            .feature-card:hover .icon {
                transform: scale(1.2) rotate(5deg);
            }
        </style>
    </section>

    @push('custom_js')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                new Swiper('.studyAbroadSwiper', {
                    slidesPerView: 3,
                    spaceBetween: 30,
                    loop: true,
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev'
                    },
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true
                    },
                    autoplay: {
                        delay: 3000,
                        disableOnInteraction: false
                    },
                    breakpoints: {
                        576: {
                            slidesPerView: 1
                        },
                        768: {
                            slidesPerView: 2
                        },
                        1200: {
                            slidesPerView: 3
                        }
                    }
                });
            });
        </script>
    @endpush
@endsection
