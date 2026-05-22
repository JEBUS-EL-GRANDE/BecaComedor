<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Particular;
use App\Models\Persona;
use Illuminate\Http\Request;

class ParticularController extends Controller
{
    /**
     * Muestra la lista de registros particulares.
     */
    public function index()
{
    // ❌ Cambia esto:
    // $particulares = Particular::with('persona')->get();
    
    // ✅ Por esto (con paginación):
    $particulares = Particular::with('persona')->paginate(15);
    
    return view('admin.particulares.index', compact('particulares'));
}

    /**
     * Muestra el formulario para crear un nuevo registro particular.
     */
    public function create()
    {
        // Solo mostramos las Personas que tienen el Rol 'PARTICULAR'
        $personas = Persona::where('rol', 'PARTICULAR')->get();
        
        return view('admin.particulares.create', compact('personas'));
    }

    /**
     * Almacena un nuevo registro particular en la BD.
     */
    public function store(Request $request)
    {
        $request->validate([
            // Asegura que la persona exista y no sea ya un particular registrado
            'id_personal'     => 'required|exists:personas,id_personal|unique:particular,id_personal', 
            'tipo_particular' => 'required|string|max:50',
        ]);

        Particular::create($request->all());

        return redirect()->route('admin.particulares.index')
                         ->with('success', 'Registro Particular creado correctamente.');
    }

    /**
     * Muestra el formulario para editar un registro particular.
     */
    public function edit(Particular $particular)
    {
        return view('admin.particulares.edit', compact('particular'));
    }

    /**
     * Actualiza el registro de un particular en la base de datos.
     */
    public function update(Request $request, Particular $particular)
    {
        $request->validate([
            'tipo_particular' => 'required|string|max:50',
        ]);
        
        $particular->update($request->all());

        return redirect()->route('admin.particulares.index')
                         ->with('success', 'El registro particular ha sido actualizado.');
    }

    /**
     * Elimina el registro de un particular.
     */
    public function destroy(Particular $particular)
    {
        $nombreCompleto = $particular->persona->nombre . ' ' . $particular->persona->apellido;
        
        $particular->delete();

        return redirect()->route('admin.particulares.index')
                         ->with('success', "El registro de particular para {$nombreCompleto} ha sido eliminado.");
    }
}