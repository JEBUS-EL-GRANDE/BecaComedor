@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="card shadow">
        <div class="card-header bg-success text-white">
            <h4><i class="fas fa-graduation-cap me-2"></i> Añadir Nueva Carrera</h4>
        </div>
        <div class="card-body">
            
            <form action="{{ route('admin.carreras.store') }}" method="POST">
                @csrf

                {{-- Campo Nombre de la Carrera --}}
                <div class="mb-3">
                    <label for="nombre_carrera" class="form-label">Nombre de la Carrera</label>
                    <input type="text" class="form-control @error('nombre_carrera') is-invalid @enderror" id="nombre_carrera" name="nombre_carrera" value="{{ old('nombre_carrera') }}" required>
                    @error('nombre_carrera') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                
                {{-- Campo Duración (Semestres) --}}
                <div class="mb-3">
                    <label for="duracion_semestres" class="form-label">Duración (Número de Semestres)</label>
                    <input type="number" class="form-control @error('duracion_semestres') is-invalid @enderror" id="duracion_semestres" name="duracion_semestres" value="{{ old('duracion_semestres') }}" required min="1" max="20">
                    @error('duracion_semestres') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-success me-2"><i class="fas fa-save me-1"></i> Guardar Carrera</button>
                    <a href="{{ route('admin.carreras.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
            
        </div>
    </div>
</div>
@endsection