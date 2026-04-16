<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activite;
use App\Models\Stage;
use App\Models\Capture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ActiviteController extends Controller
{
    public function index(Request $request)
    {
        $activites = Activite::with(['stage'])
            ->when($request->type, fn($q) => $q->byType($request->type))
            ->latest('date_realisation')
            ->paginate(15);

        return view('admin.activites.index', compact('activites'));
    }

    public function create()
    {
        $stages      = Stage::orderBy('date_debut', 'desc')->get();
        return view('admin.activites.form', compact('stages'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre'             => 'required|string|max:255',
            'description_courte'=> 'required|string|max:255',
            'description'       => 'required|string',
            'type'              => 'required|in:stage,ap,projet',
            'date_realisation'  => 'required|date',
            'outils'            => 'nullable|string|max:500',
            'lien_externe'      => 'nullable|url|max:500',
            'ap'                => 'nullable|string|max:255',
            'stage_id'          => 'nullable|exists:stages,id',
            'sous_competences'  => 'nullable|array',
            'sous_competences.*'=> 'exists:sous_competences,id',
            'captures'          => 'nullable|array|max:5',
            'captures.*'        => 'file|mimes:jpg,jpeg,png,pdf|max:5120',
            'visible'           => 'nullable',
            'mise_en_avant'     => 'nullable',
        ]);

        $activite = Activite::create([
            ...$validated,
            'visible'       => $request->boolean('visible'),
            'mise_en_avant' => $request->boolean('mise_en_avant'),
        ]);

        $activite->sousCompetences()->sync($request->input('sous_competences', []));

        // Upload captures
        if ($request->hasFile('captures')) {
            foreach ($request->file('captures') as $file) {
                $path = $file->store('captures/' . $activite->id, 'public');
                Capture::create([
                    'activite_id' => $activite->id,
                    'chemin'      => $path,
                    'nom'         => $file->getClientOriginalName(),
                ]);
            }
        }

        return redirect()->route('admin.activites.index')
            ->with('success', 'Activité créée avec succès !');
    }

    public function edit(Activite $activite)
    {
        $activite->load(['sousCompetences', 'captures']);
        $stages      = Stage::orderBy('date_debut', 'desc')->get();
        return view('admin.activites.form', compact('activite', 'stages'));
    }

    public function update(Request $request, Activite $activite)
    {
        $validated = $request->validate([
            'titre'             => 'required|string|max:255',
            'description_courte'=> 'required|string|max:255',
            'description'       => 'required|string',
            'type'              => 'required|in:stage,ap,projet',
            'date_realisation'  => 'required|date',
            'outils'            => 'nullable|string|max:500',
            'lien_externe'      => 'nullable|url|max:500',
            'ap'                => 'nullable|string|max:255',
            'stage_id'          => 'nullable|exists:stages,id',
            'sous_competences'  => 'nullable|array',
            'captures'          => 'nullable|array|max:5',
            'captures.*'        => 'file|mimes:jpg,jpeg,png,pdf|max:5120',
            'visible'           => 'nullable',
            'mise_en_avant'     => 'nullable',
        ]);

        $activite->update([
            ...$validated,
            'visible'       => $request->boolean('visible'),
            'mise_en_avant' => $request->boolean('mise_en_avant'),
        ]);

        $activite->sousCompetences()->sync($request->input('sous_competences', []));

        if ($request->hasFile('captures')) {
            foreach ($request->file('captures') as $file) {
                $path = $file->store('captures/' . $activite->id, 'public');
                Capture::create([
                    'activite_id' => $activite->id,
                    'chemin'      => $path,
                    'nom'         => $file->getClientOriginalName(),
                ]);
            }
        }

        return redirect()->route('admin.activites.index')
            ->with('success', 'Activité mise à jour !');
    }

    public function destroy(Activite $activite)
    {
        // Supprimer les fichiers
        foreach ($activite->captures as $capture) {
            Storage::disk('public')->delete($capture->chemin);
        }
        $activite->delete();

        return redirect()->route('admin.activites.index')
            ->with('success', 'Activité supprimée.');
    }

    public function toggleVisible(Activite $activite)
    {
        $activite->update(['visible' => !$activite->visible]);
        return response()->json(['visible' => $activite->visible]);
    }
}