<?php
include("../../../config.php");
session_start();
$action = $_POST['action'];
$id = $_SESSION['unique_company_id'];
if ($action == 'delete') {
    $task = $_POST['task'];
    $date =  $_POST['date'];

    $date = mysqli_real_escape_string($conn, $date);
    $task = mysqli_real_escape_string($conn, $task);
    $delete_query = mysqli_query($conn, "DELETE FROM task WHERE date='$date' AND event='$task' AND person_id='$id'");
    if ($delete_query) {
        echo "success";
    }
} elseif ($action == "update") {

    $ptask = $_POST['pretask'];
    $ntask = $_POST['newtask'];
    $date =  $_POST['date'];

    $ntask = mysqli_real_escape_string($conn, $ntask);
    $date = mysqli_real_escape_string($conn, $date);
    $ptask = mysqli_real_escape_string($conn, $ptask);

    $update_query = mysqli_query($conn, "UPDATE task SET event='$ntask' WHERE date='$date' AND event='$ptask' AND person_id='$id'");
    if ($update_query) {
        echo "success";
    }
} elseif ($action == "insert") {

    $task = $_POST['task'];
    $date =  $_POST['date'];

    $date = mysqli_real_escape_string($conn, $date);
    $task = mysqli_real_escape_string($conn, $task);

    $insert_query = mysqli_query($conn, "INSERT INTO task (date, event, person_id) VALUES ('{$date}', '{$task}', '{$id}')");
    if ($insert_query) {
        echo "success";
    } else {
        echo mysqli_errno($conn);
    }
} elseif ($action == "getDaynTask") {

    $date = $_POST['date'];
    $date = mysqli_real_escape_string($conn, $date);
    $getquery = mysqli_query($conn, "SELECT * FROM task WHERE date='$date' AND person_id='$id'");
    $tosend = "";
    while ($sub = mysqli_fetch_assoc($getquery)) {
        $tosend .= $sub['date'] . "_" . $sub['event'] . "/";
    }
    echo $tosend;
} else {

    // Fonction pour convertir une date au format "12 June 2024" en objet DateTime
    function parseDate($dateString)
    {
        return DateTime::createFromFormat('d F Y', $dateString);
    }

    $date = $_POST['date'];
    // Conversion en objets DateTime
    $parse_given_date = parseDate($date);

    // Extraire le mois et l'année de la date donnée
    $given_month = $parse_given_date->format('m');
    $given_year = $parse_given_date->format('Y');

    $tosend = "";


    // Requête SQL pour obtenir les dates du même mois et de la même année
    $sql = "SELECT date FROM task WHERE MONTH(STR_TO_DATE(date, '%d %M %Y')) = '$given_month' AND YEAR(STR_TO_DATE(date, '%d %M %Y')) = '$given_year' AND person_id='$id'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {

            // Convertir chaque date en objet DateTime
            $task_date_obj =  parseDate($row['date']);;

            // Comparer les dates
            if ($task_date_obj >= $parse_given_date) {
                $tosend .= $row['date'] . "/";
            }
        }

        echo $tosend;
    }else{
        echo "nothing";
    }
}