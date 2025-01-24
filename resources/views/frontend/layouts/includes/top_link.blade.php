<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
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
<link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/responsive.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/color.css') }}">

<style>
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
