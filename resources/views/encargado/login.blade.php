<!DOCTYPE html>
<html>
<head>
    <title>Login de Encargado</title>
    <style>
        :root {
            --primary-color: #27ae60; /* Verde distintivo para encargado */
            --secondary-color: #2ecc71;
            --error-color: #e74c3c;
            --light-gray: #f9f9f9;
            --dark-gray: #333;
            --border-radius: 4px;
            --box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: var(--light-gray);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
            color: var(--dark-gray);
        }

        .login-container {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            padding: 30px;
            width: 100%;
            max-width: 400px;
            border-top: 4px solid var(--primary-color);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: var(--primary-color);
            font-size: 24px;
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
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: var(--border-radius);
            font-size: 16px;
            transition: border 0.3s;
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
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

        @media (max-width: 600px) {
            .login-container {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Login de Encargado</h1>

        @if ($errors->any())
            <div class="error-message">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('encargado.login.submit') }}">
            @csrf

            <div>
                <label for="ci">CI:</label>
                <input type="text" name="ci" id="ci" value="{{ old('ci') }}" required autofocus>
            </div>

            <div>
                <label for="contrasena">Contraseña:</label>
                <input type="password" name="contrasena" id="contrasena" required>
            </div>

            <button type="submit">Acceder al Panel Encargado</button>
        </form>
    </div>
</body>
</html>
