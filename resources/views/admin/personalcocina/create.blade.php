@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="card shadow">
        <div class="card-header bg-success text-white">
            <h4><i class="fas fa-user-plus me-2"></i> Añadir Personal de Cocina</h4>
        </div>
        <div class="card-body">
            
            <form action="{{ route('admin.personalcocina.store') }}" method="POST">
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
                            Seleccione una persona que tenga rol "PERSONAL COCINA"
                        </small>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="especialidad" class="form-label">Especialidad</label>
                        <input type="text" class="form-control @error('especialidad') is-invalid @enderror" 
                               id="especialidad" name="especialidad" 
                               value="{{ old('especialidad') }}"
                               placeholder="Ej: Chef, Ayudante, Pastelero, etc.">
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
                               value="{{ old('horario_trabajo') }}"
                               placeholder="Ej: Lunes-Viernes 8:00-16:00">
                        @error('horario_trabajo') 
                            <div class="invalid-feedback">{{ $message }}</div> 
                        @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-success me-2">
                        <i class="fas fa-save me-1"></i> Guardar
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