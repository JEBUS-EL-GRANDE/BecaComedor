<!--para ser admin
UPDATE personas 
SET rol = 'ADMINISTRADOR' 
WHERE id_personal = 1;
-->
<!DOCTYPE html>
<html>
<head>
    <title>Login de Administrador</title>
    <style>
        :root {
            --primary-color: #e74c3c; /* Rojo distintivo para admin */
            --secondary-color: #c0392b;
            --error-color: #e74c3c;
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
            max-width: 400px;
            border-top: 4px solid var(--primary-color);
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

        .back-link {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            display: block;
        }

        .back-link a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
        }

        .back-link a:hover {
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
        <h2>Login de Administrador</h2>

        @if ($errors->any())
            <div class="error-message">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login') }}">
            @csrf

            <div>
                <label for="ci">CI:</label>
                <input type="text" id="ci" name="ci" value="{{ old('ci') }}" required autofocus>
            </div>

            <div>
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <button type="submit">Acceder al Panel Admin</button>
        </form>

        <p class="back-link"><a href="/">Volver a la página principal</a></p>
    </div>
</body>
</html>
