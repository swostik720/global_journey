@extends('frontend.layouts.includes.master')
@section('meta_title', 'Study Abroad Destinations | ' . ($setting->name ?? config('app.name')))
@section('meta_description', 'Compare study abroad destinations, academic pathways, and visa planning insights to choose the right country for your goals.')
@section('maincontent')
    @include('frontend.layouts.includes.page_hero', [
        'eyebrow' => 'Study Abroad Destinations',
        'title' => 'Study in Your ',
        'accent' => 'Dream Country',
        'subtitle' => 'Explore destinations, compare academic pathways, and find the country that aligns with your goals, budget, and long-term future.',
        'meta' => ['Country Guides', 'Program Selection', 'Visa Planning'],
        'primaryAction' => ['label' => 'Book a Consultation', 'url' => route('contact-us')],
    ])

    <section data-aos="fade-up" class="gj-page-shell gj-page-shell--blue">
        <div class="container">
            <div data-aos="fade-up" data-aos-delay="100" class="gj-section-header">
                <span class="gj-section-header__eyebrow">Study Abroad</span>
                <h2>Explore Countries and Programs That Match Your Goals</h2>
                <p>Each destination comes with its own academic strengths, visa conditions, and lifestyle advantages. Compare them with confidence.</p>
            </div>

            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 justify-content-center">
                @foreach ($studyabroads as $studyabroad)
                    <div class="col">
                        <div data-aos="zoom-in-up" data-aos-delay="140"
                            class="card h-100 border-0 shadow-sm position-relative overflow-hidden rounded-4"
                            style="cursor:pointer; transition:all .4s ease; border-radius: 20px;"
                            onmouseover="this.style.transform='translateY(-8px) scale(1.02)'; this.style.boxShadow='0 12px 40px rgba(0,0,0,0.15)';"
                            onmouseout="this.style.transform=''; this.style.boxShadow='';">

                            <a href="{{ route('study-abroad.details', $studyabroad->slug) }}"
                                class="d-block h-100 text-decoration-none text-dark">

                                <!-- Image -->
                                <div class="ratio ratio-4x3 position-relative">
                                    <img class="card-img-top object-fit-cover" alt="{{ $studyabroad->title }}"
                                        src="{{ $studyabroad->image_path }}"
                                        style="object-fit:cover; width:100%; height:100%; transition: transform 0.5s ease;">
                                    <div class="overlay position-absolute top-0 start-0 w-100 h-100"
                                        style="background: linear-gradient(180deg, rgba(0,0,0,0) 40%, rgba(0,0,0,0.4) 100%);
                                    opacity:0; transition: opacity 0.5s ease;">
                                    </div>
                                </div>

                                <!-- Card Body -->
                                <div data-aos="zoom-in-up" data-aos-delay="140" class="card-body text-center p-4">
                                    <h3 class="card-title h5 mb-2" style="font-weight:700; color:#333;">
                                        {{ $studyabroad->title }}
                                    </h3>
                                    <p class="card-text small mb-3" style="color:#666; line-height:1.6;">
                                        {!! $studyabroad->short_description !!}
                                    </p>
                                    <span class="themebtu" style="justify-content:center;">
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

            /* Card text adjustments */
            .card-body h3 {
                font-size: 1.2rem;
            }

            .card-body p {
                font-size: 0.9rem;
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

