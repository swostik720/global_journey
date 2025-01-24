<script>
    ClassicEditor
        .create(document.querySelector("#{{$textarea_id}}"), {
            removePlugins: ['CKFinderUploadAdapter', 'CKFinder', 'EasyImage', 'Image', 'ImageCaption', 'ImageStyle', 'ImageToolbar', 'MediaEmbed'],
        })
        .catch(error => {
            console.error(error);
        });
</script>
