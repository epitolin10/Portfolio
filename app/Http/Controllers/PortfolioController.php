<?php

namespace App\Http\Controllers;

use App\Models\Activite;
use App\Models\CompetenceAcquise;
use App\Models\EntrepriseAp;
use App\Models\Etude;
use App\Models\Stage;
use App\Models\Profil;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller
{
    public function index()
    {
        $profil           = Profil::first();
        $activitesRecentes = Activite::visible()
            ->latest('date_realisation')
            ->take(3)
            ->get();

        $nbActivites   = Activite::visible()->count();
        $nbStages      = Stage::count();

        $competencesAcquises = CompetenceAcquise::orderBy('categorie')
            ->orderBy('ordre')
            ->get()
            ->groupBy('categorie');

        $etudes = Etude::orderBy('ordre')->orderBy('date_debut', 'desc')->get();

        return view('index', compact(
            'profil', 'activitesRecentes',
            'nbActivites', 'nbStages',
            'competencesAcquises', 'etudes'
        ));
    }

    public function competences()
    {
        $competencesAcquises = CompetenceAcquise::orderBy('categorie')
            ->orderBy('ordre')
            ->get()
            ->groupBy('categorie');

        return view('competence', compact('competencesAcquises'));
    }

    public function activites()
    {
        $stages = Stage::orderBy('date_debut', 'asc')->get();

        $activites = Activite::visible()
            ->with('stage')
            ->when(request('type'), fn($q) => $q->byType(request('type')))
            ->when(request('stage_id'), fn($q) => $q->where('stage_id', request('stage_id')))
            ->latest('date_realisation')
            ->paginate(6)
            ->withQueryString();

        return view('activites', compact('activites', 'stages'));
    }

    public function activiteShow($slug)
    {
        $activite = Activite::visible()
            ->with(['sousCompetences', 'stage', 'captures'])
            ->where('slug', $slug)
            ->firstOrFail();

        $autresActivites = Activite::visible()
            ->where('id', '!=', $activite->id)
            ->take(3)
            ->get();

        return view('activite-show', compact('activite', 'autresActivites'));
    }

    public function stages()
    {
        $stages = Stage::with(['activites' => fn($q) => $q->visible()->orderBy('date_realisation', 'asc')])
            ->orderBy('date_debut', 'asc')
            ->get();

        return view('stage', compact('stages'));
    }

    public function ap()
    {
        $entreprises = EntrepriseAp::with(['activites' => fn($q) => $q->visible()->orderBy('date_realisation', 'asc')])
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

    public function downloadCv()
    {
        $profil = Profil::first();

        if (! $profil || ! $profil->cv || ! Storage::disk('public')->exists($profil->cv)) {
            abort(404);
        }

        $nom = 'CV-' . ($profil->prenom ?? 'Enzo') . '-' . ($profil->nom ?? 'Pitolin') . '.pdf';

        return Storage::disk('public')->download($profil->cv, $nom);
    }
}