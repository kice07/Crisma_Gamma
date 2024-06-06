<?php
header("Content-Type: application/json");

$dsn = "mysql:host=localhost;dbname=websocket;charset=utf8mb4";
$username = "root";
$password = "";

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(["error" => "Database connection failed: " . $e->getMessage()]);
    exit;
}

$method = $_SERVER['REQUEST_METHOD'];
$path = explode('/', trim($_SERVER['PATH_INFO'], '/'));

switch ($method) {
    case 'GET':
        if ($path[0] === 'freelancer') {
            $stmt = $pdo->query("SELECT id, nom FROM freelancer");
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($users);
        } elseif ($path[0] === 'messages' && isset($_GET['userId']) && isset($_GET['contactId'])) {
            $userId = $_GET['userId'];
            $contactId = $_GET['contactId'];
            $stmt = $pdo->prepare("SELECT * FROM message WHERE (incoming_msg_id = ? AND outgoing_msg_id = ?) OR (outgoing_msg_id = ? AND incoming_msg_id = ?) ORDER BY created_on");
            $stmt->execute([$userId, $contactId, $contactId, $userId]);
            $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($messages);
        }
        break;
    case 'POST':
        if ($path[0] === 'users') {
            $input = json_decode(file_get_contents('php://input'), true);
            $username = $input['username'];
            $password = password_hash($input['password'], PASSWORD_BCRYPT);

            $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            $stmt->execute([$username, $password]);

            echo json_encode(["success" => true]);
        }
        break;
    default:
        http_response_code(405);
        echo json_encode(["error" => "Method not allowed"]);
        break;
}
