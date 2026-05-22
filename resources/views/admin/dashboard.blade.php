<!--Esta es la web que aparece después del login exitoso. Contiene 
los enlaces a todas las tablas que el administrador puede gestionar.-->
<!DOCTYPE html>
<html>
<head>
    <title>Panel de Administración - Comedor</title>
    <style>
        :root {
            --primary-color: #e74c3c; /* Rojo distintivo para admin */
            --secondary-color: #c0392b;
            --text-color: #333;
            --light-gray: #f9f9f9;
            --border-color: #ddd;
            --border-radius: 4px;
            --box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: var(--light-gray);
            color: var(--text-color);
            line-height: 1.6;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            padding: 30px;
        }

        h1 {
            color: var(--primary-color);
            margin-bottom: 10px;
            font-size: 24px;
            border-bottom: 2px solid var(--border-color);
            padding-bottom: 10px;
        }

        h2 {
            color: var(--secondary-color);
            margin: 25px 0 15px 0;
            font-size: 20px;
        }

        p {
            margin-bottom: 20px;
            font-size: 16px;
        }

        ul {
            list-style: none;
            margin-bottom: 30px;
        }

        li {
            margin-bottom: 10px;
        }

        li a {
            display: block;
            padding: 12px 15px;
            background-color: var(--light-gray);
            color: var(--primary-color);
            text-decoration: none;
            border-radius: var(--border-radius);
            transition: all 0.3s;
            font-weight: 500;
            border-left: 4px solid var(--primary-color);
        }

        li a:hover {
            background-color: var(--primary-color);
            color: white;
        }

        form {
            margin-top: 30px;
            text-align: right;
        }

        button[type="submit"] {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: var(--border-radius);
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button[type="submit"]:hover {
            background-color: var(--secondary-color);
        }

        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>¡Bienvenido, Administrador {{ Auth::user()->nombre }}!</h1>
        <p>Utiliza los siguientes enlaces para gestionar la información de la base de datos:</p>

        <h2>Gestión de Tablas (CRUD)</h2>
        <ul>
            <li><a href="{{ route('admin.personas.index') }}">Gestión de Personas</a></li>
            <li><a href="{{ route('admin.carreras.index') }}">Gestión de CARRERAS</a></li>
            <li><a href="{{ route('admin.encargados.index') }}">Gestión de ENCARGADOS</a></li>
            <li><a href="{{ route('admin.tipobecas.index') }}">Gestión de TIPOS DE BECA</a></li>
            <li><a href="{{ route('admin.particulares.index') }}">Gestión de PARTICULARES</a></li>
            <li><a href="{{ route('admin.personalcocina.index') }}">Gestión de PERSONAL DE COCINA</a></li>
            <li><a href="{{ route('admin.estudiantes.index') }}">Gestión de ESTUDIANTES</a></li>
            <li><a href="{{ route('admin.administradores.index') }}">Gestión de ADMINISTRADORES</a></li>
        </ul>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Cerrar Sesión</button>
        </form>
    </div>
</body>
</html>
