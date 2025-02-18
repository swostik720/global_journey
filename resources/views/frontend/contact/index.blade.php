@extends('frontend.layouts.includes.master')
@section('maincontent')
    <section class="splash-area-section" style="background-image: url({{ asset('frontend/assets/img/background.jpg') }})">
        <div class="container">
            <div class="splash-area">
                <h2>Let Us Know What
                    You're Looking For</h2>
                <a href="#">Get in Touch</a>
            </div>
        </div>
    </section>


    <section class="contact-page gap">
        <div class="container">
            <div class="heading">
                <h6>Start Your Project With Us.</h6>
                <h2>Let's Talk</h2>
                <img alt="line" src="{{ asset('frontend/assets/img/headingline.png') }}">
            </div>
            <div class="row">
                <div class="col-xl-6 col-lg-6">
                    @include('frontend.layouts.contact_form')
                </div>
                <div class="offset-lg-1 col-xl-5 col-lg-5">
                    <div class="_details">
                        <h4>Details</h4>

                        <li>
                            <a  href="tel:{{ $setting->phone ?? '+01-84856938' }}">
                                <i class="fa-solid fa-phone"></i>
                                <span>{{ $setting->phone ?? '+01-84856938' }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="tel:{{ $setting->mobile ?? '+977-9843215204' }}">
                                <i class="fa-solid fa-mobile"></i>
                                <span>{{ $setting->mobile ?? '+977-9843215204' }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="mailto:{{ $setting->email ?? 'contact@globaljourneyedu.com.np' }}">
                                <i class="fa-solid fa-envelope"></i>
                                <span>{{ $setting->email ?? 'contact@globaljourneyedu.com.np' }}</span>
                            </a>
                        </li>

                        <hr>

                        <div class="">
                            <h5>Social Links</h5>
                            <ul class="_brand_icons">
                            
                                    <li>
                                        <a href="{{ $setting->fb_link ?? '#' }}" target="_blank">
                                            <i class="fa-brands fa-facebook-f"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ $setting->twitter_link ?? '#' }}" target="_blank">
                                            <i class="fa-brands fa-twitter"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ $setting->instagram_link ?? '#' }}" target="_blank">
                                            <i class="fa-brands fa-instagram"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ $setting->linkedIn_link ?? '#' }}" target="_blank">
                                            <i class="fa-brands fa-linkedin-in"></i>
                                        </a>
                                    </li>
                            </ul>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </section>

    <style>
        ._details{ 
            background-color: #f2f2f2;
            padding: 18px 16px;
            border-radius: 14px;
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        ._details h4 {
            font-weight: 700;
        }

        ._details li a {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .branches_ .heading ul li,
        ._brand_icons {
            display: flex;
            align-items:center;
            gap: 6px;
        }

        .branches_ .heading .fa-solid,
        ._brand_icons li a .fa-brands,
        ._details .fa-solid {
            display: grid;
            place-content: center;
            width: 3rem;
            aspect-ratio: 1;
            background: #ffffff;
            border-radius: 100vh;
            
        }

        .branches_ {
            display: grid;
            place-content: center;        
        }

        .branches_ .heading {
            background: #f2f2f2;
            padding: 18px 32px;
            border-radius: 22px;
        }

        .branches_ .heading h2 {
            font-size: 26px;
        }
        

        .branches_ .heading ul {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

    </style>

    <section class="offices gap" style="background-color:#f3f8fb;">
        <div class="container">
            <div class="row">
                @foreach ($branches as $branch)
                    <div class="col-xl-6 branches_">
                        <div class="heading">
                            <h2>{{ $branch->name ?? '' }}</h2>
                            <ul>
                                <li><i class="fa-solid fa-envelope"></i> <span> {{ $branch->email ?? '' }}  </span></li>
                                <li><i class="fa-solid fa-location-dot"></i> <span> {{ $branch->contact_address ?? '' }}  </span></li>
                                <li><i class="fa-solid fa-phone"></i> <span> {{ $branch->phone ?? '' }}  </span></li>
                                <li><i class="fa-solid fa-clock"></i> <span> {{ $branch->working_hours ?? '' }} </span></li>
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="tp-hero__shapes">
            <div class="style-shapes-5">
                <img alt="dots1" src="{{ asset('frontend/assets/img/shap-2.png') }}">
            </div>
            <div class="style-shapes-6">
                <img alt="dots1" src="{{ asset('frontend/assets/img/shap-2.png') }}">
            </div>
            <div class="style-shapes-7">
                <img alt="dots1" src="{{ asset('frontend/assets/img/shap-5.png') }}">
            </div>
        </div>
    </section>

    <div class="map">
        <iframe src="{{ $setting->map_url ?? '' }}" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
@endsection
