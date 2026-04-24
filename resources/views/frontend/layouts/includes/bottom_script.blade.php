<script src="{{ asset('frontend/assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/jquery.fancybox.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/swiper.js') }}"></script>
<script src="{{ asset('frontend/assets/js/custom.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (window.AOS) {
            AOS.init({
                duration: 750,
                easing: 'ease-out-cubic',
                once: true,
                offset: 70,
                delay: 60,
            });
        }
    });
</script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if (Session::has('success') || Session::has('error'))
    <script>
        Swal.fire({
            toast: true,
            position: 'top-end',
            timer: 9000,
            timerProgressBar: true,
            icon: '{{ session('success') ? 'success' : 'error' }}',
            title: '{{ session('success') ?? session('error') }}',
            showConfirmButton: false,
        })
    </script>
@endif
