@extends('frontend.layouts.includes.master')
@section('maincontent')
    <section class="splash-area-section" style="background-image: url({{ asset('frontend/assets/img/background.jpg') }})">
        <div class="container">
            <div class="splash-area">
                <h2>We Deliver<br>Results</h2>
                <a href="#">About Us</a>
            </div>
        </div>
    </section>
    <section class="things-differently gap">
        <div class="container">
            <div class="row">
                <div class="col-xl-7">
                    <div class="heading">
                        <h6>Know What We Stand For</h6>
                        <h2>Welcome to <br>Global Education Services.</h2>
                        <img alt="line" src="{{ asset('frontend/assets/img/headingline.png') }}">
                        <img alt="dots" class="dots" src="{{ asset('frontend/assets/img/dots.png') }}">
                    </div>
                </div>
                <div class="col-xl-5">
                    <div class="signature">
                        <p>At Global Journey Education Services, our name is synonymous with excellence in providing
                            comprehensive study abroad consulting services in Nepal. Our prime location is in the heart of
                            downtown Putalisadak, Kathmandu, where our head office stands. Additionally, we have
                            strategically positioned branches throughout Nepal to cater to your needs effectively. <br><br>
                        </p>
                        <p>
                            Our unwavering commitment revolves around guiding students towards optimal educational
                            opportunities, setting them on a path to a promising future. Leveraging our profound expertise
                            and extensive experience, we meticulously match students with institutions that align with their
                            aspirations. Our strong affiliations with Australian institutions further enhance our ability to
                            provide unparalleled services to our valued students.</p>
                        <p>Global Journey Education Services is renowned for its unmatched dedication to facilitating study
                            abroad journeys. Our central location in Putalisadak, Kathmandu, coupled with our support office
                            in Sydney and strategically located branches across Nepal, underscores our commitment to
                            delivering top-tier assistance to students.</p>
                        <div class="ceo">
                            <div>
                                <img alt="img" src="{{ asset('frontend/assets/img/signature.png') }}">
                                <span>CEO, Global Journey</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="gap">
        <div class="container">
            <div class="row">
                <div class="col-xl-6">
                    <div class="heading">
                        <h6>Meet Our Team Members</h6>
                        <h2> Our team is always ready to work with exciting and ambitious clients.
                            If you're ready to start your creative partnership with us, get in touch.</h2>
                        <img alt="line" src="{{ asset('frontend/assets/img/headingline.png') }}">
                    </div>
                </div>
                <div class="offset-xl-1 col-xl-5">
                    <div class="team-welcome-text">
                        <p>Sed pretium, ligula sollicitudin laoreet viverra, tortor libero sodales leo, eget blandit nunc
                            tortor eu nibh. Nullam mollis. Ut justo. Suspendisse potenti. Sedegestas, antet vulputate
                            volutpat, eros pede semperest.</p>
                        <a href="{{ route('contact-us') }}" class="themebtu">Contact Us</a>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                @foreach ($teams as $team)
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="team-member">
                            <img class="w-100" alt="img" src="{{ $team->image_path ?? '' }}">
                            <div class="team-member-text">
                                <a href="#">
                                    <h6>{{ $team->name ?? '' }}</h6>
                                </a>
                                <p>{{ $team->responsibility ?? '' }}</p>
                                <ul class="brandicon">
                                    <li>
                                        <a href="{{ $team->fb_link ?? '' }}">
                                            <i class="fa-brands fa-facebook-f"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ $team->twitter_link ?? '' }}">
                                            <i class="fa-brands fa-twitter"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ $team->instagram_link ?? '' }}">
                                            <i class="fa-brands fa-instagram"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ $team->linkedin_link ?? '' }}">
                                            <i class="fa-brands fa-linkedin-in"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <section class="we-deliver-results gap" style="background-color: #f2edf5;">
        <div class="container">
            <div class="heading two">
                <h2>Why Choose Global Journey Education Services?</h2>
                <img alt="line" src="{{ asset('frontend/assets/img/headingline.png') }}">
            </div>
            <div class="row">
                <div class="col-xl-3 col-md-6 col-sm-12">
                    <div class="makes-us-different-text">
                        <i>
                            <svg enable-background="new 0 0 64 64" height="512" viewBox="0 0 64 64" width="512"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="m33 19v-2h3v-3c0-1.654-1.346-3-3-3h-2c-.552 0-1-.449-1-1v-1h3c.552 0 1 .449 1 1h2c0-1.654-1.346-3-3-3v-2h-2v2h-3v3c0 1.654 1.346 3 3 3h2c.552 0 1 .449 1 1v1h-3c-.552 0-1-.449-1-1h-2c0 1.654 1.346 3 3 3v2z" />
                                <path
                                    d="m62.618 47-5-10h-13.974c2.044-1.651 3.356-4.174 3.356-7v-1h-7c-2.826 0-5.349 1.312-7 3.356v-9.406c5.598-.508 10-5.222 10-10.95 0-6.065-4.935-11-11-11s-11 4.935-11 11c0 5.728 4.402 10.442 10 10.949v5.406c-1.651-2.043-4.174-3.355-7-3.355h-7v1c0 4.962 4.037 9 9 9h5v2h-1.382-3.236-20l-5 10h3.618v16h52v-16zm-36.618-14c-3.521 0-6.442-2.612-6.929-6h4.929c3.521 0 6.442 2.612 6.929 6zm14-2h4.929c-.486 3.388-3.408 6-6.929 6h-4.929c.487-3.388 3.408-6 6.929-6zm-17-19c0-4.962 4.037-9 9-9s9 4.038 9 9-4.037 9-9 9-9-4.038-9-9zm8 27h7 18.382l3 6h-26.764l-3-6zm-23.382 0h18.764l-3 6h-18.764zm-.618 8h17.618l2.382-4.764v18.764h-20zm48 14h-26v-18.764l2.382 4.764h23.618z" />
                                <path d="m53 53h-15v6h15zm-2 4h-11v-2h11z" />
                                <path d="m9 53h2v2h-2z" />
                                <path d="m9 57h2v2h-2z" />
                                <path d="m9 49h2v2h-2z" />
                                <path
                                    d="m49 33h2v-19h-2.233l4.233-7.056 4.233 7.056h-2.233v9h2v-7h3.767l-7.767-12.944-7.767 12.944h3.767z" />
                                <path d="m55 25h2v2h-2z" />
                                <path d="m55 29h2v2h-2z" />
                                <path
                                    d="m6 23h2v-9h-2.233l4.233-7.056 4.233 7.056h-2.233v19h2v-17h3.767l-7.767-12.944-7.767 12.944h3.767z" />
                                <path d="m6 25h2v2h-2z" />
                                <path d="m6 29h2v2h-2z" />
                                <path d="m46 41h2v2h-2z" />
                                <path d="m50 41h2v2h-2z" />
                                <path d="m54 41h2v2h-2z" />
                                <path d="m8 41h2v2h-2z" />
                                <path d="m12 41h2v2h-2z" />
                                <path d="m16 41h2v2h-2z" />
                            </svg>
                        </i>
                        <h4>
                            We are Caring and Focus</h4>
                        <p>
                            Phasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel, dapibus id,
                            mattis velnisi. Sed pretium, ligula sollicitudin.
                        </p>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 col-sm-12">
                    <div class="makes-us-different-text">
                        <i>
                            <svg id="Ecommerce" enable-background="new 0 0 48 48" height="512" viewBox="0 0 48 48"
                                width="512" xmlns="http://www.w3.org/2000/svg">
                                <g>
                                    <path
                                        d="m25 7.03c0-.552-.447-1-1-1-5.514 0-10 4.486-10 10 0 .552.447 1 1 1s1-.448 1-1c0-4.411 3.589-8 8-8 .553 0 1-.448 1-1z" />
                                    <path
                                        d="m22.246 45.79h1.754 1.754c1.652 0 2.999-1.345 3-3v-1.099c1.032-.475 1.755-1.512 1.755-2.721v-3.72c.176-.382.281-.802.281-1.25 0-1.016.226-2 .671-2.927.441-.919 1.086-1.752 1.864-2.409 3.746-3.165 5.709-7.989 5.25-12.909-.7-7.375-6.813-13.189-14.265-13.525l-.31-.01-.354.011c-7.408.335-13.521 6.149-14.222 13.526-.458 4.917 1.505 9.742 5.251 12.906.778.658 1.423 1.491 1.864 2.41.445.927.671 1.911.671 2.927 0 .447.105.868.281 1.25v3.721c0 1.209.722 2.247 1.755 2.721v1.1c.001 1.653 1.348 2.998 3 2.998zm4.508-3c0 .552-.449 1-1 1h-1.754-1.754c-.551 0-1-.449-1-1v-.82h2.754 2.754zm1.755-3.819c0 .551-.448 1-1 1h-3.509-3.509c-.552 0-1-.449-1-1v-2.068c.232.058.47.097.719.097h3.79 3.79c.249 0 .487-.039.719-.097zm-9.299-4.971c0-1.318-.292-2.595-.868-3.793-.563-1.171-1.385-2.233-2.376-3.071-3.247-2.742-4.948-6.926-4.551-11.191.607-6.389 5.903-11.426 12.275-11.715l.31-.01.265.009c6.417.29 11.713 5.327 12.319 11.714.398 4.267-1.303 8.451-4.55 11.193-.991.838-1.813 1.9-2.376 3.071-.576 1.198-.868 2.475-.868 3.793 0 .551-.448 1-1 1h-3.79-3.79c-.552 0-1-.449-1-1z" />
                                </g>
                            </svg>
                        </i>
                        <h4>High Success Rate</h4>
                        <p>
                            In nisi neque, aliquet vel, dapibus id, mattisvel, nisi. Sed pretium, ligula sollicitudin
                            laoreet viverra, tortor libero sodales leo, eget .
                        </p>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 col-sm-12">
                    <div class="makes-us-different-text">
                        <i>
                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 60.07 60.07"
                                style="enable-background:new 0 0 60.07 60.07;" xml:space="preserve">
                                <path
                                    d="M59.921,27.964C58.908,13.099,46.934,1.124,32.068,0.11L31,0.038v28.994h28.994L59.921,27.964z M33,27.032V2.199
                                                                                          c2.475,0.265,4.854,0.859,7.097,1.732c-0.004,0.035-0.02,0.065-0.02,0.101c0,0.552,0.448,1,1,1c0.301,0,0.562-0.14,0.746-0.35
                                                                                          c4.937,2.317,9.089,6.035,11.952,10.637c-0.18-0.177-0.426-0.287-0.698-0.287c-0.552,0-1,0.448-1,1s0.448,1,1,1s1-0.448,1-1
                                                                                          c0-0.129-0.029-0.25-0.073-0.363c0.512,0.85,0.969,1.735,1.39,2.64c-0.193,0.182-0.317,0.437-0.317,0.723c0,0.552,0.448,1,1,1
                                                                                          c0.021,0,0.039-0.011,0.061-0.012c0.855,2.218,1.434,4.569,1.696,7.012H33z" />
                                <path
                                    d="M31.318,31.032l20.097,20.097l0.706-0.766c4.618-5.008,7.415-11.494,7.876-18.263l0.073-1.068H31.318z M51.343,48.229
                                                                                          L36.146,33.032h21.762C57.308,38.616,55.007,43.942,51.343,48.229z" />
                                <circle cx="35.076" cy="4.032" r="1" />
                                <circle cx="35.076" cy="10.032" r="1" />
                                <circle cx="38.076" cy="7.032" r="1" />
                                <circle cx="44.076" cy="7.032" r="1" />
                                <circle cx="41.076" cy="10.032" r="1" />
                                <circle cx="47.076" cy="10.032" r="1" />
                                <circle cx="50.076" cy="13.032" r="1" />
                                <circle cx="38.076" cy="13.032" r="1" />
                                <circle cx="44.076" cy="13.032" r="1" />
                                <circle cx="50.076" cy="19.032" r="1" />
                                <circle cx="53.076" cy="22.032" r="1" />
                                <circle cx="35.076" cy="16.032" r="1" />
                                <circle cx="35.076" cy="22.032" r="1" />
                                <circle cx="38.076" cy="19.032" r="1" />
                                <circle cx="44.076" cy="19.032" r="1" />
                                <circle cx="41.076" cy="16.032" r="1" />
                                <circle cx="47.076" cy="16.032" r="1" />
                                <circle cx="41.076" cy="22.032" r="1" />
                                <circle cx="47.076" cy="22.032" r="1" />
                                <circle cx="56.076" cy="25.032" r="1" />
                                <circle cx="50.076" cy="25.032" r="1" />
                                <circle cx="38.076" cy="25.032" r="1" />
                                <circle cx="44.076" cy="25.032" r="1" />
                                <path
                                    d="M29,0.038L27.932,0.11C12.269,1.179,0,14.321,0,30.032c0,7.239,2.621,14.233,7.38,19.695l0.704,0.808L29,29.618V0.038z
                                                                                           M27,28.79L8.199,47.591C4.194,42.623,2,36.43,2,30.032C2,15.729,12.896,3.705,27,2.199V28.79z" />
                                <path
                                    d="M9.498,51.948l0.808,0.704c5.461,4.759,12.456,7.38,19.694,7.38c6.927,0,13.687-2.425,19.037-6.826l0.851-0.7
                                                                                          L29.414,32.032L9.498,51.948z M29.414,34.86l1.101,1.101L13.707,52.768c-0.426-0.306-0.856-0.604-1.266-0.934L29.414,34.86z
                                                                                           M21.198,56.592c-0.695-0.231-1.379-0.491-2.053-0.776l15.613-15.613l1.414,1.414L21.198,56.592z M37.586,43.032L39,44.446
                                                                                          L25.756,57.691c-0.795-0.122-1.583-0.277-2.362-0.467L37.586,43.032z M17.219,54.914c-0.616-0.316-1.218-0.657-1.81-1.019
                                                                                          l16.52-16.52l1.415,1.415L17.219,54.914z M28.315,57.96l12.099-12.1l1.414,1.414L31.117,57.986
                                                                                          c-0.372,0.015-0.743,0.046-1.117,0.046C29.436,58.032,28.876,57.994,28.315,57.96z M43.242,48.689l1.415,1.415l-6.763,6.763
                                                                                          c-1.2,0.354-2.419,0.639-3.659,0.83L43.242,48.689z M42.56,55.029l3.512-3.512l0.828,0.828
                                                                                          C45.536,53.38,44.077,54.266,42.56,55.029z" />
                            </svg>
                        </i>
                        <h4>Result Oriented Performance</h4>
                        <p>
                            Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus hendrerit. Pellentesque
                            aliquet nibh nec urna.
                        </p>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 col-sm-12">
                    <div class="makes-us-different-text">
                        <i>
                            <svg xmlns="http://www.w3.org/2000/svg" id="&#x421;&#x43B;&#x43E;&#x439;_1"
                                data-name="&#x421;&#x43B;&#x43E;&#x439; 1" viewBox="0 0 128 128" width="512"
                                height="512">
                                <path
                                    d="M14,50c.4,0,.79,0,1.18-.06L16,54.38A2,2,0,0,0,20,53.62L19.08,49a14,14,0,0,0,8.28-17.22L54.21,18.92a12.15,12.15,0,0,0,2.18,2.35l-22,31.59a2,2,0,0,0,3.28,2.28L59.89,23.26a11.29,11.29,0,0,0,2.11.56V41a2,2,0,0,0,4,0V23.82a11.29,11.29,0,0,0,2.11-.56L90.36,55.14a2,2,0,1,0,3.28-2.28l-22-31.59a12.15,12.15,0,0,0,2.18-2.35l26.85,12.89A14,14,0,0,0,108.92,49L108,53.62a2,2,0,1,0,3.92.76l.86-4.44c.39,0,.78.06,1.18.06a14,14,0,1,0-11.62-21.8L75.52,15.31A11.67,11.67,0,0,0,76,12a12,12,0,0,0-24,0,11.67,11.67,0,0,0,.48,3.31L25.62,28.2A14,14,0,1,0,14,50ZM114,26a10,10,0,1,1-10,10A10,10,0,0,1,114,26ZM64,4a8,8,0,1,1-8,8A8,8,0,0,1,64,4ZM14,26A10,10,0,1,1,4,36,10,10,0,0,1,14,26Z" />
                                <path
                                    d="M110.71,94.45A12.67,12.67,0,0,0,116,84V67a6.85,6.85,0,0,0-7-7H96a6.85,6.85,0,0,0-7,7V84a12.65,12.65,0,0,0,5.24,10.41,24.91,24.91,0,0,0-3.78,1.66,2,2,0,1,0,1.92,3.51A20.9,20.9,0,0,1,102.51,97C114.16,97,124,107.08,124,119a2,2,0,0,0,4,0A26.37,26.37,0,0,0,110.71,94.45ZM93,67a2.84,2.84,0,0,1,3-3h13a2.84,2.84,0,0,1,3,3v5H93Zm0,17V76h19v8c0,5.13-4.08,9-9.49,9S93,89.13,93,84Z" />
                                <path
                                    d="M34.86,99.26a2,2,0,0,0,1.81-3.57c-.48-.25-2.44-1.08-2.94-1.26A12.65,12.65,0,0,0,39,84V67a6.85,6.85,0,0,0-7-7H19a6.85,6.85,0,0,0-7,7V84a12.65,12.65,0,0,0,5.24,10.41A26,26,0,0,0,0,119a2,2,0,0,0,4,0A21.78,21.78,0,0,1,25.51,97,20.69,20.69,0,0,1,34.86,99.26ZM16,67a2.84,2.84,0,0,1,3-3H32a2.84,2.84,0,0,1,3,3v5H16Zm0,17V76H35v8c0,5.13-4.08,9-9.49,9S16,89.13,16,84Z" />
                                <path
                                    d="M73.5,93.8A17.31,17.31,0,0,0,82,79V56a9,9,0,0,0-9-9H55a9,9,0,0,0-9,9V79a17.45,17.45,0,0,0,8.61,14.72A33.14,33.14,0,0,0,30.5,126a2,2,0,0,0,4,0A29.23,29.23,0,0,1,64,96.42,29.57,29.57,0,0,1,93.5,126a2,2,0,0,0,4,0A33.63,33.63,0,0,0,73.5,93.8ZM50,56a5,5,0,0,1,5-5H73a5,5,0,0,1,5,5v7H50Zm0,23V67H78V79c0,7.27-6.35,13.42-13.88,13.42S50,86.27,50,79Z" />
                            </svg>
                        </i>
                        <h4>Trustworthy</h4>
                        <p>
                            Sed pretium, ligula sollicitudin laoreet viverra, tortor libero sodales leo, eget blandit nunc
                            tortor eunibh. Nullam mollis. Ut justo.
                        </p>
                    </div>
                </div>
            </div>
            <div class="btugap">
                <a href="{{ route('contact-us') }}" class="themebtu">Enquire Now</a>
            </div>
        </div>
    </section>
    <div class="counter-style gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="counter-text">
                        <div class="d-flex align-items-center justify-content-center">
                            <div class="counter" data-target="6000"></div>
                            <h6>+</h6>
                        </div>
                        <div class="boder"></div>
                        <span>Students Abroad</span>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="counter-text">
                        <div class="d-flex align-items-center justify-content-center">
                            <div class="counter" data-target="5000"></div>
                            <h6>+</h6>
                        </div>
                        <div class="boder"></div>
                        <span>Happy Students</span>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="counter-text">
                        <div class="d-flex align-items-center justify-content-center">
                            <div class="counter" data-target="9"></div>
                            <h6>+</h6>
                        </div>
                        <div class="boder"></div>
                        <span>Years in Business</span>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="counter-text">
                        <div class="d-flex align-items-center justify-content-center">
                            <div class="counter" data-target="36"></div>
                            <h6>+</h6>
                        </div>
                        <div class="boder"></div>
                        <span>Experts Teachers</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('frontend.layouts.why_choose_global')
@endsection
