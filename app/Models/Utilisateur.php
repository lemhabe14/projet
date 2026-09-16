<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Utilisateur extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['nom', 'prenom', 'email', 'telephone', 'adresse', 'password'];
    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return ['email_verified_at' => 'datetime', 'password' => 'hashed'];
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_utilisateur');
    }

    public function isAdmin(): bool
    {
        return $this->roles()->where('nom', 'admin')->exists();
    }
}