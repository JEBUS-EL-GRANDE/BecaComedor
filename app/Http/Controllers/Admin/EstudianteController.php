<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Estudiante;
use App\Models\Persona;
use App\Models\Carrera;
use Illuminate\Http\Request;

class EstudianteController extends Controller
{
    /**botones
     * buscar****************************************************************
     */
    public function index(Request $request)
    {
        // Obtener el parámetro de búsqueda
        $search = $request->get('search');
        $carrera_id = $request->get('carrera_id');
        
        // Iniciar la consulta con relaciones
        $query = Estudiante::with(['persona', 'carrera']);
        
        // Aplicar filtro de búsqueda general si existe
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->whereHas('persona', function($q2) use ($search) {
                    $q2->where('nombre', 'LIKE', "%{$search}%")
                       ->orWhere('apellido', 'LIKE', "%{$search}%")
                       ->orWhere('ci', 'LIKE', "%{$search}%");
                })
                ->orWhereHas('carrera', function($q2) use ($search) {
                    $q2->where('nombre_carrera', 'LIKE', "%{$search}%");
                })
                ->orWhere('situacion_academica', 'LIKE', "%{$search}%")
                ->orWhere('id_registro', 'LIKE', "%{$search}%");
            });
        }
        
        // Aplicar filtro por carrera específica
        if ($carrera_id) {
            $query->where('id_carrera', $carrera_id);
        }
        
        // Ordenar por ID de registro
        $query->orderBy('id_registro', 'desc');
        
        // Paginar los resultados
        $estudiantes = $query->paginate(15);
        
        // Obtener todas las carreras para el select
        $carreras = Carrera::orderBy('nombre_carrera')->get();
        
        // Mantener parámetros en la paginación
        if ($search || $carrera_id) {
            $estudiantes->appends([
                'search' => $search,
                'carrera_id' => $carrera_id
            ]);
        }
        
        return view('admin.estudiantes.index', compact('estudiantes', 'carreras', 'search', 'carrera_id'));
    }

    /**
     *crear**************************************************************
     */
    public function create()
    {
        // Necesitamos listas de Personas con rol 'ESTUDIANTE' y todas las Carreras
        $personas = Persona::where('rol', 'ESTUDIANTE')->get();
        $carreras = Carrera::all();
        
        return view('admin.estudiantes.create', compact('personas', 'carreras'));
    }

    /**
     * Almacena un nuevo estudiante en la BD.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_personal'         => 'required|exists:personas,id_personal|unique:estudiante,id_personal', // Asegura que la persona existe y no es ya un estudiante
            'id_carrera'          => 'required|exists:carrera,id_carrera',
            'promedio_academico'  => 'nullable|numeric|max:100|min:0',
            'situacion_academica' => 'nullable|string|max:50',
        ]);

        Estudiante::create($request->all());

        return redirect()->route('admin.estudiantes.index')
                         ->with('success', 'Estudiante registrado correctamente.');
    }

    /**
     * Elimina ****************************************************
     */
    public function destroy(Estudiante $estudiante)
    {
        $nombreCompleto = $estudiante->persona->nombre . ' ' . $estudiante->persona->apellido;
        
        $estudiante->delete();

        return redirect()->route('admin.estudiantes.index')
                         ->with('success', "El estudiante {$nombreCompleto} ha sido eliminado.");
    }
    
    // Los métodos edit y update son similares y se implementarían aquí.
    /**
     * editar****************************************************************
     */
    public function edit(Estudiante $estudiante)
    {
        // Necesitamos la lista de carreras para el campo de selección
        $carreras = Carrera::all();
        
        // La persona asociada ya se carga automáticamente gracias a la inyección de dependencia
        // pero la precargamos para asegurar su acceso en la vista
        $estudiante->load('persona');

        return view('admin.estudiantes.edit', compact('estudiante', 'carreras'));
    }

    /**
     * Actualiza el registro de un estudiante en la base de datos.
     */
    public function update(Request $request, Estudiante $estudiante)
    {
        $request->validate([
            // La persona no se puede cambiar, pero actualizamos la carrera y otros campos
            'id_carrera'          => 'required|exists:carrera,id_carrera',
            'promedio_academico'  => 'nullable|numeric|max:100|min:0',
            'situacion_academica' => 'nullable|string|max:50',
        ]);
        
        $estudiante->update($request->all());

        return redirect()->route('admin.estudiantes.index')
                         ->with('success', 'El registro del estudiante ha sido actualizado.');
    }
}