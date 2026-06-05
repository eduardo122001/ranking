<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Nota;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Cargar la nota del estudiante con su semestre y el peso asociado a ese semestre
        $registro = Nota::with('semestre.peso')
            ->where('estudiante_id', $user->id)
            ->latest()
            ->first();

        // Historial del estudiante (también cargamos sus relaciones de forma eficiente)
        $historial = Nota::with('semestre.peso')
            ->where('estudiante_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        // Ya no necesitas buscar el peso por separado ($peso = Peso::latest...), 
        // ahora el peso vive dentro del semestre de la nota cargada.
        return view('dashboard', compact(
            'user',
            'registro',
            'historial'
        ));
    }
}