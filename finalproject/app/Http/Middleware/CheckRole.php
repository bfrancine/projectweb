<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string $role): mixed
    {
        // Verificar si el usuario está autenticado
        if (!Auth::check()) {
            return redirect()->route('login'); // Redirigir al login si no está autenticado
        }

        // Validar el rol del usuario
        if (Auth::user()->type_user !== $role) {
            abort(403, 'Unauthorized'); // Mostrar un error 403 si no tiene acceso
        }

        return $next($request);
    }
}
