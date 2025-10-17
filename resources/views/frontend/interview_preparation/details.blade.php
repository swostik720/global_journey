@extends('frontend.layouts.includes.master')

@section('title', 'Interview Preparation for ' . $interviewPreparation->title)

@section('maincontent')
    <section class="splash-area-section" style="background-image: url({{ asset('frontend/assets/img/background.jpg') }});">
        <div class="container">
            <div class="splash-area">
                @php
                    $parts = explode(' ', $interviewPreparation->title ?? '', 3); // split into max 3 parts
                    $firstPart = isset($parts[0], $parts[1]) ? $parts[0] . ' ' . $parts[1] : $parts[0] ?? '';
                    $secondPart = $parts[2] ?? '';
                @endphp

                <h2 class="splash-title">{{ $firstPart }}</h2>
                @if ($secondPart)
                    <h2 class="splash-title gradient-text">{{ $secondPart }}</h2>
                @endif
            </div>
        </div>

        <style>
            /* Fixed font size on large screens */
            .splash-title {
                font-size: 70px;
                line-height: 1.1;
                margin: 0;
                padding-left: 50px;
                white-space: wrap;
                /* prevent wrapping */
            }

            .gradient-text {
                background: linear-gradient(90deg, #0026cc, #001a80, #000d40);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
            }

            /* Responsive container */
            .splash-area-section .container {
                max-width: 100%;
                /* horizontal scroll if needed */
                padding: 0 15px;
            }

            /* Scale down for very small screens */
            @media (max-width: 400px) {
                .splash-title {
                    font-size: 60px;
                    padding-left: 10px;
                }
            }
        </style>
    </section>

    <section>
        <div class="container mt-5 mb-5">
            <div class="row justify-content-center">
                <div class="col-xl-10">

                    {{-- Main Card --}}
                    <div class="card shadow-lg border-0 rounded-4 mb-5 hover-card">
                        @if ($interviewPreparation->image)
                            <img src="{{ asset('uploaded-images/interwiew-preperations-images/' . $interviewPreparation->image) }}"
                                alt="{{ $interviewPreparation->title }}" class="card-img-top rounded-top">
                        @endif
                        <div class="card-body p-5">
                            <h3 class="mb-4 text-primary fw-bold">{{ $interviewPreparation->title }}</h3>
                            <p class="text-muted fs-5">{!! $interviewPreparation->description !!}</p>
                        </div>
                    </div>

                    {{-- Visa Conditions --}}
                    @if (!empty($interviewPreparation->visa_conditions))
                        <div class="card shadow-sm border-0 rounded-4 mb-5 visa-card p-4">
                            <h4 class="card-title mb-4 text-dark fw-bold">Student Visa Conditions</h4>
                            <ul class="list-group list-group-flush">
                                @foreach ($interviewPreparation->visa_conditions as $condition)
                                    <li class="list-group-item visa-item">
                                        <i class="bi bi-journal-check me-2 fs-5 text-primary"></i>
                                        {{ $condition }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Possible Interview Questions --}}
                    @if (!empty($interviewPreparation->interview_questions))
                        <section class="questions-section py-4 px-3 mb-5 rounded-4"
                            style="background: rgba(13,110,253,0.05);">
                            <h4 class="fw-bold mb-4 text-dark">Possible Interview Questions</h4>
                            <div class="accordion" id="questionsAccordion">
                                @foreach ($interviewPreparation->interview_questions as $index => $q)
                                    <div class="accordion-item gradient-accordion">
                                        <h2 class="accordion-header" id="heading{{ $index }}">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}"
                                                aria-expanded="false" aria-controls="collapse{{ $index }}">
                                                Q. {{ $q['question'] ?? $q }}
                                            </button>
                                        </h2>
                                        <div id="collapse{{ $index }}" class="accordion-collapse collapse"
                                            aria-labelledby="heading{{ $index }}"
                                            data-bs-parent="#questionsAccordion">
                                            <div class="accordion-body">
                                                @if (isset($q['answer']))
                                                    Possible Answer. ({{ $q['answer'] }})
                                                @else
                                                    No answer available.
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </section>
                    @endif

                    {{-- FAQs --}}
                    @if (!empty($interviewPreparation->faqs))
                        <section class="faq-section py-4 px-3 mb-5 rounded-4" style="background: rgba(220,220,220,0.15);">
                            <h4 class="fw-bold mb-4 text-dark">FAQs about {{ $interviewPreparation->title }}</h4>
                            <div class="accordion" id="faqAccordion">
                                @foreach ($interviewPreparation->faqs as $index => $faq)
                                    <div class="accordion-item gradient-accordion">
                                        <h2 class="accordion-header" id="faqHeading{{ $index }}">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#faqCollapse{{ $index }}"
                                                aria-expanded="false" aria-controls="faqCollapse{{ $index }}">
                                                Q. {{ $faq['question'] ?? '' }}
                                            </button>
                                        </h2>
                                        <div id="faqCollapse{{ $index }}" class="accordion-collapse collapse"
                                            aria-labelledby="faqHeading{{ $index }}" data-bs-parent="#faqAccordion">
                                            <div class="accordion-body">
                                                A. {{ $faq['answer'] ?? 'No answer available.' }}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </section>
                    @endif

                </div>
            </div>
        </div>
    </section>

    {{-- Custom Styles --}}
    <style>
        /* Card hover effect */
        .hover-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .hover-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 32px rgba(0, 0, 0, 0.15);
        }

        /* Visa Conditions */
        .visa-card {
            background: linear-gradient(135deg, rgba(230, 230, 230, 0.8), rgba(200, 200, 200, 0.2));
            border-radius: 15px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .visa-item {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            margin-bottom: 8px;
            border-radius: 8px;
            transition: transform 0.3s ease, background 0.3s ease;
            background: rgba(255, 255, 255, 0.7);
            cursor: pointer;
        }

        .visa-item:hover {
            background: rgba(255, 255, 255, 0.9);
            transform: translateX(5px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        /* Accordion hover and gradient border effect */
        .gradient-accordion {
            border-radius: 10px;
            margin-bottom: 12px;
            transition: transform 0.3s ease, box-shadow 0.3s ease, border 0.3s ease;
            border: 2px solid transparent;
            background-clip: padding-box;
        }

        .gradient-accordion:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
            border-image-slice: 1;
            border-width: 2px;
            border-image-source: linear-gradient(90deg, #feda75, #fa7e1e, #d62976, #962fbf, #4f5bd5);
            border-style: solid;
        }

        .accordion-button {
            font-weight: 600;
            color: #0d6efd;
            transition: all 0.3s ease;
        }

        .accordion-button:focus {
            box-shadow: none;
        }

        .accordion-button:not(.collapsed) {
            background: rgba(13, 110, 253, 0.1);
            color: #0b5ed7;
        }

        .accordion-body {
            background: rgba(240, 240, 240, 0.5);
            padding: 15px;
            border-radius: 0 0 8px 8px;
            color: #333;
        }

        /* Images */
        .card-img-top {
            max-height: 400px;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .card-img-top:hover {
            transform: scale(1.05);
        }

        @media (max-width: 768px) {
            .visa-item {
                transform: none !important;
            }

            .accordion-body {
                font-size: 0.95rem;
            }
        }
    </style>
@endsection
