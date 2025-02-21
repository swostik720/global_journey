<div class="_header">
    <div class="container">
        <section class="desktop_header">
            <div class="_logo">
                    @if (is_object($setting) && isset($setting['logo']))
                        <a href="{{ url('/') }}">
                            <img src="{{ asset('uploaded-images/site-setting-images/' . $setting->logo) }}"
                                width="250">
                        </a>
                    @else
                        <a href="{{ url('/') }}">
                            <img alt="logo" class=""
                                src="{{ asset('frontend/global-journey/assets/img/logo.png') }}" width="250">
                        </a>
                    @endif
            </div>
            <ul class="header_menu">
                <li class='header_item'>
                    <a href="{{ url('/') }}">Home</a>
                </li>
                <li class='header_item'>
                    <a href="{{ route('about-us') }}">About Us</a>
                </li>
                <li class='header_item'>
                    <a href="{{ route('study-abroad') }}">Study Abroad</a>
                    <i class="fa-solid fa-angle-down"></i>
                    <ul class="header_submenu">
                        @foreach ($studyabroads as $studyabroad)
                            <li><a
                                    href="{{ route('study-abroad.details', $studyabroad->slug) }}">{{ $studyabroad->title }}</a>
                            </li>
                        @endforeach
                    </ul>
                </li>
                <li class='header_item'>
                    <a href="{{ route('test-preparation') }}">Test Preparation</a>
                    <i class="fa-solid fa-angle-down"></i>
                    <ul class="header_submenu">
                        @foreach ($testpreparations as $testpreparation)
                            <li>
                                <a href="{{ route('test-preparation.details', $testpreparation->slug) }}">
                                    {{ $testpreparation->title }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
                <li class='header_item'>
                    <a href="{{ route('contact-us') }}">Contact Us</a>
                </li>
            </ul>
        </section>

        <section class="desktop_mobile">
            <div class="_logo">
                    @if (is_object($setting) && isset($setting['logo']))
                        <a href="{{ url('/') }}">
                            <img src="{{ asset('uploaded-images/site-setting-images/' . $setting->logo) }}"
                                width="250">
                        </a>
                    @else
                        <a href="{{ url('/') }}">
                            <img alt="logo" class=""
                                src="{{ asset('frontend/global-journey/assets/img/logo.png') }}" width="250">
                        </a>
                    @endif
            </div>

            <div class="_btn" id='open_main_btn'>
                <i class="fa-solid fa-bars"></i>
            </div>
        </section>
    </div>

    
</div>
<section id='mobile_open_main' class='mobile_open_main'>
        <div class="container">
            <div class="close_row">
                <div class="_logo">
                        @if (is_object($setting) && isset($setting['logo']))
                            <a href="{{ url('/') }}">
                                <img src="{{ asset('uploaded-images/site-setting-images/' . $setting->logo) }}"
                                    width="250">
                            </a>
                        @else
                            <a href="{{ url('/') }}">
                                <img alt="logo" class=""
                                    src="{{ asset('frontend/global-journey/assets/img/logo.png') }}" width="250">
                            </a>
                        @endif
                </div>

                <i id='close_main_btn' class="fa-solid fa-xmark"></i>
            </div>


            <ul class="header_menu">
                <li class='header_item'>
                    <a href="{{ url('/') }}">Home</a>
                </li>
                <li class='header_item'>
                    <a href="{{ route('about-us') }}">About Us</a>
                </li>
                <li class='header_item'>
                    <p>
                        <a href="{{ route('study-abroad') }}">Study Abroad</a>
                        <i class="fa-solid fa-angle-down"></i>
                    </p>

                    <ul class="header_submenu">
                        @foreach ($studyabroads as $studyabroad)
                            <li><a
                                    href="{{ route('study-abroad.details', $studyabroad->slug) }}">{{ $studyabroad->title }}</a>
                            </li>
                        @endforeach
                    </ul>
                </li>
                <li class='header_item'>
                    <p>
                        <a href="{{ route('test-preparation') }}">Test Preparation</a>
                        <i class="fa-solid fa-angle-down"></i>
                    </p>

                    <ul class="header_submenu">
                        @foreach ($testpreparations as $testpreparation)
                            <li>
                                <a href="{{ route('test-preparation.details', $testpreparation->slug) }}">
                                    {{ $testpreparation->title }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
                <li class='header_item'>
                    <a href="{{ route('contact-us') }}">Contact Us</a>
                </li>
            </ul>
        </div>
    </section>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const openMenuButton = document.getElementById('open_main_btn');
    const closeMenuButton = document.getElementById('close_main_btn');
    const mobileMenu = document.getElementById('mobile_open_main');

    // Open menu
    openMenuButton.addEventListener('click', function () {
        mobileMenu.style.display = 'block';
    });

    // Close menu
    closeMenuButton.addEventListener('click', function () {
        mobileMenu.style.display = 'none';
    });
});

