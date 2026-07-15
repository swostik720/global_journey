<link rel="stylesheet" href="{{ asset('css/contact-speed-dial.css') }}">

<div class="gj-speed-dial" id="gjSpeedDial" role="navigation" aria-label="Quick contact options">
    <div class="gj-speed-dial__backdrop" aria-hidden="true"></div>

    <button class="gj-speed-dial__toggle"
            id="gjSpeedDialToggle"
            aria-label="Open quick contact options"
            aria-haspopup="true"
            aria-expanded="false"
            type="button">
        <i class="fas fa-comment-dots gj-icon-chat" aria-hidden="true"></i>
        <i class="fas fa-times gj-icon-close" aria-hidden="true"></i>
    </button>

    <div class="gj-speed-dial__menu" role="menu" aria-labelledby="gjSpeedDialToggle">
        <ul class="gj-speed-dial__grid">
            <li class="gj-speed-dial__item" role="none">
                <a href="https://www.m.me/Globaljourney2018"
                   class="gj-speed-dial__link"
                   role="menuitem"
                   target="_blank"
                   rel="noopener noreferrer"
                   aria-label="Contact us on Facebook Messenger">
                    <span class="gj-speed-dial__icon" style="background: linear-gradient(135deg, #1a3c6e, #2557a7);">
                        <i class="fab fa-facebook-messenger" aria-hidden="true"></i>
                    </span>
                    <span class="gj-speed-dial__label">Messenger</span>
                </a>
            </li>

            <li class="gj-speed-dial__item" role="none">
                <a href="tel:+9779843215204"
                   class="gj-speed-dial__link"
                   role="menuitem"
                   aria-label="Call us at +977 9843215204">
                    <span class="gj-speed-dial__icon" style="background: linear-gradient(135deg, #f97316, #fb923c);">
                        <i class="fas fa-phone-alt" aria-hidden="true"></i>
                    </span>
                    <span class="gj-speed-dial__label">Phone Call</span>
                </a>
            </li>

            <li class="gj-speed-dial__item" role="none">
                <a href="/contact-us"
                   class="gj-speed-dial__link"
                   role="menuitem"
                   aria-label="Open contact form">
                    <span class="gj-speed-dial__icon" style="background: linear-gradient(135deg, #130074, #d946ef);">
                        <i class="fas fa-envelope" aria-hidden="true"></i>
                    </span>
                    <span class="gj-speed-dial__label">Contact Form</span>
                </a>
            </li>

            <li class="gj-speed-dial__item" role="none">
                <a href="https://wa.me/9843215204?text=Hello%2C%20I%20would%20like%20to%20know%20more%20about%20your%20services."
                   class="gj-speed-dial__link"
                   role="menuitem"
                   target="_blank"
                   rel="noopener noreferrer"
                   aria-label="Chat with us on WhatsApp">
                    <span class="gj-speed-dial__icon" style="background: linear-gradient(135deg, #25d366, #34d96f);">
                        <i class="fab fa-whatsapp" aria-hidden="true"></i>
                    </span>
                    <span class="gj-speed-dial__label">WhatsApp</span>
                </a>
            </li>
        </ul>
    </div>
</div>

<script src="{{ asset('js/contact-speed-dial.js') }}" defer></script>
