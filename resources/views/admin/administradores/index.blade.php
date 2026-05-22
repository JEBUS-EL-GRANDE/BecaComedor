@extends('layouts.admin') 

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Gestión de Administradores</h4>
                    <a href="{{ route('admin.administradores.create') }}" class="btn btn-light btn-sm">
                        <i class="fas fa-user-plus me-2"></i> Añadir Administrador
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
                                    <th>ID Admin</th>
                                    <th>Nombre Completo</th>
                                    <th>CI</th>
                                    <th>Fecha Inicio Rol</th>
                                    <th>Último Acceso</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($administradores as $admin)
                                <tr>
                                    <td>{{ $admin->id_administrador }}</td>
                                    <td>
                                        {{ $admin->persona->nombre ?? 'N/A' }} 
                                        {{ $admin->persona->apellido ?? '' }}
                                    </td>
                                    <td>{{ $admin->persona->ci ?? 'N/A' }}</td>
                                    <td>{{ $admin->fecha_inicio_rol ? date('d/m/Y', strtotime($admin->fecha_inicio_rol)) : 'N/A' }}</td>
                                    <td>{{ $admin->ultimo_acceso ? date('d/m/Y', strtotime($admin->ultimo_acceso)) : 'N/A' }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.administradores.edit', $admin->id_administrador) }}" 
                                           class="btn btn-sm btn-warning me-1" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        
                                        <form action="{{ route('admin.administradores.destroy', $admin->id_administrador) }}" 
                                              method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" 
                                                    onclick="return confirm('¿Eliminar este administrador?');" 
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