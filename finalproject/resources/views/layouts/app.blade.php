<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mi Proyecto')</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <!-- Si usas Font Awesome para íconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <header>
        <nav class="main-nav">
            <ul>
                @if(Auth::check()) <!-- Si el usuario está autenticado -->
                    <li><a href="{{ route('species.index') }}">Species</a></li>
                    <li><a href="{{ route('friends.index') }}">Friends</a></li>
                    <li><a href="{{ route('logout') }}">Logout</a></li>
                @else <!-- Si el usuario no está autenticado -->
                    <li><a href="{{ route('register') }}">Registro</a></li>
                    <li><a href="{{ route('login') }}">Iniciar Sesión</a></li>
                @endif
            </ul>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <p>
            <i class="fa fa-copyright" aria-hidden="true"></i> Copyright &copy; 2024 | Diseñado por Francine Barquero y Alondra Rodríguez
        </p>
    </footer>
</body>
</html>


