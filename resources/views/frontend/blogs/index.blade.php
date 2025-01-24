@extends('frontend.layouts.includes.master')
@section('maincontent')
    <section class="splash-area-section" style="background-image: url({{ asset('frontend/assets/img/background.jpg') }})">
        <div class="container">
            <div class="splash-area">
                <h2>Our Blogs
                </h2>
            </div>
        </div>
    </section>
    <section class="gap no-top">
        <div class="container">
            <div class="row">
                @foreach ($blogs as $blog)
                    <div class="col-xl-4 col-md-6">
                        <div class="latest-blog-post hoverstyle">
                            <figure>
                                <img alt="img" class="w-100" src="{{ $blog->image_path ?? '' }}">
                            </figure>
                            <a href="#">
                                <i class="fa-regular fa-clock"></i>
                                <span>
                                    {{ \Carbon\Carbon::parse($blog->blog_date)->format('d F Y') }} | By
                                    {{ $blog->user->name ?? 'Admin' }}
                                </span>
                            </a>
                            <a href="{{ route('blog.details', $blog->slug) }}">
                                <h4>{{ $blog->title ?? '' }}</h4>
                            </a>
                            <span>
                                {{ \Illuminate\Support\Str::words($blog->short_description, 25, '...') ?? '' }}
                            </span>
                            <a href="{{ route('blog.details', $blog->slug) }}" class="themebtu">Learn
                                More</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <div class="next-previous-page">
        <div class="container">
            <div class="next-previous">
                @if ($blogs->onFirstPage())
                    <div class="prev disabled">
                        <a href="javascript:void(0);">
                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                viewBox="0 0 476.213 476.213" xml:space="preserve">
                                <polygon
                                    points="405.606,167.5 384.394,188.713 418.787,223.106 0,223.106 0,253.106 418.787,253.106 384.394,287.5 405.606,308.713 476.213,238.106" />
                            </svg>
                            prev page
                        </a>
                    </div>
                @else
                    <div class="prev">
                        <a href="{{ $blogs->previousPageUrl() }}">
                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                viewBox="0 0 476.213 476.213" xml:space="preserve">
                                <polygon
                                    points="405.606,167.5 384.394,188.713 418.787,223.106 0,223.106 0,253.106 418.787,253.106 384.394,287.5 405.606,308.713 476.213,238.106" />
                            </svg>
                            prev page
                        </a>
                    </div>
                @endif

                @if ($blogs->hasMorePages())
                    <div class="next">
                        <a href="{{ $blogs->nextPageUrl() }}">
                            next page
                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                viewBox="0 0 476.213 476.213" xml:space="preserve">
                                <polygon
                                    points="405.606,167.5 384.394,188.713 418.787,223.106 0,223.106 0,253.106 418.787,253.106 384.394,287.5 405.606,308.713 476.213,238.106" />
                            </svg>
                        </a>
                    </div>
                @else
                    <div class="next disabled">
                        <a href="javascript:void(0);">
                            next page
                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                viewBox="0 0 476.213 476.213" xml:space="preserve">
                                <polygon
                                    points="405.606,167.5 384.394,188.713 418.787,223.106 0,223.106 0,253.106 418.787,253.106 384.394,287.5 405.606,308.713 476.213,238.106" />
                            </svg>
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
