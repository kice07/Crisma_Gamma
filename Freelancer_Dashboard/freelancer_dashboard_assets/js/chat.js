// start: Coversation



// Load conversation
// document.querySelectorAll('[data-conversation]').forEach(function (item) {
//     item.addEventListener('click', function (e) {
//         e.preventDefault()
//         // document.querySelectorAll('.conversation').forEach(function (i) {
//         //     i.classList.remove('active')
//         // })
//         document.querySelector(this.dataset.conversation).classList.add('active')
//     })
// })

// // End loading conversation

// document.querySelectorAll('.conversation-form-input').forEach(function (item) {
//     item.addEventListener('input', function () {
//         this.rows = this.value.split('\n').length
//     })
// })




// document.querySelectorAll('.conversation-back').forEach(function (item) {
//     item.addEventListener('click', function (e) {
//         e.preventDefault()
//         this.closest('.conversation').classList.remove('active')
//         document.querySelector('.conversation-default').classList.add('active')
//     })
// })
// end: Coversation]




// Load users
const searchBarUser = document.querySelector(".content-sidebar-form input"),
    usersList = document.querySelector(".content-messages-list");

document.addEventListener("DOMContentLoaded", () => {

    setInterval(() => {

        let xhr = new XMLHttpRequest();

        xhr.open("GET", "freelancer_dashboard_assets/php_checking/user.php", true);
        console.log("inside");
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;

                    usersList.innerHTML = data;

                    // Search 

                    searchBarUser.onkeyup = () => {

                        let xhr = new XMLHttpRequest();

                        let user = new FormData();
                        user.append('searchTerm', searchBarUser.value);

                        xhr.open("POST", "freelancer_dashboard_assets/php_checking/search.php", true);
                        xhr.onload = () => {
                            if (xhr.readyState === XMLHttpRequest.DONE) {
                                if (xhr.status === 200) {
                                    let data = xhr.response;
                                    usersList.innerHTML = data;

                                }
                            }
                        }
                        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                        xhr.send(user);

                    }

                }
            }
        }
        xhr.send();


    }, 500);

});



// Sendind preparation

function loadMsg(chatBox, persoId) {

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "freelancer_dashboard_assets/php_checking/get-chat.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                chatBox.innerHTML = data;

                // scrollToBottom();

            }
        }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("incoming_id=" + persoId);
}


function sendMsg(file, Ftype, Fsize, Fname, incoming_id, inputField, chatBox) {
    const heureLocale = new Date();
    const heures = heureLocale.getHours();
    const minutes = heureLocale.getMinutes();
    var time = heures + ":" + minutes;
    var day = heureLocale.getDate(); // Obtient le jour du mois (de 1 à 31)
    var month = heureLocale.getMonth() + 1; // Obtient le mois (de 0 à 11, donc ajoute 1 pour obtenir le mois réel)
    var year = heureLocale.getFullYear()


    var type = (Ftype !== "") ? Ftype : "text";
    var size = (Fsize !== 0) ? Fsize : 0;
    var msg = (Fname !== "") ? Fname : inputField.value;
    var state = "unread";

    let xhr = new XMLHttpRequest();

    let sendMessage = new FormData();
    sendMessage.append('date', time);
    sendMessage.append('day', day);
    sendMessage.append('month', month);
    sendMessage.append('year', year);
    sendMessage.append('message', msg);
    sendMessage.append('company', incoming_id);
    sendMessage.append('state', state);
    sendMessage.append('type', type);
    sendMessage.append('size', size);
    sendMessage.append('file', file);

    console.log(time + " " + msg + " " + state + " " + type + " " + size)
    xhr.open("POST", "freelancer_dashboard_assets/php_checking/insert-chat.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                console.log("done");
                inputField.value = "";
                if (xhr.response == "success") {

                    loadMsg(chatBox, incoming_id);
                }

                console.log(xhr.response);


            }
        }
    }

    xhr.send(sendMessage);


}









var IschatCreated = false,
    persoId,
    conversation = "";



