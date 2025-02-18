@extends('frontend.layouts.includes.master')
@section('maincontent')
    <section class="splash-area-section" style="background-image: url({{ asset('frontend/assets/img/background.jpg') }})">
        <div class="container">
            <div class="splash-area">
                <h2>Test Preparation
                </h2>
            </div>
        </div>
    </section>
    <section class="gap no-top">
        <div class="container">
            <div class="row">
                @foreach ($testpreparations as $testpreparation)
                    <div class="col-xl-4 col-md-6 mt-5">

                                <div class="_card">
                                    <a href="{{ route('test-preparation.details', $testpreparation->slug) }}">
                                        <img class="w-100" alt="{{ $testpreparation->title }}" src="{{ $testpreparation->image_path }}">
                                        <div class="_body">
                                            <h3><a href="{{ route('test-preparation.details', $testpreparation->slug) }}">{{ $testpreparation->title }}</a>
                                            <p class=''>{!! $testpreparation->short_description !!}</p>

                                            <a class="_button" href="{{ route('test-preparation.details', $testpreparation->slug) }}">Learn More</a>
                                        </div>
                                    </a>
                                </div>

            <!-- <figure class="snip1253" style='height:100%'>
                <div class="image"><img src="{{ $testpreparation->image_path ?? '' }}" alt="sample52" /></div>
                <figcaption>
                    <div class="date">
                        <span class="day">{{ \Carbon\Carbon::parse($testpreparation->blog_date)->format('d') }}</span>
                        <span class="month">{{ \Carbon\Carbon::parse($testpreparation->blog_date)->format('M') }}</span>
                    </div>

                    <h3>{{ $testpreparation->title ?? '' }}</h3>
                    <p>{{ \Illuminate\Support\Str::words($testpreparation->short_description, 25, '...') ?? '' }}</p>

                </figcaption>
                <a href="{{ route('blog.details', $testpreparation->slug) }}"></a>
            </figure> -->

                        <!-- <div class="latest-blog-post hoverstyle">
                            <figure>
                                <img alt="img" class="w-100" src="{{ $testpreparation->image_path ?? '' }}">
                            </figure>
                            <a href="{{ route('test-preparation.details', $testpreparation->slug) }}">
                                <h4>{{ $testpreparation->title ?? '' }}</h4>
                            </a>
                            <p>{!! $testpreparation->short_description ?? '' !!}</p>
                            <a href="{{ route('test-preparation.details', $testpreparation->slug) }}" class="themebtu">Learn
                                More</a>
                        </div> -->
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
