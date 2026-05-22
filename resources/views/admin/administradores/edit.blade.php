@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="card shadow">
        <div class="card-header bg-warning text-dark">
            <h4>
                <i class="fas fa-user-edit me-2"></i> 
                Editar Administrador
            </h4>
        </div>
        <div class="card-body">
            
            <form action="{{ route('admin.administradores.update', $administrador->id_administrador) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Persona</label>
                        <input type="text" class="form-control" 
                               value="{{ $administrador->persona->ci ?? 'N/A' }} - {{ $administrador->persona->nombre ?? '' }} {{ $administrador->persona->apellido ?? '' }}"
                               readonly>
                        <small class="form-text text-muted">
                            No se puede cambiar la persona asignada
                        </small>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="fecha_inicio_rol" class="form-label">Fecha Inicio Rol *</label>
                        <input type="date" class="form-control @error('fecha_inicio_rol') is-invalid @enderror" 
                               id="fecha_inicio_rol" name="fecha_inicio_rol" 
                               value="{{ old('fecha_inicio_rol', $administrador->fecha_inicio_rol ? date('Y-m-d', strtotime($administrador->fecha_inicio_rol)) : date('Y-m-d')) }}" 
                               required>
                        @error('fecha_inicio_rol') 
                            <div class="invalid-feedback">{{ $message }}</div> 
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="ultimo_acceso" class="form-label">Último Acceso</label>
                        <input type="date" class="form-control @error('ultimo_acceso') is-invalid @enderror" 
                               id="ultimo_acceso" name="ultimo_acceso" 
                               value="{{ old('ultimo_acceso', $administrador->ultimo_acceso ? date('Y-m-d', strtotime($administrador->ultimo_acceso)) : date('Y-m-d')) }}">
                        @error('ultimo_acceso') 
                            <div class="invalid-feedback">{{ $message }}</div> 
                        @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-warning me-2">
                        <i class="fas fa-save me-1"></i> Guardar Cambios
                    </button>
                    <a href="{{ route('admin.administradores.index') }}" class="btn btn-secondary">
                        Cancelar
                    </a>
                </div>
            </form>
            
        </div>
    </div>
</div>
@endsection