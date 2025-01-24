<script>
    $(function () {
        $('.select_two_model').select2({
            allowClear: true,
            placeholder: 'Select {{$model}}'
        });

        const isParentCheckBox = document.getElementById('is_parent');
        const selectBox = document.getElementById('parent_select');
        const select = document.getElementById('parent_id');

        if (document.querySelector('#is_parent').checked) {
            selectBox.classList.add('d-none');
        } else {
            selectBox.classList.remove('d-none');
        }

        isParentCheckBox.addEventListener('change', e => {
            if (e.target.checked === true) {
                selectBox.classList.add('d-none');
                select.value = '';
            } else {
                selectBox.classList.remove('d-none');
            }
        });
    })
</script>
