<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->rol === 'ADMINISTRADOR') {
            return $next($request);
        }
        
        // Redirigir si no es administrador o no está logueado.
        Auth::logout(); // Opcional: Cerrar sesión si intenta acceder sin ser admin
        return redirect()->route('admin.login')->with('error', 'Acceso restringido. Inicie sesión como Administrador.');
    }
}