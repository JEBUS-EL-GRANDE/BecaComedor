@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="card shadow">
        <div class="card-header bg-success text-white">
            <h4><i class="fas fa-user-plus me-2"></i> Añadir Nueva Persona</h4>
        </div>
        <div class="card-body">
            
            {{-- Formulario que llama al método store para guardar --}}
            <form action="{{ route('admin.personas.store') }}" method="POST">
                @csrf

                {{-- ERRORES DE VALIDACIÓN --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                {{-- Fila de Nombres y Apellidos --}}
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
                        @error('nombre') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="apellido" class="form-label">Apellido</label>
                        <input type="text" class="form-control @error('apellido') is-invalid @enderror" id="apellido" name="apellido" value="{{ old('apellido') }}" required>
                        @error('apellido') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                {{-- Fila de CI y Teléfono --}}
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="ci" class="form-label">Cédula de Identidad (CI)</label>
                        <input type="text" class="form-control @error('ci') is-invalid @enderror" id="ci" name="ci" value="{{ old('ci') }}" required>
                        @error('ci') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="telefono" class="form-label">Teléfono (Opcional)</label>
                        <input type="text" class="form-control @error('telefono') is-invalid @enderror" id="telefono" name="telefono" value="{{ old('telefono') }}">
                        @error('telefono') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                {{-- Fila de Email y Dirección --}}
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Email (Opcional)</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}">
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="direccion" class="form-label">Dirección (Opcional)</label>
                        <input type="text" class="form-control @error('direccion') is-invalid @enderror" id="direccion" name="direccion" value="{{ old('direccion') }}">
                        @error('direccion') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                {{-- Fila de Contraseña, Rol y Sexo --}}
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="contrasena" class="form-label">Contraseña</label>
                        <input type="password" class="form-control @error('contrasena') is-invalid @enderror" id="contrasena" name="contrasena" required>
                        @error('contrasena') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <label for="rol" class="form-label">Rol</label>
                        <select class="form-select @error('rol') is-invalid @enderror" id="rol" name="rol" required>
                            <option value="">Seleccione Rol</option>
                            {{-- Ajusta estos valores a los que uses en tu BD (ej: mayúsculas) --}}
                            <option value="ADMINISTRADOR" {{ old('rol') === 'ADMINISTRADOR' ? 'selected' : '' }}>ADMINISTRADOR</option>
                            <option value="ESTUDIANTE" {{ old('rol') === 'ESTUDIANTE' ? 'selected' : '' }}>ESTUDIANTE</option>
                            <option value="ENCARGADO" {{ old('rol') === 'ENCARGADO' ? 'selected' : '' }}>ENCARGADO</option>
                            <option value="PERSONAL COCINA" {{ old('rol') === 'PERSONAL COCINA' ? 'selected' : '' }}>PERSONAL COCINA</option>
                        </select>
                        @error('rol') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="sexo" class="form-label">Sexo</label>
                        <select class="form-select @error('sexo') is-invalid @enderror" id="sexo" name="sexo" required>
                            <option value="">Seleccione Sexo</option>
                            <option value="M" {{ old('sexo') === 'M' ? 'selected' : '' }}>Masculino</option>
                            <option value="F" {{ old('sexo') === 'F' ? 'selected' : '' }}>Femenino</option>
                            <option value="O" {{ old('sexo') === 'O' ? 'selected' : '' }}>Otro</option>
                        </select>
                        @error('sexo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-success me-2"><i class="fas fa-save me-1"></i> Guardar Persona</button>
                    <a href="{{ route('admin.personas.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
            
        </div>
    </div>
</div>
@endsection