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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if (Session::has('success') || Session::has('error'))
    <style>
        .gj-toast-container.swal2-container {
            z-index: 99999 !important;
            padding-top: 88px !important;
            padding-right: 16px !important;
            padding-left: 16px !important;
        }

        .gj-toast-popup.swal2-popup.swal2-toast {
            width: min(420px, calc(100vw - 24px)) !important;
            border-radius: 16px !important;
            border: 1px solid rgba(147, 197, 253, 0.35) !important;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.97) 0%, rgba(240, 247, 255, 0.97) 100%) !important;
            box-shadow: 0 20px 38px rgba(12, 37, 92, 0.22), 0 8px 18px rgba(29, 78, 216, 0.15) !important;
            backdrop-filter: blur(6px);
            padding: 14px 14px 14px 14px !important;
        }

        .gj-toast-title.swal2-title {
            margin: 0 !important;
            color: #0f2454 !important;
            font-size: 14px !important;
            font-weight: 700 !important;
            line-height: 1.45 !important;
            letter-spacing: 0.01em;
        }

        .gj-toast-popup .swal2-icon {
            margin: 0 10px 0 0 !important;
        }

        .gj-toast-popup .swal2-timer-progress-bar {
            background: linear-gradient(90deg, #0f2454 0%, #2563eb 60%, #60a5fa 100%) !important;
            height: 4px !important;
        }

        @media (max-width: 767px) {
            .gj-toast-container.swal2-container {
                padding-top: 80px !important;
            }

            .gj-toast-title.swal2-title {
                font-size: 13px !important;
            }
        }
    </style>

    <script>
        const toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            customClass: {
                container: 'gj-toast-container',
                popup: 'gj-toast-popup',
                title: 'gj-toast-title',
            },
            background: 'transparent',
            showClass: {
                popup: 'animate__animated animate__fadeInDown',
            },
            hideClass: {
                popup: 'animate__animated animate__fadeOutUp',
            },
            timer: 9000,
            timerProgressBar: true,
            showConfirmButton: false,
            didOpen: (el) => {
                el.addEventListener('mouseenter', Swal.stopTimer);
                el.addEventListener('mouseleave', Swal.resumeTimer);
            },
        });

        toast.fire({
            icon: @json(session('success') ? 'success' : 'error'),
            title: @json(session('success') ?? session('error')),
        });
    </script>
@endif
