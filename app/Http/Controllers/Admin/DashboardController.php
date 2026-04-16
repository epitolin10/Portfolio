<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Activite;
use App\Models\CompetenceAcquise;
use App\Models\Stage;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'activites' => Activite::count(),
            'competences_couvertes' => CompetenceAcquise::count(),
            'competences_acquises' => CompetenceAcquise::count(),
            'stages' => Stage::count(),
            'visibles' => Activite::where('visible', true)->count(),
            'avec_captures' => Activite::has('captures')->count(),
        ];

        $coverageCompetences = collect();

        $activitesRecentes = Activite::latest('created_at')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'coverageCompetences', 'activitesRecentes'));
    }
}
