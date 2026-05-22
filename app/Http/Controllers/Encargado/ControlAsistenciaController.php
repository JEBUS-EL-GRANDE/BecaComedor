<?php

namespace App\Http\Controllers\Encargado;

use App\Http\Controllers\Controller;
use App\Models\ControlAsistencia;
use App\Models\Estudiante;
use App\Models\TipoServicio;
use Illuminate\Http\Request;

class ControlAsistenciaController extends Controller
{
    public function index()
    {
        // Obtener asistencias con relaciones
        $asistencias = ControlAsistencia::with(['estudiante.persona'])
            ->orderBy('fecha', 'desc')
            ->paginate(10);
            
        return view('encargado.asistencia.index', compact('asistencias'));
    }
    
    public function create()
{
    // Obtener estudiantes para el select - CORREGIDO
    $estudiantes = Estudiante::with('persona')->get();
    
    // Obtener servicios de la tabla tipo_servicio - CORREGIDO
    $servicios = TipoServicio::all();
    
    return view('encargado.asistencia.create', compact('estudiantes', 'servicios'));
}
    
public function store(Request $request)
{
    // Validación CORREGIDA
    $validated = $request->validate([
        'id_estudiante' => 'required|exists:estudiante,id_registro',
        'tipo_servicio' => 'required|string|max:50',
        'fecha' => 'required|date',
        'observacion' => 'nullable|string|max:100'
    ]);
    
    \Log::info('Datos recibidos para guardar asistencia:', $validated);
    
    try {
        // Crear la asistencia
        $asistencia = ControlAsistencia::create([
            'id_estudiante' => $validated['id_estudiante'],
            'tipo_servicio' => $validated['tipo_servicio'],
            'fecha' => $validated['fecha'],
            'observacion' => $validated['observacion'] ?? null
        ]);
        
        \Log::info('Asistencia creada con ID: ' . $asistencia->id_asistencia);
        
        return redirect()->route('encargado.asistencia.index')
            ->with('success', 'Asistencia registrada correctamente.');
            
    } catch (\Exception $e) {
        \Log::error('Error al crear asistencia: ' . $e->getMessage());
        
        return back()->withInput()
            ->with('error', 'Error al registrar la asistencia: ' . $e->getMessage());
    }
}

    
    public function edit(ControlAsistencia $asistencia)
    {
        $estudiantes = Estudiante::with('persona')->get();
        $servicios = TipoServicio::all();
        
        return view('encargado.asistencia.edit', 
            compact('asistencia', 'estudiantes', 'servicios'));
    }
    
    public function update(Request $request, ControlAsistencia $asistencia)
{
    $validated = $request->validate([
        'tipo_servicio' => 'required|string|max:50',
        'fecha' => 'required|date',
        'observacion' => 'nullable|string|max:100'
    ]);
    
    $asistencia->update($validated);
    
    return redirect()->route('encargado.asistencia.index')
        ->with('success', 'Asistencia actualizada correctamente.');
}
    
    public function destroy(ControlAsistencia $asistencia)
    {
        $asistencia->delete();
        
        return redirect()->route('encargado.asistencia.index')
            ->with('success', 'Asistencia eliminada correctamente.');
    }
}