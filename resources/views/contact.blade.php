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
            <p class="contact-subtitle">Étudiant BTS SIO — Option {{ $profil->option ?? 'SLAM' }}</p>

            <div class="contact-links">
                @if($profil->email ?? false)
                <a href="mailto:{{ $profil->email }}" class="contact-link">
                    <span class="contact-link-icon">✉</span>
                    {{ $profil->email }}
                </a>
                @endif
                <a href="mailto:enzopitolin3@gmail.com" class="contact-link" aria-label="Email">
                    <span class="contact-link-icon">✉</span>
                    enzopitolin3@gmail.com
                </a>
                <a href="https://www.linkedin.com/in/enzo-pitolin-b623473b7/" class="contact-link" aria-label="LinkedIn">
                    <span class="contact-link-icon contact-link-icon--social" aria-hidden="true">
                        <svg viewBox="0 0 24 24" role="img" focusable="false">
                            <path d="M4.98 3.5C4.98 4.88 3.86 6 2.48 6S0 4.88 0 3.5 1.12 1 2.5 1s2.48 1.12 2.48 2.5zM.5 8h4V23h-4V8zm7 0h3.83v2.05h.06C11.92 8.97 13.34 8 15.6 8 20.16 8 21 11 21 14.95V23h-4v-7.12c0-1.7-.03-3.88-2.36-3.88-2.37 0-2.73 1.85-2.73 3.76V23h-4V8z" fill="currentColor"/>
                        </svg>
                    </span>
                    LinkedIn
                </a>
                <a href="https://github.com/epitolin10" class="contact-link" aria-label="GitHub">
                    <span class="contact-link-icon contact-link-icon--social" aria-hidden="true">
                        <svg viewBox="0 0 24 24" role="img" focusable="false">
                            <path d="M12 .5C5.65.5.5 5.65.5 12a11.5 11.5 0 0 0 7.86 10.92c.57.1.78-.25.78-.56 0-.28-.01-1.03-.02-2.02-3.2.7-3.88-1.54-3.88-1.54-.52-1.33-1.28-1.68-1.28-1.68-1.05-.71.08-.7.08-.7 1.16.08 1.77 1.2 1.77 1.2 1.03 1.76 2.7 1.25 3.36.95.1-.75.4-1.25.72-1.54-2.56-.29-5.25-1.28-5.25-5.72 0-1.26.45-2.29 1.2-3.1-.12-.29-.52-1.46.11-3.04 0 0 .98-.31 3.2 1.18a11.2 11.2 0 0 1 5.82 0c2.22-1.49 3.2-1.18 3.2-1.18.63 1.58.23 2.75.11 3.04.75.81 1.2 1.84 1.2 3.1 0 4.45-2.7 5.43-5.28 5.71.41.35.78 1.04.78 2.1 0 1.52-.01 2.75-.01 3.12 0 .31.2.67.79.56A11.5 11.5 0 0 0 23.5 12C23.5 5.65 18.35.5 12 .5z" fill="currentColor"/>
                        </svg>
                    </span>
                    GitHub
                </a>
            </div>
        </div>

        <div class="contact-card">
            <p class="contact-note">
                Ce portfolio a été réalisé dans le cadre de l'épreuve E5 du BTS Services Informatiques aux Organisations (SIO).<br><br>
                Il présente l'ensemble de mes compétences acquises lors de mes stages et des ateliers de professionnalisation.
            </p>
            <div class="contact-ctas">
                <a href="{{ route('portfolio.competences') }}" class="btn btn-primary">Voir mes compétences</a>
                <a href="{{ route('portfolio.activites') }}" class="btn btn-outline">Voir mes activités</a>
            </div>
        </div>
    </div>
</section>

@endsection