<?php

session_start();
include('../config.php');
$plan = $_SESSION['plan'];
$fileContent = file_get_contents('freelancer_dashboard_assets/subscripion_plan.txt');
$planDetails;
function extractPlanDetails($plan, $content)
{
    $lines = explode("\n", $content);
    $isInSection = false;
    $sectionLines = [];

    foreach ($lines as $line) {
        $trimmedLine = trim($line);
        if ($trimmedLine === "-$plan") {
            $isInSection = true;
            continue;
        }

        if (strpos($trimmedLine, '-') === 0 && $isInSection) {
            break; // Sortir de la boucle quand une nouvelle section est rencontrée
        }

        if ($isInSection) {
            $sectionLines[] = $line;
        }
    }

    return $sectionLines;
}

if (isset($plan)) {
    $planDetails = extractPlanDetails($plan, $fileContent);
}
// Récupérer les détails du plan correspondant


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="freelancer_dashboard_assets/css/Profile.css">
    <link rel="stylesheet" href="freelancer_dashboard_assets/css/navbar.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css'>

    <link rel="icon" href="freelancer_dashboard_assets/images/crislogo.png" type="image/png">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://emoji-css.afeld.me/emoji.css" rel="stylesheet">

    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <title>CrismaWork | Dashboard | Freelancer | Profile</title>

</head>

