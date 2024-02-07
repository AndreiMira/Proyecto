<?php

namespace App\Console\Commands;

use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;
use App\Http\Controllers\WebSocketController;
use Illuminate\Console\Command;

class WebSocketServer extends Command
{
    protected $signature = 'websocket:serve';

    protected $description = 'Start WebSocket Server';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $server = IoServer::factory(
            new HttpServer(
                new WsServer(
                    new WebSocketController()
                )
            ),
            8080
        );

        $this->info('WebSocket server running at port 8080');

        $server->run();
    }
}
