@extends('layouts.app')

@section('title', 'Définir le mot de passe')

@section('content')

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Définir le mot de passe</h3>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">
            Retour
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-header">
            <strong>Gestion des utilisateurs</strong>
        </div>

        <div class="card-body">
            <p class="text-muted mb-4">
                Définissez un nouveau mot de passe pour cet utilisateur.
            </p>

            <div class="mb-3">
                <label class="form-label">Nom</label>
                <input
                    type="text"
                    class="form-control"
                    value="{{ $utilisateur->nom }}"
                    readonly
                >
            </div>

            <div class="mb-3">
                <label class="form-label">Prénom</label>
                <input
                    type="text"
                    class="form-control"
                    value="{{ $utilisateur->prenom }}"
                    readonly
                >
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input
                    type="email"
                    class="form-control"
                    value="{{ $utilisateur->email }}"
                    readonly
                >
            </div>

            <hr>

            <form
                action="{{ route('users.password.update', $utilisateur) }}"
                method="POST"
            >
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="password" class="form-label">
                        Nouveau mot de passe
                    </label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-control @error('password') is-invalid @enderror"
                        minlength="8"
                        required
                        autocomplete="new-password"
                    >

                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                    <small class="text-muted">
                        Le mot de passe doit contenir au moins 8 caractères.
                    </small>
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="form-label">
                        Confirmer le mot de passe
                    </label>

                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        class="form-control"
                        minlength="8"
                        required
                        autocomplete="new-password"
                    >
                </div>

                <button type="submit" class="btn btn-primary">
                    Enregistrer le mot de passe
                </button>

                <a href="{{ route('users.index') }}" class="btn btn-secondary">
                    Annuler
                </a>
            </form>
        </div>
    </div>
</div>

@endsection