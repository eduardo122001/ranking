<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;

use App\Models\User;

use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Redirigir a Google
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    // Callback de Google
    public function callback()
    {
        $googleUser = Socialite::driver('google')->user();

        // Buscar usuario por correo
        $user = User::where(
            'email',
            $googleUser->email
        )->first();

        // Si NO existe → acceso rechazado
        if (!$user) {

            return view('acceso-rechazado');
        }

        // Guardar google_id opcionalmente
        $user->google_id = $googleUser->id;

        $user->save();

        // Login
        Auth::login($user);

        // Redirigir
        return redirect('/notas');
    }
}