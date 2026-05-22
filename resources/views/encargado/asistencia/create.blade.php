@extends('layouts.encargado')

@section('content')
<div class="container-fluid py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header text-white text-center" style="background-color: #ff9800;">
                    <h4 class="mb-0"><i class="fas fa-user-check me-2"></i>Registrar Control de Asistencia</h4>
                </div>
                <div class="card-body p-4" style="background-color: #f8f9fa;">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <form action="{{ route('encargado.asistencia.store') }}" method="POST">
                        @csrf
                        <!-- Fecha -->
                        <div class="mb-3">
                            <label for="fecha" class="form-label fw-semibold">Fecha *</label>
                            <input type="date" name="fecha" id="fecha" 
                                   class="form-control form-control-lg @error('fecha') is-invalid @enderror" 
                                   value="{{ old('fecha', now()->format('Y-m-d')) }}" required>
                            @error('fecha')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Estudiante -->
                        <div class="mb-3">
                            <label for="id_estudiante" class="form-label fw-semibold">Estudiante *</label>
                            <select name="id_estudiante" id="id_estudiante" 
                                    class="form-select form-select-lg @error('id_estudiante') is-invalid @enderror" required>
                                <option value="" disabled selected>Seleccionar estudiante...</option>
                                @foreach($estudiantes as $estudiante)
                                    <option value="{{ $estudiante->id_registro }}" 
                                        {{ old('id_estudiante') == $estudiante->id_registro ? 'selected' : '' }}>
                                        {{ trim($estudiante->persona->nombre . ' ' . $estudiante->persona->apellido) }}
                                        (CI: {{ $estudiante->persona->ci }})
                                    </option>
                                @endforeach
                            </select>
                            @error('id_estudiante')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Tipo de Servicio -->
                        <div class="mb-3">
                            <label for="tipo_servicio" class="form-label fw-semibold">Tipo de Servicio *</label>
                            <select name="tipo_servicio" id="tipo_servicio" 
                                    class="form-select form-select-lg @error('tipo_servicio') is-invalid @enderror" required>
                                <option value="" disabled selected>Seleccionar servicio...</option>
                                @foreach($servicios as $servicio)
                                    <option value="{{ $servicio->nombre_servicio }}"
                                        {{ old('tipo_servicio') == $servicio->nombre_servicio ? 'selected' : '' }}>
                                        {{ $servicio->nombre_servicio }}
                                    </option>
                                @endforeach
                            </select>
                            @error('tipo_servicio')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Observación -->
                        <div class="mb-4">
                            <label for="observacion" class="form-label fw-semibold">Observación (Opcional)</label>
                            <textarea name="observacion" id="observacion" rows="3" 
                                      class="form-control @error('observacion') is-invalid @enderror" 
                                      placeholder="Escribe una observación si es necesario...">{{ old('observacion') }}</textarea>
                            @error('observacion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Botones -->
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('encargado.asistencia.index') }}" class="btn btn-outline-secondary btn-lg">
                                <i class="fas fa-arrow-left me-2"></i>Cancelar
                            </a>
                            <button type="submit" class="btn btn-success btn-lg">
                                <i class="fas fa-save me-2"></i>Guardar Asistencia
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Estilo general del card */
    .card {
        border: none;
        border-radius: 1rem !important;
        overflow: hidden;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
    }

    /* Header del card */
    .card-header {
        background-color: #ff9800 !important;
        color: white;
        font-weight: 600;
        padding: 1rem 1.5rem;
        border-bottom: none;
    }

    /* Body del card */
    .card-body {
        padding: 2rem;
        background-color: #f8f9fa;
    }

    /* Estilo para los labels */
    .form-label {
        font-weight: 600;
        color: #495057;
        margin-bottom: 0.5rem;
    }

    /* Estilo para inputs, selects y textarea */
    .form-control, .form-select {
        border-radius: 0.5rem;
        border: 1px solid #ced4da;
        padding: 0.75rem 1rem;
        font-size: 1rem;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

    .form-control:focus, .form-select:focus {
        border-color: #ff9800;
        box-shadow: 0 0 0 0.25rem rgba(255, 152, 0, 0.25);
    }

    /* Estilo para el textarea */
    textarea.form-control {
        resize: vertical;
        min-height: 100px;
    }

    /* Botones */
    .btn {
        border-radius: 0.5rem;
        padding: 0.5rem 1.5rem;
        font-weight: 600;
        transition: all 0.2s ease-in-out;
    }

    .btn-outline-secondary {
        color: #6c757d;
        border-color: #6c757d;
    }

    .btn-success {
        background-color: #28a745;
        border-color: #28a745;
    }

    .btn-success:hover {
        background-color: #218838;
        border-color: #1e7e34;
    }

    /* Estilo para el contenedor de botones */
    .d-flex.justify-content-between {
        margin-top: 1.5rem;
    }
</style>
@endsection