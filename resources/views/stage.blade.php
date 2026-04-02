@extends('layouts.app')
@section('title', 'Mes Stages')

@section('content')

<section class="page-hero">
    <div class="container">
        <span class="section-tag">Parcours</span>
        <h1 class="page-title">Mes stages</h1>
        <p class="page-desc">Présentation des entreprises d'accueil et des missions effectuées durant mes deux années de BTS SIO.</p>
    </div>
</section>

<section class="container section-spaced">

    @php $total = $stages->count(); @endphp

    @if($total === 0)
        <div class="empty-pub">
            <p>Aucun stage renseigné pour le moment.</p>
        </div>
    @else

    {{-- Navigation entre stages --}}
    @if($total > 1)
    <div class="stage-nav">
        <button id="btn-prev" class="btn btn-outline" onclick="changeStage(-1)" disabled>← Stage précédent</button>
        <span class="stage-nav-indicator" id="stage-indicator">Stage <span id="stage-current">1</span> / {{ $total }}</span>
        <button id="btn-next" class="btn btn-outline" onclick="changeStage(1)">Stage suivant →</button>
    </div>
    @endif

    @foreach($stages as $index => $stage)
    <div class="stage-block" id="stage-{{ $index }}" @if($index > 0) style="display:none" @endif>
        <div class="stage-block-header">
            <div class="stage-num">Stage {{ $index + 1 }}</div>
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
                            <span class="meta-chip">📍 {{ $stage->ville }}</span>
                        @endif
                        @if($stage->secteur)
                            <span class="meta-chip">🏢 {{ $stage->secteur }}</span>
                        @endif
                        <span class="meta-chip">📅 {{ $stage->date_debut->format('d/m/Y') }} → {{ $stage->date_fin->format('d/m/Y') }}</span>
                        <span class="meta-chip">⏱ {{ $stage->duree }}</span>
                        @if($stage->maitre_stage)
                            <span class="meta-chip">👤 Maître de stage : {{ $stage->maitre_stage }}</span>
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
                        <div class="activite-tags">
                            @foreach($activite->competences->take(3) as $c)
                                <span class="tag">{{ $c->intitule_court }}</span>
                            @endforeach
                        </div>
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