<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Un Millón de Árboles</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex flex-col bg-emerald-50/50 min-h-screen">
    <nav class="bg-emerald-900 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            @auth
                @if (auth()->user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="text-xl font-bold">Un Millón de Árboles</a>
                @elseif(auth()->user()->role === 'operator')
                    <a href="{{ route('operator.dashboard') }}" class="text-xl font-bold">Un Millón de Árboles</a>
                @else
                    <a href="{{ route('friend.dashboard') }}" class="text-xl font-bold">Un Millón de Árboles</a>
                @endif
            @else
                <a href="{{ route('login') }}" class="text-xl font-bold">Un Millón de Árboles</a>
            @endauth

            <div class="space-x-4">
                @auth
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-white">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}">Login</a>
                    <a href="{{ route('register') }}">Register</a>
                @endauth
            </div>
        </div>
    </nav>

    <main class="container mx-auto py-6">
        @if (!Request::routeIs('*.dashboard'))
            <div class="mb-6">
                @yield('breadcrumb')
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="bg-emerald-900 text-white py-4 mt-auto">
        <div class="container mx-auto text-center">
            <p class="flex items-center justify-center gap-2">
                <i class="fa fa-copyright" aria-hidden="true"></i>
                Copyright &copy; 2024 | Diseñado por Francine Barquero y Alondra Rodríguez
            </p>
        </div>
    </footer>
</body>

</html>
