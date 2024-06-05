//============NAVBAR & CATEGORIES=================

const navLinks= document.querySelectorAll("nav .text");
const catLinks= document.querySelectorAll(".categories p");


navLinks.forEach(link => {
    link.addEventListener("click",()=>{
        navLinks.forEach(subLinks =>{
            subLinks.classList.remove("selected");
        })
        link.classList.add("selected");

    })
    
});

catLinks.forEach(cat => {
    cat.addEventListener("click",()=>{
        catLinks.forEach(subcat =>{
            subcat.classList.remove("selected");
        })
        cat.classList.add("selected");

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


