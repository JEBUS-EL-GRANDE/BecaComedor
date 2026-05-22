<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asistencia Registrada</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #00b09b 0%, #96c93d 100%);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .success-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 500px;
            overflow: hidden;
        }
        
        .success-header {
            background: linear-gradient(135deg, #00b09b 0%, #96c93d 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        
        .success-body {
            padding: 40px;
        }
        
        .check-icon {
            width: 80px;
            height: 80px;
            background: #00b09b;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            font-size: 2.5rem;
        }
        
        .info-box {
            background: #f0f9ff;
            border-left: 4px solid #00b09b;
            padding: 20px;
            margin: 20px 0;
            border-radius: 5px;
        }
        
        .info-item {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }
        
        .info-item:last-child {
            border-bottom: none;
        }
        
        .btn-home {
            background: linear-gradient(135deg, #00b09b 0%, #96c93d 100%);
            border: none;
            color: white;
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
        }
        
        .btn-home:hover {
            background: linear-gradient(135deg, #009a87 0%, #85b837 100%);
            color: white;
        }
    </style>
</head>
<body>
    <div class="success-card">
        <div class="success-header">
            <h2><i class="fas fa-check-circle me-2"></i> ¡Asistencia Registrada!</h2>
            <p class="mb-0">Su asistencia ha sido guardada exitosamente</p>
        </div>
        
        <div class="success-body">
            <div class="check-icon">
                <i class="fas fa-check"></i>
            </div>
            
            <h3 class="text-center mb-4">Confirmación de Asistencia</h3>
            
            <div class="info-box">
                <div class="info-item">
                    <span><strong>Estudiante:</strong></span>
                    <span>{{ $estudiante->persona->nombre }} {{ $estudiante->persona->apellido }}</span>
                </div>
                
                <div class="info-item">
                    <span><strong>CI:</strong></span>
                    <span>{{ $estudiante->persona->ci }}</span>
                </div>
                
                <div class="info-item">
                    <span><strong>Servicio:</strong></span>
                    <span class="badge bg-success">{{ $tipo_servicio }}</span>
                </div>
                
                <div class="info-item">
                    <span><strong>Fecha:</strong></span>
                    <span>{{ date('d/m/Y', strtotime($fecha)) }}</span>
                </div>
                
                <div class="info-item">
                    <span><strong>Hora:</strong></span>
                    <span>{{ date('H:i:s') }}</span>
                </div>
            </div>
            
            <div class="alert alert-info">
                <i class="fas fa-info-circle me-2"></i>
                <strong>Importante:</strong> Presente este comprobante si es necesario. 
                La asistencia queda registrada en el sistema.
            </div>
            
            <div class="text-center mt-4">
                <a href="{{ url('/') }}" class="btn btn-home me-3">
                    <i class="fas fa-home me-1"></i> Volver al Inicio
                </a>
                <a href="{{ route('asistencia.showLoginForm') }}" class="btn btn-outline-primary">
                    <i class="fas fa-plus me-1"></i> Nueva Asistencia
                </a>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>