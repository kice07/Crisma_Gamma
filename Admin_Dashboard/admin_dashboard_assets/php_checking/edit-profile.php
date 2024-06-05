<?php
session_start();
include('../../../config.php');

$action = $_POST['action'];
$id = $_SESSION['unique_company_id'];

if ($action == "updateInfo") {
    $name = $_POST['name'];
    $mail = $_POST['mail'];
    $country = $_POST['country'];
    $language = $_POST['language'];

    $updatequery = mysqli_query($conn, "UPDATE company SET name ='$name' ,email='$mail' ,pays='$country' ,language='$language' WHERE id='$id'");
    if ($updatequery) {
        $_SESSION['name'] = $name;
        $_SESSION['email'] = $mail;
        $_SESSION['pays'] = $country;
        $_SESSION['language'] = $language;
        echo "success";
    }
} elseif ($action == "updatePassword") {
    if (password_verify($_POST['oldP'], $_SESSION['password'])) {
        $newP = password_hash($_POST['newP'], PASSWORD_BCRYPT);
        $updatequery = mysqli_query($conn, "UPDATE company SET pass='$newP' WHERE id='$id'");
        if ($updatequery) {
            $_SESSION['pass'] = $newP;
            echo "success";
        }
    } else {
        echo "error: password";
    }
}else {

    $chemin_fichier = '../images/company/'. $_SESSION['picture'];

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
        $uploadFileDir = '../images/company/';
        $dest_path = $uploadFileDir . $fileName;

        // Déplacez le fichier téléchargé vers le répertoire de destination
        if (move_uploaded_file($fileTmpPath, $dest_path)) {
            $updatequery = mysqli_query($conn, "UPDATE company SET picture='$fileName' WHERE id='$id'");
            if ($updatequery) {
                $_SESSION['picture'] = $fileName;
                echo "success";
            }
        } else {
            echo 'There was an error moving the uploaded file.';
        }
    } else {
        echo 'There was an error with the file upload.';
    }
}