<body>


    <!-- Navbar -->
    <?php include('navbar.php') ?>

    <!-- main -->
    <div class="main_content">
        <div class="banner">
        </div>

        <div class="main_info">
            <div class="left">
                <img src=<?php echo ($_SESSION['image']  =='' ) ?"freelancer_dashboard_assets/images/freelancer/no_user.png": "freelancer_dashboard_assets/images/freelancer/" . $_SESSION['image'] ?> alt="">
                <i class='bx bxs-camera'></i>
                <input type="file" name="" class="profile_pic" hidden>
            </div>
            <div class="right">
                <h3><?php echo $_SESSION['nom'] . " " . $_SESSION['prenom'] ?> </h3>
                <span>Freelancer</span>
            </div>
        </div>

        <div class="details_options">
            <div class="left">
                <p>Modifier votre profile</p>
                <p>Mot de passe et sécurité</p>
                <p>plan et souscription</p>
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
                                <span class="translate">Nom</span><br>
                                <input type="text" name="firstname" class="firstname" value="<?php echo $_SESSION['nom'] ?>">
                            </div>

                            <div class="input_field">
                                <span class="translate">Prenom</span><br>
                                <input type="text" name="lastname" class="lastname" value="<?php echo $_SESSION['prenom'] ?>">
                            </div>

                            <div class="input_field">
                                <span class="translate">Age</span><br>
                                <input type="text" name="age" class="age" value="<?php echo $_SESSION['age'] ?>">
                            </div>


                            <div class="input_field">
                                <span class="translate">Mail</span><br>
                                <input type="text" name="mail" class="mail" value="<?php echo $_SESSION['email'] ?>">
                            </div>

                            <div class="input_field">
                                <span class="translate">Pays</span><br>
                                <input type="text" name="country" class="country" value="<?php echo $_SESSION['pays'] ?>">
                            </div>

                            <div class="input_field">
                                <span class="translate">Langue</span><br>
                                <input type="text" name="language" class="language" value="<?php echo ($_SESSION['language'] == "fr") ? "français" : "english" ?>">
                            </div>

                            <div class="input_field">
                                <span class="translate">Disponibilité</span><br>
                                <input type="text" name="availability" class="availability" value="<?php echo $_SESSION['availability']?>">
                            </div>
                        </div>
                        <button class="translate" onclick="updateInfo(this)">Sauvegarder</button>
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

                <!--plan et souscriprtion-->
                <div class="case third" style="display: none;">
                    <div class="top_line">
                        <p>Plan de souscription</p>
                        <div class="modif-date">
                            <span>dernière modification:</span>
                            <span> 1 févirier 2024</span>
                        </div>

                    </div>
                    <div class="content">
                        <?php
                        if (isset($planDetails)) {
                        ?>
                            <div class="offer_bloc">
                                <span class="label"><?php echo $plan ?></span>
                                <p class="price"><?php echo $planDetails[0]?></p>
                                <div class="options_list">

                                    <?php
                                    for ($i = 1; $i < 4; $i++) {
                                    ?>
                                        <div class="op">
                                            <i class="ai-circle-check"></i>
                                            <p class="translate"><?php echo $planDetails[$i]?></p>
                                        </div>

                                    <?php
                                    }?>

                                </div>
                                <button class="annuler" onclick="cancelPlan(this)">annuler</button>
                            </div>

                        <?php }?>


                        <button class="change_offer" onclick="newPlan()">nouveau plan</button>
                    </div>
                </div>

                <div class="popup_subscription">

                    <p class="head_title">Choisissez le plan qui vous convient</p>
                    <i class="ai-cross" onclick="closePopup(this)"></i>
                    <div class="content">
                        <div class="offer_bloc">
                            <div class="top">
                                <span class="label">Platine</span>
                                <i class="ai-circle-check"></i>
                                <i class="ai-circle-check-fill"></i>
                            </div>

                            <p class="price">$20 / mois</p>

                            <div class="options_list">

                                <div class="op">
                                    <i class="ai-circle-check"></i>
                                    <p class="translate">+5 cv</p>
                                </div>

                                <div class="op">
                                    <i class="ai-circle-check"></i>
                                    <p class="translate">Bon positionnement de cv </p>
                                </div>

                                <div class="op">
                                    <i class="ai-circle-check"></i>
                                    <p class="translate">un autre avantage</p>
                                </div>

                                <div class="op">
                                    <i class="ai-circle-check"></i>
                                    <p class="translate">un autre avantage</p>
                                </div>
                            </div>

                        </div>

                        <div class="offer_bloc">
                            <div class="top">
                                <span class="label">or</span>
                                <i class="ai-circle-check"></i>
                                <i class="ai-circle-check-fill"></i>
                            </div>
                            <p class="price">$20 / mois</p>
                            <div class="options_list">

                                <div class="op">
                                    <i class="ai-circle-check"></i>
                                    <p class="translate">+5 cv</p>
                                </div>

                                <div class="op">
                                    <i class="ai-circle-check"></i>
                                    <p class="translate">Bon positionnement de cv </p>
                                </div>

                                <div class="op">
                                    <i class="ai-circle-check"></i>
                                    <p class="translate">un autre avantage</p>
                                </div>

                                <div class="op">
                                    <i class="ai-circle-check"></i>
                                    <p class="translate">un autre avantage</p>
                                </div>
                            </div>

                        </div>

                        <div class="offer_bloc">
                            <div class="top">
                                <span class="label">Diamant</span>
                                <i class="ai-circle-check"></i>
                                <i class="ai-circle-check-fill"></i>
                            </div>
                            <p class="price">$20 / mois</p>
                            <div class="options_list">

                                <div class="op">
                                    <i class="ai-circle-check"></i>
                                    <p class="translate">+5 cv</p>
                                </div>

                                <div class="op">
                                    <i class="ai-circle-check"></i>
                                    <p class="translate">Bon positionnement de cv </p>
                                </div>

                                <div class="op">
                                    <i class="ai-circle-check"></i>
                                    <p class="translate">un autre avantage</p>
                                </div>

                                <div class="op">
                                    <i class="ai-circle-check"></i>
                                    <p class="translate">un autre avantage</p>
                                </div>
                            </div>

                        </div>

                    </div>
                    <button class="choose_offer" onclick="chosePlan(this)">choisir</button>
                </div>
            </div>
        </div>


    </div>



    <!-- Custom js -->
    <script src="https://unpkg.com/akar-icons-fonts"></script>
    <script src="freelancer_dashboard_assets/js/Profile.js"></script>

    <script src="freelancer_dashboard_assets/js/translate.js"></script>



</body>

</html>