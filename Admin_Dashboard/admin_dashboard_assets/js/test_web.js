let conn;
let currentUserId;
let currentContactId;

document.getElementById('connect').onclick = function() {
    conn = new WebSocket('wss://46.28.41.127:8080');

    conn.onopen = function(e) {
        console.log("Connection established!");
        login(currentUserId);
        loadUsers();
    };

    conn.onmessage = function(e) {
        const data = JSON.parse(e.data);
        const messages = document.getElementById('messages');
        const message = document.createElement('div');

        if (data.type === 'message' && data.senderId === currentContactId) {
            message.textContent = `User ${data.senderId}: ${data.message}`;
            messages.appendChild(message);
        }
    };

    conn.onclose = function(e) {
        console.log("Connection closed!");
    };

    conn.onerror = function(error) {
        console.log("WebSocket Error: ", error);
    };
};

document.getElementById('disconnect').onclick = function() {
    if (conn) {
        conn.close();
    }
};

document.getElementById('send').onclick = function() {
    const messageInput = document.getElementById('message');
    const message = messageInput.value;
    conn.send(JSON.stringify({ type: 'message', receiverId: currentContactId, message: message }));
    messageInput.value = '';

    // Afficher le message dans la fenêtre de chat
    const messages = document.getElementById('messages');
    const messageElement = document.createElement('div');
    messageElement.textContent = `Me: ${message}`;
    messages.appendChild(messageElement);
};

function login(userId) {
    conn.send(JSON.stringify({ type: 'login', userId: userId }));
}

function loadUsers() {
    fetch('/api.php/users')
        .then(response => response.json())
        .then(users => {
            const usersDiv = document.getElementById('users');
            usersDiv.innerHTML = '';

            users.forEach(user => {
                const userDiv = document.createElement('div');
                userDiv.textContent = user.username;
                userDiv.onclick = function() {
                    currentContactId = user.id;
                    loadMessages(currentUserId, currentContactId);
                };
                usersDiv.appendChild(userDiv);
            });
        });
}

function loadMessages(userId, contactId) {
    fetch(`/api.php/messages?userId=${userId}&contactId=${contactId}`)
        .then(response => response.json())
        .then(messages => {
            const messagesDiv = document.getElementById('messages');
            messagesDiv.innerHTML = '';

            messages.forEach(message => {
                const messageElement = document.createElement('div');
                messageElement.textContent = `${message.sender_id === userId ? 'Me' : 'User ' + message.sender_id}: ${message.message}`;
                messagesDiv.appendChild(messageElement);
            });
        });
}

// Simuler un login (remplacer par un véritable système d'authentification)
currentUserId = 1404511236;
document.getElementById('connect').click();
