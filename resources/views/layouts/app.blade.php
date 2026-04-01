<!DOCTYPE html>
<html lang="fr" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Portfolio BTS SIO')</title>
    <script>
        (function() {
            var saved = localStorage.getItem('portfolio-theme');
            if (saved === 'light') document.documentElement.setAttribute('data-theme', 'light');
        })();
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages.css') }}">
    @stack('styles')
</head>
<body>

<nav class="navbar">
    <div class="nav-inner">
        <a href="{{ route('portfolio.index') }}" class="nav-logo">
            <span class="logo-bracket">[</span>Portfolio<span class="logo-bracket">]</span>
        </a>
        <ul class="nav-links">
            <li><a href="{{ route('portfolio.index') }}" class="{{ request()->routeIs('portfolio.index') ? 'active' : '' }}">Accueil</a></li>
            <li><a href="{{ route('portfolio.competences') }}" class="{{ request()->routeIs('portfolio.competences') ? 'active' : '' }}">Compétences B1</a></li>
            <li><a href="{{ route('portfolio.activites') }}" class="{{ request()->routeIs('portfolio.activites*') ? 'active' : '' }}">Activités</a></li>
            <li><a href="{{ route('portfolio.stages') }}" class="{{ request()->routeIs('portfolio.stages') ? 'active' : '' }}">Stages</a></li>
            <li><a href="{{ route('portfolio.ap') }}" class="{{ request()->routeIs('portfolio.ap') ? 'active' : '' }}">AP</a></li>
            <li><a href="{{ route('portfolio.etudes') }}" class="{{ request()->routeIs('portfolio.etudes') ? 'active' : '' }}">Mes études</a></li>
            <li><a href="{{ route('portfolio.contact') }}" class="{{ request()->routeIs('portfolio.contact') ? 'active' : '' }}">Contact</a></li>
        </ul>
        <button class="nav-toggle" id="navToggle">☰</button>
        <button class="theme-toggle" id="themeToggle" aria-label="Changer de thème" title="Changer de thème">
            <span id="themeIcon">🌙</span>
        </button>
    </div>
</nav>

<main>
    @yield('content')
</main>

<footer class="footer">
    <div class="footer-inner">
        <p>BTS SIO — <strong>@yield('author', 'Enzo Pitolin')</strong></p>
        <div class="footer-socials">
            <a href="mailto:enzopitolin3@gmail.com" class="footer-social-link" aria-label="Email">
                <svg viewBox="0 0 24 24" fill="currentColor" width="20" height="20"><path d="M3 6.75A1.75 1.75 0 0 1 4.75 5h14.5A1.75 1.75 0 0 1 21 6.75v10.5A1.75 1.75 0 0 1 19.25 19H4.75A1.75 1.75 0 0 1 3 17.25V6.75zm1.5.63v.2L12 12.63l7.5-5.05v-.2a.25.25 0 0 0-.25-.25H4.75a.25.25 0 0 0-.25.25zm15 2L12.42 14.2a.75.75 0 0 1-.84 0L4.5 9.38v7.87c0 .14.11.25.25.25h14.5a.25.25 0 0 0 .25-.25V9.38z"/></svg>
            </a>
            <a href="https://www.linkedin.com/in/enzo-pitolin-b623473b7/" class="footer-social-link" target="_blank" rel="noopener" aria-label="LinkedIn">
                <svg viewBox="0 0 24 24" fill="currentColor" width="20" height="20"><path d="M4.98 3.5C4.98 4.88 3.86 6 2.48 6S0 4.88 0 3.5 1.12 1 2.5 1s2.48 1.12 2.48 2.5zM.5 8h4V23h-4V8zm7 0h3.83v2.05h.06C11.92 8.97 13.34 8 15.6 8 20.16 8 21 11 21 14.95V23h-4v-7.12c0-1.7-.03-3.88-2.36-3.88-2.37 0-2.73 1.85-2.73 3.76V23h-4V8z"/></svg>
            </a>
            <a href="https://github.com/epitolin10" class="footer-social-link" target="_blank" rel="noopener" aria-label="GitHub">
                <svg viewBox="0 0 24 24" fill="currentColor" width="20" height="20"><path d="M12 .5C5.65.5.5 5.65.5 12a11.5 11.5 0 0 0 7.86 10.92c.57.1.78-.25.78-.56 0-.28-.01-1.03-.02-2.02-3.2.7-3.88-1.54-3.88-1.54-.52-1.33-1.28-1.68-1.28-1.68-1.05-.71.08-.7.08-.7 1.16.08 1.77 1.2 1.77 1.2 1.03 1.76 2.7 1.25 3.36.95.1-.75.4-1.25.72-1.54-2.56-.29-5.25-1.28-5.25-5.72 0-1.26.45-2.29 1.2-3.1-.12-.29-.52-1.46.11-3.04 0 0 .98-.31 3.2 1.18a11.2 11.2 0 0 1 5.82 0c2.22-1.49 3.2-1.18 3.2-1.18.63 1.58.23 2.75.11 3.04.75.81 1.2 1.84 1.2 3.1 0 4.45-2.7 5.43-5.28 5.71.41.35.78 1.04.78 2.1 0 1.52-.01 2.75-.01 3.12 0 .31.2.67.79.56A11.5 11.5 0 0 0 23.5 12C23.5 5.65 18.35.5 12 .5z"/></svg>
            </a>
        </div>
    </div>
</footer>

<script src="{{ asset('js/app.js') }}"></script>
@stack('scripts')
</body>
</html>