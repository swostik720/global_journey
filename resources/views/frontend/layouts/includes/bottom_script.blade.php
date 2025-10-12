<script src="{{ asset('frontend/assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/jquery.fancybox.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/swiper.js') }}"></script>
<script src="{{ asset('frontend/assets/js/custom.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

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
