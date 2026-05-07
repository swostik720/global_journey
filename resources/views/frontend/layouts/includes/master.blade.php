<!DOCTYPE html>
<html lang="zxx">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css">
    @include('frontend.layouts.includes.top_link')
    @stack('custom_css')
</head>

<body>
    @include('frontend.layouts.includes.header')

    @yield('maincontent')

    @include('frontend.layouts.includes.footer')

    @stack('custom_js')

    @include('frontend.layouts.includes.bottom_script')
</body>

</html>
