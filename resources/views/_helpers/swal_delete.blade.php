<script>
    $(function() {
        $('#datatable').on('click', '.btn-delete', function(e) {
            e.preventDefault();
            let form = $(this).closest("form")

            Swal.fire({
                title: 'Are you sure?',
                text: "This item will be deleted" +
                    "!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            })
        });


        $('#datatable').on('click', '.btn-force-delete', function(e) {
            e.preventDefault();
            let form = $(this).closest("form")

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Eliminate it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            })
        });


        $('#bulk-delete').on('click', '.bulk-delete-btn', function(e) {
            e.preventDefault();
            let form = $(this).closest("form")

            let ids = [];
            $('.select-row:checked').each(function() {
                ids.push($(this).data('id'));
            });

            if (ids.length === 0) {
                Swal.fire('No data selected', 'Please select at least one data to delete', 'warning');
                return;
            }

            Swal.fire({
                title: 'Are you sure?',
                text: "Selected data will be deleted!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete them!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: form.attr('action'),
                        method: form.attr('method'),
                        data: {
                            _token: '{{ csrf_token() }}',
                            ids: ids
                        },
                        success: function(response) {
                            Swal.fire('Deleted!', response.message, 'success');
                            let table = $('#datatable').DataTable();
                            ids.forEach(function(id) {
                                table.row($('[data-id="' + id + '"]')
                                    .parents('tr')).remove().draw();
                            });

                        },
                        error: function(xhr) {
                            Swal.fire('Error',
                                'There was an error deleting the contacts',
                                'error');
                        }
                    });
                }
            });
        });
    })
</script>
