<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Http\Requests\StorePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::latest()->get();

        return view('permissions.index', [
            'permissions' => $permissions,
        ]);
    }

    public function create()
    {
        return view('permissions.create');
    }

    public function store(StorePermissionRequest $request)
    {
        Permission::create($request->validated());

        return redirect()->route('permissions.index')
            ->with('success', 'Permission ajoutée avec succès.');
    }

    public function edit(Permission $permission)
    {
        return view('permissions.edit', [
            'permission' => $permission,
        ]);
    }

    public function update(UpdatePermissionRequest $request, Permission $permission)
    {
        $permission->update($request->validated());

        return redirect()->route('permissions.index')
            ->with('success', 'Permission modifiée avec succès.');
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();

        return redirect()->route('permissions.index')
            ->with('success', 'Permission supprimée avec succès.');
    }
}