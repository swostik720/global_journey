<section class="latest-blog gap">
    <div class="container">
        <div class="heading">
            <h6>our blog</h6>
            <h2>News and Thoughts</h2>
            <img alt="line" src="{{ asset('frontend/assets/img/headingline.png') }}">
        </div>
        <div class="swiper-container latestswiper">
            <div class="swiper-wrapper">
                @foreach ($blogs as $blog)
                    <div class="swiper-slide">
                        <div class="latest-blog-post">
                            <img alt="img" class="w-100" src="{{ $blog->image_path ?? '' }}">
                            <a href="#"><i class="fa-regular fa-clock"></i>
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
            <div class="swiper-pagination"></div>
        </div>
    </div>
</section>
