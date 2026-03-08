@extends('layouts.app')
@section('title', 'Compétences B1')

@section('content')

<section class="page-hero">
    <div class="container">
        <span class="section-tag">Bloc B1</span>
        <h1 class="page-title">Compétences acquises</h1>
        <p class="page-desc">Présentation de mes compétences par blocs B1, illustrées par les activités réalisées en stage et en AP.</p>
    </div>
</section>

<section class="container section-spaced">

    {{-- Filtres rapides --}}
    <div class="filter-tabs">
        <button class="filter-tab active" data-filter="all">Tous les blocs</button>
        @foreach($competences as $comp)
            <button class="filter-tab" data-filter="{{ $comp->slug }}">{{ $comp->intitule_court }}</button>
        @endforeach
    </div>

    {{-- Blocs de compétences --}}
    @foreach($competences as $comp)
    <div class="bloc-competence" id="{{ $comp->slug }}" data-bloc="{{ $comp->slug }}">

        <div class="bloc-header">
            <div class="bloc-header-left">
                <span class="bloc-icon">{{ $comp->icone }}</span>
                <div>
                    <h2 class="bloc-title">{{ $comp->intitule }}</h2>
                    <p class="bloc-desc">{{ $comp->description_courte }}</p>
                </div>
            </div>
            <div class="bloc-stats">
                <span class="bloc-count">{{ $comp->activites->count() }} activité(s)</span>
            </div>
        </div>

        {{-- Sous-compétences --}}
        @if($comp->sousCompetences->count())
        <div class="sous-comp-tags">
            @foreach($comp->sousCompetences as $sc)
                <span class="sc-tag {{ $comp->activites->whereIn('id', $sc->activites->pluck('id') ?? [])->count() ? 'sc-tag--active' : '' }}">
                    {{ $sc->intitule }}
                </span>
            @endforeach
        </div>
        @endif

        {{-- Activités liées --}}
        @if($comp->activites->count())
        <div class="bloc-activites">
            @foreach($comp->activites as $activite)
            <a href="{{ route('portfolio.activites.show', $activite->slug) }}" class="mini-card">
                <div class="mini-card-top">
                    <span class="activite-type {{ $activite->type }}">{{ ucfirst($activite->type) }}</span>
                    <span class="activite-date">{{ $activite->date_realisation->format('M Y') }}</span>
                </div>
                <h3>{{ $activite->titre }}</h3>
                <p>{{ Str::limit($activite->description_courte, 100) }}</p>
                @if($activite->outils)
                <div class="mini-card-tools">
                    @foreach(explode(',', $activite->outils) as $outil)
                        <span class="tool-tag">{{ trim($outil) }}</span>
                    @endforeach
                </div>
                @endif
                <span class="mini-card-link">Voir le détail →</span>
            </a>
            @endforeach
        </div>
        @else
        <div class="bloc-empty">
            <p>Aucune activité associée à ce bloc pour le moment.</p>
        </div>
        @endif

    </div>
    @endforeach

</section>

@endsection

@push('scripts')
<script>
document.querySelectorAll('.filter-tab').forEach(btn => {
    btn.addEventListener('click', function() {
        document.querySelectorAll('.filter-tab').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        const filter = this.dataset.filter;
        document.querySelectorAll('.bloc-competence').forEach(bloc => {
            bloc.style.display = (filter === 'all' || bloc.dataset.bloc === filter) ? '' : 'none';
        });
    });
});
</script>
@endpush