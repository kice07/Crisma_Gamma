
// ========== goDown Button
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


//============ Popup file

// faire disparaitre le popup file
var filePopup = document.querySelector(".file_popup");
var quitPopup = document.querySelector(".quit_file_popup");
var quitPopupButtons = document.querySelectorAll(".quit_file_popup .options button");
var veil = document.querySelector(".veil");
document.addEventListener("click", function (e) {
    if (!filePopup.contains(e.target) && window.getComputedStyle(filePopup).display === "block") {

        veil.style.display = "block";

        // filePopup.style.display ="none";
        quitPopup.style.opacity = "1";
        quitPopup.style.transition = "opacity .1s ease-in-out";

        quitPopupButtons.forEach((button, index) => {
            button.addEventListener("click", () => {
                if (index == 0) {

                    setTimeout(function () {
                        veil.style.display = "none";

                        filePopup.style.display = "none";
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


//======== search message popup 
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


//============== create_contract
var swiper = document.querySelectorAll(".create_offer_popup .up .right i");
var allSlide = document.querySelectorAll(".create_offer_popup .down .slide");
var actualIndex = 0;
var stepCounter = document.querySelector(".create_offer_popup .up .left .number .counter");


//swiper les differentes slide
swiper.forEach((swipe, index) => {
    swipe.addEventListener("click", () => {

        if (index == 0) {
            // afficher le forth swiper
            swiper[1].style.color = "#19202b";
            swiper[1].style.transition = "all .3s ease-in-out";
            swiper[1].style.pointerEvents = "auto";

            actualIndex--;
            allSlide.forEach(content => { content.classList.remove('active') });
            allSlide[actualIndex].classList.add('active');
            stepCounter.textContent = actualIndex + 1;

            if (actualIndex == 0) {
                swipe.style.color = "#969999";
                swipe.style.transition = "all .3s ease-in-out";
                swipe.style.pointerEvents = "none";
            }

        } else {
            // afficher le forth swiper
            swiper[0].style.color = "#19202b";
            swiper[0].style.transition = "all .3s ease-in-out";
            swiper[0].style.pointerEvents = "auto";

            actualIndex++;
            allSlide.forEach(content => { content.classList.remove('active') });
            allSlide[actualIndex].classList.add('active');
            stepCounter.textContent = actualIndex + 1;
            if (actualIndex == 6) {
                swipe.style.color = "#969999";
                swipe.style.transition = "all .3s ease-in-out";
                swipe.style.pointerEvents = "none";
            }

        }
    })

})

//les checkboxs a cochage unique



// pour creer une nouvelle offfre
function createOffer(element) {
    var veil = document.querySelector(".veil");
    var create_contract = document.querySelector(".create_offer_popup");

    veil.style.display = "block";
    setTimeout(() => {

        create_contract.classList.add('animate__animated', 'animate__zoomIn');
        create_contract.style.display = "block";

    }, 300);


}

// pour les liste d'options
function displaySub(element) {
    var options = element.parentElement.parentElement.lastElementChild;
    if (window.getComputedStyle(options).display === "block") {
        element.classList.remove("reverse_rotate");
        options.style.display = "none";

    } else {
        element.classList.add("reverse_rotate");
        options.style.display = "block";

    }
}

// pour remplir les inputs a partir de liste d'options
function fillInput(element) {
    element.parentElement.
        previousElementSibling.
        firstElementChild.value = element.textContent;

    element.parentElement.style.display = "none"
    element.parentElement.
        previousElementSibling.
        lastElementChild.classList.remove("reverse_rotate");
}

//receuillir les info entrées pour les displays dans la preview
function setInput() {

   
    //starting_date
    var startingDate = document.querySelector(".startingDate").value;

    // Ending date
    var EndingDate = document.querySelector(".EndingDate").value;

    //concurences term
    var Concurences =  document.querySelectorAll(".concurrence");
    var ConcurencesList = []
    Concurences.forEach(element=>{
        if (element.checked){
            ConcurencesList.push(element.nextElementSibling.textContent);
        }
    })

    //Displaying info
    var actualWorkPeriod = document.querySelectorAll(".actualdate");
    actualWorkPeriod[0].textContent = startingDate;
    actualWorkPeriod[1].textContent = EndingDate;

    ConcurencesList.forEach(item=>{
        var innerConcurrenceTerm = `<span>`+item+`</span><br><br>`;
        document.querySelector(".actualConcurrence").innerHTML+=innerConcurrenceTerm
    })
    

    console.log(startingDate+"\n");
    console.log(EndingDate+"\n");
    console.table(ConcurencesList+"\n");



}

// afficher la preview du contrat apres remplissage
function previewContract(element) {
    var create_contract = element.parentElement.parentElement.parentElement;
    var previewContract = create_contract.nextElementSibling;

    create_contract.classList.add('animate__animated', 'animate__zoomOut');

    setTimeout(() => {
        create_contract.style.display = "none";

        //remmettre le popup du contrat au premier slide
        actualIndex = 0;
        allSlide.forEach(content => { content.classList.remove('active') });
        allSlide[0].classList.add("active");
        stepCounter.textContent = 1;
        swiper.forEach(swipe => {
            swipe.style.color = "#19202b";
            swipe.style.transition = "all .3s ease-in-out";
            swipe.style.pointerEvents = "auto";
        })

        //enlever la class de zoomOut apres avoir masqué l'element
        create_contract.classList.remove('animate__animated', 'animate__zoomOut');

      
        previewContract.classList.add('animate__animated', 'animate__zoomIn');
        previewContract.style.display = "block";
        setInput();
    }, 300);

}

// retourner a la creation du contrat pour plus de modification
function returnCreateContract(element) {
    var previewContract = element.parentElement.parentElement;
    var create_contract = previewContract.previousElementSibling;

    previewContract.classList.add('animate__animated', 'animate__zoomOut');

    setTimeout(() => {
        previewContract.style.display = "none";

        //enlever la class de zoomOut apres avoir masqué l'element
        previewContract.classList.remove('animate__animated', 'animate__zoomOut');

        create_contract.classList.add('animate__animated', 'animate__zoomIn');
        create_contract.style.display = "block";

    }, 300);


}

// terminer la creation du contrat et envoi
function closePreview(element) {
    var previewContract = element.parentElement.parentElement;
    previewContract.classList.add('animate__animated', 'animate__zoomOut');
    setTimeout(() => {
        previewContract.style.display = "none";
        document.querySelector(".veil").style.display = "none";
    }, 300);


}