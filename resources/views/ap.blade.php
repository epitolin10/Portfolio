@extends('layouts.app')
@section('title', 'Atelier de Professionalisation')

@section('content')

<section class="page-hero">
    <div class="container">
        <span class="section-tag">Parcours</span>
        <h1 class="page-title">Atelier de Professionalisation</h1>
    </div>
</section>

<section class="container section-spaced">

    @forelse($entreprises as $index => $entreprise)
    <div class="stage-block">
        <div class="stage-block-header">
            <div class="stage-num">AP {{ $index + 1 }}</div>
            <div class="stage-block-info">
                @if($entreprise->logo)
                    <img src="{{ asset('storage/'.$entreprise->logo) }}" alt="{{ $entreprise->nom }}" class="stage-logo">
                @else
                    <div class="stage-logo-placeholder">{{ strtoupper(substr($entreprise->nom, 0, 2)) }}</div>
                @endif
                <div>
                    <h2>{{ $entreprise->nom }}</h2>
                </div>
            </div>
        </div>

        {{-- Missions / Activités de l'AP --}}
        @if($entreprise->activites->count())
        <div class="stage-activites">
            <h3>Missions réalisées ({{ $entreprise->activites->count() }})</h3>
            <div class="stage-activites-list">
                @foreach($entreprise->activites as $activite)
                <a href="{{ route('portfolio.activites.show', $activite->slug) }}" class="stage-act-item">
                    <div class="stage-act-left">
                        <h4>{{ $activite->titre }}</h4>
                        <p>{{ Str::limit($activite->description_courte, 100) }}</p>
                        @if($activite->outils)
                            <div class="activite-tags">
                                @foreach(explode(',', $activite->outils) as $outil)
                                    <span class="tag">{{ trim($outil) }}</span>
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <span class="stage-act-arrow">→</span>
                </a>
                @endforeach
            </div>
        </div>
        @endif

    </div>
    @empty
    <div class="empty-pub">
        <p>Aucune activité professionnelle renseignée pour le moment.</p>
    </div>
    @endforelse

</section>

@endsection