</script>

<!-- <header>
    <div class="container">
        <div class="nav">
            <div class="d-flex align-items-center justify-content-between w-100">
                <div class="logo">
                    @if (is_object($setting) && isset($setting['logo']))
                        <a href="{{ url('/') }}">
                            <img src="{{ asset('uploaded-images/site-setting-images/' . $setting->logo) }}"
                                width="250">
                        </a>
                    @else
                        <a href="{{ url('/') }}">
                            <img alt="logo" class=""
                                src="{{ asset('frontend/global-journey/assets/img/logo.png') }}" width="250">
                        </a>
                    @endif

                </div>
                <ul class="menu">
                    <li>
                        <a href="{{ url('/') }}">Home</a>
                    </li>
                    <li>
                        <a href="{{ route('about-us') }}">About Us</a>
                    </li>
                    <li>
                        <a href="{{ route('study-abroad') }}">Study Abroad</a>
                        <ul class="sub-menu">
                            @foreach ($studyabroads as $studyabroad)
                                <li><a
                                        href="{{ route('study-abroad.details', $studyabroad->slug) }}">{{ $studyabroad->title }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <li>
                        <a href="{{ route('test-preparation') }}">Test Preparation</a>
                        <ul class="sub-menu">
                            @foreach ($testpreparations as $testpreparation)
                                <li>
                                    <a href="{{ route('test-preparation.details', $testpreparation->slug) }}">
                                        {{ $testpreparation->title }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <li>
                        <a href="{{ route('contact-us') }}">contacts</a>
                    </li>
                </ul>
                <div>
                    <a href="{{ route('enquiry-us') }}" class="themebtu">Enquire Today</a>
                </div>
            </div>
            <div class="bar-menu">
                <i class="fa-solid fa-bars"></i>
            </div>
        </div>
    </div>
    <div class="mobile-nav hmburger-menu" id="mobile-nav" style="display:block;">
        <div class="res-log">
            @if (is_object($setting) && isset($setting['logo']))
                <a href="{{ url('/') }}">
                    <img src="{{ asset('uploaded-images/site-setting-images/' . $setting->logo) }}"
                        alt="Responsive Logo">
                </a>
            @else
                <a href="{{ url('/') }}">
                    <img src="{{ asset('frontend/assets/img/logo.png') }}" alt="Responsive Logo">
                </a>
            @endif
        </div>
        <ul>

            <li class="menu-item-has-children"><a href="{{ url('/') }}">Home</a>
            </li>
            <li class="menu-item-has-children"><a href="JavaScript:void(0)">Pages</a>
                <ul class="sub-menu">
                    <li><a href="{{ route('about-us') }}">about</a></li>
                    <li><a href="team.html">team</a></li>
                    <li><a href="services.html">services</a></li>
                    <li><a href="pricing.html">pricing</a></li>
                    <li><a href="{{ route('contact-us') }}">contact</a></li>
                </ul>
            </li>

            <li class="menu-item-has-children">
                <a href="{{ route('study-abroad') }}">Study Abroad</a>
                <ul class="sub-menu">
                    @foreach ($studyabroads as $studyabroad)
                        <li><a
                                href="{{ route('study-abroad.details', $studyabroad->slug) }}">{{ $studyabroad->title }}</a>
                        </li>
                    @endforeach
                </ul>
            </li>
            <li class="menu-item-has-children"><a href="JavaScript:void(0)">blog</a>

                <ul class="sub-menu">

                    <li><a href="blog-grid.html">blog grid</a></li>
                    <li><a href="blog-single-post.html">blog single post 1</a></li>
                    <li><a href="blog-single-post-2.html">blog single post 2</a></li>
                </ul>

            </li>
            <li class="menu-item-has-children">
                <a href="{{ route('test-preparation') }}">Test Preparation</a>
                <ul class="sub-menu">
                    @foreach ($testpreparations as $testpreparation)
                        <li>
                            <a href="{{ route('test-preparation.details', $testpreparation->slug) }}">
                                {{ $testpreparation->title }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </li>

            <li><a href="{{ route('contact-us') }}">contacts</a></li>

        </ul>

        <a href="JavaScript:void(0)" id="res-cross"></a>
    </div>
</header>
 -->
