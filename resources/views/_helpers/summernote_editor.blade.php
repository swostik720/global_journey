<script src="{{ asset('vendor/summernote/summernote.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#description').summernote({
            placeholder: 'Content here...',
            tabsize: 2,
            height: 300,
            codeviewFilter: false,
            codeviewIframeFilter: true,
            minHeight: null,
            maxHeight: null,
            focus: true,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript', 'fontsize', 'color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']]
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video', 'hr']],
                ['view', ['codeview', 'help']],
            ],
            styleTags: [
                'p',
                {
                    title: 'Blockquote',
                    tag: 'blockquote',
                    className: 'blockquote',
                    value: 'blockquote'
                },
                'pre', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6'
            ],

        });
    });
</script>
