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
                    <div class="col-xl-4 col-md-6">
                        <div class="latest-blog-post hoverstyle">
                            <figure>
                                <img alt="img" class="w-100" src="{{ $testpreparation->image_path ?? '' }}">
                            </figure>
                            <a href="{{ route('test-preparation.details', $testpreparation->slug) }}">
                                <h4>{{ $testpreparation->title ?? '' }}</h4>
                            </a>
                            <p>{!! $testpreparation->short_description ?? '' !!}</p>
                            <a href="{{ route('test-preparation.details', $testpreparation->slug) }}" class="themebtu">Learn
                                More</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
