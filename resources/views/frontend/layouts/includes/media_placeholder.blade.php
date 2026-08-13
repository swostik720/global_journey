@once
    <style>
        .gj-media-fallback {
            position: absolute;
            inset: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 10px;
            text-align: center;
            padding: 16px;
            background: linear-gradient(135deg, #0038A6 0%, #0046C4 45%, #0058E8 100%);
        }

        .gj-media-fallback::before {
            content: "";
            position: absolute;
            inset: 0;
            background-image: radial-gradient(circle at 20% 20%, rgba(255, 255, 255, 0.14), transparent 45%),
                radial-gradient(circle at 82% 78%, rgba(255, 255, 255, 0.10), transparent 40%);
        }

        .gj-media-fallback__flag {
            position: relative;
            font-size: 2.6rem;
            line-height: 1;
            filter: drop-shadow(0 6px 14px rgba(0, 0, 0, 0.25));
        }

        .gj-media-fallback__label {
            position: relative;
            color: rgba(255, 255, 255, 0.92);
            font-size: 0.82rem;
            font-weight: 700;
            letter-spacing: 0.03em;
        }
    </style>
@endonce

<div class="gj-media-fallback" role="img" aria-label="{{ $label ?? 'Destination photo coming soon' }}">
    <span class="gj-media-fallback__flag" aria-hidden="true">{{ $flag ?? '🌍' }}</span>
    <span class="gj-media-fallback__label">{{ $label ?? 'Photo coming soon' }}</span>
</div>
