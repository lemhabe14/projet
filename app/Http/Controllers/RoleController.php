<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::with('permissions')->latest()->get();

        return view('roles.index', [
            'roles' => $roles,
        ]);
    }

    public function create()
    {
        return view('roles.create');
    }

    public function store(StoreRoleRequest $request)
    {
        Role::create($request->validated());

        return redirect()->route('roles.index')
            ->with('success', 'Rôle ajouté avec succès.');
    }

    public function edit(Role $role)
    {
        return view('roles.edit', [
            'role' => $role,
        ]);
    }

    public function update(UpdateRoleRequest $request, Role $role)
    {
        if ($role->nom === 'admin') {
            return redirect()->route('roles.index')
                ->with('error', 'Le rôle admin ne peut pas être modifié.');
        }

        $role->update($request->validated());

        return redirect()->route('roles.index')
            ->with('success', 'Rôle modifié avec succès.');
    }

    public function destroy(Role $role)
    {
        if ($role->nom === 'admin') {
            return redirect()->route('roles.index')
                ->with('error', 'Le rôle admin ne peut pas être supprimé.');
        }

        $role->delete();

        return redirect()->route('roles.index')
            ->with('success', 'Rôle supprimé avec succès.');
    }
}