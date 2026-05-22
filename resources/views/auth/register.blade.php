<!DOCTYPE html>
<html>
<head>
    <title>Registro de Usuario</title>
    <style>
        :root {
            --primary-color: #3498db;
            --secondary-color: #2980b9;
            --error-color: #e74c3c;
            --success-color: #2ecc71;
            --light-gray: #f5f5f5;
            --dark-gray: #333;
            --border-radius: 4px;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f9f9f9;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
            color: var(--dark-gray);
        }

        .container {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 30px;
            width: 100%;
            max-width: 500px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: var(--primary-color);
        }

        .error-message {
            background-color: #fdecea;
            border: 1px solid var(--error-color);
            color: var(--error-color);
            padding: 10px;
            border-radius: var(--border-radius);
            margin-bottom: 20px;
            list-style: none;
        }

        .error-message li {
            margin-bottom: 5px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        label {
            font-weight: 600;
            margin-bottom: 5px;
            display: block;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: var(--border-radius);
            font-size: 16px;
            transition: border 0.3s;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus,
        select:focus {
            border-color: var(--primary-color);
            outline: none;
        }

        button[type="submit"] {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 12px;
            border-radius: var(--border-radius);
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 10px;
        }

        button[type="submit"]:hover {
            background-color: var(--secondary-color);
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
        }

        .login-link a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        @media (max-width: 600px) {
            .container {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Registro</h2>

        @if ($errors->any())
            <div class="error-message">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
            </div>

            <div>
                <label for="apellido">Apellido:</label>
                <input type="text" id="apellido" name="apellido" value="{{ old('apellido') }}" required>
            </div>

            <div>
                <label for="ci">CI:</label>
                <input type="text" id="ci" name="ci" value="{{ old('ci') }}" required>
            </div>

            <div>
                <label for="sexo">Sexo:</label>
                <select id="sexo" name="sexo" required>
                    <option value="">Seleccione</option>
                    <option value="M" {{ old('sexo') == 'M' ? 'selected' : '' }}>Masculino</option>
                    <option value="F" {{ old('sexo') == 'F' ? 'selected' : '' }}>Femenino</option>
                    <option value="O" {{ old('sexo') == 'O' ? 'selected' : '' }}>Otro</option>
                </select>
            </div>

            <div>
                <label for="email">Email (Opcional):</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}">
            </div>

            <div>
                <label for="telefono">Teléfono (Opcional):</label>
                <input type="text" id="telefono" name="telefono" value="{{ old('telefono') }}">
            </div>

            <div>
                <label for="direccion">Dirección (Opcional):</label>
                <input type="text" id="direccion" name="direccion" value="{{ old('direccion') }}">
            </div>

            <div>
                <label for="rol">Rol:</label>
                <select id="rol" name="rol" required>
                    <option value="">Seleccione un rol</option>
                    <option value="PARTICULAR" {{ old('rol') == 'PARTICULAR' ? 'selected' : '' }}>Particular</option>
                    <option value="ESTUDIANTE" {{ old('rol') == 'ESTUDIANTE' ? 'selected' : '' }}>Estudiante</option>
                </select>
            </div>

            <div>
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div>
                <label for="password_confirmation">Confirmar Contraseña:</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
            </div>

            <button type="submit">Registrarse</button>
        </form>

        <p class="login-link">¿Ya tienes cuenta? <a href="{{ route('login') }}">Inicia Sesión aquí</a></p>
    </div>
</body>
</html>
