<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Vicissitude To-Do')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Estilos personalizados (naranja, blanco, negro) */
        body {
            font-family: sans-serif;
            background-color: #f7f7f7; /* Gris claro de fondo */
            color: #333;
            margin: 0;
            padding: 0;
        }

        .navbar {
            background-color: #000;
            color: #fff;
            padding: 1rem 0;
        }

        .navbar a {
            color: #000;
            text-decoration: none;
            margin: 0 1rem;
            transition: color 0.3s ease;
        }

        .navbar a:hover {
            color: #ff9800; /* Naranja al pasar el ratón */
        }

        .container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 1rem;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            background-color: #ff9800;
            color: #fff;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 0.25rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #e08200;
        }

        .form-control {
            width: 100%;
            padding: 0.5rem;
            margin-bottom: 1rem;
            border: 1px solid #ccc;
            border-radius: 0.25rem;
        }

        .error-message {
            color: #f00;
            font-size: 0.8rem;
            margin-top: -0.5rem;
            margin-bottom: 0.5rem;
        }

        .task-list {
            list-style: none;
            padding: 0;
        }

        .task-list li {
            border-bottom: 1px solid #eee;
            padding: 0.5rem 0;
        }

        .task-list li:last-child {
            border-bottom: none;
        }
    </style>
</head>

<body>

    <nav class="navbar">
        <div class="container mx-auto flex justify-between items-center">
            <a href="/" class="text-2xl font-semibold">Vicissitude To-Do</a>
            <div>
                @auth
                    <a href="{{ route('tasks.index') }}">Tareas</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Cerrar Sesión
                    </a>
                @else
                    <a href="{{ route('login.view') }}">Iniciar Sesión</a>
                    <a href="{{ route('register.view') }}">Registrarse</a>
                @endauth
            </div>
        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>

    <footer class="text-center mt-8 py-4 text-gray-500">
        <p>&copy; {{ date('Y') }} Vicissitude To-Do. Todos los derechos reservados.</p>
    </footer>

</body>

</html>