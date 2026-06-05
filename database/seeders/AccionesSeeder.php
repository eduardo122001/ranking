<?php

namespace Database\Seeders;

use App\Models\Accion;
use Illuminate\Database\Seeder;

class AccionesSeeder extends Seeder
{
    public function run(): void
    {
        Accion::insert([
            [
                'id' => 1,
                'nombre' => 'subir_notas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'nombre' => 'crear_pesos',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'nombre' => 'editar_pesos',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'nombre' => 'crear_usuario',
                'updated_at' => now(),
                'created_at' => now(),
            ],
            [
                'id' => 5,
                'nombre' => 'editar_usuario',
                'updated_at' => now(),
                'created_at' => now(),
            ],
        ]);
    }
}