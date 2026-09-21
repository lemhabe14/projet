@extends('layouts.app')

@section('title', 'Liste des Permissions')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3>Liste des permissions</h3>
</div>

<div class="card shadow-sm">
    <table class="table table-hover mb-0">
        <thead class="table-light">
            <tr>
                <th>Fonctionnalité</th>
                <th>Permission</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($permissions as $permission)
                <tr>
                    <td>{{ $permission->fonctionnalite }}</td>
                    <td>{{ $permission->nom }}</td>
                </tr>
            @empty
                <tr><td colspan="2" class="text-center text-muted py-4">Aucune permission enregistrée.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection