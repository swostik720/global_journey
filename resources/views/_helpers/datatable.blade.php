<script type="text/javascript">
    $(function() {
        new DataTable("#datatable", {
            pageLength: 10,
            lengthMenu: [
                [10, 20, 50, -1],
                [10, 20, 50, 'All']
            ]
        });
        $('#select-all').on('click', function() {
            $('.select-row').prop('checked', $(this).prop('checked'));
        });

        $('#datatable').on('change', '.select-row', function() {
            if (!$(this).prop('checked')) {
                $('#select-all').prop('checked', false);
            } else if ($('.select-row:checked').length === $('.select-row').length) {
                $('#select-all').prop('checked', true);
            }
        });
    });
</script>
