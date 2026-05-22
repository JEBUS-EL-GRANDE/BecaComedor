@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="card shadow">
        <div class="card-header bg-success text-white">
            <h4><i class="fas fa-briefcase me-2"></i> Asignar una Persona como Encargado</h4>
            <p class="mb-0">Solo se listan personas con el Rol "ENCARGADO".</p>
        </div>
        <div class="card-body">
            
            <form action="{{ route('admin.encargados.store') }}" method="POST">
                @csrf

                {{-- Campo Persona (ID_PERSONAL) --}}
                <div class="mb-3">
                    <label for="id_personal" class="form-label">Persona (con Rol ENCARGADO)</label>
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
                
                {{-- Campo Cargo --}}
                <div class="mb-3">
                    <label for="cargo" class="form-label">Cargo</label>
                    <input type="text" class="form-control @error('cargo') is-invalid @enderror" id="cargo" name="cargo" value="{{ old('cargo') }}" required>
                    @error('cargo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                
                {{-- Campo Turno --}}
                <div class="mb-3">
                    <label for="turno" class="form-label">Turno</label>
                    <select class="form-select @error('turno') is-invalid @enderror" id="turno" name="turno" required>
                        <option value="">Seleccione Turno</option>
                        <option value="MAÑANA" {{ old('turno') === 'MAÑANA' ? 'selected' : '' }}>Mañana</option>
                        <option value="TARDE" {{ old('turno') === 'TARDE' ? 'selected' : '' }}>Tarde</option>
                        <option value="NOCHE" {{ old('turno') === 'NOCHE' ? 'selected' : '' }}>Noche</option>
                    </select>
                    @error('turno') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-success me-2"><i class="fas fa-save me-1"></i> Registrar Encargado</button>
                    <a href="{{ route('admin.encargados.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
            
        </div>
    </div>
</div>
@endsection