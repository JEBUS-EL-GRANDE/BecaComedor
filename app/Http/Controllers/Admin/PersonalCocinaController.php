<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PersonalCocina;
use App\Models\Persona;
use Illuminate\Http\Request;

class PersonalCocinaController extends Controller
{
    public function index()
    {
        $personalCocina = PersonalCocina::with('persona')->get();
        return view('admin.personalcocina.index', compact('personalCocina'));
    }
    
    public function create()
    {
        // Obtener solo personas con rol PERSONAL COCINA o todas si prefieres
        $personas = Persona::where('rol', 'PERSONAL COCINA')->get();
        // O si quieres mostrar todas las personas:
        // $personas = Persona::all();
        
        return view('admin.personalcocina.create', compact('personas'));
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_personal' => 'required|exists:personas,id_personal|unique:personal_cocina,id_personal',
            'especialidad' => 'nullable|string|max:50',
            'horario_trabajo' => 'nullable|string|max:50'
        ]);
        
        PersonalCocina::create($validated);
        
        // Opcional: Actualizar el rol de la persona si no está definido
        $persona = Persona::find($validated['id_personal']);
        if ($persona && !$persona->rol) {
            $persona->update(['rol' => 'PERSONAL COCINA']);
        }
        
        return redirect()->route('admin.personalcocina.index')
            ->with('success', 'Personal de cocina creado correctamente.');
    }
    
    public function edit($id) // O (PersonalCocina $personalCocina) si usas route model binding
    {
        $personalCocina = PersonalCocina::with('persona')->findOrFail($id);
        return view('admin.personalcocina.edit', compact('personalCocina'));
    }
    
    public function update(Request $request, $id)
    {
        $personalCocina = PersonalCocina::findOrFail($id);
        
        $validated = $request->validate([
            'especialidad' => 'nullable|string|max:50',
            'horario_trabajo' => 'nullable|string|max:50'
        ]);
        
        $personalCocina->update($validated);
        
        return redirect()->route('admin.personalcocina.index')
            ->with('success', 'Personal de cocina actualizado correctamente.');
    }
    
    public function destroy($id)
    {
        $personalCocina = PersonalCocina::findOrFail($id);
        $personalCocina->delete();
        
        return redirect()->route('admin.personalcocina.index')
            ->with('success', 'Personal de cocina eliminado correctamente.');
    }
}