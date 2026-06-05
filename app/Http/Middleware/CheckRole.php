<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (!auth()->check()) {
            return redirect('/login');
        }

        $user = auth()->user();
        
        if (is_numeric($role)) {
            if ($user->rol_id != $role) {
                abort(403, 'Acceso denegado');
            }
        }

        return $next($request);
    }
}
