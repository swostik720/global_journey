<section class="gap no-bottom">
    <div class="container">
        <div class="row">
            <div>
                <!-- Heading -->
                <div class="heading design-enjoy">
                    <h6 class="text-primary">Empowering Your Global Journey</h6>
                    <h2 class="fw-bold">
                        Expert Guidance for <br> Your Study Abroad Success
                    </h2>
                    <img alt="line" src="{{ asset('frontend/assets/img/headingline.png') }}">
                </div>

                <!-- Video -->
                <div class="video-container fade-in-up" style="animation-delay: 0.2s;">
                    <div class="video-frame">
                        <div class="video-glow"></div>
                        <video autoplay muted loop playsinline class="main-video">
                            <source src="{{ asset('frontend/assets/img/map.mp4') }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>


                    </div>
                </div>



                <!-- Text -->
                <div class="welcome-section text-center fade-in-up" style="animation-delay: 0.4s;">
                    <p class="lead-text mb-5">
                        Global Journey Education Services is your trusted partner for comprehensive study abroad
                        consulting in Nepal. Located in the heart of Putalisadak, Kathmandu, our head office is
                        supported by branches across Nepal and a support office in Sydney, Australia.
                    </p>

                    <!-- Location Cards -->
                    <div class="location-cards mb-5">
                        <div class="location-card">
                            <div class="location-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <h6>Head Office</h6>
                            <p>Putalisadak, Kathmandu</p>
                        </div>
                        <div class="location-card">
                            <div class="location-icon">
                                <i class="fas fa-building"></i>
                            </div>
                            <h6>Multiple Branches</h6>
                            <p>Across Nepal</p>
                        </div>
                        <div class="location-card">
                            <div class="location-icon">
                                <i class="fas fa-globe-asia"></i>
                            </div>
                            <h6>Support Office</h6>
                            <p>Sydney, Australia</p>
                        </div>
                    </div>
                    <!-- Button -->
                    <a href="{{ route('about-us') }}" class="themebtu">
                        Learn More
                    </a>
                </div>
            </div>
        </div>
    </div>
    <img class="w-100" alt="line" src="{{ asset('frontend/assets/img/line.jpg') }}">
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
        height: auto;
        display: block;
        filter: brightness(1.05) contrast(1.1) saturate(1.15);
        transition: filter 0.5s ease;
        position: relative;
        z-index: 2;
    }

    .video-frame:hover .main-video {
        filter: brightness(1.1) contrast(1.15) saturate(1.2);
    }

    /* Welcome Section */
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

    /* Location Cards */
    .location-cards {
        display: flex;
        justify-content: center;
        gap: 25px;
        flex-wrap: wrap;
    }

    .location-card {
        background: linear-gradient(135deg, #f8f9ff 0%, #ffffff 100%);
        border: 2px solid #f0f0f0;
        border-radius: 20px;
        padding: 30px 25px;
        min-width: 200px;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .location-card:hover {
        transform: translateY(-10px);
        border-color: #667eea;
        box-shadow: 0 15px 40px rgba(102, 126, 234, 0.15);
    }

    .location-icon {
        width: 60px;
        height: 60px;
        margin: 0 auto 15px;
        background: linear-gradient(135deg,
                #0038A6,
                #0046C4,
                #0058E8,
                #003070,
                #001F50);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 24px;
        transition: transform 0.4s ease;
    }

    .location-card:hover .location-icon {
        transform: rotateY(360deg);
    }

    .location-card h6 {
        font-size: 16px;
        font-weight: 700;
        color: #333;
        margin-bottom: 8px;
    }

    .location-card p {
        font-size: 14px;
        color: #666;
        margin: 0;
    }
</style>
