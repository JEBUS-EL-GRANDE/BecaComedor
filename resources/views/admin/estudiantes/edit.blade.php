@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="card shadow">
        <div class="card-header bg-warning text-dark">
            <h4><i class="fas fa-user-edit me-2"></i> Editar Registro de Estudiante</h4>
            <p class="mb-0">Persona: <strong>{{ trim($estudiante->persona->nombre) . ' ' . trim($estudiante->persona->apellido) }}</strong> (CI: {{ trim($estudiante->persona->ci) }})</p>
        </div>
        <div class="card-body">
            
            <form action="{{ route('admin.estudiantes.update', $estudiante->id_registro) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Campo Carrera (ID_CARRERA) --}}
                <div class="mb-3">
                    <label for="id_carrera" class="form-label">Carrera</label>
                    <select class="form-select @error('id_carrera') is-invalid @enderror" id="id_carrera" name="id_carrera" required>
                        <option value="">Seleccione una Carrera...</option>
                        @foreach ($carreras as $carrera)
                            <option value="{{ $carrera->id_carrera }}" 
                                {{ old('id_carrera', $estudiante->id_carrera) == $carrera->id_carrera ? 'selected' : '' }}>
                                {{ trim($carrera->nombre_carrera) }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_carrera') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{-- Campo Promedio --}}
                <div class="mb-3">
                    <label for="promedio_academico" class="form-label">Promedio Académico (0-100)</label>
                    <input type="number" step="0.01" class="form-control @error('promedio_academico') is-invalid @enderror" id="promedio_academico" name="promedio_academico" 
                           value="{{ old('promedio_academico', $estudiante->promedio_academico) }}" min="0" max="100">
                    @error('promedio_academico') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{-- Campo Situación Académica --}}
                <div class="mb-3">
                    <label for="situacion_academica" class="form-label">Situación Académica</label>
                    <input type="text" class="form-control @error('situacion_academica') is-invalid @enderror" id="situacion_academica" name="situacion_academica" 
                           value="{{ old('situacion_academica', trim($estudiante->situacion_academica)) }}">
                    @error('situacion_academica') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-warning me-2"><i class="fas fa-save me-1"></i> Guardar Cambios</button>
                    <a href="{{ route('admin.estudiantes.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
            
        </div>
    </div>
</div>
@endsection