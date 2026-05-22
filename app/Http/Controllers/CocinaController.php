<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Persona;
use App\Models\PersonalCocina;

class CocinaController extends Controller
{
    // Mostrar formulario de login
    public function showLoginForm()
    {
        return view('cocina.login');
    }
    
    // Procesar login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'ci' => 'required|string',
            'contrasena' => 'required|string'
        ]);
        
        // Buscar persona por CI
        $persona = Persona::where('ci', $credentials['ci'])->first();
        
        if (!$persona) {
            return back()->withErrors([
                'ci' => 'CI no encontrado.'
            ])->withInput();
        }
        
        // Verificar contraseña (asumiendo que está sin encriptar o con hash simple)
        if ($persona->contrasena !== $credentials['contrasena']) {
            return back()->withErrors([
                'contrasena' => 'Contraseña incorrecta.'
            ])->withInput();
        }
        
        // Verificar que tenga rol PERSONAL COCINA
        if ($persona->rol !== 'PERSONAL COCINA') {
            return back()->withErrors([
                'ci' => 'No tienes permisos de Personal de Cocina.'
            ])->withInput();
        }
        
        // Login manual (sin usar Auth::attempt porque la contraseña no está encriptada)
        Auth::login($persona);
        
        return redirect()->route('cocina.horario');
    }
    
    // Mostrar horario (solo lectura)
    public function showHorario()
    {
        // Obtener el personal de cocina actual
        $user = Auth::user();
        
        // Buscar información del personal de cocina
        $personalCocina = PersonalCocina::where('id_personal', $user->id_personal)
            ->with('persona')
            ->first();
        
        if (!$personalCocina) {
            return redirect()->route('cocina.horario.showLoginForm')
                ->withErrors(['error' => 'No se encontró información del personal de cocina.']);
        }
        
        return view('cocina.horario', compact('personalCocina'));
    }
    
    // Logout
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}