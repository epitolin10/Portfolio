@extends('layouts.admin')
@section('title', 'Profil')
@section('page-title', 'Mon Profil')

@section('content')

<form method="POST" action="{{ route('admin.profil.update') }}" enctype="multipart/form-data" class="admin-form">
    @csrf @method('PUT')

    <div class="form-card" style="max-width:680px">
        <h3 class="form-card-title">Informations personnelles</h3>

        {{-- Photo de profil --}}
        <div class="form-group">
            <label>Photo de profil</label>

            @if($profil && $profil->photo)
                <div style="margin-bottom:.75rem">
                    <img src="{{ asset('storage/'.$profil->photo) }}"
                         alt="Photo de profil actuelle"
                         style="width:100px;height:100px;object-fit:cover;border-radius:50%;border:2px solid var(--border)">
                </div>
            @endif

            <input type="file" name="photo" id="photo" accept="image/*" class="form-input" style="padding:.4rem">
            <small style="color:var(--text-muted)">JPEG, PNG, WEBP — max 3 Mo. Laissez vide pour conserver la photo actuelle.</small>
            @error('photo') <span class="form-error">{{ $message }}</span> @enderror
        </div>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem">
            <div class="form-group">
                <label>Prénom <span style="color:var(--accent)">*</span></label>
                <input type="text" name="prenom"
                       value="{{ old('prenom', $profil->prenom ?? '') }}"
                       class="form-input @error('prenom') is-invalid @enderror"
                       required maxlength="255">
                @error('prenom') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label>Nom <span style="color:var(--accent)">*</span></label>
                <input type="text" name="nom"
                       value="{{ old('nom', $profil->nom ?? '') }}"
                       class="form-input @error('nom') is-invalid @enderror"
                       required maxlength="255">
                @error('nom') <span class="form-error">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email"
                   value="{{ old('email', $profil->email ?? '') }}"
                   class="form-input @error('email') is-invalid @enderror"
                   maxlength="255">
            @error('email') <span class="form-error">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label>Option BTS <span style="color:var(--accent)">*</span></label>
            <select name="option" class="form-input" required>
                <option value="SLAM" {{ old('option', $profil->option ?? 'SLAM') === 'SLAM' ? 'selected' : '' }}>SLAM</option>
                <option value="SISR" {{ old('option', $profil->option ?? '') === 'SISR' ? 'selected' : '' }}>SISR</option>
            </select>
            @error('option') <span class="form-error">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label>Bio</label>
            <textarea name="bio" rows="5"
                      class="form-input @error('bio') is-invalid @enderror"
                      placeholder="Quelques mots sur vous...">{{ old('bio', $profil->bio ?? '') }}</textarea>
            @error('bio') <span class="form-error">{{ $message }}</span> @enderror
        </div>

        <h3 class="form-card-title" style="margin-top:1.5rem">Liens</h3>

        <div class="form-group">
            <label>LinkedIn</label>
            <input type="url" name="linkedin"
                   value="{{ old('linkedin', $profil->linkedin ?? '') }}"
                   class="form-input @error('linkedin') is-invalid @enderror"
                   placeholder="https://linkedin.com/in/..." maxlength="255">
            @error('linkedin') <span class="form-error">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label>GitHub</label>
            <input type="url" name="github"
                   value="{{ old('github', $profil->github ?? '') }}"
                   class="form-input @error('github') is-invalid @enderror"
                   placeholder="https://github.com/..." maxlength="255">
            @error('github') <span class="form-error">{{ $message }}</span> @enderror
        </div>

        <div style="display:flex;gap:1rem;margin-top:1.5rem">
            <button type="submit" class="btn btn-primary">✓ Enregistrer</button>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-ghost">Annuler</a>
        </div>
    </div>
</form>

@endsection
