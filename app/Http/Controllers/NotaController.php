<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use Maatwebsite\Excel\Facades\Excel;

use App\Imports\NotasImport;
use App\Models\Semestre;

class NotaController extends Controller
{
    public function form()
    {
        $semestres = Semestre::orderBy('id', 'desc')
            ->take(5)
            ->get();

        return view('upload', compact('semestres'));
    }

    public function upload(Request $request)
    {
        // Validar archivo
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
            'semestre_id' => 'required|exists:semestres,id'
        ]);

        $semestreId = $request->semestre_id;

        // Crear import
        $import = new NotasImport($semestreId);

        // Importar Excel
        Excel::import(
            $import,
            $request->file('file')
        );

        // Recalcular rankings SOLO de grupos afectados
        foreach ($import->gruposAfectados as $grupo) {

            DB::statement("
        UPDATE notas n
        JOIN (
            SELECT
                id,
                DENSE_RANK() OVER (
                    ORDER BY
                        promedio DESC,
                        rendimiento DESC,
                        comportamiento DESC
                ) AS nuevo_ranking
            FROM notas
            WHERE semestre_id = ?
            AND carrera_id = ?
            AND semestre_estudiante = ?
        ) r ON n.id = r.id
        SET n.ranking = r.nuevo_ranking
        WHERE n.semestre_id = ?
        AND n.carrera_id = ?
        AND n.semestre_estudiante = ?
    ", [

                $grupo['semestre_id'],
                $grupo['carrera_id'],
                $grupo['semestre_estudiante'],

                $grupo['semestre_id'],
                $grupo['carrera_id'],
                $grupo['semestre_estudiante']
            ]);
        }

        return back()->with(
            'success',
            'Datos importados correctamente'
        );
    }
}
