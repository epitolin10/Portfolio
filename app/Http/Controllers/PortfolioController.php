<?php

namespace App\Http\Controllers;

use App\Models\Activite;
use App\Models\Competence;
use App\Models\CompetenceAcquise;
use App\Models\EntrepriseAp;
use App\Models\Etude;
use App\Models\Stage;
use App\Models\Profil;

class PortfolioController extends Controller
{
    public function index()
    {
        $profil           = Profil::first();
        $competences      = Competence::withCount('activites')->orderBy('ordre')->get();
        $activitesRecentes = Activite::visible()
            ->with('competences')
            ->latest('date_realisation')
            ->take(3)
            ->get();

        $nbActivites   = Activite::visible()->count();
        $nbCompetences = Competence::has('activites')->count();
        $nbStages      = Stage::count();

        $competencesAcquises = CompetenceAcquise::orderBy('categorie')
            ->orderBy('ordre')
            ->get()
            ->groupBy('categorie');

        $etudes = Etude::orderBy('ordre')->orderBy('date_debut', 'desc')->get();

        return view('index', compact(
            'profil', 'competences', 'activitesRecentes',
            'nbActivites', 'nbCompetences', 'nbStages',
            'competencesAcquises', 'etudes'
        ));
    }

    public function competences()
    {
        $competences = Competence::with(['sousCompetences'])->orderBy('ordre')->get();

        $competencesAcquises = CompetenceAcquise::orderBy('categorie')
            ->orderBy('ordre')
            ->get()
            ->groupBy('categorie');

        return view('competence', compact('competences', 'competencesAcquises'));
    }

    public function activites()
    {
        $competences = Competence::orderBy('ordre')->get();

        $activites = Activite::visible()
            ->with(['competences', 'stage'])
            ->when(request('type'), fn($q) => $q->byType(request('type')))
            ->when(request('competence'), fn($q) => $q->byCompetence(request('competence')))
            ->latest('date_realisation')
            ->get();

        return view('activites', compact('activites', 'competences'));
    }

    public function activiteShow($slug)
    {
        $activite = Activite::visible()
            ->with(['competences.sousCompetences', 'sousCompetences', 'stage', 'captures'])
            ->where('slug', $slug)
            ->firstOrFail();

        $autresActivites = Activite::visible()
            ->whereHas('competences', fn($q) =>
                $q->whereIn('competences.id', $activite->competences->pluck('id'))
            )
            ->where('id', '!=', $activite->id)
            ->take(3)
            ->get();

        return view('activite-show', compact('activite', 'autresActivites'));
    }

    public function stages()
    {
        $stages = Stage::with(['activites' => fn($q) => $q->visible()])
            ->orderBy('date_debut', 'desc')
            ->get();

        return view('stage', compact('stages'));
    }

    public function ap()
    {
        $entreprises = EntrepriseAp::with(['activites' => fn($q) => $q->visible()->with('competences')])
            ->orderBy('nom')
            ->get();

        return view('ap', compact('entreprises'));
    }

    public function etudes()
    {
        $etudes = Etude::orderBy('ordre')->orderBy('date_debut', 'desc')->get();

        return view('etudes', compact('etudes'));
    }

    public function contact()
    {
        $profil = Profil::first();
        return view('contact', compact('profil'));
    }
}