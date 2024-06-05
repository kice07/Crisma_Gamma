<?php

include_once "../../../config.php";
session_start();

$id = $_POST['resumeid'];
$free = $_POST['freeid'];
$free_query = mysqli_query($conn, "SELECT nom, prenom, age, pays, image FROM freelancer WHERE id='$free'");
$freelancer = mysqli_fetch_assoc($free_query);

// Préparation des requêtes
$resume_bio_position = mysqli_fetch_assoc(mysqli_query($conn, "SELECT position, bio FROM resume WHERE id='$id'"));
$resume_experience = mysqli_query($conn, "SELECT position, starting_date, ending_date, description FROM resume_experience WHERE resume_id='$id'");
$resume_education = mysqli_query($conn, "SELECT name, starting_date, ending_date, degree FROM resume_education WHERE resume_id='$id'");
$resume_skill = mysqli_query($conn, "SELECT label, level FROM resume_skill WHERE resume_id='$id'");
$resume_lang = mysqli_query($conn, "SELECT label, level FROM resume_language WHERE resume_id='$id'");

// Initialisation de la variable $tosend
$tosend = '
    <img src="admin_dashboard_assets/images/crislogo.png" alt="" class="watermark">
    <!-- top -->
    <div class="top">
        <img src="' . ($freelancer['image'] == '' ? '../Freelancer_Dashboad/freelancer_dashboard_assets/images/freelancer/no_user.png' : '../Freelancer_Dashboard/freelancer_dashboard_assets/images/freelancer/' . $freelancer['image']) . '" alt="">
        <div class="infos">
            <h3>' . $freelancer['nom'] ." ".$freelancer['prenom'] . '</h3>
            <p class="position">' . $resume_bio_position['position'] . '</p>
            <p>' . $freelancer['age'] . ' ans</p>
            <p>' . $freelancer['pays'] . '</p>
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


