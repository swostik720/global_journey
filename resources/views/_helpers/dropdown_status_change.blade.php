<script>
    $(document).on('change', 'select[name="user_status"]', function() {
        var id = $(this).data('id');
        $.ajax({
            url: '{{ $route }}'.replace(':id', id),
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                status: $(this).val()
            },
            success: function(data) {
                Swal.fire({
                    toast: true,
                    timer: 1500,
                    timerProgressBar: true,
                    position: 'top-end',
                    icon: 'success',
                    title: 'Status Changed Successfully',
                    showConfirmButton: false,
                });
            },
            error: function(xhr) {
                console.log(xhr.responseText);
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!',
                });
            }
        });
    });
</script>
