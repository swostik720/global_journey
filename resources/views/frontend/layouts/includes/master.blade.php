<!DOCTYPE html>
<html lang="zxx">

<head>
    @include('frontend.layouts.includes.top_link')
</head>

<body>
    @include('frontend.layouts.includes.header')

    @yield('maincontent')

    @include('frontend.layouts.includes.footer')

    @include('frontend.layouts.includes.bottom_script')
</body>

</html>
