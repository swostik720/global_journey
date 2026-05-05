@php
    $countrySlides = collect($studyabroads ?? [])->take(5)->map(function ($item) {
        $slug = $item->slug ?? '';
        // Strip "Study in " prefix from title, then normalize
        $rawTitle = str_replace('study in ', '', strtolower($item->title ?? ''));

        // Map database country names to copyMap keys
        $countryMap = [
            'united states' => 'usa',
            'usa' => 'usa',
            'australia' => 'australia',
            'canada' => 'canada',
            'uk' => 'united kingdom',
            'united kingdom' => 'united kingdom',
            'new zealand' => 'new zealand',
        ];

        $countryLabels = [
            'usa' => 'USA',
            'australia' => 'Australia',
            'canada' => 'Canada',
            'united kingdom' => 'UK',
            'new zealand' => 'New Zealand',
        ];

        $country = $countryMap[$rawTitle] ?? $rawTitle;

        $copyMap = [
            'australia' => [
                'headline'   => "Live, Learn & Thrive<br>in <span class='gj-hl'>Australia</span>",
                'sub'        => 'World-class universities, vibrant cities, and post-study work rights — Australia turns ambitious students into global professionals.',
                'cta1'       => 'Study in Australia',
                'cta2'       => 'Check Eligibility',
            ],
            'united kingdom' => [
                'headline'   => "Write Your Story at<br><span class='gj-hl'>Britain's Finest Universities</span>",
                'sub'        => 'From Oxford to Edinburgh, earn a globally respected degree in as little as 3 years with full scholarship guidance.',
                'cta1'       => 'Explore UK Programs',
                'cta2'       => 'Book Free Counselling',
            ],
            'canada' => [
                'headline'   => "<span class='gj-hl'>Canada</span>: Where<br>Education Opens Every Door",
                'sub'        => 'Top-ranked programs, affordable tuition, and a clear pathway to permanent residency — Canada is the smart choice.',
                'cta1'       => 'Study in Canada',
                'cta2'       => 'Get Your Roadmap',
            ],
            'usa' => [
                'headline'   => "Dream Bigger.<br>Study at the <span class='gj-hl'>USA</span>",
                'sub'        => 'Ivy League or state university — the USA offers infinite possibilities for every field, every passion, every future.',
                'cta1'       => 'Explore USA Universities',
                'cta2'       => 'Talk to an Expert',
            ],
            'new zealand' => [
                'headline'   => "Fresh Start. World-Class Education.<br><span class='gj-hl'>New Zealand</span>",
                'sub'        => 'A welcoming nation with stunning landscapes and globally accredited degrees that open doors in every industry.',
                'cta1'       => 'Study in New Zealand',
                'cta2'       => 'Check Visa Options',
            ],
        ];

        // Only show if country exists in copyMap
        if (!isset($copyMap[$country])) {
            return null;
        }

        $copy = $copyMap[$country];

        return [
            'type'     => 'image',
            'image'    => asset($item->image_path ?? ''),
            'headline' => $copy['headline'],
            'sub'      => $copy['sub'],
            'cta1'     => $copy['cta1'],
            'cta2'     => $copy['cta2'],
            'cta1_url' => !empty($slug) ? route('study-abroad.details', $slug) : route('study-abroad'),
            'cta2_url' => route('contact-us'),
            'country'  => $countryLabels[$country] ?? ucfirst($rawTitle),
        ];
    })->filter();

    $globalSlide = [
        'type'     => 'video',
        'video'    => 'https://videos.pexels.com/video-files/1258446/1258446-hd_1920_1080_24fps.mp4',
        'headline' => "Your Global Path<br><span class='gj-hl'>To Success</span> Starts Here",
        'sub'      => "Nepal's most trusted study-abroad consultancy — 5,000+ success stories across 20+ countries. Expert guidance, zero confusion.",
        'cta1'     => 'Start Your Journey',
        'cta2'     => 'Explore Destinations',
        'cta1_url' => route('contact-us'),
        'cta2_url' => route('study-abroad'),
        'country'  => null,
    ];

    $slides = collect([$globalSlide])->merge($countrySlides)->values();
@endphp

