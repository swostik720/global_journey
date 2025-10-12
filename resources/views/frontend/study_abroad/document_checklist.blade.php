@extends('frontend.layouts.includes.master')
@section('maincontent')
<div class="container py-5">
    <div class="heading mb-5 text-center pt-5">
        <h6 class="text-primary">Document Checklist for {{ $country->name ?? 'Country' }}</h6>
        <h2>Documents Required for Studying in {{ $country->name ?? 'Country' }}</h2>
        <img alt="line" src="{{ asset('frontend/assets/img/headingline.png') }}" class="mx-auto mt-3" style="max-width:200px;">
    </div>

    @if($checklist && $checklist->documents)
        <div class="row g-4">
            @foreach($checklist->documents as $doc)
                <div class="col-md-6 col-lg-4">
                    <div class="card checklist-card shadow-lg rounded-4 h-100 p-4 text-center position-relative" style="border-radius: 20px;">
                        <div class="checklist-icon mb-3">
                            <i class="fa fa-file text-primary" style="font-size:3rem;"></i>
                        </div>
                        <p class="fw-semibold fs-5 text-dark">{{ $doc }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-warning text-center mt-4">
            <i class="bx bx-info-circle"></i> No checklist available for this country.
        </div>
    @endif
</div>

<style>
.checklist-card {
    transition: all 0.35s ease;
    cursor: pointer;
    background: #fff;
}
.checklist-card:hover {
    transform: translateY(-8px) scale(1.03);
    box-shadow: 0 16px 45px rgba(0,0,0,0.15);
    background: linear-gradient(145deg, #eaf7ff, #ffffff);
}
.checklist-icon {
    transition: all 0.4s ease;
}
.checklist-card:hover .checklist-icon {
    transform: rotate(-15deg) scale(1.3);
}
</style>
@endsection
