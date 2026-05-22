<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Administrador;
use App\Models\Persona;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdministradorController extends Controller
{
    /**
     * Muestra la lista de registros de administradores.
     */
    public function index()
    {
        $administradores = Administrador::with('persona')->get();
        return view('admin.administradores.index', compact('administradores'));
    }

    /**
     * Muestra el formulario para crear un nuevo registro de administrador.
     */
    public function create()
    {
        // Solo mostramos las Personas que tienen el Rol 'ADMINISTRADOR'
        $personas = Persona::where('rol', 'ADMINISTRADOR')->get();
        
        return view('admin.administradores.create', compact('personas'));
    }

    /**
     * Almacena un nuevo registro de administrador en la BD.
     */
    public function store(Request $request)
    {
        $request->validate([
            // Asegura que la persona exista y no sea ya un administrador registrado
            'id_personal'     => 'required|exists:personas,id_personal|unique:administrador,id_personal', 
            'ultimo_acceso'   => 'required|date',
            'fecha_inicio_rol' => 'required|date|before_or_equal:ultimo_acceso',
        ]);

        Administrador::create($request->all());

        return redirect()->route('admin.administradores.index')
                         ->with('success', 'Registro de Administrador creado correctamente.');
    }

    /**
     * Muestra el formulario para editar un registro de administrador.
     */
    public function edit(Administrador $administrador)
    {
        return view('admin.administradores.edit', compact('administrador'));
    }

    /**
     * Actualiza el registro de un administrador en la base de datos.
     */
    public function update(Request $request, Administrador $administrador)
    {
        $request->validate([
            'ultimo_acceso'   => 'required|date',
            'fecha_inicio_rol' => 'required|date|before_or_equal:ultimo_acceso',
        ]);
        
        $administrador->update($request->all());

        return redirect()->route('admin.administradores.index')
                         ->with('success', 'El registro de administrador ha sido actualizado.');
    }

    /**
     * Elimina el registro de un administrador.
     */
    public function destroy(Administrador $administrador)
    {
        $nombreCompleto = $administrador->persona->nombre . ' ' . $administrador->persona->apellido;
        
        $administrador->delete();

        return redirect()->route('admin.administradores.index')
                         ->with('success', "El registro de administrador para {$nombreCompleto} ha sido eliminado.");
    }
}