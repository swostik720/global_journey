<section class="gap review-section" style="background: #f9f9f9; padding: 80px 0;">
    <div class="container">
        <!-- Heading -->
        <div class="heading mb-4 text-center">
            <h6>Why Choose Global Journeys?</h6>
            <h2>Hear What Our Students Say!</h2>
            <img alt="line" src="{{ asset('frontend/assets/img/headingline.png') }}" style="margin-top: 15px;">
        </div>

        <!-- Swiper -->
        <div class="swiper-container partnerswiper">
            <div class="swiper-wrapper">
                @foreach ($testimonials as $testimonial)
                    <div class="swiper-slide">
                        <div class="review shadow-lg rounded-4 p-5"
                            style="background: #fff; color: #333; min-height: 320px;
                            display: flex; flex-direction: column; align-items: center; text-align: center;
                            transition: all 0.3s ease; cursor: pointer; border-radius: 20px;
                            position: relative; overflow: visible;"
                            onmouseover="this.style.transform='translateY(-8px) scale(1.02)'; this.style.boxShadow='0 12px 40px rgba(0,0,0,0.15)';"
                            onmouseout="this.style.transform='translateY(0) scale(1)'; this.style.boxShadow='';">

                            <!-- Floating Student Image (direct rounded square, no wrapper) -->
                            <img alt="student" class="student-img" src="{{ $testimonial->image_path ?? '' }}">

                            <!-- Testimonial Text -->
                            <p style="font-size: 20px; line-height: 1.5; margin-bottom: 20px; margin-top: 50px;">
                                “{!! $testimonial->description ?? '' !!}”
                            </p>

                            <!-- Rating -->
                            <div class="mb-3">
                                @for ($i = 0; $i < 5; $i++)
                                    <i class="fas fa-star{{ $i < intval($testimonial->rating) ? '' : '-alt' }}"
                                        style="color: {{ $i < intval($testimonial->rating) ? '#FFD700' : '#ccc' }};
                                        font-size: 18px; margin-right: 3px;"></i>
                                @endfor
                            </div>

                            <!-- Name & Address -->
                            <p class="testimonial-name mb-1" style="font-weight: 700; font-size: 18px;">
                                {{ $testimonial->name ?? '' }}
                            </p>
                            <p class="testimonial-address mb-0" style="font-size: 14px; color: #666;">
                                {{ $testimonial->address ?? '' }}
                            </p>

                            <!-- Progress Bar -->
                            <div class="progress-hover"></div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Navigation -->
            <div class="swiper-button-next"><i class="fa fa-arrow-right"></i></div>
            <div class="swiper-button-prev"><i class="fa fa-arrow-left"></i></div>
            <div class="swiper-pagination"></div>
        </div>

        <!-- View All Button -->
        <div class="text-center mt-5">
            <a href="https://www.google.com/search?client=ms-android-xiaomi-terr1-rso2&sca_esv=96401a4aa5f3e59e&sxsrf=AE3TifNIFMqgddFDRIezsJhcv4ZMgat3oQ:1758813167366&q=global+journey+education+kathmandu+reviews&uds=AOm0WdGCrBrLBW3vjUiZVdrnKqNnJ21ZA369CsCeiRTYwopz-ecHTUTypGHio094ex4TMER1BC9ZoZIQslzZtdU8LlyxTeMW8ejrhbvy7Z45Zicrg-_DTI7gktLTGTHiqRP7MUthYUBLOLqI5ZFUYP6SrWSegimfjMvgw2QJUOOtOyXqCE22hFh4XBKZ1Otk5uL-MuCzgFg_OOB-1uTXRjkXOZrlOqLaA1HK-npuqqPxsiPpni0RLePyGc_mPsaTfuU4g4Xtrw0aqONKVu-iO7vyuV60fqXnjzTg3feVV_SVcmfdTZvFGghonyhmPA9D_8-DpanEmDaJjPQzlJJ4R1T4Y09MU4zqyKjijgpdSpbHLMOgg8a4BYtD-KVUvAjMb27MBz5-P822jvuD5SMS3kxw0scmIJ0KiPxqp6RFIq45vRh6lwYJbOw1_f1o5dBukjZ46l1_jgJYH5-ueXjVZdIb3wMCyE_wca36VEjEAjLs6wm0888nEJ7jQcloK-1ULnz5DP3t4r3zZV8YvbIXVT1Tw1WoiBgctfF5Skbzo9J-Kng2X46WHYk&si=AMgyJEtREmoPL4P1I5IDCfuA8gybfVI2d5Uj7QMwYCZHKDZ-E6DDVcVsJ7TnTRRW-RnlpkTCTE9IvLZXgGRwrQTNkuGlB2RirZx8yP0UdUI805y6Mh702mZwRX2HWdkAQNIfg2YV4pO0Nqq-5KW0sCZ0G5HaVgf-y3_dIVqKmsEpgCKCWoumieo%3D&sa=X&ved=2ahUKEwi1vMTQmfSPAxV1RmwGHVZ2INQQk8gLegQIHBAB&ictx=1&stq=1&cs=0&lei=71vVaPWIFvWMseMP1uyBoQ0#ebo=1"
                target="_blank" class="themebtu">
                View All Reviews
            </a>
        </div>
    </div>
</section>

<style>
    /* Progress bar for review cards */
    .review .progress-hover {
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

    .review:hover .progress-hover {
        width: 100%;
    }

    /* Student image (big rounded square, clean look) */
    .student-img {
        position: absolute;
        top: -70px;
        left: 50%;
        transform: translateX(-50%);
        width: 130px;
        height: 130px;
        border-radius: 20px;
        object-fit: cover;
        border: 5px solid #fff;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        transition: all 0.4s ease;
        z-index: 5;
    }

    /* Hover glow */
    .review:hover .student-img {
        transform: translateX(-50%) scale(1.08);
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.25), 0 0 20px rgba(214, 41, 118, 0.4);
    }

    /* Card spacing to accommodate floating image */
    .review {
        margin-top: 80px;
        padding-top: 90px !important;
        position: relative;
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

<!-- Swiper JS -->
<script>
    var swiper = new Swiper('.partnerswiper', {
        slidesPerView: 1,
        spaceBetween: 30,
        loop: true,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        breakpoints: {
            768: {
                slidesPerView: 2
            },
            1024: {
                slidesPerView: 3
            }
        }
    });
</script>
