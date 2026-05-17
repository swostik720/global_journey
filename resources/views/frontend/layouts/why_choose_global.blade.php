<section data-aos="fade-up" class="gap gj-proof" aria-label="Student Testimonials">
    <div class="container">
        <div data-aos="fade-up" data-aos-delay="100" class="heading-boder two text-center">
            <h2>Why Choose Global <span> Journeys?</span></h2>
            <p>Hear What Our Students Say!</p>
        </div>

        <div class="tp-hero__shapes">
            <div class="style-shapes-5">
                <img alt="dots1" src="{{ asset('frontend/assets/img/shap-1.png') }}">
            </div>
            <div class="style-shapes-6">
                <img alt="dots1" src="{{ asset('frontend/assets/img/shap-4.png') }}">
            </div>
            <div class="style-shapes-7">
                <img alt="dots1" src="{{ asset('frontend/assets/img/shap-5.png') }}">
            </div>
        </div>

        <div class="gj-proof-frame">
            <div class="swiper gj-proof-swiper">
                <div class="swiper-wrapper">
                    @foreach ($testimonials as $testimonial)
                        <div class="swiper-slide">
                            <article class="gj-proof-card" data-aos="fade-up"
                                data-aos-delay="{{ 140 + ($loop->index % 3) * 80 }}">
                                <div class="gj-proof-media">
                                    <img alt="{{ $testimonial->name ?? 'Student' }}"
                                        src="{{ $testimonial->image_path ?? '' }}">
                                    <div class="gj-proof-meta">
                                        <h3>{{ $testimonial->name ?? '' }}</h3>
                                        <p>{{ $testimonial->address ?? '' }}</p>
                                    </div>
                                </div>

                                <div class="gj-proof-content">
                                    <p class="gj-proof-text">{!! $testimonial->description ?? '' !!}</p>

                                    <div class="gj-proof-rating"
                                        aria-label="Rating {{ intval($testimonial->rating) }} out of 5">
                                        @for ($i = 0; $i < 5; $i++)
                                            <i class="bi bi-star-fill"
                                                style="opacity: {{ $i < intval($testimonial->rating) ? '1' : '.22' }}"></i>
                                        @endfor
                                    </div>

                                    <div class="gj-proof-controls">
                                        <div class="gj-proof-buttons">
                                            <button type="button" class="gj-proof-btn gj-proof-prev"
                                                aria-label="Previous testimonial">&#8249;</button>
                                            <button type="button" class="gj-proof-btn gj-proof-pause"
                                                aria-label="Pause autoplay">&#10074;&#10074;</button>
                                            <button type="button" class="gj-proof-btn gj-proof-next"
                                                aria-label="Next testimonial">&#8250;</button>
                                        </div>

                                        <div class="gj-proof-progress-wrap" aria-hidden="true">
                                            <span class="gj-proof-progress-fill"></span>
                                        </div>

                                        <div class="gj-proof-counter"><span class="gj-proof-current">01</span> / <span
                                                class="gj-proof-total">01</span></div>
                                    </div>
                                </div>
                            </article>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div data-aos="fade-up" data-aos-delay="260" class="text-center mt-5">
            <a data-aos="fade-up" data-aos-delay="340"
                href="https://www.google.com/search?client=ms-android-xiaomi-terr1-rso2&sca_esv=96401a4aa5f3e59e&sxsrf=AE3TifNIFMqgddFDRIezsJhcv4ZMgat3oQ:1758813167366&q=global+journey+education+kathmandu+reviews&uds=AOm0WdGCrBrLBW3vjUiZVdrnKqNnJ21ZA369CsCeiRTYwopz-ecHTUTypGHio094ex4TMER1BC9ZoZIQslzZtdU8LlyxTeMW8ejrhbvy7Z45Zicrg-_DTI7gktLTGTHiqRP7MUthYUBLOLqI5ZFUYP6SrWSegimfjMvgw2QJUOOtOyXqCE22hFh4XBKZ1Otk5uL-MuCzgFg_OOB-1uTXRjkXOZrlOqLaA1HK-npuqqPxsiPpni0RLePyGc_mPsaTfuU4g4Xtrw0aqONKVu-iO7vyuV60fqXnjzTg3feVV_SVcmfdTZvFGghonyhmPA9D_8-DpanEmDaJjPQzlJJ4R1T4Y09MU4zqyKjijgpdSpbHLMOgg8a4BYtD-KVUvAjMb27MBz5-P822jvuD5SMS3kxw0scmIJ0KiPxqp6RFIq45vRh6lwYJbOw1_f1o5dBukjZ46l1_jgJYH5-ueXjVZdIb3wMCyE_wca36VEjEAjLs6wm0888nEJ7jQcloK-1ULnz5DP3t4r3zZV8YvbIXVT1Tw1WoiBgctfF5Skbzo9J-Kng2X46WHYk&si=AMgyJEtREmoPL4P1I5IDCfuA8gybfVI2d5Uj7QMwYCZHKDZ-E6DDVcVsJ7TnTRRW-RnlpkTCTE9IvLZXgGRwrQTNkuGlB2RirZx8yP0UdUI805y6Mh702mZwRX2HWdkAQNIfg2YV4pO0Nqq-5KW0sCZ0G5HaVgf-y3_dIVqKmsEpgCKCWoumieo%3D&sa=X&ved=2ahUKEwi1vMTQmfSPAxV1RmwGHVZ2INQQk8gLegQIHBAB&ictx=1&stq=1&cs=0&lei=71vVaPWIFvWMseMP1uyBoQ0#ebo=1"
                target="_blank" class="themebtu">
                View All Reviews
            </a>
        </div>
    </div>
