<?php

namespace App\Http\Controllers;

use App\Models\Utilisateur;
use Illuminate\Http\Request;

class UserPasswordController extends Controller
{
    public function edit(Utilisateur $utilisateur)
    {
        abort_unless(auth()->user()->isAdmin(), 403);

        if ($utilisateur->isAdmin()) {
            return redirect()->route('users.index')
                ->with('error', 'Le mot de passe d’un administrateur ne peut pas être modifié depuis cette page.');
        }

        return view('users.password', [
            'utilisateur' => $utilisateur,
        ]);
    }

    public function update(Request $request, Utilisateur $utilisateur)
    {
        abort_unless(auth()->user()->isAdmin(), 403);

        if ($utilisateur->isAdmin()) {
            return redirect()->route('users.index')
                ->with('error', 'Le mot de passe d’un administrateur ne peut pas être modifié depuis cette page.');
        }

        $validated = $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // Le cast "hashed" du modèle Utilisateur chiffre le mot de passe.
        $utilisateur->password = $validated['password'];
        $utilisateur->save();

        return redirect()->route('users.index')
            ->with('success', 'Mot de passe mis à jour avec succès.');
    }
}