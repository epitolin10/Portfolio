@extends('layouts.app')
@section('title', 'Compétences B1')

@section('content')

<section class="page-hero">
    <div class="container">
        <span class="section-tag">Bloc B1</span>
        <h1 class="page-title">Compétences B1</h1>
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
        </div>

        {{-- Sous-compétences --}}
        @if($comp->sousCompetences->count())
        <div class="sous-comp-tags">
            @foreach($comp->sousCompetences as $sc)
                <span class="sc-tag">
                    {{ $sc->intitule }}
                </span>
            @endforeach
        </div>
        @endif



    </div>
    @endforeach

</section>

{{-- Compétences acquises (skills techniques) --}}
@if($competencesAcquises->count())
<section class="section-skills">
    <div class="container">
        <div class="section-header">
            <span class="section-tag">Compétences</span>
            <h2>Compétences acquises</h2>
            <p class="page-desc" style="margin-top:.5rem;">Les technologies et outils que je maîtrise.</p>
        </div>

        <div class="skills-categories">
            @foreach($competencesAcquises as $categorie => $items)
            <div class="skills-category">
                <h3 class="skills-cat-title">{{ $categorie }}</h3>
                <div class="skills-list">
                    @foreach($items as $ca)
                    <div class="skill-item">
                        <div class="skill-header">
                            @if($ca->image)
                                <img src="{{ asset('storage/'.$ca->image) }}" alt="{{ $ca->nom }}" class="skill-icon-img">
                            @endif
                            <span class="skill-name">{{ $ca->nom }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

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