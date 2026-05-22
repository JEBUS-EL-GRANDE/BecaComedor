<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Estudiante;
use App\Models\ControlAsistencia;
use App\Models\TipoServicio;
use Carbon\Carbon;

class AsistenciaPublicaController extends Controller
{
    // Mostrar formulario de login para asistencia
    public function showLoginForm()
    {
        return view('asistencia.login');
    }
    
    // Procesar login y mostrar formulario de asistencia
    public function registrarAsistencia(Request $request)
    {
        // Validar CI y contraseña
        $credentials = $request->validate([
            'ci' => 'required|string',
            'contrasena' => 'required|string'
        ]);
        
        // Buscar estudiante por CI a través de la relación con persona
        $estudiante = Estudiante::whereHas('persona', function($query) use ($credentials) {
            $query->where('ci', $credentials['ci']);
        })->with(['persona', 'carrera'])->first();
        
        if (!$estudiante) {
            return back()->withErrors([
                'ci' => 'Estudiante no encontrado.'
            ])->withInput();
        }
        
        // Verificar contraseña (simple comparación)
        if ($estudiante->persona->contrasena !== $credentials['contrasena']) {
            return back()->withErrors([
                'contrasena' => 'Contraseña incorrecta.'
            ])->withInput();
        }
        
        // Obtener tipos de servicio disponibles
        $servicios = TipoServicio::all();
        
        // Pasar datos a la vista de registro
        return view('asistencia.registrar', [
            'estudiante' => $estudiante,
            'servicios' => $servicios
        ]);
    }
    
    // Guardar la asistencia
    public function storeAsistencia(Request $request)
    {
        $validated = $request->validate([
            'id_estudiante' => 'required|exists:estudiante,id_registro',
            'tipo_servicio' => 'required|string|max:50',
            'observacion' => 'nullable|string|max:100'
        ]);
        
        // Verificar si ya tiene asistencia hoy
        $hoy = Carbon::today()->toDateString();
        $asistenciaExistente = ControlAsistencia::where('id_estudiante', $validated['id_estudiante'])
            ->whereDate('fecha', $hoy)
            ->exists();
        
        if ($asistenciaExistente) {
            return back()->withErrors([
                'error' => 'Ya tienes una asistencia registrada para hoy.'
            ])->withInput();
        }
        
        // Crear asistencia
        ControlAsistencia::create([
            'id_estudiante' => $validated['id_estudiante'],
            'tipo_servicio' => $validated['tipo_servicio'],
            'fecha' => $hoy,
            'observacion' => $validated['observacion'] ?? null
        ]);
        
        // Obtener datos del estudiante para el mensaje
        $estudiante = Estudiante::with('persona')->find($validated['id_estudiante']);
        
        return view('asistencia.success', [
            'estudiante' => $estudiante,
            'tipo_servicio' => $validated['tipo_servicio'],
            'fecha' => $hoy
        ]);
    }
}