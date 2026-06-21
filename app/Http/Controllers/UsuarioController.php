<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Rol;
use App\Models\Log;
use App\Models\Nota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UsuarioController extends Controller
{
    public function index(Request $request)
    {
        $query = User::with('rol');

        $user = Auth::user();

        if ($user->rol_id == 3) {
            $query->where('rol_id', 4);
        } elseif ($request->filled('rol')) {
            $query->where('rol_id', $request->rol);
        }

        if ($request->filled('nombre')) {
            $query->where('name', 'like', '%' . $request->nombre . '%');
        }

        $usuarios = $query->paginate(15);
        $roles = Rol::all();

        
        if ($user->rol_id == 1) {
            return view('superadministrador.usuarios', compact('usuarios', 'roles'));
        }

        if ($user->rol_id == 3) {
            return view('tutor.usuarios', compact('usuarios', 'roles'));
        }
        
    }

    public function create()
    {
        $user = Auth::user();
        if ($user->rol_id == 1) {
            $roles = Rol::all();
            return view('superadministrador.usuarios-create', compact('roles'));
        }

        if ($user->rol_id == 3) {

            $roles = Rol::where('id', 4)->get();

            return view(
                'tutor.usuarios-create',
                compact('roles')
            );
        }

    }

    public function store(Request $request)
    {
        $authUser = Auth::user();

        $rolId = $request->rol_id;

        if ($authUser->rol_id == 3) {
            $rolId = 4; // Tutor solo puede crear alumnos
        }

        if ($authUser->rol_id == 3) {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'dni' => 'required|unique:users,dni'
            ]);
        } else {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'dni' => 'required|unique:users,dni',
                'rol_id' => 'required'
            ]);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'dni' => $request->dni,
            'rol_id' => $rolId,
            'password' => null
        ]);

        // DESPUES DE CREAR UN USUARIO SE CREA UN LOG (REPORTE)
        $user->load('rol');
        $autor = auth()->user();

        Log::create([
            'autor_id' => auth()->id(),
            'accion_id' => 4,
            'entidad' => 'user',
            'entidad_id' => $user->id,
            'descripcion' => $autor->name .' creó el usuario ' . $user->name . ' con rol ' . $user->rol->nombre
        ]);

        $user = Auth::user();
        if ($user->rol_id == 1) {
            return redirect('superadministrador/usuarios')->with('success', 'Usuario creado');
        }

        if ($user->rol_id == 3) {
            return redirect('tutor/usuarios')->with('success', 'Usuario creado');
        }
    }

    public function edit(User $user)
    {
        $roles = Rol::all();

        $authUser = Auth::user();

        // Superadministrador: puede editar cualquiera
        if ($authUser->rol_id == 1) {
            return view(
                'superadministrador.usuarios-edit',
                compact('user', 'roles')
            );
        }

        // Tutor: solo puede editar alumnos
        if ($authUser->rol_id == 3) {

            if ($user->rol_id != 4) {
                abort(403, 'No tienes permiso para editar este usuario');
            }

            $roles = Rol::where('id', 4)->get();

            return view(
                'tutor.usuarios-edit',
                compact('user', 'roles')
            );
        }

        abort(403);
    }

    public function update(Request $request, User $user)
    {
        $authUser = Auth::user();

        // Un tutor solo puede editar alumnos
        if ($authUser->rol_id == 3 && $user->rol_id != 4) {
            abort(403, 'Acceso denegado');
        }

        if ($authUser->rol_id == 3) {

            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users,email,' . $user->id,
                'dni' => 'required|unique:users,dni,' . $user->id,
            ]);

            // Forzar que siga siendo alumno
            $rolId = 4;

        } else {

            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users,email,' . $user->id,
                'dni' => 'required|unique:users,dni,' . $user->id,
                'rol_id' => 'required'
            ]);

            $rolId = $request->rol_id;
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'dni' => $request->dni,
            'rol_id' => $rolId
        ]);

        // LOG
        $user->load('rol');
        $autor = auth()->user();

        Log::create([
            'autor_id' => auth()->id(),
            'accion_id' => 5,
            'entidad' => 'user',
            'entidad_id' => $user->id,
            'descripcion' => $autor->name .
                ' actualizó el usuario ' .
                $user->name .
                ' con rol ' .
                $user->rol->nombre
        ]);

        if ($authUser->rol_id == 1) {
            return redirect('superadministrador/usuarios')
                ->with('success', 'Usuario actualizado');
        }

        return redirect('tutor/usuarios')
            ->with('success', 'Usuario actualizado');
    }

    public function destroy(User $user)
    {
        $authUser = Auth::user();

        if ($authUser->rol_id == 3 && $user->rol_id != 4) {
            abort(403);
        }
        // 1. Guardar la información antes de eliminarlo para el reporte de Log
        $user->load('rol');
        $autor = auth()->user();
        $nombreUsuarioEliminado = $user->name;
        $rolUsuarioEliminado = $user->rol->nombre ?? 'Sin rol';

        DB::transaction(function () use ($user, $authUser, $nombreUsuarioEliminado, $rolUsuarioEliminado ) {

            // 2. Crear el LOG (Reporte) de eliminación
            Log::create([  
                'autor_id' => auth()->id(),
                'accion_id' => 6, 
                'entidad' => 'user',
                'entidad_id' => $user->id,
                'descripcion' => $authUser->name . ' eliminó al usuario ' . $nombreUsuarioEliminado . ' que tenía el rol ' . $rolUsuarioEliminado
            ]);

            // Eliminar todas las notas del usuario
            Nota::where('estudiante_id', $user->id)->delete();

            // 3.  eliminamos el usuario físicamente
            $user->delete();
        });


         // 4. Redireccionar de forma directa por URL para forzar la tabla y romper el bucle del 404
        if ($authUser->rol_id == 1) {
            return redirect()->route('superadministrador.usuarios.index')
                ->with('success', 'Usuario eliminado correctamente');
        }

        if ($authUser->rol_id == 3) {
            return redirect()->route('tutor.usuarios.index')
                ->with('success', 'Usuario eliminado correctamente');
        }
        
        
    }
}