<?php

namespace App\Http\Controllers\Encargado;

use App\Http\Controllers\Controller;
use App\Models\TipoServicio;
use Illuminate\Http\Request;

class TipoServicioController extends Controller
{
    public function index()
    {
        $servicios = TipoServicio::orderBy('hora_inicio')->get();
        return view('encargado.servicios.index', compact('servicios'));
    }
    
    public function create()
    {
        return view('encargado.servicios.create');
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre_servicio' => 'required|string|max:50|unique:tipo_servicio',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio'
        ]);
        
        TipoServicio::create($validated);
        
        return redirect()->route('encargado.servicios.index')
            ->with('success', 'Servicio creado correctamente.');
    }
    
    public function edit(TipoServicio $servicio)
    {
        return view('encargado.servicios.edit', compact('servicio'));
    }
    
    public function update(Request $request, TipoServicio $servicio)
    {
        $validated = $request->validate([
            'nombre_servicio' => 'required|string|max:50|unique:tipo_servicio,nombre_servicio,' . $servicio->id_tipo_servicio . ',id_tipo_servicio',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio'
        ]);
        
        $servicio->update($validated);
        
        return redirect()->route('encargado.servicios.index')
            ->with('success', 'Servicio actualizado correctamente.');
    }
    
    public function destroy(TipoServicio $servicio)
    {
        $servicio->delete();
        
        return redirect()->route('encargado.servicios.index')
            ->with('success', 'Servicio eliminado correctamente.');
    }
}