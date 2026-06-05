<?php

namespace App\Http\Controllers;

use App\Models\Nota;
use App\Models\User;
use App\Models\Carrera;
use App\Models\Semestre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TutorController extends Controller
{
    /**
     * Dashboard del tutor - listar estudiantes
     */
    public function dashboard()
    {
        $tutor = Auth::user();
        
        $estudiantes = User::where('rol_id', 4) // 4 = ESTUDIANTE
            ->orderBy('name')
            ->paginate(15);

        return view('tutor.dashboard', compact('tutor', 'estudiantes'));
    }

    /**
     * Formulario para crear/editar estudiante
     */
    public function editarEstudiante($id = null)
    {
        $carreras = Carrera::orderBy('nombre')->get();
        
        if ($id) {
            $estudiante = User::findOrFail($id);
            if ($estudiante->rol_id != 4) {
                abort(403, 'Solo puedes editar estudiantes');
            }
        } else {
            $estudiante = null;
        }

        return view('tutor.editar-estudiante', compact('estudiante', 'carreras'));
    }

    /**
     * Guardar o actualizar estudiante
     */
    public function guardarEstudiante(Request $request, $id = null)
    {
        if ($id) {
            $validated = $request->validate([
                'name' => 'required|string|max:100',
                'email' => 'required|email|unique:users,email,' . $id,
                'dni' => 'required|string|max:8|unique:users,dni,' . $id,
                'password' => 'nullable|min:8',
            ]);

            $estudiante = User::findOrFail($id);
            $estudiante->name = $validated['name'];
            $estudiante->email = $validated['email'];
            $estudiante->dni = $validated['dni'];
            if ($request->filled('password')) {
                $estudiante->password = bcrypt($validated['password']);
            }
            $estudiante->save();
            $mensaje = 'Estudiante actualizado ✓';
        } else {
            $validated = $request->validate([
                'name' => 'required|string|max:100',
                'email' => 'required|email|unique:users',
                'dni' => 'required|string|max:8|unique:users',
                'password' => 'required|min:8',
            ]);

            $validated['password'] = bcrypt($validated['password']);
            $validated['rol_id'] = 4; // ESTUDIANTE
            User::create($validated);
            $mensaje = 'Estudiante creado ✓';
        }

        return redirect()->route('tutor.dashboard')->with('success', $mensaje);
    }

    /**
     * Ver ranking completo (todos los estudiantes)
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

        return view('tutor.ranking', compact(
            'ranking',
            'carreras',
            'semestres',
            'semestresEstudiante'
        ));
    }

    /**
     * Eliminar estudiante
     */
    public function eliminarEstudiante($id)
    {
        $estudiante = User::findOrFail($id);
        if ($estudiante->rol_id != 4) {
            abort(403, 'Solo puedes eliminar estudiantes');
        }

        Nota::where('estudiante_id', $id)->delete();
        $estudiante->delete();

        return redirect()->route('tutor.dashboard')->with('success', 'Estudiante eliminado ✓');
    }
}
