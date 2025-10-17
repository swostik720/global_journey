@extends('frontend.layouts.includes.master')

@section('maincontent')
    <!-- Hero Section -->
    <section class="splash-area-section" style="background-image: url({{ asset('frontend/assets/img/background.jpg') }})">
        <div class="container">
            <div class="splash-area">
                <h2 class="splash-title">Interview</h2>
                <h2 class="splash-title gradient-text">Preperation</h2>
            </div>
        </div>

        <style>
            /* Keep font size fixed at 70px */
            .splash-title {
                font-size: 70px;
                padding-left: 50px;
                line-height: 1.1;
                margin: 0;
                /* white-space: nowrap; */
                /* prevent wrapping */
            }

            .gradient-text {
                background: linear-gradient(90deg, #0026cc, #001a80, #000d40);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
            }

            /* Responsive container padding to avoid cutting text */
            .splash-area-section .container {
                max-width: 100%;
                padding: 0 15px;
            }

            /* Optional: slightly scale text on very small screens */
            @media (max-width: 400px) {
                .splash-title {
                    font-size: 70px;
                    padding-left: 10px;
                }
            }
        </style>
    </section>

    <!-- Interview Preparation Grid -->
    <section class="py-5 position-relative">
        <div class="container">
            <div class="heading text-center mb-5">
                <h6 class="text-primary fw-semibold">Tips & Preparations</h6>
                <h2 class="fw-bold">Interview Preparation Resources</h2>
                <img alt="line" src="{{ asset('frontend/assets/img/headingline.png') }}" class="img-fluid mt-3"
                    style="max-width: 150px;">
            </div>

            <div class="row g-4 justify-content-center">
                @forelse ($interviewPreparations as $item)
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden prep-card position-relative">
                            <a href="{{ route('interview-preparation.details', $item->slug) }}"
                                class="text-decoration-none text-dark h-100 d-block">
                                <div class="ratio ratio-4x3">
                                    <img class="card-img-top object-fit-cover" alt="{{ $item->title }}"
                                        src="{{ $item->image ? asset('uploaded-images/interwiew-preperations-images/' . $item->image) : asset('frontend/assets/img/default.jpg') }}"
                                        style="object-fit:cover; width:100%; height:100%;">
                                </div>
                                <div class="card-body p-4">
                                    <h5 class="card-title fw-bold">{{ $item->title }}</h5>
                                    <p class="card-text small text-muted mb-3">{!! Str::limit($item->description, 100) !!}</p>
                                    <span class="themebtu mt-auto">Learn More <i class="bi bi-arrow-right ms-1"></i></span>
                                </div>
                                <!-- Progress Bar -->
                                <div class="progress-bar"></div>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5 text-muted">
                        No interview preparations found.
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Visa Conditions Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="heading text-center mb-5">
                <h6 class="text-primary fw-semibold">Visa Interview Checklist & Conditions</h6>
                <h2 class="fw-bold">Prepare Confidently for Your Visa Interview</h2>
                <img alt="line" src="{{ asset('frontend/assets/img/headingline.png') }}" class="img-fluid mt-3"
                    style="max-width: 150px;">
            </div>

            @php
                $visaConditions = [
                    'Passport must be valid for at least 6 months.',
                    'Provide proof of financial support.',
                    'Submit all required application forms and documents.',
                    'Show proof of accommodation and study plans.',
                    'Attend the interview with a confident and positive attitude.',
                    'Be honest and clear in your responses.',
                    'Demonstrate ties to your home country to ensure return after studies.',
                    'Prepare for common interview questions related to your study plans and future goals.',
                ];
            @endphp

            <div class="row g-4 justify-content-center mb-5">
                @foreach ($visaConditions as $condition)
                    <div class="col-md-6 col-lg-4">
                        <div class="card visa-condition-card h-100 p-4 text-center position-relative overflow-hidden">
                            <i class="bi bi-shield-check text-white mb-3 card-icon pulse-icon"></i>
                            <p class="fw-semibold fs-6 text-white mt-2">{{ $condition }}</p>
                            <div class="overlay"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Tips Section -->
    <section class="py-5">
        <div class="container">
            <div class="heading text-center mb-5">
                <h6 class="text-primary fw-semibold">Visa Interview Tips</h6>
                <h2 class="fw-bold">Essential Tips to Succeed</h2>
                <img alt="line" src="{{ asset('frontend/assets/img/headingline.png') }}" class="img-fluid mt-3"
                    style="max-width: 150px;">
            </div>

            @php
                $tips = [
                    'Be confident and speak clearly.',
                    'Give short, honest answers.',
                    'Do not memorize answers word-for-word.',
                    'Maintain eye contact with the interviewer.',
                    'Be polite and respectful at all times.',
                    'Dress professionally to make a good impression.',
                    'Arrive early to avoid any last-minute stress.',
                    'Bring all required documents organized and ready.',
                    'Practice common interview questions beforehand.',
                ];
            @endphp

            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                @foreach ($tips as $tip)
                    <div class="col">
                        <div class="card tip-card h-100 p-4 text-center position-relative overflow-hidden">
                            <i class="bi bi-lightbulb-fill text-warning mb-3 card-icon pulse-icon"></i>
                            <p class="fw-semibold mb-0">{{ $tip }}</p>
                            <div class="overlay"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <style>
        /* PREPARATION CARDS */
        .prep-card {
            border-radius: 20px;
            transition: all 0.3s ease-in-out;
            min-height: 280px;
            position: relative;
            overflow: hidden;
        }

        .prep-card:hover {
            transform: translateY(-6px) scale(1.03);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
        }

        /* Progress Bar Effect */
        .progress-bar {
            position: absolute;
            bottom: 0;
            left: 0;
            height: 4px;
            width: 0;
            background: linear-gradient(90deg, #feda75, #fa7e1e, #d62976, #962fbf, #4f5bd5);
            transition: width 0.5s ease;
            border-radius: 4px 4px 0 0;
        }

        .prep-card:hover .progress-bar {
            width: 100%;
        }

        /* VISA CONDITION CARDS */
        .visa-condition-card {
            background: linear-gradient(135deg, #6dd5ed, #2193b0);
            color: white;
            border: none;
            border-radius: 15px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
            overflow: hidden;
            min-height: 200px;
        }

        .visa-condition-card:hover {
            transform: translateY(-8px) scale(1.05);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
        }

        .visa-condition-card .card-icon {
            font-size: 2.5rem;
        }

        .visa-condition-card .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.05);
            transition: all 0.3s ease;
            z-index: 0;
        }

        .visa-condition-card:hover .overlay {
            background: rgba(255, 255, 255, 0.15);
        }

        /* TIPS CARDS */
        .tip-card {
            border-radius: 15px;
            border: none;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
            min-height: 150px;
            background: linear-gradient(135deg,
                    rgba(200, 200, 200, 0.15),
                    rgba(150, 150, 150, 0.05));
        }

        .tip-card:hover {
            transform: translateY(-6px) scale(1.04);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.18);
        }

        .tip-card .card-icon {
            font-size: 2rem;
            color: #ffc107;
            /* yellow color for lightbulb */
            transition: all 0.3s ease;
            text-shadow: 0 0 0 rgba(255, 223, 0, 0);
            /* initially off */
        }

        /* Glow animation for hover (lightbulb on/off effect) */
        .tip-card:hover .card-icon {
            animation: lightbulb-glow 1s infinite alternate;
            text-shadow:
                0 0 5px #fff3a3,
                0 0 10px #fff3a3,
                0 0 15px #ffc107,
                0 0 20px #ffc107;
        }

        @keyframes lightbulb-glow {
            0% {
                text-shadow: 0 0 0 rgba(255, 223, 0, 0);
            }

            50% {
                text-shadow:
                    0 0 5px #fff3a3,
                    0 0 10px #fff3a3,
                    0 0 15px #ffc107,
                    0 0 20px #ffc107;
            }

            100% {
                text-shadow: 0 0 0 rgba(255, 223, 0, 0);
            }
        }

        /* ICON PULSE ANIMATION */
        .pulse-icon {
            display: inline-block;
            transition: transform 0.3s ease, text-shadow 0.3s ease;
        }

        .visa-condition-card:hover .pulse-icon,
        .pulse-icon {
            animation: pulse 1s infinite alternate;
            text-shadow: 0 0 8px rgba(255, 255, 255, 0.6), 0 0 15px rgba(255, 255, 255, 0.3);
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.15);
            }

            100% {
                transform: scale(1.1);
            }
        }

        /* Responsive tweaks */
        @media (max-width: 768px) {

            .visa-condition-card,
            .tip-card,
            .prep-card {
                min-height: 180px;
            }
        }
    </style>
@endsection
