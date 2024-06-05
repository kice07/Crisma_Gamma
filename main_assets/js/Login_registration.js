const forms = document.querySelector(".forms"),
    pwShowHide = document.querySelectorAll(".eye-icon"),
    links = document.querySelectorAll(".link");
pwShowHide.forEach(eyeIcon => {
    eyeIcon.addEventListener("click", () => {
        let pwFields = eyeIcon.parentElement.parentElement.querySelectorAll(".password");

        pwFields.forEach(password => {
            if (password.type === "password") {
                password.type = "text";
                eyeIcon.classList.replace("bx-hide", "bx-show");
                return;
            }
            password.type = "password";
            eyeIcon.classList.replace("bx-show", "bx-hide");
        })

    })
});

function showSignUp(element) {
    var actualForm = element.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement;
    var toAppear = actualForm.nextElementSibling;

    actualForm.classList.add('animate__animated', 'animate__zoomOut');
    
    setTimeout(() => {
        // actualForm.style.opacity="0";
        actualForm.style.display="none";
        actualForm.classList.remove('animate__animated', 'animate__zoomOut');
        toAppear.classList.add('animate__animated', 'animate__zoomIn');
        toAppear.style.opacity="1";
        toAppear.style.display="block";
 
       
    }, 100);


}

function showLogin(element) {
    var actualForm = element.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement;
    var toAppear = actualForm.previousElementSibling;
    actualForm.classList.add('animate__animated', 'animate__zoomOut');
    
    setTimeout(() => {
        actualForm.style.display="none";
        actualForm.classList.remove('animate__animated', 'animate__zoomOut');
        toAppear.classList.add('animate__animated', 'animate__zoomIn');
        toAppear.style.display="block";
       
    }, 100);
    
}
