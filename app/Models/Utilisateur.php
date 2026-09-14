<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Utilisateur extends Model
{
    public function roles()
{
    return $this->belongsToMany(Role::class, 'role_utilisateur');
}
    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'telephone',
        'adresse',
    ];
}
