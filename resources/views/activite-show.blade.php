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
                        <span class="stage-chip">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true" class="meta-icon">
                                <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A32 32 0 0 1 8 14.58a32 32 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10"/>
                                <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4m0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                            </svg>
                            {{ $activite->stage->entreprise }}
                        </span>
                    @elseif($activite->ap)
                        <span class="stage-chip">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true" class="meta-icon">
                                <path d="M3 0a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h3v-3.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5V16h3a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1zm1 2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3.5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5M4 5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zM7.5 5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5m2.5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zM4.5 8h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5m2.5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3.5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5"/>
                            </svg>
                            {{ $activite->ap }}
                        </span>
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
                            <a href="{{ asset('storage/'.$capture->chemin) }}" target="_blank" rel="noopener noreferrer" class="capture-pdf">
                                <span class="pdf-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true" class="meta-icon">
                                        <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5zM1.6 11.85H0v3.999h.791v-1.342h.803q.43 0 .732-.173.305-.175.463-.474a1.4 1.4 0 0 0 .161-.677q0-.375-.158-.677a1.2 1.2 0 0 0-.46-.477q-.3-.18-.732-.179m.545 1.333a.8.8 0 0 1-.085.38.57.57 0 0 1-.238.241.8.8 0 0 1-.375.082H.788V12.48h.66q.327 0 .512.181.185.183.185.522m1.217-1.333v3.999h1.46q.602 0 .998-.237a1.45 1.45 0 0 0 .595-.689q.196-.45.196-1.084 0-.63-.196-1.075a1.43 1.43 0 0 0-.589-.68q-.396-.234-1.005-.234zm.791.645h.563q.371 0 .609.152a.9.9 0 0 1 .354.454q.118.302.118.753a2.3 2.3 0 0 1-.068.592 1.1 1.1 0 0 1-.196.422.8.8 0 0 1-.334.252 1.3 1.3 0 0 1-.483.082h-.563zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638z"/>
                                    </svg>
                                </span>
                                <span>{{ $capture->nom ?? 'Document PDF' }}</span>
                            </a>
                        @else
                            <button type="button" class="capture-img-wrap"
                                    data-lightbox="{{ asset('storage/'.$capture->chemin) }}"
                                    data-caption="{{ $capture->nom ?? '' }}">
                                <img src="{{ asset('storage/'.$capture->chemin) }}" alt="{{ $capture->nom }}">
                                <span class="capture-overlay">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true" class="meta-icon">
                                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                                    </svg>
                                    Agrandir
                                </span>
                            </button>
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
                        <p class="si-detail">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true" class="meta-icon">
                                <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A32 32 0 0 1 8 14.58a32 32 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10"/>
                                <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4m0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                            </svg>
                            {{ $activite->stage->ville }}
                        </p>
                    @endif
                    <p class="si-detail">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true" class="meta-icon">
                            <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"/>
                        </svg>
                        {{ $activite->stage->date_debut->format('M Y') }} → {{ $activite->stage->date_fin->format('M Y') }}
                    </p>
                    <a href="{{ route('portfolio.stages') }}" class="see-all" style="font-size:.85rem;">Voir le stage →</a>
                </div>
            </div>
            @endif

        </aside>
    </div>
</section>

{{-- Lightbox modal --}}
<div id="lightboxOverlay" class="lightbox-overlay" role="dialog" aria-modal="true" aria-label="Aperçu de la capture" hidden>
    <button class="lightbox-close" id="lightboxClose" aria-label="Fermer">&times;</button>
    <button class="lightbox-nav lightbox-prev" id="lightboxPrev" aria-label="Image précédente" hidden>&#8249;</button>
    <div class="lightbox-content">
        <img id="lightboxImg" src="" alt="">
        <p id="lightboxCaption" class="lightbox-caption"></p>
        <p id="lightboxCounter" class="lightbox-counter"></p>
        <div class="lightbox-zoom-controls">
            <button class="zoom-btn" id="zoomIn" aria-label="Zoom avant">+</button>
            <button class="zoom-btn" id="zoomOut" aria-label="Zoom arrière">−</button>
            <button class="zoom-btn" id="zoomReset" aria-label="Réinitialiser le zoom">⭯</button>
        </div>
    </div>
    <button class="lightbox-nav lightbox-next" id="lightboxNext" aria-label="Image suivante" hidden>&#8250;</button>
</div>

@endsection