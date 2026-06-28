<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Support\Facades\Auth;
use App\Imports\NotasImport;
use App\Models\Semestre;
use App\Models\Log;

class NotaController extends Controller
{
    public function form()
    {
        $semestre = Semestre::latest('id')->first();


        $authuser = Auth::user();

        if ($authuser->rol_id == 1) {
                return view('superadministrador.upload', compact('semestre'));
        }
        if ($authuser->rol_id == 3) {
                return view('tutor.upload', compact('semestre'));
        }

    }

    public function upload(Request $request)
    {
        // Validar archivo
        $request->validate([
            'file' => 'required|extensions:xlsx,xls',
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
        UPDATE notas
        SET ranking = (
            SELECT nuevo_ranking
            FROM (
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
            ) r
            WHERE r.id = notas.id
        )
        WHERE semestre_id = ?
        AND carrera_id = ?
        AND semestre_estudiante = ?
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
