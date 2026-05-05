<section data-aos="fade-up" class="gj-start-section">
    <div class="container">

        {{-- Section Header --}}
        <div data-aos="fade-up" data-aos-delay="60" class="gj-start-header">
            <span class="gj-start-eyebrow">
                <i class="bi bi-stars" aria-hidden="true"></i>
                Your Journey Starts Here
            </span>
            <h2>Let's Start Your Journey <strong>Together</strong></h2>
            <p>We make a difference — one student at a time. Personalised. Trusted. Proven.</p>
        </div>

        <div class="row g-lg-5 g-4 align-items-stretch gj-start-row">

            {{-- Left: Video + Stats --}}
            <div class="col-lg-6" data-aos="fade-right" data-aos-delay="140">
                <div class="gj-start-video">
                    <div class="gj-start-video__overlay"></div>
                    <img src="{{ asset('frontend/assets/img/team.jpg') }}"
                         alt="Global Journey Team"
                         class="gj-start-video__img">
                    <a class="gj-start-video__play" data-fancybox
                       href="https://www.youtube.com/embed/oWomYbpdLjA?si=_9vfMRMOXfGv16pI"
                       aria-label="Watch our team video">
                        <span class="gj-start-video__play-ring" aria-hidden="true"></span>
                        <i class="bi bi-play-fill" aria-hidden="true"></i>
                    </a>
                    <div class="gj-start-video__badge">
                        <i class="bi bi-check-circle-fill"></i>
                        Trusted by 5,000+ Students
                    </div>
                </div>

                {{-- Stat Pills --}}
                <div class="gj-start-stats" data-aos="fade-up" data-aos-delay="240">
                    <div class="gj-start-stat">
                        <div class="gj-start-stat__value">5,000+</div>
                        <div class="gj-start-stat__label">Students Placed</div>
                    </div>
                    <div class="gj-start-stat">
                        <div class="gj-start-stat__value">15+</div>
                        <div class="gj-start-stat__label">Countries</div>
                    </div>
                    <div class="gj-start-stat">
                        <div class="gj-start-stat__value">98%</div>
                        <div class="gj-start-stat__label">Visa Success</div>
                    </div>
                    <div class="gj-start-stat">
                        <div class="gj-start-stat__value">10+</div>
                        <div class="gj-start-stat__label">Yrs Experience</div>
                    </div>
                </div>
            </div>

            {{-- Right: Form Card --}}
            <div class="col-lg-6" data-aos="fade-left" data-aos-delay="190">
                <div class="gj-start-form-card">
                    <div class="gj-start-form-card__head">
                        <h3 class="gj-start-form-card__title">Get In <span>Touch</span></h3>
                        <p class="gj-start-form-card__sub">Begin your global education journey today!</p>
                    </div>
                    <p class="gj-start-desc">
                        Whether you're looking to study in Australia, Canada, the UK, or beyond —
                        expert advice, tailored support, no guesswork.
                    </p>
                    @include('frontend.layouts.enquiry_form')
                </div>
            </div>

        </div>
    </div>
</section>

