@extends('layouts.admin') 

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Gestión de Tipos de Beca</h4>
                    <a href="{{ route('admin.tipobecas.create') }}" class="btn btn-light btn-sm">
                        <i class="fas fa-plus me-2"></i> Añadir Tipo de Beca
                    </a>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    {{-- BARRA DE BÚSQUEDA --}}
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <form action="{{ route('admin.tipobecas.index') }}" method="GET" class="d-flex">
                                <div class="input-group">
                                    <input type="text" 
                                           name="search" 
                                           class="form-control" 
                                           placeholder="Buscar por tipo, descripción o duración..." 
                                           value="{{ request('search') }}"
                                           aria-label="Buscar">
                                    <button class="btn btn-outline-primary" type="submit">
                                        <i class="fas fa-search"></i> Buscar
                                    </button>
                                    @if(request('search'))
                                        <a href="{{ route('admin.tipobecas.index') }}" class="btn btn-outline-secondary">
                                            <i class="fas fa-times"></i> Limpiar
                                        </a>
                                    @endif
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6 text-end">
                            @if(request('search'))
                                <div class="alert alert-info mb-0 py-2 d-inline-flex align-items-center">
                                    <i class="fas fa-info-circle me-2"></i>
                                    <div>
                                        Resultados para: "<strong>{{ request('search') }}</strong>"
                                        @if($tipoBecas->total() > 0)
                                            <span class="badge bg-primary ms-2">{{ $tipoBecas->total() }} encontrados</span>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="table-responsive">
                        @if($tipoBecas->count() > 0)
                            <table class="table table-hover table-striped">
                                <thead class="table-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Tipo de Beca</th>
                                        <th>Duración (meses)</th>
                                        <th>Descripción</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tipoBecas as $beca)
                                    <tr>
                                        <td>{{ $beca->id_tipo }}</td>
                                        <td>
                                            <span class="badge bg-info">{{ $beca->tipo_beca }}</span>
                                        </td>
                                        <td>
                                            @if($beca->duracion)
                                                <span class="badge bg-secondary">{{ $beca->duracion }} meses</span>
                                            @else
                                                <span class="badge bg-warning text-dark">N/A</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($beca->descripcion)
                                                <small>{{ Str::limit($beca->descripcion, 80) }}</small>
                                            @else
                                                <span class="text-muted">Sin descripción</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.tipobecas.edit', $beca->id_tipo) }}" 
                                               class="btn btn-sm btn-warning me-1" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            
                                            <form action="{{ route('admin.tipobecas.destroy', $beca->id_tipo) }}" 
                                                  method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" 
                                                        onclick="return confirm('¿Eliminar este tipo de beca?');" 
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
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                @if(request('search'))
                                    No se encontraron tipos de beca con el término: "<strong>{{ request('search') }}</strong>"
                                @else
                                    No hay tipos de beca registrados.
                                    <a href="{{ route('admin.tipobecas.create') }}" class="alert-link ms-1">
                                        ¡Crea el primero!
                                    </a>
                                @endif
                            </div>
                        @endif
                    </div>

                    {{-- PAGINACIÓN --}}
                    @if($tipoBecas->hasPages())
                        <div class="d-flex justify-content-center mt-4">
                            {{ $tipoBecas->withQueryString()->links('pagination::bootstrap-5') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection