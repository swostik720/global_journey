<!DOCTYPE html>
<html lang="zxx">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css">
    @include('frontend.layouts.includes.top_link')
    @stack('custom_css')

    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "ProfessionalService",
        "name": "Global Journey Education Services Pvt. Ltd.",
        "image": "https://globaljourneyedu.com.np/uploaded-images/site-setting-images/RXun1DXkrTYfSHzNi71vu9CU7FtEfdJAruk1Nbdm.png",
        "@id": "",
        "url": "https://globaljourneyedu.com.np/",
        "telephone": "01-4168345",
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "Kharel Building, Ground, inside, 31 Putalisadak, Kathmandu",
            "addressLocality": "Kathmandu",
            "postalCode": "44600",
            "addressCountry": "NP"
        },
        "openingHoursSpecification": {
            "@type": "OpeningHoursSpecification",
            "dayOfWeek": [
                "Monday",
                "Tuesday",
                "Wednesday",
                "Thursday",
                "Friday",
                "Sunday"
            ],
            "opens": "09:30",
            "closes": "18:00"
        },
        "sameAs": [
            "https://www.facebook.com/Globaljourney2018",
            "https://www.instagram.com/globaljourneyeducation/",
            "https://www.linkedin.com/company/global-journey-education-services-pvt-ltd/",
            "https://globaljourneyedu.com.np/",
            "https://www.tiktok.com/@globalljourney"
        ]
    }
    </script>
</head>

<body>
    @include('frontend.layouts.includes.header')

    @yield('maincontent')

    @include('frontend.layouts.includes.footer')

    @include('includes.contact-speed-dial')

    @stack('custom_js')

    @include('frontend.layouts.includes.bottom_script')

    @include('frontend.layouts.includes.chatbot')
</body>

</html>
