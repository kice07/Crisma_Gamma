<?php
require __DIR__ . '/vendor/autoload.php';


use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;

require __DIR__ . '/vendor/autoload.php';

class Chat implements MessageComponentInterface {
    protected $clients;
    protected $users;

    public function __construct() {
        $this->clients = new \SplObjectStorage;
        $this->users = [];
    }

    public function onOpen(ConnectionInterface $conn) {
        $this->clients->attach($conn);
        echo "New connection! ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        $data = json_decode($msg);
        
        switch ($data->type) {
            case 'login':
                $this->users[$data->userId] = $from;
                $from->userId = $data->userId;
                break;
            case 'message':
                $senderId = $from->userId;
                $receiverId = $data->receiverId;
                $message = $data->message;

                // Save message to database
                $dsn = "mysql:host=localhost;dbname=websocket;charset=utf8mb4";
                $pdo = new PDO($dsn, "root", "");
                $stmt = $pdo->prepare("INSERT INTO message (outgoing_msg_id, incoming_msg_id, msg) VALUES (?, ?, ?)");
                $stmt->execute([$senderId, $receiverId, $message]);

                if (isset($this->users[$receiverId])) {
                    $this->users[$receiverId]->send(json_encode([
                        'type' => 'message',
                        'senderId' => $senderId,
                        'message' => $message
                    ]));
                }
                break;
        }
    }

    public function onClose(ConnectionInterface $conn) {
        $this->clients->detach($conn);
        if (isset($conn->userId)) {
            unset($this->users[$conn->userId]);
        }
        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";
        $conn->close();
    }
}

$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new Chat()
        )
    ),
    8080
);

echo "WebSocket server started on ws://127.0.0.1:8080\n";
$server->run();

?>