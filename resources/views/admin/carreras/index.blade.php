@extends('layouts.admin') 

@section('content')
<div class="container-fluid py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Gestión de Carreras</h4>
            <a href="{{ route('admin.carreras.create') }}" class="btn btn-light btn-sm">
                <i class="fas fa-plus me-2"></i> Añadir Nueva Carrera
            </a>
        </div>

        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            {{-- BARRA DE BÚSQUEDA --}}
            <div class="row mb-4">
                <div class="col-md-6">
                    <form action="{{ route('admin.carreras.index') }}" method="GET" class="d-flex">
                        <div class="input-group">
                            <input type="text" 
                                   name="search" 
                                   class="form-control" 
                                   placeholder="Buscar carrera por nombre..." 
                                   value="{{ request('search') }}"
                                   aria-label="Buscar">
                            <button class="btn btn-outline-primary" type="submit">
                                <i class="fas fa-search"></i> Buscar
                            </button>
                            @if(request('search'))
                                <a href="{{ route('admin.carreras.index') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-times"></i> Limpiar
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
                <div class="col-md-6 text-end">
                    @if(request('search'))
                        <div class="alert alert-info mb-0 py-2">
                            <i class="fas fa-info-circle me-1"></i>
                            Resultados de búsqueda para: "<strong>{{ request('search') }}</strong>"
                            @if($carreras->total() > 0)
                                <span class="badge bg-primary ms-2">{{ $carreras->total() }} encontradas</span>
                            @endif
                        </div>
                    @endif
                </div>
            </div>

            <div class="table-responsive">
                @if($carreras->count() > 0)
                    <table class="table table-hover table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Nombre de la Carrera</th>
                                <th>Duración (Semestres)</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($carreras as $carrera)
                            <tr>
                                <td>{{ $carrera->id_carrera }}</td>
                                <td>{{ trim($carrera->nombre_carrera) }}</td>
                                <td>{{ $carrera->duracion_semestres }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.carreras.edit', $carrera->id_carrera) }}" class="btn btn-sm btn-warning me-1" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.carreras.destroy', $carrera->id_carrera) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar la carrera {{ trim($carrera->nombre_carrera) }}?');" title="Eliminar">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="alert alert-warning text-center">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        @if(request('search'))
                            No se encontraron carreras con el término: "<strong>{{ request('search') }}</strong>"
                        @else
                            No hay carreras registradas.
                        @endif
                    </div>
                @endif
            </div>

            {{-- PAGINACIÓN --}}
            @if($carreras->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $carreras->withQueryString()->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection