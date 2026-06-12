<?php

namespace App\Http\Controllers;


use App\Models\Nota;
use App\Models\Carrera;
use App\Models\Semestre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RankingController extends Controller
{
    public function index(Request $request)
    {
        $carreras = Carrera::orderBy('nombre')->get();

        $semestres = Semestre::orderByDesc('id')->get();

        $semestresEstudiante = Nota::select('semestre_estudiante')
            ->distinct()
            ->orderBy('semestre_estudiante')
            ->pluck('semestre_estudiante');

        $ranking = null; // vacío por defecto

        if (
            $request->filled('carrera') &&
            $request->filled('semestre') &&
            $request->filled('semestre_estudiante')
        ) {

            $ranking = Nota::with([
                    'estudiante',
                    'carrera',
                    'semestre'
                ])
                ->where('carrera_id', $request->carrera)
                ->where('semestre_id', $request->semestre)
                ->where('semestre_estudiante', $request->semestre_estudiante)
                ->orderByDesc('promedio')
                ->paginate(20)
                ->withQueryString();
        }

        $user = Auth::user();

        if ($user->rol_id == 1) {
            return view('Superadministrador.rankinglist', compact(
            'ranking',
            'carreras',
            'semestres',
            'semestresEstudiante'
        ));
        }
        if ($user->rol_id == 3) {
            return view('tutor.rankinglist', compact(
            'ranking',
            'carreras',
            'semestres',
            'semestresEstudiante'
        ));
        }
        if ($user->rol_id == 2) {
            return view('supervisor.rankinglist', compact(
            'ranking',
            'carreras',
            'semestres',
            'semestresEstudiante'
        ));
        }

        
    }
}