<section class="gj-hero" aria-label="Global Journey Hero Slider">

    <div class="gj-hero__pag" aria-label="Slide pagination"></div>

    <div class="gj-hero__swiper swiper">
        <div class="swiper-wrapper">
            @foreach ($slides as $slide)
                <article class="swiper-slide gj-hero__slide">
                    <div class="gj-hero__media" aria-hidden="true">
                        @if (($slide['type'] ?? 'image') === 'video')
                            <video autoplay muted loop playsinline preload="metadata" class="gj-hero__video">
                                <source src="{{ $slide['video'] ?? '' }}" type="video/mp4">
                            </video>
                        @else
                            <img src="{{ $slide['image'] ?? '' }}" alt="{{ $slide['country'] ?? 'Banner' }}" class="gj-hero__img" loading="eager">
                        @endif
                        <div class="gj-hero__overlay"></div>
                    </div>

                    <div class="gj-hero__body">
                        <div class="gj-hero__inner">
                            @if (!empty($slide['country']))
                                <div class="gj-hero__tag gj-hero__anim" style="--d:0s">
                                    <span class="gj-hero__tag-dot"></span>
                                    Study in {{ $slide['country'] }}
                                </div>
                            @else
                                <div class="gj-hero__tag gj-hero__anim" style="--d:0s">
                                    <span class="gj-hero__tag-dot"></span>
                                    Nepal's #1 Study Abroad Consultancy
                                </div>
                            @endif

                            <h1 class="gj-hero__h1 gj-hero__anim" style="--d:0.08s">
                                {!! $slide['headline'] ?? '' !!}
                            </h1>

                            <p class="gj-hero__sub gj-hero__anim" style="--d:0.18s">
                                {{ $slide['sub'] ?? '' }}
                            </p>

                            <div class="gj-hero__ctas gj-hero__anim" style="--d:0.28s">
                                <a href="{{ $slide['cta1_url'] ?? '#' }}" class="gj-hero__btn gj-hero__btn--primary">
                                    {{ $slide['cta1'] ?? 'Get Started' }}
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                                </a>
                                <a href="{{ $slide['cta2_url'] ?? '#' }}" class="gj-hero__btn gj-hero__btn--ghost">
                                    {{ $slide['cta2'] ?? 'Learn More' }}
                                </a>
                            </div>

                            @if (is_null($slide['country'] ?? 'x'))
                                <div class="gj-hero__trust gj-hero__anim" style="--d:0.38s">
                                    <div class="gj-hero__trust-item">
                                        <strong>5,000+</strong><span>Students Placed</span>
                                    </div>
                                    <div class="gj-hero__trust-sep"></div>
                                    <div class="gj-hero__trust-item">
                                        <strong>20+</strong><span>Countries</span>
                                    </div>
                                    <div class="gj-hero__trust-sep"></div>
                                    <div class="gj-hero__trust-item">
                                        <strong>98%</strong><span>Visa Success Rate</span>
                                    </div>
                                    <div class="gj-hero__trust-sep"></div>
                                    <div class="gj-hero__trust-item">
                                        <strong>15+</strong><span>Years Experience</span>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </article>
            @endforeach
        </div>

        <div class="gj-hero__controls" aria-label="Slider controls">
            <button type="button" class="gj-hero__arrow gj-hero__arrow--up" aria-label="Previous slide">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m18 15-6-6-6 6"/></svg>
            </button>
            <button type="button" class="gj-hero__arrow gj-hero__arrow--down" aria-label="Next slide">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m6 9 6 6 6-6"/></svg>
            </button>
        </div>
    </div>

    <div class="gj-hero__scroll" aria-hidden="true">
        <span></span><span></span><span></span>
    </div>
</section>

<style>
/* ================================================================
   GLOBAL JOURNEY — PREMIUM HERO  |  $10k SaaS Aesthetic
   Palette: ink #03071A · champagne #C8A96E · white #FFFFFF
   ================================================================ */

/* ---------- tokens ---------- */
:root {
    --gh-ink:        #03071A;
    --gh-accent:     #4A90E2;
    --gh-accent-pale: #A8C8F0;
    --gh-accent-glow: rgba(74,144,226,.22);
    --gh-white:      #FFFFFF;
    --gh-white-70:   rgba(255,255,255,.70);
    --gh-white-40:   rgba(255,255,255,.40);
    --gh-white-10:   rgba(255,255,255,.10);
    --gh-white-06:   rgba(255,255,255,.06);
}

