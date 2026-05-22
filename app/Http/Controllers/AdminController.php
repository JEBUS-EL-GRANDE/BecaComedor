<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Persona;

class AdminController extends Controller
{
    /**
     * Muestra el formulario de login del Administrador.
     */
    public function showLoginForm()
    {
        return view('admin.login');
    }

    /**
     * Procesa el intento de login: SOLO CI Y CONTRASEÑA (TEMPORAL).
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'ci' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = Persona::where('ci', $credentials['ci'])->first();
/**para que se autentique el usuario en el login admin */
        $adminCheck = $user && $user->contrasena === $credentials['password'] && trim($user->rol) === 'ADMINISTRADOR'; // Lógica TEMPORAL

        if ($adminCheck) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'ci' => 'Credenciales no válidas. Intente de nuevo.',
        ])->onlyInput('ci');
    }

    /**
     * Muestra el Dashboard de Administración.
     */
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    // --- MÉTODOS DE GESTIÓN DE TABLAS (CRUD) ---
    public function managePersonas() { return view('admin.manage', ['table' => 'Personas']); }
    public function manageCarreras() { return view('admin.manage', ['table' => 'Carreras']); }
    public function manageEncargados() { return view('admin.manage', ['table' => 'Encargados']); }
    public function manageTiposBeca() { return view('admin.manage', ['table' => 'Tipos Beca']); }
    public function manageParticulares() { return view('admin.manage', ['table' => 'Particulares']); }
    public function managePersonalCocina() { return view('admin.manage', ['table' => 'Personal Cocina']); }
    public function manageEstudiantes() { return view('admin.manage', ['table' => 'Estudiantes']); }
}