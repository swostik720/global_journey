@extends('frontend.layouts.includes.master')
@section('maincontent')
    <!-- Hero Section -->
    <section class="splash-area-section" style="background-image: url({{ asset('frontend/assets/img/background.jpg') }})">
        <div class="container">
            <div class="splash-area">
                <h2 class="splash-title">Our</h2>
                <h2 class="splash-title gradient-text">Galleries</h2>
            </div>
        </div>

        <style>
            /* Keep font size fixed at 70px */
            .splash-title {
                font-size: 70px;
                padding-left: 50px;
                line-height: 1.1;
                margin: 0;
                /* white-space: nowrap; */
                /* prevent wrapping */
            }

            .gradient-text {
                background: linear-gradient(90deg, #0026cc, #001a80, #000d40);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
            }

            /* Responsive container padding to avoid cutting text */
            .splash-area-section .container {
                max-width: 100%;
                padding: 0 15px;
            }

            /* Optional: slightly scale text on very small screens */
            @media (max-width: 400px) {
                .splash-title {
                    font-size: 70px;
                    padding-left: 10px;
                }
            }
        </style>
    </section>

    <!-- Gallery Cards Section -->
    <section class="gap no-top mt-5">
        <div class="container">
            <div class="row g-4">
                @foreach ($galleries as $gallery)
                    <div class="col-lg-4 col-md-6">
                        <div
                            class="card gallery-card h-100 border-0 shadow-sm rounded-4 overflow-hidden position-relative d-flex flex-column">

                            <!-- Hover Overlay -->
                            <div class="image-wrapper position-relative overflow-hidden">
                                @if (!empty($gallery->images_path))
                                    <img src="{{ $gallery->images_path[0] }}" class="card-img-top"
                                        alt="{{ $gallery->title }}">
                                @endif
                                <div class="overlay d-flex align-items-center justify-content-center">
                                    <i class="bi bi-eye-fill text-white fs-2"></i>
                                </div>
                            </div>

                            <div class="card-body d-flex flex-column">
                                <!-- Title -->
                                <h5 class="card-title fw-bold mb-2 text-dark">
                                    <i class="bi bi-camera-reels text-primary me-2"></i>{{ $gallery->title }}
                                </h5>

                                <!-- Category -->
                                <div class="mb-2">
                                    <span class="badge rounded-pill bg-light text-dark border">
                                        <i class="bi bi-tag me-1 text-secondary"></i>
                                        {{ $gallery->galleryCategory->title ?? 'General' }}
                                    </span>
                                </div>

                                <!-- Image Count -->
                                <div class="text-muted small mb-3">
                                    <i class="bi bi-images me-1 text-info"></i>
                                    {{ count($gallery->images ?? []) }} Images
                                </div>

                                <!-- View Button -->
                                <a href="{{ route('gallery.details', $gallery->id) }}" class="themebtu mt-auto text-center">
                                    <i class="bi bi-arrow-right me-1"></i> View Photos
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Pagination -->
    <div class="container mb-5">
        <div class="d-flex justify-content-center">
            {{ $galleries->links('pagination::bootstrap-4') }}
        </div>
    </div>

    <!-- Styles -->
    <style>
        /* Card base */
        .gallery-card {
            transition: all 0.4s ease;
            background: #fff;
            border-radius: 1rem;
        }

        /* Hover lift effect */
        .gallery-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 12px 28px rgba(0, 0, 0, 0.15);
        }

        /* Image hover zoom */
        .image-wrapper img {
            height: 230px;
            object-fit: cover;
            width: 100%;
            transition: transform 0.4s ease;
        }

        .gallery-card:hover .image-wrapper img {
            transform: scale(1.1);
        }

        /* Overlay fade-in on hover */
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.45);
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        .gallery-card:hover .overlay {
            opacity: 1;
        }

        /* Badge styling */
        .badge {
            font-size: 0.75rem;
            padding: 5px 10px;
            background: #f8f9fa;
        }

        /* Smooth transitions for everything */
        .card-title,
        .text-muted,
        .badge,
        .btn-view {
            transition: all 0.3s ease;
        }
    </style>
@endsection