/* ---------- root ---------- */
.gj-hero {
    position: relative;
    width: 100%;
    /* stretch up behind the fixed header so it truly fills the viewport */
    height: calc(100vh + 94px);
    margin-top: -94px;
    min-height: 660px;
    overflow: hidden;
    background: var(--gh-ink);
}

/* ---------- swiper ---------- */
.gj-hero__swiper { width: 100%; height: 100%; }
.gj-hero__slide  { position: relative; width: 100%; height: 100%; }
.gj-hero__media  { position: absolute; inset: 0; }

/* ---------- media ---------- */
.gj-hero__video,
.gj-hero__img {
    position: absolute;
    inset: 0;
    width: 100%; height: 100%;
    object-fit: cover;
    object-position: center;
    max-width: 100%;
    max-height: 100%;
    transform: scale(1);
    transition: opacity .6s ease;
    will-change: opacity;
}
/* hide non-active slides instantly so no overflow bleed */
.gj-hero__slide:not(.swiper-slide-active) .gj-hero__video,
.gj-hero__slide:not(.swiper-slide-active) .gj-hero__img { opacity: 0; }

/* ---------- cinematic overlay ---------- */
.gj-hero__overlay {
    position: absolute;
    inset: 0;
    /* deep left-side shadow so text is always legible */
    background:
        linear-gradient(105deg,
            rgba(3,7,26,.93) 0%,
            rgba(3,7,26,.76) 34%,
            rgba(3,7,26,.30) 58%,
            rgba(3,7,26,.60) 100%),
        linear-gradient(180deg,
            rgba(0,0,0,.04) 0%,
            rgba(0,0,0,.52) 100%);
}

/* subtle gold-blue bloom behind text — pure CSS */
.gj-hero__body::before {
    content: '';
    position: absolute;
    left: -80px;
    top: 50%;
    transform: translateY(-50%);
    width: 700px; height: 700px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(14,40,120,.28) 0%, transparent 68%);
    pointer-events: none;
    z-index: 1;
}

/* ---------- body / inner ---------- */
.gj-hero__body {
    position: relative;
    z-index: 2;
    height: 100%;
    display: flex;
    align-items: center;
}

.gj-hero__inner {
    max-width: min(680px, 58vw);
    margin-left: clamp(60px, 8vw, 140px);
    animation: gjHeroRise .7s cubic-bezier(.22,.68,0,1.1) both;
}

/* ---------- eyebrow tag ---------- */
.gj-hero__tag {
    display: inline-flex;
    align-items: center;
    gap: 9px;
    background: rgba(74,144,226,.12);
    border: 1px solid rgba(74,144,226,.30);
    color: var(--gh-accent-pale);
    font-size: .75rem;
    font-weight: 700;
    letter-spacing: .10em;
    text-transform: uppercase;
    padding: 5px 14px 5px 10px;
    border-radius: 999px;
    margin-bottom: 22px;
    backdrop-filter: blur(10px);
}
.gj-hero__tag-dot {
    width: 6px; height: 6px;
    border-radius: 50%;
    background: var(--gh-accent);
    flex-shrink: 0;
    box-shadow: 0 0 0 3px var(--gh-accent-glow);
    animation: gjDotPulse 2.4s ease-in-out infinite;
}

/* ---------- accent line above headline ---------- */
.gj-hero__inner::before {
    content: '';
    display: block;
    width: 44px; height: 2px;
    background: linear-gradient(90deg, var(--gh-accent) 0%, transparent 100%);
    border-radius: 999px;
    margin-bottom: 18px;
    opacity: .9;
}

/* ---------- headline ---------- */
.gj-hero__h1 {
    color: var(--gh-white);
    font-size: clamp(2rem, 4.2vw, 3.8rem);
    font-weight: 900;
    line-height: 1.03;
    letter-spacing: -.032em;
    margin: 0 0 20px;
}

