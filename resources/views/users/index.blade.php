@extends('layouts.app')

@section('title', 'Liste des Utilisateurs')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3>Liste des utilisateurs</h3>
    <a href="{{ route('users.create') }}" class="btn btn-primary">+ Ajouter un utilisateur</a>
</div>

<div class="card shadow-sm">
    <table class="table table-hover mb-0">
        <thead class="table-light">
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Adresse</th>
                <th class="text-end">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($utilisateurs as $utilisateur)
                <tr>
                    <td>{{ $utilisateur->nom }}</td>
                    <td>{{ $utilisateur->prenom }}</td>
                    <td>{{ $utilisateur->email }}</td>
                    <td>{{ $utilisateur->telephone }}</td>
                    <td>{{ $utilisateur->adresse }}</td>
                    <td class="text-end">
                        <a href="{{ route('users.show', $utilisateur) }}" class="btn btn-sm btn-outline-secondary">Voir</a>
                        <a href="{{ route('users.edit', $utilisateur) }}" class="btn btn-sm btn-outline-primary">Modifier</a>
                        <form action="{{ route('users.destroy', $utilisateur) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer cet utilisateur ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center text-muted py-4">Aucun utilisateur enregistré.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection