@extends('frontend.layouts.includes.master')
@section('meta_title', ('Country Guide for ' . ($country->name ?? 'Your Destination')) . ' | ' . ($setting->name ?? config('app.name')))
@section('meta_description', 'Get a step-by-step country guide for admissions, planning, and student transition to your chosen study destination.')
@section('maincontent')
@include('frontend.layouts.includes.page_hero', [
    'eyebrow' => 'Country Guide',
    'title' => 'Guide for ',
    'accent' => $country->name,
    'subtitle' => 'A simplified step-by-step overview for students planning their move, application, and transition into ' . $country->name . '.',
    'meta' => ['Student Planning', 'Country Overview', 'Practical Guidance'],
])

<section class="gj-page-shell gj-page-shell--blue">
<div class="container">
    <div data-aos="fade-up" data-aos-delay="100" class="gj-section-header">
        <span class="gj-section-header__eyebrow">Guide for {{ $country->name }}</span>
        <h2 class="fw-bold">Step-by-step guidance for students planning to study in {{ $country->name }}</h2>
        <p>Each point below helps you understand what to expect and how to plan with fewer surprises.</p>
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
                    <div data-aos="zoom-in-up" data-aos-delay="140" class="card guide-card gj-grid-card shadow-sm rounded-4 h-100 p-4 text-center position-relative" style="border-radius: 20px;">
                        <div class="guide-icon gj-grid-card__icon">
                            <i class="bi bi-book-half"></i>
                        </div>
                        <div data-aos="zoom-in-up" data-aos-delay="140" class="card-body">
                            <div class="fw-bold mb-2 text-primary">{{ $boldText }}:</div>
                            <p class="text-muted">{{ $restText }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        @endforeach
    </div>
</div>
</section>

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
