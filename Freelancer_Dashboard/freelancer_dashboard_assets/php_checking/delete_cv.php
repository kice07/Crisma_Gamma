<?php
 include("../../../config.php");

 $resume_id = $_GET['resume_id'];
 $delete_cv = mysqli_query($conn,"DELETE FROM resume WHERE id ='{$resume_id}'");

 if($delete_cv){
    header("Location: ../../profile.php");
 }else{
    echo "zuut";
 }

?>