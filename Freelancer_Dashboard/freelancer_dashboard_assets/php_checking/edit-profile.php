<?php
session_start();
include('../../../config.php');

$action = $_POST['action'];
$id = $_SESSION['unique_freelancer_id'];

if ($action == "updateInfo") {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $age = $_POST['age'];
    $mail = $_POST['mail'];
    $country = $_POST['country'];
    $language = $_POST['language'];

    $updatequery = mysqli_query($conn, "UPDATE freelancer SET nom ='$firstname' ,prenom='$lastname' ,age='$age' ,email='$mail' ,pays='$country' ,langage='$language' WHERE id='$id'");
    if ($updatequery) {
        $_SESSION['nom'] = $firstname;
        $_SESSION['prenom'] = $lastname;
        $_SESSION['age'] = $age;
        $_SESSION['email'] = $mail;
        $_SESSION['pays'] = $country;
        $_SESSION['language'] = $language;
        echo "success";
    }
} elseif ($action == "updatePassword") {
    if (password_verify($_POST['oldP'], $_SESSION['password'])) {
        $newP = password_hash($_POST['newP'], PASSWORD_BCRYPT);
        $updatequery = mysqli_query($conn, "UPDATE freelancer SET password='$newP' WHERE id='$id'");
        if ($updatequery) {
            $_SESSION['password'] = $newP;
            echo "success";
        }
    } else {
        echo "error: password";
    }
} elseif ($action == "changePlan") {
    $index = (int)$_POST['plan'];
    $plan;
    switch ($index) {
        case 0:
            $plan = 'Platine';
            break;
        case 1:
            $plan = 'Or';
            break;
        case 2:
            $plan = 'Diamant';
    }

    $updatequery = mysqli_query($conn, "UPDATE freelancer SET plan='$plan' WHERE id='$id'");
    if ($updatequery) {
        $_SESSION['plan'] = $plan;
        echo "success";
    }
} elseif ($action == "cancel_plan") {

    $updatequery = mysqli_query($conn, "UPDATE freelancer SET plan=NULL WHERE id='$id'");
    if ($updatequery) {
        echo "success";
    }
} else {

    $chemin_fichier = '../images/freelancer/'. $_SESSION['image'];

    // Vérifier si le fichier existe avant de tenter de le supprimer
    if (file_exists($chemin_fichier)) {
        if (unlink($chemin_fichier)) {
            echo "Le fichier a été supprimé avec succès.";
        } else {
            echo "Erreur lors de la suppression du fichier.";
        }
    }else{
        echo "inexistant";
    }


    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        // Obtenez des informations sur le fichier
        $fileTmpPath = $_FILES['file']['tmp_name'];
        $fileName = $_FILES['file']['name'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        // Définir un répertoire de destination
        $uploadFileDir = '../images/freelancer/';
        $dest_path = $uploadFileDir . $fileName;

        // Déplacez le fichier téléchargé vers le répertoire de destination
        if (move_uploaded_file($fileTmpPath, $dest_path)) {
            $updatequery = mysqli_query($conn, "UPDATE freelancer SET image='$fileName' WHERE id='$id'");
            if ($updatequery) {
                $_SESSION['image'] = $fileName;
                echo "success";
            }
        } else {
            echo 'There was an error moving the uploaded file.';
        }
    } else {
        echo 'There was an error with the file upload.';
    }
}
