@extends('layouts.admin')
@section('page-title', 'Compétences acquises')

@section('content')

<div class="toolbar">
    <div class="toolbar-left">
        <span style="font-size:.9rem; color:var(--text-muted);">Vos compétences techniques (HTML, CSS, JS, Frameworks…)</span>
    </div>
    <a href="{{ route('admin.competences-acquises.create') }}" class="btn btn-primary btn-sm">+ Ajouter</a>
</div>

@if($competencesAcquises->count())
    @foreach($competencesAcquises as $categorie => $items)
    <div class="table-wrapper" style="margin-bottom:1.5rem">
        <div style="padding:.9rem 1.2rem; border-bottom:1px solid var(--border); background:var(--bg3);">
            <strong style="font-size:.85rem; text-transform:uppercase; letter-spacing:.06em; color:var(--text-muted);">{{ $categorie }}</strong>
        </div>
        <table class="admin-table">
            <thead>
                <tr>
                    <th style="width:50px"></th>
                    <th>Nom</th>
                    <th>Ordre</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $ca)
                <tr>
                    <td>
                        @if($ca->image)
                            <img src="{{ asset('storage/'.$ca->image) }}" alt="{{ $ca->nom }}" style="width:32px; height:32px; object-fit:contain;">
                        @else
                            <span style="font-size:1.4rem">◈</span>
                        @endif
                    </td>
                    <td><strong>{{ $ca->nom }}</strong></td>
                    <td><span style="font-size:.85rem; color:var(--text-muted);">{{ $ca->ordre }}</span></td>
                    <td>
                        <div class="action-btns">
                            <a href="{{ route('admin.competences-acquises.edit', $ca->id) }}" class="btn-icon btn-edit" title="Modifier">✎</a>
                            <form method="POST" action="{{ route('admin.competences-acquises.destroy', $ca->id) }}"
                                  onsubmit="return confirm('Supprimer cette compétence ?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-icon btn-delete" title="Supprimer">✕</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endforeach
@else
    <div class="empty-state">
        <p>Aucune compétence acquise pour le moment.</p>
        <a href="{{ route('admin.competences-acquises.create') }}" class="btn btn-primary">+ Ajouter une compétence</a>
    </div>
@endif

@endsection
