<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompetenceAcquise;
use Illuminate\Http\Request;

class CompetenceAcquiseController extends Controller
{
    public function index()
    {
        $competencesAcquises = CompetenceAcquise::orderBy('categorie')
            ->orderBy('ordre')
            ->get()
            ->groupBy('categorie');

        return view('admin.competence-acquise.index', compact('competencesAcquises'));
    }

    public function create()
    {
        return view('admin.competence-acquise.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom'       => 'required|string|max:100',
            'categorie' => 'required|string|max:100',
            'image'     => 'nullable|image|max:2048',
            'ordre'     => 'nullable|integer|min:0',
        ]);

        $data = $request->only('nom', 'categorie', 'ordre');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('competences', 'public');
        }

        CompetenceAcquise::create($data);

        return redirect()->route('admin.competences-acquises.index')
            ->with('success', 'Compétence acquise ajoutée.');
    }

    public function edit(CompetenceAcquise $competences_acquise)
    {
        return view('admin.competence-acquise.form', ['competenceAcquise' => $competences_acquise]);
    }

    public function update(Request $request, CompetenceAcquise $competences_acquise)
    {
        $request->validate([
            'nom'       => 'required|string|max:100',
            'categorie' => 'required|string|max:100',
            'image'     => 'nullable|image|max:2048',
            'ordre'     => 'nullable|integer|min:0',
        ]);

        $data = $request->only('nom', 'categorie', 'ordre');

        if ($request->hasFile('image')) {
            if ($competences_acquise->image) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($competences_acquise->image);
            }
            $data['image'] = $request->file('image')->store('competences', 'public');
        }

        $competences_acquise->update($data);

        return redirect()->route('admin.competences-acquises.index')
            ->with('success', 'Compétence acquise mise à jour.');
    }

    public function destroy(CompetenceAcquise $competences_acquise)
    {
        if ($competences_acquise->image) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($competences_acquise->image);
        }

        $competences_acquise->delete();

        return redirect()->route('admin.competences-acquises.index')
            ->with('success', 'Compétence acquise supprimée.');
    }
}
