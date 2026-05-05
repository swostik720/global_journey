@php
    $stayUpdatedSubtitle = $stayUpdatedSubtitle ?? 'Stay Updated';
    $stayUpdatedTitle = $stayUpdatedTitle ?? 'Updated';
    $stayUpdatedBody =
        $stayUpdatedBody ??
        'Get the latest study abroad tips, visa news, and scholarship opportunities straight to your inbox.';
    $stayUpdatedPlaceholder = $stayUpdatedPlaceholder ?? 'Enter your email address';
    $stayUpdatedButton = $stayUpdatedButton ?? 'Subscribe';
    $stayUpdatedInputId = $stayUpdatedInputId ?? 'stay-updated-email';
@endphp

<section data-aos="fade-up" class="bds-stay-updated-section">
    <div class="container">
        <div class="tp-hero__shapes bds-stay-updated__shapes" aria-hidden="true">
            <div class="style-shapes-1"></div>
            <div class="style-shapes-2">
                <img alt="shap-4" src="{{ asset('frontend/assets/img/shap-4.png') }}">
            </div>
            <div class="style-shapes-3"></div>
        </div>

        <div class="bds-newsletter-modal" data-aos="zoom-in-up" data-aos-delay="100">
            {{-- <div class="bds-newsletter-modal__top">
                <img src="{{ asset('uploaded-images/site-setting-images/' . $setting->logo) }}" alt="logo"
                    class="bds-newsletter-modal__logo">

                <span class="bds-newsletter-modal__close" aria-hidden="true">
                    <i class="bi bi-x-lg"></i>
                </span>
            </div> --}}

            <div class="row align-items-center g-4">
                <div class="col-lg-6">
                    <div class="bds-newsletter-modal__art-wrap">
                        <img src="{{ asset('frontend/assets/img/newsletter.png') }}" alt="Newsletter updates"
                            class="bds-newsletter-modal__art">
                        <span class="bds-newsletter-pill bds-newsletter-pill--one">Visa Alerts</span>
                        <span class="bds-newsletter-pill bds-newsletter-pill--two">Scholarships</span>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="bds-newsletter-modal__content">
                        <h3>Subscribe to our <span>Newsletter!</span></h3>
                        <p>{{ $stayUpdatedBody }}</p>

                        <form action="{{ route('subscribe.store') }}" method="post" class="bds-newsletter-modal__form">
                            @csrf
                            <label for="{{ $stayUpdatedInputId }}" class="visually-hidden">Email address</label>
                            <div class="bds-newsletter-modal__input-wrap">
                                <i class="bi bi-envelope"></i>
                                <input id="{{ $stayUpdatedInputId }}" type="email" name="email"
                                    placeholder="{{ $stayUpdatedPlaceholder }}" required>
                            </div>
                            <button type="submit">{{ $stayUpdatedButton }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@once
    @push('custom_css')
        <style>
            .bds-stay-updated-section,
            .bds-stay-updated-section * {
                font-family: "Poppins", sans-serif !important;
            }

            .bds-stay-updated-section {
                background: linear-gradient(180deg, #eef4ff 0%, #e1ebff 100%);
                padding: 90px 0 84px;
                position: relative;
                overflow: hidden;
            }

            .bds-stay-updated-section .container {
                position: relative;
                z-index: 1;
            }

            .bds-stay-updated__shapes {
                pointer-events: none;
            }

            .bds-stay-updated__shapes .style-shapes-1 {
                animation: bdsShapeFloatA 9s ease-in-out infinite;
            }

            .bds-stay-updated__shapes .style-shapes-2 {
                animation: bdsShapeFloatB 11s ease-in-out infinite;
            }

            .bds-stay-updated__shapes .style-shapes-3 {
                animation: bdsShapeFloatA 12s ease-in-out infinite reverse;
            }

            .bds-stay-updated__shapes .style-shapes-2 img {
                animation: bdsShapeSpin 18s linear infinite;
                transform-origin: center;
            }

            @keyframes bdsShapeFloatA {
                0%,
                100% {
                    transform: translate3d(0, 0, 0);
                }
                50% {
                    transform: translate3d(0, -12px, 0);
                }
            }

            @keyframes bdsShapeFloatB {
                0%,
                100% {
                    transform: translate3d(0, 0, 0);
                }
                50% {
                    transform: translate3d(10px, -8px, 0);
                }
            }

            @keyframes bdsShapeSpin {
                from {
                    transform: rotate(0deg);
                }
                to {
                    transform: rotate(360deg);
                }
            }

            .bds-newsletter-modal {
                background: #ffffff;
                border-radius: 26px;
                border: 1px solid rgba(15, 36, 96, 0.12);
                box-shadow: 0 30px 80px rgba(12, 32, 82, 0.18);
                padding: 24px 26px 26px;
                max-width: 1080px;
                margin: 0 auto;
                position: relative;
            }

            .bds-newsletter-modal__top {
                display: flex;
                align-items: center;
                justify-content: space-between;
                margin-bottom: 10px;
            }

            .bds-newsletter-modal__logo {
                width: 148px;
                height: auto;
            }

            .bds-newsletter-modal__close {
                width: 34px;
                height: 34px;
                border-radius: 50%;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                color: #0f2460;
                background: #f2f6ff;
                border: 1px solid rgba(15, 36, 96, 0.14);
                font-size: 13px;
            }

            .bds-newsletter-modal__art-wrap {
                position: relative;
                padding: 8px;
                max-width: 520px;
                margin: 0 auto;
                min-height: 420px;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .bds-newsletter-modal__art {
                width: min(100%, 480px);
                max-height: 480px;
                object-fit: contain;
                display: block;
                margin-inline: auto;
                filter: drop-shadow(0 20px 34px rgba(15, 36, 96, 0.14));
            }

            .bds-newsletter-pill {
                position: absolute;
                display: inline-flex;
                align-items: center;
                border-radius: 999px;
                padding: 6px 12px;
                font-size: 11px;
                font-weight: 700;
                letter-spacing: 0.05em;
                text-transform: uppercase;
                color: #0f2460;
                background: #e8f0ff;
                border: 1px solid rgba(29, 78, 216, 0.2);
            }

            .bds-newsletter-pill--one {
                left: -4px;
                top: 6px;
            }

            .bds-newsletter-pill--two {
                right: -8px;
                bottom: 8px;
            }

            .bds-newsletter-modal__content h3 {
                color: #111827;
                font-size: clamp(1.8rem, 3vw, 2.4rem);
                line-height: 1.15;
                font-weight: 800;
                margin: 0 0 10px;
                letter-spacing: -0.01em;
            }

            .bds-newsletter-modal__content h3 span {
                color: #1d4ed8;
            }

            .bds-newsletter-modal__content p {
                margin: 0 0 18px;
                color: #4b5f82;
                font-size: 0.98rem;
                line-height: 1.72;
                max-width: 48ch;
            }

            .bds-newsletter-modal__form {
                display: grid;
                gap: 10px;
                max-width: 430px;
            }

            .bds-newsletter-modal__input-wrap {
                display: flex;
                align-items: center;
                gap: 10px;
                border: 1px solid rgba(15, 36, 96, 0.22);
                background: #f9fbff;
                border-radius: 12px;
                padding: 0 12px;
                min-height: 52px;
            }

            .bds-newsletter-modal__input-wrap i {
                color: #1d4ed8;
                font-size: 16px;
            }

            .bds-newsletter-modal__input-wrap input {
                width: 100%;
                border: 0;
                background: transparent;
                outline: none;
                font-size: 14px;
                color: #0f172a;
            }

            .bds-newsletter-modal__input-wrap input::placeholder {
                color: #7b8da9;
            }

            .bds-newsletter-modal__form button {
                min-height: 50px;
                border: 0;
                border-radius: 12px;
                font-size: 14px;
                font-weight: 700;
                color: #fff;
                background: linear-gradient(135deg, #0f2460, #1d4ed8);
                box-shadow: 0 12px 28px rgba(15, 36, 96, 0.24);
                transition: transform 0.2s ease, box-shadow 0.2s ease;
            }

            .bds-newsletter-modal__form button:hover {
                transform: translateY(-1px);
                box-shadow: 0 16px 30px rgba(15, 36, 96, 0.30);
            }

            @media (max-width: 991.98px) {
                .bds-stay-updated-section {
                    padding: 70px 0 64px;
                }

                .bds-newsletter-modal {
                    padding: 20px 18px 20px;
                }

                .bds-newsletter-modal__content {
                    margin-top: 4px;
                }

                .bds-newsletter-modal__form {
                    max-width: 100%;
                }

                .bds-newsletter-modal__art-wrap {
                    max-width: 420px;
                    min-height: 340px;
                }

                .bds-newsletter-modal__art {
                    width: min(100%, 360px);
                    max-height: 360px;
                }
            }

            @media (max-width: 575.98px) {
                .bds-newsletter-modal__logo {
                    width: 124px;
                }

                .bds-newsletter-modal__content h3 {
                    font-size: 1.65rem;
                }

                .bds-newsletter-pill {
                    font-size: 10px;
                    padding: 5px 10px;
                }

                .bds-newsletter-modal__art-wrap {
                    max-width: 280px;
                    min-height: 250px;
                }

                .bds-newsletter-modal__art {
                    width: min(100%, 240px);
                    max-height: 240px;
                }

                .bds-newsletter-pill--one {
                    left: -6px;
                    top: 0;
                }

                .bds-newsletter-pill--two {
                    right: -6px;
                    bottom: 0;
                }
            }
        </style>
    @endpush
@endonce

