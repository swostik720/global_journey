@extends('frontend.layouts.includes.master')
@section('maincontent')
    <section class="splash-area-section" style="background-image: url({{ asset('frontend/assets/img/background.jpg') }})">
        <div class="container">
            <div class="splash-area">
                <h2>{{ $testpreparation->title ?? '' }}</h2>
                <p class="mt-3"><a href="{{ url('/') }}">Home</a> / <a href="{{ route('test-preparation') }}">Test
                        Preparation</a> / <a href="#">IELTS</a></p>
            </div>
        </div>
    </section>
    <section>
        <div class="container mt-5 mb-5">
            <div class="row">
                <div class="col-xl-8">
                    <div class="blog-item hoverstyle">
                        <figure>
                            <img alt="img" class="w-100" src="{{ $testpreparation->image_path ?? '' }}">
                        </figure>
                        <p>{!! $testpreparation->description ?? '' !!}</p>
                    </div>
                </div>

                <div class="col-xl-4 pl-60">
                    <div class="heading">
                        <h6>Start Abroad Journey Starts here.</h6>
                        <h2>Let's Talk</h2>
                        <img alt="line" src="{{ asset('frontend/assets/img/headingline.png') }}">
                    </div>

                    @include('frontend.layouts.contact_form')

                </div>
            </div>
    </section>
@endsection
