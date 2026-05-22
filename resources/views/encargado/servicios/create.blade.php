@extends('layouts.encargado')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-warning text-white d-flex align-items-center">
            <i class="fas fa-user-edit me-2"></i>
            <h4 class="mb-0">Crear Nuevo Tipo de Servicio</h4>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('encargado.servicios.store') }}" method="POST">
                @csrf

                <div class="row g-3">
                    <div class="col-md-6 mb-3">
                        <label for="nombre_servicio" class="form-label fw-semibold">Nombre del Servicio *</label>
                        <input type="text"
                               class="form-control form-control-lg @error('nombre_servicio') is-invalid @enderror"
                               id="nombre_servicio"
                               name="nombre_servicio"
                               value="{{ old('nombre_servicio') }}"
                               placeholder="Ej: Desayuno, Almuerzo, Merienda, Cena"
                               required>
                        @error('nombre_servicio')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="hora_inicio" class="form-label fw-semibold">Hora de Inicio *</label>
                        <input type="time"
                               class="form-control form-control-lg @error('hora_inicio') is-invalid @enderror"
                               id="hora_inicio"
                               name="hora_inicio"
                               value="{{ old('hora_inicio') }}"
                               required>
                        @error('hora_inicio')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="hora_fin" class="form-label fw-semibold">Hora de Fin *</label>
                        <input type="time"
                               class="form-control form-control-lg @error('hora_fin') is-invalid @enderror"
                               id="hora_fin"
                               name="hora_fin"
                               value="{{ old('hora_fin') }}"
                               required>
                        @error('hora_fin')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <small class="text-muted">
                        <i class="fas fa-info-circle me-1"></i>
                        Asegúrate de que la hora de fin sea posterior a la hora de inicio.
                    </small>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('encargado.servicios.index') }}" class="btn btn-secondary btn-lg px-4">
                        <i class="fas fa-times me-1"></i> Cancelar
                    </a>
                    <button type="submit" class="btn btn-warning btn-lg px-4 text-white">
                        <i class="fas fa-save me-1"></i> Guardar Cambios
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
/* Estilo del card */
.card {
    border-radius: 0.75rem;
    overflow: hidden;
}

/* Header del card */
.card-header {
    background-color: #ffc107 !important;
    padding: 1rem 1.5rem;
    border-bottom: none;
}

/* Body del card */
.card-body {
    background-color: #f8f9fa;
}

/* Estilo para los labels */
.form-label {
    color: #495057;
}

/* Estilo para inputs */
.form-control {
    border-radius: 0.375rem;
    border: 1px solid #ced4da;
    padding: 0.65rem 1rem;
    font-size: 1rem;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.form-control:focus {
    border-color: #ffc107;
    box-shadow: 0 0 0 0.25rem rgba(255, 193, 7, 0.25);
}

/* Botones */
.btn {
    border-radius: 0.375rem;
    font-weight: 600;
    transition: all 0.2s ease-in-out;
}

.btn-lg {
    padding: 0.6rem 1.5rem;
    font-size: 1rem;
}

/* Ajustes para pantallas pequeñas */
@media (max-width: 768px) {
    .btn-lg {
        padding: 0.5rem 1rem;
        font-size: 0.9rem;
    }

    .gap-2 {
        gap: 0.75rem !important;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const horaInicio = document.getElementById('hora_inicio');
    const horaFin = document.getElementById('hora_fin');

    horaInicio.addEventListener('change', function() {
        if (horaFin.value && horaInicio.value >= horaFin.value) {
            horaFin.setCustomValidity('La hora de fin debe ser posterior a la hora de inicio');
        } else {
            horaFin.setCustomValidity('');
        }
    });

    horaFin.addEventListener('change', function() {
        if (horaInicio.value && horaInicio.value >= horaFin.value) {
            horaFin.setCustomValidity('La hora de fin debe ser posterior a la hora de inicio');
        } else {
            horaFin.setCustomValidity('');
        }
    });
});
</script>
@endsection
