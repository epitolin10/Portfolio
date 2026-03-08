@extends('layouts.app')
@section('title', $activite->titre)

@section('content')

<section class="container section-spaced">

    {{-- Breadcrumb --}}
    <nav class="breadcrumb">
        <a href="{{ route('portfolio.index') }}">Accueil</a>
        <span>/</span>
        <a href="{{ route('portfolio.activites') }}">Activités</a>
        <span>/</span>
        <span>{{ Str::limit($activite->titre, 40) }}</span>
    </nav>

    <div class="activite-detail-grid">

        {{-- CONTENU PRINCIPAL --}}
        <div class="activite-main">

            <div class="activite-detail-header">
                <div class="activite-detail-meta">
                    <span class="activite-type {{ $activite->type }}">{{ ucfirst($activite->type) }}</span>
                    <span class="activite-date">{{ $activite->date_realisation->format('d M Y') }}</span>
                    @if($activite->stage)
                        <span class="stage-chip">📍 {{ $activite->stage->entreprise }}</span>
                    @elseif($activite->ap)
                        <span class="stage-chip">🏫 {{ $activite->ap }}</span>
                    @endif
                </div>
                <h1 class="activite-detail-title">{{ $activite->titre }}</h1>
                <p class="activite-detail-intro">{{ $activite->description_courte }}</p>
            </div>

            {{-- Description --}}
            <div class="activite-content">
                <h2>Description</h2>
                <div class="prose">
                    {!! nl2br(e($activite->description)) !!}
                </div>
            </div>

            {{-- Captures --}}
            @if($activite->captures->count())
            <div class="activite-captures">
                <h2>Captures & Preuves</h2>
                <div class="captures-grid">
                    @foreach($activite->captures as $capture)
                        @if(Str::endsWith($capture->chemin, '.pdf'))
                            <a href="{{ asset('storage/'.$capture->chemin) }}" target="_blank" class="capture-pdf">
                                <span class="pdf-icon">📄</span>
                                <span>{{ $capture->nom ?? 'Document PDF' }}</span>
                            </a>
                        @else
                            <a href="{{ asset('storage/'.$capture->chemin) }}" target="_blank" class="capture-img-wrap">
                                <img src="{{ asset('storage/'.$capture->chemin) }}" alt="{{ $capture->nom }}">
                                <span class="capture-overlay">🔍 Agrandir</span>
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>
            @endif

            {{-- Lien externe --}}
            @if($activite->lien_externe)
            <div class="activite-link">
                <a href="{{ $activite->lien_externe }}" target="_blank" class="btn btn-outline">
                    ↗ Voir le projet en ligne
                </a>
            </div>
            @endif

        </div>

        {{-- SIDEBAR --}}
        <aside class="activite-sidebar">

            {{-- Compétences --}}
            <div class="sidebar-card">
                <h3>Compétences B1 mobilisées</h3>
                @foreach($activite->competences as $comp)
                <div class="comp-item">
                    <span class="comp-item-icon">{{ $comp->icone }}</span>
                    <div>
                        <strong>{{ $comp->intitule_court }}</strong>
                        <small>{{ $comp->intitule }}</small>
                    </div>
                </div>

                {{-- Sous-compétences associées --}}
                @php
                    $sousComp = $activite->sousCompetences->where('competence_id', $comp->id);
                @endphp
                @if($sousComp->count())
                <ul class="sc-list">
                    @foreach($sousComp as $sc)
                        <li>{{ $sc->intitule }}</li>
                    @endforeach
                </ul>
                @endif
                @endforeach
            </div>

            {{-- Outils --}}
            @if($activite->outils)
            <div class="sidebar-card">
                <h3>Outils & Technologies</h3>
                <div class="tools-list">
                    @foreach(explode(',', $activite->outils) as $outil)
                        <span class="tool-tag">{{ trim($outil) }}</span>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- Stage --}}
            @if($activite->stage)
            <div class="sidebar-card">
                <h3>Contexte du stage</h3>
                <div class="stage-info">
                    <p><strong>{{ $activite->stage->entreprise }}</strong></p>
                    @if($activite->stage->ville)
                        <p class="si-detail">📍 {{ $activite->stage->ville }}</p>
                    @endif
                    <p class="si-detail">
                        📅 {{ $activite->stage->date_debut->format('M Y') }} → {{ $activite->stage->date_fin->format('M Y') }}
                    </p>
                    <a href="{{ route('portfolio.stages') }}" class="see-all" style="font-size:.85rem;">Voir le stage →</a>
                </div>
            </div>
            @endif

        </aside>
    </div>

    {{-- Autres activités similaires --}}
    @if($autresActivites->count())
    <div class="activites-similaires">
        <div class="section-header">
            <span class="section-tag">Similaires</span>
            <h2>Autres activités liées</h2>
        </div>
        <div class="activites-list">
            @foreach($autresActivites as $a)
            <a href="{{ route('portfolio.activites.show', $a->slug) }}" class="activite-card">
                <div class="activite-card-meta">
                    <span class="activite-type {{ $a->type }}">{{ ucfirst($a->type) }}</span>
                    <span class="activite-date">{{ $a->date_realisation->format('M Y') }}</span>
                </div>
                <h3>{{ $a->titre }}</h3>
                <p>{{ Str::limit($a->description_courte, 100) }}</p>
            </a>
            @endforeach
        </div>
    </div>
    @endif

</section>

@endsection