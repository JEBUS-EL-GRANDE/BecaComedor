@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="card shadow">
        <div class="card-header bg-warning text-dark">
            <h4><i class="fas fa-user-edit me-2"></i> Editar Persona: {{ trim($persona->nombre) . ' ' . trim($persona->apellido) }}</h4>
        </div>
        <div class="card-body">
            
            {{-- El formulario usa el método POST, pero Blade lo simula como PUT/PATCH para el recurso --}}
            <form action="{{ route('admin.personas.update', $persona->id_personal) }}" method="POST">
                @csrf
                @method('PUT') {{-- Esto es crucial para el método update --}}

                <div class="row">
                    {{-- Campo Nombre --}}
                    <div class="col-md-6 mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        {{-- Usamos old() para mantener el valor en caso de error o el valor actual si no hay old() --}}
                        <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" value="{{ old('nombre', trim($persona->nombre)) }}" required>
                        @error('nombre') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- Campo Apellido --}}
                    <div class="col-md-6 mb-3">
                        <label for="apellido" class="form-label">Apellido</label>
                        <input type="text" class="form-control @error('apellido') is-invalid @enderror" id="apellido" name="apellido" value="{{ old('apellido', trim($persona->apellido)) }}" required>
                        @error('apellido') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                {{-- Campo CI --}}
                <div class="mb-3">
                    <label for="ci" class="form-label">Cédula de Identidad (CI)</label>
                    <input type="text" class="form-control @error('ci') is-invalid @enderror" id="ci" name="ci" value="{{ old('ci', trim($persona->ci)) }}" required>
                    @error('ci') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                
                {{-- Campo Contraseña (Opcional) --}}
                <div class="mb-3">
                    <label for="contrasena" class="form-label">Contraseña (Dejar vacío para no cambiar)</label>
                    <input type="password" class="form-control @error('contrasena') is-invalid @enderror" id="contrasena" name="contrasena">
                    @error('contrasena') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                
                {{-- Campo Rol --}}
                <div class="mb-3">
                    <label for="rol" class="form-label">Rol</label>
                    <select class="form-select @error('rol') is-invalid @enderror" id="rol" name="rol" required>
                        {{-- Opciones de rol (ajusta esta lista a los roles válidos en tu sistema) --}}
                        @php $currentRol = trim(old('rol', $persona->rol)); @endphp
                        <option value="ADMINISTRADOR" {{ $currentRol === 'ADMINISTRADOR' ? 'selected' : '' }}>ADMINISTRADOR</option>
                        <option value="ESTUDIANTE" {{ $currentRol === 'ESTUDIANTE' ? 'selected' : '' }}>ESTUDIANTE</option>
                        <option value="ENCARGADO" {{ $currentRol === 'ENCARGADO' ? 'selected' : '' }}>ENCARGADO</option>
                        <option value="PERSONAL COCINA" {{ $currentRol === 'PERSONAL COCINA' ? 'selected' : '' }}>PERSONAL COCINA</option>
                        {{-- ... otros roles ... --}}
                    </select>
                    @error('rol') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                
                {{-- Campo Sexo (ejemplo) --}}
                <div class="mb-3">
                    <label for="sexo" class="form-label">Sexo</label>
                    <select class="form-select @error('sexo') is-invalid @enderror" id="sexo" name="sexo" required>
                        @php $currentSexo = trim(old('sexo', $persona->sexo)); @endphp
                        <option value="M" {{ $currentSexo === 'M' ? 'selected' : '' }}>Masculino</option>
                        <option value="F" {{ $currentSexo === 'F' ? 'selected' : '' }}>Femenino</option>
                        <option value="O" {{ $currentSexo === 'O' ? 'selected' : '' }}>Otro</option>
                    </select>
                    @error('sexo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                
                {{-- Botones --}}
                <button type="submit" class="btn btn-warning me-2"><i class="fas fa-save me-1"></i> Guardar Cambios</button>
                <a href="{{ route('admin.personas.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
            
        </div>
    </div>
</div>
@endsection