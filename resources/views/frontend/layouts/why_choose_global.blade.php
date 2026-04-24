<section data-aos="fade-up" class="gap gj-proof" aria-label="Student Testimonials">
    <div class="container">
        <div data-aos="fade-up" data-aos-delay="100" class="heading mb-4 text-center">
            <h6>Why Choose Global Journeys?</h6>
            <h2>Hear What Our Students Say!</h2>
            <img alt="line" src="{{ asset('frontend/assets/img/headingline.png') }}" style="margin-top: 15px;">
        </div>

        <div class="gj-proof-frame">
            <div class="swiper gj-proof-swiper">
                <div class="swiper-wrapper">
                    @foreach ($testimonials as $testimonial)
                        <div class="swiper-slide">
                            <article class="gj-proof-card" data-aos="fade-up" data-aos-delay="{{ 140 + (($loop->index % 3) * 80) }}">
                                <div class="gj-proof-media">
                                    <img alt="{{ $testimonial->name ?? 'Student' }}" src="{{ $testimonial->image_path ?? '' }}">
                                    <div class="gj-proof-meta">
                                        <h3>{{ $testimonial->name ?? '' }}</h3>
                                        <p>{{ $testimonial->address ?? '' }}</p>
                                    </div>
                                </div>

                                <div class="gj-proof-content">
                                    <p class="gj-proof-text">{!! $testimonial->description ?? '' !!}</p>

                                    <div class="gj-proof-rating" aria-label="Rating {{ intval($testimonial->rating) }} out of 5">
                                        @for ($i = 0; $i < 5; $i++)
                                            <i class="fa fa-star" style="opacity: {{ $i < intval($testimonial->rating) ? '1' : '.22' }}"></i>
                                        @endfor
                                    </div>

                                    <div class="gj-proof-controls">
                                        <div class="gj-proof-buttons">
                                            <button type="button" class="gj-proof-btn gj-proof-prev" aria-label="Previous testimonial">&#8249;</button>
                                            <button type="button" class="gj-proof-btn gj-proof-pause" aria-label="Pause autoplay">&#10074;&#10074;</button>
                                            <button type="button" class="gj-proof-btn gj-proof-next" aria-label="Next testimonial">&#8250;</button>
                                        </div>

                                        <div class="gj-proof-progress-wrap" aria-hidden="true">
                                            <span class="gj-proof-progress-fill"></span>
                                        </div>

                                        <div class="gj-proof-counter"><span class="gj-proof-current">01</span> / <span class="gj-proof-total">01</span></div>
                                    </div>
                                </div>
                            </article>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div data-aos="fade-up" data-aos-delay="260" class="text-center mt-5">
            <a data-aos="fade-up" data-aos-delay="340" href="https://www.google.com/search?client=ms-android-xiaomi-terr1-rso2&sca_esv=96401a4aa5f3e59e&sxsrf=AE3TifNIFMqgddFDRIezsJhcv4ZMgat3oQ:1758813167366&q=global+journey+education+kathmandu+reviews&uds=AOm0WdGCrBrLBW3vjUiZVdrnKqNnJ21ZA369CsCeiRTYwopz-ecHTUTypGHio094ex4TMER1BC9ZoZIQslzZtdU8LlyxTeMW8ejrhbvy7Z45Zicrg-_DTI7gktLTGTHiqRP7MUthYUBLOLqI5ZFUYP6SrWSegimfjMvgw2QJUOOtOyXqCE22hFh4XBKZ1Otk5uL-MuCzgFg_OOB-1uTXRjkXOZrlOqLaA1HK-npuqqPxsiPpni0RLePyGc_mPsaTfuU4g4Xtrw0aqONKVu-iO7vyuV60fqXnjzTg3feVV_SVcmfdTZvFGghonyhmPA9D_8-DpanEmDaJjPQzlJJ4R1T4Y09MU4zqyKjijgpdSpbHLMOgg8a4BYtD-KVUvAjMb27MBz5-P822jvuD5SMS3kxw0scmIJ0KiPxqp6RFIq45vRh6lwYJbOw1_f1o5dBukjZ46l1_jgJYH5-ueXjVZdIb3wMCyE_wca36VEjEAjLs6wm0888nEJ7jQcloK-1ULnz5DP3t4r3zZV8YvbIXVT1Tw1WoiBgctfF5Skbzo9J-Kng2X46WHYk&si=AMgyJEtREmoPL4P1I5IDCfuA8gybfVI2d5Uj7QMwYCZHKDZ-E6DDVcVsJ7TnTRRW-RnlpkTCTE9IvLZXgGRwrQTNkuGlB2RirZx8yP0UdUI805y6Mh702mZwRX2HWdkAQNIfg2YV4pO0Nqq-5KW0sCZ0G5HaVgf-y3_dIVqKmsEpgCKCWoumieo%3D&sa=X&ved=2ahUKEwi1vMTQmfSPAxV1RmwGHVZ2INQQk8gLegQIHBAB&ictx=1&stq=1&cs=0&lei=71vVaPWIFvWMseMP1uyBoQ0#ebo=1"
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
        --gj-bg: linear-gradient(180deg, #f9fbff 0%, #ffffff 100%);
        font-family: 'Poppins', sans-serif;
        background: var(--gj-bg);
        padding: 58px 0;
    }

    .gj-proof .gj-proof-swiper {
        overflow: hidden;
        border-radius: 20px;
    }

    .gj-proof .gj-proof-frame {
        max-width: 1180px;
        margin: 0 auto;
        padding: 0 36px;
    }

    .gj-proof .gj-proof-card {
        min-height: 420px;
        height: 420px;
        display: grid;
        grid-template-columns: 1.06fr 1fr;
        background: var(--gj-card);
        border-radius: 18px;
        border: 1px solid rgba(0, 56, 166, 0.11);
        box-shadow: 0 14px 36px rgba(0, 56, 166, 0.12);
        overflow: hidden;
    }

    .gj-proof .gj-proof-media {
        position: relative;
        min-height: 420px;
        height: 420px;
    }

    .gj-proof .gj-proof-media img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .gj-proof .gj-proof-meta {
        position: absolute;
        left: 0;
        right: 0;
        bottom: 0;
        padding: 18px 18px;
        color: #ffffff;
        background: linear-gradient(180deg, rgba(0, 56, 166, 0) 0%, rgba(0, 56, 166, 0.86) 100%);
    }

    .gj-proof .gj-proof-meta h3 {
        margin: 0;
        font-size: clamp(1.08rem, 1.4vw, 1.35rem);
        line-height: 1.2;
        font-weight: 700;
        letter-spacing: 0;
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
    }

    .gj-proof .gj-proof-text {
        margin: 0;
        color: var(--gj-ink);
        font-size: clamp(0.89rem, 1.15vw, 1rem);
        line-height: 1.66;
        font-weight: 400;
        min-height: 156px;
        display: -webkit-box;
        -webkit-line-clamp: 6;
        -webkit-box-orient: vertical;
        overflow: hidden;
        position: relative;
        padding-inline: 14px;
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
        font-size: 0.82rem;
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
        width: 34px;
        height: 34px;
        border: 1px solid rgba(0, 56, 166, 0.2);
        border-radius: 8px;
        background: #ffffff;
        color: var(--gj-primary);
        font-size: 0.98rem;
        font-weight: 600;
        line-height: 1;
        display: grid;
        place-items: center;
        transition: transform 0.25s ease, background 0.25s ease, color 0.25s ease;
    }

    .gj-proof .gj-proof-btn:hover {
        transform: translateY(-2px);
        background: var(--gj-primary);
        color: #ffffff;
    }

    .gj-proof .gj-proof-pause {
        font-size: 0.82rem;
        letter-spacing: -0.1em;
    }

    .gj-proof .gj-proof-progress-wrap {
        position: relative;
        flex: 1;
        min-width: 95px;
        max-width: 130px;
        height: 4px;
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
    }

    .gj-proof .gj-proof-counter {
        font-size: 0.83rem;
        font-weight: 600;
        letter-spacing: 0.04em;
        color: var(--gj-primary);
        min-width: 58px;
        text-align: right;
    }

    .gj-proof .gj-proof-counter .gj-proof-current {
        color: var(--gj-primary);
    }

    @media (max-width: 1199px) {
        .gj-proof .gj-proof-frame {
            padding: 0 24px;
        }

        .gj-proof .gj-proof-card {
            min-height: 400px;
            height: 400px;
        }

        .gj-proof .gj-proof-content {
            padding: 24px 18px 18px;
        }

        .gj-proof .gj-proof-text {
            min-height: 144px;
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
        }

        .gj-proof .gj-proof-media {
            min-height: 280px;
            height: 280px;
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

        .gj-proof .gj-proof-counter {
            text-align: left;
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
            padding: 14px 14px;
        }

        .gj-proof .gj-proof-btn {
            width: 32px;
            height: 32px;
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
        var root = document.querySelector('.gj-proof');
        if (!root || typeof Swiper === 'undefined') {
            return;
        }

        var currentEl = root.querySelector('.gj-proof-current');
        var totalEl = root.querySelector('.gj-proof-total');
        var fillEl = root.querySelector('.gj-proof-progress-fill');
        var pauseBtn = root.querySelector('.gj-proof-pause');
        var delay = 4500;
        var progressTimer = null;
        var progressStart = null;
        var isPaused = false;

        var slider = new Swiper('.gj-proof-swiper', {
            slidesPerView: 1,
            spaceBetween: 20,
            loop: true,
            speed: 700,
            autoplay: {
                delay: delay,
                disableOnInteraction: false
            },
            navigation: {
                nextEl: '.gj-proof-next',
                prevEl: '.gj-proof-prev'
            }
        });

        function formatNumber(num) {
            return String(num).padStart(2, '0');
        }

        function stopProgress() {
            if (progressTimer) {
                clearInterval(progressTimer);
                progressTimer = null;
            }
        }

        function startProgress() {
            if (!fillEl) {
                return;
            }

            stopProgress();
            progressStart = Date.now();
            fillEl.style.width = '0%';

            progressTimer = setInterval(function() {
                var elapsed = Date.now() - progressStart;
                var pct = Math.min((elapsed / delay) * 100, 100);
                fillEl.style.width = pct + '%';

                if (pct >= 100) {
                    stopProgress();
                }
            }, 40);
        }

        function updateCounter() {
            if (!currentEl || !totalEl) {
                return;
            }

            currentEl.textContent = formatNumber(slider.realIndex + 1);
            totalEl.textContent = formatNumber(slider.slides.length - slider.loopedSlides * 2);
        }

        slider.on('init', function() {
            updateCounter();
            startProgress();
        });

        slider.on('slideChange', function() {
            updateCounter();
            if (slider.autoplay.running) {
                startProgress();
            }
        });

        slider.on('autoplayStart', function() {
            if (!isPaused) {
                startProgress();
            }
        });

        slider.on('autoplayStop', function() {
            stopProgress();
        });

        updateCounter();
        startProgress();

        if (pauseBtn) {
            pauseBtn.addEventListener('click', function() {
                if (slider.autoplay.running) {
                    isPaused = true;
                    slider.autoplay.stop();
                    pauseBtn.innerHTML = '&#9654;';
                    pauseBtn.setAttribute('aria-label', 'Resume autoplay');
                    stopProgress();
                } else {
                    isPaused = false;
                    slider.autoplay.start();
                    pauseBtn.innerHTML = '&#10074;&#10074;';
                    pauseBtn.setAttribute('aria-label', 'Pause autoplay');
                    startProgress();
                }
            });
        }
    })();
</script>
