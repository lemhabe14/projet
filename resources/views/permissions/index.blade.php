@extends('layouts.app')

@section('title', 'Liste des Permissions')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3>Liste des permissions</h3>
    <a href="{{ route('permissions.create') }}" class="btn btn-primary">+ Ajouter une permission</a>
</div>

<div class="card shadow-sm">
    <table class="table table-hover mb-0">
        <thead class="table-light">
            <tr>
                <th>Nom de la permission</th>
                <th class="text-end">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($permissions as $permission)
                <tr>
                    <td>{{ $permission->nom }}</td>
                    <td class="text-end">
                        <a href="{{ route('permissions.edit', $permission) }}" class="btn btn-sm btn-outline-primary">Modifier</a>
                        <form action="{{ route('permissions.destroy', $permission) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer cette permission ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="2" class="text-center text-muted py-4">Aucune permission enregistrée.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection