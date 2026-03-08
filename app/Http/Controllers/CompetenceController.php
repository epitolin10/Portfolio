<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Competence;
use Illuminate\Http\Request;

class CompetenceController extends Controller
{
    public function index()
    {
        $competences = Competence::withCount('activites')
            ->with('sousCompetences')
            ->orderBy('ordre')
            ->get();

        return view('admin.competences.index', compact('competences'));
    }

    public function edit(Competence $competence)
    {
        $competence->load('sousCompetences');
        return view('admin.competences.edit', compact('competence'));
    }

    public function update(Request $request, Competence $competence)
    {
        $request->validate([
            'description_courte' => 'nullable|string|max:255',
            'icone'              => 'nullable|string|max:10',
        ]);

        $competence->update($request->only('description_courte', 'icone'));

        return redirect()->route('admin.competences.index')
            ->with('success', 'Compétence mise à jour.');
    }
}