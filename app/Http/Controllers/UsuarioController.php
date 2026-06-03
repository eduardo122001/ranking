<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Rol;
use App\Models\Log;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function index(Request $request)
    {
        $query = User::with('rol');

        if ($request->filled('nombre')) {
            $query->where('name', 'like', '%' . $request->nombre . '%');
        }

        if ($request->filled('rol')) {
            $query->where('rol_id', $request->rol);
        }

        $usuarios = $query->paginate(15);
        $roles = Rol::all();

        return view('usuarios', compact('usuarios', 'roles'));
    }

    public function create()
    {
        $roles = Rol::all();

        return view('usuarios-create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'dni' => 'required|unique:users,dni',
            'rol_id' => 'required'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'dni' => $request->dni,
            'rol_id' => $request->rol_id,
            'password' => null
        ]);

        //DESPUES DE CREAR UN USUARIO SE CREA UN LOG (REPORTE)
    
        $user->load('rol');
        $autor = auth()->user();

        Log::create([
            'autor_id' => auth()->id(),
            'accion_id' => 4,
            'entidad' => 'user',
            'entidad_id' => $user->id,
            'descripcion' => $autor->name .' creó el usuario ' . $user->name .
                            ' con rol ' . $user->rol->nombre
        ]);

        return redirect()
            ->route('usuarios.index')
            ->with('success', 'Usuario creado');
    }

    public function edit(User $user)
    {
        $roles = Rol::all();

        return view('usuarios-edit', compact(
            'user',
            'roles'
        ));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'dni' => 'required|unique:users,dni,' . $user->id,
            'rol_id' => 'required'
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'dni' => $request->dni,
            'rol_id' => $request->rol_id
        ]);

        //DESPUES DE EDITAR UN USUARIO SE CREA UN LOG (REPORTE)

        $user->load('rol');
        $autor = auth()->user();

        Log::create([  
            'autor_id' => auth()->id(),
            'accion_id' => 5,
            'entidad' => 'user',
            'entidad_id' => $user->id,
            'descripcion' => $autor->name . ' actualizó el usuario ' . $user->name .
                            ' con rol ' . $user->rol->nombre
        ]);


        return redirect()
            ->route('usuarios.index')
            ->with('success', 'Usuario actualizado');
    }


}