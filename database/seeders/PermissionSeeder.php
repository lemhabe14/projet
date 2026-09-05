<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        Permission::create(['nom' => 'voir utilisateurs']);
        Permission::create(['nom' => 'ajouter utilisateurs']);
        Permission::create(['nom' => 'modifier utilisateurs']);
        Permission::create(['nom' => 'supprimer utilisateurs']);
    }
}