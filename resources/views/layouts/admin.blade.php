<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Panel Admin Comedor')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        .sidebar { height: 100vh; background-color: #343a40; padding-top: 20px; }
        .sidebar a { color: #f8f9fa; padding: 10px 15px; text-decoration: none; display: block; }
        .sidebar a:hover { background-color: #495057; }
        .content { padding: 20px; }
    </style>
</head>
<body>
    <div class="d-flex">
        <div class="sidebar text-white">
            <h4 class="text-center text-danger mb-4">ADMIN PANEL</h4>
            <a href="{{ route('admin.dashboard') }}"><i class="fas fa-home me-2"></i> Dashboard</a>
            <hr class="text-secondary">
            <a href="{{ route('admin.personas.index') }}"><i class="fas fa-users me-2"></i> Personas</a>
            <a href="{{ route('admin.carreras.index') }}"><i class="fas fa-graduation-cap me-2"></i> Carreras</a>
            <a href="{{ route('admin.estudiantes.index') }}"><i class="fas fa-user-graduate me-2"></i> Estudiantes</a>
            <a href="{{ route('admin.encargados.index') }}"><i class="fas fa-user-tie me-2"></i> Encargados</a>
            <a href="{{ route('admin.personalcocina.index') }}"><i class="fas fa-utensils me-2"></i> Personal Cocina</a>
            <a href="{{ route('admin.tipobecas.index') }}"><i class="fas fa-certificate me-2"></i> Tipos de Beca</a>
            <a href="{{ route('admin.administradores.index') }}"><i class="fas fa-user-shield me-2"></i> Administradores</a>
            <form method="POST" action="{{ route('logout') }}" class="mt-5 px-3">
                @csrf
                <button type="submit" class="btn btn-danger btn-sm w-100"><i class="fas fa-sign-out-alt me-2"></i> Cerrar Sesión</button>
            </form>
        </div>
        
        <div class="content flex-grow-1">
            @yield('content')
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>