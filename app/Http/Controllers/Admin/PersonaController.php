<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Persona; // Importa tu modelo Persona
use Illuminate\Http\Request;

class PersonaController extends Controller
{
    public function index()
    {
        // Obtener todos los datos de la tabla personas
        $personas = Persona::all();

        // Pasar los datos a la vista 'admin.personas.index'
        return view('admin.personas.index', compact('personas'));
    }
    /**
     *********************************** Elimina el registro de una persona.
     */
    public function destroy(Persona $persona)
    {
        // El tipo hinting (Persona $persona) hace que Laravel la busque automáticamente por el ID
        $nombreCompleto = trim($persona->nombre) . ' ' . trim($persona->apellido);
        
        $persona->delete();

        // Redirigir de vuelta a la lista con un mensaje de éxito
        return redirect()->route('admin.personas.index')
                        ->with('success', "La persona {$nombreCompleto} ha sido eliminada correctamente.");
    }
    /**************************************Boton editar */
    public function edit(Persona $persona)
    {
        // Pasa el modelo de persona a la vista para que el formulario se precargue
        return view('admin.personas.edit', compact('persona'));
    }

    /**
     * Actualiza el registro de una persona en la base de datos.
     */
    public function update(Request $request, Persona $persona)
    {
        // 1. Validación de datos (Ajusta estas reglas a tus necesidades)
        $request->validate([
            'nombre'     => 'required|string|max:50',
            'apellido'   => 'required|string|max:50',
            'ci'         => 'required|string|max:20|unique:personas,ci,' . $persona->id_personal . ',id_personal',
            'rol'        => 'required|string|max:30',
            // ... (añadir validación para todos los campos: telefono, email, etc.)
        ]);

        // 2. Actualización
        $persona->nombre = $request->nombre;
        $persona->apellido = $request->apellido;
        $persona->ci = $request->ci;
        $persona->rol = $request->rol;
        // ... (asigna el resto de los campos)
        
        // Manejo de la contraseña (solo si se proporciona)
        if ($request->filled('contrasena')) {
             $persona->contrasena = $request->contrasena; // Asignación de texto plano
        }
        
        $persona->save();

        // 3. Redirección con mensaje de éxito
        return redirect()->route('admin.personas.index')
                        ->with('success', "El registro de {$persona->nombre} fue actualizado correctamente.");
    }
    /**boton de añadir nueva persona*********************************** */
    public function create()
    {
        return view('admin.personas.create');
    }

    /**
     * Almacena una nueva persona en la base de datos.
     */
    public function store(Request $request)
    {
        // 1. Validación de Datos
        $request->validate([
            'nombre'     => 'required|string|max:50',
            'apellido'   => 'required|string|max:50',
            'telefono'   => 'nullable|string|max:15',
            'email'      => 'nullable|string|email|max:50|unique:personas',
            'contrasena' => 'required|string|min:4', // Usamos 'contrasena' aquí, no 'password'
            'ci'         => 'required|string|max:20|unique:personas',
            'sexo'       => 'required|string|max:1',
            'direccion'  => 'nullable|string|max:100',
            'rol'        => 'required|string|max:30',
        ]);

        // 2. Creación del Registro
        Persona::create([
            'nombre'     => $request->nombre,
            'apellido'   => $request->apellido,
            'telefono'   => $request->telefono,
            'email'      => $request->email,
            'contrasena' => $request->contrasena, // Se guarda como texto plano (temporalmente)
            'sexo'       => $request->sexo,
            'ci'         => $request->ci,
            'direccion'  => $request->direccion,
            'rol'        => $request->rol,
        ]);

        // 3. Redirección con mensaje de éxito
        return redirect()->route('admin.personas.index')
                        ->with('success', 'La nueva persona ha sido registrada correctamente.');
    }
}