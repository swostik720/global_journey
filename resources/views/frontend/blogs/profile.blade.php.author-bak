@extends('frontend.layouts.includes.master')
@section('maincontent')

    <section data-aos="fade-up" class="splash-area-section" style="background-image: url({{ asset('frontend/assets/img/background.jpg') }})">
        <div class="container">
            <div class="splash-area">
                <h1 class="splash-title">Writer <span class="gradient-text">{{ $user->name }}</span></h1>
            </div>
        </div>
    </section>

    <section data-aos="fade-up" class="abp-main">
        <div class="container">
            <div class="row g-4 g-xl-5">
                <div class="col-lg-4 col-xl-3">
                    <aside class="abp-sidebar">
                        <div data-aos="zoom-in-up" data-aos-delay="140" class="abp-card abp-card--author text-center">
                            <img src="{{ $user->image_path }}" alt="{{ $user->name }}" class="abp-avatar">
                            <h2 class="abp-name">{{ $user->name }}</h2>
                            <p class="abp-role">{{ ucwords(str_replace('_', ' ', $user->user_type ?? 'Content Writer')) }}</p>
                            <a href="mailto:{{ $user->email }}" class="themebtu abp-mail-btn">Email Author</a>
                        </div>

                        <div data-aos="zoom-in-up" data-aos-delay="140" class="abp-card">
                            <h3 class="abp-card__title">Writer Snapshot</h3>
                            <div data-aos="zoom-in-up" data-aos-delay="140" class="abp-meta-list">
                                <div data-aos="zoom-in-up" data-aos-delay="140" class="abp-meta-item">
                                    <span class="abp-meta-item__label">Published Articles</span>
                                    <strong>{{ $publishedCount }}</strong>
                                </div>
                                <div data-aos="zoom-in-up" data-aos-delay="140" class="abp-meta-item">
                                    <span class="abp-meta-item__label">Primary Niche</span>
                                    <strong>{{ $categoryExpertise->first() ?? 'Study Abroad' }}</strong>
                                </div>
                                <div data-aos="zoom-in-up" data-aos-delay="140" class="abp-meta-item">
                                    <span class="abp-meta-item__label">Contact</span>
                                    <strong>{{ $user->email }}</strong>
                                </div>
                            </div>
                        </div>

                        @if ($categoryExpertise->isNotEmpty())
                            <div data-aos="zoom-in-up" data-aos-delay="140" class="abp-card">
                                <h3 class="abp-card__title">Expertise</h3>
                                <div class="abp-tags">
                                    @foreach ($categoryExpertise as $tag)
                                        <span class="abp-tag">{{ $tag }}</span>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </aside>
                </div>

                <div class="col-lg-8 col-xl-9">
                    <section data-aos="fade-up" class="abp-about">
                        <div data-aos="fade-up" data-aos-delay="100" class="heading mb-4">
                            <h6>About Writer</h6>
                            <h2>{{ $user->name }}</h2>
                            <img alt="line" src="{{ asset('frontend/assets/img/headingline.png') }}">
                        </div>

                        <div class="abp-about__body">
                            <p>
                                <strong>{{ $user->name }}</strong> contributes high-value, practical content that helps students and families make confident decisions around study abroad, test preparation, and admissions strategy.
                            </p>
                            <p>
                                With <strong>{{ $publishedCount }} published article{{ $publishedCount === 1 ? '' : 's' }}</strong>, this writer focuses on clear guidance, actionable checklists, and real-world insight that improve clarity and outcomes for readers.
                            </p>
                            @if ($featuredBlog)
                                <p>
                                    Latest contribution: <a href="{{ route('blog.details', $featuredBlog->slug) }}">{{ $featuredBlog->title }}</a>.
                                </p>
                            @endif
                        </div>
                    </section>

                    <section data-aos="fade-up" class="abp-articles mt-4 mt-md-5">
                        <div data-aos="fade-up" data-aos-delay="100" class="heading mb-4">
                            <h6>Articles</h6>
                            <h2>Written by {{ $user->name }}</h2>
                            <img alt="line" src="{{ asset('frontend/assets/img/headingline.png') }}">
                        </div>

                        @if ($authorBlogs->isNotEmpty())
                            <div class="row g-4">
                                @foreach ($authorBlogs as $blog)
                                    <div class="col-md-6">
                                        <a href="{{ route('blog.details', $blog->slug) }}" class="abp-blog-link d-block h-100" aria-label="Read blog: {{ $blog->title }}">
                                            <div data-aos="zoom-in-up" data-aos-delay="140" class="card abp-blog-card h-100 border-0 shadow-sm rounded-4 overflow-hidden d-flex flex-column">
                                                @if ($blog->image_path)
                                                    <img src="{{ $blog->image_path }}" class="card-img-top" alt="{{ $blog->title }}" loading="lazy">
                                                @endif
                                                <div data-aos="zoom-in-up" data-aos-delay="140" class="card-body d-flex flex-column">
                                                    <h5 class="card-title fw-bold">{{ $blog->title }}</h5>
                                                    <p class="card-text text-muted">
                                                        {{ \Illuminate\Support\Str::words(strip_tags($blog->short_description), 22, '...') }}
                                                    </p>

                                                    <div class="mb-2">
                                                        <span class="badge rounded-pill bg-light text-dark border">
                                                            {{ $blog->category->name ?? 'General' }}
                                                        </span>
                                                    </div>

                                                    <div class="d-flex justify-content-between text-muted small mb-2">
                                                        <div>
                                                            <i class="bi bi-calendar-event me-1"></i>
                                                            {{ \Carbon\Carbon::parse($blog->blog_date)->format('M d, Y') }}
                                                        </div>
                                                        <div>
                                                            <i class="bi bi-clock me-1"></i>
                                                            {{ max(1, ceil(str_word_count(strip_tags($blog->short_description)) / 160)) }} min read
                                                        </div>
                                                    </div>

                                                    <span class="themebtu mt-auto">Read More</span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>

                            <div class="mt-4 d-flex justify-content-center">
                                {{ $authorBlogs->links('pagination::bootstrap-4') }}
                            </div>
                        @else
                            <div class="abp-empty">
                                No published articles by this writer yet.
                            </div>
                        @endif
                    </section>
                </div>
            </div>
        </div>
    </section>

    <style>
        .splash-title {
            font-size: 70px;
            padding-left: 50px;
            line-height: 1.1;
            margin: 0;
            white-space: nowrap;
        }

        .gradient-text {
            background: linear-gradient(90deg, #0026cc, #001a80, #000d40);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .splash-area-section .container {
            max-width: 100%;
            padding: 0 15px;
        }

        .abp-main {
            padding: 48px 0 64px;
            background: #f4f7fb;
        }

        .abp-sidebar {
            position: sticky;
            top: 24px;
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .abp-card {
            background: #fff;
            border: 1px solid #e2e8f3;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(10, 30, 80, 0.07);
            padding: 20px;
            transition: transform 0.24s ease, box-shadow 0.24s ease;
        }

        .abp-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 28px rgba(10, 30, 80, 0.13);
        }

        .abp-avatar {
            width: 110px;
            height: 110px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #eff6ff;
            box-shadow: 0 8px 20px rgba(29, 78, 216, 0.15);
            margin-bottom: 14px;
        }

        .abp-name {
            font-size: 1.2rem;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 4px;
        }

        .abp-role {
            font-size: 0.82rem;
            font-weight: 500;
            color: #64748b;
            margin-bottom: 14px;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }

        .abp-mail-btn {
            width: 100%;
            text-align: center;
            margin-top: 4px;
        }

        .abp-card__title {
            font-size: 1rem;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 12px;
        }

        .abp-meta-list {
            display: grid;
            gap: 10px;
        }

        .abp-meta-item {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            gap: 10px;
            border-bottom: 1px dashed #e2e8f0;
            padding-bottom: 8px;
        }

        .abp-meta-item:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .abp-meta-item__label {
            color: #64748b;
            font-size: 0.86rem;
        }

        .abp-meta-item strong {
            color: #1e293b;
            font-size: 0.9rem;
            text-align: right;
        }

        .abp-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .abp-tag {
            font-size: 0.78rem;
            font-weight: 600;
            padding: 6px 10px;
            border-radius: 999px;
            background: #eff6ff;
            color: #1d4ed8;
            border: 1px solid #bfdbfe;
            transition: transform 0.2s ease;
        }

        .abp-tag:hover {
            transform: translateY(-1px);
        }

        .abp-about,
        .abp-articles {
            background: #fff;
            border: 1px solid #e2e8f3;
            border-radius: 18px;
            box-shadow: 0 4px 20px rgba(10, 30, 80, 0.07);
            padding: 24px;
        }

        .abp-about__body p {
            color: #334155;
            line-height: 1.85;
            margin-bottom: 1rem;
        }

        .abp-about__body p:last-child {
            margin-bottom: 0;
        }

        .abp-about__body a {
            color: #1d4ed8;
            font-weight: 600;
            text-decoration: underline;
            text-underline-offset: 3px;
        }

        .abp-blog-link {
            text-decoration: none;
            color: inherit;
        }

        .abp-blog-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .abp-blog-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
        }

        .abp-blog-card .card-img-top {
            height: 220px;
            object-fit: cover;
        }

        .abp-blog-card .themebtu {
            width: 100%;
            text-align: center;
            display: inline-block;
            margin-top: 10px;
        }

        .abp-empty {
            padding: 24px;
            border-radius: 12px;
            border: 1px dashed #bfdbfe;
            background: #f8fbff;
            color: #475569;
            text-align: center;
            font-weight: 500;
        }

        @media (max-width: 992px) {
            .abp-sidebar {
                position: static;
            }

            .abp-main {
                padding: 34px 0 44px;
            }
        }

        @media (max-width: 576px) {
            .abp-about,
            .abp-articles {
                padding: 18px;
            }

            .splash-title {
                font-size: 52px;
                padding-left: 10px;
                white-space: normal;
            }
        }
    </style>
@endsection
