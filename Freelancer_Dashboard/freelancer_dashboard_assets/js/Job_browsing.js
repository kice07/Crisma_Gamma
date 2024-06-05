
//============NAVBAR & CATEGORIES=================

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
  } else {
    checkbox.classList.add("checked");
    checkbox.nextElementSibling.style.color = "#fe6c4c";
    checkbox.nextElementSibling.style.fontWeight = "bold";
  }

}

// =========== SEARCH BAR ============
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



// ==============Filter
let subCat = document.querySelector(".subcat");
function getSubCat(category) {

  let cat_id = category.getAttribute("id");


  // get sub cat
  let xhr = new XMLHttpRequest();

  let subcatForm = new FormData();
  subcatForm.append("action", "getsub");
  subcatForm.append("cat_id", cat_id);
  xhr.open("POST", "freelancer_dashboard_assets/php_checking/job_settings.php", true);
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