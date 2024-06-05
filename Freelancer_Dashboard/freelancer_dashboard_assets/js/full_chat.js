//send text
// Ajouter un gestionnaire d'événement pour détecter le défilement
var messageBox = document.querySelector(".message_box");
var goDownButton = document.querySelector(".goDown");
messageBox.addEventListener("scroll", () => {

    // Vérifier si on est en bas du défilement
    if (messageBox.scrollHeight - Math.ceil(messageBox.scrollTop) === messageBox.clientHeight) {
        goDownButton.style.transition = "all .3s ease-in-out";
        goDownButton.style.display = "none";
        // toBottomButton.style.opacity = "1";

    } else {
        goDownButton.style.transition = "all .3s ease-in-out";
        goDownButton.style.display = "block";
    }
});


// Auto scroll
goDownButton.addEventListener("click", function () {
    // Défilez jusqu'en bas de l'élément .message_box
    messageBox.scrollTo({
        top: messageBox.scrollHeight,
        behavior: 'smooth' // Défilement fluide
    });
});


// faire disparaitre le popup file
var filePopup = document.querySelector(".file_popup");
var quitPopup = document.querySelector(".quit_file_popup");
var quitPopupButtons = document.querySelectorAll(".quit_file_popup .options button");
var veil = document.querySelector(".veil");
document.addEventListener("click", function (e) {
    if (!filePopup.contains(e.target) && filePopup.style.opacity === "1") {

        veil.style.display = "block";

        // filePopup.style.display ="none";
        quitPopup.style.opacity = "1";
        quitPopup.style.transition = "opacity .1s ease-in-out";

        quitPopupButtons.forEach((button, index) => {
            button.addEventListener("click", () => {
                if (index == 0) {

                    setTimeout(function () {
                        veil.style.display = "none";

                        filePopup.style.opacity = "0";
                        filePopup.style.transition = "opacity .1s ease-in-out";

                        quitPopup.style.opacity = "0";
                        quitPopup.style.transition = "opacity .1s ease-in-out";
                    }, 200);



                } else {
                    setTimeout(function () {
                        quitPopup.style.opacity = "0";
                        quitPopup.style.transition = "opacity .1s ease-in-out";

                        veil.style.display = "none";
                    }, 200);


                }
            })

        });
    }
})


//search message popup 
var searchTrigger = document.querySelector(".chat_bloc .right .up .action i:last-child");
var messagePopup = document.querySelector(".search_message_popup");
var messagePopupButtons = document.querySelectorAll(".search_message_popup .options i");

searchTrigger.addEventListener("click", () => {
    messagePopup.style.opacity = "1";
    messagePopup.style.transition = "opacity .1s ease-in-out";

    messagePopupButtons.forEach((button, index) => {
        button.addEventListener("click", () => {
            if (index == 2) {
                messagePopup.style.transition = "opacity .1s ease-in-out";
                messagePopup.style.opacity = "0";
            }

        })
    })
})