@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="card shadow">
        <div class="card-header bg-success text-white">
            <h4><i class="fas fa-user-graduate me-2"></i> Registrar Nuevo Estudiante</h4>
            <p class="mb-0">Asegúrese de que la Persona ya exista con el Rol "ESTUDIANTE".</p>
        </div>
        <div class="card-body">
            
            <form action="{{ route('admin.estudiantes.store') }}" method="POST">
                @csrf

                {{-- Campo Persona (ID_PERSONAL) --}}
                <div class="mb-3">
                    <label for="id_personal" class="form-label">Persona (con Rol ESTUDIANTE)</label>
                    <select class="form-select @error('id_personal') is-invalid @enderror" id="id_personal" name="id_personal" required>
                        <option value="">Seleccione una Persona...</option>
                        @foreach ($personas as $persona)
                            <option value="{{ $persona->id_personal }}" {{ old('id_personal') == $persona->id_personal ? 'selected' : '' }}>
                                {{ trim($persona->nombre) . ' ' . trim($persona->apellido) }} (CI: {{ trim($persona->ci) }})
                            </option>
                        @endforeach
                    </select>
                    @error('id_personal') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                
                {{-- Campo Carrera (ID_CARRERA) --}}
                <div class="mb-3">
                    <label for="id_carrera" class="form-label">Carrera</label>
                    <select class="form-select @error('id_carrera') is-invalid @enderror" id="id_carrera" name="id_carrera" required>
                        <option value="">Seleccione una Carrera...</option>
                        @foreach ($carreras as $carrera)
                            <option value="{{ $carrera->id_carrera }}" {{ old('id_carrera') == $carrera->id_carrera ? 'selected' : '' }}>
                                {{ trim($carrera->nombre_carrera) }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_carrera') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{-- Campo Promedio --}}
                <div class="mb-3">
                    <label for="promedio_academico" class="form-label">Promedio Académico (Opcional)</label>
                    <input type="number" step="0.01" class="form-control @error('promedio_academico') is-invalid @enderror" id="promedio_academico" name="promedio_academico" value="{{ old('promedio_academico') }}">
                    @error('promedio_academico') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{-- Campo Situación Académica --}}
                <div class="mb-3">
                    <label for="situacion_academica" class="form-label">Situación Académica (Opcional)</label>
                    <input type="text" class="form-control @error('situacion_academica') is-invalid @enderror" id="situacion_academica" name="situacion_academica" value="{{ old('situacion_academica') }}">
                    @error('situacion_academica') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-success me-2"><i class="fas fa-save me-1"></i> Guardar Estudiante</button>
                    <a href="{{ route('admin.estudiantes.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
            
        </div>
    </div>
</div>
@endsection