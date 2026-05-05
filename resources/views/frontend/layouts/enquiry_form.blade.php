@include('frontend.layouts.includes.premium_form_skin')

<form data-aos="fade-up" data-aos-delay="120" class="enquiry-form_form gj-premium-form" action="{{ route('enquiry.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">

        <!-- Name -->
        <div class="col-md-6 col-12">
            <div class="input-group gj-premium-form__field">
                <input class="gj-premium-form__control" type="text" name="name" id="enquiry_name" required placeholder=" ">
                <label class="gj-premium-form__label" for="enquiry_name">Your Full Name *</label>
            </div>
        </div>

        <!-- Email -->
        <div class="col-md-6 col-12">
            <div class="input-group gj-premium-form__field">
                <input class="gj-premium-form__control" type="email" name="email" id="enquiry_email" required placeholder=" ">
                <label class="gj-premium-form__label" for="enquiry_email">Email Address *</label>
            </div>
        </div>

        <!-- Address -->
        <div class="col-md-6 col-12">
            <div class="input-group gj-premium-form__field">
                <input class="gj-premium-form__control" type="text" name="address" id="enquiry_address" required placeholder=" ">
                <label class="gj-premium-form__label" for="enquiry_address">Your Address *</label>
            </div>
        </div>

        <!-- Phone -->
        <div class="col-md-6 col-12">
            <div class="input-group gj-premium-form__field">
                <input class="gj-premium-form__control" type="number" name="phone" id="enquiry_phone" placeholder=" ">
                <label class="gj-premium-form__label" for="enquiry_phone">Your Phone (optional)</label>
            </div>
        </div>

        <!-- Study Destination -->
        <div class="col-12">
            <div class="input-group gj-premium-form__field">
                <select id="studyabroad_id" name="studyabroad_id" required>
                    <option value="" disabled selected></option>
                    @foreach ($studyabroads as $studyabroad)
                        <option value="{{ $studyabroad->id }}">{{ $studyabroad->title }}</option>
                    @endforeach
                </select>
                <label class="gj-premium-form__label" for="studyabroad_id">Choose Your Study Destination</label>
            </div>
        </div>

        <!-- Message -->
        <div class="col-12">
            <div class="input-group gj-premium-form__field">
                <textarea name="enquiry_message" id="enquiry_message" required placeholder=" "></textarea>
                <label class="gj-premium-form__label" for="enquiry_message">Your Message *</label>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="btugap col-12 text-center gj-premium-form__submit">
            <button type="submit" class="themebtu">Send Message</button>
        </div>
    </div>
</form>
