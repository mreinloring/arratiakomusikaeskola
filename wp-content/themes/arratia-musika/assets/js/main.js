document.addEventListener('DOMContentLoaded', function () {
    // ── Mobile menu ───────────────────────────────────────────
    const toggle = document.getElementById('menuToggle');
    const nav    = document.getElementById('siteNav');

    if (toggle && nav) {
        toggle.addEventListener('click', function () {
            const open = nav.classList.toggle('open');
            toggle.setAttribute('aria-expanded', open);
        });
        document.addEventListener('click', function (e) {
            if (!toggle.contains(e.target) && !nav.contains(e.target)) {
                nav.classList.remove('open');
                toggle.setAttribute('aria-expanded', 'false');
            }
        });
    }

    // ── Bideo desc "Irakurri gehiago" ─────────────────────────
    document.querySelectorAll('.front-bideo-desc').forEach(function(desc) {
        var btn = desc.parentElement.querySelector('.front-bideo-more');
        if (!btn) return;
        // Show button only if text is clamped
        if (desc.scrollHeight > desc.clientHeight + 4) {
            btn.style.display = 'block';
        }
        btn.addEventListener('click', function() {
            desc.classList.add('expanded');
            btn.style.display = 'none';
        });
    });

    // ── Ikasgai sliders ───────────────────────────────────────
    document.querySelectorAll('.ig-slider').forEach(function (slider) {
        const track  = slider.querySelector('.ig-slider-track');
        const slides = slider.querySelectorAll('.ig-slide');
        const dots   = slider.querySelectorAll('.ig-dot');
        const prev   = slider.querySelector('.ig-slider-prev');
        const next   = slider.querySelector('.ig-slider-next');
        if (!track || slides.length < 2) return;

        // Visible per slide: 3 on desktop, 1 on mobile
        function perView() { return window.innerWidth <= 640 ? 1 : 3; }

        let current = 0;
        const max = function() { return Math.max(0, slides.length - perView()); };

        function goTo(idx) {
            current = Math.min(Math.max(idx, 0), max());
            // wrap around
            if (idx < 0) current = max();
            if (idx > max()) current = 0;
            var pct = (100 / perView()) * current;
            track.style.transform = 'translateX(-' + pct + '%)';
            dots.forEach(function (d, i) { d.classList.toggle('active', i === current); });
        }

        if (prev) prev.addEventListener('click', function () { goTo(current - 1); });
        if (next) next.addEventListener('click', function () { goTo(current + 1); });
        dots.forEach(function (d) {
            d.addEventListener('click', function () { goTo(parseInt(d.dataset.idx)); });
        });

        setInterval(function () { goTo(current + 1); }, 4000);
    });
});
