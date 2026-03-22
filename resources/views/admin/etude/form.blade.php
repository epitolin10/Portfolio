@extends('layouts.admin')
@section('page-title', isset($etude) ? 'Modifier l\'étude' : 'Nouvelle étude')

@section('content')

<form method="POST"
      action="{{ isset($etude) ? route('admin.etudes.update', $etude->id) : route('admin.etudes.store') }}"
      class="admin-form">
    @csrf
    @if(isset($etude)) @method('PUT') @endif

    <div class="form-card" style="max-width:700px">
        <h3 class="form-card-title">Informations de la formation</h3>

        <div class="form-group">
            <label>Intitulé <span class="required">*</span></label>
            <input type="text" name="intitule" value="{{ old('intitule', $etude->intitule ?? '') }}"
                   class="form-input @error('intitule') error @enderror"
                   placeholder="Ex : BTS SIO option SLAM" required>
            @error('intitule')<span class="form-error">{{ $message }}</span>@enderror
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Établissement <span class="required">*</span></label>
                <input type="text" name="etablissement" value="{{ old('etablissement', $etude->etablissement ?? '') }}"
                       class="form-input @error('etablissement') error @enderror"
                       placeholder="Ex : Lycée Jean Moulin" required>
                @error('etablissement')<span class="form-error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label>Ville</label>
                <input type="text" name="ville" value="{{ old('ville', $etude->ville ?? '') }}"
                       class="form-input" placeholder="Ex : Bordeaux">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Niveau</label>
                <input type="text" name="niveau" value="{{ old('niveau', $etude->niveau ?? '') }}"
                       class="form-input" placeholder="Ex : Bac+2, Baccalauréat...">
            </div>
            <div class="form-group">
                <label>Mention</label>
                <input type="text" name="mention" value="{{ old('mention', $etude->mention ?? '') }}"
                       class="form-input" placeholder="Ex : Mention bien">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Date de début <span class="required">*</span></label>
                <input type="date" name="date_debut"
                       value="{{ old('date_debut', isset($etude) ? $etude->date_debut->format('Y-m-d') : '') }}"
                       class="form-input" required>
                @error('date_debut')<span class="form-error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label>Date de fin <small style="opacity:.6">(laisser vide si en cours)</small></label>
                <input type="date" name="date_fin"
                       value="{{ old('date_fin', isset($etude) && $etude->date_fin ? $etude->date_fin->format('Y-m-d') : '') }}"
                       class="form-input">
                @error('date_fin')<span class="form-error">{{ $message }}</span>@enderror
            </div>
        </div>

        <div class="form-group">
            <label class="form-checkbox-label">
                <input type="hidden" name="en_cours" value="0">
                <input type="checkbox" name="en_cours" value="1"
                       {{ old('en_cours', $etude->en_cours ?? false) ? 'checked' : '' }}>
                Formation en cours
            </label>
        </div>

        <div class="form-group">
            <label>Description</label>
            <textarea name="description" rows="4" class="form-input form-textarea"
                      placeholder="Décrivez la formation, les matières clés, les compétences acquises...">{{ old('description', $etude->description ?? '') }}</textarea>
        </div>

        <div class="form-group" style="max-width:150px">
            <label>Ordre d'affichage</label>
            <input type="number" name="ordre" value="{{ old('ordre', $etude->ordre ?? 0) }}"
                   class="form-input" min="0">
        </div>

        <div style="display:flex; gap:1rem; margin-top:.5rem">
            <button type="submit" class="btn btn-primary">
                {{ isset($etude) ? '✓ Enregistrer' : '+ Créer l\'étude' }}
            </button>
            <a href="{{ route('admin.etudes.index') }}" class="btn btn-ghost">Annuler</a>
        </div>
    </div>
</form>

@endsection
