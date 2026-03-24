<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') — Admin Portfolio</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    @stack('styles')
</head>
<body class="admin-body">

<aside class="sidebar">
    <div class="sidebar-header">
        <span class="sidebar-logo"><span class="logo-bracket">[</span>Admin<span class="logo-bracket">]</span></span>
        <p class="sidebar-sub">Portfolio E5</p>
    </div>
    <nav class="sidebar-nav">
        <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <span class="icon">⬛</span> Dashboard
        </a>
        <a href="{{ route('admin.activites.index') }}" class="sidebar-link {{ request()->routeIs('admin.activites*') ? 'active' : '' }}">
            <span class="icon">◈</span> Activités
        </a>
        <a href="{{ route('admin.competences.index') }}" class="sidebar-link {{ request()->routeIs('admin.competences.index') || request()->routeIs('admin.competences.edit') || request()->routeIs('admin.competences.update') ? 'active' : '' }}">
            <span class="icon">◉</span> Compétences B1
        </a>
        <a href="{{ route('admin.competences-acquises.index') }}" class="sidebar-link {{ request()->routeIs('admin.competences-acquises*') ? 'active' : '' }}">
            <span class="icon">⚡</span> Compétences acquises
        </a>
        <a href="{{ route('admin.stages.index') }}" class="sidebar-link {{ request()->routeIs('admin.stages*') ? 'active' : '' }}">
            <span class="icon">◎</span> Stages
        </a>
        <a href="{{ route('admin.etudes.index') }}" class="sidebar-link {{ request()->routeIs('admin.etudes*') ? 'active' : '' }}">
            <span class="icon">🎓</span> Études
        </a>
        <a href="{{ route('admin.profil.edit') }}" class="sidebar-link {{ request()->routeIs('admin.profil*') ? 'active' : '' }}">
            <span class="icon">👤</span> Mon profil
        </a>
        <div class="sidebar-divider"></div>
        <a href="{{ route('portfolio.index') }}" class="sidebar-link" target="_blank">
            <span class="icon">↗</span> Voir le portfolio
        </a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="sidebar-link sidebar-logout">
                <span class="icon">⏻</span> Déconnexion
            </button>
        </form>
    </nav>
</aside>

<div class="admin-content">
    <header class="admin-topbar">
        <h1 class="admin-page-title">@yield('page-title', 'Dashboard')</h1>
        <div class="admin-user">
            <span>{{ auth()->user()->name ?? 'Admin' }}</span>
        </div>
    </header>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-error">{{ session('error') }}</div>
    @endif

    <div class="admin-main">
        @yield('content')
    </div>
</div>

<script src="{{ asset('js/admin.js') }}"></script>
@stack('scripts')
</body>
</html>