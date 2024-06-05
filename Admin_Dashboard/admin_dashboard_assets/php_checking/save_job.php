<?php
include('../../../config.php');
session_start();

if ($_POST['action'] == "loadSub") {
    $answer = '';
    $id = $_POST['cat_id'];
    $sub_query= mysqli_query($conn,"SELECT label AS subValue FROM job_sub_category WHERE big_cat_id='$id'");
    
    if($sub_query){

        while($row = mysqli_fetch_assoc($sub_query)){
            $answer.=$row['subValue']."/";
        }
       
        echo $answer;
    }else{
        echo mysqli_errno($conn);
    }
    
} elseif($_POST['action'] == "insertJob") {
    
    $company_id = $_SESSION['unique_company_id'];
    $cat = $_POST['cat'];
    $sub_cat = $_POST['sub_cat'];
    $title = $_POST['title'];
    $description = mysqli_real_escape_string($conn,$_POST['description']);
    $skill_tab= json_decode($_POST['skill_tab']);
    $post_date = date('d/m/Y');
    $ending_date = $_POST['ending_date'];
    $applicants = $_POST['applicants'];
    $type = $_POST['type'];
    $experience = $_POST['experience'];
    $frequency = $_POST['frequency'];
    $currency = $_POST['currency'];
    $amount = $_POST['amount'];
    $skills="";

    for($i=0;$i<count($skill_tab)-1;$i++){
        $skills .= $skill_tab[$i].";";
    }
    $skills .= $skill_tab[count($skill_tab)-1];

    $query ="INSERT INTO jobs(title, job_category, job_sub_category, content, currency, salary, job_type, skills, experience, post_date, expire_date, frequence, applicants, company_id) VALUES('$title', '$cat', '$sub_cat', '$description', '$currency', '$amount', '$type', '$skills', '$experience', '$post_date', '$ending_date', '$frequency', '$applicants', '$company_id')";
    $insert_query = mysqli_query($conn,$query);

    if($insert_query){
        echo "success";
    }else{
        echo mysqli_error($conn);
    }
}else{
  
    $cat = $_POST['cat'];
    $sub_cat = $_POST['sub_cat'];
    $title = $_POST['title'];
    $description = mysqli_real_escape_string($conn,$_POST['description']);
    $skill_tab= json_decode($_POST['skill_tab']);
    $post_date = date('d/m/Y');
    $ending_date = $_POST['ending_date'];
    $applicants = $_POST['applicants'];
    $type = $_POST['type'];
    $experience = $_POST['experience'];
    $frequency = $_POST['frequency'];
    $currency = $_POST['currency'];
    $amount = $_POST['amount'];
    $skills="";
    $id = $skill_tab[count($skill_tab)-1];

    for($i=0;$i<count($skill_tab)-2;$i++){
        $skills .= $skill_tab[$i].";";
    }
    $skills .= $skill_tab[count($skill_tab)-2];

    $query ="UPDATE jobs SET title='$title', job_category='$cat', job_sub_category='$sub_cat', content='$description', currency='$currency', salary='$amount', job_type='$type', skills='$skills', experience='$experience', expire_date='$ending_date', frequence='$frequency', applicants='$applicants' WHERE id='$id'";
    $insert_query = mysqli_query($conn,$query);

    if($insert_query){
        echo "success";
    }else{
        echo mysqli_error($conn);
    }
}

