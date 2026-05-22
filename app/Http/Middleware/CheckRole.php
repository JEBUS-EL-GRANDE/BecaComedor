<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response{
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();
        $user_role = trim($user->rol);

        if ($user && in_array($user->rol, $roles)) {
            return $next($request);
        }
        return redirect('/dashboard')->with('error', 'No tienes permiso para acceder a esta sección.');
    }
}