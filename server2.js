import express from 'express';
import http from 'http';
import { Server } from 'socket.io';
import mysql from 'mysql2/promise';
import dotenv from 'dotenv';
// import { format, parse } from 'date-fns';
// import { utcToZonedTime , zonedTimeToUtc } from 'date-fns-tz';


dotenv.config({ path: 'config.env' });
// Créer une application Express
const app = express();

// Créer un serveur HTTP en utilisant l'application Express
const httpServer = http.createServer(app);

// Configurer Socket.IO avec CORS pour accepter les connexions locales
const io = new Server(httpServer, {
  cors: {
    origin: "https://crismawork.com:3000", // Permet les connexions depuis l'URL local
    methods: ["GET", "POST"],
  }
});

console.log('Database Host:', process.env.DB_HOST);

const db = await mysql.createConnection({
  host: process.env.DB_HOST,
  user: process.env.DB_USERNAME,
  password: process.env.DB_PASSWORD,
  database: process.env.DB_DATABASE,
});


var users = [];
function getFormattedDate() {
  const today = new Date();
  const day = String(today.getDate()).padStart(2, '0');
  const month = String(today.getMonth() + 1).padStart(2, '0'); // Les mois commencent à 0
  const year = today.getFullYear();

  return `${day}/${month}/${year}`;
}
function getHour() {
  const now = new Date();
  const hours = now.getHours().toString().padStart(2, '0');
  const minutes = now.getMinutes().toString().padStart(2, '0');
  return `${hours}:${minutes}`;
}
function changeDate(dateStr, timeStr, userTimeZone) {

  // Convertir la chaîne en un objet Date
  const [day, month, year] = dateStr.split('/').map(Number);
  const [hours, minutes] = timeStr.split(':').map(Number);
  const dateObj = new Date(Date(year, month - 1, day, hours, minutes));

  // Formater la date et l'heure en fonction du fuseau horaire de l'utilisateur
  const options = {
    year: 'numeric',
    month: '2-digit',
    day: '2-digit',
    hour: '2-digit',
    minute: '2-digit',
    timeZone: userTimeZone,
    timeZoneName: 'short'
  };

  const formatter = new Intl.DateTimeFormat('fr-FR', options);
  const formattedParts = formatter.formatToParts(dateObj);

  // Extraire la date et l'heure formatées
  const formattedDate = `${formattedParts[0].value}/${formattedParts[2].value}/${formattedParts[4].value}`;
  const formattedTime = `${formattedParts[6].value}:${formattedParts[8].value}`;

  return [formattedDate, formattedTime];
}

