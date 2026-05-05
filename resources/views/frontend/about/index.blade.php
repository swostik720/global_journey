@extends('frontend.layouts.includes.master')
@section('meta_title', 'About Us | ' . ($setting->name ?? config('app.name')))
@section('meta_description', 'Learn about Global Journey, our counseling approach, and how we guide students through admissions, visas, and destination planning.')

@section('maincontent')
    @include('frontend.layouts.includes.page_hero', [
        'eyebrow' => 'About Global Journey',
        'title' => 'About ',
        'accent' => 'Global Journey',
        'subtitle' => 'From Nepal to the world, we guide students with clarity, strategy, and trusted support through admissions, visas, and long-term academic planning.',
        'meta' => ['13+ Years of Guidance', 'Student-First Counseling', 'Trusted Branch Network'],
        'primaryAction' => ['label' => 'Talk to Our Team', 'url' => route('contact-us')],
        'secondaryAction' => ['label' => 'Explore Services', 'url' => route('study-abroad')],
    ])

    <section data-aos="fade-up" class="about-intro gap">
        <div class="container">
            <div class="row about-intro__row g-4 g-xl-5">
                <div class="heading-boder two text-center" data-aos="fade-up" data-aos-delay="140">
                        <h2>Message from <span>CEO</span></h2>
                        <p>Students First. Results Always.</p>
                    </div>
                <div class="col-xl-5 col-lg-6">
                    <div class="about-intro__media" data-aos="zoom-in-up" data-aos-delay="120">
                        <img src="{{ asset('frontend/assets/img/ceo.png') }}" alt="Global Journey CEO">
                        <div class="about-intro__badge">13+ Years Of Guidance</div>
                    </div>
                </div>
                <div class="col-xl-7 col-lg-6">

                    <div class="about-intro__right">
                        <div class="about-intro__content" data-aos="fade-up" data-aos-delay="180">
                        <p>
                            I&apos;m Bishal Neupane, Founder and CEO of Global Journey Education. With over 13 years of
                            experience in the international education sector and as a QEAC/PIER Certified Education
                            Counselor, I take great pride in helping students turn their academic dreams into reality.
                        </p>
                        <p>
                            At Global Journey Education, we are committed to providing honest, personalized, and
                            professional guidance to students aspiring to study abroad. Every student&apos;s journey is
                            unique, and our goal is to ensure they receive the support, information, and confidence they
                            need to make informed decisions for their future.
                        </p>
                        <p>
                            We are proud to serve students and families through our conveniently located branch offices
                            in Kumaripati, Chabahil, and Birtamode, where our experienced counselors are always ready to
                            assist you.
                        </p>
                        <p>
                            Thank you for trusting Global Journey Education as your partner in shaping a brighter,
                            global future.
                        </p>
                        <div class="about-intro__signature">
                            <span>Warm regards,</span>
                            <strong>Bishal Neupane</strong>
                            <span>CEO, Global Journey Education</span>
                            <span>QEAC Certified Counselor</span>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section data-aos="fade-up" class="about-team-slider gap no-top">
        <div class="container">
            <div class="heading-boder two text-center" data-aos="fade-up" data-aos-delay="100">
                <h2>Meet Our Expert <span>Team</span></h2>
                <p>Guiding your journey to global education success</p>
            </div>

            <div class="about-team-slider__wrap" data-aos="zoom-in-up" data-aos-delay="140">
                <div class="swiper aboutTeamSwiper">
                    <div class="swiper-wrapper">
                        @forelse ($teams as $team)
                            <div class="swiper-slide">
                                <article class="about-team-slide-card">
                                    <div class="about-team-slide-card__left">
                                        <img src="{{ $team->image_path }}" alt="{{ $team->name }}">
                                        <span class="about-team-slide-card__name">{{ $team->name }}</span>
                                    </div>
                                    <div class="about-team-slide-card__right">
                                        <blockquote>"{{ $team->responsibility ?: 'Education Counseling Specialist' }}"</blockquote>
                                        <p>
                                            We provide full-profile guidance, admission strategy, and complete process
                                            mapping for confident global education outcomes.
                                        </p>

                                        <div class="about-team-slide-card__contacts">
                                            <a href="mailto:{{ $team->email ?: '' }}" @if (!$team->email) aria-disabled="true" @endif>
                                                <i class="bi bi-envelope-fill"></i>
                                                <span>{{ $team->email ?: 'Email not available' }}</span>
                                            </a>
                                            <a href="tel:{{ $team->phone ?: '' }}" @if (!$team->phone) aria-disabled="true" @endif>
                                                <i class="bi bi-telephone-fill"></i>
                                                <span>{{ $team->phone ?: 'Phone not available' }}</span>
                                            </a>
                                        </div>

                                        <a href="{{ route('contact-us') }}" class="about-team-slide-card__btn">Explore Programs</a>
                                    </div>
                                </article>
                            </div>
                        @empty
                            <div class="swiper-slide">
                                <article class="about-team-slide-card about-team-slide-card--empty">
                                    <div class="about-team-slide-card__right">
                                        <blockquote>"Our team profiles will be updated shortly."</blockquote>
                                    </div>
                                </article>
                            </div>
                        @endforelse
                    </div>
                </div>

                <button class="about-team-nav about-team-nav--prev" type="button" aria-label="Previous team member">
                    <i class="bi bi-arrow-left"></i>
                </button>
                <button class="about-team-nav about-team-nav--next" type="button" aria-label="Next team member">
                    <i class="bi bi-arrow-right"></i>
                </button>

                <div class="about-team-pagination"></div>
            </div>
        </div>
    </section>

    <section data-aos="fade-up" class="about-why gap no-top pt-4">
        <div class="container">
            <div class="heading-boder two text-center py-5" data-aos="fade-up" data-aos-delay="100">
                <h2>Why Choose Global Journey Education <span>Services?</span></h2>
            </div>

            <div class="about-why__grid">
                <article class="about-why-card" data-aos="zoom-in-up" data-aos-delay="120">
                    <i class="bi bi-mortarboard-fill"></i>
                    <h4>We are Caring and Focus</h4>
                    <p>We provide personalized guidance, focusing on each student&apos;s unique academic journey.</p>
                </article>

                <article class="about-why-card" data-aos="zoom-in-up" data-aos-delay="160">
                    <i class="bi bi-trophy-fill"></i>
                    <h4>High Success Rate</h4>
                    <p>We have a strong track record of securing placements in top universities worldwide.</p>
                </article>

                <article class="about-why-card" data-aos="zoom-in-up" data-aos-delay="200">
                    <i class="bi bi-signpost-split-fill"></i>
                    <h4>Result Oriented Performance</h4>
                    <p>We offer clear, actionable plans to help students achieve their educational goals.</p>
                </article>

                <article class="about-why-card" data-aos="zoom-in-up" data-aos-delay="240">
                    <i class="bi bi-people-fill"></i>
                    <h4>Trustworthy</h4>
                    <p>We deliver honest, reliable support, ensuring confidence throughout the application process.</p>
                </article>

                <article class="about-why-card" data-aos="zoom-in-up" data-aos-delay="280">
                    <i class="bi bi-gear-fill"></i>
                    <h4>Career & Country Planning</h4>
                    <p>Plan beyond admission with clear guidance for career pathway, migration direction, and lifestyle fit.</p>
                </article>

                <article class="about-why-card" data-aos="zoom-in-up" data-aos-delay="320">
                    <i class="bi bi-mortarboard-fill"></i>
                    <h4>University & Course Selection</h4>
                    <p>Find the right course, college, and destination that align with your goals and future potential.</p>
                </article>
            </div>

            <div class="about-why__cta">
                <a href="{{ route('contact-us') }}" class="themebtu">Start Your Journey</a>
            </div>
        </div>
    </section>
    @include('frontend.layouts.includes.contact_band', [
        'eyebrow' => 'Start Your Project With Us',
        'title' => "Let's Plan Your Next Move",
        'subtitle' => 'Speak with our counselors for clear next steps on destination choice, admissions, documentation, and visa preparation.',
        'panelTitle' => 'Book a conversation with the Global Journey team',
        'panelCopy' => 'Share your destination, budget, and timeline. We will help you identify the right country, course, and application strategy.',
    ])
    @include('frontend.layouts.branch_network')
    @include('frontend.layouts.take_next_step')
    @include('frontend.layouts.stay_updated')
