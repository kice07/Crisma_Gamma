"https://www.worldometers.info/img/flags/fr-flag.gif"
"https://www.worldometers.info/img/flags/us-flag.gif"


function changeFlag(element){
    if (element.src =="https://www.worldometers.info/img/flags/fr-flag.gif"){
        element.src = "https://www.worldometers.info/img/flags/us-flag.gif"
    }else{
        element.src = "https://www.worldometers.info/img/flags/fr-flag.gif"
    }
}

const links = document.querySelectorAll('.navbar .middle a');
links.forEach(link => {
    link.addEventListener('click', () => {
        links.forEach(other => {
            if (!(other === link)) {
                other.style.color = "#19202b";
            }
        })
        link.style.color = "#fe6c4c";
    })

})

function showDetails(card) {
    card.querySelector("i").style.display = "block";
    setTimeout(() => {
        // card.querySelector("i").style.transform = "rotate(45deg)";
        card.querySelector("i").classList.add("rotate")
    }, 300);


    card.querySelector("i").style.transition = "all .3s ease-in-out";
    card.querySelector("p").style.display = "block";
    card.querySelector("p").style.transition = "all .3s ease-in-out";
}

function hideDetails(card) {
    card.querySelector("i").classList.remove("rotate")
    setTimeout(() => {
        card.querySelector("i").style.display = "none";
        card.querySelector("i").style.transition = "all .3s ease-in-out";
        card.querySelector("p").style.display = "none";
        card.querySelector("p").style.transition = "all .3s ease-in-out";
    }, 300);
}


// toggle
let toggles = document.getElementsByClassName('toggle');
let contentDiv = document.querySelectorAll('.wrapper .content');
let icons = document.querySelectorAll('.icon');

for(let i=0; i<toggles.length; i++){
    toggles[i].addEventListener('click', ()=>{
        if( parseInt(contentDiv[i].style.height) != contentDiv[i].scrollHeight){
            contentDiv[i].style.height = contentDiv[i].scrollHeight + "px";
            toggles[i].style.color = "#0084e9";
            icons[i].classList.remove('ai-plus');
            icons[i].classList.add('ai-minus');
           
        }
        else{
            contentDiv[i].style.height = "0px";
            toggles[i].style.color = "#111130";
            icons[i].classList.remove('ai-minus');
            icons[i].classList.add('ai-plus');
        }

        for(let j=0; j<contentDiv.length; j++){
            if(j!==i){
                contentDiv[j].style.height = "0px";
                toggles[j].style.color = "#111130";
                icons[j].classList.remove('ai-minus');
                icons[j].classList.add('ai-plus');
            }
        }
    });
}
