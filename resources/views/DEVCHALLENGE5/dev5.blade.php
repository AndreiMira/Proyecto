<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Piedra papel tijeras spock lagartija</title>
    <link rel="stylesheet" href="./style.css">
    <script src="/socket.io/socket.io.js"></script>
    <script src="./client.js"></script>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>
    <nav class="bg-gray-800 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <!-- Logo o título del sitio -->
            <a href="/" class="text-gray-300 hover:text-white">Andrei Mira</a>
            <!-- Nombre de usuario y opción de cerrar sesión -->
            @auth
                <div class="flex items-center">
                    <span class="mr-2">{{ auth()->user()->name }}</span>
                    <a href="{{ route('logout') }}" class="text-gray-300 hover:text-white">Cerrar Sesión</a>
                </div>
            @endauth

        </div>
    </nav>
    <div id="initial" class="container col-md-6">
        <table>
            <tr>
                <td colspan="3"></td>
                <td><img height="200" src="{{ asset('img/rock.svg') }}" alt="Rock"></td>
                <td colspan="3"></td>
            </tr>
            <tr>
                <td><img height="100" src="{{ asset('img/spock.svg') }}" alt="Spock"></td>
                <td colspan="2"></td>
                <td colspan="2"></td>
                <td><img height="200" src="{{ asset('img/paper.svg') }}" alt="Paper"></td>
                <td></td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td></td>
                <td colspan="2"></td>
                <td colspan="2"></td>
            </tr>
            <tr>
                <td></td>
                <td><img height="200" src="{{ asset('img/scissor.svg') }}" alt="Scissor"></td>
                <td></td>
                <td></td>
                <td><img height="100" src="{{ asset('img/lizard.svg') }}" alt="Lizard"></td>
                <td></td>
                <td></td>
            </tr>
        </table>
        <button class="form-control btn btn-primary" onclick="createGame()">Crear juego</button>
        <div class="text-center display-3">o</div>
        <input class="form-control my-2" placeholder="Entra código" type="text" name="" id="roomUniqueId" />
        <button class="form-control btn btn-secondary" onclick="joinGame()">Unirse a un juego</button>
    </div>
    <div id="gamePlay" class="container">
        <div id="waitingArea" class="h4">

        </div>
        <div id="gameArea" class="h3 row" style="display: none;">
            <div class="col-md-6">
                You:
                <div id="player1Choice">
                    <button class="rock" onclick="sendChoice('Rock')">Piedra</button>
                    <button class="paper" onclick="sendChoice('Paper')">Papel</button>
                    <button class="scissor" onclick="sendChoice('Scissor')">Tijeras</button>
                    <button class="spock" onclick="sendChoice('Spock')">Spock</button>
                    <button class="lizard" onclick="sendChoice('Lizard')">Lizard</button>
                </div>
            </div>
            <div class="col-md-6">
                Oponente:
                <div id="player2Choice">
                    <p id="opponentState">Esperando a Oponente</p>
                </div>
            </div>
        </div>
        <hr />
        <div id="winnerArea" class="display-4">

        </div>
    </div>
</body>

</html>
