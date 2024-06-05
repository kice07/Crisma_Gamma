<?php
    session_start();
    include_once "../../../config.php";

    // $outgoing_id = $_SESSION['unique_id'];
    $outgoing_id = 600628041;
    $searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']);

    $sql = "SELECT * FROM freelancer WHERE nom LIKE '%{$searchTerm}%' OR prenom LIKE '%{$searchTerm}%' ";
    $output = "";
    $query = mysqli_query($conn, $sql);
    if(mysqli_num_rows($query) > 0){
        include_once "data.php";
    }else{
        $output .= 'Aucun freelancer correspondante';
    }
    echo $output;
?>