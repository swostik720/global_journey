@extends('frontend.layouts.includes.master')
@section('maincontent')
<div class="container py-5">
    <div class="heading text-center mb-5 pt-5">
        <h6 class="text-primary">Guide for {{ $country->name }}</h6>
        <h2 class="fw-bold">Step-by-step guidance for students planning to study in {{ $country->name }}</h2>
        <img alt="line" src="{{ asset('frontend/assets/img/headingline.png') }}" class="mx-auto mt-3">
    </div>

    <div class="row g-4">
        @foreach($countryGuides as $guide)
            @foreach($guide->guides as $g)
                @php
                    $parts = explode(':', $g, 2);
                    $boldText = $parts[0];
                    $restText = $parts[1] ?? '';
                @endphp
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card guide-card shadow-sm rounded-4 h-100 p-4 text-center position-relative" style="border-radius: 20px;">
                        <div class="guide-icon">
                            <i class="fa fa-book-open text-primary"></i>
                        </div>
                        <div class="card-body">
                            <div class="fw-bold mb-2 text-primary">{{ $boldText }}:</div>
                            <p class="text-muted">{{ $restText }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        @endforeach
    </div>
</div>

<style>
.guide-card {
    transition: all 0.35s ease;
    cursor: pointer;
    background: #fff;
}
.guide-card:hover {
    transform: translateY(-8px) scale(1.03);
    box-shadow: 0 16px 40px rgba(0,0,0,0.15);
    background: linear-gradient(145deg, #e6f0ff, #ffffff);
}
.guide-icon {
    position: absolute; top: 15px; right: 15px; font-size: 2.2rem;
    transition: all 0.4s ease;
}
.guide-card:hover .guide-icon {
    transform: rotate(15deg) scale(1.3);
}
</style>
@endsection
