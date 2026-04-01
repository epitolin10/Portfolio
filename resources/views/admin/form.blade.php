@extends('layouts.admin')
@section('title', isset($activite) ? 'Modifier l\'activité' : 'Nouvelle activité')
@section('page-title', isset($activite) ? 'Modifier : '.$activite->titre : 'Nouvelle activité')

@section('content')

<form method="POST"
      action="{{ isset($activite) ? route('admin.activites.update', $activite->id) : route('admin.activites.store') }}"
      enctype="multipart/form-data"
      class="admin-form">
    @csrf
    @if(isset($activite)) @method('PUT') @endif

    <div class="form-grid">

        {{-- COLONNE GAUCHE --}}
        <div class="form-col">

            <div class="form-card">
                <h3 class="form-card-title">Informations générales</h3>

                <div class="form-group">
                    <label for="titre">Titre de l'activité <span class="required">*</span></label>
                    <input type="text" id="titre" name="titre"
                           value="{{ old('titre', $activite->titre ?? '') }}"
                           placeholder="Ex : Déploiement d'un serveur DHCP"
                           class="form-input @error('titre') error @enderror" required>
                    @error('titre')<span class="form-error">{{ $message }}</span>@enderror
                </div>

                <div class="form-group">
                    <label for="description_courte">Description courte <span class="required">*</span></label>
                    <input type="text" id="description_courte" name="description_courte"
                           value="{{ old('description_courte', $activite->description_courte ?? '') }}"
                           placeholder="Résumé en une phrase"
                           class="form-input @error('description_courte') error @enderror" required>
                    @error('description_courte')<span class="form-error">{{ $message }}</span>@enderror
                </div>

                <div class="form-group">
                    <label for="description">Description détaillée <span class="required">*</span></label>
                    <textarea id="description" name="description" rows="8"
                              class="form-input form-textarea @error('description') error @enderror"
                              placeholder="Décrivez le contexte, les actions réalisées, les outils utilisés...">{{ old('description', $activite->description ?? '') }}</textarea>
                    @error('description')<span class="form-error">{{ $message }}</span>@enderror
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="type">Type <span class="required">*</span></label>
                        <select id="type" name="type" class="form-input form-select" required>
                            <option value="stage" {{ old('type', $activite->type ?? '') == 'stage' ? 'selected' : '' }}>Stage</option>
                            <option value="ap" {{ old('type', $activite->type ?? '') == 'ap' ? 'selected' : '' }}>AP</option>
                            <option value="projet" {{ old('type', $activite->type ?? '') == 'projet' ? 'selected' : '' }}>Projet perso</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="date_realisation">Date de réalisation <span class="required">*</span></label>
                        <input type="date" id="date_realisation" name="date_realisation"
                               value="{{ old('date_realisation', isset($activite) ? $activite->date_realisation->format('Y-m-d') : '') }}"
                               class="form-input" required>
                    </div>
                </div>

                <div class="form-group" id="stageGroup">
                    <label for="stage_id">Stage associé</label>
                    <select id="stage_id" name="stage_id" class="form-input form-select">
                        <option value="">— Aucun —</option>
                        @foreach($stages as $stage)
                            <option value="{{ $stage->id }}"
                                {{ old('stage_id', $activite->stage_id ?? '') == $stage->id ? 'selected' : '' }}>
                                {{ $stage->nom }} ({{ $stage->entreprise }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group" id="apGroup" style="display:none">
                    <label for="ap">Nom de l'AP</label>
                    <input type="text" id="ap" name="ap"
                           value="{{ old('ap', $activite->ap ?? '') }}"
                           placeholder="Ex : AP réseau – semestre 3"
                           class="form-input">
                </div>

                <div class="form-group" id="entrepriseApGroup" style="display:none">
                    <label for="entreprise_ap_id">Entreprise AP associée</label>
                    <select id="entreprise_ap_id" name="entreprise_ap_id" class="form-input form-select">
                        <option value="">— Aucune —</option>
                        @foreach($entreprisesAp ?? [] as $entrepriseAp)
                            <option value="{{ $entrepriseAp->id }}"
                                {{ old('entreprise_ap_id', $activite->entreprise_ap_id ?? '') == $entrepriseAp->id ? 'selected' : '' }}>
                                {{ $entrepriseAp->nom }}{{ $entrepriseAp->ville ? ' ('.$entrepriseAp->ville.')' : '' }}
                            </option>
                        @endforeach
                    </select>
                    @if(($entreprisesAp ?? collect())->isEmpty())
                        <small class="form-hint">
                            <a href="{{ route('admin.ap.create') }}" target="_blank">Créer une entreprise AP</a> d'abord.
                        </small>
                    @endif
                </div>
            </div>

            <div class="form-card">
                <h3 class="form-card-title">Livrables & preuves</h3>

                <div class="form-group">
                    <label for="outils">Outils / Technologies utilisés</label>
                    <input type="text" id="outils" name="outils"
                           value="{{ old('outils', $activite->outils ?? '') }}"
                           placeholder="Ex : Cisco Packet Tracer, Windows Server 2019, Linux"
                           class="form-input">
                </div>

                <div class="form-group">
                    <label for="captures">Captures d'écran / Fichiers (preuves)</label>
                    <input type="file" id="captures" name="captures[]"
                           multiple accept="image/*,.pdf"
                           class="form-input form-file">
                    <small class="form-hint">Formats acceptés : JPG, PNG, PDF. Max 5 fichiers.</small>

                    @if(isset($activite) && $activite->captures->count())
                    <div class="captures-preview">
                        @foreach($activite->captures as $capture)
                        <div class="capture-item">
                            <img src="{{ asset('storage/'.$capture->chemin) }}" alt="">
                            <button type="button" class="capture-delete" data-id="{{ $capture->id }}">✕</button>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="lien_externe">Lien externe (GitHub, doc...)</label>
                    <input type="url" id="lien_externe" name="lien_externe"
                           value="{{ old('lien_externe', $activite->lien_externe ?? '') }}"
                           placeholder="https://github.com/..."
                           class="form-input">
                </div>
            </div>
        </div>

        {{-- COLONNE DROITE --}}
        <div class="form-col form-col-aside">

            <div class="form-card">
                <h3 class="form-card-title">Options</h3>
                <label class="toggle-label">
                    <input type="checkbox" name="visible" value="1"
                           {{ old('visible', $activite->visible ?? true) ? 'checked' : '' }}>
                    <span class="toggle-slider-inline"></span>
                    Visible sur le portfolio public
                </label>

                <label class="toggle-label mt-2">
                    <input type="checkbox" name="mise_en_avant" value="1"
                           {{ old('mise_en_avant', $activite->mise_en_avant ?? false) ? 'checked' : '' }}>
                    <span class="toggle-slider-inline"></span>
                    Mettre en avant sur l'accueil
                </label>
            </div>

            <div class="form-actions-sticky">
                <button type="submit" class="btn btn-primary btn-full">
                    {{ isset($activite) ? '✓ Enregistrer les modifications' : '+ Créer l\'activité' }}
                </button>
                <a href="{{ route('admin.activites.index') }}" class="btn btn-ghost btn-full">Annuler</a>
            </div>
        </div>

    </div>
</form>

@endsection

@push('scripts')
<script>
const typeSelect = document.getElementById('type');
const stageGroup = document.getElementById('stageGroup');
const apGroup = document.getElementById('apGroup');
const entrepriseApGroup = document.getElementById('entrepriseApGroup');

function updateTypeVisibility() {
    stageGroup.style.display = typeSelect.value === 'stage' ? '' : 'none';
    apGroup.style.display = typeSelect.value === 'ap' ? '' : 'none';
    entrepriseApGroup.style.display = typeSelect.value === 'ap' ? '' : 'none';
}

typeSelect.addEventListener('change', updateTypeVisibility);
updateTypeVisibility();
</script>
@endpush