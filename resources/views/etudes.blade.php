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
                            <span class="meta-chip">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true" class="meta-icon">
                                    <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A32 32 0 0 1 8 14.58a32 32 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10"/>
                                    <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4m0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                                </svg>
                                {{ $etude->ville }}
                            </span>
                        @endif
                        @if($etude->niveau)
                            <span class="meta-chip">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true" class="meta-icon">
                                    <path d="M8.211 2.047a.5.5 0 0 0-.422 0l-7.5 3.5a.5.5 0 0 0 .025.917l7.5 3a.5.5 0 0 0 .372 0L14 7.14V13a1 1 0 0 0-1 1v2h3v-2a1 1 0 0 0-1-1V6.739l.686-.275a.5.5 0 0 0 .025-.917zM8 8.46 1.758 5.965 8 3.052l6.242 2.913z"/>
                                    <path d="M4.176 9.032a.5.5 0 0 0-.656.327l-.5 1.7a.5.5 0 0 0 .294.605l4.5 1.8a.5.5 0 0 0 .372 0l4.5-1.8a.5.5 0 0 0 .294-.605l-.5-1.7a.5.5 0 0 0-.656-.327L8 10.466zm-.068 1.873.22-.748 3.496 1.311a.5.5 0 0 0 .352 0l3.496-1.311.22.748L8 12.46z"/>
                                </svg>
                                {{ $etude->niveau }}
                            </span>
                        @endif
                        <span class="meta-chip">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true" class="meta-icon">
                                <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"/>
                            </svg>
                            {{ $etude->duree }}
                        </span>
                        @if($etude->en_cours)
                            <span class="meta-chip" style="background:rgba(var(--color-accent-rgb),.15); color:var(--color-accent);">⏳ En cours</span>
                        @endif
                        @if($etude->mention)
                            <span class="meta-chip">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true" class="meta-icon">
                                    <path d="M9.669.864 8 0 6.331.864l-1.858.282-.842 1.68-1.337 1.32L2.6 6l-.306 1.854 1.337 1.32.842 1.68 1.858.282L8 12l1.669-.864 1.858-.282.842-1.68 1.337-1.32L13.4 6l.306-1.854-1.337-1.32-.842-1.68zm1.196 1.193.684 1.365 1.086 1.072L12.387 6l.248 1.506-1.086 1.072-.684 1.365-1.51.229L8 10.874l-1.355-.702-1.51-.229-.684-1.365-1.086-1.072L3.614 6l-.25-1.506 1.087-1.072.684-1.365 1.51-.229L8 1.126l1.356.702z"/>
                                    <path d="M4 11.794V16l4-1 4 1v-4.206l-2.018.306L8 13.126 6.018 12.1z"/>
                                </svg>
                                {{ $etude->mention }}
                            </span>
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
