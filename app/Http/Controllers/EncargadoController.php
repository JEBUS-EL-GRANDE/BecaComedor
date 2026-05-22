<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona; // Usamos tu modelo Persona
use Illuminate\Support\Facades\Auth;

class EncargadoController extends Controller
{
    /**
     * Muestra el formulario de login para Encargados.
     */
    public function showLoginForm()
    {
        return view('encargado.login');
    }

    /**
     * Maneja el intento de login para Encargados.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'ci' => 'required|string',
            'contrasena' => 'required|string',
        ]);

        // 1. Buscar usuario por CI y ROL 'ENCARGADO'
        $user = Persona::where('ci', trim($credentials['ci']))
                        ->whereRaw("trim(rol) = 'ENCARGADO'") // Verificar Rol 'ENCARGADO'
                        ->first();

        // 2. Verificación de contraseña (texto plano, si no usas Hash)
        if ($user && trim($user->contrasena) === trim($credentials['contrasena'])) {
            
            // Iniciar sesión (usando la guardia web por defecto)
            Auth::login($user); 

            $request->session()->regenerate();

            return redirect()->route('encargado.dashboard');
        }
        
        // Fallo en la autenticación
        return back()->withErrors([
            'ci' => 'Credenciales no válidas o no tiene permisos de Encargado.',
        ])->onlyInput('ci');
    }

    /**
     * Muestra el dashboard del Encargado.
     */
    public function dashboard()
    {
        // El middleware 'rol:ENCARGADO' ya asegura que solo los encargados lleguen aquí
        return view('encargado.dashboard');
    }

    /**
     * Cierra la sesión (Opcional, si quieres un logout separado).
     */
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}