@extends('frontend.layouts.includes.master')
@section('maincontent')
    <section data-aos="fade-up" class="splash-area-section" style="background-image: url({{ asset('frontend/assets/img/background.jpg') }})">
        <div class="container">
            <div class="splash-area">
                <h1 class="splash-title">Test <span class="gradient-text">Preperation</span></h1>
            </div>
        </div>

        <style>
            /* Keep font size fixed at 70px */
            .splash-title {
                font-size: 70px;
                padding-left: 50px;
                line-height: 1.1;
                margin: 0;
                white-space: nowrap;
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

    <section data-aos="fade-up" class="gap no-bottom" style="background: #f9f9ff; padding: 80px 0;">
        <div class="container">
            <!-- Heading -->
            <div data-aos="fade-up" data-aos-delay="100" class="heading text-center mb-5">
                <h6>Test Preparation</h6>
                <h2 style="">Boost Your Scores with Expert Guidance</h2>
                <img src="{{ asset('frontend/assets/img/headingline.png') }}" alt="line" style="margin-top:15px;">
            </div>

            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 justify-content-center">
                @foreach ($testpreparations as $testpreparation)
                    <div class="col">
                        <div data-aos="zoom-in-up" data-aos-delay="140" class="card h-100 border-0 shadow-sm position-relative overflow-hidden rounded-4"
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
                                    <span class="themebtu mt-auto" style="justify-content:left">
                                        Learn More <i class="fa fa-arrow-right"></i>
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
                background: linear-gradient(90deg, #feda75, #fa7e1e, #d62976, #962fbf, #4f5bd5);
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
        </style>
    </section>
@endsection
