<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TipoBeca;
use Illuminate\Http\Request;

/*buscar******************************* */
class TipoBecaController extends Controller
{
    public function index(Request $request)
    {
        // Obtener el parámetro de búsqueda
        $search = $request->get('search');
        
        // Iniciar la consulta
        $query = TipoBeca::query();
        
        // Aplicar filtro de búsqueda si existe
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('tipo_beca', 'LIKE', "%{$search}%")
                  ->orWhere('descripcion', 'LIKE', "%{$search}%")
                  ->orWhere('duracion', 'LIKE', "%{$search}%");
            });
        }
        
        // Ordenar por ID
        $query->orderBy('id_tipo', 'asc');
        
        // Paginar los resultados (15 por página)
        $tipoBecas = $query->paginate(15);
        
        // Pasar también el término de búsqueda para mantenerlo en la paginación
        if ($search) {
            $tipoBecas->appends(['search' => $search]);
        }
        
        return view('admin.tipobecas.index', compact('tipoBecas', 'search'));
    }
    /**crear********************************************************************* */
    public function create()
    {
        return view('admin.tipobecas.create');
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tipo_beca' => 'required|string|max:50|unique:tipo_beca',
            'duracion' => 'nullable|integer|min:1|max:120',
            'descripcion' => 'nullable|string|max:100'
        ]);
        
        TipoBeca::create($validated);
        
        return redirect()->route('admin.tipobecas.index')
            ->with('success', 'Tipo de beca creado correctamente.');
    }
    /**editar************************************************************** */
    public function edit(TipoBeca $tipobeca) // o $id si usas otro método
    {
        return view('admin.tipobecas.edit', compact('tipobeca'));
    }
    
    public function update(Request $request, TipoBeca $tipobeca)
    {
        $validated = $request->validate([
            'tipo_beca' => 'required|string|max:50|unique:tipo_beca,tipo_beca,' . $tipobeca->id_tipo . ',id_tipo',
            'duracion' => 'nullable|integer|min:1|max:120',
            'descripcion' => 'nullable|string|max:100'
        ]);
        
        $tipobeca->update($validated);
        
        return redirect()->route('admin.tipobecas.index')
            ->with('success', 'Tipo de beca actualizado correctamente.');
    }
    /**eliminar*************************************************************** */
    public function destroy(TipoBeca $tipobeca)
    {
        $tipobeca->delete();
        
        return redirect()->route('admin.tipobecas.index')
            ->with('success', 'Tipo de beca eliminado correctamente.');
    }
}