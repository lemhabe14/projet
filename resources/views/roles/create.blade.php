@extends('layouts.app')

@section('title', 'Ajouter un rôle')

@section('content')

<h3 class="mb-4">Ajouter un rôle</h3>

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

    <form method="POST" action="{{ route('roles.store') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nom du rôle</label>
            <input type="text" name="nom" class="form-control" value="{{ old('nom') }}">
        </div>

        <button type="submit" class="btn btn-primary">Enregistrer</button>
        <a href="{{ route('roles.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>

@endsection