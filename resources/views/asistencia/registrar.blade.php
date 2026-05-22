<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Asistencia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .header {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            color: white;
            padding: 20px 0;
            margin-bottom: 30px;
        }
        
        .info-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            padding: 25px;
            margin-bottom: 30px;
        }
        
        .form-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            padding: 30px;
        }
        
        .student-info {
            display: flex;
            align-items: center;
            background: #e7f3ff;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        
        .student-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-size: 1.5rem;
        }
        
        .btn-submit {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            border: none;
            color: white;
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 600;
        }
        
        .btn-submit:hover {
            background: linear-gradient(135deg, #5a0db5 0%, #1c68e8 100%);
            color: white;
        }
        
        .current-date {
            background: #f8f9fa;
            padding: 10px 15px;
            border-radius: 8px;
            text-align: center;
            font-weight: 600;
            color: #2575fc;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1><i class="fas fa-clipboard-check me-2"></i> Registrar Asistencia</h1>
                    <p class="mb-0">Comedor Universitario - Servicio Estudiantil</p>
                </div>
                <a href="{{ url('/') }}" class="btn btn-light">
                    <i class="fas fa-home me-1"></i> Inicio
                </a>
            </div>
        </div>
    </div>
    
    <div class="container">
        <!-- Información del Estudiante -->
        <div class="info-card">
            <h3 class="mb-4">
                <i class="fas fa-user-graduate me-2"></i>
                Información del Estudiante
            </h3>
            
            <div class="student-info">
                <div class="student-icon">
                    <i class="fas fa-user"></i>
                </div>
                <div>
                    <h5 class="mb-1">
                        {{ $estudiante->persona->nombre }} {{ $estudiante->persona->apellido }}
                    </h5>
                    <p class="mb-1">
                        <strong>CI:</strong> {{ $estudiante->persona->ci }}
                        @if($estudiante->carrera)
                            | <strong>Carrera:</strong> {{ $estudiante->carrera->nombre_carrera }}
                        @endif
                    </p>
                    @if($estudiante->promedio_academico)
                        <p class="mb-0">
                            <strong>Promedio:</strong> {{ $estudiante->promedio_academico }}
                        </p>
                    @endif
                </div>
            </div>
            
            <div class="current-date">
                <i class="fas fa-calendar-day me-2"></i>
                Fecha: {{ date('d/m/Y') }}
            </div>
        </div>
        
        <!-- Formulario de Asistencia -->
        <div class="form-card">
            <h3 class="mb-4">
                <i class="fas fa-edit me-2"></i>
                Formulario de Asistencia
            </h3>
            
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <form action="{{ route('asistencia.store') }}" method="POST">
                @csrf
                
                <input type="hidden" name="id_estudiante" value="{{ $estudiante->id_registro }}">
                
                <div class="mb-4">
                    <label for="tipo_servicio" class="form-label">Servicio a Tomar *</label>
                    <select class="form-select @error('tipo_servicio') is-invalid @enderror" 
                            id="tipo_servicio" name="tipo_servicio" required>
                        <option value="">Seleccione el servicio...</option>
                        @foreach($servicios as $servicio)
                            <option value="{{ $servicio->nombre_servicio }}">
                                {{ $servicio->nombre_servicio }} 
                                ({{ date('H:i', strtotime($servicio->hora_inicio)) }} - {{ date('H:i', strtotime($servicio->hora_fin)) }})
                            </option>
                        @endforeach
                    </select>
                    @error('tipo_servicio')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-4">
                    <label for="observacion" class="form-label">Observación (Opcional)</label>
                    <textarea class="form-control @error('observacion') is-invalid @enderror" 
                              id="observacion" name="observacion" 
                              rows="3"
                              placeholder="Ej: Llegué puntual, Es mi primera vez, etc."></textarea>
                    @error('observacion')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="d-flex justify-content-between">
                    <a href="{{ url('/') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Volver
                    </a>
                    <button type="submit" class="btn btn-submit">
                        <i class="fas fa-check-circle me-1"></i> Registrar Asistencia
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>