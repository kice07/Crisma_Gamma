
// import express from 'express';
// import http from 'http';
// import { fileURLToPath } from 'node:url';
// import { dirname, join } from 'node:path';
// import { Server } from 'socket.io';
// import fs from 'fs';

// const app = express();

// const httpServer = http.createServer(app);

  
// const io = new Server(httpServer, {
//   cors: {
//     origin: "https://crismawork.com",
//     methods: ["GET", "POST"],         
//   }
// });

// // Événement de connexion de Socket.IO
// io.on('connection', (socket) => {
//   console.log('a user connected');

//   socket.on('disconnect', () => {
//     console.log('user disconnected');
//   });

//   socket.on('chat message', (msg) => {
//     io.emit('chat message', msg);
//   });

// });

// const __dirname = dirname(fileURLToPath(import.meta.url));

// app.get('/', (req, res) => {
//     // res.send('Hello World!');
//     res.sendFile(join(__dirname, 'job.html'));
// });

// const PORT = 3000;
// httpServer.listen(PORT,'0.0.0.0', () => {
//   console.log(`Server listening on port ${PORT}`);
// });

import express from 'express';
import https from 'https';
import fs from 'fs';
import { fileURLToPath } from 'node:url';
import { dirname, join } from 'node:path';
import { Server } from 'socket.io';

// Créer une application Express
const app = express();

// Chemins vers vos fichiers de certificat SSL
const privateKey = fs.readFileSync('/etc/letsencrypt/live/crismawork.com/privkey.pem', 'utf8');
const certificate = fs.readFileSync('/etc/letsencrypt/live/crismawork.com/fullchain.pem', 'utf8');
// const ca = fs.readFileSync('/etc/apache2/ssl.crt/ca-bundle.crt', 'utf8');

const credentials = { key: privateKey, cert: certificate };
// const credentials = { key: privateKey, cert: certificate, ca: ca };

// Créer un serveur HTTPS en utilisant l'application Express
const httpsServer = https.createServer(credentials, app);

// Configurer Socket.IO avec CORS
const io = new Server(httpsServer, {
  cors: {
    origin: "https://crismawork.com",
    methods: ["GET", "POST"],
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
    res.sendFile(join(__dirname, 'job.html'));
});

// Démarrer le serveur HTTPS
const PORT = 3000; // Port HTTPS standard
httpsServer.listen(PORT, '0.0.0.0', () => {
  console.log(`Server listening on port ${PORT}`);
});
