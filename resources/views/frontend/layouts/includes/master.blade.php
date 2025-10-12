<!DOCTYPE html>
<html lang="zxx">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css">

<head>
    @include('frontend.layouts.includes.top_link')
</head>
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    @stack('custom_css')

<body>
    @include('frontend.layouts.includes.header')

    @yield('maincontent')

    @include('frontend.layouts.includes.footer')

    @stack('custom_js')

    @include('frontend.layouts.includes.bottom_script')
</body>

</html>
