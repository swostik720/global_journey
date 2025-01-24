<form class="touch enquiry-form_form" action="{{ route('enquiry.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-6 col-12">
            <input type="text" name="name" placeholder="Your Full name *" required>
        </div>
        <div class="col-md-6 col-12">
            <input type="email" name="email" placeholder="Email address *" required>
        </div>
        <div class="col-md-6 col-12">
            <input type="text" name="address" placeholder="Your Address" required>
        </div>
        <div class="col-md-6 col-12">
            <input type="number" name="phone" placeholder="Your Phone (optional)">
        </div>
        <div class="col-12">
            <select id="studyabroad_id" name="studyabroad_id">
                <option value="">Choose Your Study Course Destination:</option>
                @foreach ($studyabroads as $studyabroad)
                    <option value="{{ $studyabroad->id }}">{{ $studyabroad->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-xl-12">
            <textarea placeholder="Your message *" name="enquiry_message" required></textarea>
        </div>
        <div class="btugap">
            <button type="submit" class="themebtu full">Send Message</button>
        </div>
    </div>
</form>
