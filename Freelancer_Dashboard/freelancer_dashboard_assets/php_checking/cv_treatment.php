<?php
include_once "../../../config.php";
session_start();

$output = '';
$purpose = $_POST['purpose'];
if ($purpose == "subcategories") {
   $cat_id = $_POST['cat_id'];
   $get_sub = mysqli_query($conn, "SELECT * FROM job_sub_category WHERE big_cat_id ='{$cat_id}'");
   while ($row = mysqli_fetch_assoc($get_sub)) {
      $output .= ' <li class="cat_lib">' . $row['label'] . '</li>';
   }
   echo $output;
   
} else {


   $freelancer = $_SESSION['unique_freelancer_id'];
   $job_title = $_POST['job_title'];
   $resume_name = $_POST['name'];
   $resume_second_name = $_POST['second_name'];
   $job_category =  $_POST['category'];
   $job_sub_category =  $_POST['sub_category'];
   $bio =  mysqli_real_escape_string($conn, $_POST['bio']) ;

   $experiences = json_decode($_POST['experiences']);
   $educations = json_decode($_POST['educations']);
   $skills = json_decode($_POST['skills']);
   $languages = json_decode($_POST['languages']);

   $id = $resume_name . "_" . $resume_second_name . "_" . $job_title;

   // first insertion : resume
   $sql1 = mysqli_query($conn, "INSERT INTO resume (id, user_id, position, category, sous_category, bio)
   VALUES ('{$id}', '{$freelancer}', '{$job_title}', '{$job_category}', '{$job_sub_category}', '{$bio}')");

   if ($sql1) {
      // second insertion : experiences

      foreach ($experiences as $experience) {
         // Accéder aux attributs de chaque objet
         $position = $experience->position;
         $company = $experience->company;
         $start = $experience->startingDate;
         $end = $experience->endingDate;
         $ville = $experience->ville;
         $description = $experience->description;

         $sql2 = mysqli_query($conn, "INSERT INTO resume_experience (position, company, starting_date, ending_date, city, description, resume_id)
         VALUES ('{$position}', '{$company}', '{$start}', '{$end}', '{$ville}', '{$description}', '{$id}')");

         
      }

      if (!$sql2) {
         echo mysqli_error($conn);
      } else {

         // third insertion : experiences

         foreach ($educations as $education) {
            // Accéder aux attributs de chaque objet
            $school = $education->school;
            $degree = $education->degree;
            $start = $education->startingDate;
            $end = $education->endingDate;
            $ville = $education->ville;
            $description = $education->description;

            $sql3 = mysqli_query($conn, "INSERT INTO resume_education (name, degree, starting_date, ending_date, city, description, resume_id)
         VALUES ('{$school}', '{$degree}', '{$start}', '{$end}', '{$ville}', '{$description}', '{$id}')");

         
         }

         if (!$sql3) {
            echo mysqli_error($conn);
         } else {

            // fourth insertion : skills

            foreach ($skills as $skill) {
               // Accéder aux attributs de chaque objet
               $label = $skill->label;
               $level = $skill->level;


               $sql4 = mysqli_query($conn, "INSERT INTO resume_skill (label, level, resume_id)
               VALUES ('{$label}', '{$level}', '{$id}')");
            }

            if (!$sql4) {
               echo mysqli_error($conn);
            } else {


               // fifth insertion : skills
               foreach ($languages as $language) {
                  // Accéder aux attributs de chaque objet
                  $label = $language->language;
                  $level = $language->level;


                  $sql5 = mysqli_query($conn, "INSERT INTO resume_language (label, level, resume_id)
                  VALUES ('{$label}', '{$level}', '{$id}')");

               }

               if (!$sql5) {
                  echo mysqli_error($conn);
               }else{
                  echo "success";
               }
            }
         }
      }
   }else{
     echo mysqli_error($conn);
   }
}
