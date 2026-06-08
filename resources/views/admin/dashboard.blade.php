@extends('layouts.admin')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')

<div class="dash-stats">
    <div class="stat-card">
        <div class="stat-card-icon">◈</div>
        <div class="stat-card-body">
            <span class="stat-card-num">{{ $stats['activites'] }}</span>
            <span class="stat-card-label">Activités totales</span>
        </div>
        <a href="{{ route('admin.activites.index') }}" class="stat-card-link">Gérer →</a>
    </div>
    <div class="stat-card">
        <div class="stat-card-icon">⚡</div>
        <div class="stat-card-body">
            <span class="stat-card-num">{{ $stats['competences_acquises'] }}</span>
            <span class="stat-card-label">Compétences acquises</span>
        </div>
        <a href="{{ route('admin.competences-acquises.index') }}" class="stat-card-link">Gérer →</a>
    </div>
    <div class="stat-card">
        <div class="stat-card-icon">◎</div>
        <div class="stat-card-body">
            <span class="stat-card-num">{{ $stats['stages'] }}</span>
            <span class="stat-card-label">Expériences Pro renseignées</span>
        </div>
        <a href="{{ route('admin.stages.index') }}" class="stat-card-link">Gérer →</a>
    </div>
    <div class="stat-card stat-card-accent">
        <div class="stat-card-icon">⬛</div>
        <div class="stat-card-body">
            <span class="stat-card-num">{{ $stats['visibles'] }}</span>
            <span class="stat-card-label">Activités visibles</span>
        </div>
    </div>
</div>

<div class="dash-grid">
    <div class="dash-card">
        <div class="dash-card-header">
            <h3>Dernières activités ajoutées</h3>
            <a href="{{ route('admin.activites.create') }}" class="btn btn-sm btn-primary">+ Ajouter</a>
        </div>
        <div class="recent-list">
            @forelse($activitesRecentes as $a)
            <div class="recent-item">
                <div class="recent-item-left">
                    <span class="badge badge-{{ $a->type }}">{{ ucfirst($a->type) }}</span>
                    <div>
                        <strong>{{ $a->titre }}</strong>
                        <small>{{ $a->date_realisation->format('d/m/Y') }}</small>
                    </div>
                </div>
                <div class="recent-item-actions">
                    <a href="{{ route('admin.activites.edit', $a->id) }}" class="btn-icon btn-edit">✎</a>
                </div>
            </div>
            @empty
            <p class="empty-state-sm">Aucune activité. <a href="{{ route('admin.activites.create') }}">Commencer →</a></p>
            @endforelse
        </div>
    </div>
</div>

<div class="dash-checklist">
    <h3>Checklist E5</h3>
    <div class="checklist-grid">
        <div class="checklist-item {{ $stats['activites'] >= 5 ? 'done' : '' }}">
            <span class="check-icon">{{ $stats['activites'] >= 5 ? '✓' : '○' }}</span>
            <span>Au moins 5 activités documentées</span>
        </div>
        <div class="checklist-item {{ $stats['competences_acquises'] >= 5 ? 'done' : '' }}">
            <span class="check-icon">{{ $stats['competences_acquises'] >= 5 ? '✓' : '○' }}</span>
            <span>5 compétences acquises</span>
        </div>
        <div class="checklist-item {{ $stats['stages'] >= 2 ? 'done' : '' }}">
            <span class="check-icon">{{ $stats['stages'] >= 2 ? '✓' : '○' }}</span>
            <span>2 stages renseignés</span>
        </div>
        <div class="checklist-item {{ $stats['avec_captures'] >= 3 ? 'done' : '' }}">
            <span class="check-icon">{{ $stats['avec_captures'] >= 3 ? '✓' : '○' }}</span>
            <span>Preuves / captures jointes (≥ 3 activités)</span>
        </div>
    </div>
</div>

@endsection