@extends('frontend.layouts.includes.master')
@section('maincontent')
<div class="container py-5">
    <div class="heading mb-5 text-center pt-5">
        <h6 class="text-primary">Why Choose {{ $country->name }}?</h6>
        <h2 class="fw-bold">Top reasons to study in {{ $country->name }}</h2>
        <img alt="line" src="{{ asset('frontend/assets/img/headingline.png') }}" class="mx-auto mt-3" style="max-width:200px;">
    </div>

    <div class="row g-4">
        @foreach ($whyCountries as $why)
            @foreach ($why->description as $point)
                <div class="col-md-6 col-lg-4">
                    <div class="card reason-card shadow-sm rounded-4 h-100 text-center p-4 position-relative" style="border-radius: 20px;">
                        <div class="reason-icon mb-3">
                            <i class="fa fa-check-circle text-success" style="font-size:3rem;"></i>
                        </div>
                        <p class="card-text fs-5 fw-semibold text-dark">{{ $point }}</p>
                    </div>
                </div>
            @endforeach
        @endforeach
    </div>
</div>

<style>
.reason-card {
    transition: all 0.35s ease;
    cursor: pointer;
    background: #fff;
}
.reason-card:hover {
    transform: translateY(-8px) scale(1.03);
    box-shadow: 0 18px 45px rgba(0,0,0,0.15);
    background: linear-gradient(135deg, #e8f7f0, #ffffff);
}
.reason-icon {
    transition: all 0.35s ease;
}
.reason-card:hover .reason-icon {
    transform: scale(1.3) rotate(10deg);
}
</style>
@endsection
