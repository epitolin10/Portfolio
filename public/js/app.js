// app.js — Portfolio public

// ── Theme toggle ─────────────────────────────────
(function () {
    var html   = document.documentElement;
    var btn    = document.getElementById('themeToggle');
    var icon   = document.getElementById('themeIcon');

    function applyTheme(theme) {
        html.setAttribute('data-theme', theme);
        icon.textContent = theme === 'light' ? '🌙' : '☀️';
        localStorage.setItem('portfolio-theme', theme);
    }

    // Sync icon with current theme on load
    applyTheme(html.getAttribute('data-theme') || 'dark');

    btn && btn.addEventListener('click', function () {
        var current = html.getAttribute('data-theme');
        applyTheme(current === 'light' ? 'dark' : 'light');
    });
}());

document.getElementById('navToggle')?.addEventListener('click', function() {
    const links = document.querySelector('.nav-links');
    links?.classList.toggle('nav-links--open');
});

// ── Lightbox captures ────────────────────────────
(function () {
    const overlay = document.getElementById('lightboxOverlay');
    if (!overlay) return;

    const img     = document.getElementById('lightboxImg');
    const caption = document.getElementById('lightboxCaption');
    const btnClose = document.getElementById('lightboxClose');

    function openLightbox(src, cap) {
        img.src = src;
        img.alt = cap || '';
        caption.textContent = cap || '';
        overlay.hidden = false;
        document.body.style.overflow = 'hidden';
        btnClose.focus();
    }

    function closeLightbox() {
        overlay.hidden = true;
        img.src = '';
        document.body.style.overflow = '';
    }

    document.querySelectorAll('[data-lightbox]').forEach(function (btn) {
        btn.addEventListener('click', function () {
            openLightbox(btn.dataset.lightbox, btn.dataset.caption);
        });
    });

    btnClose.addEventListener('click', closeLightbox);

    overlay.addEventListener('click', function (e) {
        if (e.target === overlay) closeLightbox();
    });

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && !overlay.hidden) closeLightbox();
    });
}());