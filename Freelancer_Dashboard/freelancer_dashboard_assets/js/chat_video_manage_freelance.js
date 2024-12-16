var chatBox = document.querySelector(".message_box");
var lastButton = chatBox.querySelector(".goDown");
var previousDate = ''
var compId = ''
var myId = document.querySelector(".chat_bloc").getAttribute("myId");
var unread = 0
//formater la date pour le separator
function formatDate(dateString) {
    // Décompose la date en jour, mois et année
    const [day, month, year] = dateString.split('/');

    // Tableau des mois en français
    const mois = [
        'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin',
        'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'
    ];

    // Récupère le nom du mois (le mois est 0-indexé, donc on soustrait 1)
    const monthName = mois[parseInt(month, 10) - 1];

    // Formate la date
    return `${day} ${monthName}, ${year}`;
}

//placer le chat en tete de fil de disscussion et update preview
function findChildIndex(id) {
    const ul = document.querySelector('.users_list ul');
    const items = Array.from(ul.children); // Convert HTMLCollection to Array
    const itemToFind = Array.from(ul.children).find(item => item.getAttribute("compId") === id);
    const index = items.indexOf(itemToFind);

    return index;
}

function moveToFirstPosition(index) {
    const ul = document.querySelector('.users_list ul');
    const items = ul.getElementsByTagName('li');

    // Vérifiez que l'index est valide
    if (index < 0 || index >= items.length) {
        console.error('Invalid index');
        return;
    }

    // Récupère l'élément à l'index spécifié
    const elementToMove = items[index];

    // Vérifie si l'élément est déjà le premier enfant
    if (index === 0) {
        console.log('Element is already in the first position');
        return;
    }

    // Déplace l'élément à la première position
    ul.insertBefore(elementToMove, ul.firstChild);
}

function updatePreview(index, message, heure, object, unread) {
    const ul = document.querySelector('.users_list ul');
    const itemToFind = Array.from(ul.children).find(item => item.getAttribute("compId") === index);
    itemToFind.querySelector(".up span").textContent = heure;
    itemToFind.querySelector(".bottom span:first-child").textContent = message;





    var headInfos = document.querySelector(".chat_bloc .right .up .info");
    if (headInfos.getAttribute("compId") != index) {
        unread = parseInt(itemToFind.getAttribute("unread"));
        if (unread == 0) {
            var spanElement = itemToFind.querySelector(".bottom .counter");
            spanElement.classList.remove("invisible");
            spanElement.textContent = unread + 1;
            itemToFind.setAttribute("unread", unread + 1);


        } else {
            itemToFind.querySelector(".bottom .counter").textContent = unread + 1;
        }

        unread++;
        // headInfos.querySelector("i").classList.add("offline");
    }

}

//precision du separateur
function parseDate(dateStr) {
    const [day, month, year] = dateStr.split('/').map(Number);
    return new Date(year, month - 1, day);
}

function checkDate(dateStr) {
    const inputDate = parseDate(dateStr);
    const today = new Date();
    const yesterday = new Date(today);
    yesterday.setDate(today.getDate() - 1);

    // Set hours, minutes, and seconds to 0 for accurate comparison
    today.setHours(0, 0, 0, 0);
    yesterday.setHours(0, 0, 0, 0);

    // Compare dates
    if (inputDate.getTime() === today.getTime()) {
        return 'Aujourd\'hui';
    } else if (inputDate.getTime() === yesterday.getTime()) {
        return 'Hier';
    } else {
        return dateStr;
    }
}

//former le template du separateur
function buildSeparator(date) {
    var divider = document.createElement('div');
    divider.className = 'divider';

    const line1 = document.createElement('div');
    line1.className = 'line';

    const dateText = document.createElement('p');
    dateText.textContent = date;

    const line2 = document.createElement('div');
    line2.className = 'line';

    // Assemblage du diviseur
    divider.appendChild(line1);
    divider.appendChild(dateText);
    divider.appendChild(line2);
    return divider;
}

//former le template d'un message de type text
function buildTextMessage(msg, time, side) {
    // Créer les éléments
    var msgText = document.createElement('div');
    msgText.className = 'msg_text ' + ((side == "me") ? "outgoing" : "incoming");

    const messageParagraph = document.createElement('p');
    messageParagraph.textContent = msg;

    const detailsDiv = document.createElement('div');
    detailsDiv.className = 'details';

    const timeSpan = document.createElement('span');
    timeSpan.textContent = time;

    const icon = document.createElement('i');
    icon.className = 'ai-double-check';

    // Assembler les éléments
    detailsDiv.appendChild(timeSpan);
    detailsDiv.appendChild(icon);

    msgText.appendChild(messageParagraph);
    msgText.appendChild(detailsDiv);

    return msgText;
}

