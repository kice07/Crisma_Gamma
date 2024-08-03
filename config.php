<?php

$conn = mysqli_connect("srv1266.hstgr.io", "u645835425_kice", "GODis2king#", "u645835425_crismawork");

if (!$conn) {
    echo "Echec de la connexion";
}
 



require __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Accéder aux variables d'environnement
$dbConnection = $_ENV['DB_CONNECTION'];
$dbHost = $_ENV['DB_HOST'];
$dbPort = $_ENV['DB_PORT'];
$dbDatabase = $_ENV['DB_DATABASE'];
$dbUsername = $_ENV['DB_USERNAME'];
$dbPassword = $_ENV['DB_PASSWORD'];

// Connexion à la base de données
$conn = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbDatabase);

if (!$conn) {
    die("Connection failed: ");
}
echo "Connected successfully";

?>
