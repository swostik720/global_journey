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
<style>
    .blog-hero-image{
        width:100%;
        height:70vh;
        object-fit: cover;
        margin-top: 32px;
    }

    .sub_heading {
        display:flex;
        align-items:center;
        justify-content:space-between;
        gap: 12px;
        padding-block: 18px;
    }


    .sub_heading .icon_wrapper{
        display:flex; 
        gap: 14px;
    }

    .sub_heading .icon_wrapper > p{
        display:flex; 
        align-items:center;
        gap: 4px;
    }

    @media screen and (max-width: 600px){
        .sub_heading {
            flex-direction: column;
            align-items:start;
        }
    }
</style>
    <section>
        

        <div class="container">

        <img alt="img" class='blog-hero-image' src="{{ $blog->image_path ?? '' }}">


            <div class="sub_heading">
                <div class='icon_wrapper'>
                    <p><i class="fa-solid fa-user"></i><span>{{ $blog->user->name ?? 'Admin' }}</span> </p>
                    <p><i class="fa-solid fa-clock"></i><span>{{ \Carbon\Carbon::parse($blog->blog_date)->format('d F Y') }}</span></p>
                </div>

                <div>
                    <i class="fa-solid fa-tag"></i>
                    @foreach ($categories as $category)
                        <span>
                            {{ $category->name ?? '' }}
                            <span>({{ $category->blogs_count ?? '0' }})</span>
                            @if (!$loop->last), @endif
                        </span>
                    @endforeach
                </div>
            </div>
        <!-- <ul class="sidebar">
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
                    </ul> -->

        </div>
    </section>


    <section>
        <div class="container">

            <div class="row">
                <div class="col-xl-8">
                    <div class="blog-item">
                        <!-- <img alt="img" src="{{ $blog->image_path ?? '' }}"> -->
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
                    <div class="col-xl-4 col-md-6">
                            <!-- <div class="latest-blog-post">
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
                            </div> -->

                <figure class="snip1253" style='height:100%'>
                <div class="image"><img src="{{ $blog->image_path ?? '' }}" alt="sample52" /></div>
                <figcaption>
                    <div class="date">
                        <span class="day">{{ \Carbon\Carbon::parse($blog->blog_date)->format('d') }}</span>
                        <span class="month">{{ \Carbon\Carbon::parse($blog->blog_date)->format('M') }}</span>
                    </div>

                    <h3>{{ $blog->title ?? '' }}</h3>
                    <p>{{ \Illuminate\Support\Str::words($blog->short_description, 25, '...') ?? '' }}</p>

                    
                </figcaption>
                <a href="{{ route('blog.details', $blog->slug) }}"></a>
            </figure>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
@endsection
