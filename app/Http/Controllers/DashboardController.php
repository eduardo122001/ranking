<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Nota;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Buscar nota del estudiante logueado
        $registro = Nota::where('estudiante_id', $user->id)
            ->latest()
            ->first();

        // Historial del estudiante
        $historial = Nota::where('estudiante_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'user',
            'registro',
            'historial'
        ));
    }
}