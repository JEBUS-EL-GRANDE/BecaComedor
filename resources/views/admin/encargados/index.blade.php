@extends('layouts.admin') 

@section('content')
<div class="container-fluid py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Gestión de Encargados</h4>
            <a href="{{ route('admin.encargados.create') }}" class="btn btn-light btn-sm">
                <i class="fas fa-briefcase me-2"></i> Asignar Encargado
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
                            <th>ID</th>
                            <th>Nombre Completo</th>
                            <th>CI</th>
                            <th>Cargo</th>
                            <th>Turno</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($encargados as $encargado)
                        <tr>
                            <td>{{ $encargado->id_encargado }}</td>
                            {{-- Accedemos a los datos de la persona gracias a la relación --}}
                            <td>{{ trim($encargado->persona->nombre) . ' ' . trim($encargado->persona->apellido) }}</td>
                            <td>{{ trim($encargado->persona->ci) }}</td>
                            <td><span class="badge bg-success">{{ trim($encargado->cargo) }}</span></td>
                            <td>{{ trim($encargado->turno) }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.encargados.edit', $encargado->id_encargado) }}" class="btn btn-sm btn-warning me-1" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.encargados.destroy', $encargado->id_encargado) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar el registro de {{ trim($encargado->persona->nombre) }} como Encargado?');" title="Eliminar">
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