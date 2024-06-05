<?php

include("../../config.php");
$output = "";

function dateDiff($date) {
    $datePassee = new DateTime($date);
    
    // Obtenir la date actuelle
    $dateActuelle = new DateTime();
    
    // Calculer la différence entre les deux dates
    $difference = $dateActuelle->diff($datePassee);
    
    // Retourner la différence en jours
    return $difference->days;
}
$sub_cat = $_POST['sub'];
$type = $_POST['type'];
if ($sub_cat == "") {
    $jobs = mysqli_query($conn, "SELECT * FROM jobs WHERE job_type ='{$type}'");
} elseif ($type == "" or $type == "vide") {
    $jobs = mysqli_query($conn, "SELECT * FROM jobs WHERE job_category ='{$sub_cat}'");
} else {
    $jobs = mysqli_query($conn, "SELECT * FROM jobs WHERE job_category ='{$sub_cat}' and job_type ='{$type}'");
}


if ($jobs) {
    $num = mysqli_num_rows($jobs);
    $output .= ' <p class="title">' . $num . ' jobs trouvés</p>
                   <div class="jobs_wrapper">';
    while ($job = mysqli_fetch_assoc($jobs)) {
        $job_id = $job['id'];
    
        // $name = mysqli_fetch_assoc(mysqli_query($conn, "SELECT nom FROM freelancer WHERE id ='{$user_id}'"))['nom'];
        // $picture = mysqli_fetch_assoc(mysqli_query($conn, "SELECT image FROM freelancer WHERE id ='{$user_id}'"))['image'];
        // $prenom = mysqli_fetch_assoc(mysqli_query($conn, "SELECT prenom FROM freelancer WHERE id ='{$user_id}'"))['prenom'];
        // $pays = mysqli_fetch_assoc(mysqli_query($conn, "SELECT pays FROM freelancer WHERE id ='{$user_id}'"))['pays'];
        // $ville = mysqli_fetch_assoc(mysqli_query($conn, "SELECT ville FROM freelancer WHERE id ='{$user_id}'"))['ville'];
        // $skills = mysqli_query($conn, "SELECT label FROM resume_skill WHERE resume_id ='{$resume_id}'");
       
        $output .= '    <div class="job">
                            <div class="head">
                                <a href="job_details.php?jo_i='.$job_id.'" class="job-title">'.$job['title'].'</a>
                                <span class="open-positions">Depuis '.dateDiff($job['post_date']).'jours</span>
                            </div>


                            <div class="mid-info">
                                <span class="expire-date">Expire le '.$job['expire_date'].'</span> <br><br>
                                <i class="bx bxs-group"></i><span class="candidate">3 postulants</span><br>
                                <div class="skills">';
        $skills = explode(" ",$job['skills']);
        foreach ($skills as $skill){
            $output .='<span>'.$skill.'</span>';
        }

        $output.='</div>
                            </div>
                            
                            <div class="bottom-info">
                                <div class="first-col">
                                    <div class="ab">
                                        <i class="bx bxs-briefcase-alt-2"></i><span>'.$job['experience'].'</span>
                                    </div>
                                    <div class="ba">
                                        <i class="bx bx-money"></i><span> '.$job['salary_amount'].' $</span>
                                    </div>
                                </div>
                                <div class="second-col">
                                    <div class="ab">
                                        <i class="bx bxs-time-five"></i><span>'.$job['job_type'].'</span>
                                    </div>
                                    <div class="ba">
                                        <i class="bx bxs-user"></i><span>'.$job['title'].'</span>
                                    </div>
                                </div>
                            </div>
                      </div>';

    }
    $output .= '</div>';
} else {
    $output = "<p>Aucun job correspondant</p>";
}

echo $output;
