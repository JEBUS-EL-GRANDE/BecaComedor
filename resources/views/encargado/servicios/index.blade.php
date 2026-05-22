@extends('layouts.encargado')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">
            <i class="fas fa-utensils me-2"></i>
            Tipos de Servicio
        </h2>

        <a href="{{ route('encargado.servicios.create') }}" class="btn btn-success">
            <i class="fas fa-plus me-2"></i> Crear Nuevo Servicio
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center">ID</th>
                            <th>Nombre del Servicio</th>
                            <th class="text-center">Hora Inicio</th>
                            <th class="text-center">Hora Fin</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($servicios as $servicio)
                        <tr>
                            <td class="text-center">
                                <span class="badge bg-secondary fs-6">
                                    {{ $servicio->id_tipo_servicio }}
                                </span>
                            </td>
                            <td>
                                <strong>{{ ucfirst($servicio->nombre_servicio) }}</strong>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-primary fs-6">
                                    {{ date('H:i', strtotime($servicio->hora_inicio)) }}
                                </span>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-warning text-dark fs-6">
                                    {{ date('H:i', strtotime($servicio->hora_fin)) }}
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('encargado.servicios.edit', $servicio->id_tipo_servicio) }}"
                                       class="btn btn-sm btn-outline-primary px-3"
                                       title="Editar">
                                        <i class="fas fa-edit me-1"></i> Editar
                                    </a>
                                    <form action="{{ route('encargado.servicios.destroy', $servicio->id_tipo_servicio) }}"
                                          method="POST"
                                          class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn btn-sm btn-outline-danger px-3"
                                                title="Eliminar"
                                                onclick="return confirm('¿Eliminar el servicio: {{ $servicio->nombre_servicio }}?');">
                                            <i class="fas fa-trash-alt me-1"></i> Eliminar
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
/* Estilo para la tabla */
.table {
    --bs-table-bg: #ffffff;
    --bs-table-striped-bg: #f8f9fa;
    --bs-table-hover-bg: #e9ecef;
}

/* Badges */
.badge {
    font-size: 0.85rem;
    padding: 0.4em 0.6em;
    border-radius: 0.35rem;
}

/* Botones */
.btn-sm {
    font-size: 0.85rem;
    padding: 0.45rem 0.8rem;
    border-radius: 0.35rem;
    min-width: 90px;
}

/* Ajustes para pantallas pequeñas */
@media (max-width: 768px) {
    .btn-sm {
        min-width: 70px;
        padding: 0.35rem 0.6rem;
        font-size: 0.8rem;
    }

    .btn-sm i {
        margin-right: 3px !important;
    }

    .gap-2 {
        gap: 0.5rem;
    }
}

/* Card */
.card {
    border-radius: 0.75rem;
    border: none;
}

/* Alineación de texto en celdas */
.align-middle td,
.align-middle th {
    vertical-align: middle;
}
</style>
@endsection
