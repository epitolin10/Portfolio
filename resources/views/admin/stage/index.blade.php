@extends('layouts.admin')
@section('page-title', 'Gestion des Expériences Pro')

@section('content')

<div class="toolbar">
    <div></div>
    <a href="{{ route('admin.stages.create') }}" class="btn btn-primary">+ Nouveau stage</a>
</div>

<div class="table-wrapper">
    <table class="admin-table">
        <thead>
            <tr>
                <th>Nom du stage</th>
                <th>Entreprise</th>
                <th>Période</th>
                <th>Année BTS</th>
                <th>Activités</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($stages as $stage)
            <tr>
                <td><strong>{{ $stage->nom }}</strong></td>
                <td>
                    {{ $stage->entreprise }}
                    @if($stage->ville)
                        <small class="table-sub">{{ $stage->ville }}</small>
                    @endif
                </td>
                <td>
                    {{ $stage->date_debut->format('d/m/Y') }}
                    <small class="table-sub">→ {{ $stage->date_fin->format('d/m/Y') }}</small>
                </td>
                <td><span class="badge badge-ap">Année {{ $stage->annee }}</span></td>
                <td><span class="badge badge-stage">{{ $stage->activites_count }}</span></td>
                <td>
                    <div class="action-btns">
                        <a href="{{ route('admin.stages.edit', $stage->id) }}" class="btn-icon btn-edit">✎</a>
                        <form method="POST" action="{{ route('admin.stages.destroy', $stage->id) }}"
                              onsubmit="return confirm('Supprimer ce stage ? Les activités liées seront dissociées.')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-icon btn-delete">✕</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="empty-state">
                    <p>Aucun stage renseigné.</p>
                    <a href="{{ route('admin.stages.create') }}" class="btn btn-primary">Ajouter un stage</a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection