@extends('frontend.layouts.includes.master')
@section('maincontent')
    <section class="splash-area-section" style="background-image: url({{ asset('frontend/assets/img/background.jpg') }});">
        <div class="container">
            <div class="splash-area">
                <h2 class="splash-title">{{ $testpreparation->title ?? '' }}</h2>
                <h2 class="splash-title gradient-text">Preparation</h2>
            </div>
        </div>

        <style>
            /* Keep font size fixed at 70px */
            .splash-title {
                font-size: 70px;
                padding-left: 50px;
                line-height: 1.1;
                margin: 0;
                white-space: nowrap;
                /* prevent wrapping */
            }

            .gradient-text {
                background: linear-gradient(90deg, #0026cc, #001a80, #000d40);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
            }

            /* Responsive container padding to avoid cutting text */
            .splash-area-section .container {
                max-width: 100%;
                padding: 0 15px;
            }

            /* Optional: slightly scale text on very small screens */
            @media (max-width: 400px) {
                .splash-title {
                    font-size: 70px;
                    padding-left: 10px;
                }
            }
        </style>
    </section>
    <!-- Main Section -->
    <section class="py-5">
        <div class="container">
            <div class="row g-5">
                <!-- Left Content -->
                <div class="col-xl-8">
                    <div class="blog-item">
                        <!-- Featured Image -->
                        <figure class="shadow-sm rounded-4 mb-4 image-hover">
                            <img alt="img" class="w-100 rounded-4" src="{{ $testpreparation->image_path ?? '' }}">
                        </figure>

                        <!-- Description Card -->
                        <div class="content-card shadow-sm rounded-4 p-4 bg-white hover-up">
                            <p class="text-muted">{!! $testpreparation->description ?? '' !!}</p>
                        </div>
                    </div>
                </div>

                <!-- Right Sidebar -->
                <div class="col-xl-4">
                    <!-- Enroll Now -->
                    <div class="sidebar-card bg-white rounded-4 p-4 shadow-sm">
                        <div class="heading">
                            <h6 class="text-primary">Study in our {{ $testpreparation->title }} class.</h6>
                            <h2 class="fw-bold">Enroll Now!</h2>
                            <img alt="line" src="{{ asset('frontend/assets/img/headingline.png') }}" class="mb-3">
                        </div>

                        @include('frontend.layouts.enrollNow_form', [
                            'default_title' => $testpreparation->title ?? null,
                            'testPreparationsOptions' => [1 => 'IELTS', 2 => 'PTE'],
                        ])
                    </div>

                    <!-- Course Card -->
                    <div class="course-card mt-5 shadow-sm hover-up">
                        @if ($testpreparation->slug === 'ielts')
                            <h5 class="text-center text-primary mb-3">IELTS Course</h5>
                            <ul class="list-unstyled mb-4">
                                <li>✔ Complete Classes – 6 weeks</li>
                                <li>✔ Free Practice Materials</li>
                                <li>✔ Full Teaching Support</li>
                            </ul>
                            <a href="#" class="themebtu w-100 text-center">BOOK NOW</a>
                        @elseif($testpreparation->slug === 'pte')
                            <h5 class="text-center text-primary mb-3">PTE Course</h5>
                            <ul class="list-unstyled mb-4">
                                <li>✔ Complete Classes – 6 weeks</li>
                                <li>✔ Free Practice Materials</li>
                                <li>✔ Full Teaching Support</li>
                            </ul>
                            <a href="#" class="themebtu w-100 text-center">BOOK NOW</a>
                        @endif
                    </div>

                    <!-- Explore More -->
                    <div class="explore-card mt-5">
                        @if ($testpreparation->slug === 'ielts')
                            <div class="explore-header">
                                <i class="fa-solid fa-graduation-cap"></i>
                                <div>
                                    <h6>Curious about</h6>
                                    <h2>IELTS</h2>
                                </div>
                            </div>
                            <p class="explore-text">
                                Learn more about IELTS official guidelines, formats, and updates directly from the source.
                            </p>
                            <a href="https://ielts.org/" target="_blank" class="themebtu">
                                Visit Official Website <i class="fa-solid fa-arrow-up-right-from-square ms-2"></i>
                            </a>
                        @endif

                        @if ($testpreparation->slug === 'pte')
                            <div class="explore-header">
                                <i class="fa-solid fa-book-open"></i>
                                <div>
                                    <h6>Curious about</h6>
                                    <h2>PTE</h2>
                                </div>
                            </div>
                            <p class="explore-text">
                                Get all the details about Pearson PTE, test requirements, and official preparation
                                materials.
                            </p>
                            <a href="https://pearsonpte.com/" target="_blank" class="themebtu">
                                Visit Official Website <i class="fa-solid fa-arrow-up-right-from-square ms-2"></i>
                            </a>
                        @endif
                    </div>

                </div>
            </div>

            <!-- Back Button -->
            <div class="mt-5">
                <a href="{{ route('test-preparation') }}" class="themebtu">
                    <i class="fa fa-arrow-left"></i> Back
                </a>
            </div>
        </div>
    </section>
@endsection

@push('custom_css')
    <style>
        /* ===== Image Hover ===== */
        .image-hover img {
            transition: all 0.4s ease;
        }

        .image-hover:hover img {
            transform: scale(1.05);
            filter: brightness(1.1);
        }

        /* ===== Hover Effects for Cards ===== */
        .hover-up {
            transition: all 0.35s ease;
        }

        .hover-up:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 32px rgba(0, 0, 0, 0.15) !important;
        }

        /* ===== Enroll Form Card Hover ===== */
        .sidebar-card {
            transition: transform .35s cubic-bezier(.2, .9, .2, 1),
                box-shadow .35s ease,
                border-color .35s ease,
                background .35s ease;
            border: 1px solid transparent;
            will-change: transform, box-shadow;
        }

        .sidebar-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 22px 46px rgba(102, 102, 255, 0.12);
            border-color: rgba(102, 102, 255, 0.10);
            background: linear-gradient(180deg, #ffffff, #fbfbff);
        }

        .sidebar-card:hover .themebtu {
            transform: translateY(-2px);
            box-shadow: 0 10px 28px rgba(102, 102, 255, 0.12);
        }

        .sidebar-card:hover input:focus,
        .sidebar-card:hover textarea:focus,
        .sidebar-card:hover select:focus {
            box-shadow: 0 6px 18px rgba(102, 102, 255, 0.08);
        }

        /* ===== Explore More Card Hover ===== */
        .sidebar-card.hover-border {
            border: 1px solid #eee;
        }

        .sidebar-card.hover-border:hover {
            transform: translateY(-6px);
            box-shadow: 0 14px 36px rgba(108, 99, 255, 0.12);
            border-color: #6c63ff;
            background: linear-gradient(135deg, rgba(108, 99, 255, 0.03), #ffffff);
        }

        .sidebar-card.hover-border:hover .heading h6,
        .sidebar-card.hover-border:hover .heading h2 {
            color: #4b46e6;
        }

        .sidebar-card.hover-border:hover .themebtu {
            background: linear-gradient(135deg, #764ba2, #667eea);
            transform: scale(1.02);
            box-shadow: 0 12px 30px rgba(102, 102, 255, 0.12);
        }

        .sidebar-card a,
        .sidebar-card .themebtu {
            cursor: pointer;
        }

        /* ===== Course Card ===== */
        .course-card {
            border: 1px solid #ddd;
            padding: 25px;
            border-radius: 16px;
            background: linear-gradient(135deg, #fdfdfd, #f9f9ff);
            transition: all 0.35s ease;
        }

        .course-card h5 {
            font-size: 20px;
            font-weight: 700;
        }

        .course-card ul li {
            font-size: 15px;
            margin-bottom: 10px;
            color: #555;
        }

        /* Explore Card */
        .explore-card {
            border-radius: 14px;
            background: #fff;
            padding: 25px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid #eee;
            transition: all 0.35s ease;
            position: relative;
            overflow: hidden;
        }

        .explore-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 32px rgba(108, 99, 255, 0.15);
            border-color: #6c63ff;
        }

        /* Gradient Header */
        .explore-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 15px;
        }

        .explore-header i {
            font-size: 40px;
            color: #6c63ff;
            background: rgba(108, 99, 255, 0.1);
            padding: 14px;
            border-radius: 50%;
        }

        .explore-header h6 {
            font-size: 14px;
            color: #777;
            margin-bottom: 3px;
        }

        .explore-header h2 {
            font-size: 22px;
            font-weight: 700;
            color: #222;
        }

        /* Text */
        .explore-text {
            font-size: 15px;
            color: #555;
            margin-bottom: 18px;
            line-height: 1.5;
        }
    </style>
@endpush
