<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;

class RolePermissionController extends Controller
{
    public function edit(Role $role)
    {
        $permissions = Permission::all();

        return view('roles.permissions', [
            'role' => $role,
            'permissions' => $permissions,
        ]);
    }

    public function update(Request $request, Role $role)
    {
        if ($role->nom === 'admin') {
            return redirect()->route('roles.index')
                ->with('error', 'Le rôle admin dispose déjà de toutes les permissions et ne peut pas être modifié.');
        }

        $role->permissions()->sync($request->input('permissions', []));

        return redirect()->route('roles.index')
            ->with('success', 'Permissions mises à jour pour ' . $role->nom . '.');
    }
}