//former le template d'un message de type file
function buildFileMessage(name, size, time, side) {
    // Création de l'élément principal
    var msgFile = document.createElement('div');
    msgFile.className = 'msg_file ' + ((side == "me") ? "outgoing" : "incoming");;

    // Création des sous-éléments
    const doubleLayer = document.createElement('div');
    doubleLayer.className = 'double_layer';

    const upDiv = document.createElement('div');
    upDiv.className = 'up';

    const img = document.createElement('img');
    img.src = 'admin_dashboard_assets/images/other/rar.png';

    const fileInfo = document.createElement('div');
    fileInfo.className = 'file_info';

    const fileName = document.createElement('p');
    fileName.textContent = name;

    const fileSize = document.createElement('span');
    fileSize.textContent = size + ' ko, Document PDF';

    const actionDiv = document.createElement('div');
    actionDiv.className = 'action';

    const openButton = document.createElement('button');
    openButton.className = 'translate';
    openButton.textContent = 'Ouvrir';

    const saveButton = document.createElement('button');
    saveButton.className = 'translate';
    saveButton.textContent = 'Enregistrer sous';

    // Assemblage de la partie haute
    fileInfo.appendChild(fileName);
    fileInfo.appendChild(fileSize);

    upDiv.appendChild(img);
    upDiv.appendChild(fileInfo);

    actionDiv.appendChild(openButton);
    actionDiv.appendChild(saveButton);

    // Ajout de la partie haute et actions au double_layer
    doubleLayer.appendChild(upDiv);
    doubleLayer.appendChild(actionDiv);

    // Création de la partie basse
    const downDiv = document.createElement('div');
    downDiv.className = 'down';

    const incomingMessage = document.createElement('p');
    incomingMessage.textContent = 'Message entrant'; //le message en bas du fichier (optionel)

    const detailsDiv = document.createElement('div');
    detailsDiv.className = 'details';

    const timeSpan = document.createElement('span');
    timeSpan.textContent = time;

    const icon = document.createElement('i');
    icon.className = 'ai-double-check';

    // Assemblage de la partie basse
    detailsDiv.appendChild(timeSpan);
    detailsDiv.appendChild(icon);

    downDiv.appendChild(incomingMessage);
    downDiv.appendChild(detailsDiv);

    // Assemblage de l'élément principal
    msgFile.appendChild(doubleLayer);
    msgFile.appendChild(downDiv);

    return msgFile;
}

//former le template d'un message de type contract
function buidlContractMessage(msg, time) {
    // Création de l'élément principal
    const msgContract = document.createElement('div');
    msgContract.className = 'msg_contract incoming';

    // Création des sous-éléments
    const doubleLayer = document.createElement('div');
    doubleLayer.className = 'double_layer';

    const upDiv = document.createElement('div');
    upDiv.className = 'up';

    const img = document.createElement('img');
    img.src = 'admin_dashboard_assets/images/other/briefcase.png';

    const fileInfo = document.createElement('div');
    fileInfo.className = 'file_info';

    const contractTitle = document.createElement('p');
    contractTitle.textContent = msg;

    const contractType = document.createElement('span');
    contractType.className = 'translate';
    contractType.textContent = "offre d'emploi";

    const actionDiv = document.createElement('div');
    actionDiv.className = 'action';

    const openButton = document.createElement('button');
    openButton.textContent = 'Ouvrir';

    const saveButton = document.createElement('button');
    saveButton.textContent = 'Enregistrer sous';

    // Assemblage de la partie haute
    fileInfo.appendChild(contractTitle);
    fileInfo.appendChild(contractType);

    upDiv.appendChild(img);
    upDiv.appendChild(fileInfo);

    actionDiv.appendChild(openButton);
    actionDiv.appendChild(saveButton);

    // Ajout de la partie haute et actions au double_layer
    doubleLayer.appendChild(upDiv);
    doubleLayer.appendChild(actionDiv);

    // Création de la partie basse
    const detailsDiv = document.createElement('div');
    detailsDiv.className = 'details';

    const timeSpan = document.createElement('span');
    timeSpan.textContent = time;

    const icon = document.createElement('i');
    icon.className = 'ai-double-check';

    // Assemblage de la partie basse
    detailsDiv.appendChild(timeSpan);
    detailsDiv.appendChild(icon);

    // Assemblage de l'élément principal
    msgContract.appendChild(doubleLayer);
    msgContract.appendChild(detailsDiv);

}



