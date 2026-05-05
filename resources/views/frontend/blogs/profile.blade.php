@extends('frontend.layouts.includes.master')
@section('meta_title', ($author->name ?? 'Author Profile') . ' | ' . ($setting->name ?? config('app.name')))
@section('meta_description', 'Explore author profile, expertise, and published blogs from the Global Journey knowledge team.')
@section('maincontent')
    @php
        $expertiseItems = collect(explode(',', (string) ($author->expertise ?? '')))
            ->map(fn ($item) => trim($item))
            ->filter()
            ->values();

        if ($expertiseItems->isEmpty()) {
            $expertiseItems = $categoryExpertise;
        }

        $socialLinks = collect([
            ['label' => 'LinkedIn', 'icon' => 'bi bi-linkedin', 'url' => $author->linkedin_url],
            ['label' => 'X', 'icon' => 'bi bi-twitter-x', 'url' => $author->x_url],
            ['label' => 'Facebook', 'icon' => 'bi bi-facebook', 'url' => $author->facebook_url],
            ['label' => 'Instagram', 'icon' => 'bi bi-instagram', 'url' => $author->instagram_url],
            ['label' => 'Amazon', 'icon' => 'bi bi-amazon', 'url' => $author->amazon_url],
        ])->filter(fn ($item) => filled($item['url']))->values();
    @endphp

    @include('frontend.layouts.includes.page_hero', [
        'eyebrow' => 'Author Profile',
        'title' => 'Meet ',
        'accent' => $author->name,
        'subtitle' => 'Explore the author profile, expertise areas, and published resources created to guide students through study abroad decisions.',
        'meta' => [$publishedCount . ' Articles', $author->company ?: 'Global Journey', $author->title ?: 'Author'],
    ])

    <section data-aos="fade-up" class="bap-main">
        <div class="container">
            <div class="bap-layout">
                <aside class="bap-sidebar">
                    <div data-aos="zoom-in-up" data-aos-delay="120" class="bap-card bap-card--hero">
                        <div class="bap-card__glow"></div>
                        <img src="{{ $author->profile_picture_path }}" alt="{{ $author->name }}" class="bap-avatar">
                        <h2 class="bap-name">{{ $author->name }}</h2>
                        <p class="bap-title">{{ $author->title ?: 'Author' }}</p>

                        <div class="bap-actions">
                            @if ($author->email)
                                <a href="mailto:{{ $author->email }}" class="themebtu bap-btn">Email Author</a>
                            @endif
                            @if ($author->website)
                                <a href="{{ $author->website }}" target="_blank" rel="noopener noreferrer" class="bap-ghost-btn">Visit Website</a>
                            @endif
                        </div>

                        @if ($socialLinks->isNotEmpty())
                            <div class="bap-socials">
                                @foreach ($socialLinks as $social)
                                    <a href="{{ $social['url'] }}" target="_blank" rel="noopener noreferrer" aria-label="{{ $social['label'] }}">
                                        <i class="{{ $social['icon'] }}"></i>
                                    </a>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <div data-aos="zoom-in-up" data-aos-delay="170" class="bap-card">
                        <h3 class="bap-card__title">Author Snapshot</h3>
                        <div class="bap-stat-list">
                            <div class="bap-stat-item">
                                <span>Articles Written</span>
                                <strong>{{ $publishedCount }}</strong>
                            </div>
                            <div class="bap-stat-item">
                                <span>Company</span>
                                <strong>{{ $author->company ?: 'Global Journey' }}</strong>
                            </div>
                            <div class="bap-stat-item">
                                <span>Favourite Tool</span>
                                <strong>{{ $author->favourite_tool ?: 'Research & Writing Stack' }}</strong>
                            </div>
                            <div class="bap-stat-item">
                                <span>Email</span>
                                <strong>{{ $author->email ?: 'Not provided' }}</strong>
                            </div>
                        </div>
                    </div>

                    @if ($expertiseItems->isNotEmpty())
                        <div data-aos="zoom-in-up" data-aos-delay="220" class="bap-card">
                            <h3 class="bap-card__title">Expertise</h3>
                            <div class="bap-tags">
                                @foreach ($expertiseItems as $tag)
                                    <span class="bap-tag">{{ $tag }}</span>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </aside>

                <div class="bap-content">
                    <section data-aos="fade-up" class="bap-panel bap-panel--intro">
                        <div class="bap-panel__head">
                            <span class="bap-panel__eyebrow">Author Profile</span>
                            <h2>About {{ $author->name }}</h2>
                        </div>
                        <div class="bap-prose">
                            <p>
                                {!! $author->about_author ?: '<strong>' . e($author->name) . '</strong> shares practical guidance for students and families navigating study abroad, admissions, interviews, and test preparation.' !!}
                            </p>
                            @if ($featuredBlog)
                                <p>
                                    Latest contribution: <a href="{{ route('blog.details', $featuredBlog->slug) }}">{{ $featuredBlog->title }}</a>.
                                </p>
                            @endif
                        </div>
                    </section>

                    {{-- <section data-aos="fade-up" class="bap-panel">
                        <div class="bap-panel__head">
                            <span class="bap-panel__eyebrow">Credentials</span>
                            <h2>Professional Overview</h2>
                        </div>
                        <div class="bap-overview-grid">
                            <div class="bap-overview-card">
                                <span class="bap-overview-card__label">Education</span>
                                <strong>{{ $author->education ?: 'Not added yet' }}</strong>
                            </div>
                            <div class="bap-overview-card">
                                <span class="bap-overview-card__label">Expertise</span>
                                <strong>{{ $author->expertise ?: ($categoryExpertise->first() ?? 'Study Abroad Guidance') }}</strong>
                            </div>
                            <div class="bap-overview-card">
                                <span class="bap-overview-card__label">Company</span>
                                <strong>{{ $author->company ?: 'Global Journey' }}</strong>
                            </div>
                            <div class="bap-overview-card">
                                <span class="bap-overview-card__label">Favourite Tool</span>
                                <strong>{{ $author->favourite_tool ?: 'Not added yet' }}</strong>
                            </div>
                            <div class="bap-overview-card">
                                <span class="bap-overview-card__label">Website</span>
                                <strong>{{ $author->website ?: 'Not added yet' }}</strong>
                            </div>
                            <div class="bap-overview-card">
                                <span class="bap-overview-card__label">Articles Written By Author</span>
                                <strong>{{ $publishedCount }}</strong>
                            </div>
                        </div>
                    </section> --}}

                    <section data-aos="fade-up" class="bap-panel">
                        <div class="bap-panel__head">
                            <span class="bap-panel__eyebrow">Articles</span>
                            <h2>Written by {{ $author->name }}</h2>
                        </div>

                        @if ($authorBlogs->isNotEmpty())
                            <div class="row g-4">
                                @foreach ($authorBlogs as $blog)
                                    <div class="col-md-6">
                                        <a href="{{ route('blog.details', $blog->slug) }}" class="bap-blog-link d-block h-100" aria-label="Read blog: {{ $blog->title }}">
                                            <div class="card bap-blog-card h-100 border-0 rounded-4 overflow-hidden d-flex flex-column">
                                                @if ($blog->image_path)
                                                    <img src="{{ $blog->image_path }}" class="card-img-top" alt="{{ $blog->title }}" loading="lazy">
                                                @endif
                                                <div class="card-body d-flex flex-column">
                                                    <div class="bap-blog-card__meta">
                                                        <span><i class="bi bi-calendar-event"></i> {{ \Carbon\Carbon::parse($blog->blog_date)->format('M d, Y') }}</span>
                                                        <span><i class="bi bi-folder2-open"></i> {{ $blog->category->name ?? 'General' }}</span>
                                                    </div>
                                                    <h5 class="card-title fw-bold">{{ $blog->title }}</h5>
                                                    <p class="card-text text-muted">
                                                        {{ \Illuminate\Support\Str::words(strip_tags($blog->short_description), 22, '...') }}
                                                    </p>
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
                            <div class="bap-empty">
                                No published articles by this author yet.
                            </div>
                        @endif
                    </section>
                </div>
            </div>
        </div>
    </section>

    {{-- @include('frontend.layouts.take_next_step')
    @include('frontend.layouts.stay_updated', ['stayUpdatedInputId' => 'author-stay-updated-email']) --}}

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

        .bap-main {
            padding: 52px 0 60px;
            background: #f4f7fb;
        }

        .bap-layout {
            display: grid;
            grid-template-columns: 320px minmax(0, 1fr);
            gap: 30px;
            align-items: start;
        }

        .bap-sidebar {
            position: sticky;
            top: 110px;
            display: flex;
            flex-direction: column;
            gap: 18px;
        }

        .bap-card,
        .bap-panel {
            background: #fff;
            border: 1px solid #dfebfb;
            border-radius: 22px;
            box-shadow: 0 16px 36px rgba(15, 36, 96, 0.08);
        }

        .bap-card {
            padding: 22px;
            position: relative;
            overflow: hidden;
        }

        .bap-card--hero {
            background: linear-gradient(180deg, #fdfefe 0%, #f4f8ff 100%);
            text-align: center;
        }

        .bap-card__glow {
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at top, rgba(29, 78, 216, 0.16), transparent 55%);
            pointer-events: none;
        }

        .bap-avatar {
            position: relative;
            z-index: 1;
            width: 124px;
            height: 124px;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid #ffffff;
            box-shadow: 0 18px 34px rgba(29, 78, 216, 0.18);
            margin-bottom: 16px;
        }

        .bap-name {
            position: relative;
            z-index: 1;
            font-size: 1.42rem;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 4px;
        }

        .bap-title {
            position: relative;
            z-index: 1;
            color: #64748b;
            font-size: 0.86rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            margin-bottom: 18px;
        }

        .bap-actions {
            position: relative;
            z-index: 1;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .bap-btn,
        .bap-ghost-btn {
            width: 100%;
            text-align: center;
            display: inline-block;
            border-radius: 12px;
        }

        .bap-ghost-btn {
            padding: 11px 14px;
            text-decoration: none;
            font-weight: 600;
            color: #12306f;
            border: 1px solid #cdddf7;
            background: #fff;
            transition: all 0.2s ease;
        }

        .bap-ghost-btn:hover {
            color: #0f2460;
            border-color: #9dbcf2;
            transform: translateY(-1px);
        }

        .bap-socials {
            position: relative;
            z-index: 1;
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 16px;
            flex-wrap: wrap;
        }

        .bap-socials a {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            display: grid;
            place-items: center;
            text-decoration: none;
            color: #12306f;
            background: #eff6ff;
            border: 1px solid #cfe0fb;
            transition: all 0.2s ease;
        }

        .bap-socials a:hover {
            background: linear-gradient(135deg, #0f2460, #1d4ed8);
            color: #fff;
            transform: translateY(-2px);
        }

        .bap-card__title {
            font-size: 1rem;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 14px;
        }

        .bap-stat-list {
            display: grid;
            gap: 12px;
        }

        .bap-stat-item {
            display: flex;
            justify-content: space-between;
            gap: 14px;
            align-items: baseline;
            padding-bottom: 10px;
            border-bottom: 1px dashed #d8e4f8;
        }

        .bap-stat-item:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .bap-stat-item span {
            font-size: 0.86rem;
            color: #64748b;
        }

        .bap-stat-item strong {
            font-size: 0.92rem;
            color: #0f172a;
            text-align: right;
        }

        .bap-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .bap-tag {
            padding: 8px 12px;
            border-radius: 999px;
            font-size: 0.8rem;
            font-weight: 600;
            color: #1d4ed8;
            background: #eff6ff;
            border: 1px solid #bfdbfe;
        }

        .bap-content {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .bap-panel {
            padding: 28px;
        }

        .bap-panel--intro {
            background: linear-gradient(135deg, #ffffff 0%, #f7fbff 100%);
        }

        .bap-panel__head {
            margin-bottom: 18px;
        }

        .bap-panel__eyebrow {
            display: inline-block;
            font-size: 0.76rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: #1d4ed8;
            background: #eff6ff;
            border: 1px solid #cfe0fb;
            border-radius: 999px;
            padding: 6px 12px;
            margin-bottom: 12px;
        }

        .bap-panel__head h2 {
            margin: 0;
            font-size: 2rem;
            color: #0f172a;
            font-weight: 700;
        }

        .bap-prose p {
            color: #334155;
            line-height: 1.9;
            margin-bottom: 1rem;
        }

        .bap-prose p:last-child {
            margin-bottom: 0;
        }

        .bap-prose a {
            color: #1d4ed8;
            font-weight: 600;
            text-decoration: underline;
            text-underline-offset: 3px;
        }

        .bap-overview-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 16px;
        }

        .bap-overview-card {
            border-radius: 18px;
            background: linear-gradient(180deg, #ffffff 0%, #f6f9ff 100%);
            border: 1px solid #dbe8fb;
            padding: 18px;
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.9);
        }

        .bap-overview-card__label {
            display: block;
            font-size: 0.78rem;
            font-weight: 700;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            color: #64748b;
            margin-bottom: 8px;
        }

        .bap-overview-card strong {
            color: #0f172a;
            line-height: 1.55;
            font-size: 1rem;
        }

        .bap-blog-link {
            text-decoration: none;
            color: inherit;
        }

        .bap-blog-card {
            border: 1px solid #dfebfb !important;
            background: #fff;
            box-shadow: 0 12px 28px rgba(15, 36, 96, 0.08);
            transition: transform 0.28s ease, box-shadow 0.28s ease;
        }

        .bap-blog-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 18px 34px rgba(15, 36, 96, 0.14);
        }

        .bap-blog-card .card-img-top {
            height: 220px;
            object-fit: cover;
        }

        .bap-blog-card__meta {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            font-size: 0.78rem;
            color: #64748b;
            margin-bottom: 14px;
        }

        .bap-blog-card__meta span {
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .bap-blog-card .themebtu {
            width: 100%;
            text-align: center;
            display: inline-block;
            margin-top: 10px;
        }

        .bap-empty {
            padding: 24px;
            border-radius: 16px;
            border: 1px dashed #bfd5f7;
            background: #f8fbff;
            color: #475569;
            text-align: center;
            font-weight: 500;
        }

        @media (max-width: 992px) {
            .bap-layout {
                grid-template-columns: 1fr;
            }

            .bap-sidebar {
                position: static;
            }
        }

        @media (max-width: 576px) {
            .bap-main {
                padding: 34px 0 44px;
            }

            .bap-panel,
            .bap-card {
                padding: 18px;
            }

            .bap-overview-grid {
                grid-template-columns: 1fr;
            }

            .splash-title {
                font-size: 52px;
                padding-left: 10px;
                white-space: normal;
            }
        }
    </style>
@endsection
