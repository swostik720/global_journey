@extends('frontend.layouts.includes.master')
@section('meta_title', 'Blogs | ' . ($setting->name ?? config('app.name')))
@section('meta_description', 'Read Global Journey blogs for study abroad insights, visa tips, test preparation strategies, and student success guidance.')
@section('maincontent')
    @include('frontend.layouts.includes.page_hero', [
        'eyebrow' => 'Global Journey Journal',
        'title' => 'Our ',
        'accent' => 'Blogs',
        'subtitle' => 'Practical guidance, student stories, destination insights, and application strategy from the Global Journey team.',
        'meta' => ['Study Abroad Insights', 'Visa Advice', 'Student Success Stories'],
        'primaryAction' => ['label' => 'Contact an Advisor', 'url' => route('contact-us')],
    ])

    <section data-aos="fade-up" class="gj-page-shell gj-page-shell--blue blog-index-section">
        <div class="container">
            <div data-aos="fade-up" data-aos-delay="100" class="gj-section-header">
                <span class="gj-section-header__eyebrow">Blogs</span>
                <h2>Insights, Guides, and Tips for Your Study Journey</h2>
                <p>Browse expert-written articles built to help students choose the right path, destination, and preparation strategy.</p>
            </div>

            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 justify-content-center">
                @foreach ($blogs as $blog)
                    <div class="col">
                        <a href="{{ route('blog.details', $blog->slug) }}" class="blog-card-link d-block h-100"
                            aria-label="Read blog: {{ $blog->title }}">
                            <div data-aos="zoom-in-up" data-aos-delay="140" class="card blog-card h-100 border-0 shadow-sm rounded-4 overflow-hidden d-flex flex-column">
                                @if ($blog->image_path)
                                    <div class="ratio ratio-4x3 position-relative">
                                        <img src="{{ $blog->image_path }}" class="card-img-top" alt="{{ $blog->title }}">
                                        <div class="blog-card-overlay position-absolute top-0 start-0 w-100 h-100"></div>
                                    </div>
                                @endif
                                <div data-aos="zoom-in-up" data-aos-delay="140" class="card-body d-flex flex-column p-4">
                                    <h3 class="card-title h5 mb-2">{{ $blog->title }}</h3>
                                    <p class="card-text small mb-3">
                                        {{ \Illuminate\Support\Str::words($blog->short_description, 25, '...') }}
                                    </p>

                                    <!-- Category centered -->
                                    <div class="mb-2">
                                        <span class="badge rounded-pill bg-light text-dark border">
                                            {{ $blog->category->name ?? 'General' }}
                                        </span>
                                    </div>

                                    <!-- Date & User -->
                                    <div class="d-flex justify-content-between text-muted small mb-3">
                                        <div>
                                            <i class="bi bi-calendar-event me-1"></i>
                                            {{ \Carbon\Carbon::parse($blog->blog_date)->format('M d, Y') }}
                                        </div>
                                        <div>
                                            <i class="bi bi-person-circle me-1"></i>
                                            <strong>{{ $blog->author->name ?? 'Global Journey Team' }}</strong>
                                        </div>
                                    </div>
                                    <!-- Read More label always at bottom -->
                                    <span class="themebtu blog-card__cta mt-auto">Learn More <i class="bi bi-arrow-right"></i></span>
                                </div>
                                <div class="blog-card-progress"></div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Pagination -->
    <div class="container blog-index-pagination">
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
            transition: all 0.4s ease;
            min-height: 100%;
            position: relative;
            border-radius: 20px;
        }

        .blog-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
        }

        .blog-card-progress {
            position: absolute;
            left: 0;
            bottom: 0;
            height: 5px;
            width: 0%;
            background: linear-gradient(135deg,
                    #0038A6,
                    #0046C4,
                    #0058E8,
                    #003070,
                    #001F50);
            transition: width 0.6s ease-in-out;
            border-bottom-left-radius: 20px;
            border-bottom-right-radius: 20px;
        }

        .blog-card:hover .blog-card-progress {
            width: 100%;
        }

        .card-img-top {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .blog-card-overlay {
            background: linear-gradient(180deg, rgba(0, 0, 0, 0) 40%, rgba(0, 0, 0, 0.4) 100%);
            opacity: 0;
            transition: opacity 0.5s ease;
        }

        .blog-card:hover .card-img-top {
            transform: scale(1.08);
        }

        .blog-card:hover .blog-card-overlay {
            opacity: 1;
        }

        .badge {
            font-size: 0.75rem;
            padding: 5px 10px;
        }

        .blog-card__cta {
            width: 100%;
            display: inline-flex;
            justify-content: center;
            margin-top: 10px;
        }

        .card-body .card-title {
            font-weight: 700;
            color: #333;
        }

        .card-body .card-text {
            color: #666;
            line-height: 1.6;
        }

        .blog-index-section {
            padding-bottom: 3rem;
        }

        .blog-index-pagination {
            margin-bottom: 4rem;
        }

        @media (max-width: 991.98px) {
            .blog-index-section {
                padding-bottom: 2rem;
            }

            .blog-index-pagination {
                margin-bottom: 3rem;
            }
        }

        @media (max-width: 575.98px) {
            .blog-index-section {
                padding-bottom: 1.5rem;
            }

            .blog-index-pagination {
                margin-bottom: 2rem;
            }
        }

        @media (hover: none) {
            .blog-card:hover {
                transform: none;
            }
        }
    </style>
@endsection

