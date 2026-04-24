<form data-aos="fade-up" data-aos-delay="120" class="enquiry-form_form" action="{{ route('enquiry.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">

        <!-- Name -->
        <div class="col-md-6 col-12">
            <div class="input-group">
                <input type="text" name="name" id="name" required placeholder=" ">
                <label for="name">Your Full Name *</label>
            </div>
        </div>

        <!-- Email -->
        <div class="col-md-6 col-12">
            <div class="input-group">
                <input type="email" name="email" id="email" required placeholder=" ">
                <label for="email">Email Address *</label>
            </div>
        </div>

        <!-- Address -->
        <div class="col-md-6 col-12">
            <div class="input-group">
                <input type="text" name="address" id="address" required placeholder=" ">
                <label for="address">Your Address *</label>
            </div>
        </div>

        <!-- Phone -->
        <div class="col-md-6 col-12">
            <div class="input-group">
                <input type="number" name="phone" id="phone" placeholder=" ">
                <label for="phone">Your Phone (optional)</label>
            </div>
        </div>

        <!-- Study Destination -->
        <div class="col-12">
            <div class="input-group">
                <select id="studyabroad_id" name="studyabroad_id" required>
                    <option value="" disabled selected></option>
                    @foreach ($studyabroads as $studyabroad)
                        <option value="{{ $studyabroad->id }}">{{ $studyabroad->title }}</option>
                    @endforeach
                </select>
                <label for="studyabroad_id">Choose Your Study Destination</label>
            </div>
        </div>

        <!-- Message -->
        <div class="col-12">
            <div class="input-group">
                <textarea name="enquiry_message" id="enquiry_message" required placeholder=" "></textarea>
                <label for="enquiry_message">Your Message *</label>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="btugap col-12 text-center">
            <button type="submit" class="themebtu">Send Message</button>
        </div>
    </div>
</form>
