@extends('layouts.admin')
@section('page-title', isset($stage) ? 'Modifier le stage' : 'Nouveau stage')

@section('content')

<form method="POST"
      action="{{ isset($stage) ? route('admin.stages.update', $stage->id) : route('admin.stages.store') }}"
      enctype="multipart/form-data"
      class="admin-form">
    @csrf
    @if(isset($stage)) @method('PUT') @endif

    <div class="form-card" style="max-width:700px">
        <h3 class="form-card-title">Informations du stage</h3>

        <div class="form-group">
            <label>Nom du stage <span class="required">*</span></label>
            <input type="text" name="nom" value="{{ old('nom', $stage->nom ?? '') }}"
                   class="form-input @error('nom') error @enderror"
                   placeholder="Ex : Stage 1 — DSI Lycée Jean Moulin" required>
            @error('nom')<span class="form-error">{{ $message }}</span>@enderror
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Entreprise / Organisation <span class="required">*</span></label>
                <input type="text" name="entreprise" value="{{ old('entreprise', $stage->entreprise ?? '') }}"
                       class="form-input @error('entreprise') error @enderror"
                       placeholder="Ex : Mairie de Bordeaux" required>
                @error('entreprise')<span class="form-error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label>Secteur d'activité</label>
                <input type="text" name="secteur" value="{{ old('secteur', $stage->secteur ?? '') }}"
                       class="form-input" placeholder="Ex : Administration publique">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Ville</label>
                <input type="text" name="ville" value="{{ old('ville', $stage->ville ?? '') }}"
                       class="form-input" placeholder="Ex : Lyon">
            </div>
            <div class="form-group">
                <label>Maître de stage</label>
                <input type="text" name="maitre_stage" value="{{ old('maitre_stage', $stage->maitre_stage ?? '') }}"
                       class="form-input" placeholder="Prénom Nom">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Date de début <span class="required">*</span></label>
                <input type="date" name="date_debut"
                       value="{{ old('date_debut', isset($stage) ? $stage->date_debut->format('Y-m-d') : '') }}"
                       class="form-input" required>
                @error('date_debut')<span class="form-error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label>Date de fin <span class="required">*</span></label>
                <input type="date" name="date_fin"
                       value="{{ old('date_fin', isset($stage) ? $stage->date_fin->format('Y-m-d') : '') }}"
                       class="form-input" required>
                @error('date_fin')<span class="form-error">{{ $message }}</span>@enderror
            </div>
        </div>

        <div class="form-group">
            <label>Année BTS <span class="required">*</span></label>
            <select name="annee" class="form-input form-select" style="max-width:200px" required>
                <option value="1" {{ old('annee', $stage->annee ?? 1) == 1 ? 'selected' : '' }}>Année 1</option>
                <option value="2" {{ old('annee', $stage->annee ?? 1) == 2 ? 'selected' : '' }}>Année 2</option>
            </select>
        </div>

        <div class="form-group">
            <label>Description de l'entreprise</label>
            <textarea name="description" rows="5" class="form-input form-textarea"
                      placeholder="Présentez l'entreprise, son activité, sa taille...">{{ old('description', $stage->description ?? '') }}</textarea>
        </div>

        <div class="form-group">
            <label>Logo de l'entreprise</label>
            <input type="file" name="logo" accept="image/*" class="form-input form-file">
            @if(isset($stage) && $stage->logo)
                <img src="{{ asset('storage/'.$stage->logo) }}" alt="Logo actuel" style="height:50px; margin-top:.5rem; border-radius:6px;">
            @endif
        </div>

        <div style="display:flex; gap:1rem; margin-top:.5rem">
            <button type="submit" class="btn btn-primary">
                {{ isset($stage) ? '✓ Enregistrer' : '+ Créer le stage' }}
            </button>
            <a href="{{ route('admin.stages.index') }}" class="btn btn-ghost">Annuler</a>
        </div>
    </div>
</form>

@endsection