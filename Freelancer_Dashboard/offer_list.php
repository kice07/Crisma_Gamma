<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="freelancer_dashboard_assets/css/offer_lists.css">
    <link rel="stylesheet" href="freelancer_dashboard_assets/css/navbar.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css'>

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://emoji-css.afeld.me/emoji.css" rel="stylesheet">

    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <title>CrismaWork | Dashboard | Freelancer | Profile</title>

</head>

<body>


    <!-- Navbar -->
    <!-- <div class="navbar">
        <div class="logo"><img src="freelancer_dashboard_assets/images/crislogo.png" alt=""></div>
        <div class="middle">
            <ul>
                <a href="#">
                    <li class="translate">Liste d'offres</li>
                </a>
                <a href="#">
                    <li class="translate">Portfolio</li>
                </a>
                <a href="#">
                    <li class="translate">Factures</li>
                </a>
                <a href="#">
                    <li class="translate">Candidatures</li>
                </a>
                <a href="#">
                    <li class="translate">Chat</li>
                </a>
            </ul>
        </div>
        <div class="end">
            <img src="https://www.worldometers.info/img/flags/fr-flag.gif" alt="">

            <div class="counter">
                <i class='bx bx-chat'></i>
                <span>2</span>
            </div>

            <div class="counter">
                <i class='bx bx-bell'></i>

            </div>

            <div class="profile"><img src="freelancer_dashboard_assets/images/Ely.jpg" alt=""></div>
        </div>
    </div> -->

    <?php include("navbar.php")?>


    <!-- main -->
    <div class="main_content">
        <div class="banner">
            <h3>Retrouvez toutes vos candidatures</h3>
        </div>


        <div class="container">
            <div class="tab_box">
                <button class="tab_btn translate active">Candidatures acceptée</button>
                <button class="tab_btn translate">En attente</button>
                <button class="tab_btn translate">Refusées</button>
                <button class="tab_btn translate">wishlist</button>
                <div class="line"></div>
            </div>
        </div>
        <div class="content_box">
            <!-- candidature acceptée -->
            <div class="content active">
                
                <div class="filter">
                    <div class="label"><span class="translate">Flitre</span></div>
                    <div class="input_field">
                        <i class="ai-search"></i>
                        <input type="text" placeholder="Nom de l'offre...">
                    </div>
                </div>



                <table>
                    <tr>
                        <th class="translate">Entreprise</th>
                        <th class="translate">Poste</th>
                        <th class="translate">Remuneration</th>
                        <th class="translate">Date de Candidature</th>
                        <th class="translate">Action</th>

                    </tr>
                    <tr>
                        <td>
                            <img src="freelancer_dashboard_assets/images/Google_ logo.png" alt="">
                            <div class="about">
                                <p>Google</p>
                                <p class="translate">Technologie et Ia</p>
                            </div>
                        </td>
                        <td class="ongoing">
                            <p class="translate">Web developpeur</p>
                        </td>
                        <td class="translate">$2500 / mois</td>
                        <td class="translate">21 / 04 /2023</td>
                        <td class="translate">
                            <span>Revoir l’offre</span>
                            <i class="ai-arrow-up-right"></i>
                        </td>
                       

                    </tr>

                </table> 

                
                <div class="counter">
                    <i class="ai-arrow-left" onclick="counter(this,'back')"></i>

                    <div class="numbers">
                        <span>1</span>
                        <span>...</span>
                        <span class="mid number hide">2</span>
                        <span class="mid hide">...</span>
                        <span>20</span>
                    </div>

                    <a href="#" onclick="counter(this,'forth')">
                        <span class="translate">suivant</span>
                        <i class="ai-arrow-right"></i>
                    </a>
                </div>

            </div>

            <!-- candidature en attente -->
            <div class="content">
                <div class="filter">
                    <div class="label"><span class="translate">Flitre</span></div>
                    <div class="input_field">
                        <i class="ai-search"></i>
                        <input type="text" placeholder="Nom de l'offre...">
                    </div>
                </div>



                <table>
                    <tr>
                        <th class="translate">Entreprise</th>
                        <th class="translate">Poste</th>
                        <th class="translate">Remeuneration</th>
                        <th class="translate">Date de Candidature</th>
                        <th class="translate">Action</th>

                    </tr>
                    <tr>
                        <td>
                            <img src="freelancer_dashboard_assets/images/Google_ logo.png" alt="">
                            <div class="about">
                                <p>Google</p>
                                <p class="translate">Technologie et Ia</p>
                            </div>
                        </td>
                        <td class="ongoing">
                            <p class="translate">Web developpeur</p>
                        </td>
                        <td class="translate">$2500 / mois</td>
                        <td class="translate">21 / 04 /2023</td>
                        <td class="translate">
                            <span>Revoir l’offre</span>
                            <i class="ai-arrow-up-right"></i>
                        </td>
                       

                    </tr>

                </table> 

                
                <div class="counter">
                    <i class="ai-arrow-left" onclick="counter(this,'back')"></i>

                    <div class="numbers">
                        <span>1</span>
                        <span>...</span>
                        <span class="mid number hide">2</span>
                        <span class="mid hide">...</span>
                        <span>20</span>
                    </div>

                    <a href="#" onclick="counter(this,'forth')">
                        <span class="translate">suivant</span>
                        <i class="ai-arrow-right"></i>
                    </a>
                </div>
    
            </div>

            <!-- candidature refusée -->
            <div class="content">
                <div class="filter">
                    <div class="label"><span class="translate">Flitre</span></div>
                    <div class="input_field">
                        <i class="ai-search"></i>
                        <input type="text" placeholder="Nom de l'offre...">
                    </div>
                </div>

                <table>
                    <tr>
                        <th class="translate">Entreprise</th>
                        <th class="translate">Poste</th>
                        <th class="translate">Remeuneration</th>
                        <th class="translate">Date de Candidature</th>
                        <th class="translate">Action</th>

                    </tr>
                    <tr>
                        <td>
                            <img src="freelancer_dashboard_assets/images/Google_ logo.png" alt="">
                            <div class="about">
                                <p>Google</p>
                                <p class="translate">Technologie et Ia</p>
                            </div>
                        </td>
                        <td class="ongoing">
                            <p class="translate">Web developpeur</p>
                        </td>
                        <td class="translate">$2500 / mois</td>
                        <td class="translate">21 / 04 /2023</td>
                        <td class="translate">
                            <span>Revoir l’offre</span>
                            <i class="ai-arrow-up-right"></i>
                        </td>
                       

                    </tr>

                </table> 

                
                <div class="counter">
                    <i class="ai-arrow-left" onclick="counter(this,'back')"></i>

                    <div class="numbers">
                        <span>1</span>
                        <span>...</span>
                        <span class="mid number hide">2</span>
                        <span class="mid hide">...</span>
                        <span>20</span>
                    </div>

                    <a href="#" onclick="counter(this,'forth')">
                        <span class="translate">suivant</span>
                        <i class="ai-arrow-right"></i>
                    </a>
                </div>
    
            </div>

            <!-- wishlist -->
            <div class="content">
                <div class="filter">
                    <div class="label"><span class="translate">Flitre</span></div>
                    <div class="input_field">
                        <i class="ai-search"></i>
                        <input type="text" placeholder="Nom de l'offre...">
                    </div>
                </div>

                <div class="job_bloc">

                    <!-- job bloc -->
                    <div class="job">
                        <!-- up job -->
                        <div class="top">
                            <div class="row first">
                                <h3>Web developer</h3>
                                <i class="ai-x-small"></i>
                            </div>
                            <div class="row second">
                                <span class="translate match">correspond a un de vos cv</span>
                                <div class="job_detail">
                                    <span class="translate">Temps plein</span>
                                    <span class="translate">1-2ans</span>
                                    <span class="translate">Un details</span>
                                </div>
                                <span class="translate delay">Il y a 2 min</span>
                                <span class="applier translate"><i class='bx bxs-circle'></i> 2 postulants</span>
                            </div>
                        </div>

                        <!-- bottom job -->
                        <div class="bottom">
                            <div class="salary">
                                <span>15000$</span>
                                <span>/mois</span>
                            </div>
                            <a href="#" class="translate"> plus de details</a>
                        </div>
                    </div>

                    <!-- job bloc -->
                    <div class="job">
                        <!-- up job -->
                        <div class="top">
                            <div class="row first">
                                <h3>Web developer</h3>
                                <i class="ai-cross"></i>
                            </div>
                            <div class="row second">
                                <span class="translate match">correspond a un de vos cv</span>
                                <div class="job_detail">
                                    <span class="translate">Temps plein</span>
                                    <span class="translate">1-2ans</span>
                                    <span class="translate">Un details</span>
                                </div>
                                <span class="translate delay">Il y a 2 min</span>
                                <span class="applier translate"><i class='bx bxs-circle'></i> 2 postulants</span>
                            </div>
                        </div>

                        <!-- bottom job -->
                        <div class="bottom">
                            <div class="salary">
                                <span>15000$</span>
                                <span>/mois</span>
                            </div>
                            <a href="#" class="translate"> plus de details</a>
                        </div>
                    </div>

                </div>

                
                <div class="counter">
                    <i class="ai-arrow-left" onclick="counter(this,'back')"></i>

                    <div class="numbers">
                        <span>1</span>
                        <span>...</span>
                        <span class="mid number hide">2</span>
                        <span class="mid hide">...</span>
                        <span>20</span>
                    </div>

                    <a href="#" onclick="counter(this,'forth')">
                        <span class="translate">suivant</span>
                        <i class="ai-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>



    <!-- Custom js -->
    <script src="https://unpkg.com/akar-icons-fonts"></script>
    <script src="freelancer_dashboard_assets/js/offer_lists.js"></script>
    <script src="freelancer_dashboard_assets/js/translate.js"></script>

</body>

</html>