<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfilController extends Controller
{
    public function edit()
    {
        $profil = Profil::first();

        return view('admin.profil.edit', compact('profil'));
    }

    public function update(Request $request)
    {
        $profil = Profil::first();

        $validated = $request->validate([
            'nom'       => 'required|string|max:255',
            'prenom'    => 'required|string|max:255',
            'email'     => 'nullable|email|max:255',
            'option'    => 'required|in:SLAM,SISR',
            'bio'       => 'nullable|string',
            'linkedin'  => 'nullable|url|max:255',
            'github'    => 'nullable|url|max:255',
            'photo'     => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
        ]);

        if ($request->hasFile('photo')) {
            if ($profil && $profil->photo) {
                Storage::disk('public')->delete($profil->photo);
            }
            $validated['photo'] = $request->file('photo')->store('profil', 'public');
        }

        if ($profil) {
            $profil->update($validated);
        } else {
            Profil::create($validated);
        }

        return redirect()->route('admin.profil.edit')
            ->with('success', 'Profil mis à jour avec succès !');
    }
}
