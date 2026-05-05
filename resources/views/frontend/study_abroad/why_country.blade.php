@extends('frontend.layouts.includes.master')
@section('meta_title', ('Why Study in ' . ($country->name ?? 'This Country')) . ' | ' . ($setting->name ?? config('app.name')))
@section('meta_description', 'Discover the top academic, lifestyle, and career reasons to choose this country for your international education journey.')
@section('maincontent')
@include('frontend.layouts.includes.page_hero', [
    'eyebrow' => 'Why This Destination',
    'title' => 'Why Study in ',
    'accent' => $country->name,
    'subtitle' => 'See the strongest academic, lifestyle, and career reasons students choose ' . $country->name . ' as their study destination.',
    'meta' => ['Career Potential', 'Student Lifestyle', 'Academic Value'],
])

<section class="gj-page-shell gj-page-shell--blue">
<div class="container">
    <div data-aos="fade-up" data-aos-delay="100" class="gj-section-header">
        <span class="gj-section-header__eyebrow">Why Choose {{ $country->name }}?</span>
        <h2 class="fw-bold">Top reasons to study in {{ $country->name }}</h2>
        <p>A quick view of the advantages that make this destination attractive for international students.</p>
    </div>

    <div class="row g-4">
        @foreach ($whyCountries as $why)
            @foreach ($why->description as $point)
                <div class="col-md-6 col-lg-4">
                    <div data-aos="zoom-in-up" data-aos-delay="140" class="card reason-card gj-grid-card shadow-sm rounded-4 h-100 text-center p-4 position-relative" style="border-radius: 20px;">
                        <div class="reason-icon mb-3">
                            <i class="bi bi-check-circle-fill text-success" style="font-size:3rem;"></i>
                        </div>
                        <p class="card-text fs-5 fw-semibold text-dark">{{ $point }}</p>
                    </div>
                </div>
            @endforeach
        @endforeach
    </div>
</div>
</section>

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

@media (hover: none) {
    .reason-card:hover {
        transform: none;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        background: #fff;
    }

    .reason-card:hover .reason-icon {
        transform: none;
    }
}
</style>
@endsection

