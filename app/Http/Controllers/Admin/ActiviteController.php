<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Activite;
use App\Models\Competence;

class ActiviteController extends Controller
{
    public function index()
    {
        $activites = Activite::with(['competences', 'stage'])->latest('date_realisation')->get();
        $competences = Competence::orderBy('ordre')->get();
        
        return view('admin.index', compact('activites', 'competences'));
    }
}
