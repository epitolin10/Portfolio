@extends('layouts.app')
@section('title', 'Activités')

@section('content')

<section class="page-hero">
    <div class="container">
        <span class="section-tag">Option B</span>
        <h1 class="page-title">Mes Atelier de Professionalisation</h1>
        <p class="page-desc">Ensemble des réalisations effectuées durant mes stages et ateliers de professionnalisation.</p>
    </div>
</section>

<section class="container section-spaced">

    {{-- Filtres --}}
    <form method="GET" action="{{ route('portfolio.activites') }}" class="filters-bar">
        <div class="filters-left">
            <select name="type" class="filter-select-pub" id="filter-type" onchange="onTypeChange(this)">
                <option value="">Tous les types</option>
                <option value="stage"  {{ request('type') == 'stage'  ? 'selected' : '' }}>Stage</option>
                <option value="ap"     {{ request('type') == 'ap'     ? 'selected' : '' }}>AP</option>
                <option value="projet" {{ request('type') == 'projet' ? 'selected' : '' }}>Projet perso</option>
            </select>

            <select name="stage_id" id="filter-stage" class="filter-select-pub"
                onchange="this.form.submit()"
                style="{{ request('type') == 'stage' ? '' : 'display:none' }}">
                <option value="">Tous les stages</option>
                @foreach($stages as $i => $s)
                    <option value="{{ $s->id }}" {{ request('stage_id') == $s->id ? 'selected' : '' }}>
                        Stage {{ $i + 1 }} — {{ $s->entreprise }}
                    </option>
                @endforeach
            </select>

            @if(request('type') || request('competence') || request('stage_id'))
                <a href="{{ route('portfolio.activites') }}" class="filter-reset">✕ Réinitialiser</a>
            @endif
        </div>
        <span class="filter-count">{{ $activites->total() }} activité(s)</span>
    </form>

    {{-- Grille --}}
    @if($activites->count())
    <div class="activites-grid">
        @foreach($activites as $activite)
        <a href="{{ route('portfolio.activites.show', $activite->slug) }}" class="activite-card-full">
            <div class="acf-top">
                <span class="activite-type {{ $activite->type }}">{{ ucfirst($activite->type) }}</span>
                <span class="activite-date">{{ $activite->date_realisation->format('d/m/Y') }}</span>
            </div>
            <h3>{{ $activite->titre }}</h3>
            <p>{{ Str::limit($activite->description_courte, 130) }}</p>

            @if($activite->stage)
                <div class="acf-stage">
                    <span class="stage-chip">📍 {{ $activite->stage->entreprise }}</span>
                </div>
            @endif

            <div class="acf-footer">
                <div class="activite-tags">
                    @foreach($activite->competences->take(3) as $c)
                        <span class="tag">{{ $c->intitule_court }}</span>
                    @endforeach
                </div>
                @if($activite->outils)
                    <span class="acf-tools">{{ Str::limit($activite->outils, 40) }}</span>
                @endif
            </div>
        </a>
        @endforeach
    </div>

    @else
    <div class="empty-pub">
        <p>Aucune activité trouvée pour ces filtres.</p>
        <a href="{{ route('portfolio.activites') }}" class="btn btn-outline">Voir toutes les activités</a>
    </div>
    @endif

    {{-- Pagination --}}
    @if($activites->hasPages())
    <div class="pagination-pub">
        <div class="pag-inner">
            @if($activites->onFirstPage())
                <span class="pag-btn pag-btn--disabled">← Précédent</span>
            @else
                <a href="{{ $activites->previousPageUrl() }}" class="pag-btn">← Précédent</a>
            @endif

            <span class="pag-info">Page {{ $activites->currentPage() }} / {{ $activites->lastPage() }}</span>

            @if($activites->hasMorePages())
                <a href="{{ $activites->nextPageUrl() }}" class="pag-btn">Suivant →</a>
            @else
                <span class="pag-btn pag-btn--disabled">Suivant →</span>
            @endif
        </div>
    </div>
    @endif

</section>

@push('scripts')
<script>
function onTypeChange(sel) {
    const stageSelect = document.getElementById('filter-stage');
    if (sel.value === 'stage') {
        stageSelect.style.display = '';
    } else {
        stageSelect.style.display = 'none';
        stageSelect.value = '';
    }
    sel.form.submit();
}
</script>
@endpush

@endsection