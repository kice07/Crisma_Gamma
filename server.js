// import express from 'express';
// import http from 'http';

// import { Server as SocketIOServer } from 'socket.io';
// // import fs from 'fs';
// import path from 'path';

// const app = express();
// const server = http.createServer(app);
// const io = new SocketIOServer(server);

// // Serve static files
// app.use(express.static(path.join(__dirname, 'index.html')));

// // Handle WebSocket connections
// io.on('connection', (socket) => {
//     console.log('New client connected');

//     socket.on('disconnect', () => {
//         console.log('Client disconnected');
//     });

//     socket.on('message', (msg) => {
//         console.log('Message received: ' + msg);
//         io.emit('message', msg); // Broadcast message to all clients
//     });
// });

// // Start server with HTTPS (if SSL certificates are provided)
// // const sslOptions = {
// //     key: fs.readFileSync('/path/to/your/key.pem'),
// //     cert: fs.readFileSync('/path/to/your/cert.pem')
// // };

// server.listen(3000, () => {
//     console.log('Server listening on port 3000');
// });

// // To use SSL, uncomment the following lines and comment the above `server.listen` line
// // const https = require('https');
// // const httpsServer = https.createServer(sslOptions, app);
// // httpsServer.listen(3000, () => {
// //     console.log('Server listening on port 3000 with SSL');
// // });


import express from 'express';
import { createServer } from 'node:http';
import { Server } from 'socket.io';
import { fileURLToPath } from 'node:url';
import { dirname, join } from 'node:path';
import cors from 'cors'; // Importer le module CORS

const app = express();
const server = createServer(app);

// Configurer CORS
app.use(cors({
    origin: 'http://localhost:3000', // Permet les connexions de tous les domaines
}));

const io = new Server(server, {
    cors: {
        origin: 'http://localhost:3000', // Permet les connexions de tous les domaines
    }
});

io.on('connection', (socket) => {
    console.log('a user connected');
    socket.on('disconnect', () => {
        console.log('user disconnected');
    });
});

const __dirname = dirname(fileURLToPath(import.meta.url));

app.get('/', (req, res) => {
    // res.send('Hello World!');
    res.sendFile(join(__dirname, 'job.html'));
});
server.listen(3000, () => {
    console.log('listening on *:3000');
});
