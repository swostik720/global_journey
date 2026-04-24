<form data-aos="fade-up" data-aos-delay="120" class="content-form contact-form__form" action="{{ route('contact.store') }}" method="POST">
    @csrf
    <div class="row g-2">
        <div class="col-lg-6">
            <div class="input-group">
                <input type="text" name="name" id="name" required placeholder=" ">
                <label for="name">Your Name *</label>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="input-group">
                <input type="text" name="phone" id="phone" required placeholder=" ">
                <label for="phone">Your Phone *</label>
            </div>
        </div>
    </div>

    <div class="input-group">
        <input type="text" name="email" id="email" required placeholder=" ">
        <label for="email">Your Email *</label>
    </div>

    <div class="input-group">
        <input type="text" name="address" id="address" placeholder=" ">
        <label for="address">Your Address</label>
    </div>

    <div class="input-group" style="margin-bottom: 30px;">
        <select name="interested_country" id="interested_country" required>
            <option value="" disabled selected></option>
            @foreach (['United State', 'Canada', 'UK', 'Australia', 'Newzerland'] as $country)
                <option value="{{ $country }}" {{ isset($default_country) && $default_country == $country ? 'selected' : '' }}>
                    {{ $country }}
                </option>
            @endforeach
        </select>
        <label for="interested_country">Interested Country *</label>
    </div>

    <div class="input-group">
        <input type="text" name="last_qualification" id="last_qualification" placeholder=" ">
        <label for="last_qualification">Last Qualification (GPA/%)</label>
    </div>

    <div class="input-group" style="margin-bottom: 30px;">
        <select name="test_preparation" id="test_preparation">
            <option value="" disabled selected></option>
            @foreach (['IELTS', 'PTE'] as $test)
                <option value="{{ $test }}">{{ $test }}</option>
            @endforeach
        </select>
        <label for="test_preparation">Test Preparation</label>
    </div>

    <div class="input-group">
        <textarea name="contact_message" id="contact_message" required placeholder=" "></textarea>
        <label for="contact_message">Your Message *</label>
    </div>

    <div class="text-center mt-3">
        <button class="themebtu">Submit</button>
    </div>
</form>

<style>
/* Wrapper for input fields */
.contact-form__form .input-group {
    position: relative;
    margin-bottom: 8px; /* tight spacing */
}

/* Inputs, Textareas, Selects */
.contact-form__form input,
.contact-form__form textarea,
.contact-form__form select {
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
.contact-form__form input:hover,
.contact-form__form textarea:hover,
.contact-form__form select:hover,
.contact-form__form input:focus,
.contact-form__form textarea:focus,
.contact-form__form select:focus {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(108, 99, 255, 0.25);
    border-color: #6c63ff;
    animation: pulse 1.5s infinite alternate;
}

/* Floating Labels */
.contact-form__form label {
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
.contact-form__form input:focus + label,
.contact-form__form input:not(:placeholder-shown) + label,
.contact-form__form textarea:focus + label,
.contact-form__form textarea:not(:placeholder-shown) + label,
.contact-form__form select:focus + label,
.contact-form__form select:not([value=""]) + label {
    top: -6px;
    left: 10px;
    font-size: 11px;
    color: #6c63ff;
}

/* Textarea */
.contact-form__form textarea {
    min-height: 80px;
    resize: vertical;
}

/* Placeholder */
.contact-form__form input::placeholder,
.contact-form__form textarea::placeholder {
    color: #888;
}

/* Custom dropdown arrow */
.contact-form__form select {
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
