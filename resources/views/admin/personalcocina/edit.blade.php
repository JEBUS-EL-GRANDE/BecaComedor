@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="card shadow">
        <div class="card-header bg-warning text-dark">
            <h4>
                <i class="fas fa-user-edit me-2"></i> 
                Editar Personal de Cocina
            </h4>
        </div>
        <div class="card-body">
            
            <form action="{{ route('admin.personalcocina.update', $personalCocina->id_personal) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Persona</label>
                        <input type="text" class="form-control" 
                               value="{{ $personalCocina->persona->ci ?? 'N/A' }} - {{ $personalCocina->persona->nombre ?? '' }} {{ $personalCocina->persona->apellido ?? '' }}"
                               readonly>
                        <small class="form-text text-muted">
                            No se puede cambiar la persona asignada
                        </small>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="especialidad" class="form-label">Especialidad</label>
                        <input type="text" class="form-control @error('especialidad') is-invalid @enderror" 
                               id="especialidad" name="especialidad" 
                               value="{{ old('especialidad', $personalCocina->especialidad) }}"
                               placeholder="Ej: Chef, Ayudante, Pastelero">
                        @error('especialidad') 
                            <div class="invalid-feedback">{{ $message }}</div> 
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="horario_trabajo" class="form-label">Horario de Trabajo</label>
                        <input type="text" class="form-control @error('horario_trabajo') is-invalid @enderror" 
                               id="horario_trabajo" name="horario_trabajo" 
                               value="{{ old('horario_trabajo', $personalCocina->horario_trabajo) }}"
                               placeholder="Ej: Lunes-Viernes 8:00-16:00">
                        @error('horario_trabajo') 
                            <div class="invalid-feedback">{{ $message }}</div> 
                        @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-warning me-2">
                        <i class="fas fa-save me-1"></i> Guardar Cambios
                    </button>
                    <a href="{{ route('admin.personalcocina.index') }}" class="btn btn-secondary">
                        Cancelar
                    </a>
                </div>
            </form>
            
        </div>
    </div>
</div>
@endsection