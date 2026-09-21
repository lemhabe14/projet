<?php

use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserRoleController;
use App\Http\Controllers\RolePermissionController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;

Route::get('/', fn () => redirect('/login'));

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::middleware('permission:Consulter les utilisateurs')->group(function () {
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
    });
    Route::middleware('permission:Ajouter un utilisateur')->group(function () {
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
    });
    Route::middleware('permission:Modifier un utilisateur')->group(function () {
        Route::get('/users/{utilisateur}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{utilisateur}', [UserController::class, 'update'])->name('users.update');
    });
    Route::middleware('permission:Voir un utilisateur')->group(function () {
        Route::get('/users/{utilisateur}', [UserController::class, 'show'])->name('users.show');
    });
    Route::middleware('permission:Supprimer un utilisateur')->group(function () {
        Route::delete('/users/{utilisateur}', [UserController::class, 'destroy'])->name('users.destroy');
    });

    Route::middleware('permission:Attribuer des rôles')->group(function () {
        Route::get('/users/{utilisateur}/roles', [UserRoleController::class, 'edit'])->name('users.roles.edit');
        Route::put('/users/{utilisateur}/roles', [UserRoleController::class, 'update'])->name('users.roles.update');
    });

    Route::middleware('permission:Consulter les rôles')->group(function () {
        Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
    });
    Route::middleware('permission:Ajouter un rôle')->group(function () {
        Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
        Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
    });
    Route::middleware('permission:Modifier un rôle')->group(function () {
        Route::get('/roles/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit');
        Route::put('/roles/{role}', [RoleController::class, 'update'])->name('roles.update');
    });
    Route::middleware('permission:Supprimer un rôle')->group(function () {
        Route::delete('/roles/{role}', [RoleController::class, 'destroy'])->name('roles.destroy');
    });

    Route::middleware('permission:Attribuer des permissions')->group(function () {
        Route::get('/roles/{role}/permissions', [RolePermissionController::class, 'edit'])->name('roles.permissions.edit');
        Route::put('/roles/{role}/permissions', [RolePermissionController::class, 'update'])->name('roles.permissions.update');
    });

    Route::middleware('permission:Consulter les permissions')->group(function () {
        Route::resource('permissions', PermissionController::class)->except(['show']);
    });
});
