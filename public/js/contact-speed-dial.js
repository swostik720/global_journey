(function () {
    'use strict';

    var dial = document.getElementById('gjSpeedDial');
    if (!dial) return;

    var toggle = dial.querySelector('.gj-speed-dial__toggle');
    var backdrop = dial.querySelector('.gj-speed-dial__backdrop');
    var isOpen = false;

    function openDial() {
        if (isOpen) return;
        isOpen = true;
        dial.classList.add('is-open');
        toggle.setAttribute('aria-expanded', 'true');
    }

    function closeDial() {
        if (!isOpen) return;
        isOpen = false;
        dial.classList.remove('is-open');
        toggle.setAttribute('aria-expanded', 'false');
    }

    function toggleDial(e) {
        e.stopPropagation();
        if (isOpen) {
            closeDial();
        } else {
            openDial();
        }
    }

    var menuLinks = dial.querySelectorAll('.gj-speed-dial__link');

    toggle.addEventListener('click', toggleDial);

    backdrop.addEventListener('click', closeDial);

    menuLinks.forEach(function (link) {
        link.addEventListener('click', closeDial);
    });

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && isOpen) {
            closeDial();
            toggle.focus();
        }
    });

    document.addEventListener('click', function (e) {
        if (isOpen && !dial.contains(e.target)) {
            closeDial();
        }
    });
})();