@endsection

@push('custom_css')
    <style>
        .about-hero {
            min-height: 500px;
        }

        .about-hero__inner {
            padding-left: 40px !important;
            white-space: normal !important;
            overflow: visible !important;
            max-width: 860px;
        }

        .about-hero__subtitle {
            margin-top: 18px;
            color: #e8f3ff;
            font-size: 18px;
            line-height: 1.8;
            max-width: 640px;
        }

        .about-intro {
            background: linear-gradient(180deg, #f7faff 0%, #ffffff 100%);
            position: relative;
            overflow: hidden;
        }

        .about-intro::before {
            content: "";
            position: absolute;
            width: 280px;
            height: 280px;
            border-radius: 50%;
            right: -80px;
            top: -80px;
            background: radial-gradient(circle, rgba(29, 78, 216, 0.15) 0%, transparent 70%);
            animation: glowPulse 4.5s ease-in-out infinite;
            pointer-events: none;
        }

        .about-intro__row {
            align-items: flex-start;
        }

        .about-intro__media {
            border-radius: 24px;
            overflow: hidden;
            position: relative;
            box-shadow: 0 22px 50px rgba(0, 35, 104, 0.16);
            min-height: 620px;
            animation: liftIn 0.8s ease both, floatSoft 6s ease-in-out infinite;
            max-width: 560px;
            margin-inline: auto;
        }

        .about-intro__media img {
            width: 100%;
            display: block;
            height: 620px;
            object-fit: cover;
            object-position: center top;
            transition: transform 0.55s ease, filter 0.4s ease;
        }

        .about-intro__media::after {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(140deg, rgba(96, 179, 255, 0.34), rgba(158, 214, 255, 0.12));
            opacity: 0;
            transition: opacity 0.35s ease;
            pointer-events: none;
        }

        .about-intro__media:hover img {
            transform: scale(1.05);
            filter: brightness(1.03);
        }

        .about-intro__media:hover::after {
            opacity: 1;
        }

        .about-intro__badge {
            position: absolute;
            left: 18px;
            bottom: 18px;
            background: linear-gradient(135deg, #0038a6, #0058e8);
            color: #fff;
            border-radius: 999px;
            padding: 10px 16px;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 0.04em;
            opacity: 0;
            transform: translateY(12px);
            transition: opacity 0.35s ease, transform 0.35s ease;
            pointer-events: none;
        }

        .about-intro__media:hover .about-intro__badge {
            opacity: 1;
            transform: translateY(0);
        }

        .about-intro__content p {
            margin-bottom: 14px;
            color: #5c6d8b;
            font-size: 15px;
            line-height: 1.82;
        }

        .about-intro__content {
            background: #ffffff;
            border: 1px solid #dce7fb;
            border-radius: 18px;
            padding: 24px 24px 18px;
            box-shadow: 0 14px 34px rgba(0, 35, 104, 0.08);
            animation: liftIn 0.95s ease both;
            margin-top: 12px;
            position: relative;
        }

        .about-intro__content::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 0;
            height: 3px;
            background: linear-gradient(90deg, #0038a6, #0058e8, #60a5fa);
            border-radius: 18px 18px 0 0;
            animation: lineGrow 1.1s ease 0.35s forwards;
        }

        .about-intro__right {
            padding-top: 8px;
        }

        .about-intro__content p {
            transition: color 0.28s ease;
        }

        .about-intro__content p:hover {
            color: #0d3f9b;
        }

        .about-intro__signature {
            margin-top: 18px;
            border-top: 1px solid #dce7fb;
            padding-top: 14px;
            display: flex;
            flex-direction: column;
            gap: 2px;
            color: #2d4577;
            font-size: 14px;
            line-height: 1.6;
        }

        .about-intro__signature strong {
            color: #0f2e73;
            font-size: 16px;
        }

        .about-team-slider {
            position: relative;
            padding: 10px 0 18px;
            background: linear-gradient(180deg, #ffffff 0%, #f3f8ff 100%);
            overflow: hidden;
        }

        .about-team-slider::before,
        .about-team-slider::after {
            content: "";
            position: absolute;
            border-radius: 50%;
            pointer-events: none;
            z-index: 0;
        }

        .about-team-slider::before {
            width: 320px;
            height: 320px;
            top: -140px;
            right: -120px;
            background: radial-gradient(circle, rgba(37, 99, 235, 0.16) 0%, rgba(37, 99, 235, 0) 72%);
        }

        .about-team-slider::after {
            width: 300px;
            height: 300px;
            bottom: -150px;
            left: -100px;
            background: radial-gradient(circle, rgba(14, 165, 233, 0.14) 0%, rgba(14, 165, 233, 0) 70%);
        }

        .about-team-slider .container {
            position: relative;
            z-index: 1;
        }

        .about-team-slider .heading-boder.two {
            margin-bottom: 8px;
        }

        .about-team-slider .heading-boder.two p {
            max-width: 58ch;
            margin-left: auto;
            margin-right: auto;
        }

        .about-team-slider__wrap {
            position: relative;
            margin-top: 30px;
            padding: 28px 74px 58px;
            background: linear-gradient(145deg, #f8fbff 0%, #eef4ff 100%);
            border-radius: 22px;
            border: 1px solid #d6e2f8;
            box-shadow: 0 22px 50px rgba(7, 30, 70, 0.12);
            animation: liftIn 0.9s ease both;
        }

        .about-team-slider__wrap::after {
            content: "";
            position: absolute;
            inset: 0;
            border-radius: 22px;
            background: linear-gradient(120deg, transparent 35%, rgba(255, 255, 255, 0.42) 50%, transparent 65%);
            transform: translateX(-120%);
            animation: sweepShine 5.5s ease-in-out infinite;
            pointer-events: none;
        }

        .aboutTeamSwiper .swiper-wrapper {
            align-items: stretch;
        }

        .aboutTeamSwiper .swiper-slide {
            height: auto;
        }

        .about-team-slide-card {
            height: 420px;
            min-height: 420px;
            background: #fff;
            border: 1px solid #d9e4f5;
            border-radius: 18px;
            overflow: hidden;
            display: grid;
            grid-template-columns: 1fr 1fr;
            box-shadow: 0 14px 32px rgba(8, 29, 71, 0.1);
            animation: liftIn 0.7s ease both;
            transition: transform 0.35s ease, box-shadow 0.35s ease, border-color 0.35s ease;
        }

        .about-team-slide-card:hover {
            transform: translateY(-8px);
            border-color: #b8cff8;
            box-shadow: 0 24px 42px rgba(7, 30, 70, 0.17);
        }

        .about-team-slide-card__left {
            position: relative;
            min-height: 420px;
            background: linear-gradient(180deg, #ffffff 0%, #edf3ff 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .about-team-slide-card__left img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center top;
            display: block;
            transition: transform 0.45s ease;
        }

        .about-team-slide-card:hover .about-team-slide-card__left img {
            transform: scale(1.03);
        }

        .about-team-slide-card__name {
            position: absolute;
            top: 16px;
            left: 16px;
            background: rgba(14, 36, 84, 0.92);
            color: #fff;
            padding: 8px 14px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            box-shadow: 0 10px 20px rgba(15, 36, 84, 0.26);
        }

        .about-team-slide-card__right {
            padding: 22px 22px 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            gap: 10px;
            overflow: hidden;
        }

        .about-team-slide-card__right blockquote {
            margin: 0;
            color: #132f72;
            font-size: clamp(1.24rem, 2.1vw, 1.75rem);
            line-height: 1.3;
            font-style: italic;
            font-weight: 500;
            font-family: Georgia, 'Times New Roman', serif;
            max-width: 100%;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .about-team-slide-card__right p {
            margin: 0;
            color: #5d7198;
            font-size: 13px;
            line-height: 1.72;
            max-width: 520px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .about-team-slide-card__contacts {
            display: grid;
            grid-template-columns: 1fr;
            gap: 9px;
            margin-top: 4px;
        }

        .about-team-slide-card__contacts a {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            width: fit-content;
            color: #163a88;
            background: #f6f9ff;
            border: 1px solid #d6e3fb;
            border-radius: 999px;
            padding: 8px 12px;
            text-decoration: none;
            font-weight: 500;
            font-size: 11px;
            transition: all 0.3s ease;
            max-width: 100%;
        }

        .about-team-slide-card__contacts a i {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            background: linear-gradient(135deg, #0f2454, #1d4ed8);
            font-size: 10px;
            flex-shrink: 0;
            box-shadow: 0 8px 16px rgba(29, 78, 216, 0.24);
        }

        .about-team-slide-card__contacts a span {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .about-team-slide-card__contacts a:hover {
            transform: translateY(-2px);
            background: #ebf2ff;
            border-color: #bfd2f8;
        }

        .about-team-slide-card__contacts a[aria-disabled="true"] {
            opacity: 0.75;
            pointer-events: none;
        }

        .about-team-slide-card--empty {
            grid-template-columns: 1fr;
            min-height: 260px;
        }

        .about-team-slide-card__btn {
            margin-top: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: fit-content;
            padding: 10px 21px;
            background: linear-gradient(135deg, #0f2454, #1d4ed8);
            color: #fff;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            text-decoration: none;
            border: 1px solid rgba(29, 78, 216, 0.4);
            border-radius: 999px;
            box-shadow: 0 12px 20px rgba(16, 46, 120, 0.2);
            transition: all 0.3s ease;
        }

        .about-team-slide-card__btn:hover {
            transform: translateY(-2px);
            color: #fff;
            background: linear-gradient(135deg, #0a1d48, #183fa8);
        }

        .about-team-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 46px;
            height: 46px;
            border: 1px solid #d0dcf5;
            border-radius: 14px;
            background: rgba(255, 255, 255, 0.96);
            color: #0d2e75;
            box-shadow: 0 14px 24px rgba(0, 35, 104, 0.13);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all 0.25s ease;
            z-index: 5;
        }

        .about-team-nav:hover {
            background: linear-gradient(135deg, #0038a6, #0058e8);
            color: #fff;
            border-color: transparent;
        }

        .about-team-nav--prev {
            left: 0;
        }

        .about-team-nav--next {
            right: 0;
        }

        .about-team-pagination {
            text-align: center;
            margin-top: 24px;
        }

        .about-team-pagination .swiper-pagination-bullet {
            width: 10px;
            height: 10px;
            border-radius: 99px;
            background: #c6d6f3;
            opacity: 1;
            transition: all 0.3s ease;
        }

        .about-team-pagination .swiper-pagination-bullet-active {
            width: 26px;
            background: linear-gradient(135deg, #0038a6, #0058e8);
        }

        .about-why {
            background: linear-gradient(180deg, #f8fbff 0%, #eef4ff 100%);
        }

        .about-why__grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 20px;
            margin-top: 30px;
        }

        .about-why-card {
            border-radius: 18px;
            background: #fff;
            border: 1px solid #dce7fb;
            box-shadow: 0 14px 34px rgba(0, 35, 104, 0.09);
            padding: 28px 24px;
            transition: all 0.3s ease;
            display: grid;
            grid-template-columns: 64px 1fr;
            align-items: start;
            gap: 16px;
            animation: liftIn 0.65s ease both;
        }

        .about-why-card:nth-child(1) {
            animation-delay: 0.04s;
        }

        .about-why-card:nth-child(2) {
            animation-delay: 0.08s;
        }

        .about-why-card:nth-child(3) {
            animation-delay: 0.12s;
        }

        .about-why-card:nth-child(4) {
            animation-delay: 0.16s;
        }

        .about-why-card:nth-child(5) {
            animation-delay: 0.2s;
        }

        .about-why-card:nth-child(6) {
            animation-delay: 0.24s;
        }

        .about-why-card:hover {
            transform: translateY(-6px);
            background: linear-gradient(135deg, #0038a6, #0058e8);
            box-shadow: 0 18px 40px rgba(0, 56, 166, 0.28);
        }

        .about-why-card i {
            width: 60px;
            height: 60px;
            border-radius: 16px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #e9f1ff;
            color: #0f388b;
            font-size: 22px;
            transition: all 0.3s ease;
        }

        .about-why-card h4,
        .about-why-card p {
            grid-column: 2;
        }

        .about-why-card h4 {
            margin-bottom: 6px;
            font-size: 24px;
            color: #0a245f;
            transition: color 0.3s ease;
        }

        .about-why-card p {
            margin: 0;
            color: #607192;
            line-height: 1.75;
            transition: color 0.3s ease;
        }

        .about-why-card:hover i {
            background: rgba(255, 255, 255, 0.2);
            color: #fff;
        }

        .about-why-card:hover h4,
        .about-why-card:hover p {
            color: #fff;
        }

        .about-why__cta {
            text-align: center;
            margin-top: 30px;
        }

        .sa-contact-section {
            padding: 0 0 58px;
            background: #f4f7fb;
            --grad: linear-gradient(135deg, #0038A6, #0046C4, #0058E8, #003070, #001F50);
        }

        .sa-contact-wrap {
            border-radius: 16px;
            border: 1px solid #dde7f5;
            background: #f6f8fc;
            box-shadow: 0 10px 28px rgba(15, 41, 95, 0.08);
            display: grid;
            grid-template-columns: minmax(0, 1.2fr) minmax(0, 0.95fr);
            gap: 28px;
            padding: 26px;
            animation: liftIn 0.9s ease both;
        }

        .sa-contact-form-col {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .sa-contact__badge {
            display: inline-block;
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: #1e40af;
            background: #eff6ff;
            border: 1px solid #bfdbfe;
            border-radius: 20px;
            padding: 4px 10px;
            margin-bottom: 10px;
        }

        .sa-contact__title {
            font-size: 2.2rem;
            margin-bottom: 10px;
            font-weight: 700;
            color: #1f2937;
        }

        .sa-contact__line {
            max-width: 80px;
            margin-top: 2px;
        }

        .sa-contact {
            border-radius: 16px;
            background: #ffffff;
            border: 1px solid #dbe6f6;
            padding: 22px;
        }

        .bds-contact-form-wrap .contact-form__form {
            border: none;
            border-radius: 0;
            padding: 0;
            background: transparent;
            box-shadow: none;
            width: 100%;
        }

        .bds-contact-form-wrap input,
        .bds-contact-form-wrap select,
        .bds-contact-form-wrap textarea {
            border-radius: 10px;
            border: 1px solid #d6e1f3;
            background: #ffffff;
            padding: 10px 12px;
        }

        .bds-contact-form-wrap button.themebtu,
        .bds-contact-form-wrap .themebtu {
            width: 100%;
            text-align: center;
            margin-top: 6px;
        }

        .sa-contact-section .details-card {
            background: #fff;
            border-radius: 14px;
            padding: 25px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
            transition: all .3s ease;
            align-self: flex-start;
            margin-top: 96px;
        }

        .sa-contact-section .details-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 28px rgba(0, 0, 0, 0.15);
        }

        .sa-contact-section .details-card h4 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 16px;
            color: #1f2937;
        }

        .sa-contact-section .details-card h5 {
            font-size: 1.15rem;
            font-weight: 700;
            margin: 14px 0 10px;
            color: #1f2937;
        }

        .sa-contact-section .details-card hr {
            border-color: #e5eaf2;
            margin: 16px 0;
        }

        .sa-contact-section .contact-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sa-contact-section .contact-list li a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 0;
            text-decoration: none;
            color: #333;
            font-size: 15px;
            transition: all .3s ease;
        }

        .sa-contact-section .contact-list li a:hover {
            color: #0038A6;
        }

        .sa-contact-section .contact-list i {
            width: 40px;
            height: 40px;
            background: #f3f3f3;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
            transition: all .4s ease;
        }

        .sa-contact-section .contact-list li:hover i {
            background: var(--grad);
            color: #fff;
            box-shadow: 0 0 12px rgba(0, 56, 166, 0.5);
        }

        .sa-contact-section .social-links {
            list-style: none;
            display: flex;
            gap: 12px;
            padding: 0;
            margin: 12px 0 0;
        }

        .sa-contact-section .social-links li {
            list-style: none;
        }

        .sa-contact-section .social-links a {
            display: grid;
            place-content: center;
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: #f3f3f3;
            color: #333;
            font-size: 16px;
            text-decoration: none;
            transition: all .5s ease;
        }

        .sa-contact-section .social-links a:hover {
            background: var(--grad);
            color: #fff;
            transform: rotate(10deg) scale(1.1);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.2);
        }

        @keyframes liftIn {
            from {
                opacity: 0;
                transform: translateY(18px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes lineGrow {
            from {
                width: 0;
            }

            to {
                width: 100%;
            }
        }

        @keyframes sweepShine {
            0%,
            70%,
            100% {
                transform: translateX(-120%);
            }

            30% {
                transform: translateX(120%);
            }
        }

        @keyframes navPulse {
            0%,
            100% {
                box-shadow: 0 10px 20px rgba(0, 35, 104, 0.12);
            }

            50% {
                box-shadow: 0 14px 26px rgba(0, 56, 166, 0.28);
            }
        }

        @keyframes glowPulse {
            0%,
            100% {
                transform: scale(1);
                opacity: 0.8;
            }

            50% {
                transform: scale(1.12);
                opacity: 1;
            }
        }

        @keyframes floatSoft {
            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-8px);
            }
        }

        @media (max-width: 1199px) {
            .about-team-slider__wrap {
                padding: 22px 58px 52px;
            }

            .about-team-slide-card {
                height: 380px;
                min-height: 380px;
                grid-template-columns: 1fr 1fr;
            }

            .about-team-slide-card__left {
                min-height: 380px;
            }

            .about-intro__media {
                min-height: 560px;
            }

            .about-intro__media img {
                height: 560px;
            }

            .sa-contact-wrap {
                grid-template-columns: minmax(0, 1fr);
                gap: 18px;
                padding: 18px;
            }

            .sa-contact-section .details-card {
                margin-top: 0;
                width: 100%;
            }
        }

        @media (max-width: 991px) {
            .about-hero__inner {
                padding-left: 10px !important;
            }

            .about-intro__right {
                padding-top: 0;
            }

            .about-team-slider__wrap {
                padding: 16px 12px 62px;
                border-radius: 16px;
            }

            .about-team-slide-card {
                min-height: 0;
                height: auto;
                grid-template-columns: 1fr;
            }

            .about-team-slide-card__left {
                min-height: 250px;
            }

            .about-team-slide-card__right p {
                font-size: 13px;
            }

            .about-team-nav {
                top: auto;
                bottom: -4px;
                transform: none;
            }

            .about-team-nav--prev {
                left: calc(50% - 62px);
            }

            .about-team-nav--next {
                right: calc(50% - 62px);
            }

            .about-why__grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 767px) {
            .about-team-slider {
                padding: 4px 0 10px;
            }

            .about-hero {
                min-height: 400px;
            }

            .about-hero__subtitle {
                font-size: 15px;
            }

            .about-team-slide-card__right blockquote {
                font-size: 28px;
            }

            .about-team-slide-card__right p {
                font-size: 15px;
            }

            .about-why__grid {
                grid-template-columns: 1fr;
            }

            .about-intro__media {
                min-height: 460px;
            }

            .about-intro__media img {
                height: 460px;
            }

            .about-team-nav {
                width: 40px;
                height: 40px;
                border-radius: 12px;
            }
        }

        @media (max-width: 575px) {
            .about-intro__media {
                min-height: 320px;
            }

            .about-intro__media img {
                height: 320px;
            }

            .about-hero {
                min-height: 320px;
            }

            .about-hero__subtitle {
                font-size: 13px;
            }
        }

        @media (hover: none) {
            .about-why__card:hover {
                transform: none;
            }
        }
    </style>
@endpush

@push('custom_js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (window.Swiper) {
                new Swiper('.aboutTeamSwiper', {
                    slidesPerView: 1,
                    spaceBetween: 0,
                    loop: true,
                    speed: 650,
                    allowTouchMove: true,
                    autoplay: false,
                    navigation: {
                        nextEl: '.about-team-nav--next',
                        prevEl: '.about-team-nav--prev',
                    },
                    pagination: {
                        el: '.about-team-pagination',
                        clickable: true,
                    },
                });
            }
        });
    </script>
@endpush

