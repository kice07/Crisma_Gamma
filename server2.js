// import express from 'express';
// import { createServer } from 'http';
// import { Server } from 'socket.io';
// import cors from 'cors';

// const app = express();
// const server = createServer(app);

// // Configurer CORS pour Express
// app.use(cors({
//   origin: '*', // Permet toutes les origines
// }));

// // Configurer Socket.IO
// const io = new Server(server, {
//   cors: {
//     origin: '*', // Permet toutes les origines
//   }
// });

// io.on('connection', (socket) => {
//   console.log('a user connected');
//   socket.on('disconnect', () => {
//     console.log('user disconnected');
//   });
// });

// app.get('/', (req, res) => {
//   res.send('Hello World!');
// });

// server.listen(3000, () => {
//   console.log('listening on *:3000');
// });


import express from 'express';
import http from 'http';
import { fileURLToPath } from 'node:url';
import { dirname, join } from 'node:path';
import { Server } from 'socket.io';
import fs from 'fs';
// Créer une application Express
const app = express();

// Créer un serveur HTTP en utilisant l'application Express
const httpServer = http.createServer(app);

  

// Configurer Socket.IO avec CORS
const io = new Server(httpServer, {
  cors: {
    // origin: "http://82.112.250.144:3000", // Origine autorisée
    origin: "https://crismawork.com",
    methods: ["GET", "POST"],         // Méthodes HTTP autorisées
  }
});

// Événement de connexion de Socket.IO
io.on('connection', (socket) => {
  console.log('a user connected');

  socket.on('disconnect', () => {
    console.log('user disconnected');
  });

  socket.on('chat message', (msg) => {
    io.emit('chat message', msg);
  });

  // Vous pouvez ajouter d'autres gestionnaires d'événements ici
});

const __dirname = dirname(fileURLToPath(import.meta.url));

app.get('/', (req, res) => {
    // res.send('Hello World!');
    res.sendFile(join(__dirname, 'index.html'));
});
// Démarrer le serveur HTTP
const PORT = 3000;
httpServer.listen(PORT,'0.0.0.0', () => {
  console.log(`Server listening on port ${PORT}`);
});
