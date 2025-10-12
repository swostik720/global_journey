@extends('frontend.layouts.includes.master')
@section('maincontent')
    <section class="splash-area-section" style="background-image: url({{ asset('frontend/assets/img/background.jpg') }})">
        <div class="container">
            <div class="splash-area">
                <h2 style="font-size: 70px;">We Deliver</h2>
                <h2
                    style="
    font-size: 70px;
    background: linear-gradient(90deg, #0026cc, #001a80, #000d40);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
  ">
                    Results
                </h2>
            </div>
        </div>
    </section>
    <section class="things-differently gap py-5" style="background-color: #f8f9fc;">
        <div class="container">
            <div class="row align-items-center gy-5">

                <!-- Left Column: Heading and Image -->
                <div class="col-xl-7">
                    <div class="heading pe-xl-5">
                        <h6>Message from the CEO</h6>
                        <h2>
                            Welcome to Global Journey Education!
                        </h2>
                        <img alt="line" src="{{ asset('frontend/assets/img/headingline.png') }}" class="mb-4">

                        <div class="ceo-img position-relative text-center text-xl-start">
                            <img src="{{ asset('frontend/assets/img/ceo.png') }}" alt="CEO"
                                class="img-fluid rounded-4 shadow-lg ceo-photo">
                            <div class="overlay"></div>
                            <div class="floating-badge">
                                <span>13+ Years<br>Experience</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Message -->
                <div class="col-xl-5">
                    <div class="signature bg-white p-4 p-md-5 rounded-4 shadow-sm position-relative animate-card">
                        <p class="mb-3">
                            I’m <strong>Bishal Neupane</strong>, Founder and CEO of Global Journey Education.
                            With over 13 years of experience in the international education sector and as a
                            QEAC/PIER Certified Education Counselor, I take great pride in helping students
                            turn their academic dreams into reality.
                        </p>

                        <p class="mb-3">
                            At Global Journey Education, we are committed to providing honest, personalized,
                            and professional guidance to students aspiring to study abroad. Every student’s
                            journey is unique, and our goal is to ensure they receive the support, information,
                            and confidence they need to make informed decisions for their future.
                        </p>

                        <p class="mb-3">
                            We are proud to serve students and families through our conveniently located branch
                            offices in <strong>Kumaripati, Chabahil,</strong> and <strong>Birtamode</strong>,
                            where our experienced counselors are always ready to assist you.
                        </p>

                        <p class="mb-4">
                            Thank you for trusting Global Journey Education as your partner in shaping a
                            brighter, global future.
                        </p>

                        <div class="ceo text-end text-xl-start">
                            <span class="d-block fw-semibold">
                                Warm regards,<br>
                                <strong>Bishal Neupane</strong><br>
                                CEO, Global Journey Education<br>
                                QEAC Certified Counselor
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <style>
            /* ===============================
                                                   CEO SECTION ENHANCED STYLES
                                                ================================ */
            .things-differently {
                position: relative;
                overflow: hidden;
            }

            /* CEO Image Effects */
            .ceo-img {
                position: relative;
                display: inline-block;
                overflow: hidden;
                border-radius: 18px;
            }

            .ceo-img img {
                transition: transform 1s cubic-bezier(0.19, 1, 0.22, 1), filter 0.5s ease;
            }

            .ceo-img:hover img {
                transform: scale(1.07);
                filter: brightness(1.1);
            }

            .ceo-img .overlay {
                position: absolute;
                inset: 0;
                background: linear-gradient(135deg, rgba(0, 56, 166, 0.25), rgba(0, 56, 166, 0.1));
                opacity: 0;
                transition: opacity 0.5s ease;
                border-radius: 18px;
            }

            .ceo-img:hover .overlay {
                opacity: 1;
            }

            /* Floating Badge */
            .floating-badge {
                position: absolute;
                bottom: 20px;
                right: 20px;
                background: linear-gradient(135deg, #0038A6, #0070FF);
                color: #fff;
                padding: 10px 15px;
                border-radius: 10px;
                font-size: 0.9rem;
                font-weight: 600;
                box-shadow: 0 4px 15px rgba(0, 56, 166, 0.3);
                opacity: 0;
                transform: translateY(15px);
                transition: all 0.5s ease;
            }

            .ceo-img:hover .floating-badge {
                opacity: 1;
                transform: translateY(0);
            }

            /* Signature Card */
            .animate-card {
                border: 2px solid transparent;
                transition: all 0.6s ease;
            }

            .animate-card:hover {
                transform: translateY(-8px);
                box-shadow: 0 12px 30px rgba(0, 56, 166, 0.15);
                border-color: #0038A6;
                background: linear-gradient(145deg, #ffffff, #f7f9ff);
            }

            /* Text hover glow */
            .animate-card p:hover {
                color: #0038A6;
                transition: color 0.3s ease;
            }

            /* Responsive */
            @media (max-width: 992px) {
                .heading h2 {
                    font-size: 2rem;
                }

                .floating-badge {
                    bottom: 15px;
                    right: 15px;
                    font-size: 0.8rem;
                }
            }
        </style>
    </section>


    <section>
        <div class="container">
            <div class="row">
                <div class="col-xl-6">
                    <div class="heading pt-5">
                        <h6>Meet Our Team Members</h6>
                        <h2>Guiding your jouryney</h2>
                        <img alt="line" src="{{ asset('frontend/assets/img/headingline.png') }}">
                    </div>
                </div>
            </div>
            <div class="swiper-container teamSwiper mt-5">
                <div class="swiper-wrapper">
                    @foreach ($teams as $team)
                        <div class="swiper-slide">
                            <div class="team-card">
                                <!-- Team Image -->
                                <div class="team-img-wrapper">
                                    <img class="team-img" alt="img" src="{{ $team->image_path ?? '' }}">
                                </div>

                                <!-- Team Info -->
                                <div class="team-info">
                                    <h6>{{ $team->name ?? '' }}</h6>
                                    <p>{{ $team->responsibility ?? '' }}</p>

                                    <!-- Social icons (hidden until hover) -->
                                    <ul class="team-social d-flex justify-content-center gap-2">
                                        <li>
                                            <a href="mailto:{{ $team->email ?? '' }}">
                                                <i class="fa fa-envelope"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="tel:{{ $team->phone ?? '' }}">
                                                <i class="fa fa-phone"></i>
                                            </a>
                                        </li>

                                        {{-- <li><a href="{{ $team->fb_link ?? '' }}"><i class="fa-brands fa-facebook-f"></i></a>
                                        </li>
                                        <li><a href="{{ $team->twitter_link ?? '' }}"><i
                                                    class="fa-brands fa-twitter"></i></a></li>
                                        <li><a href="{{ $team->instagram_link ?? '' }}"><i
                                                    class="fa-brands fa-instagram"></i></a></li>
                                        <li><a href="{{ $team->linkedin_link ?? '' }}"><i
                                                    class="fa-brands fa-linkedin-in"></i></a></li> --}}
                                    </ul>
                                </div>

                                <!-- Progress Bar -->
                                <div class="progress-bar"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-button-next">
                    <i class="fa fa-arrow-right"></i>
                </div>
                <div class="swiper-button-prev">
                    <i class="fa fa-arrow-left"></i>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
        <style>
            /* Card container */
            .team-card {
                position: relative;
                display: flex;
                flex-direction: column;
                height: 100%;
                overflow: hidden;
                border-radius: 16px;
                box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
                transition: transform 0.3s ease;
                background: #fff;
            }

            .team-card:hover {
                transform: translateY(-8px);
            }

            /* Image takes 70% height */
            .team-img-wrapper {
                flex: 0 0 70%;
                width: 100%;
                overflow: hidden;
            }

            .team-img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                transition: 0.4s ease;
            }

            .team-card:hover .team-img {
                transform: scale(1.05);
            }

            /* Info takes 30% height */
            .team-info {
                flex: 0 0 30%;
                padding: 15px;
                text-align: center;
                background: #fff;
                position: relative;
            }

            .team-info h6 {
                font-size: 16px;
                font-weight: 600;
                margin-bottom: 4px;
            }

            .team-info p {
                font-size: 14px;
                color: #777;
                margin: 0;
            }

            /* Social icons hidden by default */
            .team-social {
                margin-top: 10px;
                opacity: 0;
                transform: translateY(10px);
                transition: 0.3s ease;
            }

            .team-social li a {
                color: gray;
                font-size: 14px;
                padding: 6px;
                display: inline-block;
                transition: all 0.3s ease;
            }

            .team-social li a:hover {
                color: #6c63ff;
            }

            /* Show social icons on hover */
            .team-card:hover .team-social {
                opacity: 1;
                transform: translateY(0);
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
            }

            .team-card:hover .progress-bar {
                width: 100%;
            }

            /* Force all swiper slides to have the same size */
            .swiper-slide {
                height: 500px !important;
                /* fixed slide height */
                display: flex;
                align-items: center;
                justify-content: center;
            }

            /* Team card inside each slide */
            .team-item {
                width: 100%;
                height: 100%;
                /* fill the slide height */
                display: flex;
                flex-direction: column;
                justify-content: space-between;
                background: #fff;
                border-radius: 10px;
                overflow: hidden;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            }

            /* Image always the same size */
            .team-item img {
                width: 100%;
                height: 220px;
                /* fixed image height */
                object-fit: cover;
                /* crop instead of stretching */
            }

            /* Text area takes remaining space */
            .team-item .p-3 {
                flex: 1;
                display: flex;
                flex-direction: column;
                justify-content: center;
            }

            /* Swiper buttons - rounded square with gradient hover */
            .swiper-button-next,
            .swiper-button-prev {
                background: #fff;
                border-radius: 15px;
                width: 50px;
                height: 50px;
                color: #444 !important;
                box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
                transition: all 0.3s ease;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .swiper-button-next:hover,
            .swiper-button-prev:hover {
                background: linear-gradient(45deg, #667eea, #764ba2);
                color: #fff !important;
                transform: scale(1.1);
                box-shadow: 0 0 15px rgba(118, 75, 162, 0.4);
            }

            /* Pagination dots */
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
        </style>

    </section>
    <section class="we-deliver-results gap" style="background-color: #f2edf5;">
        <div class="container">
            <div class="heading two">
                <h2>Why Choose Global Journey Education Services?</h2>
                <img alt="line" src="{{ asset('frontend/assets/img/headingline.png') }}">
            </div>
            <div class="row">
                <div class="col-xl-3 col-md-6 col-sm-12">
                    <div class="makes-us-different-text makes-us-different-hover">
                        <i>
                            <svg enable-background="new 0 0 64 64" height="512" viewBox="0 0 64 64" width="512"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="m33 19v-2h3v-3c0-1.654-1.346-3-3-3h-2c-.552 0-1-.449-1-1v-1h3c.552 0 1 .449 1 1h2c0-1.654-1.346-3-3-3v-2h-2v2h-3v3c0 1.654 1.346 3 3 3h2c.552 0 1 .449 1 1v1h-3c-.552 0-1-.449-1-1h-2c0 1.654 1.346 3 3 3v2z" />
                                <path
                                    d="m62.618 47-5-10h-13.974c2.044-1.651 3.356-4.174 3.356-7v-1h-7c-2.826 0-5.349 1.312-7 3.356v-9.406c5.598-.508 10-5.222 10-10.95 0-6.065-4.935-11-11-11s-11 4.935-11 11c0 5.728 4.402 10.442 10 10.949v5.406c-1.651-2.043-4.174-3.355-7-3.355h-7v1c0 4.962 4.037 9 9 9h5v2h-1.382-3.236-20l-5 10h3.618v16h52v-16zm-36.618-14c-3.521 0-6.442-2.612-6.929-6h4.929c3.521 0 6.442 2.612 6.929 6zm14-2h4.929c-.486 3.388-3.408 6-6.929 6h-4.929c.487-3.388 3.408-6 6.929-6zm-17-19c0-4.962 4.037-9 9-9s9 4.038 9 9-4.037 9-9 9-9-4.038-9-9zm8 27h7 18.382l3 6h-26.764l-3-6zm-23.382 0h18.764l-3 6h-18.764zm-.618 8h17.618l2.382-4.764v18.764h-20zm48 14h-26v-18.764l2.382 4.764h23.618z" />
                                <path d="m53 53h-15v6h15zm-2 4h-11v-2h11z" />
                                <path d="m9 53h2v2h-2z" />
                                <path d="m9 57h2v2h-2z" />
                                <path d="m9 49h2v2h-2z" />
                                <path
                                    d="m49 33h2v-19h-2.233l4.233-7.056 4.233 7.056h-2.233v9h2v-7h3.767l-7.767-12.944-7.767 12.944h3.767z" />
                                <path d="m55 25h2v2h-2z" />
                                <path d="m55 29h2v2h-2z" />
                                <path
                                    d="m6 23h2v-9h-2.233l4.233-7.056 4.233 7.056h-2.233v19h2v-17h3.767l-7.767-12.944-7.767 12.944h3.767z" />
                                <path d="m6 25h2v2h-2z" />
                                <path d="m6 29h2v2h-2z" />
                                <path d="m46 41h2v2h-2z" />
                                <path d="m50 41h2v2h-2z" />
                                <path d="m54 41h2v2h-2z" />
                                <path d="m8 41h2v2h-2z" />
                                <path d="m12 41h2v2h-2z" />
                                <path d="m16 41h2v2h-2z" />
                            </svg>
                        </i>
                        <h4>
                            We are Caring and Focus</h4>
                        <p>
                            We provide personalized guidance, focusing on each student’s unique academic journey.
                        </p>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 col-sm-12">
                    <div class="makes-us-different-text makes-us-different-hover">
                        <i>
                            <svg id="Ecommerce" enable-background="new 0 0 48 48" height="512" viewBox="0 0 48 48"
                                width="512" xmlns="http://www.w3.org/2000/svg">
                                <g>
                                    <path
                                        d="m25 7.03c0-.552-.447-1-1-1-5.514 0-10 4.486-10 10 0 .552.447 1 1 1s1-.448 1-1c0-4.411 3.589-8 8-8 .553 0 1-.448 1-1z" />
                                    <path
                                        d="m22.246 45.79h1.754 1.754c1.652 0 2.999-1.345 3-3v-1.099c1.032-.475 1.755-1.512 1.755-2.721v-3.72c.176-.382.281-.802.281-1.25 0-1.016.226-2 .671-2.927.441-.919 1.086-1.752 1.864-2.409 3.746-3.165 5.709-7.989 5.25-12.909-.7-7.375-6.813-13.189-14.265-13.525l-.31-.01-.354.011c-7.408.335-13.521 6.149-14.222 13.526-.458 4.917 1.505 9.742 5.251 12.906.778.658 1.423 1.491 1.864 2.41.445.927.671 1.911.671 2.927 0 .447.105.868.281 1.25v3.721c0 1.209.722 2.247 1.755 2.721v1.1c.001 1.653 1.348 2.998 3 2.998zm4.508-3c0 .552-.449 1-1 1h-1.754-1.754c-.551 0-1-.449-1-1v-.82h2.754 2.754zm1.755-3.819c0 .551-.448 1-1 1h-3.509-3.509c-.552 0-1-.449-1-1v-2.068c.232.058.47.097.719.097h3.79 3.79c.249 0 .487-.039.719-.097zm-9.299-4.971c0-1.318-.292-2.595-.868-3.793-.563-1.171-1.385-2.233-2.376-3.071-3.247-2.742-4.948-6.926-4.551-11.191.607-6.389 5.903-11.426 12.275-11.715l.31-.01.265.009c6.417.29 11.713 5.327 12.319 11.714.398 4.267-1.303 8.451-4.55 11.193-.991.838-1.813 1.9-2.376 3.071-.576 1.198-.868 2.475-.868 3.793 0 .551-.448 1-1 1h-3.79-3.79c-.552 0-1-.449-1-1z" />
                                </g>
                            </svg>
                        </i>
                        <h4>High Success Rate</h4>
                        <p>
                            We have a strong track record of securing placements in top universities worldwide.
                        </p>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 col-sm-12">
                    <div class="makes-us-different-text makes-us-different-hover">
                        <i>
                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 60.07 60.07"
                                style="enable-background:new 0 0 60.07 60.07;" xml:space="preserve">
                                <path
                                    d="M59.921,27.964C58.908,13.099,46.934,1.124,32.068,0.11L31,0.038v28.994h28.994L59.921,27.964z M33,27.032V2.199
                                                                                                                                                                                                                  c2.475,0.265,4.854,0.859,7.097,1.732c-0.004,0.035-0.02,0.065-0.02,0.101c0,0.552,0.448,1,1,1c0.301,0,0.562-0.14,0.746-0.35
                                                                                                                                                                                                                  c4.937,2.317,9.089,6.035,11.952,10.637c-0.18-0.177-0.426-0.287-0.698-0.287c-0.552,0-1,0.448-1,1s0.448,1,1,1s1-0.448,1-1
                                                                                                                                                                                                                  c0-0.129-0.029-0.25-0.073-0.363c0.512,0.85,0.969,1.735,1.39,2.64c-0.193,0.182-0.317,0.437-0.317,0.723c0,0.552,0.448,1,1,1
                                                                                                                                                                                                                  c0.021,0,0.039-0.011,0.061-0.012c0.855,2.218,1.434,4.569,1.696,7.012H33z" />
                                <path
                                    d="M31.318,31.032l20.097,20.097l0.706-0.766c4.618-5.008,7.415-11.494,7.876-18.263l0.073-1.068H31.318z M51.343,48.229
                                                                                                                                                                                                                  L36.146,33.032h21.762C57.308,38.616,55.007,43.942,51.343,48.229z" />
                                <circle cx="35.076" cy="4.032" r="1" />
                                <circle cx="35.076" cy="10.032" r="1" />
                                <circle cx="38.076" cy="7.032" r="1" />
                                <circle cx="44.076" cy="7.032" r="1" />
                                <circle cx="41.076" cy="10.032" r="1" />
                                <circle cx="47.076" cy="10.032" r="1" />
                                <circle cx="50.076" cy="13.032" r="1" />
                                <circle cx="38.076" cy="13.032" r="1" />
                                <circle cx="44.076" cy="13.032" r="1" />
                                <circle cx="50.076" cy="19.032" r="1" />
                                <circle cx="53.076" cy="22.032" r="1" />
                                <circle cx="35.076" cy="16.032" r="1" />
                                <circle cx="35.076" cy="22.032" r="1" />
                                <circle cx="38.076" cy="19.032" r="1" />
                                <circle cx="44.076" cy="19.032" r="1" />
                                <circle cx="41.076" cy="16.032" r="1" />
                                <circle cx="47.076" cy="16.032" r="1" />
                                <circle cx="41.076" cy="22.032" r="1" />
                                <circle cx="47.076" cy="22.032" r="1" />
                                <circle cx="56.076" cy="25.032" r="1" />
                                <circle cx="50.076" cy="25.032" r="1" />
                                <circle cx="38.076" cy="25.032" r="1" />
                                <circle cx="44.076" cy="25.032" r="1" />
                                <path
                                    d="M29,0.038L27.932,0.11C12.269,1.179,0,14.321,0,30.032c0,7.239,2.621,14.233,7.38,19.695l0.704,0.808L29,29.618V0.038z
                                                                                                                                                                                                                   M27,28.79L8.199,47.591C4.194,42.623,2,36.43,2,30.032C2,15.729,12.896,3.705,27,2.199V28.79z" />
                                <path
                                    d="M9.498,51.948l0.808,0.704c5.461,4.759,12.456,7.38,19.694,7.38c6.927,0,13.687-2.425,19.037-6.826l0.851-0.7
                                                                                                                                                                                                                  L29.414,32.032L9.498,51.948z M29.414,34.86l1.101,1.101L13.707,52.768c-0.426-0.306-0.856-0.604-1.266-0.934L29.414,34.86z
                                                                                                                                                                                                                   M21.198,56.592c-0.695-0.231-1.379-0.491-2.053-0.776l15.613-15.613l1.414,1.414L21.198,56.592z M37.586,43.032L39,44.446
                                                                                                                                                                                                                  L25.756,57.691c-0.795-0.122-1.583-0.277-2.362-0.467L37.586,43.032z M17.219,54.914c-0.616-0.316-1.218-0.657-1.81-1.019
                                                                                                                                                                                                                  l16.52-16.52l1.415,1.415L17.219,54.914z M28.315,57.96l12.099-12.1l1.414,1.414L31.117,57.986
                                                                                                                                                                                                                  c-0.372,0.015-0.743,0.046-1.117,0.046C29.436,58.032,28.876,57.994,28.315,57.96z M43.242,48.689l1.415,1.415l-6.763,6.763
                                                                                                                                                                                                                  c-1.2,0.354-2.419,0.639-3.659,0.83L43.242,48.689z M42.56,55.029l3.512-3.512l0.828,0.828
                                                                                                                                                                                                                  C45.536,53.38,44.077,54.266,42.56,55.029z" />
                            </svg>
                        </i>
                        <h4>Result Oriented Performance</h4>
                        <p>
                            We offer clear, actionable plans to help students achieve their educational goals.
                        </p>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 col-sm-12">
                    <div class="makes-us-different-text makes-us-different-hover">
                        <i>
                            <svg xmlns="http://www.w3.org/2000/svg" id="&#x421;&#x43B;&#x43E;&#x439;_1"
                                data-name="&#x421;&#x43B;&#x43E;&#x439; 1" viewBox="0 0 128 128" width="512"
                                height="512">
                                <path
                                    d="M14,50c.4,0,.79,0,1.18-.06L16,54.38A2,2,0,0,0,20,53.62L19.08,49a14,14,0,0,0,8.28-17.22L54.21,18.92a12.15,12.15,0,0,0,2.18,2.35l-22,31.59a2,2,0,0,0,3.28,2.28L59.89,23.26a11.29,11.29,0,0,0,2.11.56V41a2,2,0,0,0,4,0V23.82a11.29,11.29,0,0,0,2.11-.56L90.36,55.14a2,2,0,1,0,3.28-2.28l-22-31.59a12.15,12.15,0,0,0,2.18-2.35l26.85,12.89A14,14,0,0,0,108.92,49L108,53.62a2,2,0,1,0,3.92.76l.86-4.44c.39,0,.78.06,1.18.06a14,14,0,1,0-11.62-21.8L75.52,15.31A11.67,11.67,0,0,0,76,12a12,12,0,0,0-24,0,11.67,11.67,0,0,0,.48,3.31L25.62,28.2A14,14,0,1,0,14,50ZM114,26a10,10,0,1,1-10,10A10,10,0,0,1,114,26ZM64,4a8,8,0,1,1-8,8A8,8,0,0,1,64,4ZM14,26A10,10,0,1,1,4,36,10,10,0,0,1,14,26Z" />
                                <path
                                    d="M110.71,94.45A12.67,12.67,0,0,0,116,84V67a6.85,6.85,0,0,0-7-7H96a6.85,6.85,0,0,0-7,7V84a12.65,12.65,0,0,0,5.24,10.41,24.91,24.91,0,0,0-3.78,1.66,2,2,0,1,0,1.92,3.51A20.9,20.9,0,0,1,102.51,97C114.16,97,124,107.08,124,119a2,2,0,0,0,4,0A26.37,26.37,0,0,0,110.71,94.45ZM93,67a2.84,2.84,0,0,1,3-3h13a2.84,2.84,0,0,1,3,3v5H93Zm0,17V76h19v8c0,5.13-4.08,9-9.49,9S93,89.13,93,84Z" />
                                <path
                                    d="M34.86,99.26a2,2,0,0,0,1.81-3.57c-.48-.25-2.44-1.08-2.94-1.26A12.65,12.65,0,0,0,39,84V67a6.85,6.85,0,0,0-7-7H19a6.85,6.85,0,0,0-7,7V84a12.65,12.65,0,0,0,5.24,10.41A26,26,0,0,0,0,119a2,2,0,0,0,4,0A21.78,21.78,0,0,1,25.51,97,20.69,20.69,0,0,1,34.86,99.26ZM16,67a2.84,2.84,0,0,1,3-3H32a2.84,2.84,0,0,1,3,3v5H16Zm0,17V76H35v8c0,5.13-4.08,9-9.49,9S16,89.13,16,84Z" />
                                <path
                                    d="M73.5,93.8A17.31,17.31,0,0,0,82,79V56a9,9,0,0,0-9-9H55a9,9,0,0,0-9,9V79a17.45,17.45,0,0,0,8.61,14.72A33.14,33.14,0,0,0,30.5,126a2,2,0,0,0,4,0A29.23,29.23,0,0,1,64,96.42,29.57,29.57,0,0,1,93.5,126a2,2,0,0,0,4,0A33.63,33.63,0,0,0,73.5,93.8ZM50,56a5,5,0,0,1,5-5H73a5,5,0,0,1,5,5v7H50Zm0,23V67H78V79c0,7.27-6.35,13.42-13.88,13.42S50,86.27,50,79Z" />
                            </svg>
                        </i>
                        <h4>Trustworthy</h4>
                        <p>
                            We deliver honest, reliable support, ensuring confidence throughout the application process.
                        </p>
                    </div>
                </div>
            </div>
            <div class="btugap">
                <a href="{{ route('contact-us') }}" class="themebtu">Enquire Now</a>
            </div>
        </div>
        <style>
            .makes-us-different-text {
                position: relative;
                background: #fff;
                border-radius: 15px;
                padding: 35px 25px;
                text-align: center;
                height: 100%;
                transition: all 0.5s ease;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
                overflow: hidden;
            }

            /* SVG Icon */
            .makes-us-different-text i svg {
                width: 60px;
                height: 60px;
                fill: #0038A6;
                transition: transform 0.5s ease 0.1s, fill 0.4s ease 0.1s;
            }

            /* Title */
            .makes-us-different-text h4 {
                font-size: 1.25rem;
                font-weight: 600;
                color: #222;
                margin-top: 20px;
                margin-bottom: 10px;
                transition: color 0.4s ease 0.2s;
            }

            /* Paragraph */
            .makes-us-different-text p {
                font-size: 0.95rem;
                color: #555;
                line-height: 1.6;
                transition: color 0.4s ease 0.25s;
            }

            /* Hover Effect */
            .makes-us-different-text:hover {
                transform: translateY(-12px) scale(1.02);
                background: linear-gradient(135deg,
                        #0038A6,
                        #0046C4,
                        #0058E8,
                        #003070,
                        #001F50);
                color: #fff;
                box-shadow: 0 12px 30px rgba(0, 56, 166, 0.35);
                transition-delay: 0.1s;
            }

            /* Hover Icon */
            .makes-us-different-text:hover i svg {
                fill: #fff;
                transform: scale(1.2);
            }

            /* Hover Text */
            .makes-us-different-text:hover h4,
            .makes-us-different-text:hover p {
                color: #fff;
            }

            /* Subtle Glow Animation */
            .makes-us-different-text::after {
                content: "";
                position: absolute;
                inset: 0;
                border-radius: 15px;
                background: radial-gradient(circle at center, rgba(255, 255, 255, 0.2), transparent 70%);
                opacity: 0;
                transition: opacity 0.6s ease;
            }

            .makes-us-different-text:hover::after {
                opacity: 1;
            }

            /* Button Section */
            .btugap {
                text-align: center;
                margin-top: 40px;
            }
        </style>


    </section>
    <div class="counter-style py-5" style="background-color: #f9fafc;">
        <div class="container">
            <div class="row g-4 justify-content-center">

                <!-- Counter 1 -->
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="card counter-card border-0 shadow-sm rounded-4 text-center py-5 h-100">
                        <div class="display-5 fw-bold text-gradient mb-2">
                            <span class="counter" data-target="100">100</span>+
                        </div>
                        <div class="boder mx-auto my-3" style="width:50px; height:3px; background:#ddd;"></div>
                        <span class="fs-5 fw-semibold text-secondary">Institutions</span>
                    </div>
                </div>

                <!-- Counter 2 -->
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="card counter-card border-0 shadow-sm rounded-4 text-center py-5 h-100">
                        <div class="display-5 fw-bold text-gradient mb-2">
                            <span class="counter" data-target="5000">5000</span>+
                        </div>
                        <div class="boder mx-auto my-3" style="width:50px; height:3px; background:#ddd;"></div>
                        <span class="fs-5 fw-semibold text-secondary">Happy Students</span>
                    </div>
                </div>

                <!-- Counter 3 -->
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="card counter-card border-0 shadow-sm rounded-4 text-center py-5 h-100">
                        <div class="display-5 fw-bold text-gradient mb-2">
                            <span class="counter" data-target="9">9</span>+
                        </div>
                        <div class="boder mx-auto my-3" style="width:50px; height:3px; background:#ddd;"></div>
                        <span class="fs-5 fw-semibold text-secondary">Years in Business</span>
                    </div>
                </div>
            </div>
        </div>

        <style>
            /* Counter section base style */
            .counter-style {
                overflow: hidden;
            }

            /* Card styling */
            .counter-style .counter-card {
                background: #fff;
                position: relative;
                border-radius: 18px;
                transition: all 0.4s ease;
            }

            .counter-style .counter-card:hover {
                transform: translateY(-6px);
                box-shadow: 0 10px 24px rgba(0, 0, 0, 0.1);
            }

            /* Gradient text for numbers */
            .text-gradient {
                background: linear-gradient(135deg,
                        #0038A6,
                        #0046C4,
                        #0058E8,
                        #003070,
                        #001F50);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
            }

            /* Progress hover bar */
            .counter-style .counter-card::after {
                content: "";
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
                transition: width 0.5s ease;
                border-bottom-left-radius: 18px;
                border-bottom-right-radius: 18px;
            }

            .counter-style .counter-card:hover::after {
                width: 100%;
            }

            /* Counter animation */
            .counter {
                transition: all 0.3s ease;
            }

            @media (max-width: 576px) {
                .counter-style .counter-card {
                    padding: 2rem 1rem;
                }
            }
        </style>
    </div>

    {{-- @include('frontend.layouts.why_choose_global') --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (window.Swiper) {
                new Swiper('.teamSwiper', {
                    slidesPerView: 1,
                    spaceBetween: 30,
                    loop: true,
                    navigation: {
                        nextEl: '.teamSwiper .swiper-button-next',
                        prevEl: '.teamSwiper .swiper-button-prev',
                    },
                    pagination: {
                        el: '.teamSwiper .swiper-pagination',
                        clickable: true,
                    },
                    autoplay: {
                        delay: 3000,
                        disableOnInteraction: false,
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
            }
        });
    </script>
@endsection
