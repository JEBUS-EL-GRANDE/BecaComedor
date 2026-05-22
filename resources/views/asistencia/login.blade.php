<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Asistencia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #bfbbc4ff 0%, #d8e0eeff 100%);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .login-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 450px;
        }
        
        .login-header {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            color: white;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
            padding: 25px;
            text-align: center;
        }
        
        .login-body {
            padding: 30px;
        }
        
        .btn-registro {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            border: none;
            color: white;
            padding: 12px;
            width: 100%;
            border-radius: 8px;
            font-weight: 600;
            font-size: 1.1rem;
        }
        
        .btn-registro:hover {
            background: linear-gradient(135deg, #5a0db5 0%, #1c68e8 100%);
            color: white;
        }
        
        .info-box {
            background: #e7f3ff;
            border-left: 4px solid #2575fc;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="login-header">
            <h2><i class="fas fa-clipboard-check me-2"></i> Registro de Asistencia</h2>
            <p class="mb-0">Estudiantes - Comedor Universitario</p>
        </div>
        
        <div class="login-body">
            <div class="info-box">
                <h6><i class="fas fa-info-circle me-2"></i> Información importante</h6>
                <p class="mb-0 small">
                    Solo los estudiantes pueden registrar su asistencia. 
                    Ingrese su CI y contraseña para continuar.
                </p>
            </div>
            
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <form action="{{ route('asistencia.registrar') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label for="ci" class="form-label">Cédula de Identidad (CI)</label>
                    <input type="text" class="form-control @error('ci') is-invalid @enderror" 
                           id="ci" name="ci" value="{{ old('ci') }}" 
                           placeholder="Ingrese su CI de estudiante" required>
                </div>
                
                <div class="mb-4">
                    <label for="contrasena" class="form-label">Contraseña</label>
                    <input type="password" class="form-control @error('contrasena') is-invalid @enderror" 
                           id="contrasena" name="contrasena" 
                           placeholder="Ingrese su contraseña" required>
                </div>
                
                <button type="submit" class="btn btn-registro mb-3">
                    <i class="fas fa-sign-in-alt me-2"></i> Registrar Asistencia
                </button>
                
                <div class="text-center">
                    <a href="{{ url('/') }}" class="text-decoration-none">
                        <i class="fas fa-arrow-left me-1"></i> Volver al inicio
                    </a>
                </div>
            </form>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script>
</body>
</html>