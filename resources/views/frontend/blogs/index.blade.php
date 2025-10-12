@extends('frontend.layouts.includes.master')
@section('maincontent')
    <section class="splash-area-section" style="background-image: url({{ asset('frontend/assets/img/background.jpg') }})">
        <div class="container">
            <div class="splash-area">
                <h2 style="font-size: 60px;">Our</h2>
                <h2 style="
    font-size: 60px;
    background: linear-gradient(90deg, #0026cc, #001a80, #000d40);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
  ">Blogs</h2>
            </div>
        </div>
    </section>

    <section class="gap no-top mt-5">
        <div class="container">
            <div class="row g-4">
                @foreach ($blogs as $blog)
                    <div class="col-lg-4 col-md-6">
                        <div class="card blog-card h-100 border-0 shadow-sm rounded-4 overflow-hidden d-flex flex-column">
                            @if ($blog->image_path)
                                <img src="{{ $blog->image_path }}" class="card-img-top" alt="{{ $blog->title }}">
                            @endif
                            <div class="card-body d-flex flex-column">
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
                                        <strong>{{ $blog->user->name }}</strong>
                                    </div>
                                </div>

                                <!-- Read More button always at bottom -->
                                <a href="{{ route('blog.details', $blog->slug) }}" class="themebtu mt-auto">
                                    Read More
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
            {{ $blogs->links('pagination::bootstrap-4') }}
        </div>
    </div>

    <style>
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
    </style>
@endsection
