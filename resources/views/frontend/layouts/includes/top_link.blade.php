<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="google-site-verification" content="LrVtsw_d_nzB4Vt_Fk6Xgp_KJa7XS1YHoZ8v4tPoERM" />
<title>{{ $setting->name ?? 'Global journeys' }}</title>

@if (is_object($setting) && isset($setting['favicon']))
    <link rel="icon" href="{{ asset('uploaded-images/site-setting-images/' . $setting->favicon) }}" />
@else
    <link rel="icon" href="{{ asset('frontend/assets/img/global-icon-only.png') }}">
@endif

<link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/fontawesome.min.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/jquery.fancybox.min.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/swiper.css') }}">
<link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/responsive.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/color.css') }}">

<style>
    /* Global inner-page hero style (applies to splash-area-section only, not home) */
    .splash-area-section,
    .splash-area-section * {
        font-family: "Poppins", sans-serif !important;
    }

    .splash-area-section {
        position: relative;
        background-size: cover;
        background-position: center;
        min-height: 480px;
        display: flex;
        align-items: center;
        padding: 80px 0 100px;
        overflow: hidden;
    }

    .splash-area-section::before {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(100deg, rgba(5, 20, 60, 0.72) 0%, rgba(10, 35, 90, 0.45) 55%, rgba(5, 18, 55, 0.65) 100%);
        z-index: 0;
    }

    .splash-area-section .container {
        position: relative;
        z-index: 1;
    }

    .splash-area-section .splash-area {
        padding-left: 40px;
        display: block !important;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .splash-area-section .splash-title {
        font-size: clamp(36px, 5vw, 64px) !important;
        font-weight: 800 !important;
        line-height: 1.1 !important;
        letter-spacing: -0.02em !important;
        color: #f0f8ff !important;
        text-shadow: 0 4px 18px rgba(0, 15, 50, 0.4) !important;
        margin: 0 0 18px !important;
        display: block !important;
        white-space: nowrap !important;
        padding-left: 0 !important;
    }

    .splash-area-section .splash-title .gradient-text {
        display: inline;
    }

    .splash-area-section .splash-title:last-child {
        margin-bottom: 18px !important;
    }

    .splash-area-section .gradient-text,
    .splash-area-section .splash-title.gradient-text {
        background: linear-gradient(90deg, #93e8ff 0%, #60d4ff 45%, #b3c8ff 100%) !important;
        -webkit-background-clip: text !important;
        -webkit-text-fill-color: transparent !important;
        background-clip: text !important;
        color: transparent !important;
    }

    @media (max-width: 768px) {
        .splash-area-section {
            min-height: 360px;
            padding: 60px 0 70px;
        }

        .splash-area-section .splash-area {
            padding-left: 10px;
        }
    }

    .hero-section-one {
        position: relative;
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .hero-section-one video {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        z-index: 1;
    }

    .hero-section-one .container {
        position: relative;
        z-index: 2;
        text-align: center;
    }
</style>
