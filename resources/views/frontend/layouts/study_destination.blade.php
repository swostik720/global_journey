<section class="project gap">
    <div class="container">
        <div class="heading-boder">
            <h2>Study in the best <br><span>Destination</span></h2>
            <p>Favourite destination</p>
        </div>
        <div class="swiper-container projectsswiper">
            <div class="swiper-wrapper">
                @foreach ($studyabroads as $studyabroad)
                    <div class="swiper-slide">
                        <figure
                            class="snip1493 card border-0 shadow-sm h-100 d-flex flex-column p-0 bg-white transition-all overflow-hidden"
                            style="min-height: 500px; cursor:pointer; border-radius: 20px; overflow: hidden; position: relative;">

                            <!-- Image -->
                            <div class="w-100" style="height: 300px; overflow: hidden;">
                                <img src="{{ asset($studyabroad->image_path ?? '') }}" alt="ls-sample3"
                                    class="img-fluid w-100 h-100" style="object-fit: cover; transition: transform .3s;"
                                    onmouseover="this.style.transform='scale(1.08)';"
                                    onmouseout="this.style.transform='scale(1)';">
                            </div>

                            <!-- Text -->
                            <figcaption
                                class="bg-white text-center p-3 border-top flex-grow-1 d-flex flex-column justify-content-center">
                                <h3 class="fw-bold mb-2">{{ $studyabroad->title ?? '' }}</h3>
                                <p class="fs-5 mb-0">{!! $studyabroad->short_description ?? '' !!}</p>
                            </figcaption>

                            <!-- Progress bar -->
                            <div class="progress-hover"></div>

                            <a href="{{ route('study-abroad.details', $studyabroad->slug) }}"
                                class="stretched-link"></a>
                        </figure>
                    </div>
                @endforeach
            </div>

            <!-- Navigation -->
            <div class="swiper-button-next"><i class="fa fa-arrow-right"></i></div>
            <div class="swiper-button-prev"><i class="fa fa-arrow-left"></i></div>
            <div class="swiper-pagination"></div>
        </div>
        <div class="btugap">
            <a href="{{ route('study-abroad') }}" class="themebtu">View all Destinations</a>
        </div>
        <div class="tp-hero__shapes">
            <div class="style-shapes-1"></div>
            <div class="style-shapes-2">
                <img alt="shap-4" src="{{ asset('frontend/assets/img/shap-4.png') }}">
            </div>
            <div class="style-shapes-3"></div>
            <div class="style-shapes-4">
                <img alt="dots1" src="{{ asset('frontend/assets/img/dots1.png') }}">
            </div>
        </div>
    </div>
</section>

<style>
    /* Progress bar container */
    .progress-hover {
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

    /* On hover, animate width */
    figure:hover .progress-hover {
        width: 100%;
    }

    /* Swiper Buttons */
    .swiper-button-next,
    .swiper-button-prev {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: linear-gradient(135deg, #4f5bd5, #962fbf, #d62976, #fa7e1e, #feda75);
        display: flex;
        justify-content: center;
        align-items: center;
        color: #fff !important;
        font-size: 18px;
        transition: all 0.3s ease-in-out;
    }

    .swiper-button-next:hover,
    .swiper-button-prev:hover {
        transform: scale(1.15);
        box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
    }

    /* Position fix */
    .swiper-button-next {
        right: 10px;
    }

    .swiper-button-prev {
        left: 10px;
    }

    /* Pagination Dots */
    /* Ensure pagination is positioned & visible */
    .swiper-pagination {
        position: absolute;
        bottom: -30px;
        /* push it below the slides */
        left: 0;
        width: 100%;
        text-align: center;
        z-index: 20;
    }

    /* .swiper-pagination {
        bottom: -35px !important;
    } */

    .swiper-pagination-bullet {
        width: 12px;
        height: 12px;
        background: #ddd;
        opacity: 1;
        transition: all 0.3s ease-in-out;
    }

    .swiper-pagination-bullet-active {
        background: linear-gradient(135deg, #4f5bd5, #962fbf, #d62976, #fa7e1e, #feda75);
        transform: scale(1.3);
    }
</style>

<!-- Swiper JS -->
<script>
    var swiper = new Swiper(".projectsswiper", {
        slidesPerView: 3,
        spaceBetween: 30,
        loop: true,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true, // <--- allows clicking dots
        },
    });
</script>
