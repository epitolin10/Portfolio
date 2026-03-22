<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Etude;
use Illuminate\Http\Request;

class EtudeController extends Controller
{
    public function index()
    {
        $etudes = Etude::orderBy('ordre')->orderBy('date_debut', 'desc')->get();

        return view('admin.etude.index', compact('etudes'));
    }

    public function create()
    {
        return view('admin.etude.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'intitule'      => 'required|string|max:255',
            'etablissement' => 'required|string|max:255',
            'ville'         => 'nullable|string|max:255',
            'niveau'        => 'nullable|string|max:100',
            'mention'       => 'nullable|string|max:100',
            'date_debut'    => 'required|date',
            'date_fin'      => 'nullable|date|after_or_equal:date_debut',
            'en_cours'      => 'boolean',
            'description'   => 'nullable|string',
            'ordre'         => 'nullable|integer|min:0',
        ]);

        $validated['en_cours'] = $request->boolean('en_cours');

        Etude::create($validated);

        return redirect()->route('admin.etudes.index')
            ->with('success', 'Étude créée avec succès !');
    }

    public function show(Etude $etude)
    {
        return redirect()->route('admin.etudes.edit', $etude);
    }

    public function edit(Etude $etude)
    {
        return view('admin.etude.form', compact('etude'));
    }

    public function update(Request $request, Etude $etude)
    {
        $validated = $request->validate([
            'intitule'      => 'required|string|max:255',
            'etablissement' => 'required|string|max:255',
            'ville'         => 'nullable|string|max:255',
            'niveau'        => 'nullable|string|max:100',
            'mention'       => 'nullable|string|max:100',
            'date_debut'    => 'required|date',
            'date_fin'      => 'nullable|date|after_or_equal:date_debut',
            'en_cours'      => 'boolean',
            'description'   => 'nullable|string',
            'ordre'         => 'nullable|integer|min:0',
        ]);

        $validated['en_cours'] = $request->boolean('en_cours');

        $etude->update($validated);

        return redirect()->route('admin.etudes.index')
            ->with('success', 'Étude mise à jour !');
    }

    public function destroy(Etude $etude)
    {
        $etude->delete();

        return redirect()->route('admin.etudes.index')
            ->with('success', 'Étude supprimée.');
    }
}
