@extends('frontend.layouts.includes.master')
@section('meta_title', ('Colleges & Universities in ' . ($country->name ?? 'Your Destination')) . ' | ' . ($setting->name ?? config('app.name')))
@section('meta_description', 'Explore colleges and universities, compare institutions, and shortlist the right campus options for your study abroad plan.')
@section('maincontent')
    @include('frontend.layouts.includes.page_hero', [
        'eyebrow' => 'Colleges & Universities',
        'title' => 'Colleges in ',
        'accent' => $country->name,
        'subtitle' =>
            'Review institutions, compare options, and shortlist campuses that match your academic goals and future plans.',
        'meta' => ['Institution Discovery', 'Campus Shortlisting', 'Study Abroad Fit'],
    ])

    <section class="gj-page-shell gj-page-shell--white">
        <div class="container">
            <div data-aos="fade-up" data-aos-delay="100" class="gj-section-header">
                <span class="gj-section-header__eyebrow">Explore institutions</span>
                <h2 class="fw-bold">Colleges & Universities of {{ $country->name }}</h2>
                <p>Use this list to compare institutions, learning environments, and the campuses most relevant to your
                    goals.</p>
            </div>

            <div class="row g-4">
                @forelse($colleges as $college)
                    <div class="col-12 col-md-6 col-lg-4">
                        <div data-aos="zoom-in-up" data-aos-delay="140"
                            class="card college-card gj-grid-card h-100 position-relative text-center p-3 shadow-sm rounded-4"
                            style="border-radius: 20px;">
                            <div class="icon-circle">
                                <i class="bi bi-bank2"></i>
                            </div>
                            <div class="overflow-hidden rounded mb-3">
                                <img src="{{ $college->image_path ?? asset('frontend/assets/img/default.jpg') }}"
                                    alt="{{ $college->name }}" class="img-fluid hover-zoom"
                                    style="height:160px; object-fit:cover;">
                            </div>
                            <h5 class="fw-bold mb-2">{{ $college->name }}</h5>
                            <p class="mb-2"><strong>Country:</strong> {{ $college->country->name ?? 'N/A' }}</p>
                            <p class="mb-3 text-muted description-ellipsis">{!! $college->description ?? 'No description available.' !!}</p>
                            @if (!empty($college->link))
                                <a href="{{ $college->link }}" target="_blank"
                                    class="themebtu w-100 mt-auto d-flex justify-content-center align-items-center">
                                    Visit Website
                                </a>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p class="text-muted">No colleges found for this country.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <style>
        .college-card {
            transition: transform 0.35s ease, box-shadow 0.35s ease, background 0.35s ease;
            cursor: pointer;
            background: #fff;
        }

        .college-card:hover {
            transform: translateY(-10px) scale(1.04);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
            background: linear-gradient(145deg, #f0f7ff, #ffffff);
        }

        .icon-circle {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            position: absolute;
            top: -25px;
            left: 50%;
            transform: translateX(-50%);
            color: #fff;
            font-size: 1.5rem;
            transition: transform 0.3s ease;
        }

        .college-card:hover .icon-circle {
            transform: translateX(-50%) rotate(15deg) scale(1.2);
        }

        .hover-zoom {
            transition: transform 0.4s ease;
        }

        .hover-zoom:hover {
            transform: scale(1.05);
        }

        .description-ellipsis {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        @media (max-width: 575.98px) {
            .college-card:hover {
                transform: translateY(-5px) scale(1.01);
            }
        }

        @media (hover: none) {
            .college-card:hover {
                transform: none;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
                background: #fff;
            }

            .college-card:hover .icon-circle {
                transform: translateX(-50%);
            }
        }
    </style>
@endsection

