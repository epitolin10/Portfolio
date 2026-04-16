// app.js — Portfolio public

// ── Theme toggle ─────────────────────────────────
(function () {
    var html   = document.documentElement;
    var btn    = document.getElementById('themeToggle');
    var icon   = document.getElementById('themeIcon');

    var icons = {
        light: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true" class="theme-icon"><path d="M6 .278a.77.77 0 0 1 .08.858 7.2 7.2 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.792-.001 1.533-.16 1.533-.16a.79.79 0 0 1 .81.316.73.73 0 0 1-.031.893A8.35 8.35 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.75.75 0 0 1 6 .278Z"/><path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.73 1.73 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.73 1.73 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.73 1.73 0 0 0 1.097-1.097Z"/><path d="M13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.16 1.16 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.16 1.16 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732Z"/></svg>',
        dark: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true" class="theme-icon"><path d="M8 4.5a3.5 3.5 0 1 1 0 7 3.5 3.5 0 0 1 0-7Z"/><path d="M8 0a.5.5 0 0 1 .5.5V2a.5.5 0 0 1-1 0V.5A.5.5 0 0 1 8 0Z"/><path d="M8 14a.5.5 0 0 1 .5.5V16a.5.5 0 0 1-1 0v-1.5A.5.5 0 0 1 8 14Z"/><path d="M16 8a.5.5 0 0 1-.5.5H14a.5.5 0 0 1 0-1h1.5A.5.5 0 0 1 16 8Z"/><path d="M2 8a.5.5 0 0 1-.5.5H0a.5.5 0 0 1 0-1h1.5A.5.5 0 0 1 2 8Z"/><path d="M11.031 2.515a.5.5 0 0 1 .707 0l1.06 1.06a.5.5 0 1 1-.707.707l-1.06-1.06a.5.5 0 0 1 0-.707Z"/><path d="M3.202 10.344a.5.5 0 1 1 .707.707l-1.06 1.06a.5.5 0 1 1-.707-.707l1.06-1.06Z"/><path d="M13.738 11.576a.5.5 0 0 1 0 .707l-1.06 1.06a.5.5 0 1 1-.707-.707l1.06-1.06a.5.5 0 0 1 .707 0Z"/><path d="M2.262 2.515a.5.5 0 1 1 .707.707l-1.06 1.06a.5.5 0 1 1-.707-.707l1.06-1.06Z"/></svg>'
    };

    function applyTheme(theme) {
        html.setAttribute('data-theme', theme);
        icon.innerHTML = theme === 'light' ? icons.light : icons.dark;
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
    const btnZoomIn = document.getElementById('zoomIn');
    const btnZoomOut = document.getElementById('zoomOut');
    const btnZoomReset = document.getElementById('zoomReset');

    // Collect all image captures (not PDFs)
    const items = Array.from(document.querySelectorAll('[data-lightbox]')).map(function (btn) {
        return { src: btn.dataset.lightbox, cap: btn.dataset.caption || '' };
    });

    let current = 0;
    let zoomLevel = 1;
    let isDragging = false;
    let startX, startY, initialX, initialY;

    function showImage(index) {
        current = (index + items.length) % items.length;
        img.src = items[current].src;
        img.alt = items[current].cap;
        caption.textContent = items[current].cap;
        if (counter) counter.textContent = items.length > 1 ? (current + 1) + ' / ' + items.length : '';
        const hasMany = items.length > 1;
        if (btnPrev) btnPrev.hidden = !hasMany;
        if (btnNext) btnNext.hidden = !hasMany;
        resetZoom();
    }

    function resetZoom() {
        zoomLevel = 1;
        initialX = 0;
        initialY = 0;
        img.style.transform = 'scale(1) translate(0, 0)';
        img.style.transformOrigin = 'center center';
        img.style.cursor = 'default';
        isDragging = false;
    }

    function updateZoom() {
        img.style.transform = `scale(${zoomLevel}) translate(${initialX || 0}px, ${initialY || 0}px)`;
        img.style.cursor = zoomLevel > 1 ? 'grab' : 'default';
    }

    function zoomIn() {
        zoomLevel = Math.min(zoomLevel * 1.2, 5);
        updateZoom();
    }

    function zoomOut() {
        zoomLevel = Math.max(zoomLevel / 1.2, 0.5);
        updateZoom();
    }

    function startDrag(e) {
        if (zoomLevel <= 1) return;
        isDragging = true;
        startX = e.clientX - (initialX || 0);
        startY = e.clientY - (initialY || 0);
        img.style.cursor = 'grabbing';
        e.preventDefault();
    }

    function drag(e) {
        if (!isDragging) return;
        initialX = e.clientX - startX;
        initialY = e.clientY - startY;
        updateZoom();
    }

    function stopDrag() {
        isDragging = false;
        if (zoomLevel > 1) {
            img.style.cursor = 'grab';
        }
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
        resetZoom();
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

    btnZoomIn && btnZoomIn.addEventListener('click', function (e) {
        e.stopPropagation();
        zoomIn();
    });

    btnZoomOut && btnZoomOut.addEventListener('click', function (e) {
        e.stopPropagation();
        zoomOut();
    });

    btnZoomReset && btnZoomReset.addEventListener('click', function (e) {
        e.stopPropagation();
        resetZoom();
    });

    // Zoom with mouse wheel
    img.addEventListener('wheel', function (e) {
        e.preventDefault();
        if (e.deltaY < 0) {
            zoomIn();
        } else {
            zoomOut();
        }
    });

    // Drag functionality
    img.addEventListener('mousedown', startDrag);
    document.addEventListener('mousemove', drag);
    document.addEventListener('mouseup', stopDrag);

    overlay.addEventListener('click', function (e) {
        if (e.target === overlay) closeLightbox();
    });

    document.addEventListener('keydown', function (e) {
        if (overlay.hidden) return;
        if (e.key === 'Escape') closeLightbox();
        if (e.key === 'ArrowLeft') showImage(current - 1);
        if (e.key === 'ArrowRight') showImage(current + 1);
        if (e.key === '+') zoomIn();
        if (e.key === '-') zoomOut();
        if (e.key === '0') resetZoom();
    });
}());