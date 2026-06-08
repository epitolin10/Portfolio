@extends('layouts.admin')
@section('title', 'Activités')
@section('page-title', 'Gestion des Activités')

@section('content')

<div class="toolbar">
    <div class="toolbar-left">
        <input type="text" id="searchInput" placeholder="Rechercher une activité..." class="search-input">
        <select id="filterType" class="filter-select">
            <option value="">Tous les types</option>
            <option value="stage">Expérience Pro</option>
            <option value="ap">Atelier Pro</option>
            <option value="projet">Projet perso</option>
        </select>
    </div>
    <a href="{{ route('admin.activites.create') }}" class="btn btn-primary">
        + Nouvelle activité
    </a>
</div>

<div class="table-wrapper">
    <table class="admin-table" id="activitesTable">
        <thead>
            <tr>
                <th>Titre</th>
                <th>Type</th>
                <th>Exp. Pro / Atelier</th>
                <th>Date</th>
                <th>Visible</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($activites as $activite)
            <tr data-type="{{ $activite->type }}">
                <td>
                    <strong>{{ $activite->titre }}</strong>
                    <small class="table-sub">{{ Str::limit($activite->description_courte, 60) }}</small>
                </td>
                <td><span class="badge badge-{{ $activite->type }}">{{ ucfirst($activite->type) }}</span></td>
                <td>{{ $activite->stage->nom ?? $activite->ap ?? '—' }}</td>
                <td>{{ $activite->date_realisation->format('d/m/Y') }}</td>
                <td>
                    <label class="toggle">
                        <input type="checkbox" {{ $activite->visible ? 'checked' : '' }}
                            data-id="{{ $activite->id }}"
                            onchange="toggleVisible(this)">
                        <span class="toggle-slider"></span>
                    </label>
                </td>
                <td>
                    <div class="action-btns">
                        <a href="{{ route('admin.activites.edit', $activite->id) }}" class="btn-icon btn-edit" title="Modifier">✎</a>
                        <a href="{{ route('portfolio.activites.show', $activite->slug) }}" class="btn-icon btn-view" title="Voir" target="_blank">↗</a>
                        <form method="POST" action="{{ route('admin.activites.destroy', $activite->id) }}"
                              onsubmit="return confirm('Supprimer cette activité ?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-icon btn-delete" title="Supprimer">✕</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="empty-state">
                    <p>Aucune activité pour l'instant.</p>
                    <a href="{{ route('admin.activites.create') }}" class="btn btn-primary">Créer ma première activité</a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection

@push('scripts')
<script>
function toggleVisible(checkbox) {
    fetch(`/admin/activites/${checkbox.dataset.id}/toggle-visible`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Content-Type': 'application/json'
        }
    });
}

document.getElementById('searchInput').addEventListener('input', function() {
    const val = this.value.toLowerCase();
    document.querySelectorAll('#activitesTable tbody tr').forEach(row => {
        row.style.display = row.textContent.toLowerCase().includes(val) ? '' : 'none';
    });
});
</script>
@endpush