<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserRoleController;
use App\Http\Controllers\UserPasswordController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\PermissionController;

Route::get('/', function () {
    return redirect('/login');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])
        ->name('login');

    Route::post('/login', [LoginController::class, 'login']);

    Route::get('/auth/keycloak', [LoginController::class, 'redirectToKeycloak'])
        ->name('keycloak.login');

    Route::get('/auth/keycloak/callback', [LoginController::class, 'handleKeycloakCallback'])
        ->name('keycloak.callback');
});

Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout');

Route::middleware('auth')->group(function () {

    // Tableau de bord
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Consulter les utilisateurs
    Route::middleware('permission:Consulter les utilisateurs')->group(function () {
        Route::get('/users', [UserController::class, 'index'])
            ->name('users.index');
    });

    // Ajouter un utilisateur
    Route::middleware('permission:Ajouter un utilisateur')->group(function () {
        Route::get('/users/create', [UserController::class, 'create'])
            ->name('users.create');

        Route::post('/users', [UserController::class, 'store'])
            ->name('users.store');
    });

    // Modifier un utilisateur
    Route::middleware('permission:Modifier un utilisateur')->group(function () {
        Route::get('/users/{utilisateur}/edit', [UserController::class, 'edit'])
            ->name('users.edit');

        Route::put('/users/{utilisateur}', [UserController::class, 'update'])
            ->name('users.update');
    });

    // Voir un utilisateur
    Route::middleware('permission:Voir un utilisateur')->group(function () {
        Route::get('/users/{utilisateur}', [UserController::class, 'show'])
            ->name('users.show');
    });

    // Supprimer un utilisateur
    Route::middleware('permission:Supprimer un utilisateur')->group(function () {
        Route::delete('/users/{utilisateur}', [UserController::class, 'destroy'])
            ->name('users.destroy');
    });

    // Attribuer des rôles
    Route::middleware('permission:Attribuer des rôles')->group(function () {
        Route::get('/users/{utilisateur}/roles', [UserRoleController::class, 'edit'])
            ->name('users.roles.edit');

        Route::put('/users/{utilisateur}/roles', [UserRoleController::class, 'update'])
            ->name('users.roles.update');
    });

    // Définir le mot de passe d’un utilisateur
    Route::middleware('permission:Définir le mot de passe d’un utilisateur')->group(function () {
        Route::get(
            '/users/{utilisateur}/password',
            [UserPasswordController::class, 'edit']
        )->name('users.password.edit');

        Route::put(
            '/users/{utilisateur}/password',
            [UserPasswordController::class, 'update']
        )->name('users.password.update');
    });

    // Consulter les rôles
    Route::middleware('permission:Consulter les rôles')->group(function () {
        Route::get('/roles', [RoleController::class, 'index'])
            ->name('roles.index');
    });

    // Ajouter un rôle
    Route::middleware('permission:Ajouter un rôle')->group(function () {
        Route::get('/roles/create', [RoleController::class, 'create'])
            ->name('roles.create');

        Route::post('/roles', [RoleController::class, 'store'])
            ->name('roles.store');
    });

    // Modifier un rôle
    Route::middleware('permission:Modifier un rôle')->group(function () {
        Route::get('/roles/{role}/edit', [RoleController::class, 'edit'])
            ->name('roles.edit');

        Route::put('/roles/{role}', [RoleController::class, 'update'])
            ->name('roles.update');
    });

    // Supprimer un rôle
    Route::middleware('permission:Supprimer un rôle')->group(function () {
        Route::delete('/roles/{role}', [RoleController::class, 'destroy'])
            ->name('roles.destroy');
    });

    // Attribuer des permissions aux rôles
    Route::middleware('permission:Attribuer des permissions')->group(function () {
        Route::get('/roles/{role}/permissions', [RolePermissionController::class, 'edit'])
            ->name('roles.permissions.edit');

        Route::put('/roles/{role}/permissions', [RolePermissionController::class, 'update'])
            ->name('roles.permissions.update');
    });

    // Consulter et gérer les permissions
    Route::middleware('permission:Consulter les permissions')->group(function () {
        Route::resource('permissions', PermissionController::class)
            ->except(['show']);
    });
});