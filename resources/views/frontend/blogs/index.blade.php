@extends('frontend.layouts.includes.master')
@section('maincontent')
    <section data-aos="fade-up" class="splash-area-section" style="background-image: url({{ asset('frontend/assets/img/background.jpg') }})">
        <div class="container">
            <div class="splash-area">
                <h1 class="splash-title">Our <span class="gradient-text">Blogs</span></h1>
            </div>
        </div>

        <style>
            /* Keep font size fixed at 70px */
            .splash-title {
                font-size: 70px;
                padding-left: 50px;
                line-height: 1.1;
                margin: 0;
                white-space: nowrap;
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

    <section data-aos="fade-up" class="gap no-top mt-5">
        <div class="container">
            <div class="row g-4">
                @foreach ($blogs as $blog)
                    <div class="col-lg-4 col-md-6">
                        <a href="{{ route('blog.details', $blog->slug) }}" class="blog-card-link d-block h-100"
                            aria-label="Read blog: {{ $blog->title }}">
                            <div data-aos="zoom-in-up" data-aos-delay="140" class="card blog-card h-100 border-0 shadow-sm rounded-4 overflow-hidden d-flex flex-column">
                                @if ($blog->image_path)
                                    <img src="{{ $blog->image_path }}" class="card-img-top" alt="{{ $blog->title }}">
                                @endif
                                <div data-aos="zoom-in-up" data-aos-delay="140" class="card-body d-flex flex-column">
                                    <h5 class="card-title fw-bold">{{ $blog->title }}</h5>
                                    <p class="card-text text-muted">
                                        {{ \Illuminate\Support\Str::words($blog->short_description, 25, '...') }}
                                    </p>

                                    <!-- Category centered -->
                                    <div class="mb-2">
                                        <span class="badge rounded-pill bg-light text-dark border">
                                            {{ $blog->category->name ?? 'General' }}
                                        </span>
                                    </div>

                                    <!-- Date & User -->
                                    <div class="d-flex justify-content-between text-muted small mb-2">
                                        <div>
                                            <i class="bi bi-calendar-event me-1"></i>
                                            {{ \Carbon\Carbon::parse($blog->blog_date)->format('M d, Y') }}
                                        </div>
                                        <div>
                                            <i class="bi bi-person-circle me-1"></i>
                                            <strong>{{ $blog->user->name ?? 'Admin' }}</strong>
                                        </div>
                                    </div>

                                    <!-- Read More label always at bottom -->
                                    <span class="themebtu mt-auto">Read More</span>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Pagination -->
    <div class="container mb-5">
        <div class="d-flex justify-content-center">
            {{ $blogs->links('pagination::bootstrap-4') }}
        </div>
    </div>

    <style>
        .blog-card-link {
            text-decoration: none;
            color: inherit;
        }

        .blog-card-link:focus-visible {
            outline: 3px solid rgba(13, 110, 253, 0.45);
            outline-offset: 4px;
            border-radius: 1rem;
        }

        .blog-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .blog-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
        }

        .card-img-top {
            height: 220px;
            object-fit: cover;
        }

        .badge {
            font-size: 0.75rem;
            padding: 5px 10px;
        }

        .themebtu {
            width: 100%;
            text-align: center;
            display: inline-block;
            margin-top: 10px;
        }

        .blog-author-link {
            color: #475569;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .blog-author-link:hover {
            color: #1d4ed8;
        }
    </style>
@endsection
