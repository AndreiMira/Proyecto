<?php

namespace App\Http\Controllers;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class WebSocketController implements MessageComponentInterface {
    protected $clients;
    protected $activeGames = [];

    public function __construct() {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn) {
        $this->clients->attach($conn);
        echo "Nueva conexión ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        $data = json_decode($msg, true);

        if (isset($data['action']) && $data['action'] === 'play' && isset($data['play']) && isset($data['userId'])) {
            if (isset($this->activeGames[$from->resourceId]) && $this->activeGames[$from->resourceId]['hasPlayed']) {
                $from->send(json_encode(['action' => 'wait', 'message' => 'Espera a que tu oponente elija.']));
                return;
            }

            $this->activeGames[$from->resourceId] = [
                'play' => $data['play'],
                'userId' => $data['userId'],
                'userName' => $data['userName'],
                'hasPlayed' => true,
            ];

            if (count($this->activeGames) == 2) {
                $this->evaluateGame();
            }
        }
    }

    protected function evaluateGame() {
        $games = array_values($this->activeGames);
        $result = $this->determineWinner($games);
    
        // Determinar si es necesario enviar una señal para continuar después de un empate
        $canContinue = $result['winnerName'] === 'Empate';
    
        foreach ($this->clients as $client) {
            if (isset($this->activeGames[$client->resourceId])) {
                $client->send(json_encode([
                    'action' => 'result',
                    'result' => $result['message'],
                    'userPlay' => $games[0]['play'],
                    'opponentPlay' => $games[1]['play'],
                    'winnerName' => $result['winnerName'],
                    'canContinue' => $canContinue, // Indica si los jugadores pueden proceder a una nueva elección
                ]));
            }
        }
    
        // Resetea el estado de 'hasPlayed' para la siguiente ronda de manera que permita nuevas elecciones
        $this->activeGames = [];
    
        // Enviar un mensaje adicional en caso de empate para asegurarse de que ambos clientes estén listos para continuar
        if ($canContinue) {
            foreach ($this->clients as $client) {
                if (isset($this->activeGames[$client->resourceId])) {
                    $client->send(json_encode([
                        'action' => 'continue', // Un nuevo tipo de acción para manejar el flujo después de un empate
                        'message' => 'Empate. Elijan nuevamente para continuar jugando.'
                    ]));
                }
            }
        }
    }
    
    

    protected function determineWinner($games) {
        $rules = [
            'tijeras' => ['papel' => 'cortan al papel', 'lagarto' => 'decapitan al lagarto'],
            'papel' => ['piedra' => 'cubre a la piedra', 'spock' => 'desaprueba a Spock'],
            'piedra' => ['lagarto' => 'aplasta al lagarto', 'tijeras' => 'aplastan a las tijeras'],
            'lagarto' => ['spock' => 'envenena a Spock', 'papel' => 'come el papel'],
            'spock' => ['tijeras' => 'destruye las tijeras', 'piedra' => 'vaporiza la piedra'],
        ];
    
        $play1 = $games[0]['play'];
        $play2 = $games[1]['play'];
        $userName1 = $games[0]['userName'];
        $userName2 = $games[1]['userName'];
    
        if ($play1 === $play2) {
            return ['message' => "Empate", 'winnerName' => 'Empate'];
        }
    
        if (array_key_exists($play2, $rules[$play1])) {
            $action = $rules[$play1][$play2];
            $message = ucfirst($play1) . " $action - $userName1 GANA";
            return ['message' => $message, 'winnerName' => $userName1];
        } else {
            $action = $rules[$play2][$play1];
            $message = ucfirst($play2) . " $action - $userName2 GANA";
            return ['message' => $message, 'winnerName' => $userName2];
        }
    }
    
    public function onClose(ConnectionInterface $conn) {
        $this->clients->detach($conn);
        unset($this->activeGames[$conn->resourceId]);
        echo "Conexión {$conn->resourceId} desconectada.\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "Error: {$e->getMessage()}\n";
        $conn->close();
    }
}