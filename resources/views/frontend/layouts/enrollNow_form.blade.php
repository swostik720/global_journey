@include('frontend.layouts.includes.premium_form_skin')

<form data-aos="fade-up" data-aos-delay="120" class="content-form enrollNow-form__form gj-premium-form" action="{{ route('enrollNow.store') }}" method="POST">
    @csrf
    <div class="row g-2">
        <div class="col-lg-6">
            <div class="input-group gj-premium-form__field">
                <input class="gj-premium-form__control" type="text" name="name" id="enroll_name" required placeholder=" ">
                <label class="gj-premium-form__label" for="enroll_name">Your Name *</label>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="input-group gj-premium-form__field">
                <input class="gj-premium-form__control" type="text" name="phone" id="enroll_phone" required placeholder=" ">
                <label class="gj-premium-form__label" for="enroll_phone">Your Phone *</label>
            </div>
        </div>
    </div>

    <div class="input-group gj-premium-form__field">
        <input class="gj-premium-form__control" type="text" name="email" id="enroll_email" required placeholder=" ">
        <label class="gj-premium-form__label" for="enroll_email">Your Email *</label>
    </div>

    <div class="input-group gj-premium-form__field">
        <select name="test_preparation_id" id="enroll_test_preparation" required>
            <option value="" disabled {{ empty($default_title) && empty($default_test_preparation_id) ? 'selected' : '' }}></option>
            @foreach ($testPreparationsOptions as $id => $title)
                <option value="{{ $id }}"
                    {{ old('test_preparation_id') == $id ? 'selected' : '' }}
                    {{ isset($default_test_preparation_id) && (string) $default_test_preparation_id === (string) $id ? 'selected' : '' }}
                    {{ isset($default_title) && $default_title == $title && empty($default_test_preparation_id) ? 'selected' : '' }}>
                    {{ $title }}
                </option>
            @endforeach
        </select>
        <label class="gj-premium-form__label" for="enroll_test_preparation">Select Test Preparation *</label>
    </div>

    <div class="text-center mt-3 gj-premium-form__submit">
        <button class="themebtu">Submit</button>
    </div>
</form>