const socket = io('https://crismawork.com', {
    auth: {
        token: 'crisma_token'
    },
    query: {
        userId: "F_" + myId
    },
    transports: ['websocket'], // Assurez-vous d'utiliser le transport WebSocket pour des connexions plus persistantes
    reconnection: true, // Activer la reconnexion automatique
    reconnectionAttempts: Infinity, // Tenter de se reconnecter indéfiniment
    reconnectionDelay: 1000, // Délai entre les tentatives de reconnexion
    reconnectionDelayMax: 5000 // Délai maximal entre les tentatives de reconnexion
});

socket.on('connect', () => {
    socket.emit('user_connected', {
        id: "F_" + myId,
        timezone: Intl.DateTimeFormat().resolvedOptions().timeZone,
    });

    socket.emit('fetch companies', myId); // Fetch freelancers when connected

    console.log('Connected to server2');
});

//====load la liste des freelancer
socket.on('companies list', (companiesList) => {

    var user_list = document.querySelector(".users_list ul");
    for (var company of companiesList) {
        var li = document.createElement('li');
        li.setAttribute('compId', company.id);
        li.setAttribute('unread', company.unread);
        li.setAttribute('status', company.status);
        li.addEventListener('click', function () {
            openConversation(this);
        });

        if (parseInt(company.unread) == 0) {
            li.innerHTML = `
                    <img src="../Admin_Dashboard/admin_dashboard_assets/images/company/${company.image}" alt="">
                    <div class="info">
                       
                        <div class="up">
                            <p>${company.nom}</p>
                            <span class="translate">${(checkDate(company.date) == 'Aujourd\'hui') ? company.heure : ((checkDate(company.date) == 'Hier') ? 'Hier' : company.date)}</span>
                        </div>
                        
                        <div class="bottom">
                            <span>${company.message}</span>
                            <span class="counter invisible">${company.unread}</span>
                        </div>
                    </div>`;

        } else {
            li.innerHTML = `
                    <img src="../Admin_Dashboard/admin_dashboard_assets/images/company/${company.image}" alt="">
                    <div class="info">
                       
                        <div class="up">
                            <p>${company.nom}</p>
                            <span class="translate">${(checkDate(company.date) == 'Aujourd\'hui') ? company.heure : ((checkDate(company.date) == 'Hier') ? 'Hier' : company.date)}</span>
                        </div>
                        
                        <div class="bottom">
                            <span>${company.message}</span>
                            <span class="counter">${company.unread}</span>
                        </div>
                    </div>`;

        }

        user_list.appendChild(li);

    }

});


//=== user connection & deconnexion
socket.on('new user connection', (userId) => {
    if (window.getComputedStyle(document.querySelector(".right .no_content")).display == "none") {
        var headInfos = document.querySelector(".chat_bloc .right .up .info");
        if (headInfos.getAttribute("compId") == userId) {
            headInfos.querySelector("span").textContent = "online";
            headInfos.querySelector("i").classList.add("online");
            // headInfos.querySelector("i").classList.add("offline");
        }

    };


});

socket.on('new user deconnexion', (userId) => {

    if (window.getComputedStyle(document.querySelector(".right .no_content")).display == "none") {
        var headInfos = document.querySelector(".chat_bloc .right .up .info");
        if (headInfos.getAttribute("compId") == userId) {
            headInfos.querySelector("span").textContent = "offline";
            headInfos.querySelector("i").classList.remove("online");

        }

    };


});



//===========Load chat

function openConversation(element) {

    //baisser le voile
    if (window.getComputedStyle(document.querySelector(".right .no_content")).display == "block") document.querySelector(".right .no_content").style.display = "none";
    if (element.querySelector(".bottom").children.length == 2)
        //  (element.querySelector(".bottom")).removeChild(element.querySelector(".bottom .counter"));
        element.querySelector(".bottom .counter").style.display = "none";

    var headInfos = document.querySelector(".chat_bloc .right .up .info");
    headInfos.setAttribute('compId', element.getAttribute("compId"))
    compId = headInfos.getAttribute('compId');
    headInfos.querySelector("img").src = element.querySelector("img").src;
    headInfos.querySelector("p").textContent = element.querySelector(".up p").textContent;
    headInfos.querySelector("span").textContent = element.getAttribute("status");
    var status = headInfos.querySelector("span").textContent;
    if (status === "online") headInfos.querySelector("i").classList.add("online");



    socket.emit("load chat", element.getAttribute("compId"));
}

