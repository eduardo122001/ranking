<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rol;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        Rol::create([
            'id' => 1,
            'nombre' => 'Superadministrador'
        ]);

        Rol::create([
            'id' => 2,
            'nombre' => 'Supervisor'
        ]);
        
        Rol::create([
            'id' => 3,
            'nombre' => 'Tutor'
        ]);

        Rol::create([
            'id' => 4,
            'nombre' => 'Estudiante'
        ]);
    }
}