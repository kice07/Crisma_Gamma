
<?php

// Vérifier si le serveur WebSocket est déjà en cours d'exécution
// $command = 'pgrep -f "php /path/to/your/chat-server.php"';
// $output = shell_exec($command);

// if (empty($output)) {
//     // Démarrer le serveur WebSocket
//     $command = 'php chat-server.php > /dev/null 2>&1 & echo $!';
//     $output = shell_exec($command);
//     echo "Server started with PID: " . $output;
// } else {
//     echo "Server is already running with PID: " . $output;
// }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Chat Application</title>
    <style>
        #chat {
            width: 500px;
            margin: 0 auto;
            border: 1px solid #ccc;
            padding: 10px;
        }

        #users {
            margin-bottom: 10px;
        }

        #messages {
            height: 300px;
            border: 1px solid #ccc;
            overflow-y: scroll;
            margin-bottom: 10px;
        }

        #message {
            width: calc(100% - 60px);
        }
    </style>
</head>
<body>
    <div id="chat">
        <div id="users"></div>
        <div id="messages"></div>
        <input type="text" id="message" placeholder="Type a message...">
        <button id="send">Send</button>
        <button id="connect">Connect</button>
        <button id="disconnect">Disconnect</button>
    </div>
    <script src="admin_dashboard_assets/js/test_web.js"></script>
</body>
</html>
