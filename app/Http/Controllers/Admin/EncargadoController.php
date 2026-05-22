<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Encargado;
use App\Models\Persona;
use Illuminate\Http\Request;

class EncargadoController extends Controller
{
    /**
     * Muestra la lista de encargados.
     */
    public function index()
    {
        // Precargamos la información de la persona para mostrar el nombre
        $encargados = Encargado::with('persona')->get();
        return view('admin.encargados.index', compact('encargados'));
    }

    /**
     * Muestra el formulario para crear un nuevo encargado.
     */
    public function create()
    {
        // Solo mostramos las Personas que tienen el Rol 'ENCARGADO'
        $personas = Persona::where('rol', 'ENCARGADO')->get();
        
        return view('admin.encargados.create', compact('personas'));
    }

    /**
     * Almacena un nuevo encargado en la BD.
     */
    public function store(Request $request)
    {
        $request->validate([
            // Asegura que la persona exista y no sea ya un encargado
            'id_personal' => 'required|exists:personas,id_personal|unique:encargado,id_personal', 
            'cargo'       => 'required|string|max:50',
            'turno'       => 'required|string|max:20',
        ]);

        Encargado::create($request->all());

        return redirect()->route('admin.encargados.index')
                         ->with('success', 'Encargado registrado correctamente.');
    }

    /**
     * Muestra el formulario para editar un encargado.
     */
    public function edit(Encargado $encargado)
    {
        // En edición no listamos todas las personas, solo editamos los campos propios del encargado
        return view('admin.encargados.edit', compact('encargado'));
    }

    /**
     * Actualiza el registro de un encargado en la base de datos.
     */
    public function update(Request $request, Encargado $encargado)
    {
        $request->validate([
            'cargo'       => 'required|string|max:50',
            'turno'       => 'required|string|max:20',
        ]);
        
        $encargado->update($request->all());

        return redirect()->route('admin.encargados.index')
                         ->with('success', 'El registro del encargado ha sido actualizado.');
    }

    /**
     * Elimina el registro de un encargado.
     */
    public function destroy(Encargado $encargado)
    {
        $nombreCompleto = $encargado->persona->nombre . ' ' . $encargado->persona->apellido;
        
        $encargado->delete();

        return redirect()->route('admin.encargados.index')
                         ->with('success', "El encargado {$nombreCompleto} ha sido eliminado.");
    }
}