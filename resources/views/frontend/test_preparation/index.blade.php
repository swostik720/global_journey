@extends('frontend.layouts.includes.master')
@section('meta_title', 'Test Preparation | ' . ($setting->name ?? config('app.name')))
@section('meta_description', 'Build exam readiness with structured IELTS and PTE preparation, expert mentoring, and score-focused strategies.')
@section('maincontent')
    @include('frontend.layouts.includes.page_hero', [
        'eyebrow' => 'Exam Readiness',
        'title' => 'Test ',
        'accent' => 'Preparation',
        'subtitle' => 'Build confidence for IELTS, PTE, and other exam pathways with structured coaching and score-focused preparation.',
        'meta' => ['Expert Mentors', 'Structured Modules', 'Score Strategy'],
        'primaryAction' => ['label' => 'Contact Our Team', 'url' => route('contact-us')],
    ])

    <section data-aos="fade-up" class="gj-page-shell gj-page-shell--blue">
        <div class="container">
            <div data-aos="fade-up" data-aos-delay="100" class="gj-section-header">
                <span class="gj-section-header__eyebrow">Test Preparation</span>
                <h2>Boost Your Scores with Expert Guidance</h2>
                <p>Choose the exam track that fits your destination and get a cleaner, more strategic route to your target band score.</p>
            </div>

            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 justify-content-center">
                @foreach ($testpreparations as $testpreparation)
                    <div class="col">
                        <div data-aos="zoom-in-up" data-aos-delay="140"
                            class="card h-100 border-0 shadow-sm position-relative overflow-hidden rounded-4"
                            style="cursor:pointer; transition:all .4s ease; border-radius: 20px;"
                            onmouseover="this.style.transform='translateY(-8px) scale(1.02)'; this.style.boxShadow='0 12px 40px rgba(0,0,0,0.15)';"
                            onmouseout="this.style.transform=''; this.style.boxShadow='';">

                            <a href="{{ route('test-preparation.details', $testpreparation->slug) }}"
                                class="d-block h-100 text-decoration-none text-dark">

                                <!-- Image -->
                                <div class="ratio ratio-4x3 position-relative">
                                    <img class="card-img-top object-fit-cover" alt="{{ $testpreparation->title }}"
                                        src="{{ $testpreparation->image_path }}"
                                        style="object-fit:cover; width:100%; height:100%; transition: transform 0.5s ease;">
                                    <div class="overlay position-absolute top-0 start-0 w-100 h-100"
                                        style="background: linear-gradient(180deg, rgba(0,0,0,0) 40%, rgba(0,0,0,0.4) 100%);
                                    opacity:0; transition: opacity 0.5s ease;">
                                    </div>
                                </div>

                                <!-- Card Body -->
                                <div data-aos="zoom-in-up" data-aos-delay="140" class="card-body text-center p-4">
                                    <h3 class="card-title h5 mb-2" style="font-weight:700; color:#333;">
                                        {{ $testpreparation->title }}
                                    </h3>
                                    <p class="card-text small mb-3" style="color:#666; line-height:1.6;">
                                        {!! $testpreparation->short_description !!}
                                    </p>
                                    <span class="themebtu mt-auto" style="justify-content:center">
                                        Learn More <i class="bi bi-arrow-right"></i>
                                    </span>
                                </div>
                            </a>

                            <!-- Progress Bar -->
                            <div class="progress-hover"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <style>
            /* Progress bar animation */
            .card .progress-hover {
                position: absolute;
                bottom: 0;
                left: 0;
                height: 5px;
                width: 0%;
                background: linear-gradient(135deg,
                        #0038A6,
                        #0046C4,
                        #0058E8,
                        #003070,
                        #001F50);
                transition: width 0.6s ease-in-out;
                border-bottom-left-radius: 20px;
                border-bottom-right-radius: 20px;
            }

            .card:hover .progress-hover {
                width: 100%;
            }

            /* Image zoom and overlay */
            .card:hover img {
                transform: scale(1.08);
            }

            .card:hover .overlay {
                opacity: 1;
            }

            @media (hover: none) {
                .card:hover img {
                    transform: none;
                }

                .card:hover .overlay {
                    opacity: 0;
                }

                .card:hover .progress-hover {
                    width: 0%;
                }

                /* Prevent JS inline style from applying on touch */
                .card[style*="scale"] {
                    transform: none !important;
                }
            }
        </style>
    </section>
@endsection

