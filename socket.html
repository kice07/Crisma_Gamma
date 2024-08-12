import express from 'express';
import { createServer } from 'http';
import { Server } from 'socket.io';
import cors from 'cors';

const app = express();
const server = createServer(app);

// Configurer CORS pour Express
app.use(cors({
  origin: '*', // Permet toutes les origines
}));

// Configurer Socket.IO
const io = new Server(server, {
  cors: {
    origin: '*', // Permet toutes les origines
  }
});

io.on('connection', (socket) => {
  console.log('a user connected');
  socket.on('disconnect', () => {
    console.log('user disconnected');
  });
});

app.get('/', (req, res) => {
  res.send('Hello World!');
});

server.listen(3000, () => {
  console.log('listening on *:3000');
});
