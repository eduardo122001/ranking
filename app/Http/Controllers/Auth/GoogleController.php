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
            
            \Log::info('Google user data:', [
                'email' => $googleUser->getEmail(),
                'name' => $googleUser->getName(),
            ]);

            // Busca el usuario por email
            $user = User::where('email', $googleUser->getEmail())->first();

            if (!$user) {
                \Log::error('User not found with email: ' . $googleUser->getEmail());
                return redirect('/login')->with('error', 'Usuario no encontrado.');
            }

            Auth::login($user);
            
            \Log::info('User logged in with role_id: ' . $user->rol_id);

            // Tutor (rol_id = 1)
            if ($user->rol_id == 1) {
                return redirect('/upload');
            }

            // Supervisor (rol_id = 2)
            if ($user->rol_id == 2) {
                return redirect('/rankinglist');
            }

            // Estudiante (rol_id = 3)
            if ($user->rol_id == 3) {
                return redirect('/dashboard');
            }

            // Superadmin (rol_id = 4)
            if ($user->rol_id == 4) {
                return redirect('/rankinglist');
            }

            // Otros roles
            Auth::logout();
            return redirect('/login')->with('error', 'Rol no autorizado.');

        } catch (\Exception $e) {
            \Log::error('Google auth error: ' . $e->getMessage());
            return redirect('/login')->with('error', 'Error: ' . $e->getMessage());
        }
    }
}
