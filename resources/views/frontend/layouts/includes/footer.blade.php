<footer class="gap no-bottom" style="background-color: #f2f2f2 ;">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-4 col-md-6 mb-5">
                <div class="footer-logo">
                    @if (is_object($setting) && isset($setting['logo']))
                        <a href="{{ url('/') }}">
                            <img src="{{ asset('uploaded-images/site-setting-images/' . $setting->logo) }}" alt="img"
                                width="250px">
                        </a>
                    @else
                        <a href="{{ url('/') }}">
                            <img alt="img" width="250px"
                                src="{{ asset('frontend/assets/img/global-white.png') }}">
                        </a>
                    @endif
                    <p>
                        {!! $setting->description ?? '' !!}
                    </p>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 mb-5">
                <div class="links">
                    <h6>Additional links</h6>
                    <ul>
                        <li><a href="{{ route('about-us') }}">About us</a></li>
                        <li><a href="{{ route('test-preparation') }}">Test Preparations</a></li>
                        <li><a href="{{ route('interview-preparation') }}">Interview Preparations</a></li>
                        <li><a href="{{ route('blogs') }}">Blogs</a></li>
                        <li class="pb-0"><a href="{{ route('contact-us') }}">Contact us</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 mb-5">
                <div class="links">
                    <h6>Study Abroad</h6>
                    <ul>
                        @foreach ($studyabroads as $studyabroad)
                            <li><a
                                    href="{{ route('study-abroad.details', $studyabroad->slug) }}">{{ $studyabroad->title }}</a>
                            </li>
                        @endforeach
                    </ul>

                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 mb-5">
                <div class="latest-news">
                    <h6>Subscribe</h6>
                    <p>Get latest news and offers</p>
                    <form action="{{ route('subscribe.store') }}" method="post" class="subscribe-form_form">
                        @csrf
                        <input type="text" name="email" placeholder="your email address">
                        <button>go</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>{{ $setting->copyright_text ?? '' }} <a href="https://ideagen.com.np/">
                    ideagen</a></p>
            <ul>
                <li><a href="{{ $setting->fb_link ?? '' }}" target="_blank"><i class="fa-brands fa-facebook-f"></i></a>
                </li>
                <li><a href="{{ $setting->twitter_link ?? '' }}" target="_blank"><i
                            class="fa-brands fa-twitter"></i></a></li>
                <li><a href="{{ $setting->instagram_link ?? '' }}" target="_blank"><i
                            class="fa-brands fa-instagram"></i></a></li>
                <li><a href="{{ $setting->linkedIn_link ?? '' }}" target="_blank"><i
                            class="fa-brands fa-linkedin-in"></i></a></li>
            </ul>
        </div>
    </div>
</footer>
<a id="button"></a>
