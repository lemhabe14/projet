<?php

namespace App\Http\Controllers;

use App\Models\Utilisateur;
use App\Http\Requests\StoreUtilisateurRequest;
use App\Http\Requests\UpdateUtilisateurRequest;
use App\Models\Role;

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
    $roles = Role::all();
    return view('users.create', compact('roles'));
}

   public function store(StoreUtilisateurRequest $request)
{
    $utilisateur = Utilisateur::create($request->validated());
    $utilisateur->roles()->sync($request->input('roles', []));

    return redirect()->route('users.index')->with('success', 'Utilisateur ajouté avec succès.');
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
        'roles' => \App\Models\Role::all(),
    ]);
    }

   public function update(UpdateUtilisateurRequest $request, Utilisateur $utilisateur)
{
    $utilisateur->update($request->validated());
    $utilisateur->roles()->sync($request->input('roles', []));

    return redirect()->route('users.index')->with('success', 'Utilisateur modifié avec succès.');
}

    public function destroy(Utilisateur $utilisateur)
    {
        $utilisateur->delete();

        return redirect()->route('users.index')
            ->with('success', 'Utilisateur supprimé avec succès.');
    }
}