@extends('layouts.app')
@section('title', 'Accueil')
@section('author', $profil->nom ?? 'Enzo Pitolin')

@section('content')

<section class="hero">
    <div class="hero-bg">
        <div class="hero-grid"></div>
    </div>
    <div class="hero-inner">
        <div class="hero-tag">BTS SIO — Option SLAM</div>
        <h1 class="hero-title">
            <span class="hero-hi">Bonjour, je suis</span>
            <span class="hero-name">{{ $profil->nom ?? 'Enzo Pitolin' }}</span>
        </h1>
        <p class="hero-desc">
            {{ $profil->bio ?? 'Étudiant en BTS Services Informatiques aux Organisations. Ce portfolio retrace mes compétences et réalisations professionnelles dans le cadre de l\'épreuve E5.' }}
        </p>
        <div class="hero-actions">
            <a href="{{ route('portfolio.competences') }}" class="btn btn-primary">Voir mes compétences</a>
            <a href="{{ route('portfolio.activites') }}" class="btn btn-outline">Mes activités</a>
        </div>
        <div class="hero-stats">
            <div class="stat">
                <span class="stat-num">{{ $nbActivites }}</span>
                <span class="stat-label">Activités</span>
            </div>
            <div class="stat">
                <span class="stat-num">{{ $nbCompetences }}</span>
                <span class="stat-label">Compétences B1</span>
            </div>
            <div class="stat">
                <span class="stat-num">{{ $nbStages }}</span>
                <span class="stat-label">Stages</span>
            </div>
        </div>
    </div>
    <div class="hero-photo">
        @if($profil->photo ?? false)
            <img src="{{ asset('storage/'.$profil->photo) }}" alt="Photo de profil">
        @else
            <div class="hero-photo-placeholder">
                <span>Photo</span>
            </div>
        @endif
    </div>
</section>

<section class="section-competences-preview">
    <div class="container">
        <div class="section-header">
            <span class="section-tag">Blocs B1</span>
            <h2>Compétences couvertes</h2>
        </div>
        <div class="competences-grid">
            @foreach($competences as $comp)
            <a href="{{ route('portfolio.competences', ['bloc' => $comp->slug]) }}" class="comp-card">
                <div class="comp-card-icon">{{ $comp->icone ?? '◈' }}</div>
                <h3>{{ $comp->intitule }}</h3>
                <p>{{ $comp->description_courte }}</p>
                <span class="comp-card-count">{{ $comp->activites_count }} activité(s)</span>
            </a>
            @endforeach
        </div>
    </div>
</section>

<section class="section-activites-recent">
    <div class="container">
        <div class="section-header">
            <span class="section-tag">Récentes</span>
            <h2>Dernières activités</h2>
            <a href="{{ route('portfolio.activites') }}" class="see-all">Tout voir →</a>
        </div>
        <div class="activites-list">
            @foreach($activitesRecentes as $activite)
            <a href="{{ route('portfolio.activites.show', $activite->slug) }}" class="activite-card">
                <div class="activite-card-meta">
                    <span class="activite-type {{ $activite->type }}">{{ ucfirst($activite->type) }}</span>
                    <span class="activite-date">{{ $activite->date_realisation->format('M Y') }}</span>
                </div>
                <h3>{{ $activite->titre }}</h3>
                <p>{{ Str::limit($activite->description_courte, 120) }}</p>
                <div class="activite-tags">
                    @foreach($activite->competences->take(3) as $c)
                        <span class="tag">{{ $c->intitule_court }}</span>
                    @endforeach
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>

@endsection