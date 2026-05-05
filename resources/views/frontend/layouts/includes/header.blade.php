<style>
body {
    padding-top: 94px;
}

.gj-header {
    position: fixed;
    inset: 0 0 auto;
    z-index: 1300;
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(10px);
    border-bottom: 1px solid rgba(15, 36, 96, 0.08);
    transition: box-shadow 0.22s ease, background-color 0.22s ease;
}

.gj-header.is-scrolled {
    box-shadow: 0 12px 24px rgba(15, 41, 95, 0.12);
    background: rgba(255, 255, 255, 0.97);
}

.gj-header__container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 14px 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 24px;
}

.gj-logo img {
    width: 185px;
    max-width: 100%;
    height: auto;
}

.gj-nav {
    display: flex;
    align-items: center;
    gap: 26px;
    margin-left: auto;
}

.gj-nav__list {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
    align-items: center;
    gap: 22px;
}

.gj-nav__item {
    position: relative;
    display: flex;
    align-items: center;
    gap: 6px;
}

.gj-nav__item>a {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    text-decoration: none;
    color: #0f172a;
    font-size: 14px;
    font-weight: 600;
    letter-spacing: 0.01em;
    transition: color 0.2s ease;
}

.gj-nav__item>a:hover,
.gj-nav__item>a:focus-visible {
    color: #1d4ed8;
}

.gj-nav__chevron {
    font-size: 11px;
    color: #64748b;
    transition: transform 0.22s ease, color 0.22s ease;
}

.gj-nav__toggle:hover .gj-nav__chevron,
.gj-nav__toggle:focus-visible .gj-nav__chevron {
    transform: rotate(180deg);
    color: #1d4ed8;
}

.gj-submenu {
    list-style: none;
    margin: 0;
    padding: 10px 0;
    position: absolute;
    top: calc(100% + 14px);
    left: 0;
    min-width: 260px;
    background: #fff;
    border-radius: 12px;
    border: 1px solid #e2e8f0;
    box-shadow: 0 20px 34px rgba(15, 41, 95, 0.16);
    opacity: 0;
    visibility: hidden;
    transform: translateY(8px);
    transition: opacity 0.22s ease, transform 0.22s ease, visibility 0.22s ease;
    z-index: 1310;
}

.gj-nav__toggle {
    width: 26px;
    height: 26px;
    border: 0;
    background: transparent;
    color: #64748b;
    border-radius: 8px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: color 0.2s ease, background-color 0.2s ease;
}

.gj-nav__toggle:hover,
.gj-nav__toggle:focus-visible {
    color: #1d4ed8;
    background: #eaf2ff;
}

