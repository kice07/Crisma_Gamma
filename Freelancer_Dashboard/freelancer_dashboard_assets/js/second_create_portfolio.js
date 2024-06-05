//=================== Sticky
// var parent = document.querySelector('.main_content');
// // Sélection de l'élément right-side
// var rightSide = document.querySelector('.right-side');

// // Fonction pour mettre à jour la position de l'élément right-side
// function updateSticky() {
//     // Obtenir la position de défilement du parent
//     var parentScrollPosition = parent.scrollTop;

//     // Vérifier si l'élément doit être sticky
//     if (parentScrollPosition >= rightSide.offsetTop) {
//         console.log("here")
//         rightSide.style.position = 'sticky';
//         rightSide.style.top = '0';
//     } else {
//         rightSide.style.position = 'static'; // Revenir à la position par défaut
//     }
// }

// // Écouter l'événement de défilement du parent et appeler la fonction de mise à jour
// parent.addEventListener('scroll', updateSticky);


// ========== Get cat and sub_cat
var categories = document.querySelectorAll(".cat li");
var subCategoryBox = document.querySelector(".sub_cat");

var inputs = document.querySelectorAll(".select_input .head input");
var Bottom = document.querySelectorAll(".select_input ul");
var firstBottomOptions = document.querySelectorAll(".select_input .cat li");
var isClicked = true;


//Display sublist
inputs.forEach((element, index) => {
    element.addEventListener("click", () => {

        // console.log(containerBottom.offsetHeight);
        if (isClicked) {
            // containerBottom.style.height = containerBottom.offsetHeight + "px";
            Bottom[index].style.height = "100px";
            Bottom[index].style.opacity = "1";
            Bottom[index].style.transition = " height .3s ease-in-out,opacity .3s ease-in-out";
            isClicked = false;

        } else {
            Bottom[index].style.height = "0";
            Bottom[index].style.opacity = "0";
            Bottom[index].style.transition = " height .3s ease-in-out,opacity .3s ease-in-out";
            isClicked = true;
        }

    });
});

//select sublist value
firstBottomOptions.forEach(element => {
    element.addEventListener("click", () => {
        inputs[0].value = element.textContent;
        Bottom[0].style.height = "0";
        Bottom[0].style.opacity = "0";
        Bottom[0].style.transition = " height .3s ease-in-out,opacity .3s ease-in-out";
    });
});




categories.forEach(element => {
    element.addEventListener("click", () => {
        var cat_id = element.getAttribute("cat_id");

        let xhr = new XMLHttpRequest();

        let sub = new FormData();
        sub.append("cat_id", cat_id);
        sub.append("purpose", "subcategories");

        xhr.open("POST", "freelancer_dashboard_assets/php_checking/cv_treatment.php", true);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    
                    subCategoryBox.innerHTML = data;

                    var secondBottomOptions = document.querySelectorAll(".select_input .sub_cat li");            
                    secondBottomOptions.forEach(element => {
                        element.addEventListener("click", () => {
                            inputs[1].value = element.textContent;
                            Bottom[1].style.height = "0";
                            Bottom[1].style.opacity = "0";
                            Bottom[1].style.transition = " height .3s ease-in-out,opacity .3s ease-in-out";
                        });
                    });

                }
            }
        }

        xhr.send(sub);

    })
})
