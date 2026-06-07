<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    // Redirigir a Google
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    // Manejar el callback
    public function callback()
{
    try {
        $googleUser = Socialite::driver('google')->user();

        // Busca el usuario por email, NO crea uno nuevo
        $user = User::where('email', $googleUser->getEmail())->first();

        if (!$user) {
            return redirect('/login')->with('error', 'Usuario no aceptado.');
        }

        Auth::login($user);

        // Estudiante
        if ($user->rol_id == 4) {

            return redirect('/dashboard');
        }

        // Tutor
        if ($user->rol_id == 3) {

            return redirect('/dashboard');
        }
        // supervisor
        if ($user->rol_id == 2) {

            return redirect('/dashboard');
        }

        // superadministrador
        if ($user->rol_id == 1) {

            return redirect('/dashboard');
        }
        // Otros roles
        Auth::logout();

        return redirect('/login')->with(
            'error',
            'Rol no autorizado.'
        );

    } catch (\Exception $e) {
        return redirect('/login')->with('error', 'Error al autenticar con Google.');
    }
}
}