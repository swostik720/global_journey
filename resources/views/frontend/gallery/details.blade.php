@extends('frontend.layouts.includes.master')
@section('meta_title', ($gallery->title ?? 'Gallery Details') . ' | ' . ($setting->name ?? config('app.name')))
@section('meta_description', 'View gallery highlights, event moments, and student activities captured by Global Journey.')
@section('maincontent')
    @php
        $parts = explode(' ', $gallery->title ?? '', 3);
        $firstPart = isset($parts[0], $parts[1]) ? $parts[0] . ' ' . $parts[1] : $parts[0] ?? '';
        $secondPart = $parts[2] ?? '';
    @endphp

    @include('frontend.layouts.includes.page_hero', [
        'eyebrow' => 'Gallery Details',
        'title' => trim($firstPart) . ' ',
        'accent' => $secondPart ?: null,
        'subtitle' => 'Explore the full image set from this Global Journey gallery and revisit the moments behind the event.',
        'meta' => [count($gallery->images_path ?? [] ) . ' Images', 'Event Moments', 'Student Highlights'],
        'primaryAction' => ['label' => 'Back to Galleries', 'url' => route('galleries.index')],
    ])

    <section data-aos="fade-up" class="gj-page-shell gj-page-shell--white gj-page-shell--compact">
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

            <div class="text-center gj-divider-space">
                <a href="{{ route('galleries.index') }}" class="themebtu">
                    <i class="bi bi-arrow-left"></i> Back
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

        @media (max-width: 575.98px) {
            .gallery-item img {
                height: 160px;
            }
        }

        @media (hover: none) {
            .gallery-item img:hover {
                transform: none;
                box-shadow: none;
            }
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

