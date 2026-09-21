@extends('layouts.app')

@section('title', 'Liste des Rôles')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3>Liste des rôles</h3>
    @if (auth()->user()->hasPermission('Ajouter un rôle'))
        <a href="{{ route('roles.create') }}" class="btn btn-primary">+ Ajouter un rôle</a>
    @endif
</div>

<div class="card shadow-sm">
    <table class="table table-hover mb-0">
        <thead class="table-light">
            <tr>
                <th>Nom du rôle</th>
                <th>Permissions</th>
                <th class="text-end">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($roles as $role)
                <tr>
                    <td>{{ $role->nom }}</td>
                    <td>
                        @forelse ($role->permissions as $permission)
                            <span class="badge bg-primary">{{ $permission->nom }}</span>
                        @empty
                            <span class="text-muted">Aucune permission</span>
                        @endforelse
                    </td>
                    <td class="text-end">
                        @unless ($role->nom === 'admin')
                            @if (auth()->user()->hasPermission('Attribuer des permissions'))
                                <a href="{{ route('roles.permissions.edit', $role) }}" class="btn btn-sm btn-outline-success">Permissions</a>
                            @endif
                            @if (auth()->user()->hasPermission('Modifier un rôle'))
                                <a href="{{ route('roles.edit', $role) }}" class="btn btn-sm btn-outline-primary">Modifier</a>
                            @endif
                            @if (auth()->user()->hasPermission('Supprimer un rôle'))
                                <form action="{{ route('roles.destroy', $role) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer ce rôle ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Supprimer</button>
                                </form>
                            @endif
                        @endunless
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center text-muted py-4">Aucun rôle enregistré.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection