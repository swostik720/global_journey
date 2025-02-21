<section class="project gap">
    <div class="container">
        <div class="heading-boder">
            <h2>Study in the best <br><span>Destination</span></h2>
            <p>Favourite destination</p>
        </div>
        <div class="swiper-container projectsswiper">
            <div class="swiper-wrapper">
                @foreach ($studyabroads as $studyabroad)
                    <div class="swiper-slide">
                        <!-- <div class="project-data">
                            <img alt="img" class="w-100" src="{{ asset($studyabroad->image_path ?? '') }}">
                            <div class="project-text">
                                <h5></h5>
                                <p></p>
                                
                            </div>
                        </div> -->
<figure class="snip1493">
  <div class="image"><img src="{{ asset($studyabroad->image_path ?? '') }}" alt="ls-sample3" /></div>
  <figcaption>
    <div class="date"><span class="day">01</span><span class="month">Dec</span></div>
    <h3>{{ $studyabroad->title ?? '' }}</h3>
    <p>{!! $studyabroad->short_description ?? '' !!}</p>


    <!-- <a href="">Learn More</a> -->
    <!-- <footer>
      <div class="views"><i class="ion-eye"></i>928</div>
      <div class="love"><i class="ion-heart"></i>198</div>
      <div class="comments"><i class="ion-chatboxes"></i>23</div>
    </footer> -->
  </figcaption>
  <a href="{{ route('study-abroad.details', $studyabroad->slug) }}"></a>
</figure>
                    </div>
                @endforeach
            </div>
            <div class="swiper-button-next">
                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                    x="0px" y="0px" viewBox="0 0 476.213 476.213" style="enable-background:new 0 0 476.213 476.213;"
                    xml:space="preserve">
                    <polygon
                        points="405.606,167.5 384.394,188.713 418.787,223.106 0,223.106 0,253.106 418.787,253.106 384.394,287.5
      405.606,308.713 476.213,238.106 " />
                </svg>
            </div>
            <div class="swiper-button-prev">
                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                    x="0px" y="0px" viewBox="0 0 476.213 476.213" style="enable-background:new 0 0 476.213 476.213;"
                    xml:space="preserve">
                    <polygon
                        points="405.606,167.5 384.394,188.713 418.787,223.106 0,223.106 0,253.106 418.787,253.106 384.394,287.5
      405.606,308.713 476.213,238.106 " />
                </svg>
            </div>
        </div>
        <div class="btugap">
            <a href="{{ route('study-abroad') }}" class="themebtu">View all Destinations</a>
        </div>
        <div class="tp-hero__shapes">
            <div class="style-shapes-1">
            </div>
            <div class="style-shapes-2">
                <img alt="shap-4" src="{{ asset('frontend/assets/img/shap-4.png') }}">
            </div>
            <div class="style-shapes-3">
            </div>
            <div class="style-shapes-4">
                <img alt="dots1" src="{{ asset('frontend/assets/img/dots1.png') }}">
            </div>
        </div>
    </div>
</section>
