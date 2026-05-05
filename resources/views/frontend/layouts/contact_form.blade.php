@include('frontend.layouts.includes.premium_form_skin')

<form data-aos="fade-up" data-aos-delay="120" class="content-form contact-form__form gj-premium-form" action="{{ route('contact.store') }}" method="POST">
    @csrf
    <div class="row g-2">
        <div class="col-lg-6">
            <div class="input-group gj-premium-form__field">
                <input class="gj-premium-form__control" type="text" name="name" id="contact_name" required placeholder=" ">
                <label class="gj-premium-form__label" for="contact_name">Your Name *</label>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="input-group gj-premium-form__field">
                <input class="gj-premium-form__control" type="text" name="phone" id="contact_phone" required placeholder=" ">
                <label class="gj-premium-form__label" for="contact_phone">Your Phone *</label>
            </div>
        </div>
    </div>

    <div class="input-group gj-premium-form__field">
        <input class="gj-premium-form__control" type="text" name="email" id="contact_email" required placeholder=" ">
        <label class="gj-premium-form__label" for="contact_email">Your Email *</label>
    </div>

    <div class="input-group gj-premium-form__field">
        <input class="gj-premium-form__control" type="text" name="address" id="contact_address" placeholder=" ">
        <label class="gj-premium-form__label" for="contact_address">Your Address</label>
    </div>

    <div class="input-group gj-premium-form__field">
        <select name="interested_country" id="contact_interested_country" required>
            <option value="" disabled selected></option>
            @foreach (['United State', 'Canada', 'UK', 'Australia', 'Newzerland'] as $country)
                <option value="{{ $country }}" {{ isset($default_country) && $default_country == $country ? 'selected' : '' }}>
                    {{ $country }}
                </option>
            @endforeach
        </select>
        <label class="gj-premium-form__label" for="contact_interested_country">Interested Country *</label>
    </div>

    <div class="input-group gj-premium-form__field">
        <input class="gj-premium-form__control" type="text" name="last_qualification" id="contact_last_qualification" placeholder=" ">
        <label class="gj-premium-form__label" for="contact_last_qualification">Last Qualification (GPA/%)</label>
    </div>

    <div class="input-group gj-premium-form__field">
        <select name="test_preparation" id="contact_test_preparation">
            <option value="" disabled selected></option>
            @foreach (['IELTS', 'PTE'] as $test)
                <option value="{{ $test }}">{{ $test }}</option>
            @endforeach
        </select>
        <label class="gj-premium-form__label" for="contact_test_preparation">Test Preparation</label>
    </div>

    <div class="input-group gj-premium-form__field">
        <textarea name="contact_message" id="contact_message" required placeholder=" "></textarea>
        <label class="gj-premium-form__label" for="contact_message">Your Message *</label>
    </div>

    <div class="text-center mt-3 gj-premium-form__submit">
        <button class="themebtu">Submit</button>
    </div>
</form>
