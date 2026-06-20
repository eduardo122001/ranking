<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Semestre;
use App\Models\Peso;
use App\Models\Nota;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;



class SemestreController extends Controller
{
    public function index()
    {
        $semestres = Semestre::latest()
            ->take(5)
            ->get();

        return view('superadministrador.semestres', compact('semestres'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'year' => 'required|numeric',
            'period' => 'required'
        ]);

        $nombre = '20' . $request->year . '-' . $request->period;

        // Verificar si ya existe
        $existe = Semestre::where('nombre', $nombre)->exists();

        if ($existe) {
            return back()
                ->withErrors([
                    'semestre' => "El semestre $nombre ya existe"
                ])
                ->withInput();
        }

        $ultimoPeso = Peso::latest()->first();

        if (!$ultimoPeso) {
            return back()->withErrors([
                'peso' => 'No existe ningún peso registrado'
            ]);
        }

        Semestre::create([
            'nombre' => $nombre,
            'peso_id' => $ultimoPeso->id
        ]);
        return back()->with('success', "Semestre $nombre creado");
    }
    public function destroy(Semestre $semestre): RedirectResponse
    {
        DB::transaction(function () use ($semestre) {
            Nota::where('semestre_id', $semestre->id)->delete();

            $semestre->delete();
        });

        return redirect()
            ->route('superadministrador.semestres.index')
            ->with('success', 'Semestre y notas relacionadas eliminados correctamente.');
    }
}
