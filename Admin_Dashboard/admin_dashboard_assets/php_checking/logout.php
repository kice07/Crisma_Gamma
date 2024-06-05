<?php
include("../../../config.php");
// Hors ligne
session_start();
$id = $_SESION['unique_company_id'];
$sql = mysqli_query($conn, "UPDATE company SET status = 'Hors ligne' WHERE id ='{$id}'");
if ($sql) {
    unset($_SESSION['unique_company_id']);

    // Finalisez la suppression de la session
    session_destroy();
    header("Location: ../../../login_registration.php?side=company");
}
?>
