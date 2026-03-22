@extends('layouts.admin')
@section('page-title', 'Gestion des Études')

@section('content')

<div class="toolbar">
    <div></div>
    <a href="{{ route('admin.etudes.create') }}" class="btn btn-primary">+ Nouvelle étude</a>
</div>

<div class="table-wrapper">
    <table class="admin-table">
        <thead>
            <tr>
                <th>Intitulé</th>
                <th>Établissement</th>
                <th>Niveau</th>
                <th>Période</th>
                <th>Statut</th>
                <th>Ordre</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($etudes as $etude)
            <tr>
                <td><strong>{{ $etude->intitule }}</strong></td>
                <td>
                    {{ $etude->etablissement }}
                    @if($etude->ville)
                        <small class="table-sub">{{ $etude->ville }}</small>
                    @endif
                </td>
                <td>{{ $etude->niveau ?? '—' }}</td>
                <td>
                    {{ $etude->date_debut->format('Y') }}
                    @if($etude->en_cours)
                        <small class="table-sub">→ en cours</small>
                    @elseif($etude->date_fin)
                        <small class="table-sub">→ {{ $etude->date_fin->format('Y') }}</small>
                    @endif
                </td>
                <td>
                    @if($etude->en_cours)
                        <span class="badge badge-ap">En cours</span>
                    @else
                        <span class="badge badge-stage">Terminé</span>
                    @endif
                </td>
                <td>{{ $etude->ordre }}</td>
                <td>
                    <div class="action-btns">
                        <a href="{{ route('admin.etudes.edit', $etude->id) }}" class="btn-icon btn-edit">✎</a>
                        <form method="POST" action="{{ route('admin.etudes.destroy', $etude->id) }}"
                              onsubmit="return confirm('Supprimer cette étude ?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-icon btn-delete">✕</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="empty-state">
                    <p>Aucune étude renseignée.</p>
                    <a href="{{ route('admin.etudes.create') }}" class="btn btn-primary">Ajouter une étude</a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
