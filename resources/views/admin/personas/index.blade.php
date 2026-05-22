@extends('layouts.admin') 

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Gestión de Personas</h4>
                    <a href="{{ route('admin.personas.create') }}" class="btn btn-light btn-sm">
                        <i class="fas fa-user-plus me-2"></i> Añadir Nueva Persona
                    </a>
                </div>

                <div class="card-body">
                    {{-- Mensajes de éxito o error --}}
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
                                    <th>Rol</th>
                                    <th>Teléfono</th>
                                    <th>Email</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($personas as $persona)
                                <tr>
                                    <td>{{ $persona->id_personal }}</td>
                                    <td>{{ trim($persona->nombre) . ' ' . trim($persona->apellido) }}</td>
                                    <td>{{ trim($persona->ci) }}</td>
                                    <td><span class="badge bg-info text-dark">{{ trim($persona->rol) }}</span></td>
                                    <td>{{ trim($persona->telefono) }}</td>
                                    <td>{{ trim($persona->email) }}</td>
                                    <td class="text-center">
                                        {{-- Botón Editar --}}
                                        <a href="{{ route('admin.personas.edit', $persona->id_personal) }}" class="btn btn-sm btn-warning me-1" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        
                                        {{-- Botón Eliminar (Formulario) --}}
                                        <form action="{{ route('admin.personas.destroy', $persona->id_personal) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de que quieres eliminar a {{ trim($persona->nombre) }}?');" title="Eliminar">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    {{-- Si usaras paginación: {{ $personas->links() }} --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection