<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Gestion des Utilisateurs')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        #sideMenu .offcanvas-body a:hover { background-color: #f0f0f0; }
    </style>
</head>
<body class="bg-light">

    <nav class="navbar navbar-dark bg-dark">
    <div class="container">
        <div class="d-flex align-items-center gap-2">
            <button class="btn btn-outline-light btn-sm" type="button" data-bs-toggle="offcanvas" data-bs-target="#sideMenu" aria-controls="sideMenu">
                <i class="bi bi-list fs-5"></i>
            </button>

            <a href="{{ route('dashboard') }}" class="navbar-brand mb-0 h1 ms-2">Gestion des Utilisateurs</a>
        </div>

        <div class="dropdown">
            <a href="#" class="d-flex align-items-center text-light text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="rounded-circle bg-secondary d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                    {{ strtoupper(substr(auth()->user()->prenom ?? auth()->user()->nom ?? '?', 0, 1)) }}
                </span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><h6 class="dropdown-header">{{ auth()->user()->prenom }} {{ auth()->user()->nom }}</h6></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form method="POST" action="{{ url('/logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item">Déconnexion</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>

    <div class="offcanvas offcanvas-start" tabindex="-1" id="sideMenu" aria-labelledby="sideMenuLabel">
        <div class="offcanvas-header justify-content-end">
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body p-0">
            <ul class="list-unstyled mb-0">
                <li>
                    <a href="{{ route('dashboard') }}" class="d-flex align-items-center gap-3 px-3 py-2 text-decoration-none text-dark {{ request()->routeIs('dashboard') ? 'bg-light fw-semibold' : '' }}">
                        <i class="bi bi-house fs-5"></i> Accueil
                    </a>
                </li>
                <li>
                    <a href="{{ route('users.index') }}" class="d-flex align-items-center gap-3 px-3 py-2 text-decoration-none text-dark {{ request()->routeIs('users.*') ? 'bg-light fw-semibold' : '' }}">
                        <i class="bi bi-people fs-5"></i> Utilisateurs
                    </a>
                </li>
                <li>
                    <a href="{{ route('roles.index') }}" class="d-flex align-items-center gap-3 px-3 py-2 text-decoration-none text-dark {{ request()->routeIs('roles.*') ? 'bg-light fw-semibold' : '' }}">
                        <i class="bi bi-shield-lock fs-5"></i> Rôles
                    </a>
                </li>
                <li>
                    <a href="{{ route('permissions.index') }}" class="d-flex align-items-center gap-3 px-3 py-2 text-decoration-none text-dark {{ request()->routeIs('permissions.*') ? 'bg-light fw-semibold' : '' }}">
                        <i class="bi bi-key fs-5"></i> Permissions
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="container mt-5">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
