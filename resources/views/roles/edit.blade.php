@extends('layouts.app')

@section('title', 'Modifier un rôle')

@section('content')

<h3 class="mb-4">Modifier le rôle</h3>

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

    <form method="POST" action="{{ route('roles.update', $role) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nom du rôle</label>
            <input type="text" name="nom" class="form-control" value="{{ old('nom', $role->nom) }}">
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        <a href="{{ route('roles.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>

@endsection