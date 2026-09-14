@extends('layouts.app')

@section('title', 'Attribuer les permissions')

@section('content')

<h3 class="mb-4">Attribuer les permissions au rôle : {{ $role->nom }}</h3>

<div class="card p-4 shadow-sm" style="max-width: 600px;">

    <form method="POST" action="{{ route('roles.permissions.update', $role) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            @forelse ($permissions as $permission)
                <div class="form-check">
                    <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" class="form-check-input"
                        id="perm{{ $permission->id }}"
                        {{ $role->permissions->contains($permission->id) ? 'checked' : '' }}>
                    <label class="form-check-label" for="perm{{ $permission->id }}">{{ $permission->nom }}</label>
                </div>
            @empty
                <p class="text-muted">Aucune permission disponible. Créez-en d'abord.</p>
            @endforelse
        </div>

        <button type="submit" class="btn btn-primary">Enregistrer</button>
        <a href="{{ route('roles.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>

@endsection