.gj-nav__item--has-sub.is-open .gj-submenu {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

.gj-submenu li a {
    display: block;
    padding: 11px 16px;
    color: #334155;
    text-decoration: none;
    font-size: 13px;
    font-weight: 500;
    line-height: 1.4;
    transition: background-color 0.2s ease, color 0.2s ease, padding-left 0.2s ease;
}

.gj-submenu li a:hover,
.gj-submenu li a:focus-visible {
    color: #1e40af;
    background: #f0f6ff;
    padding-left: 20px;
}

.gj-cta {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    border-radius: 999px;
    padding: 10px 16px;
    text-decoration: none;
    font-size: 13px;
    font-weight: 700;
    letter-spacing: 0.01em;
    color: #fff;
    background: linear-gradient(135deg, #0038A6, #0046C4, #0058E8, #003070, #001F50);
    box-shadow: 0 8px 18px rgba(15, 41, 95, 0.2);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.gj-cta:hover,
.gj-cta:focus-visible {
    color: #fff;
    transform: translateY(-2px);
    box-shadow: 0 14px 24px rgba(15, 41, 95, 0.28);
}

.gj-menu-btn {
    border: 1px solid #d9e4f7;
    background: #fff;
    color: #0f172a;
    width: 44px;
    height: 44px;
    border-radius: 12px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.22s ease;
}

.gj-menu-btn:hover,
.gj-menu-btn:focus-visible {
    color: #1d4ed8;
    border-color: #93c5fd;
    background: #eff6ff;
}

.gj-menu-btn .bi-list,
.gj-menu-btn .bi-x-lg {
    font-size: 18px;
}

.gj-mobile-trigger {
    display: none;
}

.gj-backdrop {
    position: fixed;
    inset: 0;
    background: rgba(2, 6, 23, 0.45);
    opacity: 0;
    visibility: hidden;
    transition: opacity 0.25s ease, visibility 0.25s ease;
    z-index: 1390;
}

.gj-backdrop.active {
    opacity: 1;
    visibility: visible;
}

.gj-drawer {
    position: fixed;
    top: 0;
    right: 0;
    width: min(430px, 100vw);
    height: 100vh;
    background: #f8fbff;
    transform: translateX(104%);
    transition: transform 0.32s cubic-bezier(0.2, 0.8, 0.2, 1);
    z-index: 1400;
    overflow-y: auto;
    border-left: 1px solid #d9e4f7;
    display: flex;
    flex-direction: column;
}

.gj-drawer.active {
    transform: translateX(0);
}

.gj-drawer__head {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 18px 20px;
    border-bottom: 1px solid #e2e8f0;
    background: #fff;
    position: sticky;
    top: 0;
    z-index: 1;
}

.gj-drawer__body {
    padding: 18px 20px 12px;
}

.gj-drawer-links {
    list-style: none;
    margin: 0;
    padding: 0;
    display: grid;
    gap: 8px;
}

.gj-drawer-links>li>a {
    display: block;
    text-decoration: none;
    color: #0f172a;
    font-size: 16px;
    font-weight: 700;
    border-radius: 10px;
    padding: 12px 12px;
    transition: background-color 0.2s ease, color 0.2s ease;
}

.gj-drawer-links>li>a:hover,
.gj-drawer-links>li>a:focus-visible {
    background: #ecf4ff;
    color: #1d4ed8;
}

.gj-acc {
    border-radius: 12px;
    border: 1px solid #dce6f7;
    background: #fff;
    overflow: hidden;
}

.gj-acc__head {
    width: 100%;
    border: 0;
    background: #fff;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
    padding: 14px 12px;
    cursor: pointer;
    color: #0f172a;
    font-size: 16px;
    font-weight: 700;
    text-align: left;
    transition: background-color 0.2s ease, color 0.2s ease;
}

.gj-acc__head-wrap {
    display: grid;
    grid-template-columns: 1fr auto;
    align-items: stretch;
    border-bottom: 1px solid #e6edf9;
}

.gj-acc__title-link {
    display: flex;
    align-items: center;
    padding: 14px 12px;
    color: #0f172a;
    text-decoration: none;
    font-size: 16px;
    font-weight: 700;
    transition: background-color 0.2s ease, color 0.2s ease;
}

.gj-acc__title-link:hover,
.gj-acc__title-link:focus-visible {
    background: #ecf4ff;
    color: #1d4ed8;
}

.gj-acc__head-wrap .gj-acc__head {
    width: 48px;
    justify-content: center;
    padding: 0;
    border-left: 1px solid #e6edf9;
}

.gj-acc__head:hover,
.gj-acc__head:focus-visible {
    background: #ecf4ff;
    color: #1d4ed8;
}

.gj-acc__icon {
    font-size: 13px;
    color: #64748b;
    transition: transform 0.2s ease;
}

.gj-acc.is-open .gj-acc__icon {
    transform: rotate(180deg);
    color: #1d4ed8;
}

.gj-acc__panel {
    list-style: none;
    margin: 0;
    padding: 0 10px;
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.28s ease;
}

.gj-acc.is-open .gj-acc__panel {
    max-height: 340px;
    padding-bottom: 10px;
}

.gj-acc__panel li a {
    display: block;
    text-decoration: none;
    color: #334155;
    padding: 10px 10px;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    transition: all 0.2s ease;
}

.gj-acc__panel li a:hover,
.gj-acc__panel li a:focus-visible {
    color: #1d4ed8;
    background: #f0f6ff;
    transform: translateX(2px);
}

.gj-drawer__cta {
    margin-top: auto;
    padding: 16px 20px 24px;
    display: grid;
    gap: 10px;
    background: linear-gradient(180deg, rgba(248, 251, 255, 0) 0%, rgba(248, 251, 255, 1) 25%);
}

.gj-drawer__cta .gj-cta,
.gj-drawer__cta .gj-cta-alt {
    width: 100%;
    text-align: center;
    justify-content: center;
}

.gj-cta-alt {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 999px;
    padding: 10px 16px;
    border: 1px solid #c8daf7;
    background: #fff;
    color: #1e40af;
    text-decoration: none;
    font-size: 13px;
    font-weight: 700;
    transition: all 0.2s ease;
}

.gj-cta-alt:hover,
.gj-cta-alt:focus-visible {
    background: #eff6ff;
    color: #1d4ed8;
}

.gj-mobile-only {
    display: block;
}

.gj-desktop-only {
    display: none;
}

@media (max-width: 1100px) {
    .gj-nav {
        gap: 16px;
    }

    .gj-nav__list {
        gap: 15px;
    }
}

@media (max-width: 992px) {
    body {
        padding-top: 78px;
    }

    .gj-header__container {
        padding: 10px 14px;
    }

    .gj-logo img {
        width: 160px;
    }

    .gj-nav {
        display: none;
    }

    .gj-mobile-trigger {
        display: inline-flex;
    }

    .gj-drawer {
        width: 100vw;
    }
}

@media (min-width: 993px) {
    .gj-mobile-only {
        display: none;
    }

    .gj-desktop-only {
        display: block;
    }
}
</style>

<header class="gj-header" id="gjHeader">
    <div class="gj-header__container">
        <div class="gj-logo">
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

        <nav class="gj-nav" aria-label="Primary">
            <ul class="gj-nav__list">
                <li class="gj-nav__item"><a href="{{ url('/') }}">Home</a></li>
                <li class="gj-nav__item"><a href="{{ route('about-us') }}">About Us</a></li>
                <li class="gj-nav__item gj-nav__item--has-sub">
                    <a href="{{ route('study-abroad') }}">Study Abroad</a>
                    <button type="button" class="gj-nav__toggle" data-desktop-toggle aria-label="Toggle study abroad menu" aria-expanded="false">
                        <i class="bi bi-chevron-down gj-nav__chevron" aria-hidden="true"></i>
                    </button>
                    <ul class="gj-submenu">
                        @foreach ($studyabroads ?? collect() as $studyabroad)
                            <li><a href="{{ route('study-abroad.details', $studyabroad->slug) }}">{{ $studyabroad->title }}</a></li>
                        @endforeach
                    </ul>
                </li>
                <li class="gj-nav__item"><a href="{{ route('blogs') }}">Blog</a></li>
                <li class="gj-nav__item gj-nav__item--has-sub">
                    <a href="{{ route('test-preparation') }}">Test Preparation</a>
                    <button type="button" class="gj-nav__toggle" data-desktop-toggle aria-label="Toggle test preparation menu" aria-expanded="false">
                        <i class="bi bi-chevron-down gj-nav__chevron" aria-hidden="true"></i>
                    </button>
                    <ul class="gj-submenu">
                        @foreach ($testpreparations ?? collect() as $testpreparation)
                            <li><a href="{{ route('test-preparation.details', $testpreparation->slug) }}">{{ $testpreparation->title }}</a></li>
                        @endforeach
                    </ul>
                </li>
            </ul>

            <a class="gj-cta" href="{{ route('contact-us') }}">Book an Appointment</a>
            <button class="gj-menu-btn" id="gjOpenDrawer" aria-label="Open quick menu" type="button">
                <i class="bi bi-list"></i>
            </button>
        </nav>

        <button class="gj-menu-btn gj-mobile-trigger" id="gjOpenDrawerMobile" aria-label="Open navigation menu" type="button">
            <i class="bi bi-list"></i>
        </button>
    </div>
</header>

<div class="gj-backdrop" id="gjBackdrop"></div>

<aside class="gj-drawer" id="gjDrawer" aria-hidden="true" role="dialog">
    <div class="gj-drawer__head">
        <div class="gj-logo">
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
        <button class="gj-menu-btn" id="gjCloseDrawer" aria-label="Close menu" type="button">
            <i class="bi bi-x-lg"></i>
        </button>
    </div>

    <div class="gj-drawer__body gj-mobile-only">
        <ul class="gj-drawer-links">
            <li><a href="{{ url('/') }}">Home</a></li>
            <li><a href="{{ route('about-us') }}">About Us</a></li>
            <li class="gj-acc">
                <div class="gj-acc__head-wrap">
                    <a class="gj-acc__title-link" href="{{ route('study-abroad') }}">Study Abroad</a>
                    <button type="button" class="gj-acc__head" data-acc-toggle aria-label="Toggle study abroad links">
                        <i class="bi bi-chevron-down gj-acc__icon"></i>
                    </button>
                </div>
                <ul class="gj-acc__panel">
                    @foreach ($studyabroads ?? collect() as $studyabroad)
                        <li><a href="{{ route('study-abroad.details', $studyabroad->slug) }}">{{ $studyabroad->title }}</a></li>
                    @endforeach
                </ul>
            </li>
            <li class="gj-acc">
                <div class="gj-acc__head-wrap">
                    <a class="gj-acc__title-link" href="{{ route('test-preparation') }}">Test Preparation</a>
                    <button type="button" class="gj-acc__head" data-acc-toggle aria-label="Toggle test preparation links">
                        <i class="bi bi-chevron-down gj-acc__icon"></i>
                    </button>
                </div>
                <ul class="gj-acc__panel">
                    @foreach ($testpreparations ?? collect() as $testpreparation)
                        <li><a href="{{ route('test-preparation.details', $testpreparation->slug) }}">{{ $testpreparation->title }}</a></li>
                    @endforeach
                </ul>
            </li>
            <li class="gj-acc">
                <button type="button" class="gj-acc__head" data-acc-toggle>
                    <span>Medical & NOC</span>
                    <i class="bi bi-chevron-down gj-acc__icon"></i>
                </button>
                <ul class="gj-acc__panel">
                    <li><a href="https://patient.norvichospital.com/doctor/slot/PPHY/0" target="_blank" rel="noopener noreferrer">Norvic</a></li>
                    <li><a href="https://mymedical.iom.int/apps/omas/#_frmHome" target="_blank" rel="noopener noreferrer">IOM</a></li>
                    <li><a href="https://noc.moest.gov.np/login" target="_blank" rel="noopener noreferrer">NOC</a></li>
                </ul>
            </li>
            <li class="gj-acc">
                <div class="gj-acc__head-wrap">
                    <a class="gj-acc__title-link" href="{{ route('interview-preparation') }}">Interview Preparation</a>
                    <button type="button" class="gj-acc__head" data-acc-toggle aria-label="Toggle interview preparation links">
                        <i class="bi bi-chevron-down gj-acc__icon"></i>
                    </button>
                </div>
                <ul class="gj-acc__panel">
                    @foreach ($interviewPreparations ?? collect() as $interview)
                        <li><a href="{{ route('interview-preparation.details', $interview->slug) }}">{{ $interview->title }}</a></li>
                    @endforeach
                </ul>
            </li>
            <li><a href="{{ route('blogs') }}">Blogs</a></li>
            <li><a href="{{ route('galleries.index') }}">Gallery</a></li>
            <li><a href="{{ route('contact-us') }}">Contact Us</a></li>
        </ul>
    </div>

    <div class="gj-drawer__body gj-desktop-only">
        <ul class="gj-drawer-links">
            <li class="gj-acc">
                <div class="gj-acc__head-wrap">
                    <a class="gj-acc__title-link" href="{{ route('interview-preparation') }}">Interview Preparation</a>
                    <button type="button" class="gj-acc__head" data-acc-toggle aria-label="Toggle interview preparation links">
                        <i class="bi bi-chevron-down gj-acc__icon"></i>
                    </button>
                </div>
                <ul class="gj-acc__panel">
                    @foreach ($interviewPreparations ?? collect() as $interview)
                        <li><a href="{{ route('interview-preparation.details', $interview->slug) }}">{{ $interview->title }}</a></li>
                    @endforeach
                </ul>
            </li>
            <li class="gj-acc">
                <button type="button" class="gj-acc__head" data-acc-toggle>
                    <span>Medical & NOC</span>
                    <i class="bi bi-chevron-down gj-acc__icon"></i>
                </button>
                <ul class="gj-acc__panel">
                    <li><a href="https://patient.norvichospital.com/doctor/slot/PPHY/0" target="_blank" rel="noopener noreferrer">Norvic</a></li>
                    <li><a href="https://mymedical.iom.int/apps/omas/#_frmHome" target="_blank" rel="noopener noreferrer">IOM</a></li>
                    <li><a href="https://noc.moest.gov.np/login" target="_blank" rel="noopener noreferrer">NOC</a></li>
                </ul>
            </li>
            <li><a href="{{ route('galleries.index') }}">Gallery</a></li>
            <li><a href="{{ route('contact-us') }}">Contact Us</a></li>
        </ul>
    </div>

    <div class="gj-drawer__cta gj-mobile-only">
        <a class="gj-cta" href="{{ route('contact-us') }}">Book an Appointment</a>
        <a class="gj-cta-alt" href="{{ route('test-preparation') }}">Enroll Now</a>
    </div>

    <div class="gj-drawer__cta gj-desktop-only">
        <a class="gj-cta-alt" href="{{ route('test-preparation') }}">Enroll Now</a>
    </div>
</aside>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var header = document.getElementById('gjHeader');
    var drawer = document.getElementById('gjDrawer');
    var backdrop = document.getElementById('gjBackdrop');
    var openBtns = [document.getElementById('gjOpenDrawer'), document.getElementById('gjOpenDrawerMobile')];
    var closeBtn = document.getElementById('gjCloseDrawer');
    var accToggles = drawer ? drawer.querySelectorAll('[data-acc-toggle]') : [];
    var desktopDropdownToggles = header ? header.querySelectorAll('[data-desktop-toggle]') : [];

    function updateHeaderShadow() {
        if (!header) {
            return;
        }
        header.classList.toggle('is-scrolled', window.scrollY > 8);
    }

    function openDrawer() {
        if (!drawer || !backdrop) {
            return;
        }
        drawer.classList.add('active');
        backdrop.classList.add('active');
        drawer.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';
    }

    function closeDrawer() {
        if (!drawer || !backdrop) {
            return;
        }
        drawer.classList.remove('active');
        backdrop.classList.remove('active');
        drawer.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
    }

    openBtns.forEach(function(btn) {
        if (btn) {
            btn.addEventListener('click', openDrawer);
        }
    });

    if (closeBtn) {
        closeBtn.addEventListener('click', closeDrawer);
    }

    if (backdrop) {
        backdrop.addEventListener('click', closeDrawer);
    }

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeDrawer();
            if (header) {
                header.querySelectorAll('.gj-nav__item--has-sub.is-open').forEach(function(item) {
                    item.classList.remove('is-open');
                });
            }
        }
    });

    if (header) {
        document.addEventListener('click', function(e) {
            if (!header.contains(e.target)) {
                header.querySelectorAll('.gj-nav__item--has-sub.is-open').forEach(function(item) {
                    item.classList.remove('is-open');
                    var btn = item.querySelector('[data-desktop-toggle]');
                    if (btn) {
                        btn.setAttribute('aria-expanded', 'false');
                    }
                });
            }
        });
    }

    desktopDropdownToggles.forEach(function(toggle) {
        var item = toggle.closest('.gj-nav__item--has-sub');
        if (!item) {
            return;
        }

        var submenu = item.querySelector('.gj-submenu');

        toggle.addEventListener('mouseenter', function() {
            item.classList.add('is-open');
            toggle.setAttribute('aria-expanded', 'true');
        });

        item.addEventListener('mouseleave', function() {
            item.classList.remove('is-open');
            toggle.setAttribute('aria-expanded', 'false');
        });

        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            var isOpen = item.classList.contains('is-open');

            header.querySelectorAll('.gj-nav__item--has-sub.is-open').forEach(function(openItem) {
                if (openItem !== item) {
                    openItem.classList.remove('is-open');
                    var openToggle = openItem.querySelector('[data-desktop-toggle]');
                    if (openToggle) {
                        openToggle.setAttribute('aria-expanded', 'false');
                    }
                }
            });

            item.classList.toggle('is-open', !isOpen);
            toggle.setAttribute('aria-expanded', String(!isOpen));
        });

        if (submenu) {
            submenu.addEventListener('mouseenter', function() {
                item.classList.add('is-open');
                toggle.setAttribute('aria-expanded', 'true');
            });
        }
    });

    accToggles.forEach(function(toggle) {
        toggle.addEventListener('click', function() {
            var parent = this.closest('.gj-acc');
            if (!parent || !drawer) {
                return;
            }

            drawer.querySelectorAll('.gj-acc').forEach(function(item) {
                if (item !== parent) {
                    item.classList.remove('is-open');
                }
            });

            parent.classList.toggle('is-open');
        });
    });

    updateHeaderShadow();
    window.addEventListener('scroll', updateHeaderShadow, { passive: true });
});
</script>

