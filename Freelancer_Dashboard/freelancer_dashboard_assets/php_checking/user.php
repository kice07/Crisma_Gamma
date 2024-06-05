<?php
    session_start();
    include_once "../../../config.php";
    $cpt=0;
    $outgoing_id = $_SESSION['unique_freelancer_id'];
    $sql = "SELECT * FROM company ORDER BY id DESC";
    $query = mysqli_query($conn, $sql);
    $output = "";
    if(mysqli_num_rows($query) == 0){
        $output .= "Aucune entreprise disponible";
    }elseif(mysqli_num_rows($query) > 0){
        include_once "data.php";
    }
    echo $output;
?>