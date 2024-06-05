// ----------- CV
var no_cv = document.querySelector('.right .none');
var cv = document.querySelector('.right .cv_file');

function toggleCheckbox(checkbox) {
    var resumeId = checkbox.getAttribute("resume_id");

    var isChecked = checkbox.classList.contains("checked");
    if (isChecked) {
        
        checkbox.classList.remove("checked");
        cv.style.display = 'none';
        no_cv.style.display = 'block';


    } else {
        var Checkboxs = document.querySelectorAll(".check");
        Checkboxs.forEach(littleCheck=>{
            littleCheck.classList.remove("checked");
        })
        let xhr = new XMLHttpRequest();
        let getResume = new FormData();
        getResume.append('id', resumeId);
        xhr.open("POST", "freelancer_dashboard_assets/php_checking/get-resume-info.php", true);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {

                    let data = xhr.response;
                    checkbox.classList.add("checked");
                    no_cv.style.display = 'none';
                    
                    cv.style.display = 'block';
                    cv.innerHTML=data;

                }
            }
        }
        xhr.send(getResume);

      

    }

}



