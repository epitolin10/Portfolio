@extends('layouts.admin')
@section('page-title', isset($ap) ? 'Modifier l\'entreprise' : 'Nouvelle entreprise AP')

@section('content')

<form method="POST"
      action="{{ isset($ap) ? route('admin.ap.update', $ap->id) : route('admin.ap.store') }}"
      enctype="multipart/form-data"
      class="admin-form">
    @csrf
    @if(isset($ap)) @method('PUT') @endif

    <div class="form-card" style="max-width:500px">
        <h3 class="form-card-title">Informations de l'entreprise</h3>

        <div class="form-group">
            <label>Nom de l'entreprise <span class="required">*</span></label>
            <input type="text" name="nom" value="{{ old('nom', $ap->nom ?? '') }}"
                   class="form-input @error('nom') error @enderror"
                   placeholder="Ex : Mairie de Bordeaux" required>
            @error('nom')<span class="form-error">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
            <label>Logo de l'entreprise</label>
            <input type="file" name="logo" accept="image/*" class="form-input form-file">
            @if(isset($ap) && $ap->logo)
                <img src="{{ asset('storage/'.$ap->logo) }}" alt="Logo actuel"
                     style="height:50px; margin-top:.5rem; border-radius:6px;">
            @endif
        </div>

        <div style="display:flex; gap:1rem; margin-top:.5rem">
            <button type="submit" class="btn btn-primary">
                {{ isset($ap) ? '✓ Enregistrer' : '+ Créer l\'entreprise' }}
            </button>
            <a href="{{ route('admin.ap.index') }}" class="btn btn-ghost">Annuler</a>
        </div>
    </div>
</form>

@endsection
