@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    <div class="card p-4 shadow-sm mb-4">
        <h3>Bienvenue, {{ $user->nom }} {{ $user->prenom }} 👋</h3>
        <p class="text-muted mb-0">{{ $user->email }}</p>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <div class="card p-4 shadow-sm text-center">
                <h1 class="display-4">{{ $usersCount }}</h1>
                <p class="text-muted mb-0">Utilisateurs enregistrés</p>
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <div class="card p-4 shadow-sm d-flex justify-content-center align-items-center">
                <a href="{{ url('/users') }}" class="btn btn-primary btn-lg">
                    Gérer les utilisateurs
                </a>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="card p-4 shadow-sm d-flex justify-content-center align-items-center">
                <a href="{{ route('permissions.index') }}" class="btn btn-primary btn-lg">
                    Gérer les permissions
                </a>
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <div class="card p-4 shadow-sm d-flex justify-content-center align-items-center">
                <a href="{{ route('roles.index') }}" class="btn btn-primary btn-lg">
                    Gérer les rôles
                </a>
            </div>
        </div>
    </div>

@endsection
