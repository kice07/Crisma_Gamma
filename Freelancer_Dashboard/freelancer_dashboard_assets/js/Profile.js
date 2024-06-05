
//  selection de l'operation a effectuer sur le profile
const tabs = document.querySelectorAll('.details_options .left p');
const allContent = document.querySelectorAll('.details_options .right .case');

tabs.forEach((tab, index) => {
    tab.addEventListener('click', (e) => {
        tabs.forEach(tab => { tab.style.color = "#969999" });
        tab.style.color = "#fe6c4c";

        allContent.forEach(content => { content.style.display = "none" });
        // allContent[index].classList.add('show');

        allContent[index].style.display = "block";

    });


});

//--------------------------EDIT-PROFILE----------------------------

//Changer l'image
const editBtn = document.querySelector('.main_info .left i'),
    inputImage = document.querySelector('.profile_pic'),
    currentImage = document.querySelector('.main_info .left img');
var currentImageSource = currentImage.src;



editBtn.onclick = () => {
    inputImage.click()
};

//upload et deplacer l'image
inputImage.addEventListener("change", function (e) {
    var input = e.target;

    // Vérifier s'il y a des fichiers sélectionnés
    if (input.files && input.files[0]) {
        // Accéder au premier fichier sélectionné
        var fichierImage = input.files[0];

        console.log(fichierImage);


        let xhr = new XMLHttpRequest();

        xhr.open("POST", "freelancer_dashboard_assets/php_checking/edit-profile.php", true);
        var formData = new FormData();
        formData.append('action', 'updateImage');
        formData.append('file', fichierImage);

        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // let data = xhr.response;

                    // console.log(data)
                    // Créer un objet FileReader pour lire le contenu du fichier
                    var lecteur = new FileReader();

                    // Définir une fonction de rappel pour être appelée lorsque la lecture est terminée
                    lecteur.onload = function (e) {
                        // Accéder à l'URL de l'image chargée
                        urlImage = e.target.result;

                        // Afficher l'image (par exemple, en l'ajoutant à une balise img)
                        currentImage.src = urlImage;
                        currentImageSource = urlImage;






                    };
                    // Lire le contenu du fichier en tant que Data URL (pour les images)
                    lecteur.readAsDataURL(fichierImage);
                    location.reload();

                }
            }
        }

        xhr.send(formData);

        // var lecteur = new FileReader();

        // // Définir une fonction de rappel pour être appelée lorsque la lecture est terminée
        // lecteur.onload = function (e) {
        //     // Accéder à l'URL de l'image chargée
        //     urlImage = e.target.result;

        //     // Afficher l'image (par exemple, en l'ajoutant à une balise img)
        //     currentImage.src = urlImage;
        //     currentImageSource = urlImage;

        //     // Lire le contenu du fichier en tant que Data URL (pour les images)

        //     // location.reload();

        // };
        // lecteur.readAsDataURL(fichierImage);

    }

});


//subscription

function cancelPlan(element) {
    let xhr = new XMLHttpRequest();
    let sendInfo = new FormData();

    sendInfo.append('action', 'cancel_plan');
    sendInfo.append('plan', document.querySelector(".case.third .content .label").textContent);

    xhr.open("POST", "freelancer_dashboard_assets/php_checking/edit-profile.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                if (data === "success") {
                    var subscriptionBloc = element.parentElement;
                    element.parentElement.parentElement.removeChild(subscriptionBloc);
                }

            }
        }
    }
    xhr.send(sendInfo);
}


var changed = false;
var selectedIndex;

function newPlan() {
    var subsPopup = document.querySelector(".popup_subscription");

    subsPopup.style.display = "block";
    var allOffers = subsPopup.querySelectorAll(".content .offer_bloc");
    allOffers.forEach((offer, index) => {
        offer.addEventListener("click", () => {
            var check = offer.querySelectorAll(".top i");

            allOffers.forEach(offer => {
                offer.style.borderColor = "#969999";
                var check = offer.querySelectorAll(".top i");
                check[1].style.display = "none";
                check[0].style.display = "block";
            })
            offer.style.borderColor = "#fe6c4c";
            offer.style.transition = "all .3s ease-in-out";

            check[0].style.display = "none";
            check[1].style.display = "block";

            changed = true;
            selectedIndex = index;
            console.log(selectedIndex);




        })
    })
}


function closePopup(element) {
    element.parentElement.style.display = "none"
}


//change plan
function chosePlan(element) {
    if (changed) {
        let xhr = new XMLHttpRequest();
        let sendInfo = new FormData();

        sendInfo.append('action', 'changePlan');
        sendInfo.append('plan', selectedIndex);

        xhr.open("POST", "freelancer_dashboard_assets/php_checking/edit-profile.php", true);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    if (data === "success") {
                        element.parentElement.style.display = "none";
                        // location.reload();
                        tabs[2].click();
                    }

                }
            }
        }
        xhr.send(sendInfo);
    }
}




