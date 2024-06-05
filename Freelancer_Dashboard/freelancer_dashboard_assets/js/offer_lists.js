// =================== tabs
const tabs = document.querySelectorAll('.tab_btn');
const allContent = document.querySelectorAll('.content');

tabs.forEach((tab, index)=>{
    tab.addEventListener('click',(e)=>{
        tabs.forEach(tab =>{tab.classList.remove("active")});
        tab.classList.add("active");
        
        var line = document.querySelector(".line")
        line.style.width =e.target.offsetWidth +"px";
        line.style.left =e.target.offsetLeft+"px";

        allContent.forEach(content=>{content.classList.remove('active')});
        allContent[index].classList.add('active');
        
    });


});

//==================== counter
function counter(element,side) {
    var mids = element.parentElement.querySelectorAll(" .numbers .mid");
    if(side=="back"){
        if (mids[0].textContent == "2") {
            mids.forEach(mid => {
                mid.classList.add("hide")
            })
        } else {
            mids[0].textContent = parseInt(mids[0].textContent) - 1;
        }
    }else{
        if (mids[0].classList.contains("hide")) {
            mids.forEach(mid => {
                mid.classList.remove("hide")
            })
        } else {
            mids[0].textContent = parseInt(mids[0].textContent) + 1;
        }
    }
}

// ======= remove item in wishlist
var allCross = document.querySelectorAll(".job .row.first i");

allCross.forEach(cross=>{
    cross.addEventListener("click",()=>{
        var job = cross.parentElement.parentElement.parentElement;
        job.parentElement.removeChild(job);
    })
})

