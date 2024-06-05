// ----------- CV
var no_cv = document.querySelector('.right .none');
var cv = document.querySelector('.right .job_file');


function toggleCheckbox(checkbox) {
    var boxes= document.querySelectorAll(".check");
    boxes.forEach(box=>{
        box.classList.remove("checked")
    })
    var isChecked = checkbox.classList.contains("checked");
    if (isChecked) {
        checkbox.classList.remove("checked");
        cv.style.display = 'none';
        no_cv.style.display = 'block';


    } else {
        document.querySelector(".job_file").innerHTML=`<img src="admin_dashboard_assets/images/crislogo.png" alt="" class="watermark">`
        let xhr = new XMLHttpRequest();
        let gJobs = new FormData();
        gJobs.append('action', "getjobs");
        gJobs.append('id', checkbox.getAttribute("id"));
        xhr.open("POST", "admin_dashboard_assets/php_checking/get_job.php", true);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    console.log(data);
                    document.querySelector(".job_file").innerHTML += data;
                    checkbox.classList.add("checked");
                    no_cv.style.display = 'none';
                    cv.style.display = 'block';
                }
            }
        }
        xhr.send(gJobs);
       

    }

}

function deleteRow(element){
    id = element.getAttribute('id');
    var row = element.parentElement.parentElement.parentElement;
    // console.log(row);
    var table = document.querySelector("table");
    // console.log(table);
    let xhr = new XMLHttpRequest();
    let gJobs = new FormData();
    gJobs.append('action', "deleteJobs");
    gJobs.append('id', element.getAttribute("id"));
    xhr.open("POST", "admin_dashboard_assets/php_checking/get_job.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                if(data == "success"){
                    table = document.querySelector("table");
                    table.removeChild(row);
                }
              
            }
        }
    }
    xhr.send(gJobs);
   
  
}



