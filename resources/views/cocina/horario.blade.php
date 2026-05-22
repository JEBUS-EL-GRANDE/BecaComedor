<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Horario - Personal de Cocina</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px 0;
            margin-bottom: 30px;
        }
        
        .profile-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            padding: 25px;
            margin-bottom: 30px;
        }
        
        .horario-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            padding: 30px;
        }
        
        .info-item {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }
        
        .info-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }
        
        .info-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
        }
        
        .horario-item {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 15px;
            border-left: 5px solid #667eea;
        }
        
        .horario-item h5 {
            color: #333;
            margin-bottom: 10px;
        }
        
        .badge-especialidad {
            background: #764ba2;
            color: white;
            font-size: 0.9rem;
            padding: 5px 15px;
            border-radius: 20px;
        }
        
        .logout-btn {
            background: #dc3545;
            border: none;
            color: white;
            padding: 8px 20px;
            border-radius: 5px;
            text-decoration: none;
        }
        
        .logout-btn:hover {
            background: #c82333;
            color: white;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1><i class="fas fa-utensils me-2"></i> Mi Horario de Trabajo</h1>
                    <p class="mb-0">Panel del Personal de Cocina</p>
                </div>
                <a href="{{ url('/') }}" class="logout-btn">
                    <i class="fas fa-sign-out-alt me-1"></i> Cerrar Sesión
                </a>
            </div>
        </div>
    </div>
    
    <div class="container">
        <!-- Información Personal -->
        <div class="profile-card">
            <h3 class="mb-4">
                <i class="fas fa-user-circle me-2"></i>
                Información Personal
            </h3>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="info-item">
                        <div class="info-icon">
                            <i class="fas fa-id-card"></i>
                        </div>
                        <div>
                            <h6 class="mb-1">Cédula de Identidad</h6>
                            <p class="mb-0">{{ $personalCocina->persona->ci ?? 'N/A' }}</p>
                        </div>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-icon">
                            <i class="fas fa-user"></i>
                        </div>
                        <div>
                            <h6 class="mb-1">Nombre Completo</h6>
                            <p class="mb-0">
                                {{ $personalCocina->persona->nombre ?? '' }} 
                                {{ $personalCocina->persona->apellido ?? '' }}
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    @if($personalCocina->especialidad)
                    <div class="info-item">
                        <div class="info-icon">
                            <i class="fas fa-certificate"></i>
                        </div>
                        <div>
                            <h6 class="mb-1">Especialidad</h6>
                            <span class="badge-especialidad">
                                {{ $personalCocina->especialidad }}
                            </span>
                        </div>
                    </div>
                    @endif
                    
                    <div class="info-item">
                        <div class="info-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div>
                            <h6 class="mb-1">Teléfono</h6>
                            <p class="mb-0">{{ $personalCocina->persona->telefono ?? 'No registrado' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Horario de Trabajo -->
        <div class="horario-card">
            <h3 class="mb-4">
                <i class="fas fa-calendar-alt me-2"></i>
                Horario de Trabajo
            </h3>
            
            @if($personalCocina->horario_trabajo)
                <div class="horario-item">
                    <h5><i class="fas fa-clock me-2"></i> Horario Asignado</h5>
                    <p class="mb-2">{{ $personalCocina->horario_trabajo }}</p>
                    <small class="text-muted">
                        <i class="fas fa-info-circle me-1"></i>
                        Este es su horario oficial de trabajo. Cualquier cambio será notificado.
                    </small>
                </div>
            @else
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    No se ha asignado un horario específico. Consulte con su supervisor.
                </div>
            @endif
            
            <!-- Información General -->
            <div class="horario-item mt-4">
                <h5><i class="fas fa-info-circle me-2"></i> Información General</h5>
                <ul class="mb-0">
                    <li>Presentarse 15 minutos antes del inicio de su turno</li>
                    <li>Usar uniforme completo y adecuado</li>
                    <li>Reportar cualquier inconveniente al encargado</li>
                    <li>Mantener la higiene en su área de trabajo</li>
                </ul>
            </div>
        </div>
        
        <!-- Botón Volver -->
        <div class="text-center mt-4">
            <a href="{{ url('/') }}" class="btn btn-secondary">
                <i class="fas fa-home me-1"></i> Volver al Inicio
            </a>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>