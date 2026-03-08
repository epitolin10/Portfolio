<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Portfolio BTS SIO') — E5</title>
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
            <li><a href="{{ route('portfolio.competences') }}" class="{{ request()->routeIs('portfolio.competences') ? 'active' : '' }}">Compétences</a></li>
            <li><a href="{{ route('portfolio.activites') }}" class="{{ request()->routeIs('portfolio.activites*') ? 'active' : '' }}">Activités</a></li>
            <li><a href="{{ route('portfolio.stages') }}" class="{{ request()->routeIs('portfolio.stages') ? 'active' : '' }}">Stages</a></li>
            <li><a href="{{ route('portfolio.contact') }}" class="{{ request()->routeIs('portfolio.contact') ? 'active' : '' }}">Contact</a></li>
        </ul>
        <button class="nav-toggle" id="navToggle">☰</button>
    </div>
</nav>

<main>
    @yield('content')
</main>

<footer class="footer">
    <div class="footer-inner">
        <p>BTS SIO — Épreuve E5 &nbsp;·&nbsp; <strong>@yield('author', 'Enzo Pitolin')</strong></p>
        <p class="footer-sub">Portfolio option B — Présentation par blocs de compétences</p>
    </div>
</footer>

<script src="{{ asset('js/app.js') }}"></script>
@stack('scripts')
</body>
</html>