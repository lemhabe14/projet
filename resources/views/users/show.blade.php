@extends('layouts.app')

@section('title', 'Détails utilisateur')

@section('content')

<h3 class="mb-4">Détails de l'utilisateur</h3>

<div class="card p-4 shadow-sm" style="max-width: 600px;">
    <p><strong>Nom :</strong> {{ $utilisateur->nom }}</p>
    <p><strong>Prénom :</strong> {{ $utilisateur->prenom }}</p>
    <p><strong>Email :</strong> {{ $utilisateur->email }}</p>
    <p><strong>Téléphone :</strong> {{ $utilisateur->telephone }}</p>
    <p><strong>Adresse :</strong> {{ $utilisateur->adresse }}</p>

    <div class="mt-3">
        <a href="{{ route('users.edit', $utilisateur) }}" class="btn btn-primary">Modifier</a>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Retour</a>
    </div>
</div>

@endsection