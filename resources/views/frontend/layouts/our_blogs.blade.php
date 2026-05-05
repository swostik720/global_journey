<section data-aos="fade-up" class="latest-blog latest-blog-home">
    <div class="container">
        <div class="tp-hero__shapes blog-home-shapes">
            <div class="style-shapes-1"></div>
            <div class="style-shapes-2">
                <img alt="shape" src="{{ asset('frontend/assets/img/shap-4.png') }}">
            </div>
            <div class="style-shapes-3"></div>
            <div class="style-shapes-5">
                <img alt="shape" src="{{ asset('frontend/assets/img/shap-1.png') }}">
            </div>
            <div class="style-shapes-6">
                <img alt="shape" src="{{ asset('frontend/assets/img/shap-2.png') }}">
            </div>
            <div class="style-shapes-7">
                <img alt="shape" src="{{ asset('frontend/assets/img/shap-5.png') }}">
            </div>
        </div>

        <div data-aos="fade-up" data-aos-delay="100" class="heading-boder two text-center">
            <h2>Explore Our Latest <span>Blog Posts</span></h2>
            <p>Insights, Tips, and Stories from Global Journey</p>
        </div>

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 justify-content-center">
            @foreach ($blogs as $blog)
                <div class="col">
                    <a href="{{ route('blog.details', $blog->slug) }}" class="blog-card-link d-block h-100"
                        aria-label="Read blog: {{ $blog->title }}">
                        <div data-aos="zoom-in-up" data-aos-delay="{{ 140 + ($loop->index * 70) }}" class="card blog-card h-100 border-0 shadow-sm rounded-4 overflow-hidden d-flex flex-column">
                            @if ($blog->image_path)
                                <div class="ratio ratio-4x3 position-relative">
                                    <img src="{{ $blog->image_path }}" class="card-img-top" alt="{{ $blog->title }}">
                                    <div class="blog-card-overlay position-absolute top-0 start-0 w-100 h-100"></div>
                                </div>
                            @endif
                            <div class="card-body d-flex flex-column p-4">
                                <h3 class="card-title h5 mb-2">{{ $blog->title }}</h3>
                                <p class="card-text small mb-3">
                                    {{ \Illuminate\Support\Str::words($blog->short_description, 25, '...') }}
                                </p>

                                <div class="mb-2">
                                    <span class="badge rounded-pill bg-light text-dark border">
                                        {{ $blog->category->name ?? 'General' }}
                                    </span>
                                </div>

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

                                <span class="themebtu mt-auto" style="justify-content:center;">Learn More <i class="bi bi-arrow-right"></i></span>
                            </div>
                            <div class="blog-card-progress"></div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        @if (!empty($hasMoreBlogs))
            <div class="blog-home-more" data-aos="fade-up" data-aos-delay="220">
                <a href="{{ route('blogs') }}" class="themebtu">View More</a>
            </div>
        @endif
    </div>
</section>

<style>
    .latest-blog-home {
        background: linear-gradient(180deg, #eef4ff 0%, #e6eeff 100%);
        position: relative;
        overflow: hidden;
        padding: 80px 24px;
        margin-bottom: 0;
    }

    .latest-blog-home .heading-boder.two p {
        padding-bottom: 30px;
    }

    .latest-blog-home .container {
        position: relative;
        z-index: 1;
    }

    .blog-home-shapes {
        pointer-events: none;
    }

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
        position: relative;
        transition: all 0.4s ease;
        height: 100%;
        min-height: 100%;
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
        background: linear-gradient(135deg, #0038A6, #0046C4, #0058E8, #003070, #001F50);
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

    .blog-card .themebtu {
        align-self: flex-start;
        white-space: nowrap;
    }

    .card-body .card-title {
        font-weight: 700;
        color: #333;
    }

    .card-body .card-text {
        color: #666;
        line-height: 1.6;
    }

    .blog-home-more {
        margin-top: 32px;
        text-align: center;
    }

    @media (max-width: 991.98px) {
        .latest-blog-home {
            padding: 64px 0 0;
        }
    }

    @media (max-width: 575.98px) {
        .latest-blog-home {
            padding: 52px 0 0;
        }

        .latest-blog-home .heading-boder.two p {
            padding-bottom: 22px;
        }
    }

    @media (hover: none) {
        .blog-card:hover {
            transform: none;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .blog-card:hover .blog-card-progress {
            width: 0%;
        }

        .blog-card:hover .card-img-top {
            transform: none;
        }

        .blog-card:hover .blog-card-overlay {
            opacity: 0;
        }
    }
</style>

