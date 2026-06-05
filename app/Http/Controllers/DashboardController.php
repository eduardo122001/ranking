<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Nota;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Redirige según rol
        if ($user->rol_id == 1) {
            return redirect()->route('tutor.dashboard');
        }

        if ($user->rol_id == 2) {
            return redirect()->route('supervisor.dashboard');
        }

        // Rol estudiante u otro: muestra dashboard normal
        $registro = Nota::where('estudiante_id', $user->id)->latest()->first();
        $historial = Nota::where('estudiante_id', $user->id)->latest()->take(5)->get();

        return view('dashboard', compact('user', 'registro', 'historial'));
    }
}