function updateInfo(trigger) {
    var inputBox = trigger.previousElementSibling;

    console.log(inputBox.querySelector(".firstname").value);
    console.log(inputBox.querySelector(".lastname").value);
    console.log(inputBox.querySelector(".age").value);
    console.log(inputBox.querySelector(".mail").value);
    console.log(inputBox.querySelector(".country").value);
    console.log(inputBox.querySelector(".language").value);
    var emptyCounter = 0;
    var regxName = /^[^0-9]{1,60}$/;
    var regexAge = /^-?\d+(\.\d+)?$/;
    var regexMail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    inputBox.querySelectorAll("input").forEach(input => {
        if (!input.value == "") {
            emptyCounter++;
        }
    })

    if (emptyCounter == 6) {
        if (regxName.test(inputBox.querySelector(".firstname").value) &&
            regxName.test(inputBox.querySelector(".lastname").value) &&
            regxName.test(inputBox.querySelector(".availability").value)) {
            if (regexAge.test(inputBox.querySelector(".age").value)) {

                if (regexMail.test(inputBox.querySelector(".mail").value)) {
                    if ((inputBox.querySelector(".language").value).toLowerCase().substr(0,2) != "fr" ||
                        (inputBox.querySelector(".language").value).toLowerCase().substr(0,2) != "en" ||
                        (inputBox.querySelector(".language").value).toLowerCase().substr(0,2) != "an" ) {
                        let xhr = new XMLHttpRequest();
                        let sendInfo = new FormData();
                        sendInfo.append('action', 'updateInfo');
                        sendInfo.append('firstname', inputBox.querySelector(".firstname").value);
                        sendInfo.append('lastname', inputBox.querySelector(".lastname").value);
                        sendInfo.append('age', inputBox.querySelector(".age").value);
                        sendInfo.append('mail', inputBox.querySelector(".mail").value);
                        sendInfo.append('country', inputBox.querySelector(".country").value);
                        sendInfo.append('language', inputBox.querySelector(".language").value);

                        xhr.open("POST", "freelancer_dashboard_assets/php_checking/edit-profile.php", true);
                        xhr.onload = () => {
                            if (xhr.readyState === XMLHttpRequest.DONE) {
                                if (xhr.status === 200) {
                                    let data = xhr.response;
                                    if (data === "success") {
                                        console.log("done updating");
                                    }

                                }
                            }
                        }
                        xhr.send(sendInfo);

                    } else {
                        var error = document.querySelector(".error");
                        var message = "choisissez entre le français et l'anglais";
                        error.style.display = "block";
                        error.textContent = message;
                    }

                } else {
                    var error = document.querySelector(".error");
                    var message = "Le mail est invalide";
                    error.style.display = "block";
                    error.textContent = message;
                }

            } else {
                var error = document.querySelector(".error");
                var message = "l'age doit etre un chiffre";
                error.style.display = "block";
                error.textContent = message;
            }

        } else {
            var error = document.querySelector(".error");
            var message = "Les noms et prenoms ne peuvent contenir de chiffres";
            error.style.display = "block";
            error.textContent = message;

        }

    } else {

        var error = document.querySelector(".error");
        var message = "veuillez remplir tous les champs";
        error.style.display = "block";
        error.textContent = message;
    }

}

function changePassword(trigger) {
    var inputBox = trigger.previousElementSibling;
    var emptyCounter = 0;
    var regexPass = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{1,15}$/;
    (inputBox.querySelectorAll("input")).forEach(input => {
        if (!input.value == "") {
            emptyCounter++;
        }
    })

    if (emptyCounter == 3) {

        if (document.querySelector(".new_password").value == document.querySelector(".confirm_new_password").value) {
            if (regexPass.test(document.querySelector(".new_password").value) &&
                regexPass.test(document.querySelector(".confirm_new_password").value) &&
                regexPass.test(document.querySelector(".old_password").value)) {

                let xhr = new XMLHttpRequest();
                let sendInfo = new FormData();
                sendInfo.append('action', 'updatePassword');
                sendInfo.append('oldP', inputBox.querySelector(".old_password").value);
                sendInfo.append('newP', inputBox.querySelector(".new_password").value);


                xhr.open("POST", "freelancer_dashboard_assets/php_checking/edit-profile.php", true);
                xhr.onload = () => {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            let data = xhr.response;
                            if (data === "success") {
                                console.log("done updating");
                            } else {
                                var error = document.querySelector(".error2")
                                var message = "Erreur : mot de passe";
                                error.style.display = "block";
                                error.textContent = message;
                            }

                        }
                    }
                }
                xhr.send(sendInfo);

            } else {
                var error = document.querySelector(".error2")
                var message = "Le mot de passe doit contenir des lettres(minuscule et majuscule) , des chiffres et des symbols";
                error.style.display = "block";
                error.textContent = message;
            }
        } else {
            var error = document.querySelector(".error2")
            var message = "la confirmation doit correspondre au nouveau mot de passe";
            error.style.display = "block";
         error.textContent = message;
        }



    } else {

        var error = document.querySelector(".error2")
        var message = "veuillez remplir tous les champs";
        error.style.display = "block";
        error.textContent = message;
    }
}

