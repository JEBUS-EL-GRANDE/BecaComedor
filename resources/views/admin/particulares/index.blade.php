@extends('layouts.admin') 

@section('content')
<div class="container-fluid py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Gestión de Registros Particulares</h4>
            <a href="{{ route('admin.particulares.create') }}" class="btn btn-light btn-sm">
                <i class="fas fa-plus me-2"></i> Asignar Particular
            </a>
        </div>

        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>ID Personal</th>
                            <th>Nombre Completo</th>
                            <th>CI</th>
                            <th>Tipo Particular</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($particulares as $particular)
                        <tr>
                            <td>{{ $particular->id_personal }}</td>
                            <td>{{ trim($particular->persona->nombre) . ' ' . trim($particular->persona->apellido) }}</td>
                            <td>{{ trim($particular->persona->ci) }}</td>
                            <td><span class="badge bg-info text-dark">{{ trim($particular->tipo_particular) }}</span></td>
                            <td class="text-center">
                                <a href="{{ route('admin.particulares.edit', $particular->id_personal) }}" class="btn btn-sm btn-warning me-1" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.particulares.destroy', $particular->id_personal) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar el registro de particular para {{ trim($particular->persona->nombre) }}?');" title="Eliminar">
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
@endsection