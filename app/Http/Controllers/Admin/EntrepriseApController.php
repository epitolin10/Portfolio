<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EntrepriseAp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EntrepriseApController extends Controller
{
    public function index()
    {
        $entreprises = EntrepriseAp::withCount('activites')
            ->orderBy('nom')
            ->get();

        return view('admin.ap.index', compact('entreprises'));
    }

    public function create()
    {
        return view('admin.ap.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom'  => 'required|string|max:255',
            'logo' => 'nullable|image|max:5120',
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('ap/logos', 'public');
        }

        EntrepriseAp::create($validated);

        return redirect()->route('admin.ap.index')
            ->with('success', 'Entreprise AP créée avec succès !');
    }

    public function show(EntrepriseAp $ap)
    {
        return redirect()->route('admin.ap.edit', $ap);
    }

    public function edit(EntrepriseAp $ap)
    {
        return view('admin.ap.form', compact('ap'));
    }

    public function update(Request $request, EntrepriseAp $ap)
    {
        $validated = $request->validate([
            'nom'  => 'required|string|max:255',
            'logo' => 'nullable|image|max:5120',
        ]);

        if ($request->hasFile('logo')) {
            if ($ap->logo) {
                Storage::disk('public')->delete($ap->logo);
            }
            $validated['logo'] = $request->file('logo')->store('ap/logos', 'public');
        }

        $ap->update($validated);

        return redirect()->route('admin.ap.index')
            ->with('success', 'Entreprise AP mise à jour !');
    }

    public function destroy(EntrepriseAp $ap)
    {
        if ($ap->logo) {
            Storage::disk('public')->delete($ap->logo);
        }

        $ap->delete();

        return redirect()->route('admin.ap.index')
            ->with('success', 'Entreprise AP supprimée.');
    }
}
