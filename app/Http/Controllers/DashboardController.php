<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activite;
use App\Models\Competence;
use App\Models\Stage;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'activites'           => Activite::count(),
            'visibles'            => Activite::visible()->count(),
            'stages'              => Stage::count(),
            'competences_couvertes' => Competence::has('activites')->count(),
            'avec_captures'       => Activite::has('captures')->count(),
        ];

        $coverageCompetences = Competence::withCount('activites')
            ->orderBy('ordre')
            ->get();

        $activitesRecentes = Activite::with('competences')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'coverageCompetences', 'activitesRecentes'));
    }
}