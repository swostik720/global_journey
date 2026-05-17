@php
    $countryMap = [
        'united states' => 'usa',
        'united states of america' => 'usa',
        'usa' => 'usa',
        'us' => 'usa',
        'u s a' => 'usa',
        'australia' => 'australia',
        'canada' => 'canada',
        'uk' => 'united kingdom',
        'u k' => 'united kingdom',
        'great britain' => 'united kingdom',
        'england' => 'united kingdom',
        'united kingdom' => 'united kingdom',
        'new zealand' => 'new zealand',
        'nz' => 'new zealand',
    ];

    $countryLabel = [
        'usa' => 'USA',
        'united kingdom' => 'UK',
        'australia' => 'Australia',
        'new zealand' => 'New Zealand',
        'canada' => 'Canada',
    ];

    $countryOrder = ['usa', 'united kingdom', 'australia', 'new zealand', 'canada'];

    $normalizeCountryString = static function (?string $value): string {
        $value = strtolower(trim((string) $value));
        $value = str_replace(['-', '_'], ' ', $value);
        $value = preg_replace('/[^a-z\s]/u', ' ', $value);
        $value = preg_replace('/\s+/u', ' ', (string) $value);
        $value = trim((string) preg_replace('/^study\s+in\s+/u', '', (string) $value));

        return trim((string) preg_replace('/\s+/u', ' ', (string) $value));
    };

    $resolveCountryKey = static function ($item) use ($countryMap, $normalizeCountryString) {
        $candidates = [
            (string) ($item->title ?? ''),
            (string) ($item->slug ?? ''),
        ];

        foreach ($candidates as $candidate) {
            $normalized = $normalizeCountryString($candidate);

            if ($normalized === '') {
                continue;
            }

            if (isset($countryMap[$normalized])) {
                return $countryMap[$normalized];
            }

            foreach ($countryMap as $needle => $mappedKey) {
                if ($needle !== '' && str_contains($normalized, $needle)) {
                    return $mappedKey;
                }
            }
        }

        return null;
    };

    $resolveFallbackLabel = static function ($item) use ($normalizeCountryString): string {
        $normalized = $normalizeCountryString((string) ($item->title ?? ''));

        if ($normalized === '') {
            $normalized = $normalizeCountryString((string) ($item->slug ?? ''));
        }

        return $normalized !== '' ? ucwords($normalized) : 'Destination';
    };

    $normalized = collect($studyabroads ?? [])
        ->map(function ($item) use ($resolveCountryKey, $resolveFallbackLabel, $countryLabel) {
            $key = $resolveCountryKey($item);
            $isKnownCountry = (bool) $key;
            $effectiveKey = $key ?: ('extra-' . md5((string) ($item->slug ?? '') . '|' . (string) ($item->title ?? '')));

            return [
                'key' => $effectiveKey,
                'country_key' => $key,
                'is_known_country' => $isKnownCountry,
                'label' => $isKnownCountry
                    ? ($countryLabel[$key] ?? ucfirst((string) $key))
                    : $resolveFallbackLabel($item),
                'title' => $item->title ?? '',
                'short' => $item->short_description ?? '',
                'slug' => $item->slug ?? '',
                'image' => asset($item->image_path ?? ''),
            ];
        })
        ->filter(fn($item) => !empty($item['slug']))
        ->unique('key');

    $knownCards = $normalized
        ->filter(fn($item) => $item['is_known_country'])
        ->unique('country_key')
        ->keyBy('country_key');

    $orderedKnownCards = collect($countryOrder)
        ->map(fn($key) => $knownCards->get($key))
        ->filter()
        ->values();

    $extraCards = $normalized
        ->filter(fn($item) => !$item['is_known_country'])
        ->values();

    $cards = $orderedKnownCards
        ->concat($extraCards)
        ->values();
@endphp

<section data-aos="fade-up" class="project project--manual gap">
    <div class="container">
        <div data-aos="fade-up" data-aos-delay="100" class="heading-boder text-center">
            <h2>Study in the best <br><span>Destination</span></h2>
            <p>Favourite destination</p>
        </div>

        <div class="destination-grid" data-aos="fade-up" data-aos-delay="140">
            @foreach ($cards as $card)
                <a href="{{ route('study-abroad.details', $card['slug']) }}" class="destination-grid__card destination-grid__card-link"
                    data-aos="zoom-in" data-aos-delay="{{ 120 + ($loop->index % 5) * 70 }}">
                    <div class="destination-grid__media">
                        <img src="{{ $card['image'] }}" alt="{{ $card['title'] }}">
                    </div>
                    <div class="destination-grid__overlay" aria-hidden="true"></div>

                    <div class="destination-grid__content">
                        <span class="destination-grid__badge">{{ $card['label'] }}</span>
                        <h3>{{ $card['title'] }}</h3>
                        <span class="destination-grid__cta">
                            Explore Now
                            <i class="bi bi-arrow-right" aria-hidden="true"></i>
                        </span>
                    </div>
                </a>
            @endforeach
        </div>

        <div data-aos="fade-up" data-aos-delay="220" class="btugap">
            <a data-aos="fade-up" data-aos-delay="300" href="{{ route('study-abroad') }}" class="themebtu">View all
                Destinations</a>
        </div>

        <div class="tp-hero__shapes">
            <div class="style-shapes-1"></div>
            <div class="style-shapes-2">
                <img alt="shap-4" src="{{ asset('frontend/assets/img/shap-4.png') }}">
            </div>
            <div class="style-shapes-3"></div>
        </div>
    </div>
