<section data-aos="fade-up" class="latest-blog gap">
    <div class="container">
        <div data-aos="fade-up" data-aos-delay="100" class="heading">
            <h6>our blog</h6>
            <h2>News and Thoughts</h2>
            <img alt="line" src="{{ asset('frontend/assets/img/headingline.png') }}">
        </div>

        <div class="grid-wrapper">
            @foreach ($blogs->take(3) as $blog) <!-- Only display the first 3 blogs -->
            <figure data-aos="zoom-in" data-aos-delay="130" class="snip1253">
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
            @endforeach
        </div>

        @if ($blogs->count() > 2) <!-- Conditionally show the button if there are more than 3 blogs -->
        <div class="view-more" style='width:fit-content; margin-inline:auto; margin-top: 32px'>
            <a href="{{ route('blogs') }}" class="btn">
                <button type="submit" class="themebtu full">View More</button>
            </a>
        </div>
        @endif
    </div>
</section>


<style>
    .grid-wrapper {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
        gap:16px;
    }
</style>


<!--         <div class="swiper-container latestswiper">
            <div class="swiper-wrapper">
                @foreach ($blogs as $blog)
                    <div class="swiper-slide">

                    </div>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
        </div> -->

                        <!-- <div class="latest-blog-post">
                            <img alt="img" class="w-100" src="{{ $blog->image_path ?? '' }}">
                            <a href="#"><i class="fa-regular fa-clock"></i>
                                <span>
                                    {{-- {{ \Carbon\Carbon::parse($blog->blog_date)->format('d F Y') }} | By --}}
                                    {{ $blog->user->name ?? 'Admin' }}
                                </span>
                            </a>
                            {{-- <a href="{{ route('blog.details', $blog->slug) }}"> --}}
                                <h4>{{ $blog->title ?? '' }}</h4>
                            </a>
                            <span>
                                {{-- {{ \Illuminate\Support\Str::words($blog->short_description, 25, '...') ?? '' }} --}}
                            </span>
                            {{-- <a href="{{ route('blog.details', $blog->slug) }}" class="themebtu">Learn --}}
                                More</a>
                        </div>    -->
