<?php

namespace App\Http\Controllers;

use App\Models\Nota;
use App\Models\Carrera;
use App\Models\Semestre;
use Illuminate\Http\Request;

class RankingController extends Controller
{
    public function index(Request $request)
    {
        $query = Nota::with([
            'estudiante',
            'carrera',
            'semestre'
        ]);

        // filtros
        if ($request->filled('carrera')) {
            $query->where('carrera_id', $request->carrera);
        }

        if ($request->filled('semestre')) {
            $query->where('semestre_id', $request->semestre);
        }

        if ($request->filled('semestre_estudiante')) {
            $query->where(
                'semestre_estudiante',
                $request->semestre_estudiante
            );
        }

        $ranking = $query
            ->orderByDesc('promedio')
            ->paginate(20)
            ->withQueryString();

        $carreras = Carrera::orderBy('nombre')->get();

        $semestres = Semestre::orderByDesc('id')->get();

        $semestresEstudiante = Nota::select('semestre_estudiante')
            ->distinct()
            ->orderBy('semestre_estudiante')
            ->pluck('semestre_estudiante');

        return view('rankinglist', compact(
            'ranking',
            'carreras',
            'semestres',
            'semestresEstudiante'
        ));
    }
}