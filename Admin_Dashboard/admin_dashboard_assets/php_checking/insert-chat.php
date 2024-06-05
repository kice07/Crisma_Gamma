<?php
session_start();

include_once "../../../config.php";
// $outgoing_id = $_SESSION['unique_id'];
$outgoing_id = 600628041;
$incoming_id = $_POST['freelancer'];
$msg = mysqli_real_escape_string($conn, $_POST['message']);
$type = mysqli_real_escape_string($conn, $_POST['type']);
$size = $_POST['size'];
$time =  mysqli_real_escape_string($conn, $_POST['date']);
$date = $_POST['day']."/".$_POST['month']."/".$_POST['year'];
$state = mysqli_real_escape_string($conn, $_POST['state']);
if (!isset($_FILES['file'])) {

    if (!empty($msg)) {
        $sql = mysqli_query($conn, "INSERT INTO message (incoming_msg_id, outgoing_msg_id, msg, type, size, state, time, date)
                                        VALUES ({$incoming_id}, {$outgoing_id}, '{$msg}', '{$type}', {$size}, '{$state}', '{$time}', '{$date}')");
        if ($sql) {
            echo "success";
        } else {
            echo mysqli_error($conn);
        }
    }
} else {

    $parentDirectoryPath = '../pdf_sent/company-' . $outgoing_id . "/"; // Chemin du répertoire parent
    $fileP = 'admin_dashboard_assets/pdf_sent/company-'. $outgoing_id . "/";
    // Vérifier si le répertoire parent existe, sinon le créer
    if (!file_exists($parentDirectoryPath)) {
        mkdir($parentDirectoryPath, 0777, true); // Créer le répertoire parent avec les permissions 0777
    }

    // Créer un nouveau répertoire à l'intérieur du répertoire par
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];

    // Renommer le fichier
    $newFileName = $outgoing_id ."_".$incoming_id."_".$fileName ; // Nouveau nom du fichier

    // Chemin complet du fichier de destination
    $destination = $parentDirectoryPath . $newFileName;
   

    if (move_uploaded_file($fileTmpName, $destination)) {

        $fileF = $fileP . $newFileName;
        // Fichier déplacé fivec succès

        $sql = mysqli_query($conn, "INSERT INTO message (incoming_msg_id, outgoing_msg_id, msg, type, path, size, state, time, date)
                                        VALUES ({$incoming_id}, {$outgoing_id}, '{$msg}', '{$type}', '{$fileF}', {$size}, '{$state}', '{$time}', '{$date}')");
        if ($sql) {
            echo "success";
        } else {
            echo mysqli_error($conn);
        }
    } else {
        // Erreur lors du déplacement du fichier
        // http_response_code(500); // Erreur serveur interne
        echo 'Erreur lors du téléchargement du fichier.';
    }
}
