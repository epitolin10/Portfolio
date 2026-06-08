@extends('layouts.app')
@section('title', 'Activités')

@section('content')

<section class="page-hero">
    <div class="container">
        <span class="section-tag">Option B</span>
        <h1 class="page-title">Mes Activités</h1>
    </div>
</section>

<section class="container section-spaced">

    {{-- Filtres --}}
    <form method="GET" action="{{ route('portfolio.activites') }}" class="filters-bar">
        <div class="filters-left">
            <select name="type" class="filter-select-pub" id="filter-type" onchange="onTypeChange(this)">
                <option value="">Tous les types</option>
                <option value="stage"  {{ request('type') == 'stage'  ? 'selected' : '' }}>Expérience Pro</option>
                <option value="ap"     {{ request('type') == 'ap'     ? 'selected' : '' }}>Atelier Pro</option>
                <option value="projet" {{ request('type') == 'projet' ? 'selected' : '' }}>Projet perso</option>
            </select>

            <select name="stage_id" id="filter-stage" class="filter-select-pub"
                onchange="this.form.submit()"
                style="{{ request('type') == 'stage' ? '' : 'display:none' }}">
                <option value="">Toutes les expériences</option>
                @foreach($stages as $i => $s)
                    <option value="{{ $s->id }}" {{ request('stage_id') == $s->id ? 'selected' : '' }}>
                        Expérience {{ $i + 1 }} — {{ $s->entreprise }}
                    </option>
                @endforeach
            </select>

            @if(request('type') || request('stage_id'))
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
                    <span class="stage-chip">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true" class="meta-icon">
                            <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A32 32 0 0 1 8 14.58a32 32 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10"/>
                            <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4m0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                        </svg>
                        {{ $activite->stage->entreprise }}
                    </span>
                </div>
            @endif

            <div class="acf-footer">
                @if($activite->outils)
                    <div class="activite-tags">
                        @foreach(explode(',', $activite->outils) as $outil)
                            <span class="tag">{{ trim($outil) }}</span>
                        @endforeach
                    </div>
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