socket.on('full chat', (messagesList) => {

    //enlever les elements au milieu
    const searchMessagePopup = document.querySelector('.search_message_popup');
    var nextElement = searchMessagePopup.nextSibling; // Le premier élément après search_message_popup
    while (nextElement && nextElement !== lastButton) {
        const elementToRemove = nextElement;
        nextElement = nextElement.nextSibling; // Obtenir l'élément suivant avant de supprimer
        if (elementToRemove.nodeType === 1) { // Vérifier si c'est un élément (nodeType 1)
            elementToRemove.remove(); // Supprimer l'élément
        }
    }
    chatBox.insertBefore(buildSeparator(checkDate(messagesList[0].date)), lastButton);

    //premier separateur et variable pour detecter le besoin d'un separateur
    previousDate = messagesList[0].date;

    for (var message of messagesList) {
        //changement de date , construction de separator
        if (previousDate != message.date) {
            chatBox.insertBefore(buildSeparator(checkDate(message.date)), lastButton);
            previousDate = message.date;
        }

        //insertion de messages
        if (message.type == "text") {
            chatBox.insertBefore(buildTextMessage(message.message, message.time, message.sentBy), lastButton);
            previousDate = message.date;
        } else if (message.type == "file") {
            chatBox.insertBefore(buildFileMessage(message.message, message.size, message.time, message.sentBy), lastButton);
            previousDate = message.date;
        } else {
            chatBox.insertBefore(buidlContractMessage(message.message, message.time), lastButton);
            previousDate = message.date;
        }

    }

    chatBox.scrollTo({
        top: chatBox.scrollHeight,
        behavior: 'smooth' // Défilement fluide
    });



    //===== send message 
    var sendButton = document.querySelector(".down .send .bx-send");
    
    var maintenant = new Date();
    var jour = String(maintenant.getDate()).padStart(2, '0'); // Jour du mois (01-31)
    var mois = String(maintenant.getMonth() + 1).padStart(2, '0'); // Mois (01-12) (les mois commencent à 0, donc +1)
    var annee = maintenant.getFullYear(); // Année
    var formattedDate = `${jour}/${mois}/${annee}`;
    var heures = String(maintenant.getHours()).padStart(2, '0'); // Heures (00-23)
    var minutes = String(maintenant.getMinutes()).padStart(2, '0'); // Minutes (00-59)
    var formattedTime = `${heures}:${minutes}`;

    sendButton.addEventListener("click", () => {
        var sendMessage = document.querySelector(".down .send textarea").value;
        console.log(sendMessage)
        if (sendMessage !== '') {
            socket.emit('send message', {
                incoming_id: compId,
                msg: sendMessage,
                date: formattedDate,
                time: formattedTime,
                status: 'read'
            })

            document.querySelector(".down .send textarea").value = "";

        }
    })

});


socket.on('message sent', (msg) => {
    //inserer un separateur si on est a un nouveau jour
    if (previousDate != msg.date) {
        chatBox.insertBefore(buildSeparator(checkDate(msg.date)), lastButton);
        previousDate = msg.date;
    }
    //inserer le message envoyé
    chatBox.insertBefore(buildTextMessage(msg.content, msg.time, 'me'), lastButton);
    previousDate = msg.date;

    //scroller jusqu'en bas
    chatBox.scrollTo({
        top: chatBox.scrollHeight,
        behavior: 'smooth'
    });

    //placer la conversation en tete de fil
    moveToFirstPosition(findChildIndex(msg.incoming_id));

    //update l'aperçu
    // updatePreview(msg.incoming_id, msg.content, msg.time);
    updatePreview(msg.incoming_id, msg.content, msg.time, document.querySelector(".right .no_content"), unread);
});

socket.on('message received', (msg) => {
    if (previousDate != msg.date) {
        chatBox.insertBefore(buildSeparator(checkDate(msg.date)), lastButton);
        previousDate = msg.date;
    }
    chatBox.insertBefore(buildTextMessage(msg.content, msg.time, 'other'), lastButton);
    previousDate = msg.date;
    chatBox.scrollTo({
        top: chatBox.scrollHeight,
        behavior: 'smooth' // Défilement fluide
    });

    moveToFirstPosition(findChildIndex(msg.sender));

    //update l'aperçu
    updatePreview(msg.sender, msg.content, msg.time, document.querySelector(".right .no_content"), unread);

});

// Example of sending a message

//video call
let otherThumb = "";
var room = "";

var videoStream;

