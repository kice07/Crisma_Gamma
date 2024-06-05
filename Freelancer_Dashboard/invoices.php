<?php

include("../config.php");
session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="freelancer_dashboard_assets/css/invoices.css">
    <link rel="stylesheet" href="freelancer_dashboard_assets/css/navbar.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css'>

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://emoji-css.afeld.me/emoji.css" rel="stylesheet">

    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <title>CrismaWork | Dashboard | Freelancer | invoices</title>

</head>

<body>


    <!--Navbar -->
    <?php include('navbar.php') ?>

    
    <!-- main -->
    <div class="main_content">
        <div class="banner">
            <i class="ai-file"></i>
            <div class="content">
                <h3 class="translate">Percevez votre rémunéraition</h3>
                <button>+ creer une facture</button>
            </div>
        </div>

        <div class="blured"></div>
        <div class="popup success"> C'est reussi</div>
        <div class="popup error">une erreur s'est produite</div>

        <!-- create invoice -->
        <div class="create_invoice">
            <div class="head">
                <p class="translate">creation</p>
                <i class="ai-cross"></i>
            </div>

            <div class="invoice_titles">
                <h3 class="translate">Facture</h3>
                <p>#INV358406</p>
            </div>

            <!-- section -->
            <div class="section">
                <p class="title translate">Details</p>
                <div class="data">
                    <div class="input_field">
                        <span>émetteur</span><br>
                        <input type="text" name="sender">
                    </div>
                    <div class="input_field">
                        <span>Destinataire</span><br>
                        <input type="text" name="receiver" class="receiver">
                    </div>
                </div>

                <div class="input_field">
                    <span>Projet / poste occupé sur le contrat</span><br>
                    <input type="text" name="project_job" class="project_job">
                </div>
            </div>

            <!-- section -->
            <div class="invoice_item">
                <p class="title translate">Element de la facture</p>

                <a href="#">+ Ajouter un élément</a>
            </div>

            <div class="section">
                <p class="title translate">Note</p>
                <textarea name="story" id="story" cols="70" rows="10"></textarea>
            </div>

            <button class="send"> Creer et envoyer</button>
        </div>

        <div class="overview">
            <div class="left">
                <!-- details and option -->
                <div class="detail_options">
                    <div class="top">
                        <span class="translate">solde actuel</span>
                        <p>$7710.3504</p>
                    </div>
                    <div class="bottom">
                        <a href="#">
                            <i class="ai-arrow-cycle"></i>
                            <span class="translate">transferts</span>
                        </a>
                        <a href="#">
                            <i class="ai-arrow-clockwise"></i>
                            <span class="translate">Historiques</span>
                        </a>
                    </div>
                </div>
                <!-- the card -->
                <div class="card">
                    <img class="card_background" src="freelancer_dashboard_assets/images/other/wm2.png" alt="">
                    <div class="line">
                        <i class='bx bx-wifi'></i>
                        <img src="freelancer_dashboard_assets/images/crislogo2.png" alt="">
                    </div>
                    <p class="label">7,247.23</p>
                    <div class="line">
                        <div class="details">
                            <div class="part">
                                <p class="translate">Propriétaire</p>
                                <p>Ehouman K.</p>
                            </div>
                            <div class="part">
                                <p class="translate">Devise</p>
                                <p>USD</p>
                            </div>
                        </div>
                        <img src="freelancer_dashboard_assets/images/other/chip.png" alt="">
                    </div>
                </div>
            </div>

            <div class="right">
                <div class="bloc">
                    <i class="ai-clock"></i>
                    <div class="label">
                        <span class="translate">En attente</span>
                        <p>$4000</p>
                    </div>
                </div>
                <div class="bloc">
                    <i class="ai-cross"></i>
                    <div class="label">
                        <span class="translate">Refusé ou annulé</span>
                        <p>$2500</p>
                    </div>
                </div>
            </div>

        </div>

        <div class="titles">
            <h4 class="translate">Factures</h4>
            <button>
                <i class="ai-cloud-download"></i>
                <span>Rapport</span>
            </button>
        </div>

        <!-- Table and display -->
        <div class="recap">
            <div class="left">
                <!-- ended , ongoing , failed -->
                <table>

                    <tr>
                        <th class="translate">Numero</th>
                        <th class="translate">Entreprise</th>
                        <th class="translate">Date</th>
                        <th class="translate">statut</th>
                        <th class="translate">Montant</th>
                        <th class="translate">Action</th>

                    </tr>
                    <tr>
                        <td class="translate">#Inv385408</td>
                        <td class="company_data">
                            <img src="freelancer_dashboard_assets/images/Google_ logo.png" alt="">
                            <p>Google</p>
                        </td>
                        <td class="translate">Mar 23 , 2023 - 18 : 42</td>
                        <td class="ongoing">
                            <p class="translate">en cours</p>
                        </td>
                        <td class="translate">$5000</td>

                        <td><i class="ai-eye-open"></i></td>

                    </tr>

                    <tr>
                        <td class="translate">#Inv385408</td>
                        <td class="company_data">
                            <img src="freelancer_dashboard_assets/images/Google_ logo.png" alt="">
                            <p>Google</p>
                        </td>
                        <td class="translate">Mar 23 , 2023 - 18 : 42</td>
                        <td class="ongoing">
                            <p class="translate">en cours</p>
                        </td>
                        <td class="translate">$5000</td>

                        <td><i class="ai-eye-open"></i></td>

                    </tr>

                    <tr>
                        <td class="translate">#Inv385408</td>
                        <td class="company_data">
                            <img src="freelancer_dashboard_assets/images/Google_ logo.png" alt="">
                            <p>Google</p>
                        </td>
                        <td class="translate">Mar 23 , 2023 - 18 : 42</td>
                        <td class="failed">
                            <p class="translate">Annulé</p>
                        </td>
                        <td class="translate">$5000</td>

                        <td><i class="ai-eye-open"></i></td>

                    </tr>

                    <tr>
                        <td class="translate">#Inv385408</td>
                        <td class="company_data">
                            <img src="freelancer_dashboard_assets/images/Google_ logo.png" alt="">
                            <p>Google</p>
                        </td>
                        <td class="translate">Mar 23 , 2023 - 18 : 42</td>
                        <td class="ended">
                            <p class="translate">effectué</p>
                        </td>
                        <td class="translate">$5000</td>

                        <td><i class="ai-eye-open"></i></td>

                    </tr>

                    <tr>
                        <td class="translate">#Inv385408</td>
                        <td class="company_data">
                            <img src="freelancer_dashboard_assets/images/Google_ logo.png" alt="">
                            <p>Google</p>
                        </td>
                        <td class="translate">Mar 23 , 2023 - 18 : 42</td>
                        <td class="ongoing">
                            <p class="translate">en cours</p>
                        </td>
                        <td class="translate">$5000</td>

                        <td><i class="ai-eye-open"></i></td>

                    </tr>


                </table>

                <div class="counter">
                    <i class="ai-arrow-left"></i>

                    <div class="numbers">
                        <span>1</span>
                        <span>...</span>
                        <span class="mid number hide">2</span>
                        <span class="mid hide">...</span>
                        <span>20</span>
                    </div>

                    <a href="#">
                        <span class="translate">suivant</span>
                        <i class="ai-arrow-right"></i>
                    </a>
                </div>

            </div>

            <!-- display -->
            <div class="display">

            </div>
        </div>

    </div>



    <!-- Custom js -->
    <script src="https://unpkg.com/akar-icons-fonts"></script>
    <script src="freelancer_dashboard_assets/js/invoices.js"></script>
    <script src="freelancer_dashboard_assets/js/translate.js"></script>

</body>

</html>