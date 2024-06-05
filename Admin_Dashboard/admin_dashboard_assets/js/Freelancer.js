var skill_tab = [];
var subCategories = [];
var types = [];

const catLinks = document.querySelectorAll(".categories p");
catLinks.forEach(cat => {
    cat.addEventListener("click", () => {

        catLinks.forEach(sub => {
            sub.style.color = "#000";
        })

        cat.style.color = "#ea6f11";
    })

});

// ============================ Launch Categeory =================================
let categoriesList = document.querySelector(".categories");

const ListOPtions = document.querySelectorAll('.categories li');
ListOPtions.forEach(link => {
    link.addEventListener('click', () => {
        ListOPtions.forEach(other => {
            if (!(other === link)) {
                other.style.color = "#969999";
            }
        })
        link.style.color = "#fe6c4c";
    })

})

// --------checkbox
function toggleCheckbox(checkbox) {
    var isChecked = checkbox.classList.contains("checked");
    if (isChecked) {
        checkbox.classList.remove("checked");
        checkbox.nextElementSibling.style.color = "#969999";
        checkbox.nextElementSibling.style.fontWeight = "normal";
        if (checkbox.classList.contains("type")) {
            var indexToRemove = types.indexOf(checkbox.nextElementSibling.textContent);
            types.splice(indexToRemove, 1);
        } else {
            var indexToRemove = subCategories.indexOf(checkbox.nextElementSibling.textContent);
            subCategories.splice(indexToRemove, 1);
        }
    } else {
        checkbox.classList.add("checked");
        checkbox.nextElementSibling.style.color = "#fe6c4c";
        checkbox.nextElementSibling.style.fontWeight = "bold";
        if (checkbox.classList.contains("type")) {
            types.push(checkbox.nextElementSibling.textContent);
        } else {
            subCategories.push(checkbox.nextElementSibling.textContent);
        }
    }

}

// =========== BANNER SEARCH BAR ============
//shrink action
var Triggers = document.querySelectorAll(".banner .search_bar .part .ai-chevron-down");
var box = document.querySelectorAll(".choice");
var partLabel = document.querySelectorAll(".banner .search_bar .part span");
var isClicked = false;

Triggers.forEach((trigger, index) => {

    trigger.addEventListener("click", () => {
        // console.log(trigger);
        if (!isClicked) {
            box[index].style.height = "87px";
            box[index].style.opacity = "1";
            box[index].style.transition = " height .3s ease-in-out";
            isClicked = true;

            var options = box[index].querySelectorAll("li");
            options.forEach(option => {
                option.addEventListener("click", () => {
                    partLabel[index].textContent = option.textContent;
                    box[index].style.height = "0";
                    box[index].style.opacity = "0";
                    box[index].style.transition = " height .3s ease-in-out";
                    isClicked = false;
                })
            })

        } else {
            box[index].style.height = "0";
            box[index].style.opacity = "0";
            box[index].style.transition = " height .3s ease-in-out";
            isClicked = false;
        }

    });

})



// =============== Filter Part =============================
let subCat = document.querySelector(".subcat");

function getSubCat(category) {

    let cat_id = category.getAttribute("id");


    // get sub cat
    let xhr = new XMLHttpRequest();

    let subcatForm = new FormData();
    subcatForm.append("action", "getsub");
    subcatForm.append("cat_id", cat_id);
    xhr.open("POST", "admin_dashboard_assets/php_checking/freelancer_settings.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;

                subCat.innerHTML += data;

                // let subCats = document.querySelectorAll(".filter .category .category_items .item .label input");

                // subCats.forEach(sub => {

                //     sub.addEventListener("change", () => {

                //         if (sub.checked) {
                //             subCat = sub.value

                //         } else {
                //             subCat = ""
                //         }
                //     });

                // })

            }
        }
    }

    xhr.send(subcatForm);

}



// ============== skills
function deleteItem(target) {
    var item = target.parentElement;
    var item_bloc = item.parentElement;
    item_bloc.removeChild(item);
}

var skillInput = document.getElementById("skills");
var search_suggestion = document.querySelector(".skills .search_results");
var selected = document.querySelector(".selected_skills");
var selected_item
var typing = false;

skillInput.addEventListener('focus', () => {
    if (skillInput.value === "") {
        search_suggestion.style.display = "none";
    }
})

document.addEventListener("click", (e) => {
    if (search_suggestion.style.display == "block" && !search_suggestion.contains(e.target)) {
        search_suggestion.style.display = "none";
    }
})

skillInput.addEventListener('input', (event) => {
    // Cet événement se déclenche lorsque l'utilisateur commence à saisir
    if (skillInput.value === "" && typing == true) {
        search_suggestion.style.display = "none";
    } else {
        typing = true;
        search_suggestion.style.display = "block";

        var suggestion = search_suggestion.querySelectorAll("div");
        suggestion.forEach(sugg => {
            sugg.style.display = "none";
        })

        var match = false;
        const regex = new RegExp(skillInput.value);

        if (skillInput.value == "") {
            suggestion.forEach(sugg => {
                sugg.style.display = "block";
            })
        } else {
            suggestion.forEach((sugg) => {
                if (regex.test(sugg.firstElementChild.textContent)) {
                    sugg.style.opacity = "1";
                    match = true;
                }
            })

            if (!match) {
                suggestion.forEach(sugg => {
                    sugg.style.display = "block";
                })
            }
        }


        search_suggestion.querySelectorAll("div").forEach(suggestion => {
            suggestion.addEventListener("click", () => {
                const inputValue = suggestion.firstElementChild.textContent;
                skill_tab.push(suggestion.firstElementChild.textContent);
                // Créer un élément <div> avec une icône et un paragraphe
                const newDiv = document.createElement('div');
                newDiv.classList.add('item'); // Ajouter la classe 'item' à la nouvelle div

                const newI = document.createElement('i');
                newI.classList.add('bx', 'bx-x'); // Ajouter les classes 'bx' et 'bx-x' à l'élément <i>
                newI.onclick = function () {
                    deleteItem(this);
                }
                const newParagraph = document.createElement('p');
                newParagraph.textContent = inputValue; // Définir le texte du paragraphe

                // Ajouter l'icône et le paragraphe à la nouvelle div
                newDiv.appendChild(newI);
                newDiv.appendChild(newParagraph);

                selected.appendChild(newDiv);

                // Effacer le contenu de l'input après l'ajout
                search_suggestion.style.display = "none";
            })

        })



    }


});

skillInput.addEventListener('keypress', (event) => {
    // Cet événement se déclenche lorsqu'une touche est enfoncée
    if (event.key === 'Enter') {
        // Si la touche enfoncée est "Entrée"
        const inputValue = skillInput.value;
        skill_tab.push(inputValue);

        // Créer un élément <div> avec une icône et un paragraphe
        const newDiv = document.createElement('div');
        newDiv.classList.add('item'); // Ajouter la classe 'item' à la nouvelle div

        const newI = document.createElement('i');
        newI.classList.add('bx', 'bx-x'); // Ajouter les classes 'bx' et 'bx-x' à l'élément <i>
        newI.onclick = function () {
            deleteItem(this);
        }
        const newParagraph = document.createElement('p');
        newParagraph.textContent = inputValue; // Définir le texte du paragraphe

        // Ajouter l'icône et le paragraphe à la nouvelle div
        newDiv.appendChild(newI);
        newDiv.appendChild(newParagraph);

        selected.appendChild(newDiv);

        // Effacer le contenu de l'input après l'ajout
        skillInput.value = '';

        search_suggestion.style.display = "none";


    }
});


function ApplyFilter(element){
    
}



