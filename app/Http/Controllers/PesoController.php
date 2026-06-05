<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peso;
use App\Models\Semestre;
use App\Models\Nota;
use App\Models\Log;
use Illuminate\Support\Facades\DB;

class PesoController extends Controller
{
    public function index()
    {
        //$peso = Peso::first();
        $peso = Peso::latest('id')->first();

        $semestre = Semestre::latest('id')->first();

        /*if (!$peso) {

            $peso = Peso::create([
                'semestre_id' => 1,
                'rendimiento' => 0.35,
                'comportamiento' => 0.35,
                'pagos' => 0.15,
                'referente' => 0.15
            ]);
        }*/

        $peso->rendimiento = $peso->rendimiento * 100;
        $peso->comportamiento = $peso->comportamiento * 100;
        $peso->pagos = $peso->pagos * 100;
        $peso->referente = $peso->referente * 100;

        $total =
            $peso->rendimiento +
            $peso->comportamiento +
            $peso->pagos +
            $peso->referente;

        return view('pesos',compact('peso','total','semestre'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'rendimiento' => 'required|numeric|min:0|max:100',
            'comportamiento' => 'required|numeric|min:0|max:100',
            'pagos' => 'required|numeric|min:0|max:100',
            'referente' => 'required|numeric|min:0|max:100',
        ]);

        $total =
            $request->rendimiento +
            $request->comportamiento +
            $request->pagos +
            $request->referente;

        if ($total != 100) {
            return back()->with('error', 'La suma total debe ser 100%');
        }

        $nuevoPeso = Peso::create([ // SE CREA UN NUEVO PESO Y LO ASIGNA AL ULTIMO SEMESTRE

            'rendimiento' => $request->rendimiento / 100,

            'comportamiento' => $request->comportamiento / 100,

            'pagos' => $request->pagos / 100,

            'referente' => $request->referente / 100,
        ]);

        $semestre = Semestre::latest('id')->first();

        $semestre->update([
            'peso_id' => $nuevoPeso->id
        ]);

        $notas = Nota::where('semestre_id', $semestre->id)->get();

        foreach ($notas as $nota) {

            $nota->promedio =
                ($nota->rendimiento * $nuevoPeso->rendimiento) +
                ($nota->comportamiento * $nuevoPeso->comportamiento) +
                ($nota->pagos * $nuevoPeso->pagos) +
                ($nota->referente * $nuevoPeso->referente);

            $nota->save();
        }

        $grupos = Nota::where('semestre_id', $semestre->id)
        ->select(
            'semestre_id',
            'carrera_id',
            'semestre_estudiante'
        )
        ->distinct()
        ->get();

        foreach ($grupos as $grupo) {

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

            $grupo->semestre_id,
            $grupo->carrera_id,
            $grupo->semestre_estudiante,

            $grupo->semestre_id,
            $grupo->carrera_id,
            $grupo->semestre_estudiante
        ]);
    }

    $autor = auth()->user();   

    Log::create([
        'autor_id' => $autor->id,
        'accion_id' => 2,
        'entidad' => 'semestre',
        'entidad_id' => $semestre->id,
        'descripcion' => $autor->name .
                        ' actualizo pesos para el semestre ' .
                        $semestre->nombre . ' en adelante '
    ]);

        return back()->with('success', 'Pesos actualizados correctamente');
    }
}
