@extends('layouts.admin')
@section('page-title', 'Compétences B1')

@section('content')

<div class="table-wrapper">
    <table class="admin-table">
        <thead>
            <tr>
                <th>Bloc</th>
                <th>Intitulé officiel</th>
                <th>Description courte</th>
                <th>Activités</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($competences as $comp)
            <tr>
                <td>
                    <span style="font-size:1.4rem">{{ $comp->icone }}</span>
                </td>
                <td>
                    <strong>{{ $comp->intitule_court }}</strong>
                    <small class="table-sub">{{ $comp->intitule }}</small>
                </td>
                <td>{{ $comp->description_courte ?? '—' }}</td>
                <td>
                    <span class="badge badge-stage">{{ $comp->activites_count }}</span>
                </td>
                <td>
                    <a href="{{ route('admin.competences.edit', $comp->id) }}" class="btn-icon btn-edit" title="Modifier">✎</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<p style="margin-top:1rem; font-size:.85rem; color:var(--text-muted);">
    Les intitulés officiels sont fixes (référentiel BTS SIO). Vous pouvez modifier la description courte et l'icône.
</p>

@endsection