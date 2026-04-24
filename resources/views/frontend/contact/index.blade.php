@extends('frontend.layouts.includes.master')
@section('maincontent')
    <!-- Hero Section -->

    <section data-aos="fade-up" class="splash-area-section" style="background-image: url({{ asset('frontend/assets/img/background.jpg') }})">
    <div class="container">
        <div class="splash-area">
            <h1 class="splash-title">Get in Touch <span class="gradient-text">With Us</span></h1>
        </div>
    </div>

    <style>
        /* Keep font size fixed at 70px */
        .splash-title {
            font-size: 70px;
            line-height: 1.1;
            margin: 0;
            padding-left: 50px;
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

        /* Optional: scale text slightly on very small screens */
        @media (max-width: 400px) {
            .splash-title {
                font-size: 70px;
                padding-left: 10px;
            }
        }
    </style>
</section>


    <!-- Contact Section -->
    <section data-aos="fade-up" class="contact-page gap" id="contact-form">
        <div class="container">
            <div data-aos="fade-up" data-aos-delay="100" class="heading text-left mb-5">
                <h6>Start Your Project With Us.</h6>
                <h2>Let's Talk</h2>
                <img alt="line" src="{{ asset('frontend/assets/img/headingline.png') }}">
            </div>
            <div class="row">
                <!-- Form -->
                <div class="col-xl-6 col-lg-6 mb-4">
                    @include('frontend.layouts.contact_form')
                </div>
                <!-- Contact Details -->
                <div class="offset-lg-1 col-xl-5 col-lg-5">
                    <div data-aos="zoom-in-up" data-aos-delay="140" class="details-card">
                        <h4>Contact Details</h4>

                        <ul class="contact-list">
                            <li>
                                <a href="tel:{{ $setting->phone ?? '+01-84856938' }}">
                                    <i class="fa-solid fa-phone"></i>
                                    <span>{{ $setting->phone ?? '+01-84856938' }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="tel:{{ $setting->mobile ?? '+977-9843215204' }}">
                                    <i class="fa-solid fa-mobile"></i>
                                    <span>{{ $setting->mobile ?? '+977-9843215204' }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="mailto:{{ $setting->email ?? 'contact@globaljourneyedu.com.np' }}">
                                    <i class="fa-solid fa-envelope"></i>
                                    <span>{{ $setting->email ?? 'contact@globaljourneyedu.com.np' }}</span>
                                </a>
                            </li>
                        </ul>

                        <hr>

                        <h5>Connect with Us</h5>
                        <ul class="social-links">
                            <li><a href="{{ $setting->fb_link ?? '#' }}" target="_blank"><i
                                        class="fa-brands fa-facebook-f"></i></a></li>
                            <li><a href="{{ $setting->twitter_link ?? '#' }}" target="_blank"><i
                                        class="fa-brands fa-twitter"></i></a></li>
                            <li><a href="{{ $setting->instagram_link ?? '#' }}" target="_blank"><i
                                        class="fa-brands fa-instagram"></i></a></li>
                            <li><a href="{{ $setting->linkedIn_link ?? '#' }}" target="_blank"><i
                                        class="fa-brands fa-linkedin-in"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Branch Offices -->
    <section data-aos="fade-up" class="offices gap" style="background-color:#f9fbfd;">
        <div class="container">
            <div data-aos="fade-up" data-aos-delay="100" class="heading text-left mb-5">
                <h6>Explore Our Locations</h6>
                <h2>Discover Our Global Branch Network</h2>
                <img alt="line" src="{{ asset('frontend/assets/img/headingline.png') }}">
            </div>
            <div class="container">
                <div class="row g-4">
                    @foreach ($branches as $branch)
                        <div class="col-xl-6 col-lg-6">
                            <div data-aos="zoom-in-up" data-aos-delay="140" class="branch-card">
                                <h3>{{ $branch->name ?? '' }}</h3>
                                <ul>
                                    <li><i class="fa-solid fa-envelope"></i> {{ $branch->email ?? '' }}</li>
                                    <li><i class="fa-solid fa-location-dot"></i> {{ $branch->contact_address ?? '' }}</li>
                                    <li><i class="fa-solid fa-phone"></i> {{ $branch->phone ?? '' }}</li>
                                    <li><i class="fa-solid fa-clock"></i> {{ $branch->working_hours ?? '' }}</li>
                                </ul>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Map -->
    <div data-aos="fade-up" data-aos-delay="100" class="heading mb-4 text-center pt-5">
        <h6>Find Us Here</h6>
        <h2>Our Head Office Location</h2>
        <img alt="line" src="{{ asset('frontend/assets/img/headingline.png') }}">
    </div>
    <div class="map-wrapper">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3532.4786416232705!2d85.31936537485603!3d27.702504325706123!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb19a857567ae1%3A0xd1450b2f18a91a6f!2sGlobal%20Journey%20Education!5e0!3m2!1sen!2snp!4v1758800677538!5m2!1sen!2snp"
            allowfullscreen="" loading="lazy">
        </iframe>
    </div>
@endsection

@push('custom_css')
    <style>
        /* Gradient Palette */
        :root {
            --grad: linear-gradient(135deg, #0038A6, #0046C4, #0058E8, #003070, #001F50);
        }

        /* Hero Section */
        .contact-hero {
            position: relative;
            background-size: cover;
            background-position: center;
            padding: 120px 0;
            color: #fff;
        }

        .contact-hero .overlay {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
        }

        .contact-hero .splash-area {
            position: relative;
            z-index: 2;
        }

        .contact-hero h2 {
            font-size: 38px;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .theme-btn {
            display: inline-block;
            padding: 12px 28px;
            background: var(--grad);
            color: #fff !important;
            border-radius: 8px;
            font-weight: 600;
            transition: all .4s ease;
            text-decoration: none;
            position: relative;
            overflow: hidden;
        }

        .theme-btn:hover {
            background-position: right center;
            transform: translateY(-3px) scale(1.03);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.25);
        }

        /* Details Card */
        .details-card {
            background: #fff;
            border-radius: 14px;
            padding: 25px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
            transition: all .3s ease;
        }

        .details-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 28px rgba(0, 0, 0, 0.15);
        }

        .details-card h4 {
            font-weight: 700;
            margin-bottom: 18px;
        }

        .contact-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .contact-list li a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 0;
            font-size: 15px;
            color: #333;
            transition: all .3s ease;
        }

        .contact-list li a:hover {
            color: #0038A6;
        }

        .contact-list i {
            width: 40px;
            height: 40px;
            background: #f3f3f3;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
            transition: all .4s ease;
        }

        .contact-list li:hover i {
            background: var(--grad);
            color: #fff;
            box-shadow: 0 0 12px rgba(0, 56, 166, 0.5);
        }

        /* Social Links */
        .social-links {
            display: flex;
            gap: 12px;
            padding: 0;
            margin: 12px 0 0 0;
        }

        .social-links li {
            list-style: none;
        }

        .social-links a {
            display: grid;
            place-content: center;
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: #f3f3f3;
            color: #333;
            font-size: 16px;
            transition: all .5s ease;
            background-size: 200% auto;
        }

        .social-links a:hover {
            background: var(--grad);
            color: #fff;
            transform: rotate(10deg) scale(1.1);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.2);
        }

        /* Branch Cards */
        .branch-card {
            background: #fff;
            border-radius: 16px;
            padding: 25px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.06);
            transition: transform .4s ease, box-shadow .4s ease, border .4s ease;
            border: 2px solid transparent;
        }

        .branch-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 32px rgba(0, 0, 0, 0.12);
            border: 2px solid transparent;
            border-image: var(--grad) 1;
        }

        .branch-card h3 {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 14px;
        }

        .branch-card ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .branch-card li {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 15px;
            color: #555;
            margin-bottom: 10px;
            transition: color .3s ease;
        }

        .branch-card li:hover {
            color: #0038A6;
        }

        .branch-card i {
            color: #0038A6;
            transition: transform .3s ease, color .3s ease;
        }

        .branch-card li:hover i {
            transform: scale(1.2);
            color: #0058E8;
        }

        /* Map */
        .map-wrapper {
            width: 100%;
            height: 400px;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
            margin: 0 auto 60px;
            transition: transform .5s ease;
        }

        .map-wrapper:hover {
            transform: scale(1.02);
        }

        .map-wrapper iframe {
            width: 100%;
            height: 100%;
            border: none;
        }
    </style>
@endpush
