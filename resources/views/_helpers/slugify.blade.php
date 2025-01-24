<script>
    $(document).ready(function () {
        $("#{{$name}}").keyup($.debounce(250, function () {
            let Text = $(this).val();
            Text = Text.toLowerCase();
            Text = Text.replace(/[^a-zA-Z0-9]+/g, '-');
            $("#slug").val(Text);
        }));
    });
</script>
