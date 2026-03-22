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
            {{ $profil->bio ?? 'Étudiant en BTS Services Informatiques aux Organisations. Ce portfolio retrace mes compétences et réalisations professionnelles dans le cadre de mes études.' }}
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

{{-- Compétences acquises --}}
@if($competencesAcquises->count())
<section class="section-skills-home">
    <div class="container">
        <div class="section-header">
            <span class="section-tag">Compétences</span>
            <h2>Mes compétences</h2>
        </div>
        <div class="skills-home-grid">
            @foreach($competencesAcquises as $categorie => $items)
            <div class="skills-home-cat">
                <h3 class="skills-home-cat-title">{{ $categorie }}</h3>
                <div class="skills-home-items">
                    @foreach($items as $ca)
                    <span class="skill-chip">
                        @if($ca->image)
                            <img src="{{ asset('storage/'.$ca->image) }}" alt="{{ $ca->nom }}" class="skill-chip-img">
                        @endif
                        {{ $ca->nom }}
                    </span>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<section class="section-competences-preview">
    <div class="container">
        <div class="section-header">
            <span class="section-tag">Blocs B1</span>
            <h2>Compétences B1</h2>
        </div>
        <div class="competences-grid">
            @foreach($competences as $comp)
            <a href="{{ route('portfolio.competences', ['bloc' => $comp->slug]) }}" class="comp-card">
                <div class="comp-card-icon">{{ $comp->icone ?? '◈' }}</div>
                <h3>{{ $comp->intitule }}</h3>
                <p>{{ $comp->description_courte }}</p>
                
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

{{-- Études --}}
@if($etudes->count())
<section class="section-skills-home">
    <div class="container">
        <div class="section-header">
            <span class="section-tag">Parcours académique</span>
            <h2>Mes études</h2>
            <a href="{{ route('portfolio.etudes') }}" class="see-all">Voir tout →</a>
        </div>
        <div class="activites-list">
            @foreach($etudes as $etude)
            <div class="activite-card" style="cursor:default">
                <div class="activite-card-meta">
                    @if($etude->niveau)
                        <span class="activite-type ap">{{ $etude->niveau }}</span>
                    @endif
                    <span class="activite-date">{{ $etude->duree }}</span>
                </div>
                <h3>{{ $etude->intitule }}</h3>
                <p>{{ $etude->etablissement }}@if($etude->ville) — {{ $etude->ville }}@endif</p>
                <div class="activite-tags">
                    @if($etude->en_cours)
                        <span class="tag" style="background:rgba(var(--color-accent-rgb),.15); color:var(--color-accent);">En cours</span>
                    @endif
                    @if($etude->mention)
                        <span class="tag">{{ $etude->mention }}</span>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@endsection