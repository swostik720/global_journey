
<script>
    function previewLogo(el, _target_el) {
        const target_el = document.getElementById(_target_el);
        const img_url = URL.createObjectURL(el.files[0]);
        target_el.children[0].setAttribute("src", img_url);
        target_el.style.display = "block"
    }

    function resetLogo() {
        const input_el = document.getElementById('logo');
        const target_el = document.getElementById("featured-logo");

        if (target_el.style.display === "block") {
            const markerInput = document.createElement('input');
            markerInput.type = 'hidden';
            markerInput.name = 'logo_removed';
            markerInput.value = 'true';
            input_el.form.appendChild(markerInput);
        }

        input_el.value = "";
        target_el.style.display = "none";
    }

    //for favicon
    function previewFavicon(el, _targetEl) {
        const targetEl = document.getElementById(_targetEl);
        const img_url = URL.createObjectURL(el.files[0]);
        targetEl.children[0].setAttribute("src", img_url);
        targetEl.style.display = "block"
    }

    function resetFavicon() {
        const inputEl = document.getElementById('favicon');
        const targetEl = document.getElementById("featured-favicon");

        if (targetEl.style.display === "block") {
            const markerInput = document.createElement('input');
            markerInput.type = 'hidden';
            markerInput.name = 'favicon_removed';
            markerInput.value = 'true';
            inputEl.form.appendChild(markerInput);
        }

        inputEl.value = "";
        targetEl.style.display = "none";
    }
</script>
