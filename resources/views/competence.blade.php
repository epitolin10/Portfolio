@extends('layouts.app')
@section('title', 'Compétences techniques')

@section('content')

<section class="page-hero">
    <div class="container">
        <span class="section-tag">Compétences</span>
        <h1 class="page-title">Mes Compétences</h1>
    </div>
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