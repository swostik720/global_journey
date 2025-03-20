@extends('frontend.layouts.includes.master')
@section('maincontent')
<section class="splash-area-section" style="background-image: url({{ asset('frontend/assets/img/background.jpg') }})">
    <div class="container">
        <div class="splash-area">
            <h2>Study in Your Dream
                Country
            </h2>
        </div>
    </div>
</section>
<section class="gap no-bottom">
    <div class="container">
        <div class="row">
            <div class="portfolios">
                <!-- <div class="filters portfolio-controllers-container">

                        <div class="portfolio-controllers wow fadeLeft button-group js-radio-button-group"
                            data-wow-duration="1s" data-wow-delay=".1s" data-filter-group="color">
                            <button type="button" class="button is-checked filter-btn active-work"
                                data-filter="*">All</button>
                            @foreach ($countries as $country)
                                <button type="button" class="filter-btn" data-filter=".{{ Str::slug($country->name) }}">
                                    {{ $country->name }}
                                </button>
                            @endforeach
                        </div>
                    </div> -->

                <div class="grid_container mb-5">
                    @foreach ($studyabroads as $studyabroad)
                    <div class="_card">
                        <a href="{{ route('study-abroad.details', $studyabroad->slug) }}">
                            <img class="w-100" alt="{{ $studyabroad->title }}" src="{{ $studyabroad->image_path }}">
                            <div class="_body">
                                <h3><a href="{{ route('study-abroad.details', $studyabroad->slug) }}">{{ $studyabroad->title }}</a>
                                    <p class=''>{!! $studyabroad->short_description !!}</p>

                                    <a class="_button" href="{{ route('study-abroad.details', $studyabroad->slug) }}">Learn More</a>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
            <!-- <div class="grid row align-items-center"></div> -->
        </div>
    </div>
</section>
<script src="https://unpkg.com/isotope-layout@3.0.6/dist/isotope.pkgd.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var iso = new Isotope('.grid', {
            itemSelector: '.col-lg-4',
            layoutMode: 'fitRows'
        });

        var filterButtons = document.querySelectorAll('.filter-btn');
        filterButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var filterValue = this.getAttribute('data-filter');
                iso.arrange({
                    filter: filterValue
                });
                filterButtons.forEach(function(btn) {
                    btn.classList.remove('is-checked');
                });
                this.classList.add('is-checked');
            });
        });
    });
</script>
@endsection