@extends('frontend.layouts.includes.master')
@section('meta_title', 'Contact Us | ' . ($setting->name ?? config('app.name')))
@section('meta_description', 'Contact Global Journey for admissions guidance, destination planning, visa documentation support, and consultation booking.')
@section('maincontent')
    @include('frontend.layouts.includes.page_hero', [
        'eyebrow' => 'Contact Global Journey',
        'title' => 'Get in Touch ',
        'accent' => 'With Us',
        'subtitle' => 'Speak with our counselors for clear next steps on destination choice, admissions, documentation, and visa preparation.',
        'meta' => ['Fast Response', '3 Branches', 'Personalized Guidance'],
        'primaryAction' => ['label' => 'Start Consultation', 'url' => '#contact-form'],
    ])


    <!-- Contact Section -->
    <section data-aos="fade-up" class="contact-page gj-page-shell gj-page-shell--white" id="contact-form">
        <div class="container">
            <div data-aos="fade-up" data-aos-delay="100" class="gj-section-header contact-page__header">
                <span class="gj-section-header__eyebrow">Start Your Project With Us</span>
                <h2>Let's Plan Your Next Move</h2>
                <p>Tell us where you want to study, and we'll map the most practical route from application to arrival.</p>
            </div>
            <div class="row g-4 g-xl-5 align-items-start contact-page__row">
                <div class="col-xl-7 col-lg-7">
                    <div data-aos="zoom-in-up" data-aos-delay="130" class="contact-page__panel gj-surface-card gj-prose-card">
                        <div class="contact-page__panel-intro">
                            <span class="gj-meta-pill"><i class="bi bi-chat-square-heart-fill"></i> Consultation Form</span>
                            <h3>Book a conversation with the Global Journey team</h3>
                            <p>Share your destination, budget, and timeline. We'll help you identify the right country, course, and application strategy.</p>
                        </div>
                        @include('frontend.layouts.contact_form')
                    </div>
                </div>
                <div class="col-xl-5 col-lg-5">
                    <div data-aos="zoom-in-up" data-aos-delay="160" class="details-card contact-page__details gj-surface-card">
                        <span class="gj-meta-pill"><i class="bi bi-geo-alt-fill"></i> Contact Details</span>
                        <h4>Contact Details</h4>
                        <p class="contact-page__details-copy">Reach our counselors directly or connect with us on social platforms for updates and support.</p>

                        <ul class="contact-list">
                            <li>
                                <a href="tel:{{ $setting->phone ?? '+01-84856938' }}">
                                    <i class="bi bi-telephone-fill"></i>
                                    <span>{{ $setting->phone ?? '+01-84856938' }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="tel:{{ $setting->mobile ?? '+977-9843215204' }}">
                                    <i class="bi bi-phone-fill"></i>
                                    <span>{{ $setting->mobile ?? '+977-9843215204' }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="mailto:{{ $setting->email ?? 'contact@globaljourneyedu.com.np' }}">
                                    <i class="bi bi-envelope-fill"></i>
                                    <span>{{ $setting->email ?? 'contact@globaljourneyedu.com.np' }}</span>
                                </a>
                            </li>
                        </ul>

                        <hr>

                        <h5>Connect with Us</h5>
                        <ul class="social-links">
                            <li><a href="{{ $setting->fb_link ?? '#' }}" target="_blank"><i
                                        class="bi bi-facebook"></i></a></li>
                            <li><a href="{{ $setting->twitter_link ?? '#' }}" target="_blank"><i
                                        class="bi bi-twitter"></i></a></li>
                            <li><a href="{{ $setting->instagram_link ?? '#' }}" target="_blank"><i
                                        class="bi bi-instagram"></i></a></li>
                            <li><a href="{{ $setting->linkedIn_link ?? '#' }}" target="_blank"><i
                                        class="bi bi-linkedin"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Branch Offices -->
    @include('frontend.layouts.branch_network')

    <!-- Map -->
    <div data-aos="fade-up" data-aos-delay="100" class="heading-boder text-center contact-map-heading" style="margin-top: 50px;">
        <h2>Our Head Office <br><span>Location</span></h2>
        <p>Visit our headquarters or connect with the branch closest to you.</p>
    </div>
    <div class="map-wrapper">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3532.4786416232705!2d85.31936537485603!3d27.702504325706123!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb19a857567ae1%3A0xd1450b2f18a91a6f!2sGlobal%20Journey%20Education!5e0!3m2!1sen!2snp!4v1758800677538!5m2!1sen!2snp"
            allowfullscreen="" loading="lazy">
        </iframe>
    </div>
    @include('frontend.layouts.take_next_step')
    @include('frontend.layouts.stay_updated')
@endsection


@push('custom_css')
    <style>
        /* Gradient Palette */
        :root {
            --grad: linear-gradient(135deg, #0038A6, #0046C4, #0058E8, #003070, #001F50);
        }

        .contact-page__header {
            max-width: 760px;
            margin-bottom: 36px;
        }

        .contact-map-heading {
            width: 100% !important;
            max-width: 100% !important;
            text-align: center !important;
            margin: 0 auto 22px;
            padding-top: 1.5rem !important;
        }

        .contact-map-heading h2,
        .contact-map-heading h2 span,
        .contact-map-heading p {
            display: block !important;
            width: 100% !important;
            text-align: center !important;
            margin-left: auto !important;
            margin-right: auto !important;
            float: none !important;
        }

        .contact-map-heading p {
            max-width: 64ch;
            margin-top: 8px;
            color: #4b5f82;
        }

        .contact-page__panel,
        .contact-page__details {
            border-radius: 24px;
        }

        .contact-page__panel {
            padding: clamp(24px, 3vw, 34px);
        }

        .contact-page__panel-intro {
            margin-bottom: 22px;
        }

        .contact-page__panel-intro h3 {
            margin: 16px 0 10px;
            color: var(--gj-ink-800);
            font-size: clamp(1.55rem, 2vw, 2rem);
            font-weight: 800;
            line-height: 1.2;
        }

        .contact-page__panel-intro p,
        .contact-page__details-copy {
            color: var(--gj-muted-700);
            line-height: 1.75;
            margin-bottom: 0;
        }

        .details-card {
            background: #fff;
            border-radius: 24px;
            padding: 28px;
            box-shadow: 0 10px 28px rgba(0, 0, 0, 0.08);
            transition: all .3s ease;
        }

        .details-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 28px rgba(0, 0, 0, 0.15);
        }

        .details-card h4 {
            margin-top: 18px;
            font-weight: 700;
            margin-bottom: 12px;
            color: var(--gj-ink-800);
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

        @media (max-width: 991.98px) {
            .contact-page__header {
                margin-bottom: 28px;
            }

            .contact-page__panel,
            .details-card {
                padding: 24px;
            }

            .map-wrapper {
                height: 280px;
                margin-bottom: 40px;
            }
        }

        @media (max-width: 575.98px) {
            .map-wrapper {
                height: 200px;
                border-radius: 12px;
                margin-bottom: 32px;
            }

            .map-wrapper:hover {
                transform: none;
            }
        }
    </style>
@endpush

