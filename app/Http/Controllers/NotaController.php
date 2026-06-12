<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use Maatwebsite\Excel\Facades\Excel;

use App\Imports\NotasImport;
use App\Models\Semestre;
use App\Models\Log;

class NotaController extends Controller
{
    public function form()
    {
        $semestres = Semestre::orderBy('id', 'desc')
            ->take(5)
            ->get();

        return view('tutor.upload', compact('semestres'));
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

        //DESPUES DE SUBIR UN EXCEL DE NOTAS SE CREA UN LOG (REPORTE)

        $autor = auth()->user();
        $nombreArchivo = $request->file('file')->getClientOriginalName();
        $semestre = Semestre::find($semestreId);    

        Log::create([
            'autor_id' => $autor->id,
            'accion_id' => 1,
            'entidad' => 'semestre',
            'entidad_id' => $semestreId,
            'descripcion' => $autor->name .
                            ' subió el archivo ' .
                            $nombreArchivo .
                            ' para el semestre ' .
                            $semestre->nombre
        ]);

        return back()->with(
            'success',
            'Datos importados correctamente'
        );
    }
}
