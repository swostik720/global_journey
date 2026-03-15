<script type="application/ld+json">
{
 "@context": "https://schema.org",
 "@type": "BlogPosting",
 "headline": "{{ $blog->title }}",
 "image": "{{ $blog->image_path }}",
 "url": "{{ route('blog.details', $blog->slug) }}",
 "description": "{{ strip_tags($blog->short_description) }}",
 "author": {
   "@type": "Person",
   "name": "{{ $blog->user->name ?? 'Admin' }}"
 },
 "publisher": {
   "@type": "Organization",
   "name": "{{ config('app.name') }}",
   "logo": {
     "@type": "ImageObject",
     "url": "{{ asset('frontend/assets/img/logo.png') }}"
   }
 },
 "datePublished": "{{ \Carbon\Carbon::parse($blog->blog_date)->toIso8601String() }}",
 "dateModified": "{{ $blog->updated_at->toIso8601String() }}"
}
</script>

@if (!empty($blog->faqs))
    <script type="application/ld+json">
{
 "@context": "https://schema.org",
 "@type": "FAQPage",
 "mainEntity": [
 @foreach($blog->faqs as $faq)
 {
   "@type": "Question",
   "name": "{{ $faq['question'] }}",
   "acceptedAnswer": {
     "@type": "Answer",
     "text": "{{ $faq['answer'] }}"
   }
 }@if(!$loop->last),@endif
 @endforeach
 ]
}
</script>
@endif

