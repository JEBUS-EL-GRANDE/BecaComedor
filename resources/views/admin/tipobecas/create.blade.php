@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="card shadow">
        <div class="card-header bg-success text-white">
            <h4><i class="fas fa-plus me-2"></i> Añadir Tipo de Beca</h4>
        </div>
        <div class="card-body">
            
            <form action="{{ route('admin.tipobecas.store') }}" method="POST">
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
                        <label for="tipo_beca" class="form-label">Tipo de Beca *</label>
                        <input type="text" class="form-control @error('tipo_beca') is-invalid @enderror" 
                               id="tipo_beca" name="tipo_beca" 
                               value="{{ old('tipo_beca') }}"
                               placeholder="Ej: Beca Completa, Media Beca, Beca de Alimentación"
                               required>
                        @error('tipo_beca') 
                            <div class="invalid-feedback">{{ $message }}</div> 
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="duracion" class="form-label">Duración (meses)</label>
                        <input type="number" class="form-control @error('duracion') is-invalid @enderror" 
                               id="duracion" name="duracion" 
                               value="{{ old('duracion') }}"
                               min="1" max="120"
                               placeholder="Ej: 12">
                        @error('duracion') 
                            <div class="invalid-feedback">{{ $message }}</div> 
                        @enderror
                        <small class="form-text text-muted">
                            Dejar vacío si no tiene duración específica
                        </small>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea class="form-control @error('descripcion') is-invalid @enderror" 
                                  id="descripcion" name="descripcion" 
                                  rows="3"
                                  placeholder="Descripción detallada del tipo de beca">{{ old('descripcion') }}</textarea>
                        @error('descripcion') 
                            <div class="invalid-feedback">{{ $message }}</div> 
                        @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-success me-2">
                        <i class="fas fa-save me-1"></i> Guardar
                    </button>
                    <a href="{{ route('admin.tipobecas.index') }}" class="btn btn-secondary">
                        Cancelar
                    </a>
                </div>
            </form>
            
        </div>
    </div>
</div>
@endsection