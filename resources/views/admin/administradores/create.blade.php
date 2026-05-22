@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="card shadow">
        <div class="card-header bg-success text-white">
            <h4><i class="fas fa-user-plus me-2"></i> Añadir Administrador</h4>
        </div>
        <div class="card-body">
            
            <form action="{{ route('admin.administradores.store') }}" method="POST">
                @csrf

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="id_personal" class="form-label">Persona *</label>
                        <select class="form-select @error('id_personal') is-invalid @enderror" 
                                id="id_personal" name="id_personal" required>
                            <option value="">Seleccionar Persona</option>
                            @foreach($personas as $persona)
                                <option value="{{ $persona->id_personal }}" 
                                    {{ old('id_personal') == $persona->id_personal ? 'selected' : '' }}>
                                    {{ $persona->ci }} - {{ $persona->nombre }} {{ $persona->apellido }}
                                    @if($persona->rol)
                                        ({{ $persona->rol }})
                                    @endif
                                </option>
                            @endforeach
                        </select>
                        @error('id_personal') 
                            <div class="invalid-feedback">{{ $message }}</div> 
                        @enderror
                        <small class="form-text text-muted">
                            Seleccione una persona que tenga rol "ADMINISTRADOR"
                        </small>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="fecha_inicio_rol" class="form-label">Fecha Inicio Rol *</label>
                        <input type="date" class="form-control @error('fecha_inicio_rol') is-invalid @enderror" 
                               id="fecha_inicio_rol" name="fecha_inicio_rol" 
                               value="{{ old('fecha_inicio_rol', date('Y-m-d')) }}" required>
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
                               value="{{ old('ultimo_acceso', date('Y-m-d')) }}">
                        @error('ultimo_acceso') 
                            <div class="invalid-feedback">{{ $message }}</div> 
                        @enderror
                        <small class="form-text text-muted">
                            Dejar en blanco para usar la fecha actual
                        </small>
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-success me-2">
                        <i class="fas fa-save me-1"></i> Guardar
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