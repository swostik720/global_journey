<section data-aos="fade-up" class="how-it-works visa-stories">
    <div class="container">
        <div data-aos="fade-up" data-aos-delay="90" class="heading-boder text-center">
            <h2>Visa Grant <br><span>Stories</span></h2>
            <p>Premium support, proven outcomes</p>
        </div>

        <div class="visa-stories__panel" data-aos="fade-up" data-aos-delay="140">
            <div class="row g-5 align-items-center visa-stories__hero-row">
                <div class="col-xl-5 col-lg-6">
                    <div data-aos="zoom-in-up" data-aos-delay="180" class="visa-video-wrap">
                        <div class="visa-video-frame">
                            <span class="visa-video-badge">Success Reel</span>
                            <div class="visa-video-glow"></div>

                            <video playsinline preload="metadata" class="main-video" data-video-player>
                                <source src="{{ asset('frontend/assets/img/success.mp4') }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>

                            <button type="button" class="play-overlay" data-video-overlay aria-label="Play success stories reel">
                                <span class="play-overlay__icon" aria-hidden="true"></span>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="col-xl-7 col-lg-6">
                    <aside class="visa-copy" data-aos="fade-left" data-aos-delay="220">
                        <p class="visa-copy__kicker">Global Journey Advantage</p>
                        <h3>Built for Students Who Want a Smooth, Confident Visa Outcome</h3>
                        <p class="visa-copy__desc">
                            From document strategy to interview coaching, every step is handled by experts with real embassy-level insight.
                            No guesswork, no chaos, just a clean path to your destination.
                        </p>

                        <div class="visa-copy__stats">
                            <div>
                                <strong>5,000+</strong>
                                <span>Students guided</span>
                            </div>
                            <div>
                                <strong>98%</strong>
                                <span>Visa success rate</span>
                            </div>
                            <div>
                                <strong>15+</strong>
                                <span>Years of expertise</span>
                            </div>
                        </div>

                        <a data-aos="fade-up" data-aos-delay="280" href="{{ route('about-us') }}" class="themebtu visa-copy__btn">Learn More</a>
                    </aside>
                </div>
            </div>

            <div class="success-grid" data-aos="fade-up" data-aos-delay="320">
                <article class="success-card" data-aos="fade-up" data-aos-delay="360">
                    <span class="success-card__eyebrow">Strategy</span>
                    <h3>Document Precision</h3>
                    <p>Financials, SOPs, and paperwork are reviewed line by line so your case looks clear and credible.</p>
                </article>
                <article class="success-card" data-aos="fade-up" data-aos-delay="420">
                    <span class="success-card__eyebrow">Preparation</span>
                    <h3>Interview Confidence</h3>
                    <p>Mock sessions and personalized coaching help students answer with clarity, structure, and confidence.</p>
                </article>
                <article class="success-card" data-aos="fade-up" data-aos-delay="480">
                    <span class="success-card__eyebrow">Support</span>
                    <h3>Fast, Human Guidance</h3>
                    <p>Students stay updated at every step with direct counselor support instead of confusing back-and-forth.</p>
                </article>
            </div>
        </div>

        <div class="visa-reel-modal" data-video-modal hidden>
            <div class="visa-reel-modal__backdrop" data-video-close></div>
            <div class="visa-reel-modal__dialog" role="dialog" aria-modal="true" aria-label="Visa success reel viewer">
                <button type="button" class="visa-reel-modal__close" data-video-close aria-label="Close reel viewer">
                    <i class="bi bi-x-lg" aria-hidden="true"></i>
                </button>
                <div class="visa-reel-modal__stage">
                    <video controls playsinline preload="metadata" class="visa-reel-modal__video" data-modal-video>
                        <source src="{{ asset('frontend/assets/img/success.mp4') }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            </div>
        </div>
    </div>

    <div class="tp-hero__shapes">
        <div class="style-shapes-1"></div>
        <div class="style-shapes-2">
            <img alt="shap-4" src="{{ asset('frontend/assets/img/shap-4.png') }}">
        </div>
        <div class="style-shapes-3"></div>
    </div>
</section>

