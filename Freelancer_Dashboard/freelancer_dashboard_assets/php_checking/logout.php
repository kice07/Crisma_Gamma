<?php
include("../../../config.php");
// Hors ligne
session_start();
$id = $_SESION['unique_freelancer_id'];
$sql = mysqli_query($conn, "UPDATE freelancer SET status = 'Hors ligne' WHERE id ='{$id}'");
if ($sql) {
    unset($_SESSION['unique_freelancer_id']);

    // Finalisez la suppression de la session
    session_destroy();
    header("Location: ../../../login_registration.php?side=freelancer");
}
?>