</section>

<style>
    .project--manual {
        position: relative;
        overflow: hidden;
        background: linear-gradient(160deg, #f2f7ff 0%, #e7efff 100%);
    }

    .project--manual .heading-boder {
        display: block !important;
        width: 100% !important;
        max-width: 100% !important;
        text-align: center !important;
        margin-left: auto;
        margin-right: auto;
        margin-bottom: 26px;
    }

    .project--manual .heading-boder h2,
    .project--manual .heading-boder h2 span {
        color: #0f2454;
    }

    .project--manual .heading-boder p {
        color: #4b5f82;
    }

    .project--manual .heading-boder h2,
    .project--manual .heading-boder p {
        display: block !important;
        width: 100% !important;
        text-align: center !important;
        margin-left: auto !important;
        margin-right: auto !important;
        float: none !important;
    }

    .project--manual .heading-boder p {
        margin-top: 8px;
    }

    .project--manual .destination-grid {
        display: grid;
        grid-template-columns: repeat(5, minmax(0, 1fr));
        gap: 14px;
    }

    .project--manual .destination-grid__card {
        position: relative;
        min-height: 380px;
        border-radius: 18px;
        overflow: hidden;
        border: 1px solid rgba(0, 56, 166, 0.12);
        box-shadow: 0 12px 28px rgba(0, 56, 166, 0.16);
        transform: translateY(0);
        transition: transform 0.35s ease, box-shadow 0.35s ease, border-color 0.35s ease;
        isolation: isolate;
        background: #122a5c;
    }

    .project--manual .destination-grid__card-link {
        display: block;
        text-decoration: none;
        color: inherit;
    }

    .project--manual .destination-grid__card-link:focus-visible {
        outline: 2px solid #0058E8;
        outline-offset: 2px;
    }

    .project--manual .destination-grid__media {
        position: absolute;
        inset: 0;
    }

    .project--manual .destination-grid__media img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transform: scale(1);
        transition: transform 0.55s ease;
    }

    .project--manual .destination-grid__overlay {
        position: absolute;
        inset: 0;
        background:
            linear-gradient(180deg, rgba(2, 6, 23, 0.08) 0%, rgba(2, 6, 23, 0.64) 76%, rgba(2, 6, 23, 0.80) 100%),
            linear-gradient(120deg, rgba(37, 99, 235, 0.28) 0%, rgba(37, 99, 235, 0.10) 55%, transparent 100%);
        z-index: 1;
    }

    .project--manual .destination-grid__content {
        position: absolute;
        inset: auto 14px 14px 14px;
        z-index: 2;
        color: #ffffff;
    }

    .project--manual .destination-grid__badge {
        display: inline-block;
        margin-bottom: 10px;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        color: #ffffff;
        background: linear-gradient(135deg, #0038A6, #0058E8);
        border-radius: 999px;
        padding: 6px 10px;
        box-shadow: 0 8px 18px rgba(0, 56, 166, 0.34);
    }

    .project--manual .destination-grid__content h3 {
        color: #ffffff;
        font-size: clamp(1.2rem, 1.22vw, 1.55rem);
        line-height: 1.2;
        margin-bottom: 9px;
        font-weight: 800;
        text-shadow: 0 5px 14px rgba(0, 0, 0, 0.34);
    }

    .project--manual .destination-grid__content p {
        color: rgba(255, 255, 255, 0.9);
        font-size: 0.93rem;
        line-height: 1.5;
        margin-bottom: 12px;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        min-height: 63px;
    }

    .project--manual .destination-grid__cta {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #ffffff;
        text-decoration: none;
        font-weight: 700;
        font-size: 0.94rem;
        border-bottom: 2px solid rgba(255, 255, 255, 0.72);
        padding-bottom: 2px;
        transition: gap 0.25s ease, border-color 0.25s ease;
    }

    .project--manual .destination-grid__cta i {
        transition: transform 0.25s ease;
    }

    .project--manual .destination-grid__card:hover {
        transform: translateY(-8px);
        border-color: rgba(0, 88, 232, 0.5);
        box-shadow: 0 22px 42px rgba(0, 56, 166, 0.24);
    }

    .project--manual .destination-grid__card:hover .destination-grid__media img {
        transform: scale(1.08);
    }

    .project--manual .destination-grid__card:hover .destination-grid__cta {
        gap: 12px;
        border-color: #ffffff;
    }

    .project--manual .destination-grid__card:hover .destination-grid__cta i {
        transform: translateX(4px);
    }

    @media (max-width: 1399px) {
        .project--manual .destination-grid {
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 16px;
        }
    }

    @media (max-width: 991px) {
        .project--manual .destination-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 14px;
        }

        .project--manual .destination-grid__card {
            min-height: 350px;
        }
    }

    @media (max-width: 575px) {
        .project--manual .destination-grid {
            grid-template-columns: 1fr;
        }

        .project--manual .destination-grid__card {
            min-height: 340px;
        }
    }

    @media (hover: none) {
        .project--manual .destination-grid__card:hover {
            transform: none;
            box-shadow: 0 6px 18px rgba(0, 56, 166, 0.12);
            border-color: rgba(0, 88, 232, 0.15);
        }

        .project--manual .destination-grid__card:hover .destination-grid__media img {
            transform: none;
        }
    }
</style>

