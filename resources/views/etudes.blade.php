@extends('layouts.app')
@section('title', 'Mes Études')

@section('content')

<section class="page-hero">
    <div class="container">
        <span class="section-tag">Parcours académique</span>
        <h1 class="page-title">Mes études</h1>
        <p class="page-desc">Formations et diplômes obtenus tout au long de mon parcours scolaire.</p>
    </div>
</section>

<section class="container section-spaced">

    @forelse($etudes as $etude)
    <div class="stage-block">
        <div class="stage-block-header">
            <div class="stage-num">{{ $loop->iteration }}</div>
            <div class="stage-block-info">
                <div class="stage-logo-placeholder" style="font-size:.85rem; font-weight:700; letter-spacing:.05em;">
                    {{ strtoupper(substr($etude->niveau ?? 'ÉT', 0, 3)) }}
                </div>
                <div>
                    <h2>{{ $etude->intitule }}</h2>
                    <p class="stage-entreprise">{{ $etude->etablissement }}</p>
                    <div class="stage-meta-chips">
                        @if($etude->ville)
                            <span class="meta-chip">📍 {{ $etude->ville }}</span>
                        @endif
                        @if($etude->niveau)
                            <span class="meta-chip">🎓 {{ $etude->niveau }}</span>
                        @endif
                        <span class="meta-chip">📅 {{ $etude->duree }}</span>
                        @if($etude->en_cours)
                            <span class="meta-chip" style="background:rgba(var(--color-accent-rgb),.15); color:var(--color-accent);">⏳ En cours</span>
                        @endif
                        @if($etude->mention)
                            <span class="meta-chip">🏅 {{ $etude->mention }}</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        @if($etude->description)
        <div class="stage-description">
            <h3>Présentation</h3>
            <p>{{ $etude->description }}</p>
        </div>
        @endif
    </div>
    @empty
    <div class="empty-state" style="text-align:center; padding:4rem 0;">
        <p>Aucune étude renseignée pour le moment.</p>
    </div>
    @endforelse

</section>

@endsection