<style>
    /* Let's Start Together */
    .gj-start-section {
        background: linear-gradient(135deg, #06163c 0%, #00317a 100%);
        position: relative;
        isolation: isolate;
        overflow: hidden;
        padding: 42px 0 58px;
        margin-top: 0;
    }

    /* Background Orbs */
    .gj-start-section::before {
        content: '';
        position: absolute;
        width: 560px;
        height: 560px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(0, 88, 232, 0.20) 0%, transparent 70%);
        top: -160px;
        right: -120px;
        pointer-events: none;
    }

    .gj-start-section::after {
        content: '';
        position: absolute;
        width: 360px;
        height: 360px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(96, 165, 250, 0.12) 0%, transparent 70%);
        bottom: -80px;
        left: -60px;
        pointer-events: none;
    }

    .gj-start-section .container::before {
        content: '';
        position: absolute;
        inset: 10px 0 auto;
        height: 220px;
        background: radial-gradient(circle at 50% 0%, rgba(255, 255, 255, 0.10), transparent 70%);
        pointer-events: none;
        z-index: -1;
    }

    .gj-start-section > .container {
        position: relative;
        z-index: 1;
    }

    /* Section Header */
    .gj-start-header {
        text-align: center;
        margin-bottom: 34px;
    }

    .gj-start-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        background: rgba(255, 255, 255, 0.10);
        border: 1px solid rgba(255, 255, 255, 0.20);
        border-radius: 999px;
        padding: 5px 18px;
        color: rgba(255, 255, 255, 0.88);
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        margin-bottom: 16px;
    }

    .gj-start-eyebrow i {
        color: #60a5fa;
        font-size: 9px;
    }

    .gj-start-header h2 {
        color: #ffffff;
        font-size: clamp(2rem, 4vw, 3rem);
        font-weight: 800;
        line-height: 1.16;
        margin-bottom: 12px;
        letter-spacing: -0.02em;
    }

    .gj-start-header h2 strong {
        color: #60a5fa;
        font-weight: 800;
    }

    .gj-start-header p {
        color: rgba(255, 255, 255, 0.62);
        font-size: 1rem;
        max-width: 54ch;
        margin: 0 auto;
        padding-bottom: 0;
    }

    /* Video */
    .gj-start-video {
        position: relative;
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 36px 80px rgba(0, 0, 0, 0.50);
        border: 1px solid rgba(255, 255, 255, 0.10);
    }

    .gj-start-video__img {
        width: 100%;
        height: 400px;
        object-fit: cover;
        display: block;
        transition: transform 0.55s ease, filter 0.55s ease;
    }

    .gj-start-video:hover .gj-start-video__img {
        transform: scale(1.04);
        filter: brightness(0.84);
    }

    .gj-start-video__overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, rgba(0, 18, 60, 0.06) 0%, rgba(0, 18, 60, 0.54) 100%);
        z-index: 1;
        transition: background 0.35s ease;
    }

    .gj-start-video:hover .gj-start-video__overlay {
        background: linear-gradient(180deg, rgba(0, 18, 60, 0.14) 0%, rgba(0, 18, 60, 0.66) 100%);
    }

    .gj-start-video__play {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 3;
        width: 82px;
        height: 82px;
        border-radius: 50%;
        background: linear-gradient(135deg, #1d4ed8, #60a5fa);
        color: #fff;
        font-size: 26px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        box-shadow: 0 16px 44px rgba(29, 78, 216, 0.58);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .gj-start-video__play i {
        margin-left: 5px;
    }

    .gj-start-video__play-ring {
        position: absolute;
        inset: -13px;
        border-radius: 50%;
        border: 2px solid rgba(96, 165, 250, 0.45);
        animation: gjPlayPulse 2.2s ease-in-out infinite;
    }

    .gj-start-video__play:hover {
        transform: translate(-50%, -50%) scale(1.12);
        box-shadow: 0 22px 55px rgba(29, 78, 216, 0.68);
    }

    .gj-start-video__badge {
        position: absolute;
        bottom: 18px;
        left: 18px;
        z-index: 3;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(255, 255, 255, 0.96);
        color: #0038A6;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 0.03em;
        padding: 8px 16px;
        border-radius: 999px;
        box-shadow: 0 8px 22px rgba(0, 0, 0, 0.28);
    }

    .gj-start-video__badge i {
        color: #1d4ed8;
        font-size: 14px;
    }

    /* Stats Row */
    .gj-start-stats {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 12px;
        margin-top: 16px;
    }

    .gj-start-stat {
        background: rgba(255, 255, 255, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.14);
        border-radius: 16px;
        padding: 16px 8px;
        text-align: center;
        backdrop-filter: blur(10px);
        transition: background 0.25s ease, transform 0.25s ease;
    }

    .gj-start-stat:hover {
        background: rgba(255, 255, 255, 0.14);
        transform: translateY(-3px);
    }

    .gj-start-stat__value {
        font-size: 1.4rem;
        font-weight: 800;
        color: #ffffff;
        line-height: 1.1;
    }

    .gj-start-stat__label {
        font-size: 11px;
        color: rgba(255, 255, 255, 0.62);
        margin-top: 4px;
        line-height: 1.3;
    }

    /* Form Card */
    .gj-start-form-card {
        background: #ffffff;
        border-radius: 28px;
        padding: 38px 36px;
        box-shadow: 0 44px 96px rgba(0, 8, 38, 0.48);
        border: 1px solid rgba(29, 78, 216, 0.12);
        height: 100%;
        display: flex;
        flex-direction: column;
        position: relative;
        overflow: hidden;
    }

    .gj-start-form-card::before {
        content: '';
        position: absolute;
        left: 0;
        right: 0;
        top: 0;
        height: 4px;
        background: linear-gradient(90deg, #0f2460, #1d4ed8, #60a5fa);
    }

    .gj-start-form-card__head {
        margin-bottom: 6px;
    }

    .gj-start-form-card__title {
        font-size: clamp(1.5rem, 2.8vw, 2rem);
        font-weight: 800;
        color: #0b1f44;
        line-height: 1.2;
        margin-bottom: 4px;
    }

    .gj-start-form-card__title span {
        color: #1d4ed8;
    }

    .gj-start-form-card__sub {
        color: #4A5D7A;
        font-size: 0.93rem;
        margin-bottom: 0;
    }

    .gj-start-desc {
        color: #4A5D7A;
        font-size: 0.93rem;
        line-height: 1.76;
        margin: 12px 0 20px;
        border-left: 3px solid #dbeafe;
        padding-left: 12px;
    }

    /* Keyframes */
    @keyframes gjPlayPulse {
        0%, 100% { transform: scale(1); opacity: 0.70; }
        50% { transform: scale(1.20); opacity: 0; }
    }

    /* Responsive */
    @media (max-width: 1199.98px) {
        .gj-start-stats { grid-template-columns: repeat(2, 1fr); }
    }

    @media (max-width: 991.98px) {
        .gj-start-section { padding: 36px 0 44px; }
        .gj-start-video__img { height: 340px; }
        .gj-start-form-card { padding: 28px 24px; }
        .gj-start-stats { grid-template-columns: repeat(4, 1fr); gap: 8px; }
    }

    @media (max-width: 575.98px) {
        .gj-start-section { padding: 30px 0 36px; }
        .gj-start-header { margin-bottom: 24px; }
        .gj-start-video__img { height: 260px; }
        .gj-start-video__play { width: 66px; height: 66px; font-size: 22px; }
        .gj-start-stats { grid-template-columns: repeat(2, 1fr); }
        .gj-start-form-card { padding: 22px 18px; border-radius: 20px; }
    }
</style>