<style>
    .visa-stories {
        --vs-ink: #03071A;
        --vs-accent: #60A5FA;
        --vs-accent-2: #2563EB;
        --vs-surface: #F8FBFF;
        --vs-border: rgba(29, 78, 216, 0.14);
        --vs-muted: #4A5D7A;
        position: relative;
        overflow: hidden;
        padding: 44px 0 24px;
        background: linear-gradient(180deg, #ffffff 0%, #f2f7ff 100%);
    }

    .visa-stories::before,
    .visa-stories::after {
        content: "";
        position: absolute;
        border-radius: 999px;
        pointer-events: none;
        z-index: 0;
    }

    .visa-stories::before {
        width: 420px;
        height: 420px;
        top: -180px;
        right: -140px;
        background: radial-gradient(circle, rgba(74, 144, 226, 0.18) 0%, rgba(74, 144, 226, 0) 70%);
        animation: vsFloatOrb 9s ease-in-out infinite;
    }

    .visa-stories::after {
        width: 360px;
        height: 360px;
        bottom: -160px;
        left: -110px;
        background: radial-gradient(circle, rgba(34, 102, 204, 0.16) 0%, rgba(34, 102, 204, 0) 72%);
        animation: vsFloatOrb 11s ease-in-out infinite reverse;
    }

    .visa-stories .container {
        position: relative;
        z-index: 1;
    }

    .visa-stories .heading-boder {
        display: block !important;
        width: 100% !important;
        max-width: 100% !important;
        text-align: center !important;
        margin-left: auto;
        margin-right: auto;
        margin-bottom: 26px;
    }

    .visa-stories .heading-boder h2,
    .visa-stories .heading-boder h2 span {
        color: #0f2454;
    }

    .visa-stories .heading-boder p {
        color: #4b5f82;
    }

    .visa-stories .heading-boder h2,
    .visa-stories .heading-boder p {
        display: block !important;
        width: 100% !important;
        text-align: center !important;
        margin-left: auto !important;
        margin-right: auto !important;
        float: none !important;
    }

    .visa-stories .heading-boder p {
        margin-top: 8px;
    }

    .visa-stories__panel {
        background: linear-gradient(145deg, #ffffff 0%, #f8fbff 100%);
        border: 1px solid rgba(74, 144, 226, 0.18);
        border-radius: 28px;
        box-shadow: 0 24px 65px rgba(7, 30, 70, 0.12);
        padding: clamp(20px, 2.6vw, 34px);
        transition: transform 0.35s ease, box-shadow 0.35s ease, border-color 0.35s ease;
    }

    .visa-stories__panel:hover {
        transform: translateY(-4px);
        border-color: rgba(74, 144, 226, 0.28);
        box-shadow: 0 30px 70px rgba(7, 30, 70, 0.15);
    }

    .visa-stories__hero-row {
        margin-bottom: 28px;
    }

    .visa-video-wrap {
        height: 100%;
        display: flex;
        justify-content: center;
    }

    .visa-video-frame {
        position: relative;
        width: min(100%, 320px);
        aspect-ratio: 9 / 16;
        max-height: 560px;
        border-radius: 26px;
        overflow: hidden;
        border: 1px solid rgba(74, 144, 226, 0.22);
        box-shadow: 0 16px 44px rgba(7, 30, 70, 0.18);
        background: #000;
        transition: transform 0.45s ease, box-shadow 0.45s ease, border-color 0.45s ease;
    }

    .visa-video-frame:hover {
        transform: translateY(-8px) rotate(-1deg);
        border-color: rgba(74, 144, 226, 0.42);
        box-shadow: 0 24px 60px rgba(7, 30, 70, 0.26);
    }

    .visa-video-badge {
        position: absolute;
        left: 16px;
        top: 16px;
        z-index: 4;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 7px 12px;
        border-radius: 999px;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        font-weight: 700;
        color: #fff;
        background: linear-gradient(135deg, var(--vs-accent), var(--vs-accent-2));
        box-shadow: 0 10px 22px rgba(34, 102, 204, 0.35);
    }

    .visa-video-glow {
        position: absolute;
        inset: -30% -35% auto;
        height: 70%;
        background: radial-gradient(circle, rgba(74, 144, 226, 0.32) 0%, rgba(74, 144, 226, 0) 70%);
        z-index: 1;
        pointer-events: none;
        animation: vsRotateGlow 10s linear infinite;
    }

    .visa-stories .main-video {
        width: 100%;
        height: 100%;
        object-fit: contain;
        object-position: center;
        display: block;
        position: relative;
        z-index: 2;
        background: #000;
        filter: saturate(1.08) contrast(1.06);
        transition: transform 0.55s ease, filter 0.55s ease;
    }

    .visa-video-frame:hover .main-video {
        transform: scale(1.015);
        filter: saturate(1.14) contrast(1.08);
    }

    .visa-stories .play-overlay {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 84px;
        height: 84px;
        border-radius: 50%;
        border: 1px solid rgba(255, 255, 255, 0.55);
        background: rgba(3, 7, 26, 0.36);
        backdrop-filter: blur(7px);
        z-index: 5;
        cursor: pointer;
        transition: transform 0.25s ease, background 0.25s ease, opacity 0.35s ease;
        animation: vsPulse 1.8s ease-in-out infinite;
    }

    .visa-stories .play-overlay:hover {
        transform: translate(-50%, -50%) scale(1.07);
        background: rgba(74, 144, 226, 0.75);
    }

    .visa-stories .play-overlay__icon {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-42%, -50%);
        width: 0;
        height: 0;
        border-top: 11px solid transparent;
        border-bottom: 11px solid transparent;
        border-left: 17px solid #ffffff;
    }

    .visa-stories .play-overlay.is-hidden {
        opacity: 0;
        visibility: hidden;
        pointer-events: none;
    }

    .visa-reel-modal[hidden] {
        display: none;
    }

    .visa-reel-modal {
        position: fixed;
        inset: 0;
        z-index: 2000;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100dvh;
        padding: 24px;
        overflow-y: auto;
        overscroll-behavior: contain;
    }

    .visa-reel-modal__backdrop {
        position: absolute;
        inset: 0;
        background: rgba(2, 6, 23, 0.76);
        backdrop-filter: blur(10px);
    }

    .visa-reel-modal__dialog {
        position: relative;
        z-index: 1;
        width: min(360px, calc(100vw - 32px), calc((100dvh - 48px) * 9 / 16));
        margin: auto;
    }

    .visa-reel-modal__close {
        position: absolute;
        top: -14px;
        right: -14px;
        z-index: 2;
        width: 40px;
        height: 40px;
        border: 1px solid rgba(255, 255, 255, 0.24);
        border-radius: 50%;
        background: rgba(3, 7, 26, 0.82);
        color: #fff;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        backdrop-filter: blur(8px);
        transition: transform 0.2s ease, background 0.2s ease;
    }

    .visa-reel-modal__close:hover {
        transform: scale(1.05);
        background: rgba(74, 144, 226, 0.92);
    }

    .visa-reel-modal__stage {
        width: 100%;
        aspect-ratio: 9 / 16;
        border-radius: 26px;
        overflow: hidden;
        background: #000;
        box-shadow: 0 28px 80px rgba(0, 0, 0, 0.45);
    }

    .visa-reel-modal__video {
        width: 100%;
        height: 100%;
        object-fit: contain;
        background: #000;
        display: block;
    }

    .visa-copy {
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        gap: 2px;
        border-radius: 24px;
        border: 1px solid var(--vs-border);
        padding: clamp(22px, 2.4vw, 30px);
        background: linear-gradient(160deg, #ffffff 0%, #f6faff 100%);
        box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.72);
        transition: transform 0.35s ease, box-shadow 0.35s ease, border-color 0.35s ease;
    }

    .visa-copy:hover {
        transform: translateY(-5px);
        border-color: rgba(74, 144, 226, 0.32);
        box-shadow: 0 18px 38px rgba(11, 37, 81, 0.08), inset 0 1px 0 rgba(255, 255, 255, 0.72);
    }

    .visa-copy__kicker {
        margin: 0 0 8px;
        color: var(--vs-accent-2);
        text-transform: uppercase;
        letter-spacing: 0.09em;
        font-size: 11px;
        font-weight: 700;
    }

    .visa-copy h3 {
        margin: 0;
        color: #0c1c3e;
        font-size: clamp(1.45rem, 2.25vw, 2rem);
        line-height: 1.22;
        font-weight: 800;
    }

    .visa-copy__desc {
        margin: 16px 0 22px;
        color: var(--vs-muted);
        font-size: 1rem;
        line-height: 1.78;
        max-width: 54ch;
    }

    .visa-copy__stats {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 12px;
        margin-bottom: 24px;
    }

    .visa-copy__stats > div {
        background: #fff;
        border: 1px solid rgba(74, 144, 226, 0.2);
        border-radius: 14px;
        padding: 13px 10px 12px;
        text-align: center;
        transition: transform 0.28s ease, box-shadow 0.28s ease, border-color 0.28s ease;
    }

    .visa-copy__stats > div:hover {
        transform: translateY(-4px);
        border-color: rgba(74, 144, 226, 0.34);
        box-shadow: 0 12px 24px rgba(11, 37, 81, 0.09);
    }

    .visa-copy__stats strong {
        display: block;
        color: var(--vs-accent-2);
        font-weight: 800;
        font-size: 1.08rem;
        line-height: 1.1;
    }

    .visa-copy__stats span {
        display: block;
        margin-top: 3px;
        color: #556888;
        font-size: 11px;
        letter-spacing: 0.03em;
        text-transform: uppercase;
    }

    .visa-copy__btn {
        margin-top: 4px;
        display: inline-flex;
        align-items: center;
    }

    .visa-stories .success-grid {
        margin-top: 10px;
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 16px;
    }

    .visa-stories .success-card {
        position: relative;
        border-radius: 18px;
        padding: 20px 18px;
        background: linear-gradient(145deg, #ffffff 0%, #f7fbff 100%);
        border: 1px solid rgba(74, 144, 226, 0.22);
        box-shadow: 0 12px 26px rgba(11, 37, 81, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
        overflow: hidden;
    }

    .visa-stories .success-card::before {
        content: "";
        position: absolute;
        inset: auto 0 0;
        height: 2px;
        background: linear-gradient(90deg, transparent 0%, var(--vs-accent) 52%, transparent 100%);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .visa-stories .success-card:hover {
        transform: translateY(-8px);
        border-color: rgba(74, 144, 226, 0.42);
        box-shadow: 0 20px 34px rgba(11, 37, 81, 0.16);
    }

    .visa-stories .success-card:hover::before {
        opacity: 1;
    }

    .visa-stories .success-card h3 {
        margin: 0 0 8px;
        color: #143978;
        font-size: 1.08rem;
        line-height: 1.25;
        font-weight: 800;
    }

    .visa-stories .success-card__eyebrow {
        display: inline-block;
        margin-bottom: 10px;
        color: var(--vs-accent-2);
        font-size: 10px;
        font-weight: 700;
        letter-spacing: 0.08em;
        text-transform: uppercase;
    }

    .visa-stories .success-card p {
        margin: 0;
        color: #495b78;
        font-size: 0.9rem;
        line-height: 1.7;
    }

    @keyframes vsPulse {
        0%,
        100% {
            box-shadow: 0 0 0 0 rgba(74, 144, 226, 0.36);
        }
        50% {
            box-shadow: 0 0 0 16px rgba(74, 144, 226, 0);
        }
    }

    @keyframes vsRotateGlow {
        from {
            transform: rotate(0deg);
        }
        to {
            transform: rotate(360deg);
        }
    }

    @keyframes vsFloatOrb {
        0%,
        100% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(16px);
        }
    }

    @media (max-width: 1199.98px) {
        .visa-stories__hero-row {
            margin-bottom: 24px;
        }

        .visa-stories .success-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 991.98px) {
        .visa-video-wrap {
            justify-content: center;
        }

        .visa-video-frame {
            width: min(100%, 300px);
            max-height: 520px;
            margin-left: auto;
            margin-right: auto;
        }

        .visa-copy {
            margin-top: 0;
        }

        .visa-copy__stats {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }
    }

    @media (max-width: 575.98px) {
        .visa-stories__panel {
            border-radius: 18px;
            padding: 16px;
        }

        .visa-video-frame {
            width: min(100%, 240px);
            max-height: 430px;
            border-radius: 18px;
        }

        .visa-stories .play-overlay {
            width: 66px;
            height: 66px;
        }

        .visa-stories .play-overlay__icon {
            border-top-width: 9px;
            border-bottom-width: 9px;
            border-left-width: 14px;
        }

        .visa-reel-modal {
            padding: 16px;
        }

        .visa-reel-modal__dialog {
            width: min(300px, calc(100vw - 24px), calc((100dvh - 32px) * 9 / 16));
        }

        .visa-reel-modal__close {
            top: -10px;
            right: -4px;
            width: 36px;
            height: 36px;
        }

        .visa-copy__stats {
            grid-template-columns: 1fr;
            gap: 10px;
        }

        .visa-stories .success-grid {
            grid-template-columns: 1fr;
            gap: 12px;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var sections = document.querySelectorAll('.visa-stories');

        sections.forEach(function (section) {
            var video = section.querySelector('[data-video-player]');
            var overlay = section.querySelector('[data-video-overlay]');
            var modal = section.querySelector('[data-video-modal]');
            var modalVideo = section.querySelector('[data-modal-video]');
            var closeTriggers = section.querySelectorAll('[data-video-close]');

            if (!video || !overlay) {
                return;
            }

            if (modal && modal.parentNode !== document.body) {
                document.body.appendChild(modal);
            }

            overlay.classList.remove('is-hidden');

            overlay.addEventListener('click', function () {
                if (modal && modalVideo) {
                    modal.hidden = false;
                    document.body.style.overflow = 'hidden';
                    modalVideo.currentTime = video.currentTime || 0;
                    var playPromise = modalVideo.play();
                    if (playPromise && typeof playPromise.catch === 'function') {
                        playPromise.catch(function () {});
                    }
                }
                overlay.classList.add('is-hidden');
            });

            if (modal && modalVideo) {
                closeTriggers.forEach(function (trigger) {
                    trigger.addEventListener('click', function () {
                        modalVideo.pause();
                        modal.hidden = true;
                        document.body.style.overflow = '';
                        overlay.classList.remove('is-hidden');
                    });
                });

                document.addEventListener('keydown', function (event) {
                    if (event.key === 'Escape' && !modal.hidden) {
                        modalVideo.pause();
                        modal.hidden = true;
                        document.body.style.overflow = '';
                        overlay.classList.remove('is-hidden');
                    }
                });

                modalVideo.addEventListener('ended', function () {
                    modal.hidden = true;
                    document.body.style.overflow = '';
                    overlay.classList.remove('is-hidden');
                });
            }
        });
    });
</script>

