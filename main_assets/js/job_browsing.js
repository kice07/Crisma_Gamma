
//============NAVBAR & CATEGORIES=================

const navLinks = document.querySelectorAll("nav .text");
const catLinks = document.querySelectorAll(".categories p");


navLinks.forEach(link => {
  link.addEventListener("click", () => {
    navLinks.forEach(subLinks => {
      subLinks.classList.remove("selected");
    })
    link.classList.add("selected");

  })

});

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


let xhr = new XMLHttpRequest();
xhr.open("GET", "Admin_Dashboard/admin_dashboard_assets/php_checking/get-cat.php", true);
xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
            let data = xhr.response;
            categoriesList.innerHTML = data;
        }
    }
}
xhr.send();

// =============== Filter Part =============================
let filtercategory = document.querySelector(".job_search_body .filter .category .category_items");
let subCat = "",
    type = "",
    min_price="",
    max_price="",
    skills = "";
function setfilter(category) {

    let cat_id = category.getAttribute("cat_id");
    console.log(cat_id);

    // get sub cat
    let xhr = new XMLHttpRequest();

    let subcatForm = new FormData();
    subcatForm.append("action", "getsub");
    subcatForm.append("cat_id", cat_id);
    xhr.open("POST", "Admin_Dashboard/admin_dashboard_assets/php_checking/freelancer_settings.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;

                filtercategory.innerHTML = data;

                let subCats = document.querySelectorAll(".filter .category .category_items .item .label input");

                subCats.forEach(sub => {

                    sub.addEventListener("change", () => {

                        if (sub.checked) {
                            subCat = sub.value
                            console.log(subCat);
                        } else {
                            subCat = ""
                        }
                    });

                })

            }
        }
    }

    xhr.send(subcatForm);

}



// seetings
let typeToggle = document.querySelectorAll(".job_type .switch input");
typeToggle.forEach(input => {

    input.addEventListener("change", () => {

        if (input.checked) {
            switch (input.value) {
                case "Fulltime":
                    type = "Temps plein";
                    break;
                case "parttime":
                    type = "Temps partiel";
                    break;
                case "Contract":
                    type = "Contrat";
                    break;
            }

            console.log(type);
        } else {
            type = " vide";
            console.log(type);
        }
    });

})






// =============Job -> range_slider

const rangeInput = document.querySelectorAll(".range-input input"),
  priceInput = document.querySelectorAll(".price-input input"),
  range = document.querySelector(".slider .progress");
let priceGap = 1000;
min_price=priceInput[0].value;
max_price=priceInput[1].value;

priceInput.forEach((input) => {
  input.addEventListener("input", (e) => {
    let minPrice = parseInt(priceInput[0].value),
      maxPrice = parseInt(priceInput[1].value);
      min_price = minPrice;
      max_price = maxVal;

    if (maxPrice - minPrice >= priceGap && maxPrice <= rangeInput[1].max) {
      if (e.target.className === "input-min") {
        rangeInput[0].value = minPrice;
        range.style.left = (minPrice / rangeInput[0].max) * 100 + "%";
      } else {
        rangeInput[1].value = maxPrice;
        range.style.right = 100 - (maxPrice / rangeInput[1].max) * 100 + "%";
      }
    }
  });
});

rangeInput.forEach((input) => {
  input.addEventListener("input", (e) => {
    let minVal = parseInt(rangeInput[0].value),
      maxVal = parseInt(rangeInput[1].value);
      min_price = minVal;
      max_price = maxVal;
    
    if (maxVal - minVal < priceGap) {
      if (e.target.className === "range-min") {
        rangeInput[0].value = maxVal - priceGap;
      } else {
        rangeInput[1].value = minVal + priceGap;
      }
    } else {
      priceInput[0].value = minVal;
      priceInput[1].value = maxVal;
      range.style.left = (minVal / rangeInput[0].max) * 100 + "%";
      range.style.right = 100 - (maxVal / rangeInput[1].max) * 100 + "%";
    }
  });
});

// ==============Filter
var skillInput = document.getElementById("skills");
var search_suggestion = document.querySelector(".skills .search_results");
var selected = document.querySelector(".selected_skills");
var typing=false;
                                                                                                               
skillInput.addEventListener('focus',()=>{
  if(skillInput.value===""){
    search_suggestion.style.display = "none";
  }
})
skillInput.addEventListener('input', (event) => {
  // Cet événement se déclenche lorsque l'utilisateur commence à saisir
  if(skillInput.value==="" && typing==true){
    search_suggestion.style.display = "none";
  }else{
    typing = true
    search_suggestion.style.display = "block";
  }


});

skillInput.addEventListener('keypress', (event) => {
  // Cet événement se déclenche lorsqu'une touche est enfoncée
  if (event.key === 'Enter') {
    // Si la touche enfoncée est "Entrée"
    const inputValue = skillInput.value;

    // Créer un élément <div> avec une icône et un paragraphe
    const newDiv = document.createElement('div');
    newDiv.classList.add('item'); // Ajouter la classe 'item' à la nouvelle div

    const newI = document.createElement('i');
    newI.classList.add('bx', 'bx-x'); // Ajouter les classes 'bx' et 'bx-x' à l'élément <i>

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

//============== Apply filter
// let subCat="",type="",skills = "";
var applyFilter = document.querySelector(".filter .apply_filter");
var container = document.querySelector(".job_bloc");

applyFilter.addEventListener("click", () => {
    console.log("clicked");
    if (!(subCat == "" && type == "")) {
        console.log(min_price +" "+max_price);
        let xhr = new XMLHttpRequest();

        let filterForm = new FormData();
        filterForm.append("action", "apply_filter");
        filterForm.append("sub", subCat);
        filterForm.append("type", type);
        xhr.open("POST", "assets2/php_checking/job_settings.php", true);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    console.log(data);
                    while (container.firstChild) {
                        container.removeChild(container.firstChild);
                    }
                    container.innerHTML = data;

                }
            }
        }
        xhr.send(filterForm);
    }
})

