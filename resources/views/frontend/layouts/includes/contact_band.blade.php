@php
    $contactSectionId = $sectionId ?? null;
    $contactEyebrow = $eyebrow ?? 'Start Your Project With Us';
    $contactTitle = $title ?? "Let's Plan Your Next Move";
    $contactSubtitle = $subtitle ?? "Tell us where you want to study, and we'll map the most practical route from application to arrival.";
    $contactBadge = $badge ?? 'Consultation Form';
    $contactPanelTitle = $panelTitle ?? 'Book a conversation with the Global Journey team';
    $contactPanelCopy = $panelCopy ?? "Share your destination, budget, and timeline. We'll help you identify the right country, course, and application strategy.";
    $detailsTitle = $detailsTitle ?? 'Contact Details';
    $detailsCopy = $detailsCopy ?? 'Reach our counselors directly or connect with us on social platforms for updates and support.';
    $defaultCountry = $default_country ?? null;
@endphp

<section data-aos="fade-up" class="gj-contact-band" @if($contactSectionId) id="{{ $contactSectionId }}" @endif>
    <div class="container">
        <div data-aos="fade-up" data-aos-delay="100" class="gj-section-header gj-contact-band__header">
            <span class="gj-section-header__eyebrow">{{ $contactEyebrow }}</span>
            <h2>{{ $contactTitle }}</h2>
            <p>{{ $contactSubtitle }}</p>
        </div>

        <div class="row g-4 g-xl-5 align-items-start">
            <div class="col-xl-7 col-lg-7">
                <div data-aos="zoom-in-up" data-aos-delay="130" class="gj-contact-band__panel gj-surface-card gj-prose-card">
                    <div class="gj-contact-band__intro">
                        <span class="gj-meta-pill"><i class="bi bi-chat-square-heart-fill"></i> {{ $contactBadge }}</span>
                        <h3>{{ $contactPanelTitle }}</h3>
                        <p>{{ $contactPanelCopy }}</p>
                    </div>

                    @if ($defaultCountry)
                        @include('frontend.layouts.contact_form', ['default_country' => $defaultCountry])
                    @else
                        @include('frontend.layouts.contact_form')
                    @endif
                </div>
            </div>

            <div class="col-xl-5 col-lg-5">
                <aside data-aos="zoom-in-up" data-aos-delay="160" class="gj-contact-band__details gj-surface-card">
                    <span class="gj-meta-pill"><i class="bi bi-geo-alt-fill"></i> {{ $detailsTitle }}</span>
                    <h4>{{ $detailsTitle }}</h4>
                    <p class="gj-contact-band__details-copy">{{ $detailsCopy }}</p>

                    <ul class="contact-list">
                        <li>
                            <a href="tel:{{ $setting->phone ?? '+01-4186345' }}">
                                <i class="bi bi-telephone-fill"></i>
                                <span>{{ $setting->phone ?? '+01-4186345' }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="tel:{{ $setting->mobile ?? '+977 9705427840' }}">
                                <i class="bi bi-phone-fill"></i>
                                <span>{{ $setting->mobile ?? '+977 9705427840' }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="mailto:{{ $setting->email ?? 'info@globaljourneyedu.com.np' }}">
                                <i class="bi bi-envelope-fill"></i>
                                <span>{{ $setting->email ?? 'info@globaljourneyedu.com.np' }}</span>
                            </a>
                        </li>
                    </ul>

                    <hr>

                    <h5>Connect with Us</h5>
                    <ul class="social-links">
                        <li><a href="{{ $setting->fb_link ?? '#' }}" target="_blank" rel="noopener noreferrer"><i class="bi bi-facebook"></i></a></li>
                        <li><a href="{{ $setting->twitter_link ?? '#' }}" target="_blank" rel="noopener noreferrer"><i class="bi bi-twitter"></i></a></li>
                        <li><a href="{{ $setting->instagram_link ?? '#' }}" target="_blank" rel="noopener noreferrer"><i class="bi bi-instagram"></i></a></li>
                        <li><a href="{{ $setting->linkedIn_link ?? '#' }}" target="_blank" rel="noopener noreferrer"><i class="bi bi-linkedin"></i></a></li>
                    </ul>
                </aside>
            </div>
        </div>
    </div>
</section>
