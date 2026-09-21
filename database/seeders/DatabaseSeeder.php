<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Utilisateur;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(PermissionSeeder::class); // ← هذا هو السطر الوحيد الجديد المُضاف

        $adminRole = Role::firstOrCreate(['nom' => 'admin']);
        $userRole  = Role::firstOrCreate(['nom' => 'utilisateur']);

        $admin = Utilisateur::create([
            'nom' => 'Admin', 'prenom' => 'Principal',
            'email' => 'admin@example.com', 'telephone' => '0600000000',
            'adresse' => 'N/A', 'password' => 'admin1234',
        ]);
        $admin->roles()->attach($adminRole);

        $user = Utilisateur::create([
            'nom' => 'Utilisateur', 'prenom' => 'Test',
            'email' => 'user@example.com', 'telephone' => '0600000001',
            'adresse' => 'N/A', 'password' => 'user1234',
        ]);
        $user->roles()->attach($userRole);
    }
}