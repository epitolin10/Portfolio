@extends('layouts.app')
@section('title', 'Contact')

@section('content')

<section class="page-hero">
    <div class="container">
        <span class="section-tag">Me contacter</span>
        <h1 class="page-title">Contact</h1>
    </div>
</section>

<section class="container section-spaced">
    <div class="contact-grid">
        <div class="contact-info">
            <h2>{{ $profil->prenom ?? '' }} {{ $profil->nom ?? '' }}</h2>
            <p class="contact-subtitle">Étudiant BTS SIO — Option {{ $profil->option ?? 'SISR' }}</p>

            <div class="contact-links">
                @if($profil->email ?? false)
                <a href="mailto:{{ $profil->email }}" class="contact-link">
                    <span class="contact-link-icon">✉</span>
                    {{ $profil->email }}
                </a>
                @endif
                @if($profil->linkedin ?? false)
                <a href="{{ $profil->linkedin }}" target="_blank" class="contact-link">
                    <span class="contact-link-icon">in</span>
                    LinkedIn
                </a>
                @endif
                @if($profil->github ?? false)
                <a href="{{ $profil->github }}" target="_blank" class="contact-link">
                    <span class="contact-link-icon">⌥</span>
                    GitHub
                </a>
                @endif
            </div>
        </div>

        <div class="contact-card">
            <p class="contact-note">
                Ce portfolio a été réalisé dans le cadre de l'épreuve E5 du BTS Services Informatiques aux Organisations (SIO).<br><br>
                Il présente l'ensemble de mes compétences du <strong>Bloc B1</strong> acquises lors de mes stages et ateliers de professionnalisation.
            </p>
            <div class="contact-ctas">
                <a href="{{ route('portfolio.competences') }}" class="btn btn-primary">Voir mes compétences</a>
                <a href="{{ route('portfolio.activites') }}" class="btn btn-outline">Voir mes activités</a>
            </div>
        </div>
    </div>
</section>

@endsection