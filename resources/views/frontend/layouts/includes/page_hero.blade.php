@php
    $heroBackground = $background ?? asset('frontend/assets/img/background.jpg');
    $heroEyebrow = $eyebrow ?? null;
    $heroTitle = $title ?? '';
    $heroAccent = $accent ?? null;
    $heroSubtitle = $subtitle ?? null;
    $heroMeta = collect($meta ?? [])->filter()->values();
    $heroPrimaryAction = $primaryAction ?? null;
    $heroSecondaryAction = $secondaryAction ?? null;
@endphp

<section data-aos="fade-up" class="splash-area-section" style="background-image: url({{ $heroBackground }});">
    <div class="container">
        <div class="splash-area">
            @if ($heroEyebrow)
                <span class="page-hero__eyebrow">
                    {{-- <i class="bi bi-stars" aria-hidden="true"></i> --}}
                    {{ $heroEyebrow }}
                </span>
            @endif

            <h1 class="splash-title">
                {{ $heroTitle }}@if ($heroAccent) <span class="gradient-text">{{ $heroAccent }}</span>@endif
            </h1>

            @if ($heroSubtitle)
                <p class="page-hero__subtitle">{{ $heroSubtitle }}</p>
            @endif

            @if ($heroMeta->isNotEmpty())
                <ul class="page-hero__meta">
                    @foreach ($heroMeta as $item)
                        <li>
                            <i class="bi bi-check-circle-fill" aria-hidden="true"></i>
                            <span>{{ $item }}</span>
                        </li>
                    @endforeach
                </ul>
            @endif

            @if ($heroPrimaryAction || $heroSecondaryAction)
                <div class="page-hero__actions">
                    @if (is_array($heroPrimaryAction) && filled($heroPrimaryAction['label'] ?? null) && filled($heroPrimaryAction['url'] ?? null))
                        <a href="{{ $heroPrimaryAction['url'] }}" class="page-hero__btn page-hero__btn--primary">
                            {{ $heroPrimaryAction['label'] }}
                            <i class="bi bi-arrow-right-short" aria-hidden="true"></i>
                        </a>
                    @endif

                    @if (is_array($heroSecondaryAction) && filled($heroSecondaryAction['label'] ?? null) && filled($heroSecondaryAction['url'] ?? null))
                        <a href="{{ $heroSecondaryAction['url'] }}" class="page-hero__btn page-hero__btn--ghost">
                            {{ $heroSecondaryAction['label'] }}
                            <i class="bi bi-chevron-right" aria-hidden="true"></i>
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </div>
</section>
