@extends('layouts.encargado')

@section('content')
<div class="container-fluid py-4">
    <h2 class="mb-4">Historial de Control de Asistencia</h2>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="{{ route('encargado.asistencia.create') }}" class="btn-registrar-asistencia">
            <i class="fas fa-plus-circle me-2"></i> Registrar Asistencia
        </a>

        <div class="col-md-4">
            <div class="input-group">
                <input type="text" id="buscarNombre" class="form-control" placeholder="Buscar por nombre...">
                <button class="btn" type="button" id="btnBuscar">
                    <i class="fas fa-search me-2"></i> Buscar
                </button>
            </div>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="table-responsive rounded shadow-sm">
        <table class="table table-hover" style="table-layout: fixed;">
            <thead class="table-primary">
                <tr>
                    <th class="px-4">Fecha</th>
                    <th class="px-4">CI Estudiante</th>
                    <th class="px-4">Nombre Completo</th>
                    <th class="px-4">Servicio Tomado</th>
                    <th class="px-4">Observación</th>
                    <!--<th class="px-4 text-center">Acciones</th>-->
                </tr>
            </thead>
            <tbody id="tablaAsistencias">
                @foreach ($asistencias as $asistencia)
                <tr class="align-middle">
                    <td class="px-4">{{ $asistencia->fecha->format('Y-m-d') }}</td>
                    <td class="px-4">{{ trim($asistencia->estudiante->persona->ci ?? 'N/A') }}</td>
                    <td class="px-4 nombre-estudiante">
                        {{ trim($asistencia->estudiante->persona->nombre ?? 'N/A') . ' ' . trim($asistencia->estudiante->persona->apellido ?? '') }}
                    </td>
                    <td class="px-4">
                        <span class="badge bg-info text-dark">{{ $asistencia->tipo_servicio }}</span>
                    </td>
                    <td class="px-4">{{ trim($asistencia->observacion) }}</td>
                    <td class="px-4 text-center">
                        <form action="{{ route('encargado.asistencia.destroy', $asistencia) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <!--<button type="submit" class="btn btn-danger btn-sm px-3" onclick="return confirm('¿Eliminar registro de asistencia para {{ trim($asistencia->estudiante->persona->nombre ?? '') }}?');">
                                <i class="fas fa-trash-alt me-1"></i> Eliminar
                            </button>-->
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center mt-4">
            {{ $asistencias->links() }}
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const buscarInput = document.getElementById('buscarNombre');
    const btnBuscar = document.getElementById('btnBuscar');
    const filas = document.querySelectorAll('#tablaAsistencias tr');

    function buscarPorNombre() {
        const texto = buscarInput.value.toLowerCase().trim();

        filas.forEach(fila => {
            const nombreCelda = fila.querySelector('.nombre-estudiante');
            if (nombreCelda) {
                const nombre = nombreCelda.textContent.toLowerCase();
                fila.style.display = nombre.includes(texto) ? '' : 'none';
            }
        });
    }

    btnBuscar.addEventListener('click', buscarPorNombre);

    buscarInput.addEventListener('keyup', function(event) {
        if (event.key === 'Enter') {
            buscarPorNombre();
        }
    });
});
</script>

<style>
    /* Estilo para el enlace "Registrar Nueva Asistencia" */
    .btn-registrar-asistencia {
        background-color: #dc3545;
        color: white;
        padding: 12px 24px;
        border-radius: 5px;
        text-decoration: none;
        font-weight: 500;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        transition: background-color 0.3s, transform 0.2s;
    }

    .btn-registrar-asistencia:hover {
        background-color: #bb2d3b;
        transform: translateY(-2px);
    }

    .btn-registrar-asistencia i {
        margin-right: 8px;
    }

    /* Estilo para el botón de búsqueda */
    #btnBuscar {
        background-color: #0d6efd;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 0 5px 5px 0;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s, transform 0.2s;
    }

    #btnBuscar:hover {
        background-color: #0b5ed7;
        transform: translateY(-1px);
    }

    #buscarNombre {
        padding: 10px 15px;
        border: 1px solid #ced4da;
        border-radius: 5px 0 0 5px;
        font-size: 16px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        border-right: none;
    }

    .input-group {
        display: flex;
        width: 100%;
        max-width: 400px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        border-radius: 5px;
        overflow: hidden;
    }

    /* Estilos para la tabla */
    .table td, .table th {
        padding: 1rem;
        vertical-align: middle;
    }

    .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
        transition: all 0.3s;
    }

    .btn-danger:hover {
        background-color: #bb2d3b;
        transform: scale(1.05);
    }

    .table {
        border-collapse: separate;
        border-spacing: 0;
    }

    .table-hover tbody tr:hover {
        background-color: rgba(0, 123, 255, 0.05);
    }

    .badge {
        padding: 0.5em 0.8em;
        font-size: 0.85em;
    }
</style>
@endsection
