<?php
session_start();
include('../config.php');

$cat_query = mysqli_query($conn, "SELECT * FROM job_category");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="freelancer_dashboard_assets/css/Create_portfolio.css">
    <link rel="stylesheet" href="freelancer_dashboard_assets/css/navbar.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css'>

    <link rel="icon" href="freelancer_dashboard_assets/images/crislogo.png" type="image/png">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://emoji-css.afeld.me/emoji.css" rel="stylesheet">

    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <title>CrismaWork | Dashboard | Freelancer | create_resume</title>

</head>

<body>


    <!-- Navbar -->
    <?php include('navbar.php') ?>

    <div class="banner">

        <h3 class="translate">C’est un nouveau chemin s’offre à vous</h3>
    </div>
    <div class="blured"></div>
    <div class="main_content">

        <div class="success">
            <p>Felicitation , votre CV a été crée avec succès</p>
            <button class="back"><a href="profile.php">retour</a></button>
        </div>

        <!-- left-side -->
        <div class="left-side">
            <p class="error"></p>
            <form action="#">

                <!-- PERSONNAL DETAIL -->
                <div class="personal_detail">
                    <h3>Details Personnels</h2>

                        <div class="field thumbnail">
                            <div class="left">
                                <span class="label">Titre du poste</span><br>
                                <input type="text" name="job_title" class="job_title" placeholder="ex: Web Designer">
                            </div>
                            <img src=<?php echo ($_SESSION['image']  =='' ) ?"freelancer_dashboard_assets/images/freelancer/no_user.png": "freelancer_dashboard_assets/images/freelancer/" . $_SESSION['image'] ?> alt="">
                        </div>


                        <div class="field">
                            <div class="left">
                                <span class="label">Nom</span><br>
                                <input type="text" name="first_name" class="first_name" value="<?php echo $_SESSION['nom'] ?>" readonly>
                            </div>

                            <div class="right">
                                <span class="label">Prenom</span><br>
                                <input type="text" name="second_name" class="second_name" value="<?php echo $_SESSION['prenom'] ?>" readonly>
                            </div>

                        </div>


                        <div class="field">
                            <div class="left">
                                <span class="label">Pays</span><br>
                                <input type="text" name="country" class="country" value="<?php echo $_SESSION['pays'] ?>" readonly>
                            </div>

                            <!-- <div class="right">
                                <span class="label">ville</span><br>
                                <input type="text" name="city" class="city" value="Abuja" readonly>
                            </div> -->

                            <div class="right">

                                <span class="label">categorie</span>
                                <div class="select_input">
                                    <div class="head">
                                        <input type="text" name="resume_category" class="resume_category" placeholder="selectionnez une catégorie" readonly>
                                    </div>
                                    <ul class="cat">
                                        <?php
                                        while ($row = mysqli_fetch_assoc($cat_query)) {
                                        ?>
                                            <li class="cat_lib" cat_id="<?php echo $row['id'] ?>"><?php echo $row['label'] ?></li>
                                        <?php
                                        }
                                        ?>

                                    </ul>

                                </div>

                            </div>
                        </div>

                        <div class="field">


                            <div class="left">
                                <span class="label">sous categorie</span>

                                <div class="select_input">
                                    <div class="head">
                                        <input type="text" name="resume_sub_category" class="resume_sub_category" placeholder="selectionnez une sous catégorie" readonly>
                                    </div>
                                    <ul class="sub_cat">

                                    </ul>

                                </div>

                            </div>


                        </div>


                </div>


                <!-- BIO -->
                <div class="professional_summary">
                    <h3>Details Personnels</h3>
                    <span class="description">
                        Écrivez 2 à 4 phrases courtes et énergiques pour intéresser le lecteur !
                        Mentionnez votre rôle, votre expérience et, surtout,
                        vos plus grandes réalisations, vos meilleures qualités et compétences.
                    </span>

                    <div class="textarea_field">
                        <textarea id="story" class="story" name="story" rows="15" cols="80">

                        </textarea><br><br>
                        <div class="checker">
                            <span>Conseil: écrivez 50 à 200 caractères pour augmenter
                                les chances d'entretien.</span>
                            <div class="limit">
                                <span class="counter">0</span><span>/200</span>
                                <i class="em em-slightly_smiling_face"></i>
                                <!-- <i class="em em-disappointed" aria-role="presentation" aria-label="DISAPPOINTED FACE"></i> -->
                            </div>
                        </div>
                    </div>

                </div>


                <!-- EMPLOYEMENT TRACK -->
                <div class="employment_history">
                    <h3>Experience professionel</h3>
                    <span class="description">
                        Recensé vos experience professionel pertinente ,
                        listez vos taches effectuées avec des point si possible
                        pour qu'elles soient prises en compte.
                    </span><br><br>


                    <span class="add">+ Ajouter une experience</span>

                </div>


                <!-- EDUCATION  TRACK-->
                <div class="education_history">
                    <h3>Education</h3>
                    <span class="description">
                        une education pertinente soldée
                        par des diplomes augmentes vos chances de te distinguer
                    </span><br><br>



                    <span class="add">+ Ajouter une autre experience</span>

                </div>


                <!-- SKILLS -->
                <div class="skills">
                    <h3>Compétences</h3>
                    <span class="description">
                        Choisissez des compétences qui correspondent au poste pour lequel
                        vous postulez
                    </span><br><br>


                    <span class="secondAdd">+ Ajouter une competence</span>

                </div>


                <!-- LANGUGES -->
                <div class="languages">
                    <h3>Langue</h3>
                    <span class="description">
                        selectionnez les langues que vous parlez
                    </span><br><br>


                    <span class="secondAdd">+ Ajouter une langue</span>

                </div>




                <button type="button" class="sendButton">Enregistrer</button>

            </form>

        </div>

        <!-- right-side -->
        <div class="right-side">

            <div class="cv_file">
                <img src="freelancer_dashboard_assets/images/crislogo.png" alt="" class="watermark">

                <!-- top -->
                <div class="top">
                    <img src==<?php echo ($_SESSION['image']  =='' ) ?"freelancer_dashboard_assets/images/freelancer/no_user.png": "freelancer_dashboard_assets/images/freelancer/" . $_SESSION['image'] ?> alt="">
                    <div class="infos">
                        <h3><?php echo $_SESSION['nom']." ".$_SESSION['prenom']?></h3>
                        <p class="position"></p>
                        <p><?php echo $_SESSION['age']." "?> ans</p>
                        <p><?php echo $_SESSION['pays']?></p>
                    </div>
                </div>

                <!-- bio -->
                <div class="section preview_about">
                    <p class="title translate">A PROPOS</p>
                    <p></p>
                </div>

                <!-- experience -->
                <div class="section preview_experience">
                    <p class="title translate">EXPERIENCES</p>

                </div>


                <!-- school -->
                <div class="section preview_school">
                    <p class="title translate">ETUDES ET DIPLOME</p>

                </div>

                <!-- skill -->
                <div class="section preview_skill">
                    <p class="title translate">COMPETENCES</p>

                </div>

                <!-- lang -->
                <div class="section preview_language">
                    <p class="title translate">LANGUAGE</p>

                </div>
            </div>
        </div>



    </div>

    </div>



    <!-- Custom js -->
    <script src="https://unpkg.com/akar-icons-fonts"></script>
    <script src="freelancer_dashboard_assets/js/second_create_portfolio.js"></script>
    <script src="freelancer_dashboard_assets/js/create_portfolio.js"></script>
    <script src="freelancer_dashboard_assets/js/translate.js"></script>

</body>

</html>