function createChat(element) {

    persoId = element.firstElementChild.getAttribute("perso_id");

    // unread matter 
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "freelancer_dashboard_assets/php_checking/update.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                if (data == "success") {
                    var more = element.querySelector(".content-message-more");
                    var child = more.querySelector(".content-message-unread");
                    if (child) {
                        more.removeChild(child);
                    }

                } else {
                    console.log(data)
                }



            }
        }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("company=" + persoId);




    var parent = document.querySelector(".chat-content");
    console.log(parent.childElementCount);
    parent.children[1].style.display = "none";
    if (parent.childElementCount !== 2) {
        parent.removeChild(parent.lastElementChild);
    }


    const conversationDiv = document.createElement('div');
    conversationDiv.classList.add('conversation');
    conversationDiv.classList.add('active');
    conversationDiv.id = (element.firstElementChild.getAttribute("data-conversation")).slice(1);

    var name = element.querySelector(".content-message-name").innerHTML;

    var picturePath = element.querySelector(".content-message-image").getAttribute("src");

    var statut = element.firstElementChild.getAttribute("statut");


    conversation = `  <div class="conversation-top">
                                <button type="button" class="conversation-back" ><i class="ri-arrow-left-line"></i></button >
                                <div class="conversation-user"> 
                                    <img class="conversation-user-image" src="${picturePath}" alt="">
                                    <div>
                                        <div class="conversation-user-name">${name}</div>
                                        <div class="conversation-user-status online translate">${statut}</div>
                                    </div>
                                </div>
                                <div class="conversation-buttons">
                                    <button type="button"><i class="ri-vidicon-line"></i></button>
                                    <button type="button"><i class="ri-information-line"></i></button>
                                </div>
                        </div>
                        <div class="conversation-main">
                                <ul class="conversation-wrapper">
                                    

                                </ul>
                        </div>
                        <div class="conversation-form">
                              <input type="file" id="fileInput" accept="application/pdf" style="display: none;">
                              <button type="button" class="conversation-form-button"><i class="fa-solid fa-paperclip"></i></button>
                              <div class="conversation-form-group">
                                  <textarea class="conversation-form-input" rows="1" placeholder="Ecrire ici..."></textarea>
                                  <button type="button" class="conversation-form-record"><i class="ri-mic-line"></i></button>
                              </div>
                              <button type="button" class="conversation-form-button conversation-form-submit"><i class="ri-send-plane-2-line"></i></button>
                        </div>`;

    conversationDiv.innerHTML = conversation;

    parent.appendChild(conversationDiv);

    IschatCreated = true;
    var chatBox = document.querySelector(".conversation-wrapper");
    // var inchat = chatBox.innerHTML;

    if (IschatCreated) {


        let xhr = new XMLHttpRequest();
        xhr.open("POST", "freelancer_dashboard_assets/php_checking/get-chat.php", true);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    // inchat += data;
                    chatBox.innerHTML = data;


                }
            }
        }
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send("incoming_id=" + persoId);
    }



    //Chat_options

    document.querySelectorAll('.conversation-item-dropdown-toggle').forEach(function (item) {
        item.addEventListener('click', function (e) {
            e.preventDefault()
            if (this.parentElement.classList.contains('active')) {
                this.parentElement.classList.remove('active')
            } else {
                document.querySelectorAll('.conversation-item-dropdown').forEach(function (i) {
                    i.classList.remove('active')
                })
                this.parentElement.classList.add('active')
            }
        })
    })

    // A revoir
    document.addEventListener('click', function (e) {
        if (!e.target.matches('.conversation-item-dropdown, .conversation-item-dropdown *')) {
            document.querySelectorAll('.conversation-item-dropdown').forEach(function (i) {
                i.classList.remove('active')
            })
        }
    })


    //  sending
    var Fname = "",
        Ftype = "",
        Fsize = 0;


    var inputField = document.querySelector(".conversation-form-input"),
        sendBtn = document.querySelector(".conversation-form-submit");

    var paper_clip = document.querySelector(".conversation-form-button");
    paper_clip.addEventListener("click", () => {
        document.getElementById('fileInput').click();
    });


    var file;
    document.getElementById('fileInput').addEventListener('change', function () {
        file = this.files[0];
        if (file && file.type === 'application/pdf') {
            // Fichier PDF sélectionné
            Ftype = "file"
            Fname = file.name;
            inputField.value = file.name;
            Fsize = file.size / 1024;

        } else {
            alert('Veuillez sélectionner un fichier PDF.');
            this.value = ''; // Effacer la sélection pour permettre la sélection ultérieure du fichier
        }
    });


    sendBtn.onclick = () => {
        sendMsg(file, Ftype, Fsize, Fname, persoId, inputField, chatBox);
    }


    //Autoload

    setInterval(() => {

        console.log("inside2");
        loadMsg(chatBox, persoId);

    }, 500);



}

