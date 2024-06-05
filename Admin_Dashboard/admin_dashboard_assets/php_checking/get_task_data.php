<?php
include("../../../config.php");
session_start();

$user_id = $_SESSION['unique_company_id'];
if (isset($_POST['action'])) {
   
    $date = $_POST['day'];
    $rest =$_POST['rest'];
 
    $get_query = mysqli_query($conn, "SELECT * FROM task WHERE daynumber ={$date} AND rest ='{$rest}' AND person_id ='{$user_id}' ORDER BY task_id ASC");

    if($get_query){
        if(mysqli_num_rows($get_query)>0){
 
            while($row = mysqli_fetch_assoc($get_query)){
                echo $row['task_id'] . "-" .$row['event']." ";
            }
           
        }else{
            echo "nothing";
        }
    }else{
        echo mysqli_error($conn);
    }
    
    
   


} else {
    $jourDuMois = date('j');
    $moisEtAnnee = date('F Y');

    $segment = explode(" ", $moisEtAnnee);
    switch ($segment[0]) {
        case "January":
            $moisEtAnnee = "Janvier ".$segment[1];
            break;
        case "February":
            $moisEtAnnee = "Fevrier ".$segment[1];
            break;
        case "March":
            $moisEtAnnee = "Mars ".$segment[1];
            break;
       case "April":
            $moisEtAnnee = "Avril ".$segment[1];
            break;
        case "May":
            $moisEtAnnee = "Mai ".$segment[1];
            break;
        case "June":
            $moisEtAnnee = "Juin ".$segment[1];
            break;
        case "July":
            $moisEtAnnee = "Julliet ".$segment[1];
            break;
        case "August":
            $moisEtAnnee = "Août ".$segment[1];
            break;                             
        case "September":
            $moisEtAnnee = "Septembre ".$segment[1];
            break;
        case "October":
            $moisEtAnnee = "Octobre ".$segment[1];
            break;
        case "November":
            $moisEtAnnee = "Novembre ".$segment[1];
            break;
        case "December":
            $moisEtAnnee = "Decembre ".$segment[1];
            break;            
        default:
            echo "Ce n'est pas un jour de la semaine valide.";
            break;
    }



    $get_query = mysqli_query($conn, "SELECT DISTINCT daynumber FROM task WHERE daynumber >= {$jourDuMois} AND rest ='{$moisEtAnnee}' AND person_id = '{$user_id}' ORDER BY  daynumber ASC, task_id ASC");
    $rownum = mysqli_num_rows($get_query);

    if(!$get_query){
      echo mysqli_error($conn);   
    }

    if ($rownum > 0) {

        while ($row = mysqli_fetch_assoc($get_query)) {
            echo $row['daynumber']." ";
            // echo "\n";
        }
    } else {
        echo "nothing";
    }
}
