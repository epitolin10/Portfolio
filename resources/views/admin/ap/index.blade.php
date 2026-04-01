@extends('layouts.admin')
@section('page-title', 'Atelier de Professionalisation')

@section('content')

<div class="toolbar">
    <div></div>
    <a href="{{ route('admin.ap.create') }}" class="btn btn-primary">+ Nouvelle entreprise</a>
</div>

<div class="table-wrapper">
    <table class="admin-table">
        <thead>
            <tr>
                <th>Entreprise</th>
                <th>Missions</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($entreprises as $entreprise)
            <tr>
                <td>
                    <div style="display:flex; align-items:center; gap:.6rem">
                        @if($entreprise->logo)
                            <img src="{{ asset('storage/'.$entreprise->logo) }}" alt="{{ $entreprise->nom }}"
                                 style="height:32px; width:32px; object-fit:contain; border-radius:4px; background:#f1f5f9; padding:2px">
                        @else
                            <div style="height:32px; width:32px; border-radius:4px; background:var(--color-accent-muted); display:flex; align-items:center; justify-content:center; font-weight:700; font-size:.75rem; color:var(--color-accent)">
                                {{ strtoupper(substr($entreprise->nom, 0, 2)) }}
                            </div>
                        @endif
                        <strong>{{ $entreprise->nom }}</strong>
                    </div>
                </td>
                <td><span class="badge badge-stage">{{ $entreprise->activites_count }}</span></td>
                <td>
                    <div class="action-btns">
                        <a href="{{ route('admin.ap.edit', $entreprise->id) }}" class="btn-icon btn-edit">✎</a>
                        <form method="POST" action="{{ route('admin.ap.destroy', $entreprise->id) }}"
                              onsubmit="return confirm('Supprimer cette entreprise ? Les missions associées seront dissociées.')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-icon btn-delete">✕</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="empty-state">
                    <p>Aucune entreprise AP renseignée.</p>
                    <a href="{{ route('admin.ap.create') }}" class="btn btn-primary">Ajouter une entreprise</a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
