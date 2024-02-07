<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Andrei Mira WEB</title>
    <!-- Agrega el enlace al archivo CSS de Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <nav class="bg-gray-800 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <!-- Logo o título del sitio -->
            <a href="#" class="text-lg font-semibold">Andrei Mira</a>
            <!-- Nombre de usuario y opción de cerrar sesión -->
            @auth
                <div class="flex items-center">
                    <span class="mr-2">{{ auth()->user()->name }}</span>
                    <a href="{{ route('logout') }}" class="text-gray-300 hover:text-white">Cerrar Sesión</a>
                </div>
            @endauth
        </div>
    </nav>

    <main class="container mt-4">
        <div class="flex justify-between">
            <div class="flex-grow h-full">
                <div class="p-2 h-full">
                    <a href="{{ route('calendar') }}" class="block h-full text-center">
                        <img src="{{ asset('img/calendario.jpg') }}" alt="Calendario" class="w-full h-96 object-cover">
                        <span class="block mt-2  font-bold">Calendario</span>
                    </a>
                </div>
            </div>
            <div class="flex-grow h-full">
                <div class="p-2 h-full">
                    <a href="{{ route('sqword') }}" class="block h-full text-center">
                        <img src="{{ asset('img/sqword.png') }}" alt="SQWORD" class="w-full h-96 object-cover">
                        <span class="block mt-2  font-bold">SQWORD CATALÀ</span>
                    </a>
                </div>
            </div>
            <div class="flex-grow h-full">
                <div class="p-2 h-full">
                    <a href="{{ route('game') }}" class="block h-full text-center">
                        <img src="{{ asset('img/game.jpg') }}" alt="GAME" class="w-full h-96 object-cover">
                        <span class="block mt-2  font-bold">PIEDRA PAPEL TIJERAS LAGARTO SPOCK</span>
                    </a>
                </div>
            </div>

        </div>
    </main>

    <!-- Agrega el enlace al archivo JavaScript de Tailwind CSS -->
    <script src="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.js"></script>
</body>

</html>
