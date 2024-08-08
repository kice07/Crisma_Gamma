<?php
// require __DIR__ . '/vendor/autoload.php';

// use Ratchet\MessageComponentInterface;
// use Ratchet\ConnectionInterface;

// class Chat implements MessageComponentInterface {
//     protected $clients;

//     public function __construct() {
//         $this->clients = new \SplObjectStorage;
//     }

//     public function onOpen(ConnectionInterface $conn) {
        
//         $this->clients->attach($conn);
//         echo "New connection! ({$conn->resourceId})\n";
//     }

//     public function onMessage(ConnectionInterface $from, $msg) {
//         $numRecv = count($this->clients) - 1;
//         echo sprintf('Connection %d sending message "%s" to %d other connection%s' . "\n"
//             , $from->resourceId, $msg, $numRecv, $numRecv == 1 ? '' : 's');

//         foreach ($this->clients as $client) {
//             if ($from !== $client) {
                
//                 $client->send($msg);
//             }
//         }
//     }

//     public function onClose(ConnectionInterface $conn) {
       
//         $this->clients->detach($conn);
//         echo "Connection {$conn->resourceId} has disconnected\n";
//     }

//     public function onError(ConnectionInterface $conn, \Exception $e) {
//         echo "An error has occurred: {$e->getMessage()}\n";
//         $conn->close();
//     }
// }

// use Ratchet\Server\IoServer;
// use Ratchet\Http\HttpServer;
// use Ratchet\WebSocket\WsServer;

// $server = IoServer::factory(
//     new HttpServer(
//         new WsServer(
//             new Chat()
//         )
//     ),
//     8080,
//     '0.0.0.0'
// );

// $server->run();








require __DIR__ . '/vendor/autoload.php';

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use React\EventLoop\Factory;
use React\Socket\Server as ReactServer;
use React\Socket\SecureServer;

class Chat implements MessageComponentInterface {
    protected $clients;

    public function __construct() {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn) {
        // Store the new connection to send messages to later
        $this->clients->attach($conn);
        echo "New connection! ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        $numRecv = count($this->clients) - 1;
        echo sprintf('Connection %d sending message "%s" to %d other connection%s' . "\n"
            , $from->resourceId, $msg, $numRecv, $numRecv == 1 ? '' : 's');

        foreach ($this->clients as $client) {
            if ($from !== $client) {
                // The sender is not the receiver, send to each client connected
                $client->send($msg);
            }
        }
    }

    public function onClose(ConnectionInterface $conn) {
        // The connection is closed, remove it, as we can no longer send it messages
        $this->clients->detach($conn);
        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";
        $conn->close();
    }
}

// Path to SSL certificates
$sslContext = [
    'local_cert' => '/etc/letsencrypt/live/crismawork.com/fullchain.pem',   // Replace with the path to your SSL certificate
    'local_pk'   => '/etc/letsencrypt/live/crismawork.com/privkey.pem',    // Replace with the path to your SSL private key
    
    'verify_peer'       => false // Set to true to verify the peer certificate
];

$loop = Factory::create();
$webSocketServer = new WsServer(new Chat());

// Create a non-secure server on port 8080
$reactServer = new ReactServer('0.0.0.0:8080', $loop);

// Wrap the non-secure server with a secure server
$secureServer = new SecureServer($reactServer, $loop, $sslContext);

// Run the server
$server = IoServer::factory(
    new HttpServer($webSocketServer),
    $secureServer
);

echo "WebSocket server started on wss://0.0.0.0:8080\n";

$loop->run();

?>