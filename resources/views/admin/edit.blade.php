@extends('layouts.admin')
@section('page-title', 'Modifier : '.$competence->intitule_court)

@section('content')

<form method="POST" action="{{ route('admin.competences.update', $competence->id) }}" class="admin-form">
    @csrf @method('PUT')

    <div class="form-card" style="max-width:600px">
        <h3 class="form-card-title">{{ $competence->intitule }}</h3>

        <div class="form-group">
            <label>Icône (emoji)</label>
            <input type="text" name="icone" value="{{ old('icone', $competence->icone) }}"
                   class="form-input" style="max-width:80px" maxlength="4">
        </div>

        <div class="form-group">
            <label>Description courte</label>
            <input type="text" name="description_courte"
                   value="{{ old('description_courte', $competence->description_courte) }}"
                   class="form-input" maxlength="255"
                   placeholder="Résumé affiché sur la page d'accueil">
        </div>

        <h4 style="margin:1.5rem 0 .75rem; font-size:.9rem; color:var(--text-muted)">Sous-compétences (lecture seule)</h4>
        <ul style="padding-left:1rem; display:flex; flex-direction:column; gap:.4rem">
            @foreach($competence->sousCompetences as $sc)
                <li style="font-size:.85rem; color:var(--text-muted)">{{ $sc->intitule }}</li>
            @endforeach
        </ul>

        <div style="display:flex; gap:1rem; margin-top:1.5rem">
            <button type="submit" class="btn btn-primary">✓ Enregistrer</button>
            <a href="{{ route('admin.competences.index') }}" class="btn btn-ghost">Annuler</a>
        </div>
    </div>
</form>

@endsection