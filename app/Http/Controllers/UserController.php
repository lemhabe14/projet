<?php

namespace App\Http\Controllers;

use App\Models\Utilisateur;
use App\Http\Requests\StoreUtilisateurRequest;
use App\Http\Requests\UpdateUtilisateurRequest;

class UserController extends Controller
{
    public function index()
    {
        $utilisateurs = Utilisateur::latest()->get();

        return view('users.index', [
            'utilisateurs' => $utilisateurs,
        ]);
    }

    public function create()
    {
        return view('users.create');
    }

   public function store(StoreUtilisateurRequest $request)
{
    Utilisateur::create($request->validated());

    return redirect()->route('users.index')
        ->with('success', 'Utilisateur ajouté avec succès.');
}

    public function show(Utilisateur $utilisateur)
    {
        return view('users.show', [
            'utilisateur' => $utilisateur,
        ]);
    }

    public function edit(Utilisateur $utilisateur)
    {
        return view('users.edit', [
            'utilisateur' => $utilisateur,
        ]);
    }

    public function update(UpdateUtilisateurRequest $request, Utilisateur $utilisateur)
{
    $utilisateur->update($request->validated());

    return redirect()->route('users.index')
        ->with('success', 'Utilisateur modifié avec succès.');
}

    public function destroy(Utilisateur $utilisateur)
    {
        $utilisateur->delete();

        return redirect()->route('users.index')
            ->with('success', 'Utilisateur supprimé avec succès.');
    }
}