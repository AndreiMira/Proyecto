<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Registro</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <div class="container mx-auto mt-8 flex justify-center">
        <div class="max-w-md w-full bg-white p-8 rounded-lg shadow-lg">
            <h2 class="text-2xl font-bold text-center mb-6">Registrarse</h2>
            <form method="POST" action="{{ route('validar-registro') }}">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
                    <input id="name" name="name" type="text" :value="old('name')" required autofocus
                        autocomplete="name" placeholder="Ingresa tu nombre"
                        class="mt-1 p-3 block w-full border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Correo Electrónico</label>
                    <input id="email" name="email" type="email" :value="old('email')" required
                        autocomplete="email" placeholder="Ingresa tu correo electrónico"
                        class="mt-1 p-3 block w-full border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
                    <input id="password" name="password" type="password" required autocomplete="new-password"
                        placeholder="Ingresa tu contraseña"
                        class="mt-1 p-3 block w-full border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
                </div>
                <div class="mb-6">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmar
                        Contraseña</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required
                        autocomplete="new-password" placeholder="Confirma tu contraseña"
                        class="mt-1 p-3 block w-full border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
                </div>
                <button type="submit"
                    class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600 w-full">Registrarse</button>
                <div class="mt-3 text-center text-gray-600">
                    <p class="mb-3">o tambien con</p>
                    <div class="flex justify-center">
                        <a href="/auth/google/redirect" class="mr-4">
                            <div class="w-12 h-12 flex items-center justify-center bg-white rounded-full shadow-md">
                                <img class="w-8 h-8" src="{{ asset('img/google_logo.svg') }}" alt="Google Logo">
                            </div>
                        </a>
                        <a href="/auth/github/redirect" class="ml-4">
                            <div class="w-12 h-12 flex items-center justify-center bg-white rounded-full shadow-md">
                                <img class="w-8 h-8" src="{{ asset('img/github_logo.svg') }}" alt="Github Logo">
                            </div>
                        </a>
                    </div>
                </div>
                <div class="mt-3 text-center">
                    ¿Ya tienes una cuenta? <a href="{{ route('login') }}" class="text-blue-500">Inicia sesión aquí</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
