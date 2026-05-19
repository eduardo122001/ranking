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

        return redirect()->intended('/dashboard');

    } catch (\Exception $e) {
        return redirect('/login')->with('error', 'Error al autenticar con Google.');
    }
}
}