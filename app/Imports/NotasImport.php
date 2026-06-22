<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Nota;
use App\Models\Semestre;
use App\Models\Carrera;
use App\Models\Peso;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts; 

class NotasImport implements ToModel, WithHeadingRow, WithUpserts 
{
    private int $semestreId;
    public array $gruposAfectados = [];

    public function __construct(int $semestreId)
    {
        $this->semestreId = $semestreId;
    }

    public function model(array $row)
    {   

        if (empty($row['dni'])) {
            return null; // solo saltar fila vacía
        }
        // Buscar o crear usuario por DNI
        $usuario = User::firstOrCreate(
            ['dni' => $row['dni']],
            [
                'name' => $row['nombre'],
                'email' => $row['correo'],
                'rol_id' => 4
            ]
        );

        // Obtener el valor del semestre
        $nombreSemestre = $row['semestre'];

        // Obtener la primera letra y número
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

        // Guardar grupo afectado
        $semestreId = $this->semestreId;
        $key = $semestreId . '-' . $carrera->id;

        $this->gruposAfectados[$key] = [
            'semestre_id' => $semestreId,
            'carrera_id' => $carrera->id,
            'semestre_estudiante' => $numero_semestre
        ];

        // =========================================================================
        // CORRECCIÓN DE RELACIÓN: Buscamos el peso asociado al Semestre seleccionado
        // =========================================================================
        $semestreActual = Semestre::find($semestreId);
        $peso = $semestreActual->peso ?? null;

        // Respaldos por si el administrador no configuró pesos para este periodo
        $w1 = $peso->rendimiento ?? 0.35;
        $w2 = $peso->comportamiento ?? 0.35;
        $w3 = $peso->pagos ?? 0.15;
        $w4 = $peso->referente ?? 0.15;

        // =========================================================================
        // CONTROL DE EXCEPCIONES: Si el campo viene vacío (null), se transforma en 0
        // =========================================================================
        $v_rendimiento    = $row['rendimiento'] ?? 0;
        $v_comportamiento = $row['comportamiento'] ?? 0;
        $v_pagos          = $row['pagos'] ?? 0;
        $v_referente      = $row['referente'] ?? 0;
        
        // Calcular promedio usando las variables ya validadas y seguras
        $promedio = ($v_rendimiento * $w1)
            + ($v_comportamiento * $w2)
            + ($v_pagos * $w3)
            + ($v_referente * $w4);

        // Retornamos el modelo listo para ser insertado o actualizado
        return new Nota([
            'estudiante_id' => $usuario->id,
            'semestre_id' => $this->semestreId,
            'carrera_id' => $carrera->id,
            'semestre_estudiante' => $numero_semestre,
            'rendimiento' => $v_rendimiento,
            'comportamiento' => $v_comportamiento,
            'pagos' => $v_pagos,
            'referente' => $v_referente,
            'promedio' => $promedio,
            'ranking' => 1,
        ]);
    }

    /**
     * Columnas que la base de datos considera como llave única para aplicar el Upsert.
     */
    public function uniqueBy()
    {
        return ['estudiante_id', 'semestre_id', 'carrera_id', 'semestre_estudiante'];
    }
}