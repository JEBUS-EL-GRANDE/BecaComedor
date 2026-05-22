@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="card shadow">
        <div class="card-header bg-warning text-dark">
            <h4><i class="fas fa-user-edit me-2"></i> Editar Registro de Particular</h4>
            <p class="mb-0">Persona: <strong>{{ trim($particular->persona->nombre) . ' ' . trim($particular->persona->apellido) }}</strong></p>
        </div>
        <div class="card-body">
            
            <form action="{{ route('admin.particulares.update', $particular->id_personal) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Campo Tipo Particular --}}
                <div class="mb-3">
                    <label for="tipo_particular" class="form-label">Tipo de Particular</label>
                    <input type="text" class="form-control @error('tipo_particular') is-invalid @enderror" id="tipo_particular" name="tipo_particular" 
                           value="{{ old('tipo_particular', trim($particular->tipo_particular)) }}" required>
                    @error('tipo_particular') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-warning me-2"><i class="fas fa-save me-1"></i> Guardar Cambios</button>
                    <a href="{{ route('admin.particulares.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
            
        </div>
    </div>
</div>
@endsection