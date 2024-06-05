//============NAVBAR & CATEGORIES=================


const catLinks= document.querySelectorAll(".categories p");

catLinks.forEach(cat => {
    cat.addEventListener("click",()=>{
        catLinks.forEach(subcat =>{
            subcat.classList.remove("selected");
        })
        cat.classList.add("selected");

    })
    
});


// ------------- Banner
var veil = document.querySelector(".veil");
var popup = document.querySelector('.cv_popup');

function openPopup() {

    popup.style.display ="block";
    setTimeout(function() {
        popup.style.opacity = '1';
        veil.style.display ="block"
    }, 10); 
}

function closePopup() {
    popup.style.opacity = '0';
    setTimeout(function() {
        popup.style.display ="none";
        veil.style.display ="none";
    }, 300);
   
}


function addWhishlist(element) {
    id = element.parentElement.parentElement.parentElement.getAttribute("id");
    let xhr = new XMLHttpRequest();
  
    let subcatForm = new FormData();
    subcatForm.append("action", "whishlist");
    subcatForm.append("id", parseInt(id));
    xhr.open("POST", "freelancer_dashboard_assets/php_checking/job_settings.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
  
                if (data == "success insert") {
                    const iconElement = document.createElement('i');
                    iconElement.classList.add('bx', 'bxs-bookmark');
                    iconElement.style.fontSize = ".9em";
                    iconElement.onclick = function() {
                      addWhishlist(this);
                    };
                    var parent = element.parentElement;
                    parent.removeChild(element);
                    parent.append(iconElement);
  
  
                } else if (data == "success delete") {
                    const iconElement = document.createElement('i');
                    iconElement.classList.add('ai-ribbon');
                    iconElement.style.color = "#19202b";
                    iconElement.onclick = function() {
                      addWhishlist(this);
                    };
                    var parent = element.parentElement;
                    parent.removeChild(element);
                    parent.append(iconElement);
                }else{
                    console.log(data);
                }
  
            }
        }
    }
  
    xhr.send(subcatForm);
  
  
  
}

function secondAddWhishlist(element) {

    id = element.getAttribute("id");
    let xhr = new XMLHttpRequest();
  
    let subcatForm = new FormData();
    subcatForm.append("action", "whishlist");
    subcatForm.append("id", parseInt(id));
    xhr.open("POST", "freelancer_dashboard_assets/php_checking/job_settings.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
  
                if (data == "success insert") {
                    const iconElement = document.createElement('i');
                    iconElement.classList.add('bx', 'bxs-bookmark');
                    iconElement.style.fontSize = ".9em";
                    iconElement.onclick = function() {
                      addWhishlist(this);
                    };
                    var parent = element.parentElement;
                    parent.removeChild(element);

                    parent.insertBefore(iconElement, parent.lastElementChild);
  
  
                } else if (data == "success delete") {
                    const iconElement = document.createElement('i');
                    iconElement.classList.add('ai-ribbon');
                    iconElement.style.color = "#fe6c4c";
                    iconElement.onclick = function() {
                      addWhishlist(this);
                    };
                    var parent = element.parentElement;
                    parent.removeChild(element);
                    parent.insertBefore(iconElement, parent.lastElementChild);
  
                }else{
                    console.log(data);
                }
  
            }
        }
    }
  
    xhr.send(subcatForm);
  
  
  
}