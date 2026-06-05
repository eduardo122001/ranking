<?php

namespace App\Http\Controllers;

use App\Models\Nota;
use App\Models\Carrera;
use App\Models\Semestre;
use Illuminate\Http\Request;

class SupervisorController extends Controller
{
    /**
     * Dashboard - vista de ranking (solo lectura)
     */
    public function dashboard()
    {
        $semestres = Semestre::orderByDesc('id')->get();
        
        $semestresEstudiante = Nota::select('semestre_estudiante')
            ->distinct()
            ->orderBy('semestre_estudiante')
            ->pluck('semestre_estudiante');

        $ranking = Nota::with([
            'estudiante',
            'carrera',
            'semestre'
        ])
            ->orderByDesc('promedio')
            ->paginate(20);

        $carreras = Carrera::orderBy('nombre')->get();

        return view('supervisor.dashboard', compact(
            'ranking',
            'carreras',
            'semestres',
            'semestresEstudiante'
        ));
    }

    /**
     * Vista de ranking con filtros (solo lectura)
     */
    public function ranking(Request $request)
    {
        $query = Nota::with([
            'estudiante',
            'carrera',
            'semestre'
        ]);

        if ($request->filled('carrera')) {
            $query->where('carrera_id', $request->carrera);
        }

        if ($request->filled('semestre')) {
            $query->where('semestre_id', $request->semestre);
        }

        if ($request->filled('semestre_estudiante')) {
            $query->where('semestre_estudiante', $request->semestre_estudiante);
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

        return view('supervisor.ranking', compact(
            'ranking',
            'carreras',
            'semestres',
            'semestresEstudiante'
        ));
    }
}
