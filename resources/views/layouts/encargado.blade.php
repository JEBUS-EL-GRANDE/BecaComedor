<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Encargado - @yield('title', 'Panel de Control')</title>
    <!-- Aquí puedes enlazar tus archivos CSS, por ejemplo: -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"> 
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
        }
        .sidebar {
            width: 250px;
            background-color: #3f51b5; /* Azul primario */
            color: white;
            height: 100vh;
            padding: 20px;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
        }
        .sidebar h2 {
            text-align: center;
            margin-bottom: 30px;
        }
        .sidebar a {
            display: block;
            color: white;
            padding: 10px 0;
            text-decoration: none;
            border-bottom: 1px solid #5c70c1;
        }
        .sidebar a:hover {
            background-color: #5c70c1;
        }
        .content {
            flex-grow: 1;
            padding: 20px;
            background-color: #f4f7f6;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #ddd;
        }
        .logout-form button {
            background-color: #ff5252;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .logout-form button:hover {
            background-color: #ff1744;
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <h2>Panel Encargado</h2>
        <nav>
            <a href="{{ route('encargado.dashboard') }}">Dashboard</a>
            <a href="{{ route('encargado.asistencia.index') }}">Control de Asistencia</a>
            <a href="{{ route('encargado.servicios.index') }}">Gestión de Servicios</a>
            <!-- Puedes añadir más enlaces aquí -->
        </nav>
    </div>

    <div class="content">
        <header class="header">
            <h1>@yield('page_title', 'Bienvenido')</h1>
            <div class="user-info">
                <span>Hola, {{ Auth::user()->nombre }}</span>
                <form method="POST" action="{{ route('logout') }}" class="logout-form" style="display: inline;">
                    @csrf
                    <button type="submit">Cerrar Sesión</button>
                </form>
            </div>
        </header>

        <main>
            @yield('content')
        </main>
        
        <footer>
            <!-- Contenido del pie de página -->
        </footer>
    </div>

</body>
</html>