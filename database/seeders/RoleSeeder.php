<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        Role::create(['nom' => 'Admin']);
        Role::create(['nom' => 'Manager']);
        Role::create(['nom' => 'Employé']);
    }
}