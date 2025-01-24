<form class="content-form contact-form__form" action="{{ route('contact.store') }}" method="POST">
    @csrf
    <div class="row">
        <div class="col-lg-6">
            <input type="text" name="name" placeholder="Your Name *" required>
        </div>
        <div class="col-lg-6">
            <input type="text" name="phone" placeholder="Your Phone *" required>
        </div>
    </div>
    <input type="text" name="email" placeholder="Your Email *" required>
    <textarea placeholder="Your Message *" name="contact_message" required></textarea>
    <button class="themebtu">Submit</button>
</form>