/* sky-blue gradient highlight */
.gj-hl {
    background: linear-gradient(95deg, #90C4F8 0%, #4A90E2 55%, #2266CC 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

/* ---------- sub text ---------- */
.gj-hero__sub {
    color: var(--gh-white-70);
    font-size: clamp(.85rem, 1.05vw, 1rem);
    line-height: 1.76;
    margin: 0 0 34px;
    max-width: 510px;
    font-weight: 400;
}

/* ---------- CTA buttons ---------- */
.gj-hero__ctas {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    margin-bottom: 40px;
}

.gj-hero__btn {
    display: inline-flex;
    align-items: center;
    gap: 9px;
    padding: 12px 24px;
    border-radius: 50px;
    font-size: .90rem;
    font-weight: 700;
    text-decoration: none;
    cursor: pointer;
    white-space: nowrap;
    transition: transform .22s ease, box-shadow .22s ease, opacity .22s ease;
}

/* White solid — the $10k move */
.gj-hero__btn--primary {
    background: var(--gh-white);
    color: var(--gh-ink);
    border: none;
    box-shadow: 0 4px 22px rgba(255,255,255,.18), 0 1px 4px rgba(255,255,255,.10);
    letter-spacing: -.01em;
}
.gj-hero__btn--primary:hover {
    transform: translateY(-3px) scale(1.025);
    box-shadow: 0 12px 36px rgba(255,255,255,.28);
    color: var(--gh-ink);
    text-decoration: none;
    opacity: .96;
}
.gj-hero__btn--primary svg { stroke: var(--gh-ink); }

/* Hairline ghost */
.gj-hero__btn--ghost {
    background: transparent;
    color: rgba(255,255,255,.88);
    border: 1px solid rgba(255,255,255,.30);
    letter-spacing: -.01em;
}
.gj-hero__btn--ghost:hover {
    background: var(--gh-white-10);
    border-color: rgba(255,255,255,.65);
    transform: translateY(-3px);
    color: var(--gh-white);
    text-decoration: none;
}

/* ---------- trust bar (glass card) ---------- */
.gj-hero__trust {
    display: inline-flex;
    align-items: center;
    gap: 0;
    background: var(--gh-white-06);
    border: 1px solid rgba(255,255,255,.09);
    border-radius: 14px;
    padding: 14px 24px;
    backdrop-filter: blur(14px);
    -webkit-backdrop-filter: blur(14px);
}

.gj-hero__trust-item {
    display: flex;
    flex-direction: column;
    padding: 0 22px 0 0;
    margin: 0 22px 0 0;
}
.gj-hero__trust-item:last-child { padding: 0; margin: 0; }

.gj-hero__trust-item strong {
    color: var(--gh-accent-pale);
    font-size: 1.5rem;
    font-weight: 800;
    line-height: 1.1;
    letter-spacing: -.02em;
}
.gj-hero__trust-item span {
    color: var(--gh-white-70);
    font-size: .72rem;
    letter-spacing: .05em;
    text-transform: uppercase;
    margin-top: 3px;
    font-weight: 500;
}

.gj-hero__trust-sep {
    width: 1px; height: 36px;
    background: rgba(255,255,255,.12);
    margin: 0 22px 0 0;
    flex-shrink: 0;
}

/* ---------- left pagination ---------- */
.gj-hero__pag {
    position: absolute;
    left: 20px;
    top: 50%;
    transform: translateY(-50%);
    z-index: 5;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 8px;
}
.gj-hero__pag .swiper-pagination-bullet {
    margin: 0 !important;
    width: 2px; height: 28px;
    border-radius: 999px;
    opacity: 1;
    background: rgba(255,255,255,.22);
    transition: height .35s ease, background .35s ease, width .35s ease, box-shadow .35s ease;
    display: block;
}
.gj-hero__pag .swiper-pagination-bullet-active {
    width: 3px; height: 50px;
    background: var(--gh-accent);
    box-shadow: 0 0 12px var(--gh-accent-glow);
}

/* ---------- controls ---------- */
.gj-hero__controls {
    position: absolute;
    right: 22px;
    top: 50%;
    transform: translateY(-50%);
    z-index: 5;
    display: flex;
    flex-direction: column;
    gap: 8px;
}
.gj-hero__arrow {
    width: 44px; height: 44px;
    border-radius: 12px;
    border: 1px solid rgba(255,255,255,.18);
    background: rgba(255,255,255,.08);
    color: var(--gh-white);
    display: grid;
    place-items: center;
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    transition: transform .2s ease, background .2s ease, border-color .2s ease;
    cursor: pointer;
}
.gj-hero__arrow:hover {
    transform: translateY(-2px);
    background: rgba(255,255,255,.16);
    border-color: rgba(255,255,255,.5);
}

/* ---------- scroll hint ---------- */
.gj-hero__scroll {
    position: absolute;
    bottom: 26px;
    left: 50%;
    transform: translateX(-50%);
    z-index: 5;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 4px;
}
.gj-hero__scroll span {
    display: block;
    width: 1.5px; height: 7px;
    background: rgba(255,255,255,.38);
    border-radius: 999px;
    animation: gjScroll 1.5s ease-in-out infinite;
}
.gj-hero__scroll span:nth-child(2) { animation-delay: .18s; }
.gj-hero__scroll span:nth-child(3) { animation-delay: .36s; }

/* ---------- keyframes ---------- */
@keyframes gjHeroRise {
    from { opacity: 0; transform: translateY(36px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* per-element staggered animation driven by CSS var --d */
.gj-hero__anim {
    opacity: 0;
    transform: translateY(24px);
    transition: opacity .55s ease var(--d, 0s), transform .55s ease var(--d, 0s);
}
.gj-hero__slide.swiper-slide-active .gj-hero__anim {
    opacity: 1;
    transform: translateY(0);
}
@keyframes gjDotPulse {
    0%, 100% { box-shadow: 0 0 0 3px var(--gh-accent-glow); }
    50%       { box-shadow: 0 0 0 6px transparent; }
}
@keyframes gjScroll {
    0%, 100% { opacity: .2; transform: scaleY(.7); }
    50%       { opacity: 1;  transform: scaleY(1.5); }
}

/* ---------- tablet ---------- */
@media (max-width: 991px) {
    .gj-hero__inner {
        max-width: min(560px, 74vw);
        margin-left: clamp(44px, 6vw, 80px);
    }
    .gj-hero__h1 { font-size: clamp(2rem, 6.2vw, 3.4rem); }
}

/* ---------- mobile ---------- */
@media (max-width: 767px) {
    .gj-hero { height: 100svh; min-height: 580px; }

    .gj-hero__body { align-items: flex-end; }
    .gj-hero__body::before { display: none; }

    .gj-hero__inner {
        max-width: none;
        margin-left: 0;
        padding: 0 20px 70px 48px;
    }

    .gj-hero__h1 { font-size: clamp(1.8rem, 9.5vw, 2.6rem); }
    .gj-hero__sub { font-size: .93rem; margin-bottom: 24px; }

    .gj-hero__ctas { flex-direction: column; gap: 9px; margin-bottom: 28px; }
    .gj-hero__btn  { width: 100%; justify-content: center; padding: 13px 20px; }

    .gj-hero__trust {
        padding: 10px 14px;
        border-radius: 10px;
        flex-wrap: wrap;
        gap: 8px 0;
    }
    .gj-hero__trust-item { padding-right: 12px; margin-right: 12px; }
    .gj-hero__trust-sep  { margin-right: 12px; height: 28px; }
    .gj-hero__trust-item strong { font-size: 1.2rem; }

    .gj-hero__controls {
        right: 12px; top: auto; transform: none;
        bottom: 14px; flex-direction: row;
    }
    .gj-hero__arrow { width: 40px; height: 40px; border-radius: 10px; }

    .gj-hero__pag { left: 8px; gap: 6px; }
    .gj-hero__scroll { display: none; }
}
</style>

<script>
(function () {
    var root = document.querySelector('.gj-hero');
    if (!root || typeof Swiper === 'undefined') return;
    var total = root.querySelectorAll('.gj-hero__slide').length;
    if (!total) return;

    var swiper = new Swiper('.gj-hero__swiper', {
        direction:      'vertical',
        slidesPerView:  1,
        spaceBetween:   0,
        speed:          950,
        loop:           total > 1,
        allowTouchMove: true,
        grabCursor:     true,
        autoplay: total > 1 ? { delay: 4500, disableOnInteraction: false, pauseOnMouseEnter: true } : false,
        navigation: { nextEl: '.gj-hero__arrow--down', prevEl: '.gj-hero__arrow--up' },
        pagination:  { el: '.gj-hero__pag', clickable: true },
        mousewheel:  false,
        keyboard:    { enabled: true, onlyInViewport: true },
        a11y:        { enabled: true },
    });
})();
</script>
