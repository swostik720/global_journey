<!-- resources/views/includes/header.blade.php -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>

<style>
/* ---------- Header ---------- */
body {
  padding-top: 70px; /* equal to header height + some margin */
}

._header {
  background: #fff;
  position: fixed;
  top: 0;
  width: 100%;
  z-index: 1000;
  box-shadow: 0 2px 8px rgba(0,0,0,0.06);
}
._header .container {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 8px 20px;
  max-width: 1400px;
  margin: 0 auto;
}
._logo img { width: 180px; max-width:100%; height:auto; }

/* ---------- Main Navigation ---------- */
.desktop_header {
  display: flex;
  align-items: center;
  width: 100%;
}
.header_menu {
  display: flex;
  gap: 20px;
  list-style: none;
  margin: 0;
  padding: 0;
  align-items: center;
  margin-left: auto;
}
.header_item { position: relative; }
.header_item > a {
  color: #111;
  font-weight: 600;
  font-size: 15px;
  text-decoration: none;
  white-space: nowrap;
  transition: color 0.3s ease;
  cursor: pointer;
}
.header_item > a:hover {
  color: #2563eb;
}
.header_item > i.fa-angle-down {
  margin-left: 6px;
  font-size: 11px;
  color: #666;
  cursor: pointer;
  transition: transform 0.3s ease;
}
.header_item:hover > i.fa-angle-down {
  transform: rotate(180deg);
}

/* Hamburger button */
._btn {
  cursor: pointer;
  font-size: 24px;
  color: #111;
  transition: color 0.3s ease;
}
._btn:hover {
  color: #2563eb;
}

/* ---------- Dropdown (Desktop) ---------- */
.header_submenu {
  position: absolute;
  top: calc(100% + 12px);
  left: 0;
  background: #fff;
  border-radius: 8px;
  box-shadow: 0 8px 24px rgba(0,0,0,0.12);
  padding: 8px 0;
  min-width: 220px;
  display: none;
  opacity: 0;
  transform: translateY(10px);
  transition: all 0.3s ease;
  z-index: 1200;
}
.header_item:hover > .header_submenu {
  display: block;
  opacity: 1;
  transform: translateY(0);
}
.header_submenu li {
  padding: 10px 18px;
  transition: background 0.3s;
}
.header_submenu li:hover {
  background: #f0f7ff;
}
.header_submenu li a {
  color: #222;
  font-weight: 500;
  font-size: 14px;
  text-decoration: none;
  display: flex;
  align-items: center;
  gap: 8px;
  transition: color 0.3s ease;
}
.header_submenu li a:hover {
  color: #2563eb;
}
.header_submenu li a i {
  color: #2563eb;
  font-size: 13px;
}

/* ---------- Overlay Panels ---------- */
.overlay-panel {
  position: fixed;
  top: 0;
  right: 0;
  height: 100vh;
  width: 420px;
  background: #f8fafc;
  transform: translateX(110%);
  transition: transform .35s cubic-bezier(.2,.8,.2,1);
  z-index: 1200;
  overflow-y: auto;
  padding: 30px 40px;
  box-sizing: border-box;
}
.overlay-panel.active { transform: translateX(0); }

/* Close button */
.overlay-close {
  position: absolute;
  right: 20px;
  top: 20px;
  font-size: 26px;
  color: #333;
  cursor: pointer;
  transition: color 0.3s ease;
}
.overlay-close:hover {
  color: #2563eb;
}

/* Overlay list */
.overlay-list {
  list-style: none;
  padding: 80px 0 60px 0;
  margin: 0;
}
.overlay-list > li {
  margin-bottom: 20px;
}
.overlay-list > li > a {
  text-decoration: none;
  color: #111;
  font-size: 18px;
  font-weight: 700;
  transition: color 0.3s ease;
  display: inline-block;
}
.overlay-list > li > a:hover {
  color: #2563eb;
}

/* Dropdown toggle icon in overlay */
.overlay-list > li > i.fa-angle-down {
  margin-left: 8px;
  font-size: 14px;
  color: #666;
  cursor: pointer;
  transition: transform 0.3s ease;
}
.overlay-list > li > i.fa-angle-down.active {
  transform: rotate(180deg);
}

/* Overlay submenu */
.overlay-sub {
  margin-top: 12px;
  list-style: none;
  padding-left: 20px;
  border-left: 3px solid rgba(37,99,235,0.3);
  max-height: 0;
  overflow: hidden;
  opacity: 0;
  transition: all 0.4s ease;
}
.overlay-sub.active {
  max-height: 500px;
  opacity: 1;
  margin-bottom: 10px;
}
.overlay-sub li {
  margin: 8px 0;
}
.overlay-sub li a {
  font-weight: 600;
  font-size: 15px;
  color: #444;
  text-decoration: none;
  transition: all 0.3s ease;
  display: inline-block;
}
.overlay-sub li a:hover {
  color: #2563eb;
  transform: translateX(4px);
}

/* ---------- Animations ---------- */
@keyframes slideDown {
  from { opacity: 0; transform: translateY(-10px); }
  to { opacity: 1; transform: translateY(0); }
}

