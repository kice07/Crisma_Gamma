<?php
include('../config.php');
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin_dashboard_assets/css/Profile.css">
    <link rel="stylesheet" href="admin_dashboard_assets/css/navbar.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css'>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <link rel="icon" href="admin_dashboard_assets/images/crislogo.png" type="image/png">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <title>CrismaWork | Dashboard | Profile</title>
</head>

<body>

    <?php include("navbar.php") ?>
    <!-- main -->
    <div class="main_content">
        <div class="banner">
        </div>

        <div class="main_info">
            <div class="left">
                <img src=<?php echo ($_SESSION['picture']  =='' ) ?"admin_dashboard_assets/images/Building-bro.png": "admin_dashboard_assets/images/company/" . $_SESSION['picture'] ?> alt="">
                <i class='bx bxs-camera'></i>
                <input type="file" name="" class="profile_pic" hidden>
            </div>
            <div class="right">
                <h3><?php echo $_SESSION['name']?> </h3>
                <span>Entreprise</span>
            </div>
        </div>

        <div class="details_options">
            <div class="left">
                <p>Modifier votre profile</p>
                <p>Mot de passe et sécurité</p>
                <!-- <p>plan et souscriprtion</p> -->
            </div>
            <div class="right">

                <!--Modification de profil-->
                <div class="case first" style="display: none;">
                    <div class="top_line">
                        <p>Modifier votre profile</p>
                        <div class="modif-date">
                            <span>dernière modification:</span>
                            <span> 1 févirier 2024</span>
                        </div>

                    </div>
                    <div class="content">
                    <p class="error">Remplissez tous les champs</p>
                        <div class="inputs_bloc">

                            <div class="input_field">
                                <span class="translate">Entreprise</span><br>
                                <input type="text" name="name"
                                 class="name" value="<?php echo $_SESSION['name']?>">
                            </div>


                            <div class="input_field">
                                <span class="translate">Mail</span><br>
                                <input type="text" name="mail"
                                class="mail" value="<?php echo $_SESSION['email']?>">
                            </div>

                            <div class="input_field">
                                <span class="translate">Localisation</span><br>
                                <input type="text" name="country"
                                class="country" value="<?php echo $_SESSION['location']?>">
                            </div>

                            <div class="input_field">
                                <span class="translate">Langue</span><br>
                                <input type="text" name="language"
                                class="language" value="<?php echo ($_SESSION['language']=="fr")?"français":"anglais"?>">
                            </div>
                        </div>
                        <button onclick="updateInfo(this)">Sauvegarder</button>
                    </div>
                </div>

                <!--Mot de passe et sécurité-->
                <div class="case second" style="display: none;">
                    <div class="top_line">
                        <p>Mot de passe et sécurité</p>
                        <div class="modif-date">
                            <span>dernière modification:</span>
                            <span> 1 févirier 2024</span>
                        </div>

                    </div>
                    <div class="content">
                    <p class="error2">Remplissez tous les champs</p>
                        <div class="inputs_bloc">

                        <div class="input_field">
                                <span class="translate">Ancien mot de passe</span><br>
                                <input type="password" name="old_password" class="old_password">
                            </div>

                            <div class="input_field">
                                <span class="translate">Nouveau mot de passe</span><br>
                                <input type="password" name="new_password" class="new_password">
                            </div>

                            <div class="input_field">
                                <span class="translate">Confirmation du nouveua mot de passe</span><br>
                                <input type="password" name="confirm_new_password" class="confirm_new_password">
                            </div>


                        </div>
                        <button onclick="changePassword(this)">Changer</button>
                    </div>
                </div>

            </div>
        </div>


    </div>





    <!-- Custom js -->
    <script src="https://unpkg.com/akar-icons-fonts"></script>
    <script src="admin_dashboard_assets/js/Profile.js"></script>
    <!-- <script src="admin_dashboard_assets/js/freelancer.js"></script> -->
    <!-- <script src="admin_dashboard_assets/js/translate.js"></script> -->

</body>

</html>