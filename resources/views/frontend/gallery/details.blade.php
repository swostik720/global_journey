@extends('frontend.layouts.includes.master')
@section('maincontent')
    <section data-aos="fade-up" class="splash-area-section" style="background-image: url({{ asset('frontend/assets/img/background.jpg') }})">
        <div class="container">
            <div class="splash-area">
                @php
                    $parts = explode(' ', $gallery->title ?? '', 3); // split into max 3 parts
                    $firstPart = isset($parts[0], $parts[1]) ? $parts[0] . ' ' . $parts[1] : $parts[0] ?? '';
                    $secondPart = $parts[2] ?? '';
                @endphp

                <h1 class="splash-title">
                    {{ $firstPart }}@if ($secondPart) <span class="gradient-text">{{ $secondPart }}</span>@endif
                </h1>
            </div>
        </div>

        <style>
            /* Keep font size fixed at 70px on large screens */
            .splash-title {
                font-size: 70px;
                line-height: 1.1;
                margin: 0;
                padding-left: 50px;
                white-space: nowrap;
                /* prevent wrapping */
            }

            .gradient-text {
                background: linear-gradient(90deg, #0026cc, #001a80, #000d40);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
            }

            /* Container responsive adjustments */
            .splash-area-section .container {
                max-width: 100%;
                /* horizontal scroll if needed */
                padding: 0 15px;
            }

            /* Scale down text slightly on very small screens */
            @media (max-width: 400px) {
                .splash-title {
                    font-size: 60px;
                    padding-left: 10px;
                }
            }
        </style>
    </section>

    <section data-aos="fade-up" class="gap mt-5">
        <div class="container">
            <div class="row g-3">
                @foreach ($gallery->images_path as $index => $image)
                    <div class="col-lg-3 col-md-4 col-6">
                        <div data-aos="zoom-in-up" data-aos-delay="140" class="gallery-item mb-3">
                            <img src="{{ $image }}" alt="{{ $gallery->title }}"
                                class="img-fluid rounded shadow-sm gallery-thumb" data-index="{{ $index }}">
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center" style="margin-left:0px; width:10%;">
                <a href="{{ route('galleries.index') }}" class="themebtu">
                    <i class="fa fa-arrow-left"></i> Back
                </a>
            </div>
        </div>
    </section>

    <!-- Fullscreen Lightbox -->
    <div id="lightbox" class="lightbox d-none">
        <span class="close">&times;</span>
        <span class="prev">&#10094;</span>
        <span class="next">&#10095;</span>
        <img id="lightbox-img" class="lightbox-content">
    </div>

    <style>
        /* Thumbnail hover effect */
        .gallery-item img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            cursor: pointer;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .gallery-item img:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }

        /* Lightbox styling */
        .lightbox {
            position: fixed;
            z-index: 9999;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.9);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .lightbox-content {
            max-width: 90%;
            max-height: 80%;
            border-radius: 10px;
            box-shadow: 0 0 25px rgba(0, 0, 0, 0.6);
        }

        /* Controls */
        .close,
        .prev,
        .next {
            position: absolute;
            color: #fff;
            font-size: 2.5rem;
            cursor: pointer;
            user-select: none;
            transition: color 0.3s ease;
        }

        .close:hover,
        .prev:hover,
        .next:hover {
            color: #00bcd4;
        }

        .close {
            top: 20px;
            right: 30px;
        }

        .prev,
        .next {
            top: 50%;
            transform: translateY(-50%);
            padding: 10px;
        }

        .prev {
            left: 30px;
        }

        .next {
            right: 30px;
        }
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const images = document.querySelectorAll(".gallery-thumb");
            const lightbox = document.getElementById("lightbox");
            const lightboxImg = document.getElementById("lightbox-img");
            const close = document.querySelector(".close");
            const prev = document.querySelector(".prev");
            const next = document.querySelector(".next");

            let currentIndex = 0;

            // Show image in lightbox
            images.forEach((img, index) => {
                img.addEventListener("click", () => {
                    currentIndex = index;
                    showImage(currentIndex);
                    lightbox.classList.remove("d-none");
                });
            });

            // Close lightbox
            close.addEventListener("click", () => {
                lightbox.classList.add("d-none");
            });

            // Next / Prev navigation
            next.addEventListener("click", () => {
                currentIndex = (currentIndex + 1) % images.length;
                showImage(currentIndex);
            });
            prev.addEventListener("click", () => {
                currentIndex = (currentIndex - 1 + images.length) % images.length;
                showImage(currentIndex);
            });

            // Click outside image to close
            lightbox.addEventListener("click", (e) => {
                if (e.target === lightbox) lightbox.classList.add("d-none");
            });

            // Keyboard navigation
            document.addEventListener("keydown", (e) => {
                if (lightbox.classList.contains("d-none")) return;
                if (e.key === "ArrowRight") next.click();
                if (e.key === "ArrowLeft") prev.click();
                if (e.key === "Escape") close.click();
            });

            function showImage(index) {
                lightboxImg.src = images[index].src;
            }
        });
    </script>
@endsection
