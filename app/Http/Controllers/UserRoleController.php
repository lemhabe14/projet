<?php

namespace App\Http\Controllers;

use App\Models\Utilisateur;
use App\Models\Role;
use Illuminate\Http\Request;

class UserRoleController extends Controller
{
    public function edit(Utilisateur $utilisateur)
    {
        $roles = Role::all();

        return view('users.roles', [
            'utilisateur' => $utilisateur,
            'roles' => $roles,
        ]);
    }

    public function update(Request $request, Utilisateur $utilisateur)
    {
        $utilisateur->roles()->sync($request->input('roles', []));

        return redirect()->route('users.index')
            ->with('success', 'Rôles mis à jour pour ' . $utilisateur->nom . '.');
    }
}