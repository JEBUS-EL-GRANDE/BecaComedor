@extends('layouts.admin') 

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Gestión de Personal de Cocina</h4>
                    <a href="{{ route('admin.personalcocina.create') }}" class="btn btn-light btn-sm">
                        <i class="fas fa-user-plus me-2"></i> Añadir Personal
                    </a>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre Completo</th>
                                    <th>CI</th>
                                    <th>Especialidad</th>
                                    <th>Horario Trabajo</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($personalCocina as $personal)
                                <tr>
                                    <td>{{ $personal->id_personal }}</td>
                                    <td>
                                        {{ $personal->persona->nombre ?? 'N/A' }} 
                                        {{ $personal->persona->apellido ?? '' }}
                                    </td>
                                    <td>{{ $personal->persona->ci ?? 'N/A' }}</td>
                                    <td>
                                        <span class="badge bg-info">{{ $personal->especialidad ?? 'Sin especialidad' }}</span>
                                    </td>
                                    <td>{{ $personal->horario_trabajo ?? 'No asignado' }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.personalcocina.edit', $personal->id_personal) }}" 
                                           class="btn btn-sm btn-warning me-1" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        
                                        <form action="{{ route('admin.personalcocina.destroy', $personal->id_personal) }}" 
                                              method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" 
                                                    onclick="return confirm('¿Eliminar este personal de cocina?');" 
                                                    title="Eliminar">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection