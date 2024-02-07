<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="icon" href="/favicon.svg" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <title>Sqword</title>
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-DJM6J1D7T7"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script>
        (window.dataLayer = window.dataLayer || []),
        (window.gtag = function() {
            dataLayer.push(arguments);
        }),
        window.gtag("js", new Date()),
            window.gtag("config", "G-DJM6J1D7T7");
    </script>
    @vite(['resources/css/sqword.css', 'resources/js/sqword.js'])
</head>

<body>
    <nav class="bg-gray-800 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <!-- Logo o título del sitio -->
            <a href="/" class="text-lg font-semibold">Andrei Mira</a>
            <!-- Nombre de usuario y opción de cerrar sesión -->
            @auth
                <div class="flex items-center">
                    <span class="mr-2">{{ auth()->user()->name }}</span>
                    <a href="{{ route('logout') }}" class="text-gray-300 hover:text-white">Cerrar Sesión</a>
                </div>
            @endauth

        </div>
    </nav>
    <noscript>Es necesita JavaScript per a poder jugar</noscript>
    <div id="root"></div>
</body>

</html>
