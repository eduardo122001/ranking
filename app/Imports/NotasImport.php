<?php

namespace App\Imports;


use App\Models\User;
use App\Models\Nota;
use App\Models\Semestre;
use App\Models\Carrera;
use App\Models\Peso;


use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class NotasImport implements ToModel, WithHeadingRow
{
    private int $semestreId;
    public array $gruposAfectados = [];

    public function __construct(int $semestreId)
    {
        $this->semestreId = $semestreId;
    }

    public function model(array $row)
    {
        // Buscar o crear usuario por DNI
        $usuario = User::firstOrCreate(

            ['dni' => $row['dni']],

            [
                'name' => $row['nombre'],
                'email' => $row['correo'],
                'rol_id' => 2
            ]
        );

        // Obtener el valor del semestre
        $nombreSemestre = $row['semestre'];

        // Obtener la primera letra
        $letra = strtoupper(substr($nombreSemestre, 0, 1));
        $numero_semestre = (int) substr($nombreSemestre, 2, 1);

        // Determinar carrera
        if ($letra == 'G') {

            $nombreCarrera = 'Gastronomia';
        } else {
            if ($letra == 'A') {

                $nombreCarrera = 'Administracion';
            } else {
                $nombreCarrera = 'General';
            }
        }

        $carrera = Carrera::firstOrCreate(

            ['nombre' => $nombreCarrera]

        );

        // Buscar semestre
        $semestreId = $this->semestreId;

        // Guardar grupo afectado
        $key = $semestreId . '-' . $carrera->id;

        $this->gruposAfectados[$key] = [

            'semestre_id' => $semestreId,

            'carrera_id' => $carrera->id,
            
            'semestre_estudiante' => $numero_semestre
        ];




        // Obtener pesos del semestre
        $peso = Peso::latest('id')->first();
        // Calcular promedio
        $promedio =

            ($row['rendimiento'] * $peso->rendimiento)

            +

            ($row['comportamiento'] * $peso->comportamiento)

            +

            ($row['pagos'] * $peso->pagos)

            +

            ($row['referente'] * $peso->referente);

        // Crear nota
        return new Nota([

            'estudiante_id' => $usuario->id,

            'semestre_id' => $this->semestreId,

            'carrera_id' => $carrera->id,

            'semestre_estudiante' => $numero_semestre,

            'rendimiento' => $row['rendimiento'],

            'comportamiento' => $row['comportamiento'],

            'pagos' => $row['pagos'],

            'referente' => $row['referente'],

            'promedio' => $promedio,

            'ranking' => 0,
        ]);
    }
}
