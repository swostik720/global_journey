@extends('frontend.layouts.includes.master')
@section('maincontent')
    <section class="splash-area-section" style="background-image: url({{ asset('frontend/assets/img/background.jpg') }})">
        <div class="container">
            <div class="splash-area">
                <h2>{{ $blog->title ?? '' }}</h2>
                <p class="mt-3"><a href="{{ url('/') }}">Home</a> / <a href="{{ route('blogs') }}">Blogs</a>
                    / <a href="#">{{ $blog->title ?? '' }}</a></p>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="title-blog">
                <h2>{{ $blog->title ?? '' }}</h2>
            </div>
            <div class="row">
                <div class="col-xl-8">
                    <div class="blog-item">
                        <img alt="img" src="{{ $blog->image_path ?? '' }}">
                        <p>{!! $blog->description ?? '' !!}</p>
                    </div>
                    <div class="next-previous-page two">
                        <div class="container">
                            <div class="next-previous">
                                <div class="prev">
                                    @if ($previousBlog)
                                        <a href="{{ route('blog.details', $previousBlog->slug) }}">
                                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                viewBox="0 0 476.213 476.213"
                                                style="enable-background:new 0 0 476.213 476.213;" xml:space="preserve">
                                                <polygon
                                                    points="405.606,167.5 384.394,188.713 418.787,223.106 0,223.106 0,253.106 418.787,253.106 384.394,287.5
                            405.606,308.713 476.213,238.106 " />
                                            </svg>
                                            Previous Page
                                        </a>
                                    @endif
                                </div>
                                <div class="next">
                                    @if ($nextBlog)
                                        <a href="{{ route('blog.details', $nextBlog->slug) }}">
                                            Next Page
                                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                viewBox="0 0 476.213 476.213"
                                                style="enable-background:new 0 0 476.213 476.213;" xml:space="preserve">
                                                <polygon
                                                    points="405.606,167.5 384.394,188.713 418.787,223.106 0,223.106 0,253.106 418.787,253.106 384.394,287.5
                                                    405.606,308.713 476.213,238.106 " />
                                            </svg>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 pl-60">
                    <ul class="sidebar">
                        <li>
                            <h4>Author : </h4>
                            <span>{{ $blog->user->name ?? 'Admin' }}</span>
                        </li>
                        <li>
                            <h4>Date :</h4>
                            <span>{{ \Carbon\Carbon::parse($blog->blog_date)->format('d F Y') }}</span>
                        </li>
                        <li>
                            <h4>Category :</h4>
                            @foreach ($categories as $category)
                                <span>
                                    {{ $category->name ?? '' }}
                                    <span>({{ $category->blogs_count ?? '0' }})</span>
                                    @if (!$loop->last)
                                        ,
                                    @endif
                                </span>
                            @endforeach
                        </li>
                        <li>
                            <h4>Share post :</h4>
                            <ul class="brandicon">
                                <li>
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}&title={{ urlencode($blog->title) }}"
                                        target="_blank">
                                        <i class="fa-brands fa-facebook-f"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://twitter.com/intent/tweet?text={{ urlencode($blog->title) }}&url={{ urlencode(url()->current()) }}"
                                        target="_blank">
                                        <i class="fa-brands fa-twitter"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(url()->current()) }}&title={{ urlencode($blog->title) }}&summary={{ urlencode($blog->description) }}"
                                        target="_blank">
                                        <i class="fa-brands fa-linkedin-in"></i>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </section>
    <section class="gap blog-recent-posts">
        <div class="container">
            @if ($relatedPosts->isNotEmpty())
                <h4 class="mb-5">Related Posts</h4>
                <div class="row">
                    @foreach ($relatedPosts as $relatedPost)
                        <div class="col-xl-3 col-lg-4 col-md-6">
                            <div class="latest-blog-post">
                                <img alt="img" class="w-100" src="{{ $relatedPost->image_path ?? '' }}">
                                <a href="#"><i
                                        class="fa-regular fa-clock"></i><span>{{ \Carbon\Carbon::parse($relatedPost->blog_date)->format('d F Y') }}
                                        | By
                                        {{ $blog->user->name ?? 'Admin' }}</span></a>
                                <a href="{{ route('blog.details', $relatedPost->slug) }}">
                                    <h4>{{ $relatedPost->title ?? '' }}</h4>
                                </a>
                                <span>
                                    {{ \Illuminate\Support\Str::words($relatedPost->short_description, 25, '...') ?? '' }}
                                </span>
                                <a href="{{ route('blog.details', $relatedPost->slug) }}" class="themebtu">Learn
                                    More</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
@endsection
