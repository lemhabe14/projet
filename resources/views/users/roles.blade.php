@extends('layouts.app')

@section('title', 'Attribuer les rôles')

@section('content')

<h3 class="mb-4">Attribuer les rôles à {{ $utilisateur->nom }} {{ $utilisateur->prenom }}</h3>

<div class="card p-4 shadow-sm" style="max-width: 600px;">

    <form method="POST" action="{{ route('users.roles.update', $utilisateur) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            @forelse ($roles as $role)
                <div class="form-check">
                    <input type="checkbox" name="roles[]" value="{{ $role->id }}" class="form-check-input"
                        id="role{{ $role->id }}"
                        {{ $utilisateur->roles->contains($role->id) ? 'checked' : '' }}>
                    <label class="form-check-label" for="role{{ $role->id }}">{{ $role->nom }}</label>
                </div>
            @empty
                <p class="text-muted">Aucun rôle disponible. Créez-en d'abord.</p>
            @endforelse
        </div>

        <button type="submit" class="btn btn-primary">Enregistrer</button>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>

@endsection