<?php

include("../../../config.php");
$output = "";
if ($_POST["action"] == "getsub") {

    $cat_id = $_POST['cat_id'];
    $get_sub_cat = mysqli_query($conn, "SELECT * FROM job_sub_category WHERE big_cat_id = '{$cat_id}' ");

    if ($get_sub_cat) {

        while ($row = mysqli_fetch_assoc($get_sub_cat)) {
            $label =  $row['label'];
            $id =  $row['id'];
            $numLabel = mysqli_num_rows(mysqli_query($conn, "SELECT position FROM resume WHERE sous_category ='{$label}'"));
            $output .=  ' <div class="box" id="'.$id.'">
                                <div class="check sub_cat" onclick="toggleCheckbox(this)"><i class="bx bx-check"></i></div>
                                <span class="translate">'.$label.'</span>
                          </div> ';
        }
    }
    echo $output;
} else {
    $sub_cat = $_POST['sub'];
    $type = $_POST['type'];
    if($sub_cat == ""){
        $resumes = mysqli_query($conn, "SELECT * FROM resume WHERE type ='{$type}'");
    }elseif($type=="" or $type =="vide" ){
        $resumes = mysqli_query($conn, "SELECT * FROM resume WHERE sous_category ='{$sub_cat}'");
    }else{
        $resumes = mysqli_query($conn, "SELECT * FROM resume WHERE sous_category ='{$sub_cat}' and type ='{$type}'");
    }

   
    if ($resumes) {
        $num = mysqli_num_rows($resumes);
        $output.=' <p class="title">'.$num.' freelancers trouvés</p>
                   <div class="jobs_wrapper">';
        while ($resume = mysqli_fetch_assoc($resumes)) {
            $resume_id= $resume['id'];
            $user_id = $resume['user_id'];
            $name = mysqli_fetch_assoc(mysqli_query($conn, "SELECT nom FROM freelancer WHERE id ='{$user_id}'"))['nom'];
            $picture = mysqli_fetch_assoc(mysqli_query($conn, "SELECT image FROM freelancer WHERE id ='{$user_id}'"))['image'];
            $prenom = mysqli_fetch_assoc(mysqli_query($conn, "SELECT prenom FROM freelancer WHERE id ='{$user_id}'"))['prenom'];
            $pays = mysqli_fetch_assoc(mysqli_query($conn, "SELECT pays FROM freelancer WHERE id ='{$user_id}'"))['pays'];
            $ville = mysqli_fetch_assoc(mysqli_query($conn, "SELECT ville FROM freelancer WHERE id ='{$user_id}'"))['ville'];
            $skills = mysqli_query($conn, "SELECT label FROM resume_skill WHERE resume_id ='{$resume_id}'");
            $output .= ' <div class="freelancer">
                            <div class="left">
                                <img src="../Freelancer_Dashboard/freelancer_dashboard_assets/images/freelancer/' . $picture . '" alt="">
                                <div class="freelancer_detail">
                                    <p class="name">' . $name . " " . $prenom . '</p>
                                    <span>' . $resume['position'] . '</span>
                                    <p class="rate"><i class="fa-solid fa-star"></i> 4.9(200 projet)</p>
                                    <div class="skills_row">';
            while ($skill = mysqli_fetch_assoc($skills)) {
                $output .= '<span>' . $skill['label'] . '</span>';
            }


            $output .= '</div>
                            </div>
                        </div>
                        <div class="right">
                            <div class="more_detail">
                                <div class="bloc">
                                    <p>Pays</p>
                                    <p>' . $pays . '</p>
                                </div>
                                <div class="bloc">
                                    <p>ville</p>
                                    <p>' . $ville . '</p>
                                </div>
                                <div class="bloc">
                                    <p>ratio contrats</p>
                                    <p>95%</p>
                                </div>
                            </div>
                            <a class="check_profile" href="freelancer_details.php?re_id=' . $resume_id . '&free_id='.$user_id.'">
                                <p>Voir le profil</p>
                                <i class="fa-solid fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>';
        }
        $output.='</div>';
    }else{
        $output = "<p>Aucun profile correspondant</p>";
    }

    echo $output;
}
