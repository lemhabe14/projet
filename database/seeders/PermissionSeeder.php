<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            ['fonctionnalite' => 'Gestion des utilisateurs', 'nom' => 'Consulter les utilisateurs'],
            ['fonctionnalite' => 'Gestion des utilisateurs', 'nom' => 'Voir un utilisateur'],
            ['fonctionnalite' => 'Gestion des utilisateurs', 'nom' => 'Ajouter un utilisateur'],
            ['fonctionnalite' => 'Gestion des utilisateurs', 'nom' => 'Modifier un utilisateur'],
            ['fonctionnalite' => 'Gestion des utilisateurs', 'nom' => 'Supprimer un utilisateur'],

            ['fonctionnalite' => 'Gestion des rôles', 'nom' => 'Consulter les rôles'],
            ['fonctionnalite' => 'Gestion des rôles', 'nom' => 'Ajouter un rôle'],
            ['fonctionnalite' => 'Gestion des rôles', 'nom' => 'Modifier un rôle'],
            ['fonctionnalite' => 'Gestion des rôles', 'nom' => 'Supprimer un rôle'],

            ['fonctionnalite' => 'Gestion des permissions', 'nom' => 'Consulter les permissions'],

            ['fonctionnalite' => 'Attribution des rôles', 'nom' => 'Attribuer des rôles'],

            ['fonctionnalite' => 'Attribution des permissions', 'nom' => 'Attribuer des permissions'],

            ['fonctionnalite' => 'Authentification', 'nom' => 'Se connecter (Admin)'],
            ['fonctionnalite' => 'Authentification', 'nom' => 'Se connecter (Utilisateur)'],
        ];

        foreach ($permissions as $permission) {
            Permission::updateOrCreate(
                ['nom' => $permission['nom']],
                ['fonctionnalite' => $permission['fonctionnalite']]
            );
        }
    }
}