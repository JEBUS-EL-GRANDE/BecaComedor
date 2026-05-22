<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Carrera; // Asegúrate de que este modelo exista
use Illuminate\Http\Request;

class CarreraController extends Controller
{
    /**
     * Muestra la lista de carreras.
     */
    public function index(Request $request)
    {
        // Obtener el parámetro de búsqueda
        $search = $request->get('search');
        
        // Iniciar la consulta
        $query = Carrera::query();
        
        // Aplicar filtro de búsqueda si existe
        if ($search) {
            $query->where('nombre_carrera', 'LIKE', "%{$search}%");
        }
        
        // Ordenar por ID (o por nombre si prefieres)
        $query->orderBy('id_carrera', 'asc');
        
        // Paginar los resultados (15 por página)
        $carreras = $query->paginate(15);
        
        // Pasar también el término de búsqueda para mantenerlo en la paginación
        if ($search) {
            $carreras->appends(['search' => $search]);
        }
        
        return view('admin.carreras.index', compact('carreras', 'search'));
    }

    /**
     * Muestra el formulario para crear una nueva carrera.
     */
    public function create()
    {
        return view('admin.carreras.create');
    }

    /**
     * Almacena una nueva carrera en la BD.
     */
    public function store(Request $request)
    {
        $request->validate([
            // La validación debe coincidir con tus campos de migración
            'nombre_carrera'        => 'required|string|max:50|unique:carrera',
            'duracion_semestres'    => 'required|integer|min:1', 
        ]);

        Carrera::create([
            'nombre_carrera' => $request->nombre_carrera,
            'duracion_semestres' => $request->duracion_semestres,
            // Agrega aquí otros campos si los tienes
        ]);

        return redirect()->route('admin.carreras.index')
                         ->with('success', 'Carrera creada exitosamente.');
    }

    /**
     * Muestra el formulario para editar una carrera.
     */
    public function edit(Carrera $carrera)
    {
        // Se asume que Eloquent encuentra la carrera por el ID gracias a la inyección de dependencia
        return view('admin.carreras.edit', compact('carrera'));
    }

    /**
     * Actualiza el registro de una carrera en la base de datos.
     */
    public function update(Request $request, Carrera $carrera)
    {
        // Validación, excluyendo la propia carrera del chequeo 'unique'
        $request->validate([
            'nombre_carrera'        => 'required|string|max:50|unique:carrera,nombre_carrera,' . $carrera->id_carrera . ',id_carrera',
            'duracion_semestres'    => 'required|integer|min:1',
        ]);

        $carrera->update([
            'nombre_carrera' => $request->nombre_carrera,
            'duracion_semestres' => $request->duracion_semestres,
        ]);

        return redirect()->route('admin.carreras.index')
                         ->with('success', "La carrera '{$carrera->nombre_carrera}' ha sido actualizada.");
    }

    /**
     * Elimina el registro de una carrera.
     */
    public function destroy(Carrera $carrera)
    {
        $nombre = trim($carrera->nombre_carrera);
        $carrera->delete();

        return redirect()->route('admin.carreras.index')
                         ->with('success', "La carrera '{$nombre}' ha sido eliminada.");
    }
}