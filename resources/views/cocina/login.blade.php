<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Personal de Cocina</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #ffffffff 0%, #d2ced6ff 100%);
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
            max-width: 400px;
        }
        
        .login-header {
            background: #f8f9fa;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid #e9ecef;
        }
        
        .login-header h3 {
            color: #333;
            margin: 0;
        }
        
        .login-header p {
            color: #666;
            margin: 5px 0 0 0;
            font-size: 0.9rem;
        }
        
        .login-body {
            padding: 30px;
        }
        
        .btn-login {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
            padding: 10px;
            width: 100%;
            border-radius: 8px;
            font-weight: 600;
        }
        
        .btn-login:hover {
            background: linear-gradient(135deg, #5a6fd8 0%, #6a4090 100%);
            color: white;
        }
        
        .back-link {
            text-align: center;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="login-header">
            <h3><i class="fas fa-utensils me-2"></i> Personal de Cocina</h3>
            <p>Ingrese sus credenciales para ver su horario</p>
        </div>
        
        <div class="login-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            
            <form action="{{ route('cocina.horario.login') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label for="ci" class="form-label">Cédula de Identidad (CI)</label>
                    <input type="text" class="form-control @error('ci') is-invalid @enderror" 
                           id="ci" name="ci" value="{{ old('ci') }}" 
                           placeholder="Ingrese su CI" required>
                </div>
                
                <div class="mb-4">
                    <label for="contrasena" class="form-label">Contraseña</label>
                    <input type="password" class="form-control @error('contrasena') is-invalid @enderror" 
                           id="contrasena" name="contrasena" 
                           placeholder="Ingrese su contraseña" required>
                </div>
                
                <button type="submit" class="btn btn-login">
                    <i class="fas fa-sign-in-alt me-2"></i> Ingresar
                </button>
            </form>
            
            <div class="back-link">
                <a href="{{ url('/') }}" class="text-decoration-none">
                    <i class="fas fa-arrow-left me-1"></i> Volver al inicio
                </a>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script>
</body>
</html>