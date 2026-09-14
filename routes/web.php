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
    Route::resource('permissions', PermissionController::class)->except(['show']);

    Route::get('/users/{utilisateur}/roles', [UserRoleController::class, 'edit'])->name('users.roles.edit');
    Route::put('/users/{utilisateur}/roles', [UserRoleController::class, 'update'])->name('users.roles.update');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('users', UserController::class)->parameters([
        'users' => 'utilisateur',
    ]);
    Route::resource('roles', RoleController::class)->except(['show']);
    Route::get('/roles/{role}/permissions', [RolePermissionController::class, 'edit'])->name('roles.permissions.edit');
    Route::put('/roles/{role}/permissions', [RolePermissionController::class, 'update'])->name('roles.permissions.update');
});