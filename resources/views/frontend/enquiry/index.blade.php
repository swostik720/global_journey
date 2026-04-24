@extends('frontend.layouts.includes.master')
@section('maincontent')
    <section data-aos="fade-up" class="splash-area-section" style="background-image: url({{ asset('frontend/assets/img/background.jpg') }})">
        <div class="container">
            <div class="splash-area">
                <h2>Let Us Know What
                    You're Looking For</h2>
                <a href="#">Get in Touch</a>
            </div>
        </div>
    </section>
    <section data-aos="fade-up" class="contact-page gap">
        <div class="container">
            <div data-aos="fade-up" data-aos-delay="100" class="heading">
                <h6>Start Your Project With Us.</h6>
                <h2>Let's Talk</h2>
                <img alt="line" src="{{ asset('frontend/assets/img/headingline.png') }}">
            </div>
            <div class="row">
                <div class="col-xl-6 col-lg-6">
                    @include('frontend.layouts.enquiry_form')
                </div>
                <div class="offset-lg-1 col-xl-5 col-lg-5">
                    <ul class="sidebar">
                        <li>
                            <h4>Address : </h4>
                            <span>{{ $setting->contact_address ?? 'Putalisadak Kathmandu Nepal' }}</span>
                        </li>
                        <li>
                            <h4>Phone :</h4>
                            <a
                                href="tel:{{ $setting->phone ?? '+01-84856938' }}"><span>{{ $setting->phone ?? '+01-84856938' }}</span></a>
                        </li>
                        <li>
                            <h4>Mobile :</h4>
                            <a
                                href="tel:{{ $setting->mobile ?? '+977-9843215204' }}"><span>{{ $setting->mobile ?? '+977-9843215204' }}</span></a>
                        </li>
                        <li>
                            <h4>Email :</h4>
                            <a
                                href="mailto:{{ $setting->email ?? 'contact@globaljourneyedu.com.np' }}"><span>{{ $setting->email ?? 'contact@globaljourneyedu.com.np' }}</span></a>
                        </li>
                        <li>
                            <h4>Find us :</h4>
                            <ul class="brandicon">
                                <li>
                                    <a href="{{ $setting->fb_link ?? '#' }}" target="_blank"><i
                                            class="fa-brands fa-facebook-f"></i></a>
                                </li>
                                <li>
                                    <a href="{{ $setting->twitter_link ?? '#' }}" target="_blank"><i
                                            class="fa-brands fa-twitter"></i></a>
                                </li>
                                <li>
                                    <a href="{{ $setting->instagram_link ?? '#' }}" target="_blank"><i
                                            class="fa-brands fa-instagram"></i></a>
                                </li>
                                <li>
                                    <a href="{{ $setting->linkedIn_link ?? '#' }}" target="_blank"><i
                                            class="fa-brands fa-linkedin-in"></i></a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <div class="map">
        <iframe src="{{ $setting->map_url ?? '' }}" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
    <section data-aos="fade-up" class="offices gap" style="background-color:#f3f8fb;">
        <div class="container">
            <div class="row">
                @foreach ($branches as $branch)
                    <div class="col-xl-6">
                        <div data-aos="fade-up" data-aos-delay="100" class="heading">
                            <h2>{{ $branch->name ?? '' }}</h2>
                            <p>Email: {{ $branch->email ?? '' }} <br />
                                Address: {{ $branch->contact_address ?? '' }} <br />
                                Phone: {{ $branch->phone ?? '' }} <br />
                                Working Hours: {{ $branch->working_hours ?? '' }}</p>
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
@endsection