/* ---------- Mobile adjustments ---------- */
@media (max-width: 992px) {
  .desktop_header { display: none; }
  .desktop_mobile { display: flex !important; }
  .overlay-panel {
    width: 100%;
    padding: 20px;
  }
  ._logo img { width: 160px; }
  ._header .container {
    padding: 8px 15px;
  }
}

/* Show overlays properly */
.overlay-desktop { display: block; }
.overlay-mobile { display: none; }
@media (max-width: 992px) {
  .overlay-desktop { display: none; }
  .overlay-mobile { display: block; }
}
</style>

<div class="_header">
  <div class="container">
    <!-- Desktop Header -->
    <section data-aos="fade-up" class="desktop_header">
      <!-- Logo Left -->
      <div class="_logo">
        @if (is_object($setting) && isset($setting->logo))
          <a href="{{ url('/') }}">
            <img src="{{ asset('uploaded-images/site-setting-images/' . $setting->logo) }}" alt="logo">
          </a>
        @else
          <a href="{{ url('/') }}">
            <img src="{{ asset('frontend/global-journey/assets/img/logo.png') }}" alt="logo">
          </a>
        @endif
      </div>

      <!-- Desktop menu Right -->
      <ul class="header_menu">
        <li class='header_item'><a href="{{ url('/') }}">Home</a></li>
        <li class='header_item'><a href="{{ route('about-us') }}">About Us</a></li>
        <li class='header_item'>
          <a href="{{ route('study-abroad') }}">Study Abroad</a>
          <i class="fa-solid fa-angle-down"></i>
          <ul class="header_submenu">
            @foreach ($studyabroads ?? collect() as $studyabroad)
              <li><a href="{{ route('study-abroad.details', $studyabroad->slug) }}">{{ $studyabroad->title }}</a></li>
            @endforeach
          </ul>
        </li>
        <li class='header_item'><a href="{{ route('blogs') }}">Blog</a></li>
        <li class='header_item'><a href="{{ route('galleries.index') }}">Gallery</a></li>
        <li class='header_item'><a href="{{ route('contact-us') }}">Contact Us</a></li>
        <li class='header_item'>
          <div class="_btn" id="open_overlay_btn"><i class="fa-solid fa-bars"></i></div>
        </li>
      </ul>
    </section>

    <!-- Mobile Header -->
    <section data-aos="fade-up" class="desktop_mobile" style="display:none; align-items:center; width:100%; justify-content:space-between;">
      <div class="_logo">
        @if (is_object($setting) && isset($setting->logo))
          <a href="{{ url('/') }}"><img src="{{ asset('uploaded-images/site-setting-images/' . $setting->logo) }}" alt="logo"></a>
        @else
          <a href="{{ url('/') }}"><img src="{{ asset('frontend/global-journey/assets/img/logo.png') }}" alt="logo"></a>
        @endif
      </div>
      <div class="_btn" id="open_overlay_btn_mobile"><i class="fa-solid fa-bars"></i></div>
    </section>
  </div>
</div>

<!-- Desktop Overlay -->
<aside id="overlay_desktop" class="overlay-panel overlay-desktop" aria-hidden="true" role="dialog">
  <div class="_logo">
    @if (is_object($setting) && isset($setting->logo))
      <a href="{{ url('/') }}"><img src="{{ asset('uploaded-images/site-setting-images/' . $setting->logo) }}" alt="logo"></a>
    @else
      <a href="{{ url('/') }}"><img src="{{ asset('frontend/global-journey/assets/img/logo.png') }}" alt="logo"></a>
    @endif
  </div>
  <i class="fa-solid fa-xmark overlay-close" id="overlay_close_desktop"></i>
  <ul class="overlay-list">
    <li>
      <a href="{{ route('test-preparation') }}">Test Preparation</a>
      <i class="fa-solid fa-angle-down dropdown-toggle"></i>
      <ul class="overlay-sub">
        @foreach ($testpreparations ?? collect() as $testpreparation)
          <li><a href="{{ route('test-preparation.details', $testpreparation->slug) }}">{{ $testpreparation->title }}</a></li>
        @endforeach
      </ul>
    </li>
    <li>
      <a href="#">Medical & NOC</a>
      <i class="fa-solid fa-angle-down dropdown-toggle"></i>
      <ul class="overlay-sub">
        <li><a href="https://patient.norvichospital.com/doctor/slot/PPHY/0" target="_blank">Norvic</a></li>
        <li><a href="https://mymedical.iom.int/apps/omas/#_frmHome" target="_blank">IOM</a></li>
        <li><a href="https://noc.moest.gov.np/login" target="_blank">NOC</a></li>
      </ul>
    </li>
    <li>
      <a href="{{ route('interview-preparation') }}">Interview Preparation</a>
      <i class="fa-solid fa-angle-down dropdown-toggle"></i>
      <ul class="overlay-sub">
        @foreach ($interviewPreparations ?? collect() as $interview)
          <li><a href="{{ route('interview-preparation.details', $interview->slug) }}">{{ $interview->title }}</a></li>
        @endforeach
      </ul>
    </li>
  </ul>
</aside>

