@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="card shadow">
        <div class="card-header bg-warning text-dark">
            <h4><i class="fas fa-user-edit me-2"></i> Editar Registro de Encargado</h4>
            <p class="mb-0">Persona: <strong>{{ trim($encargado->persona->nombre) . ' ' . trim($encargado->persona->apellido) }}</strong></p>
        </div>
        <div class="card-body">
            
            <form action="{{ route('admin.encargados.update', $encargado->id_encargado) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Campo Cargo --}}
                <div class="mb-3">
                    <label for="cargo" class="form-label">Cargo</label>
                    <input type="text" class="form-control @error('cargo') is-invalid @enderror" id="cargo" name="cargo" value="{{ old('cargo', trim($encargado->cargo)) }}" required>
                    @error('cargo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                
                {{-- Campo Turno --}}
                <div class="mb-3">
                    <label for="turno" class="form-label">Turno</label>
                    <select class="form-select @error('turno') is-invalid @enderror" id="turno" name="turno" required>
                        @php $currentTurno = old('turno', trim($encargado->turno)); @endphp
                        <option value="MAÑANA" {{ $currentTurno === 'MAÑANA' ? 'selected' : '' }}>Mañana</option>
                        <option value="TARDE" {{ $currentTurno === 'TARDE' ? 'selected' : '' }}>Tarde</option>
                        <option value="NOCHE" {{ $currentTurno === 'NOCHE' ? 'selected' : '' }}>Noche</option>
                    </select>
                    @error('turno') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-warning me-2"><i class="fas fa-save me-1"></i> Guardar Cambios</button>
                    <a href="{{ route('admin.encargados.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
            
        </div>
    </div>
</div>
@endsection