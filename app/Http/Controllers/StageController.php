<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Stage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StageController extends Controller
{
    public function index()
    {
        $stages = Stage::withCount('activites')->orderBy('date_debut', 'desc')->get();
        return view('admin.stages.index', compact('stages'));
    }

    public function create()
    {
        return view('admin.stages.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom'         => 'required|string|max:255',
            'entreprise'  => 'required|string|max:255',
            'secteur'     => 'nullable|string|max:255',
            'ville'       => 'nullable|string|max:255',
            'date_debut'  => 'required|date',
            'date_fin'    => 'required|date|after:date_debut',
            'description' => 'nullable|string',
            'maitre_stage'=> 'nullable|string|max:255',
            'annee'       => 'required|in:1,2',
            'logo'        => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('stages/logos', 'public');
        }

        Stage::create($validated);

        return redirect()->route('admin.stages.index')
            ->with('success', 'Stage créé avec succès !');
    }

    public function edit(Stage $stage)
    {
        return view('admin.stages.form', compact('stage'));
    }

    public function update(Request $request, Stage $stage)
    {
        $validated = $request->validate([
            'nom'         => 'required|string|max:255',
            'entreprise'  => 'required|string|max:255',
            'secteur'     => 'nullable|string|max:255',
            'ville'       => 'nullable|string|max:255',
            'date_debut'  => 'required|date',
            'date_fin'    => 'required|date|after:date_debut',
            'description' => 'nullable|string',
            'maitre_stage'=> 'nullable|string|max:255',
            'annee'       => 'required|in:1,2',
            'logo'        => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('logo')) {
            if ($stage->logo) Storage::disk('public')->delete($stage->logo);
            $validated['logo'] = $request->file('logo')->store('stages/logos', 'public');
        }

        $stage->update($validated);

        return redirect()->route('admin.stages.index')
            ->with('success', 'Stage mis à jour !');
    }

    public function destroy(Stage $stage)
    {
        if ($stage->logo) Storage::disk('public')->delete($stage->logo);
        $stage->delete();

        return redirect()->route('admin.stages.index')
            ->with('success', 'Stage supprimé.');
    }
}