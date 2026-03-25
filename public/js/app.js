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
    const overlay  = document.getElementById('lightboxOverlay');
    if (!overlay) return;

    const img      = document.getElementById('lightboxImg');
    const caption  = document.getElementById('lightboxCaption');
    const counter  = document.getElementById('lightboxCounter');
    const btnClose = document.getElementById('lightboxClose');
    const btnPrev  = document.getElementById('lightboxPrev');
    const btnNext  = document.getElementById('lightboxNext');

    // Collect all image captures (not PDFs)
    const items = Array.from(document.querySelectorAll('[data-lightbox]')).map(function (btn) {
        return { src: btn.dataset.lightbox, cap: btn.dataset.caption || '' };
    });

    let current = 0;

    function showImage(index) {
        current = (index + items.length) % items.length;
        img.src = items[current].src;
        img.alt = items[current].cap;
        caption.textContent = items[current].cap;
        if (counter) counter.textContent = items.length > 1 ? (current + 1) + ' / ' + items.length : '';
        const hasMany = items.length > 1;
        if (btnPrev) btnPrev.hidden = !hasMany;
        if (btnNext) btnNext.hidden = !hasMany;
    }

    function openLightbox(index) {
        showImage(index);
        overlay.hidden = false;
        document.body.style.overflow = 'hidden';
        btnClose.focus();
    }

    function closeLightbox() {
        overlay.hidden = true;
        img.src = '';
        document.body.style.overflow = '';
    }

    document.querySelectorAll('[data-lightbox]').forEach(function (btn, i) {
        btn.addEventListener('click', function () {
            openLightbox(i);
        });
    });

    btnClose.addEventListener('click', closeLightbox);

    btnPrev && btnPrev.addEventListener('click', function (e) {
        e.stopPropagation();
        showImage(current - 1);
    });

    btnNext && btnNext.addEventListener('click', function (e) {
        e.stopPropagation();
        showImage(current + 1);
    });

    overlay.addEventListener('click', function (e) {
        if (e.target === overlay) closeLightbox();
    });

    document.addEventListener('keydown', function (e) {
        if (overlay.hidden) return;
        if (e.key === 'Escape') closeLightbox();
        if (e.key === 'ArrowLeft') showImage(current - 1);
        if (e.key === 'ArrowRight') showImage(current + 1);
    });
}());