socket.on('upcoming call', (caller_infos) => {
    otherThumb = caller_infos.thumb;
    room = caller_infos.id;

    var videoCallBox = document.createElement('div');
    videoCallBox.classList.add('lobby_box');
    videoCallBox.innerHTML = `
                <div class="text">
                    <div class="logo">
                        <img src="freelancer_dashboard_assets/images/crislogo.png" alt="">
                        <p>crismaWork</p>
                    </div>
                    <p>Chiffrement bout en bout</p>
                </div>

                <div class="video_box">
                    <video id="video" autoplay muted></video>
                    <img src="../Admin_Dashboard/admin_dashboard_assets/images/company/${caller_infos.thumb}" alt="">
                    <p>${caller_infos.caller_name}</p>
                </div>

                <div class="actions">
                    <button room="${caller_infos.roomId}" onclick="acceptCall('${otherThumb}')">
                        <i class='bx bxs-video'></i>
                    </button>
                    <button onclick="closeWaitingScreen(this)">
                        <i class='bx bxs-phone'></i>
                    </button>
                </div>`;

    document.querySelector(".main_content").appendChild(videoCallBox);

    // Activer le flux vidéo
    navigator.mediaDevices.getUserMedia({ video: true })
        .then((stream) => {
            videoStream = stream;
            const videoElement = document.getElementById("video");
            videoElement.srcObject = stream;
            videoElement.play();
        })
        .catch((error) => {
            console.error("Erreur lors de l'accès à la caméra :", error);
        });

    console.log("flux actuel 1 =" + videoStream)
});

socket.on('missed call', (missed_call_data) => {
    if (missed_call_data) {
        console.log("Missed call reçu");

        // Masquer ou supprimer la boîte de lobby
        const lobbyBox = document.querySelector(".lobby_box");
        if (lobbyBox) {
            document.querySelector(".main_content").removeChild(lobbyBox)
        }

        console.log("flux actuel 2 =" + videoStream)
        // Désactiver le flux vidéo s'il est actif
        if (videoStream && videoStream.getTracks) {
            videoStream.getTracks().forEach(track => track.stop());
            console.log("Le flux vidéo est désactivé.");
            videoStream = null; // Réinitialiser la variable
        } else {
            console.log("Le flux n'esst pas activé")
        }
    }
});


