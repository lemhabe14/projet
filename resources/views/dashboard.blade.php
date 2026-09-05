<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Administrateur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <span class="navbar-brand mb-0 h1">Gestion des Utilisateurs</span>
            <form method="POST" action="{{ url('/logout') }}">
                @csrf
                <button type="submit" class="btn btn-outline-light btn-sm">Déconnexion</button>
            </form>
        </div>
    </nav>

    <div class="container mt-5">

        <div class="card p-4 shadow-sm mb-4">
            <h3>Bienvenue, {{ $admin->name }} 👋</h3>
            <p class="text-muted mb-0">{{ $admin->email }}</p>
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
        </div>

    </div>

</body>
</html>