@extends('layouts.app')

@section('title', 'Ajouter un utilisateur')

@section('content')

<h3 class="mb-4">Ajouter un utilisateur</h3>

<div class="card p-4 shadow-sm" style="max-width: 600px;">

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('users.store') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nom</label>
            <input type="text" name="nom" class="form-control" value="{{ old('nom') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Prénom</label>
            <input type="text" name="prenom" class="form-control" value="{{ old('prenom') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Téléphone</label>
            <input type="text" name="telephone" class="form-control" value="{{ old('telephone') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Adresse</label>
            <input type="text" name="adresse" class="form-control" value="{{ old('adresse') }}">
        </div>
        <div class="mb-3">
    <label class="form-label">Rôles</label>
    @foreach ($roles as $role)
        <div class="form-check">
            <input type="checkbox" name="roles[]" value="{{ $role->id }}" class="form-check-input"
                id="role{{ $role->id }}"
                {{ isset($utilisateur) && $utilisateur->roles->contains($role->id) ? 'checked' : '' }}>
            <label class="form-check-label" for="role{{ $role->id }}">{{ $role->nom }}</label>
        </div>
    @endforeach
</div>

        <button type="submit" class="btn btn-primary">Enregistrer</button>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>

@endsection