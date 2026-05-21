<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Peso;
use App\Models\Semestre;

class PesosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Peso::create([

                'semestre_id' => 1,

                'rendimiento' => 0.35,

                'comportamiento' => 0.35,

                'pagos' => 0.15,

                'referente' => 0.15
            ]);
    }
}