</section>

<style>
    .gj-proof {
        --gj-primary: #0038a6;
        --gj-primary-soft: #0056d6;
        --gj-ink: #1f3259;
        --gj-muted: #5f7399;
        --gj-card: #ffffff;
        --gj-bg: linear-gradient(180deg, #ffffff 0%, #f6faff 100%);
        font-family: 'Poppins', sans-serif;
        background: var(--gj-bg);
        padding: 58px 0;
        position: relative;
        isolation: isolate;
    }

    .gj-proof::before,
    .gj-proof::after {
        content: "";
        position: absolute;
        pointer-events: none;
        z-index: -1;
    }

    .gj-proof::before {
        inset: 0;
        background:
            radial-gradient(circle at 10% 10%, rgba(0, 86, 214, 0.08) 0%, transparent 42%),
            radial-gradient(circle at 92% 80%, rgba(0, 56, 166, 0.08) 0%, transparent 46%);
    }

    .gj-proof::after {
        width: min(960px, 90vw);
        height: 320px;
        left: 50%;
        transform: translateX(-50%);
        top: 80px;
        background: repeating-linear-gradient(
            -8deg,
            rgba(0, 86, 214, 0.07) 0,
            rgba(0, 86, 214, 0.07) 1px,
            transparent 1px,
            transparent 14px
        );
        opacity: 0.22;
    }

    .gj-proof .heading h2 {
        letter-spacing: -0.01em;
    }

    .gj-proof .gj-proof-swiper {
        overflow: hidden;
        border-radius: 24px;
    }

    .gj-proof .gj-proof-frame {
        max-width: 1180px;
        margin: 0 auto;
        padding: 0 36px;
    }

    .gj-proof .gj-proof-card {
        min-height: 430px;
        height: 430px;
        display: grid;
        grid-template-columns: 1.06fr 1fr;
        background: var(--gj-card);
        border-radius: 20px;
        border: 1px solid rgba(0, 56, 166, 0.14);
        box-shadow: 0 16px 42px rgba(0, 56, 166, 0.14);
        overflow: hidden;
        position: relative;
        transition: transform 0.45s ease, box-shadow 0.45s ease, border-color 0.35s ease;
    }

    .gj-proof .gj-proof-card::before {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(115deg, rgba(0, 86, 214, 0.08), transparent 32%, rgba(0, 56, 166, 0.06));
        opacity: 0;
        transition: opacity 0.45s ease;
        pointer-events: none;
    }

    .gj-proof .gj-proof-card:hover {
        transform: translateY(-7px);
        border-color: rgba(0, 56, 166, 0.22);
        box-shadow: 0 26px 58px rgba(0, 56, 166, 0.18);
    }

    .gj-proof .gj-proof-card:hover::before {
        opacity: 1;
    }

    .gj-proof .gj-proof-media {
        position: relative;
        min-height: 430px;
        height: 430px;
        overflow: hidden;
    }

    .gj-proof .gj-proof-media img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.85s cubic-bezier(0.19, 1, 0.22, 1);
    }

    .gj-proof .gj-proof-card:hover .gj-proof-media img {
        transform: scale(1.08);
    }

    .gj-proof .gj-proof-media::after {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, rgba(0, 56, 166, 0) 30%, rgba(0, 56, 166, 0.24) 100%);
        pointer-events: none;
    }

    .gj-proof .gj-proof-meta {
        position: absolute;
        left: 0;
        right: 0;
        bottom: 0;
        padding: 18px 18px;
        color: #ffffff;
        background: linear-gradient(180deg, rgba(0, 56, 166, 0) 0%, rgba(0, 56, 166, 0.9) 100%);
        z-index: 1;
    }

    .gj-proof .gj-proof-meta h3 {
        margin: 0;
        font-size: clamp(1.08rem, 1.4vw, 1.35rem);
        line-height: 1.2;
        font-weight: 700;
        color: #ffffff;
    }

    .gj-proof .gj-proof-meta p {
        margin: 4px 0 0;
        color: #d8e8ff;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        font-size: 0.72rem;
    }

    .gj-proof .gj-proof-content {
        padding: 28px 24px 20px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        color: var(--gj-ink);
        height: 100%;
        position: relative;
        z-index: 1;
    }

    .gj-proof .gj-proof-text {
        margin: 0;
        color: var(--gj-ink);
        font-size: clamp(0.9rem, 1.15vw, 1rem);
        line-height: 1.66;
        font-weight: 400;
        min-height: 156px;
        display: -webkit-box;
        -webkit-line-clamp: 6;
        -webkit-box-orient: vertical;
        overflow: hidden;
        position: relative;
        padding-inline: 14px;
        animation: gjProofTextIn 0.45s ease;
    }

    .gj-proof .gj-proof-text::before,
    .gj-proof .gj-proof-text::after {
        color: var(--gj-primary-soft);
        font-size: 1.15em;
        font-weight: 600;
        line-height: 1;
    }

    .gj-proof .gj-proof-text::before {
        content: '"';
        position: absolute;
        left: 0;
        top: 0;
    }

    .gj-proof .gj-proof-text::after {
        content: '"';
        margin-left: 4px;
    }

    .gj-proof .gj-proof-rating {
        margin-top: 12px;
        margin-bottom: 16px;
        color: var(--gj-primary-soft);
        font-size: 0.84rem;
        letter-spacing: 0.08rem;
    }

    .gj-proof .gj-proof-controls {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .gj-proof .gj-proof-buttons {
        display: inline-flex;
        gap: 8px;
    }

    .gj-proof .gj-proof-btn {
        width: 36px;
        height: 36px;
        border: 1px solid rgba(0, 56, 166, 0.2);
        border-radius: 10px;
        background: #ffffff;
        color: var(--gj-primary);
        font-size: 0.98rem;
        font-weight: 600;
        line-height: 1;
        display: grid;
        place-items: center;
        transition: transform 0.25s ease, background 0.25s ease, color 0.25s ease, box-shadow 0.25s ease;
    }

    .gj-proof .gj-proof-btn:hover {
        transform: translateY(-2px);
        background: var(--gj-primary);
        color: #ffffff;
        box-shadow: 0 10px 20px rgba(0, 56, 166, 0.2);
    }

    .gj-proof .gj-proof-btn:active {
        transform: scale(0.94);
    }

    .gj-proof .gj-proof-pause {
        font-size: 0.82rem;
        letter-spacing: -0.08em;
    }

    .gj-proof .gj-proof-progress-wrap {
        position: relative;
        flex: 1;
        min-width: 120px;
        max-width: 180px;
        height: 6px;
        border-radius: 999px;
        background: #d7e5ff;
        overflow: hidden;
    }

    .gj-proof .gj-proof-progress-fill {
        display: block;
        width: 0;
        height: 100%;
        border-radius: inherit;
        background: linear-gradient(90deg, var(--gj-primary), var(--gj-primary-soft));
        box-shadow: 0 0 12px rgba(0, 86, 214, 0.58);
        transition: width 0.08s linear;
    }

    .gj-proof .gj-proof-counter {
        font-size: 0.83rem;
        font-weight: 700;
        letter-spacing: 0.04em;
        color: var(--gj-primary);
        min-width: 74px;
        text-align: right;
        background: rgba(0, 56, 166, 0.06);
        border: 1px solid rgba(0, 56, 166, 0.1);
        border-radius: 8px;
        padding: 5px 10px;
    }

    .gj-proof .gj-proof-counter .gj-proof-current {
        color: var(--gj-primary);
    }

    @keyframes gjProofTextIn {
        from {
            opacity: 0;
            transform: translateY(8px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media (max-width: 1199px) {
        .gj-proof .gj-proof-frame {
            padding: 0 24px;
        }

        .gj-proof .gj-proof-card {
            min-height: 404px;
            height: 404px;
        }

        .gj-proof .gj-proof-media {
            min-height: 404px;
            height: 404px;
        }

        .gj-proof .gj-proof-content {
            padding: 24px 18px 18px;
        }

        .gj-proof .gj-proof-text {
            min-height: 140px;
            -webkit-line-clamp: 6;
        }
    }

    @media (max-width: 991px) {
        .gj-proof .gj-proof-frame {
            padding: 0 14px;
        }

        .gj-proof .gj-proof-card {
            grid-template-columns: 1fr;
            height: auto;
            min-height: 0;
        }

        .gj-proof .gj-proof-media {
            min-height: 290px;
            height: 290px;
        }

        .gj-proof .gj-proof-content {
            padding: 20px 16px 16px;
        }

        .gj-proof .gj-proof-text {
            min-height: 98px;
            -webkit-line-clamp: 4;
            padding-inline: 10px;
        }

        .gj-proof .gj-proof-controls {
            flex-wrap: wrap;
            gap: 10px;
        }

        .gj-proof .gj-proof-progress-wrap {
            max-width: 100%;
            order: 3;
            width: 100%;
        }

        .gj-proof .gj-proof-counter {
            text-align: left;
            margin-left: auto;
        }
    }

    @media (max-width: 576px) {
        .gj-proof {
            padding: 48px 0;
        }

        .gj-proof .gj-proof-media {
            min-height: 220px;
            height: 220px;
        }

        .gj-proof .gj-proof-meta {
            padding: 14px;
        }

        .gj-proof .gj-proof-btn {
            width: 34px;
            height: 34px;
        }

        .gj-proof .gj-proof-text {
            min-height: 88px;
            -webkit-line-clamp: 4;
            font-size: 0.84rem;
            padding-inline: 8px;
        }
    }
</style>

<script>
    (function() {
        function initProofSwiper() {
            const root = document.querySelector('.gj-proof');
            if (!root || root.dataset.swiperReady === '1' || typeof Swiper === 'undefined') {
                return false;
            }

            const currentEls = Array.from(root.querySelectorAll('.gj-proof-current'));
            const totalEls = Array.from(root.querySelectorAll('.gj-proof-total'));
            const fillEls = Array.from(root.querySelectorAll('.gj-proof-progress-fill'));
            const pauseBtns = Array.from(root.querySelectorAll('.gj-proof-pause'));
            const nextBtns = Array.from(root.querySelectorAll('.gj-proof-next'));
            const prevBtns = Array.from(root.querySelectorAll('.gj-proof-prev'));
            const originalSlides = root.querySelectorAll('.gj-proof-swiper .swiper-wrapper > .swiper-slide').length;

            if (!currentEls.length || !totalEls.length || !fillEls.length || !pauseBtns.length || !nextBtns.length || !prevBtns.length || originalSlides === 0) {
                return false;
            }

            root.dataset.swiperReady = '1';

            const cycleDuration = 4500;
            const totalSlides = originalSlides;
            let rafId = null;
            let cycleStartTime = 0;
            let elapsedWhenPaused = 0;
            let isPaused = false;

            const slider = new Swiper('.gj-proof-swiper', {
                init: false,
                slidesPerView: 1,
                loop: totalSlides > 1,
                speed: 760,
                allowTouchMove: true
            });

            function formatNumber(value) {
                return String(value).padStart(2, '0');
            }

            function setProgress(percent) {
                const width = Math.max(0, Math.min(100, percent)) + '%';
                fillEls.forEach(function(fillEl) {
                    fillEl.style.width = width;
                });
            }

            function setPauseVisual(paused) {
                pauseBtns.forEach(function(pauseBtn) {
                    if (paused) {
                        pauseBtn.innerHTML = '&#9654;';
                        pauseBtn.setAttribute('aria-label', 'Play autoplay');
                    } else {
                        pauseBtn.innerHTML = '&#10074;&#10074;';
                        pauseBtn.setAttribute('aria-label', 'Pause autoplay');
                    }
                });
            }

            function setControlsDisabled(disabled) {
                pauseBtns.forEach(function(btn) {
                    btn.disabled = disabled;
                });
                nextBtns.forEach(function(btn) {
                    btn.disabled = disabled;
                });
                prevBtns.forEach(function(btn) {
                    btn.disabled = disabled;
                });
            }

            function updateCounter() {
                const current = totalSlides === 1 ? 1 : slider.realIndex + 1;
                const currentText = formatNumber(current);
                const totalText = formatNumber(totalSlides);

                currentEls.forEach(function(currentEl) {
                    currentEl.textContent = currentText;
                });

                totalEls.forEach(function(totalEl) {
                    totalEl.textContent = totalText;
                });
            }

            function stopTicker() {
                if (rafId) {
                    cancelAnimationFrame(rafId);
                    rafId = null;
                }
            }

            function runTicker(now) {
                if (isPaused) {
                    return;
                }

                const elapsed = now - cycleStartTime;
                const progress = (elapsed / cycleDuration) * 100;
                setProgress(progress);

                if (progress >= 100) {
                    elapsedWhenPaused = 0;
                    stopTicker();

                    if (totalSlides > 1) {
                        slider.slideNext();
                    }
                    return;
                }

                rafId = requestAnimationFrame(runTicker);
            }

            function startCycle(resetElapsed) {
                if (resetElapsed) {
                    elapsedWhenPaused = 0;
                    setProgress(0);
                }

                stopTicker();
                cycleStartTime = performance.now() - elapsedWhenPaused;
                rafId = requestAnimationFrame(runTicker);
            }

            function pauseCycle() {
                isPaused = true;
                elapsedWhenPaused = performance.now() - cycleStartTime;
                stopTicker();
                setPauseVisual(true);
            }

            function resumeCycle() {
                isPaused = false;
                setPauseVisual(false);
                startCycle(false);
            }

            slider.on('init', function() {
                updateCounter();

                if (totalSlides <= 1) {
                    setProgress(100);
                    setControlsDisabled(true);
                    pauseBtns.forEach(function(pauseBtn) {
                        pauseBtn.setAttribute('aria-label', 'Autoplay unavailable');
                    });
                    return;
                }

                startCycle(true);
            });

            slider.on('slideChangeTransitionStart', function() {
                updateCounter();
                if (!isPaused && totalSlides > 1) {
                    startCycle(true);
                }
            });

            pauseBtns.forEach(function(pauseBtn) {
                pauseBtn.addEventListener('click', function() {
                    if (totalSlides <= 1) {
                        return;
                    }

                    if (isPaused) {
                        resumeCycle();
                    } else {
                        pauseCycle();
                    }
                });
            });

            nextBtns.forEach(function(nextBtn) {
                nextBtn.addEventListener('click', function() {
                    if (totalSlides <= 1) {
                        return;
                    }

                    slider.slideNext();

                    if (isPaused) {
                        elapsedWhenPaused = 0;
                        setProgress(0);
                    } else {
                        startCycle(true);
                    }
                });
            });

            prevBtns.forEach(function(prevBtn) {
                prevBtn.addEventListener('click', function() {
                    if (totalSlides <= 1) {
                        return;
                    }

                    slider.slidePrev();

                    if (isPaused) {
                        elapsedWhenPaused = 0;
                        setProgress(0);
                    } else {
                        startCycle(true);
                    }
                });
            });

            slider.init();
            return true;
        }

        function bootstrapProofSwiper(attempt) {
            if (initProofSwiper()) {
                return;
            }

            if (attempt < 25) {
                setTimeout(function() {
                    bootstrapProofSwiper(attempt + 1);
                }, 120);
            }
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', function() {
                bootstrapProofSwiper(0);
            });
        } else {
            bootstrapProofSwiper(0);
        }
    })();
</script>

