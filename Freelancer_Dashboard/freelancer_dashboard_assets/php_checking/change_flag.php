<?php
include("../../../config.php");
session_start();
$new_lang = $_POST['new_lang'];
$update_query= mysqli_query($conn,"UPDATE freelancer SET langage ='{$new_lang}' WHERE id='{$_SESSION['unique_freelancer_id']}'" );
if($update_query){
    $_SESSION['language'] = $new_lang;
    echo "success";
}else{
    echo "fail";
}

?>