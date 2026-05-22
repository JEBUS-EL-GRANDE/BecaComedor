<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
// Ya no necesitamos 'Hash' si no vamos a hashear.

class AuthController extends Controller
{
    /**
     * FORMULARIO DE REGISTRO
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * REGISTRO DE USUARIO (Guarda en texto plano para el proyecto)
     */
    public function register(Request $request)
    {
        $request->validate([
            'nombre'     => 'required|string|max:50',
            'apellido'   => 'required|string|max:50',
            'telefono'   => 'nullable|string|max:15',
            'email'      => 'nullable|string|email|max:50|unique:personas',
            'password'   => 'required|string|min:4|max:600|confirmed',
            'ci'         => 'required|string|max:20|unique:personas',
            'sexo'       => ['required', 'string', Rule::in(['M', 'F', 'O'])],
            'direccion'  => 'nullable|string|max:100',
            'rol'        => 'required|string|max:30',
        ]);

        $user = Persona::create([
            'nombre'     => $request->nombre,
            'apellido'   => $request->apellido,
            'telefono'   => $request->telefono,
            'email'      => $request->email,
            'contrasena' => $request->password, // Se guarda como texto plano (temporal)
            'sexo'       => $request->sexo,
            'ci'         => $request->ci,
            'direccion'  => $request->direccion,
            'rol'        => $request->rol,
        ]);

        Auth::login($user);
        return redirect()->route('home');
    }

    /**
     * FORMULARIO DE LOGIN
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * LOGIN NORMAL (Usa autenticación manual con texto plano)
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'ci' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = Persona::where('ci', $credentials['ci'])->first();

        // Autenticación manual con texto plano
        if ($user && $user->contrasena === $credentials['password']) {
            Auth::login($user);
            $request->session()->regenerate();
            return redirect()->route('home');
        }

        return back()->withErrors([
            'ci' => 'Las credenciales no coinciden con nuestros registros.',
        ])->onlyInput('ci');
    }

    /**
     * PAGINA DESPUÉS DEL LOGIN
     */
    public function welcome()
    {
        // Asumo que esta es la ruta 'home'
        return view('welcome'); 
    }

    /**
     * LOGOUT
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
    
    // *** SE ELIMINARON LOS MÉTODOS showAdminLogin y adminLogin ***
}