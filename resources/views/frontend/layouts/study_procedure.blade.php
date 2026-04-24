<section data-aos="fade-up" class="how-it-works no-top">
    <div class="container">
        <!-- Heading -->
        <div data-aos="fade-up" data-aos-delay="100" class="heading mb-4">
            <h6>Visa Grant Stories</h6>
            <h2>Our Success Stories</h2>
            <img alt="line" src="{{ asset('frontend/assets/img/headingline.png') }}">
        </div>

        <!-- Video -->
        <div class="row justify-content-center">
            <div class="col-xl-10">
                <div data-aos="zoom-in-up" data-aos-delay="180" class="video-container fade-in-up" style="animation-delay: 0.2s;">
                    <div class="video-frame">
                        <div class="video-glow"></div>
                        <video controls playsinline class="main-video">
                            <source src="{{ asset('frontend/assets/img/success.mp4') }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>

                        <!-- Optional Play Button Overlay -->
                        <div class="play-overlay">
                            <i class="fa-solid fa-play"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Text -->
        <div data-aos="fade-up" data-aos-delay="260" class="welcome-section text-center fade-in-up" style="animation-delay: 0.4s;">
            <p data-aos="fade-up" data-aos-delay="320" class="lead-text mb-4">
                Global Journey Education Services has proudly assisted over
                <strong>5000+ students</strong> in achieving their study abroad dreams with a remarkable
                <strong>98% visa success rate</strong>.
                Our expert guidance and personalized support ensure students are well-prepared and confident
                throughout the visa application process.
            </p>

            <!-- Button -->
            <a data-aos="fade-up" data-aos-delay="380" href="{{ route('about-us') }}" class="themebtu">
                Learn More
            </a>
        </div>
    </div>
</section>

<style>
    /* Video Container */
    .video-container {
        margin: 60px 0;
        perspective: 1000px;
    }

    .video-frame {
        position: relative;
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        transition: transform 0.5s ease, box-shadow 0.5s ease;
    }

    .video-frame:hover {
        transform: translateY(-10px) rotateX(2deg);
        box-shadow: 0 30px 80px rgba(0, 0, 0, 0.2);
    }

    .video-glow {
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(102, 126, 234, 0.3) 0%, transparent 70%);
        opacity: 0;
        transition: opacity 0.5s ease;
        pointer-events: none;
        z-index: 1;
    }

    .video-frame:hover .video-glow {
        opacity: 1;
    }

    .main-video {
        width: 100%;
        max-height: 500px;
        display: block;
        filter: brightness(1.05) contrast(1.1) saturate(1.15);
        transition: filter 0.5s ease;
        position: relative;
        z-index: 2;
        border-radius: 24px;
    }

    .video-frame:hover .main-video {
        filter: brightness(1.1) contrast(1.15) saturate(1.2);
    }

    /* Play Button Overlay */
    .play-overlay {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: rgba(102, 126, 234, 0.8);
        color: #fff;
        font-size: 28px;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 3;
        cursor: pointer;
        transition: transform 0.3s ease, background 0.3s ease;
    }

    .play-overlay:hover {
        transform: translate(-50%, -50%) scale(1.1);
        background: rgba(102, 126, 234, 1);
    }

    /* Welcome Text */
    .welcome-section {
        padding: 40px 0;
    }

    .lead-text {
        font-size: 18px;
        line-height: 1.8;
        color: #555;
        font-weight: 400;
        max-width: 800px;
        margin: 0 auto;
    }
</style>
