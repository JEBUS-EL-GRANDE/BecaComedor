@extends('layouts.admin') 

@section('content')
<div class="container-fluid py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Gestión de Estudiantes</h4>
            <a href="{{ route('admin.estudiantes.create') }}" class="btn btn-light btn-sm">
                <i class="fas fa-user-graduate me-2"></i> Registrar Estudiante
            </a>
        </div>

        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- BARRA DE BÚSQUEDA Y FILTROS --}}
            <div class="row mb-4">
                <div class="col-md-12">
                    <form action="{{ route('admin.estudiantes.index') }}" method="GET" class="row g-3">
                        {{-- Búsqueda general --}}
                        <div class="col-md-5">
                            <div class="input-group">
                                <input type="text" 
                                       name="search" 
                                       class="form-control" 
                                       placeholder="Buscar por nombre, CI, carrera o situación..." 
                                       value="{{ request('search') }}"
                                       aria-label="Buscar">
                                <button class="btn btn-outline-primary" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                        
                        {{-- Filtro por carrera --}}
                        <div class="col-md-4">
                            <select name="carrera_id" class="form-select" onchange="this.form.submit()">
                                <option value="">Todas las carreras</option>
                                @foreach($carreras as $carrera)
                                    <option value="{{ $carrera->id_carrera }}" 
                                            {{ request('carrera_id') == $carrera->id_carrera ? 'selected' : '' }}>
                                        {{ $carrera->nombre_carrera }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        {{-- Botones de acción --}}
                        <div class="col-md-3">
                            <div class="d-flex gap-2">
                                @if(request('search') || request('carrera_id'))
                                    <a href="{{ route('admin.estudiantes.index') }}" class="btn btn-outline-secondary flex-grow-1">
                                        <i class="fas fa-times"></i> Limpiar
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
                
                {{-- Información de filtros aplicados --}}
                <div class="col-md-12 mt-3">
                    @if(request('search') || request('carrera_id'))
                        <div class="alert alert-info py-2 mb-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <i class="fas fa-filter me-2"></i>
                                    <strong>Filtros aplicados:</strong>
                                    @if(request('search'))
                                        <span class="badge bg-primary ms-2">Búsqueda: "{{ request('search') }}"</span>
                                    @endif
                                    @if(request('carrera_id'))
                                        @php
                                            $carreraSeleccionada = $carreras->firstWhere('id_carrera', request('carrera_id'));
                                        @endphp
                                        @if($carreraSeleccionada)
                                            <span class="badge bg-success ms-2">Carrera: {{ $carreraSeleccionada->nombre_carrera }}</span>
                                        @endif
                                    @endif
                                </div>
                                @if($estudiantes->total() > 0)
                                    <span class="badge bg-dark">
                                        {{ $estudiantes->total() }} estudiante(s) encontrado(s)
                                    </span>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="table-responsive">
                @if($estudiantes->count() > 0)
                    <table class="table table-hover table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>Reg. ID</th>
                                <th>Nombre Completo</th>
                                <th>CI</th>
                                <th>Carrera</th>
                                <th>Promedio</th>
                                <th>Situación</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($estudiantes as $estudiante)
                            <tr>
                                <td>
                                    <span class="badge bg-secondary">{{ $estudiante->id_registro }}</span>
                                </td>
                                <td>
                                    <strong>{{ trim($estudiante->persona->nombre) . ' ' . trim($estudiante->persona->apellido) }}</strong>
                                </td>
                                <td>{{ trim($estudiante->persona->ci) }}</td>
                                <td>
                                    <span class="badge bg-info">{{ trim($estudiante->carrera->nombre_carrera) }}</span>
                                </td>
                                <td>
                                    @if($estudiante->promedio_academico)
                                        <span class="badge 
                                            {{ $estudiante->promedio_academico >= 90 ? 'bg-success' : 
                                               ($estudiante->promedio_academico >= 70 ? 'bg-warning text-dark' : 'bg-danger') }}">
                                            {{ number_format($estudiante->promedio_academico, 2) }}
                                        </span>
                                    @else
                                        <span class="badge bg-secondary">N/A</span>
                                    @endif
                                </td>
                                <td>
                                    @php
                                        $situacion = $estudiante->situacion_academica ?? 'Normal';
                                        $badgeClass = match(strtolower($situacion)) {
                                            'normal', 'regular' => 'bg-success',
                                            'en riesgo', 'bajo rendimiento' => 'bg-warning text-dark',
                                            'suspendido', 'expulsado' => 'bg-danger',
                                            default => 'bg-info'
                                        };
                                    @endphp
                                    <span class="badge {{ $badgeClass }}">{{ $situacion }}</span>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('admin.estudiantes.edit', $estudiante->id_registro) }}" 
                                       class="btn btn-sm btn-warning me-1" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.estudiantes.destroy', $estudiante->id_registro) }}" 
                                          method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" 
                                                onclick="return confirm('¿Eliminar al estudiante {{ trim($estudiante->persona->nombre) }}?');" 
                                                title="Eliminar">
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
                        <i class="fas fa-user-graduate me-2"></i>
                        @if(request('search') || request('carrera_id'))
                            No se encontraron estudiantes con los filtros aplicados.
                        @else
                            No hay estudiantes registrados.
                            <a href="{{ route('admin.estudiantes.create') }}" class="alert-link ms-1">
                                ¡Registra el primero!
                            </a>
                        @endif
                    </div>
                @endif
            </div>

            {{-- PAGINACIÓN --}}
            @if($estudiantes->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $estudiantes->withQueryString()->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Función para limpiar solo un filtro
    function clearFilter(type) {
        const url = new URL(window.location.href);
        url.searchParams.delete(type);
        window.location.href = url.toString();
    }
</script>
@endpush
@endsection