io.on('connection', (socket) => {
  var timezone = "";
  var userId = socket.handshake.query.userId;
  socket.userId = (userId.split("_"))[1];


  socket.on("user_connected", async (data) => {
    const user = ((data.id).split("_"))[1];
    const userType = (data.id).split("_")[0];
    timezone = data.timezone;
    // Définir le socket.userId
    socket.userId = user;

    // Mise à jour du statut en ligne dans la base de données
    if (userType === "C") {
      await db.query('UPDATE company SET status = "online" WHERE id = ?', [socket.userId]);
    } else {
      await db.query('UPDATE freelancer SET status = "online" WHERE id = ?', [socket.userId]);
    }

    // Nouvel objet utilisateur à ajouter
    const newUser = { id: user, socketId: socket.id, timezone: timezone, type: userType };

    // Vérifier si l'utilisateur est déjà présent dans le tableau
    const userExists = users.some(u => u.id === newUser.id);

    if (!userExists) {
      users.push(newUser);
    }

    //broadcast l'information de la connexion d'un new user
    for (var userData of users) {
      if (userData.type != newUser.type) {
        io.to(userData.socketId).emit('new user connection', newUser.id);
      }
    }

    console.log('User connected:', socket.id);
    console.log('users:', users);
  });

  //==== Deconnexion 
  socket.on('disconnect', async () => {
    if (userId.split("_")[0] = "C") {
      await db.query('UPDATE company SET status = "offline" WHERE id = ?', [socket.userId]);
    } else {
      await db.query('UPDATE freelancer SET status = "offline" WHERE id = ?', [socket.userId]);
    }


    var offline_user = users.find(item => item.id == socket.userId);

    //broadcast l'information de la deconnexion d'un user
    for (var userData of users) {
      if (userData.type != offline_user.type) {
        io.to(userData.socketId).emit('new user deconnexion', offline_user.id);
      }
    }
    users = users.filter(user => user.id !== socket.userId)


    console.log("deconnexion")
    console.log(users);

  });

  //==== Chargement de la liste des freelancer pour les companies
  socket.on('fetch freelancers', async (userId) => {
    const [freelancers] = await db.query(`SELECT DISTINCT e.id, e.nom, e.prenom, e.image, e.status
    FROM freelancer e
    JOIN message m ON (e.id = m.incoming_msg_id OR e.id = m.outgoing_msg_id)
    WHERE (m.incoming_msg_id = ? OR m.outgoing_msg_id = ?)
    AND e.id IS NOT NULL`,
      [userId, userId]);
    const freelancerList = [];


    for (const freelancer of freelancers) {
      // Récupération du dernier message pour chaque freelancer
      const [lastMessage] = await db.query(
        `SELECT msg AS message, date, time, outgoing_msg_id
        FROM message
        WHERE (incoming_msg_id = ? AND outgoing_msg_id = ?) OR (incoming_msg_id = ? AND outgoing_msg_id = ?)
        ORDER BY STR_TO_DATE(date, '%d/%m/%Y') DESC, STR_TO_DATE(time, '%H:%i') DESC
       LIMIT 1`,
        [freelancer.id, socket.userId, socket.userId, freelancer.id]
      );


      const [unreadDm] = await db.query(
        `SELECT count(msg_id) as unread
            FROM message
            WHERE ((incoming_msg_id = ? AND outgoing_msg_id = ?) OR (outgoing_msg_id = ? AND incoming_msg_id = ?)) AND state = 'unread'
          `,
        [freelancer.id, userId, userId, freelancer.id]
      );

      if (lastMessage.length > 0) {
        // const [newDate, newTime] = changeDate(lastMessage[0].date, lastMessage[0].time, timezone);
        const sentBy = lastMessage[0].outgoing_msg_id === userId ? 'company' : 'freelancer';
        freelancerList.push({
          id: freelancer.id,
          nom: freelancer.nom,
          prenom: freelancer.prenom,
          status: freelancer.status,
          message: lastMessage[0].message,
          date: lastMessage[0].date,
          heure: lastMessage[0].time,
          image: freelancer.image,
          sentBy: sentBy,
          unread: unreadDm[0].unread
        });
      }
    }

    // Tri des freelancers par récence des messages et ceux sans messages
    freelancerList.sort((a, b) => {
      if (a.message && b.message) {
        const [dayA, monthA, yearA] = a.date.split('/');
        const dateA = new Date(`${yearA}-${monthA}-${dayA}T${a.time}`);

        const [dayB, monthB, yearB] = b.date.split('/');
        const dateB = new Date(`${yearB}-${monthB}-${dayB}T${b.time}`)
        return dateB - dateA; // Plus récent en premier
      } else {
        return 0;
      }
    });

    // freelancerList.reverse();

    // Émettre la liste triée
    socket.emit('freelancers list', freelancerList);
  });

  

  //==== Chargement de la liste des conpanies pour les freelancers

  socket.on('fetch companies', async (userId) => {
    // Rechercher toutes les entreprises ayant échangé des messages avec le freelancer
    const [companies] = await db.query(
      `SELECT DISTINCT e.id, e.name, e.picture, e.id, e.status
        FROM company e
        JOIN message m ON (e.id = m.incoming_msg_id OR e.id = m.outgoing_msg_id)
        WHERE (m.incoming_msg_id = ? OR m.outgoing_msg_id = ?)
        AND e.id IS NOT NULL`,
      [userId, userId]
    );

    const companyList = [];

    for (const company of companies) {
      // Récupérer le dernier message échangé avec chaque entreprise
      const [lastMessage] = await db.query(
        `SELECT msg AS message, date, time, outgoing_msg_id
        FROM message
        WHERE (incoming_msg_id = ? AND outgoing_msg_id = ?) OR (incoming_msg_id = ? AND outgoing_msg_id = ?)
        ORDER BY STR_TO_DATE(date, '%d/%m/%Y') DESC, STR_TO_DATE(time, '%H:%i') DESC
       LIMIT 1`,
        [company.id, userId, userId, company.id]
      );

      const [unreadDm] = await db.query(
        `SELECT count(msg_id) as unread
            FROM message
            WHERE ((incoming_msg_id = ? AND outgoing_msg_id = ?) OR (outgoing_msg_id  = ? AND incoming_msg_id = ?)) AND state = 'unread'`,
        [company.id, socket.userId, socket.userId, company.id]
      );

      if (lastMessage.length > 0) {
        // const [newDate, newTime] = changeDate(lastMessage[0].date, lastMessage[0].time, timezone);
        const sentBy = lastMessage[0].id === userId ? 'freelancer' : 'company';
        companyList.push({
          id: company.id,
          nom: company.name,
          message: lastMessage[0].message,
          date: lastMessage[0].date,
          heure: lastMessage[0].time,
          image: company.picture,
          status: company.status,
          sentBy: sentBy,
          unread: unreadDm[0].unread
        });
      }
    }

    // Tri des entreprises par récence des messages
    companyList.sort((a, b) => {
      if (a.message && b.message) {
        const dateA = new Date(`${a.date} ${a.time}`);
        const dateB = new Date(`${b.date} ${b.time}`);
        return dateB - dateA; // Plus récent en premier
      } else {
        return 0;
      }
    });

    // companyList.reverse();

    // Émettre la liste triée
    socket.emit('companies list', companyList);
  });


  //==== Chargement d'une conversation
  socket.on('load chat', async (otherId) => {
    const [messages] = await db.query(`SELECT msg AS message, date, time, outgoing_msg_id, type, path, size
  FROM message
  WHERE (incoming_msg_id = ? AND outgoing_msg_id = ?) OR (incoming_msg_id = ? AND outgoing_msg_id = ?)`,
      [otherId, socket.userId, socket.userId, otherId]);
    const messagesList = [];

    for (const message of messages) {
      var sentBy = (message.outgoing_msg_id == socket.userId) ? 'me' : 'other';

      if (message.type === "text") {
        messagesList.push({
          message: message.message,
          type: message.type,
          size: null,
          path: null,
          date: message.date,
          time: message.time,
          sentBy: sentBy,
        });
      } else {
        messagesList.push({
          message: message.message,
          type: message.type,
          size: message.size,
          path: message.path,
          date: message.date,
          time: message.time,
          sentBy: sentBy,
        });
      }
    }

    await db.query(
      `UPDATE message
       SET state = 'read'
       WHERE 
         ((incoming_msg_id = ? AND outgoing_msg_id = ?) 
         OR 
         (outgoing_msg_id = ? AND incoming_msg_id = ?))
         AND state = 'unread'`,
      [otherId.id, socket.userId, socket.userId, otherId]
    );
    // Émettre la liste triée
    socket.emit('full chat', messagesList);
  });

  //==== send message
  socket.on('send message', async (msg_details) => {
    if (msg_details.type === "text") {
      console.log("message envoyé : \n")
      console.log(msg_details)
      try {
        // Enregistrez le message dans la base de données
        var sendTo = users.find(user => user.id === msg_details.incoming_id);
        const state = sendTo ? msg_details.status : 'unread';

        // Enregistrez le message dans la base de données
        await db.query('INSERT INTO message (incoming_msg_id, msg, outgoing_msg_id, type, state, time, date) VALUES (?, ?, ?, ?, ?, ?, ?)', [
          msg_details.incoming_id, msg_details.msg, socket.userId, 'text', state, msg_details.time, msg_details.date
        ]);

        // Informez le destinataire si en ligne
        if (sendTo) {
          const [nDate, nTime] = changeDate(msg_details.date, msg_details.time, sendTo.timezone);
          io.to(sendTo.socketId).emit('message received', {
            sender: socket.userId,
            content: msg_details.msg,
            time: nTime,
            date: nDate,
          });
        }

        var actualTimezone = users.find(user => user.id === socket.userId)?.timezone || 'UTC';
        const [newDate, newTime] = changeDate(msg_details.date, msg_details.time, actualTimezone);
        socket.emit('message sent', {
          incoming_id: msg_details.incoming_id,
          content: msg_details.msg,
          time: newTime,
          date: newDate,
          type: "text",
        });

      } catch (error) {
        console.error('Error sending message:', error);
      }
    } else {
      console.log("message envoyé : \n")
      console.log(msg_details)
      try {
        // Enregistrez le message dans la base de données
        var sendTo = users.find(user => user.id === msg_details.incoming_id);
        const state = sendTo ? msg_details.status : 'unread';

        // Enregistrez le message dans la base de données
        await db.query('INSERT INTO message (incoming_msg_id, msg, outgoing_msg_id, type, state, time, date) VALUES (?, ?, ?, ?, ?, ?, ?)', [
          msg_details.incoming_id, msg_details.msg, socket.userId, 'file', state, msg_details.time, msg_details.date
        ]);

        // Informez le destinataire si en ligne
        if (sendTo) {
          const [nDate, nTime] = changeDate(msg_details.date, msg_details.time, sendTo.timezone);
          io.to(sendTo.socketId).emit('message received', {
            sender: socket.userId,
            content: msg_details.msg,
            time: nTime,
            date: nDate,
          });
        }

        var actualTimezone = users.find(user => user.id === socket.userId)?.timezone || 'UTC';
        const [newDate, newTime] = changeDate(msg_details.date, msg_details.time, actualTimezone);
        socket.emit('message sent', {
          incoming_id: msg_details.incoming_id,
          content: msg_details.msg,
          time: newTime,
          date: newDate,
          type: "file",
        });

      } catch (error) {
        console.error('Error sending message:', error);
      }
    }

  })

  //===== start video call
  socket.on('start video call', async (data) => {
    await db.query('INSERT INTO calls (id, caller_id, called_id, date, hour, direction) VALUES (?, ?, ?, ?, ?, ?)',
      [data.id, data.callerId, data.calledId, getFormattedDate(), getHour(), "sortant"]);

    const [callerInfo] = await db.query(`SELECT name, picture FROM company
    WHERE id = ?`, [socket.userId]);

    console.log(callerInfo[0].name);
    console.log(callerInfo[0].picture);

    var sendTo = users.find(user => user.id === data.calledId);

    if (sendTo) {
      io.to(sendTo.socketId).emit('upcoming call', {
        callerId: socket.userId,
        caller_name: callerInfo[0].name,
        caller_pic: callerInfo[0].picture,
        id: data.id,
        thumb: data.pic,
      });
    } else {
      console.log("offline");
    }
  })

  //==== end video call
  socket.on('end video call', async (call_data) => {
    await db.query(
      `UPDATE calls
      SET duration = ?, state = ?
      WHERE id = ?
      ORDER BY STR_TO_DATE(date, '%d/%m/%Y') DESC, STR_TO_DATE(hour, '%H:%i') DESC
      LIMIT 1;`,
      [call_data.duration, "call", call_data.id]
    );

    var sendTo = users.find(user => user.id === call_data.called_id);

    if (sendTo) {
      console.log("ready to be sent")
      io.to(sendTo.socketId).emit('ended call', true);
    } else {
      console.log("offline");
    }
  })

  //==== no-answer call
  socket.on('no-answer call', async (call_data) => {
    await db.query(
      `UPDATE calls
      SET state = ?, duration = ?
      WHERE id = ?
      ORDER BY STR_TO_DATE(date, '%d/%m/%Y') DESC, STR_TO_DATE(hour, '%H:%i') DESC
      LIMIT 1;`,
      ["missed", "00:00:00", call_data.id]
    );

    var sendTo = users.find(user => user.id === call_data.called_id);

    if (sendTo) {
      console.log("missed call sent")
      io.to(sendTo.socketId).emit('missed call', true);
    } else {
      console.log("offline");
    }
  })

  //==== fetch calls logs 

  socket.on('fetch calls logs', async (requestId) => {
    const [calls] = await db.query(`SELECT * 
      FROM calls
      WHERE caller_id = ? OR called_id = ?
      ORDER BY STR_TO_DATE(date, '%d/%m/%Y') DESC , STR_TO_DATE(hour, '%H:%i') DESC;`,
      [requestId, requestId]);
    const logsList = [];
    for (const log of calls) {
      if (log.caller_id == requestId) {
        let otherInfo, otherPic, otherName
        if (userId.split("_")[0] == "F") {
          otherInfo = await db.query(`SELECT name, picture FROM company
            WHERE (id = ?)`, [log.called_id]);
          otherPic = `${otherInfo[0][0].picture}`;
          otherName = `${otherInfo[0][0].name}`;
        } else {
          otherInfo = await db.query(`SELECT nom, prenom, image FROM freelancer
            WHERE (id = ?)`, [log.called_id]);

          console.log(otherInfo)
          otherPic = `${(otherInfo[0][0]).image}`;
          otherName = `${(otherInfo[0][0]).nom} ${(otherInfo[0][0]).prenom}`;
        }

        logsList.push({
          otherName: otherName,
          otherPic: otherPic,
          otherId: log.called_id,
          date: log.date,
          hour: log.hour,
          duration: log.duration,
          direction: "sortant",
          state: log.state
        });

      } else {
        let otherInfo, otherPic, otherName
        if (userId.split("_")[0] == "F") {
          otherInfo = await db.query(`SELECT name, picture FROM company
            WHERE (id = ?)`, [log.caller_id]);
          console.log(otherInfo)
          otherPic = `${otherInfo[0][0].picture}`;
          otherName = `${otherInfo[0][0].name}`;
        } else {
          otherInfo = await db.query(`SELECT nom, prenom, image FROM freelancer
            WHERE (id = ?)`, [log.caller_id]);
          otherPic = `${otherInfo[0][0].image}`;
          otherName = `${otherInfo[0][0].nom} ${otherInfo[0][0].prenom}`;
        }

        logsList.push({
          otherName: otherName,
          otherPic: otherPic,
          date: log.date,
          hour: log.hour,
          duration: log.duration,
          direction: "entrant",
          state: log.state
        });

      }

    }

    console.log(logsList);

    // Émettre la liste triée
    socket.emit('calls list', logsList);
  });

});

// Serveur écoutant sur le port 3000
const PORT = 3000;
httpServer.listen(PORT, () => {
  console.log(`Server listening on http://localhost:${PORT}`);
});
