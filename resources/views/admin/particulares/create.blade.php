@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="card shadow">
        <div class="card-header bg-success text-white">
            <h4><i class="fas fa-user-friends me-2"></i> Registrar Persona como Particular</h4>
            <p class="mb-0">Solo se listan personas con el Rol "PARTICULAR".</p>
        </div>
        <div class="card-body">
            
            <form action="{{ route('admin.particulares.store') }}" method="POST">
                @csrf

                {{-- Campo Persona (ID_PERSONAL) --}}
                <div class="mb-3">
                    <label for="id_personal" class="form-label">Persona (con Rol PARTICULAR)</label>
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
                
                {{-- Campo Tipo Particular --}}
                <div class="mb-3">
                    <label for="tipo_particular" class="form-label">Tipo de Particular</label>
                    <input type="text" class="form-control @error('tipo_particular') is-invalid @enderror" id="tipo_particular" name="tipo_particular" value="{{ old('tipo_particular') }}" required>
                    @error('tipo_particular') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                
                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-success me-2"><i class="fas fa-save me-1"></i> Registrar Particular</button>
                    <a href="{{ route('admin.particulares.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
            
        </div>
    </div>
</div>
@endsection