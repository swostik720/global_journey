<form class="content-form enrollNow-form__form" action="{{ route('enrollNow.store') }}" method="POST">
    @csrf
    <div class="row g-2">
        <div class="col-lg-6">
            <div class="input-group">
                <input type="text" name="name" id="enroll_name" required placeholder=" ">
                <label for="enroll_name">Your Name *</label>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="input-group">
                <input type="text" name="phone" id="enroll_phone" required placeholder=" ">
                <label for="enroll_phone">Your Phone *</label>
            </div>
        </div>
    </div>

    <div class="input-group">
        <input type="text" name="email" id="enroll_email" required placeholder=" ">
        <label for="enroll_email">Your Email *</label>
    </div>

    <div class="input-group" style="margin-bottom: 30px;">
        <select name="test_preparation_id" id="enroll_test_preparation" required>
            <option value="" disabled {{ empty($default_title) ? 'selected' : '' }}></option>
            @foreach ($testPreparationsOptions as $id => $title)
                <option value="{{ $id }}" {{ isset($default_title) && $default_title == $title ? 'selected' : '' }}>
                    {{ $title }}
                </option>
            @endforeach
        </select>
        <label for="enroll_test_preparation">Select Test Preparation *</label>
    </div>

    <div class="text-center mt-3">
        <button class="themebtu">Submit</button>
    </div>
</form>

<style>
/* Wrapper for input fields */
.enrollNow-form__form .input-group {
    position: relative;
    margin-bottom: 8px;
}

/* Inputs, Textareas, Selects */
.enrollNow-form__form input,
.enrollNow-form__form select {
    width: 100%;
    padding: 10px 12px;
    font-size: 14px;
    border: 1.5px solid #ddd;
    border-radius: 8px;
    background: #fff;
    color: #000;
    outline: none;
    transition: all 0.3s ease;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
}

/* Hover & Focus Glow + Lift */
.enrollNow-form__form input:hover,
.enrollNow-form__form select:hover,
.enrollNow-form__form input:focus,
.enrollNow-form__form select:focus {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(108, 99, 255, 0.25);
    border-color: #6c63ff;
    animation: pulse 1.5s infinite alternate;
}

/* Floating Labels */
.enrollNow-form__form label {
    position: absolute;
    top: 10px;
    left: 12px;
    color: #888;
    font-size: 13px;
    pointer-events: none;
    background: #fff;
    padding: 0 4px;
    border-radius: 4px;
    transition: 0.25s ease;
}

/* Move label when field is focused or filled */
.enrollNow-form__form input:focus + label,
.enrollNow-form__form input:not(:placeholder-shown) + label,
.enrollNow-form__form select:focus + label,
.enrollNow-form__form select:not([value=""]) + label {
    top: -6px;
    left: 10px;
    font-size: 11px;
    color: #6c63ff;
}

/* Custom dropdown arrow */
.enrollNow-form__form select {
    background-image: url("data:image/svg+xml,%3Csvg fill='gray' height='20' viewBox='0 0 24 24' width='20' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M7 10l5 5 5-5z'/%3E%3Cpath d='M0 0h24v24H0z' fill='none'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 12px center;
    background-size: 16px;
    padding-right: 36px; /* space for arrow */
}

/* Pulse animation */
@keyframes pulse {
    0% { box-shadow: 0 4px 12px rgba(108, 99, 255, 0.15); }
    100% { box-shadow: 0 6px 20px rgba(108, 99, 255, 0.25); }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const selects = document.querySelectorAll('.input-group select');

    selects.forEach(select => {
        function toggleFilled() {
            if (select.value) {
                select.classList.add('filled');
            } else {
                select.classList.remove('filled');
            }
        }

        // Check on load
        toggleFilled();

        // Check on change
        select.addEventListener('change', toggleFilled);
    });
});
</script>
