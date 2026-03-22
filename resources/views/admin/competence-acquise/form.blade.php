@extends('layouts.admin')
@section('page-title', isset($competenceAcquise) ? 'Modifier : '.$competenceAcquise->nom : 'Nouvelle compétence acquise')

@section('content')

<form method="POST"
      action="{{ isset($competenceAcquise) ? route('admin.competences-acquises.update', $competenceAcquise->id) : route('admin.competences-acquises.store') }}"
      class="admin-form"
      enctype="multipart/form-data">
    @csrf
    @if(isset($competenceAcquise)) @method('PUT') @endif

    <div class="form-card" style="max-width:600px">
        <h3 class="form-card-title">{{ isset($competenceAcquise) ? 'Modifier la compétence' : 'Ajouter une compétence acquise' }}</h3>

        <div class="form-group">
            <label for="nom">Nom <span class="required">*</span></label>
            <input type="text" id="nom" name="nom"
                   value="{{ old('nom', $competenceAcquise->nom ?? '') }}"
                   placeholder="Ex : HTML, CSS, JavaScript, Laravel…"
                   class="form-input @error('nom') error @enderror" required>
            @error('nom')<span class="form-error">{{ $message }}</span>@enderror
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="categorie">Catégorie <span class="required">*</span></label>
                <input type="text" id="categorie" name="categorie"
                       value="{{ old('categorie', $competenceAcquise->categorie ?? '') }}"
                       placeholder="Ex : Langages, Frameworks, Outils"
                       class="form-input @error('categorie') error @enderror"
                       list="categories-list" required>
                <datalist id="categories-list">
                    <option value="Langages">
                    <option value="Frameworks">
                    <option value="Outils">
                    <option value="Bases de données">
                    <option value="Systèmes & Réseaux">
                </datalist>
                @error('categorie')<span class="form-error">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" id="image" name="image"
                       accept="image/*"
                       class="form-input form-file">
                @if(isset($competenceAcquise) && $competenceAcquise->image)
                    <div style="margin-top:.5rem">
                        <img src="{{ asset('storage/'.$competenceAcquise->image) }}" alt="{{ $competenceAcquise->nom }}" style="width:40px; height:40px; object-fit:contain; border-radius:6px; border:1px solid var(--border);">
                    </div>
                @endif
            </div>
        </div>

        <div class="form-group">
            <label for="ordre">Ordre d'affichage</label>
            <input type="number" id="ordre" name="ordre"
                   value="{{ old('ordre', $competenceAcquise->ordre ?? 0) }}"
                   min="0"
                   class="form-input">
        </div>

        <div style="display:flex; gap:1rem; margin-top:1.5rem">
            <button type="submit" class="btn btn-primary">
                {{ isset($competenceAcquise) ? '✓ Enregistrer' : '+ Ajouter' }}
            </button>
            <a href="{{ route('admin.competences-acquises.index') }}" class="btn btn-ghost">Annuler</a>
        </div>
    </div>
</form>

@endsection
