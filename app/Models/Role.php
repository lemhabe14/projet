<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['nom'];

    public function utilisateurs()
    {
        return $this->belongsToMany(Utilisateur::class, 'role_utilisateur');
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_role');
    }
}