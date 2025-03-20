<section class="gap review-section">
    <div class="container">
        <div class="heading">
            <h6>Why Choose Global Journeys?</h6>
            <h2>Hear What Out Students Say!</h2>
            <img alt="line" src="{{ asset('frontend/assets/img/headingline.png') }}">
        </div>
        <div class="swiper-container partnerswiper">
            <div class="swiper-wrapper">
                @foreach ($testimonials as $testimonial)
                <div class="swiper-slide">
                    <div class="review">
                        <img alt="man" class="pp" src="{{ $testimonial->image_path ?? '' }}" />
                        <p><span style='font-family: serif;'>“</span></p>
                        <p style="overflow: hidden;
                                    text-overflow: ellipsis;
                                    display: -webkit-box;
                                    -webkit-line-clamp: 5;
                                    -webkit-box-orient: vertical;">
                            {!! $testimonial->description ?? '' !!}

                        </p>
                        <p><span style='font-family: serif'>”</span>
                        </p>
                        <div class="boder"></div>
                        <div class="" width="150px" alt="">
                            @for ($i = 0; $i < 5; $i++)
                                <i class="fas fa-star{{ $i < intval($testimonial->rating) ? '' : '-alt' }}"
                                style="color: {{ $i < intval($testimonial->rating) ? '#FFD700' : '#CCC' }}; font-size: 20px; margin-right: 2px;"></i>
                                @endfor
                        </div>
                        {{-- <img src="{{ asset('frontend/assets/img/rating.png') }}" width="150px" alt=""> --}}
                        <p class="testimonial-name">{{ $testimonial->name ?? '' }}</p>
                        <p class="testimonial-address">{{ $testimonial->address ?? '' }}</p>
                    </div>
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
            <div class="swiper-pagination"></div>
        </div>
    </div>
</section>