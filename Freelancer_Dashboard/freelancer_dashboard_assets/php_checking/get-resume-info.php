<?php

include_once "../../../config.php";
session_start();

$id = $_POST['id'];

// Préparation des requêtes
$resume_bio_position = mysqli_fetch_assoc(mysqli_query($conn, "SELECT position, bio FROM resume WHERE id='$id'"));
$resume_experience = mysqli_query($conn, "SELECT position, starting_date, ending_date, description FROM resume_experience WHERE resume_id='$id'");
$resume_education = mysqli_query($conn, "SELECT name, starting_date, ending_date, degree FROM resume_education WHERE resume_id='$id'");
$resume_skill = mysqli_query($conn, "SELECT label, level FROM resume_skill WHERE resume_id='$id'");
$resume_lang = mysqli_query($conn, "SELECT label, level FROM resume_language WHERE resume_id='$id'");

// Initialisation de la variable $tosend
$tosend = '
    <img src="freelancer_dashboard_assets/images/crislogo.png" alt="" class="watermark">
    <!-- top -->
    <div class="top">
        <img src="' . ($_SESSION['image'] == '' ? 'freelancer_dashboard_assets/images/freelancer/no_user.png' : 'freelancer_dashboard_assets/images/freelancer/' . $_SESSION['image']) . '" alt="">
        <div class="infos">
            <h3>' . $_SESSION['nom'] . '</h3>
            <p class="position">' . $resume_bio_position['position'] . '</p>
            <p>' . $_SESSION['age'] . ' ans</p>
            <p>' . $_SESSION['pays'] . '</p>
        </div>
    </div>
    <!-- bio -->
    <div class="section bio">
        <p class="title translate">À PROPOS</p>
        <p>' . $resume_bio_position['bio'] . '</p>
    </div>
    <!-- experience -->
    <div class="section">
        <p class="title translate">EXPÉRIENCES</p>
        <div class="exp_bloc">';

while ($row = mysqli_fetch_assoc($resume_experience)) {
    $tosend .= '<div class="exp">
        <div class="head">
            <p class="title">' . $row['position'] . '</p>
            <span>' . $row['starting_date'] . ' - ' . $row['ending_date'] . '</span>
        </div>
        <div class="content">' . $row['description'] . '</div>
    </div>';
}

$tosend .= '</div>
    </div>
    <!-- school -->
    <div class="section">
        <p class="title translate">ÉTUDES ET DIPLÔME</p>
        <div class="sch_bloc">';

while ($row = mysqli_fetch_assoc($resume_education)) {
    $tosend .= '<div class="sch">
        <p class="title">' . $row['degree'] . ' (' . $row['name'] . ')</p>
        <span>' . $row['starting_date'] . ' - ' . $row['ending_date'] . '</span>
    </div>';
}

$tosend .= '</div>
    </div>
    <!-- skill -->
    <div class="section">
        <p class="title translate">COMPÉTENCES</p>
        <div class="skill_bloc">';

while ($row = mysqli_fetch_assoc($resume_skill)) {
    $tosend .= '<span>' . $row['label'] . ' (' . $row['level'] . ')</span>';
}

$tosend .= '</div>
    </div>
    <!-- lang -->
    <div class="section">
        <p class="title translate">LANGUE</p>
        <div class="lang_bloc">';

while ($row = mysqli_fetch_assoc($resume_lang)) {
    $tosend .= '<span>' . $row['label'] . ' (' . $row['level'] . ')</span>';
}

$tosend .= '</div>
    </div>';

echo $tosend;
?>


