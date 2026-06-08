@extends('layouts.app')
@section('title', 'Expériences Professionnelles')

@section('content')

<section class="page-hero">
    <div class="container">
        <span class="section-tag">Parcours</span>
        <h1 class="page-title">Mes expériences professionnelles</h1>
    </div>
</section>

<section class="container section-spaced">

    @php $total = $stages->count(); @endphp

    @if($total === 0)
        <div class="empty-pub">
            <p>Aucune expérience professionnelle renseignée pour le moment.</p>
        </div>
    @else

    {{-- Navigation entre stages --}}
    @if($total > 1)
    <div class="stage-nav">
        <button id="btn-prev" class="btn btn-outline" onclick="changeStage(-1)" disabled>← Expérience précédente</button>
        <span class="stage-nav-indicator" id="stage-indicator">Expérience <span id="stage-current">1</span> / {{ $total }}</span>
        <button id="btn-next" class="btn btn-outline" onclick="changeStage(1)">Expérience suivante →</button>
    </div>
    @endif

    @foreach($stages as $index => $stage)
    <div class="stage-block" id="stage-{{ $index }}" @if($index > 0) style="display:none" @endif>
        <div class="stage-block-header">
            <div class="stage-num">Expérience {{ $index + 1 }}</div>
            <div class="stage-block-info">
                @if($stage->logo)
                    <img src="{{ asset('storage/'.$stage->logo) }}" alt="{{ $stage->entreprise }}" class="stage-logo">
                @else
                    <div class="stage-logo-placeholder">{{ strtoupper(substr($stage->entreprise, 0, 2)) }}</div>
                @endif
                <div>
                    <h2>{{ $stage->nom }}</h2>
                    <p class="stage-entreprise">{{ $stage->entreprise }}</p>
                    <div class="stage-meta-chips">
                        @if($stage->ville)
                            <span class="meta-chip">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true" class="meta-icon">
                                    <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A32 32 0 0 1 8 14.58a32 32 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10"/>
                                    <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4m0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                                </svg>
                                {{ $stage->ville }}
                            </span>
                        @endif
                        @if($stage->secteur)
                            <span class="meta-chip">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true" class="meta-icon">
                                    <path d="M3 0a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h3v-3.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5V16h3a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1zm1 2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3.5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5M4 5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zM7.5 5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5m2.5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3.5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5"/>
                                </svg>
                                {{ $stage->secteur }}
                            </span>
                        @endif
                        <span class="meta-chip">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true" class="meta-icon">
                                <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"/>
                            </svg>
                            {{ $stage->date_debut->format('d/m/Y') }} → {{ $stage->date_fin->format('d/m/Y') }}
                        </span>
                        <span class="meta-chip">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true" class="meta-icon">
                                <path d="M8.5 5.6a.5.5 0 1 0-1 0v2.9h-3a.5.5 0 0 0 0 1H8a.5.5 0 0 0 .5-.5z"/>
                                <path d="M6.5 1A.5.5 0 0 1 7 .5h2a.5.5 0 0 1 0 1v.57c1.36.196 2.594.78 3.584 1.64l.012-.013.354-.354-.354-.353a.5.5 0 0 1 .707-.708l1.414 1.415a.5.5 0 1 1-.707.707l-.353-.354-.354.354-.013.012A7 7 0 1 1 7 2.071V1.5a.5.5 0 0 1-.5-.5M8 3a6 6 0 1 0 .001 12A6 6 0 0 0 8 3"/>
                            </svg>
                            {{ $stage->duree }}
                        </span>
                        @if($stage->maitre_stage)
                            <span class="meta-chip">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true" class="meta-icon">
                                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
                                </svg>
                                Maître de stage : {{ $stage->maitre_stage }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        @if($stage->description)
        <div class="stage-description">
            <h3>Présentation de l'entreprise</h3>
            <p>{{ $stage->description }}</p>
        </div>
        @endif

        @if($stage->activites->count())
        <div class="stage-activites">
            <h3>Activités réalisées ({{ $stage->activites->count() }})</h3>
            <div class="stage-activites-list">
                @foreach($stage->activites as $activite)
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
    @endforeach

    @endif

</section>

@if($total > 1)
@push('scripts')
<script>
const total = {{ $total }};
let current = 0;

function changeStage(direction) {
    document.getElementById('stage-' + current).style.display = 'none';
    current += direction;
    document.getElementById('stage-' + current).style.display = 'block';
    document.getElementById('stage-current').textContent = current + 1;
    document.getElementById('btn-prev').disabled = current === 0;
    document.getElementById('btn-next').disabled = current === total - 1;
    window.scrollTo({ top: document.querySelector('.stage-nav').offsetTop - 80, behavior: 'smooth' });
}
</script>
@endpush
@endif

@endsection