function acceptCall(othumb) {
    document.querySelector(".main_content").removeChild(document.querySelector(".lobby_box"));
    handleVideoCall(othumb);
}
let isCallEnded = false;
function handleVideoCall(a) {
    console.log("isCallEnded = "+ isCallEnded)
    if (isCallEnded) return;
    var thumbnail = document.querySelector(".chat_bloc").getAttribute("myPic");
    // let APP_ID = "7809ec5c24994fd1824aac3ae4132fec";
    let APP_ID = "31c40e8c8bba4826aaa7f209a7518701";

    let token = null;
    let uid = String(Math.floor(Math.random() * 10000))

    let client;
    let channel;
    let sharingScreen = false

    let localStream;
    let remoteStream;
    let peerConnection;

    const servers = {
        iceServers: [
            {
                urls: ['stun:stun1.l.google.com:19302', 'stun:stun2.l.google.com:19302']
            }
        ]
    }


    let constraints = {
        video: {
            width: { min: 640, ideal: 1920, max: 1920 },
            height: { min: 480, ideal: 1080, max: 1080 },
        },
        audio: true
    }

    // Initialize Agora and set up peer connection
    let init = async () => {
        if (isCallEnded) return;
        createCallUI();
        client = await AgoraRTM.createInstance(APP_ID)
        await client.login({ uid, token })
        channel = client.createChannel(room)
        await channel.join()

        channel.on('MemberJoined', handleUserJoined)
        channel.on('MemberLeft', handleUserLeft)
        channel.on('ChannelMessage', handleChannelMessage)
        client.on('MessageFromPeer', handleMessageFromPeer)

        localStream = await navigator.mediaDevices.getUserMedia(constraints)
        document.querySelector('.video_call_box .user-1 .video').srcObject = localStream
    }


    let handleUserLeft = (MemberId) => {
        document.querySelector('.video_call_box .user-2 .video').style.display = 'none'
    }

    let handleMessageFromPeer = async (message, MemberId) => {

        message = JSON.parse(message.text);
        if (message.type === 'offer') createAnswer(MemberId, message.offer);
        if (message.type === 'answer') addAnswer(message.answer);
        if (message.type === 'candidate' && peerConnection) peerConnection.addIceCandidate(message.candidate);
    }

    let handleChannelMessage = async (messageData, MemberId) => {
        console.log('New message from ' + MemberId);
        let { type, status } = JSON.parse(messageData.text);

        let userSide = document.querySelector('.video_call_box .user-2');

        if (type === 'camera') {
            userSide.firstElementChild.style.opacity = (status === 'on') ? 0 : 1;
            if (status === 'off') userSide.firstElementChild.querySelector("img").src = `../Admin_Dashboard/admin_dashboard_assets/images/company/${a}`;
        }

        if (type === 'mic') {
            userSide.style.border = (status === 'on') ? '1px solid transparent' : '1px solid red';
            userSide.querySelector('i').style.display = (status === 'on') ? 'none' : 'block';
        }

    }

    let handleUserJoined = async (MemberId) => {
        console.log('A new user joined the channel:', MemberId)
        createOffer(MemberId)
    }


    // Peer connection functions
    const createPeerConnection = async (MemberId) => {
        peerConnection = new RTCPeerConnection(servers);
        remoteStream = new MediaStream();
        document.querySelector(".video_call_box .user-2 video").srcObject = remoteStream;
        document.querySelector('.video_call_box .user-2').style.display = 'block';

        if (!localStream) {
            localStream = await navigator.mediaDevices.getUserMedia({ video: true, audio: true });
            document.querySelector(".video_call_box .user-1 video").srcObject = localStream;
        }

        localStream.getTracks().forEach((track) => peerConnection.addTrack(track, localStream));
        peerConnection.ontrack = (event) => event.streams[0].getTracks().forEach((track) => remoteStream.addTrack(track));
        peerConnection.onicecandidate = async (event) => {
            if (event.candidate) client.sendMessageToPeer({ text: JSON.stringify({ 'type': 'candidate', 'candidate': event.candidate }) }, MemberId);
        };
        startCallTimer();
    };

    const createOffer = async (MemberId) => {
        await createPeerConnection(MemberId);
        let offer = await peerConnection.createOffer();
        await peerConnection.setLocalDescription(offer);
        client.sendMessageToPeer({ text: JSON.stringify({ 'type': 'offer', 'offer': offer }) }, MemberId);
    };

    const createAnswer = async (MemberId, offer) => {
        await createPeerConnection(MemberId);

        if (peerConnection.signalingState === "stable") {
            await peerConnection.setRemoteDescription(new RTCSessionDescription(offer));
        }

        let answer = await peerConnection.createAnswer();
        await peerConnection.setLocalDescription(answer);
        client.sendMessageToPeer({ text: JSON.stringify({ 'type': 'answer', 'answer': answer }) }, MemberId);
    };

    const addAnswer = async (answer) => {
        if (!peerConnection.currentRemoteDescription) peerConnection.setRemoteDescription(answer);
    };

    let leaveChannel = async () => {
        stopCallTimer();
        isCallEnded = true;

        if (localStream) {
            localStream.getTracks().forEach(track => track.stop());
            localStream = null;
        }

        // Stop screen sharing if active
        if (sharingScreen && screenStream) {
            screenStream.getTracks().forEach(track => track.stop());
            screenStream = null;
            sharingScreen = false;
        }

        // Close the peer connection
        if (peerConnection) {
            peerConnection.close();
            peerConnection = null;
        }

        // Leave the Agora channel and log out from Agora client
        if (channel) {
            channel.leave();
            channel = null;
        }
        if (client) {
            client.logout();
            client = null;
        }

        // Stop the call timer

        
        document.querySelector(".main_content").removeChild(document.querySelector(".video_call_box"))


    }


    // Media control functions
    const toggleCamera = async () => {
        let videoTrack = localStream.getTracks().find(track => track.kind === 'video');
        const userSide = document.querySelector('.video_call_box .user-1').firstElementChild;
        videoTrack.enabled = !videoTrack.enabled;
        userSide.style.opacity = videoTrack.enabled ? 0 : 1;
        const status = videoTrack.enabled ? 'on' : 'off';
        userSide.querySelector("img").src = `admin_dashboard_assets/images/company/${thumbnail}`;
        document.getElementById('camera-btn').classList.toggle("toggled");
        await channel.sendMessage({ text: JSON.stringify({ type: 'camera', status, pic: thumbnail }) });
    };

    const toggleMic = async () => {
        let audioTrack = localStream.getTracks().find(track => track.kind === 'audio');
        console.log(audioTrack)
        audioTrack.enabled = !audioTrack.enabled;
        const micStatus = audioTrack.enabled ? 'on' : 'off';
        document.getElementById('mic-btn').classList.toggle("toggled");
        document.querySelector('.video_call_box .user-1').style.border = micStatus === 'off' ? '1px solid red' : '1px solid transparent';
        document.querySelector('.video_call_box .user-1 i').style.display = micStatus === 'off' ? 'block' : 'none';
        await channel.sendMessage({ text: JSON.stringify({ type: 'mic', status: micStatus }) });
    };


    // Screen share functions
    let screenStream;
    const toggleScreenShare = async () => {
        if (!sharingScreen) {
            try {
                screenStream = await navigator.mediaDevices.getDisplayMedia({ video: true });
                let screenTrack = screenStream.getTracks()[0];
                let videoSender = peerConnection.getSenders().find(sender => sender.track.kind === 'video');
                videoSender.replaceTrack(screenTrack);
                document.querySelector('.video_call_box .user-1 video').srcObject = screenStream;
                sharingScreen = true;
                screenTrack.onended = stopScreenShare;
            } catch (error) {
                console.error("Erreur lors du partage d'écran :", error);
            }
        } else {
            stopScreenShare();
        }
    };

    const stopScreenShare = async () => {
        let videoTrack = localStream.getTracks().find(track => track.kind === 'video');
        let videoSender = peerConnection.getSenders().find(sender => sender.track.kind === 'video');
        videoSender.replaceTrack(videoTrack);
        document.querySelector('.video_call_box .user-1 video').srcObject = localStream;
        sharingScreen = false;
    };

    init();
    document.getElementById('phone-off').addEventListener('click', leaveChannel)
    document.getElementById('screen-btn').addEventListener('click', toggleScreenShare)
    document.getElementById('camera-btn').addEventListener('click', toggleCamera)
    document.getElementById('mic-btn').addEventListener('click', toggleMic)



    socket.on('ended call', (ended) => {
        console.log("ending the call")
        if (ended) {
            let lobbyBox = document.querySelector(".lobby_box");
            if (lobbyBox) {
                document.querySelector(".main_content").removeChild(lobbyBox);
            } else {
                console.log("if not lobby")
                // Stop local media tracks (camera and microphone)
                leaveChannel()
            }

        }
    })

    //Timer
    let callStartTime;
    let callTimerInterval;

    function startCallTimer() {
        callStartTime = new Date();
        callTimerInterval = setInterval(updateCallTimer, 1000);
    }

    function updateCallTimer() {
        const currentTime = new Date();
        const elapsedTime = currentTime - callStartTime;

        const hours = Math.floor(elapsedTime / (1000 * 60 * 60));
        const minutes = Math.floor((elapsedTime % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((elapsedTime % (1000 * 60)) / 1000);

        const formattedTime = `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;

        document.querySelector('.timer').innerText = formattedTime;
    }

    function stopCallTimer() {
        clearInterval(callTimerInterval);
    }
}


function createCallUI() {
    var video_ui = document.createElement('div')
    video_ui.classList.add("video_call_box")
    video_ui.innerHTML = ` <div class="text">
                                <div class="logo">
                                    <img src="freelancer_dashboard_assets/images/crislogo2.png" alt="">
                                    <p>crismaWork</p>
                                </div>
                                <p>Chiffrement bout en bout</p>
                                <div class="options">
                                    <i class="ai-minus"></i>
                                    <i class="ai-square"></i>
                                    <i class="ai-cross"></i>
                                </div>
                            </div>

                            <div class="video_box">
                                <div class="box user-1">
                                    <div class="video_paused">
                                        <img src="" alt="">
                                    </div>
                                    <i class='bx bxs-microphone-off'></i>
                                    <video class="video" autoplay playsinline></video>
                                </div>
                                <div class="box user-2">
                                    <div class="video_paused">
                                        <img src="" alt="">
                                    </div>
                                    <i class='bx bxs-microphone-off'></i>
                                    <video class="video" autoplay playsinline></video>
                                </div>
                            </div>

                            <div class="bottom">
                                <div class="timer">00:00:00</div>
                                <div class="actions">
                                    <button id="mic-btn">
                                        <i class='bx bx-microphone'></i>
                                        <i class='bx bx-microphone-off' id='sub'></i>
                                    </button>
                                    <button id="camera-btn">
                                        <i class='bx bx-video'></i>
                                        <i class='bx bx-video-off' id='sub'></i>
                                    </button>
                                    <button id="screen-btn">
                                        <i class='bx bx-cast'></i>
                                    </button>
                                    <button id="phone-off">
                                        <i class='bx bx-phone-off'></i>
                                    </button>
                                </div>

                            </div>`;
    document.querySelector(".main_content").appendChild(video_ui)
}


let sides = document.querySelectorAll(".chat_side .side");
sides.forEach(side => {
    side.addEventListener("click", () => {
        if (!side.classList.contains("active")) {
            sides.forEach(part => {
                part.classList.remove("active")
            })
            side.classList.add("active");

            if (side.querySelector("p").textContent == "Journal d'appels") {
                document.querySelector(".call_log_detail").style.display = "block";
                document.querySelector(".calls_logs_preview").style.display = "block";
                // document.querySelector(".call_log_detail").style.display = "block";
                socket.emit("fetch calls logs", myId);
            } else {
                document.querySelector(".calls_logs_preview").style.display = "none";
                document.querySelector(".call_log_detail").style.display = "none";

                document.querySelector(".calls_logs_preview ul").innerHTML = '';
                document.querySelector(".call_log_detail").innerHTML = '';
            }
        }

    })
})

socket.on('calls list', (calls_info) => {

    var call_info_list = document.querySelector(".calls_logs_preview ul");
    for (let call of calls_info) {
        var li = document.createElement('li');
        // li.setAttribute('other_one_id',);
        const displayDate = checkDate(call.date) === 'Aujourd\'hui' ? call.hour : (checkDate(call.date) === 'Hier' ? 'Hier' : call.date);
        li.innerHTML = `
            <img src="../Admin_Dashboard/admin_dashboard_assets/images/company/${call.otherPic}" alt="">
            <div class="info">
                <div class="up">
                    <p>${call.otherName}</p>
                    <span class="translate">${displayDate}</span>
                </div>
                <div class="bottom">
                    <i ${call.direction === "sortant" ? (call.state === "missed" ? 'class="fi fi-tr-video-arrow-up-right missed"' : 'class="fi fi-tr-video-arrow-up-right"')
                : (call.state === "missed" ? 'class="fi fi-tr-video-arrow-down-left missed"' : 'class="fi fi-tr-video-arrow-down-left"')}></i>
                    <span ${call.state === "missed" ? 'class="missed"' : ''}> ${call.direction === "sortant" ? "Sortant" : (call.state === "missed" ? "Manqué" : "Entrant")}</span>
                </div>
            </div>`;
        call_info_list.appendChild(li);

        li.addEventListener('click', function () {
            displayFullLog(call);
        });
    }

});

function displayFullLog(call_info) {

    let big_parent = document.querySelector(".call_log_detail");

    while (big_parent.firstChild) {
        big_parent.removeChild(big_parent.firstChild);
    }

    big_parent.style.display = "block";
    let div = document.createElement('div');
    div.classList.add("call_detail");

    let content = `<div class="up">
                    <div class="profile">
                        <img src="../Admin_Dashboard/admin_dashboard_assets/images/company/${call_info.otherPic}" alt="">
                        <p>${call_info.otherName}</p>
                    </div>
                    <div class="actions">
                        <i class="fi fi-tr-comment-alt-dots" onclick="backToChat(this)"></i>
                        <i class="fi fi-tr-video-camera-alt"></i>
                    </div>
                </div> 
                <div class="down">
                    <p>${(checkDate(call_info.date) == 'Aujourd\'hui') ? "Aujourd'hui à " + call_info.hour : ((checkDate(call_info.date) == 'Hier') ? 'Hier' + call_info.hour : call_info.date)}</p>
                    <div class="hour_state">
                        <div class="hour">`;

    if (call_info.direction == "sortant") {
        if (call_info.state == "missed") {
            content += `<i class="fi fi-tr-video-camera-alt"></i>
                    <span>Appel vidéo sortant à ${call_info.hour}</span>
                    </div>
                    <p class="duration">Sans réponse</p>`;
        } else {
            content += `<i class="fi fi-tr-video-camera-alt"></i>
            <span>Appel vidéo sortant à ${call_info.hour}</span>
            </div>
            <p class="duration">${call_info.duration}</p>`;
        }

    } else {
        if (call_info.state == "missed") {
            content += `<i class="fi fi-tr-video-arrow-down-left missed"></i>
                    <span>Appel vidéo manqué à ${call_info.hour}</span>
                    </div>
                    <p class="duration missed">Appel manqué</p>`;
        } else {
            content += `<i class="fi fi-tr-video-arrow-down-left"></i>
                    <span>Appel vidéo entrant à ${call_info.hour}</span>
                    </div>
                    <p class="duration">${call_info.duration}</p>`;
        }
    }

    content += `</div>
            </div>`;

    div.innerHTML = content;
    big_parent.appendChild(div);
} 

//upate information
function updateLogList() {
    let parent = document.querySelector(".calls_logs_preview")
    if (window.getComputedStyle(parent).display == "block") {
        var ul = document.querySelector(".calls_logs_preview ul");
        ul.innerHTML = '';
        socket.emit("fetch calls logs", myId);
    }

}


//return to chat
function backToChat(element){
    var name = element.parentElement.previousElementSibling.querySelector("p").textContent;
    var users = document.querySelectorAll(".users_list ul li");
    for(actualUser of users){
        if(actualUser.querySelector(".info .up p").textContent == name){
            big_parent =document.querySelector(".call_log_detail")
            big_parent.removeChild(big_parent.firstChild);
           document.querySelector(".chat_side .side:first-child").click();
           openConversation(actualUser);
           break;
        }
    }
}
