<?php
include("../../../config.php");
session_start();
$new_lang = $_POST['new_lang'];
$update_query= mysqli_query($conn,"UPDATE company SET language ='{$new_lang}' WHERE id='{$_SESSION['unique_company_id']}'" );
if($update_query){
    $_SESSION['language'] = $new_lang;
    echo "success";
}else{
    echo "fail";
}

?>