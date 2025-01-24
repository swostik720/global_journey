<!-- Core JS -->
<script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
<script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

<script src="{{ asset('assets/vendor/js/menu.js') }}"></script>

<!-- Main JS -->
<script src="{{ asset('assets/js/main.js') }}"></script>

<!-- Page JS -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>

<script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-throttle-debounce/1.1/jquery.ba-throttle-debounce.min.js"
    integrity="sha512-JZSo0h5TONFYmyLMqp8k4oPhuo6yNk9mHM+FY50aBjpypfofqtEWsAgRDQm94ImLCzSaHeqNvYuD9382CEn2zw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
@if (Session::has('success') || Session::has('error'))
    <script>
        Swal.fire({
            toast: true,
            position: 'top-end',
            timer: 6000,
            timerProgressBar: true,
            icon: '{{ session('success') ? 'success' : 'error' }}',
            title: '{{ session('success') ?? session('error') }}',
            showConfirmButton: false,
        })
    </script>
@endif

<script>
    $(document).ready(function() {
        $('.mark-as-read').click(function(e) {
            e.preventDefault();
            let notificationId = $(this).data('notification-id');
            let redirectUrl = $(this).data('redirect-url');

            $.ajax({
                url: '/notifications/' + notificationId,
                type: 'GET',
                success: function(data) {
                    window.location.href = redirectUrl;
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        });
    });
</script>

@stack('custom_js')

</body>

</html>
