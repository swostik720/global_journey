<section data-aos="fade-up" class="gap no-bottom video-section" style="background-color: #f2edf5;">
    <div class="container">
        <div data-aos="fade-up" data-aos-delay="100" class="heading-boder two text-center">
            <h2>Let’s Start Your Journey <span>Together</span></h2>
            <p>We make a difference.</p>
        </div>

        <div class="tp-hero__shapes">
            <div class="style-shapes-5">
                <img alt="dots1" src="{{ asset('frontend/assets/img/shap-2.png') }}">
            </div>
            <div class="style-shapes-6">
                <img alt="dots1" src="{{ asset('frontend/assets/img/shap-2.png') }}">
            </div>
            <div class="style-shapes-7">
                <img alt="dots1" src="{{ asset('frontend/assets/img/shap-5.png') }}">
            </div>
        </div>

        <!-- Video Section -->
        <div class="row">
            <div class="offset-xl-1 col-xl-10">
                <div data-aos="zoom-in-up" data-aos-delay="180" class="video-img position-relative">
                    <div class="overlay-dark"></div>
                    <img class="w-100 rounded" alt="img" src="{{ asset('frontend/assets/img/team.jpg') }}">
                    <a data-aos="zoom-in" data-aos-delay="260" data-fancybox href="https://www.youtube.com/embed/oWomYbpdLjA?si=_9vfMRMOXfGv16pI">
                        <i class="fa fa-play play-btn"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Enquiry Form Section -->
    <div class="get-in-touch gap" style="background-color: #fff;">
        <div class="container">
            <div class="row align-items-center">
                <div class="offset-xl-1 col-xl-10">
                    <div class="row g-3 align-items-start">
                        <div class="col-xl-6">
                            <div data-aos="fade-up" data-aos-delay="100" class="heading">
                                <h6>Get In Touch</h6>
                                <h2 style="color: black;">Begin Your Global Education Journey Today!</h2>
                                <img alt="line" src="{{ asset('frontend/assets/img/headingline.png') }}">
                                <p>
                                    Whether you're looking to study in Australia, Canada, the UK, or beyond, we're here
                                    to guide you every step of the way. Let us help you achieve your study abroad dreams
                                    with expert advice and tailored support.
                                </p>
                            </div>
                        </div>

                        <div data-aos="fade-left" data-aos-delay="220" class="col-xl-6">
                            @include('frontend.layouts.enquiry_form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== Full Page Styling ===== -->
<style>
    /* === Video Overlay === */
    .video-img {
        position: relative;
        overflow: hidden;
        border-radius: 10px;
    }

    .video-img .overlay-dark {
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
        background: rgba(0, 0, 0, 0.3);
        transition: background 0.3s ease;
    }

    .video-img:hover .overlay-dark {
        background: rgba(0, 0, 0, 0.45);
    }

    /* === Play Button === */
    .video-img .play-btn {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: #6c63ff;
        border-radius: 50%;
        width: 70px;
        height: 70px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        color: #fff;
        cursor: pointer;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        transition: all 0.3s ease, transform 0.6s ease-in-out;
        z-index: 10;
        animation: pulse 2.5s infinite;
    }

    .video-img .play-btn:hover {
        background: #ff3b3b;
        transform: translate(-50%, -50%) scale(1.2) rotate(10deg);
        box-shadow: 0 12px 25px rgba(0, 0, 0, 0.35);
    }

    @keyframes pulse {
        0%, 100% { transform: translate(-50%, -50%) scale(1); }
        50% { transform: translate(-50%, -50%) scale(1.05); }
    }

    /* === Enquiry Form Styling === */
    .get-in-touch input,
    .get-in-touch textarea,
    .get-in-touch select {
        color: #000 !important;
        background-color: #fff;
    }

    .enquiry-form_form .input-group {
        position: relative;
        margin-bottom: 20px;
    }

    .enquiry-form_form input,
    .enquiry-form_form textarea,
    .enquiry-form_form select {
        width: 100%;
        padding: 14px 12px;
        border: 1.5px solid #ddd;
        border-radius: 8px;
        background: #fff;
        font-size: 15px;
        transition: 0.3s ease;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
    }

    .enquiry-form_form input:focus,
    .enquiry-form_form textarea:focus,
    .enquiry-form_form select:focus {
        border-color: #6c63ff;
        box-shadow: 0 4px 12px rgba(108, 99, 255, 0.15);
    }

    .enquiry-form_form label {
        position: absolute;
        top: 14px;
        left: 12px;
        color: #888;
        font-size: 12px;
        pointer-events: none;
        transition: 0.25s ease;
        background: #fff;
        padding: 0 6px;
        border-radius: 4px;
    }

    .enquiry-form_form input:focus+label,
    .enquiry-form_form input:not(:placeholder-shown)+label,
    .enquiry-form_form textarea:focus+label,
    .enquiry-form_form textarea:not(:placeholder-shown)+label,
    .enquiry-form_form select:focus+label,
    .enquiry-form_form select.filled+label {
        top: -8px;
        left: 10px;
        font-size: 12px;
        color: #6c63ff;
    }

    .enquiry-form_form textarea {
        min-height: 110px;
        resize: vertical;
    }

    .themebtu {
        background-color: white;
    }
</style>

<!-- === Floating Label Fix for <select> === -->
<script>
    document.querySelectorAll("select").forEach(select => {
        select.addEventListener("change", () => {
            if (select.value !== "") {
                select.classList.add("filled");
            } else {
                select.classList.remove("filled");
            }
        });
    });
</script>