<!-- Mobile Overlay -->
<aside id="overlay_mobile" class="overlay-panel overlay-mobile" aria-hidden="true" role="dialog">
  <div class="_logo">
    @if (is_object($setting) && isset($setting->logo))
      <a href="{{ url('/') }}"><img src="{{ asset('uploaded-images/site-setting-images/' . $setting->logo) }}" alt="logo"></a>
    @else
      <a href="{{ url('/') }}"><img src="{{ asset('frontend/global-journey/assets/img/logo.png') }}" alt="logo"></a>
    @endif
  </div>
  <i class="fa-solid fa-xmark overlay-close" id="overlay_close_mobile"></i>
  <ul class="overlay-list">
    <li><a href="{{ url('/') }}">Home</a></li>
    <li><a href="{{ route('about-us') }}">About Us</a></li>
    <li>
      <a href="{{ route('study-abroad') }}">Study Abroad</a>
      <i class="fa-solid fa-angle-down dropdown-toggle"></i>
      <ul class="overlay-sub">
        @foreach ($studyabroads ?? collect() as $studyabroad)
          <li><a href="{{ route('study-abroad.details', $studyabroad->slug) }}">{{ $studyabroad->title }}</a></li>
        @endforeach
      </ul>
    </li>
    <li>
      <a href="{{ route('test-preparation') }}">Test Preparation</a>
      <i class="fa-solid fa-angle-down dropdown-toggle"></i>
      <ul class="overlay-sub">
        @foreach ($testpreparations ?? collect() as $testpreparation)
          <li><a href="{{ route('test-preparation.details', $testpreparation->slug) }}">{{ $testpreparation->title }}</a></li>
        @endforeach
      </ul>
    </li>
    <li>
      <a href="#">Medical & NOC</a>
      <i class="fa-solid fa-angle-down dropdown-toggle"></i>
      <ul class="overlay-sub">
        <li><a href="https://patient.norvichospital.com/doctor/slot/PPHY/0" target="_blank">Norvic</a></li>
        <li><a href="https://mymedical.iom.int/apps/omas/#_frmHome" target="_blank">IOM</a></li>
        <li><a href="https://noc.moest.gov.np/login" target="_blank">NOC</a></li>
      </ul>
    </li>
    <li>
      <a href="{{ route('interview-preparation') }}">Interview Preparation</a>
      <i class="fa-solid fa-angle-down dropdown-toggle"></i>
      <ul class="overlay-sub">
        @foreach ($interviewPreparations ?? collect() as $interview)
          <li><a href="{{ route('interview-preparation.details', $interview->slug) }}">{{ $interview->title }}</a></li>
        @endforeach
      </ul>
    </li>
    <li><a href="{{ route('blogs') }}">Blogs</a></li>
    <li><a href="{{ route('galleries.index') }}">Gallery</a></li>
    <li><a href="{{ route('contact-us') }}">Contact Us</a></li>
  </ul>
</aside>

<script>
document.addEventListener('DOMContentLoaded', () => {
  const overlayDesktop = document.getElementById('overlay_desktop');
  const overlayMobile = document.getElementById('overlay_mobile');
  const openBtn = document.getElementById('open_overlay_btn');
  const openBtnMobile = document.getElementById('open_overlay_btn_mobile');
  const closeDesktop = document.getElementById('overlay_close_desktop');
  const closeMobile = document.getElementById('overlay_close_mobile');

  function openOverlay() {
    if (window.innerWidth <= 992) {
      overlayMobile.classList.add('active');
    } else {
      overlayDesktop.classList.add('active');
    }
    document.body.style.overflow = 'hidden';
  }

  function closeOverlay() {
    overlayDesktop.classList.remove('active');
    overlayMobile.classList.remove('active');
    document.body.style.overflow = '';
  }

  openBtn?.addEventListener('click', openOverlay);
  openBtnMobile?.addEventListener('click', openOverlay);
  closeDesktop?.addEventListener('click', closeOverlay);
  closeMobile?.addEventListener('click', closeOverlay);

  document.addEventListener('keydown', e => {
    if (e.key === 'Escape') closeOverlay();
  });

  // Dropdown toggle functionality for overlay panels
  function setupDropdowns(overlayElement) {
    const dropdownToggles = overlayElement.querySelectorAll('.dropdown-toggle');

    dropdownToggles.forEach(toggle => {
      toggle.addEventListener('click', function(e) {
        e.stopPropagation();
        const submenu = this.nextElementSibling;

        // Close other open dropdowns
        const allSubmenus = overlayElement.querySelectorAll('.overlay-sub');
        const allToggles = overlayElement.querySelectorAll('.dropdown-toggle');

        allSubmenus.forEach(menu => {
          if (menu !== submenu) {
            menu.classList.remove('active');
          }
        });

        allToggles.forEach(t => {
          if (t !== this) {
            t.classList.remove('active');
          }
        });

        // Toggle current dropdown
        if (submenu) {
          submenu.classList.toggle('active');
          this.classList.toggle('active');
        }
      });
    });
  }

  // Setup dropdowns for both overlays
  setupDropdowns(overlayDesktop);
  setupDropdowns(overlayMobile);
});
</script>