@extends('frontend.layouts.includes.master')
@section('maincontent')
    <!-- Hero Section -->
    <section class="splash-area-section" style="background-image: url({{ asset('frontend/assets/img/background.jpg') }})">
        <div class="container">
            <div class="splash-area">
                @php
                    $parts = explode(' ', $blog->title ?? '', 3); // split into max 3 parts
                    $firstPart = isset($parts[0], $parts[1]) ? $parts[0] . ' ' . $parts[1] : $parts[0] ?? '';
                    $secondPart = $parts[2] ?? '';
                @endphp

                <h2 class="splash-title">{{ $firstPart }}</h2>
                @if ($secondPart)
                    <h2 class="splash-title gradient-text">{{ $secondPart }}</h2>
                @endif
            </div>
        </div>

        <style>
            /* Keep font size fixed at 70px */
            .splash-title {
                font-size: 70px;
                line-height: 1.1;
                margin: 0;
                padding-left: 50px;
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

            /* Optional: scale text slightly on very small screens */
            @media (max-width: 400px) {
                .splash-title {
                    font-size: 60px;
                    padding-left: 10px;
                }
            }
        </style>
    </section>

    <!-- Blog Content -->
    <section class="gap no-top mt-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-xl-9">
                    <!-- Blog Article -->
                    <article class="blog-article">
                        <!-- Blog Meta -->
                        <div
                            class="blog-meta d-flex flex-wrap justify-content-between align-items-center mb-4 p-3 bg-light rounded-3">
                            <div class="d-flex gap-4 flex-wrap align-items-center">
                                <div class="author-info d-flex align-items-center">
                                    <div class="author-avatar bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2"
                                        style="width: 40px; height: 40px;">
                                        {{ strtoupper(substr($blog->user->name ?? 'A', 0, 1)) }}
                                    </div>
                                    <div>
                                        <span class="fw-semibold text-dark">{{ $blog->user->name ?? 'Admin' }}</span>
                                    </div>
                                </div>
                                <div class="blog-date text-muted">
                                    <i class="bi bi-calendar-event me-1"></i>
                                    {{ \Carbon\Carbon::parse($blog->blog_date)->format('M d, Y') }}
                                </div>
                            </div>
                            <div class="blog-categories">
                                @foreach ($categories as $category)
                                    <span class="badge rounded-pill bg-light text-dark border me-1">
                                        <i class="bi bi-tag me-1"></i>{{ $category->name ?? '' }}
                                        ({{ $category->blogs_count ?? '0' }})
                                    </span>
                                @endforeach
                            </div>
                        </div>

                        <!-- Featured Image -->
                        @if ($blog->image_path)
                            <div class="featured-image mb-5">
                                <img src="{{ $blog->image_path }}" class="img-fluid rounded-4 shadow-sm w-100"
                                    alt="{{ $blog->title }}" style="height: 400px; object-fit: cover;">
                            </div>
                        @endif

                        <!-- Blog Content -->
                        <div class="blog-content">
                            <div class="content-wrapper">
                                {!! $blog->description ?? '' !!}
                            </div>
                        </div>

                        @if (!empty($blog->faqs))
                            <section class="faq-section py-4 px-3 mt-5 rounded-4"
                                style="background: rgba(220,220,220,0.15);">
                                <h4 class="fw-bold mb-4 text-dark">Frequently Asked Questions</h4>
                                <div class="accordion" id="blogFaqAccordion">
                                    @foreach ($blog->faqs as $index => $faq)
                                        <div class="accordion-item gradient-accordion">
                                            <h2 class="accordion-header" id="blogFaqHeading{{ $index }}">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#blogFaqCollapse{{ $index }}" aria-expanded="false"
                                                    aria-controls="blogFaqCollapse{{ $index }}">
                                                    Q. {{ $faq['question'] ?? '' }}
                                                </button>
                                            </h2>
                                            <div id="blogFaqCollapse{{ $index }}" class="accordion-collapse collapse"
                                                aria-labelledby="blogFaqHeading{{ $index }}"
                                                data-bs-parent="#blogFaqAccordion">
                                                <div class="accordion-body">
                                                    A. {!! $faq['answer'] ?? 'No answer available.' !!}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </section>
                        @endif

                        <!-- Navigation -->
                        <div class="blog-navigation d-flex justify-content-between align-items-center mt-5 pt-4 border-top">
                            @if ($previousBlog)
                                <a href="{{ route('blog.details', $previousBlog->slug) }}"
                                    class="nav-link prev-post d-flex align-items-center text-decoration-none">
                                    <div class="nav-icon me-3">
                                        <i class="bi bi-arrow-left-circle fs-4"></i>
                                    </div>
                                    <div>
                                        <small class="text-muted d-block">Previous Post</small>
                                        <span
                                            class="fw-semibold">{{ \Illuminate\Support\Str::limit($previousBlog->title, 30) }}</span>
                                    </div>
                                </a>
                            @else
                                <div></div>
                            @endif

                            @if ($nextBlog)
                                <a href="{{ route('blog.details', $nextBlog->slug) }}"
                                    class="nav-link next-post d-flex align-items-center text-decoration-none text-end">
                                    <div>
                                        <small class="text-muted d-block">Next Post</small>
                                        <span
                                            class="fw-semibold">{{ \Illuminate\Support\Str::limit($nextBlog->title, 30) }}</span>
                                    </div>
                                    <div class="nav-icon ms-3">
                                        <i class="bi bi-arrow-right-circle fs-4"></i>
                                    </div>
                                </a>
                            @endif
                        </div>
                    </article>
                </div>
            </div>
            <div class="text-center" style="margin-left:100px; width:10%;">
                <a href="{{ route('blogs') }}" class="themebtu"><i class="fa fa-arrow-left"></i> Back</a>
            </div>
        </div>
    </section>
    <!-- Related Posts -->
    @if ($relatedPosts->isNotEmpty())
        <section class="gap blog-recent-posts bg-light">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10 heading">
                        <h2>Related Posts</h2>
                        <h6>You Might Also Like</h6>
                        <img alt="line" src="{{ asset('frontend/assets/img/headingline.png') }}"
                            class="text-center mb-4">
                        <div class="row g-4">
                            @foreach ($relatedPosts as $relatedPost)
                                <div class="col-lg-4 col-md-6">
                                    <div
                                        class="card blog-card h-100 border-0 shadow-sm rounded-4 overflow-hidden d-flex flex-column">
                                        @if ($relatedPost->image_path)
                                            <img src="{{ $relatedPost->image_path }}" class="card-img-top"
                                                alt="{{ $relatedPost->title }}">
                                        @endif
                                        <div class="card-body d-flex flex-column">
                                            <h6 class="card-title fw-bold">{{ $relatedPost->title ?? '' }}</h6>
                                            <p class="card-text text-muted">
                                                {{ \Illuminate\Support\Str::words($relatedPost->short_description, 20, '...') }}
                                            </p>

                                            <!-- Category centered -->
                                            <div class="mb-2">
                                                <span class="badge rounded-pill bg-light text-dark border">
                                                    {{ $relatedPost->category->name ?? 'General' }}
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
                                            <a href="{{ route('blog.details', $relatedPost->slug) }}"
                                                class="themebtu mt-auto" style="text-align: center;">
                                                Read More
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <style>
        /* Blog Article Styles */
        .blog-article {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            margin-bottom: 3rem;
        }

        .blog-meta {
            border-left: 4px solid var(--bs-primary);
        }

        .author-avatar {
            font-weight: 600;
            font-size: 1.1rem;
        }

        /* Blog Content Styles */
        /* .blog-content {
                                    font-size: 1.1rem;
                                    line-height: 1.8;
                                    color: #444;
                                } */

        .content-wrapper p {
            margin-bottom: 1.5rem;
            text-align: justify;
        }

        .content-wrapper h1,
        .content-wrapper h2,
        .content-wrapper h3,
        .content-wrapper h4,
        .content-wrapper h5,
        .content-wrapper h6 {
            margin-top: 2rem;
            margin-bottom: 1rem;
            font-weight: 600;
            color: #2c3e50;
        }

        .content-wrapper ul,
        .content-wrapper ol {
            margin-bottom: 1.5rem;
            padding-left: 2rem;
        }

        .content-wrapper li {
            margin-bottom: 0.5rem;
        }

        .content-wrapper blockquote {
            background: #f8f9fa;
            border-left: 4px solid var(--bs-primary);
            padding: 1rem 1.5rem;
            margin: 2rem 0;
            font-style: italic;
            border-radius: 0 8px 8px 0;
        }

        .content-wrapper code {
            background: #f1f3f4;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 0.9em;
            color: #e91e63;
        }

        .content-wrapper pre {
            background: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 1rem;
            overflow-x: auto;
            margin: 1.5rem 0;
        }

        /* Navigation Styles */
        .blog-navigation .nav-link {
            color: #6c757d;
            transition: all 0.3s ease;
            padding: 1rem;
            border-radius: 8px;
            background: #f8f9fa;
            border: 1px solid #e9ecef;
            max-width: 45%;
        }

        .blog-navigation .nav-link:hover {
            color: var(--bs-primary);
            background: white;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
        }

        .nav-icon i {
            transition: transform 0.3s ease;
        }

        .prev-post:hover .nav-icon i {
            transform: translateX(-5px);
        }

        .next-post:hover .nav-icon i {
            transform: translateX(5px);
        }

        /* Related Posts Styles */
        .blog-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background: white;
        }

        .blog-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
        }

        .card-img-top {
            height: 200px;
            object-fit: cover;
        }

        .badge {
            font-size: 0.75rem;
            padding: 5px 10px;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .blog-article {
                padding: 1.5rem;
            }

            .blog-meta {
                flex-direction: column;
                align-items: flex-start !important;
                gap: 1rem;
            }

            .blog-navigation .nav-link {
                max-width: 100%;
                margin-bottom: 1rem;
            }

            .blog-navigation {
                flex-direction: column;
            }

            .content-wrapper {
                font-size: 1rem;
            }

            .featured-image img {
                height: 250px !important;
            }
        }

        /* Typography Improvements */
        .content-wrapper img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin: 1.5rem 0;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .content-wrapper table {
            width: 100%;
            border-collapse: collapse;
            margin: 1.5rem 0;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .content-wrapper table th,
        .content-wrapper table td {
            padding: 0.75rem;
            border-bottom: 1px solid #e9ecef;
            text-align: left;
        }

        .content-wrapper table th {
            background: #f8f9fa;
            font-weight: 600;
            color: #495057;
        }

        /* FAQ Accordion Styles (Interview Preparation style) */
        .gradient-accordion {
            border-radius: 10px;
            margin-bottom: 12px;
            transition: transform 0.3s ease, box-shadow 0.3s ease, border 0.3s ease;
            border: 2px solid transparent;
            background-clip: padding-box;
        }

        .gradient-accordion:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
            border-image-slice: 1;
            border-width: 2px;
            border-image-source: linear-gradient(90deg, #feda75, #fa7e1e, #d62976, #962fbf, #4f5bd5);
            border-style: solid;
        }

        .accordion-button {
            font-weight: 600;
            color: #0d6efd;
            transition: all 0.3s ease;
        }

        .accordion-button:focus {
            box-shadow: none;
        }

        .accordion-button:not(.collapsed) {
            background: rgba(13, 110, 253, 0.1);
            color: #0b5ed7;
        }

        .accordion-body {
            background: rgba(240, 240, 240, 0.5);
            padding: 15px;
            border-radius: 0 0 8px 8px;
            color: #333;
        }
    </style>
@endsection
