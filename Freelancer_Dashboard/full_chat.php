<?php

include("../config.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="freelancer_dashboard_assets/css/full_chat.css">
    <link rel="stylesheet" href="freelancer_dashboard_assets/css/navbar.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css'>

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://emoji-css.afeld.me/emoji.css" rel="stylesheet">

    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <title>CrismaWork | Dashboard | Freelancer | Chat</title>

</head>

<body>


    <!-- Navbar -->
    <?php include("navbar.php"); ?>
    <div class="banner">
        <h3>Disscutez avec de potentiels employeurs</h3>
    </div>

    <!-- main -->
    <div class="main_content">
        <div class="veil"></div>


        <!-- Le chat est fait du point de vu de l'utilisateur connecté
        dùou ses messqges sont des outgoing et ceux de celui aui lui ecrit, des incoming -->
        <div class="chat_bloc">
            <div class="left">
                <!-- choisir entre les discussions et le journal d'appel -->
                <div class="chat_side">

                    <!-- discusission -->
                    <div class="side active">
                        <i class='bx bxs-message-dots'></i>
                        <p class="translate">Discussions</p>
                    </div>
                    <!-- journal d'apel -->
                    <div class="side">
                        <i class='bx bxs-phone'></i>
                        <p class="translate">Journal d'appels</p>
                    </div>
                </div>

                <div class="users_list">
                    <!-- chercher un nom ou message en particulier -->
                    <div class="search_bar">
                        <input type="text" placeholder="Chercher">
                        <i class="ai-search"></i>
                    </div>

                    <!-- Liste des users -->
                    <ul>
                        <li>
                            <!-- profile pic -->
                            <img src="freelancer_dashboard_assets/images/Ely.jpg" alt="">
                            <div class="info">
                                <!-- name and last message hour -->
                                <div class="up">
                                    <p>Ehouman Ivan</p>
                                    <span class="translate">10:53 am</span>
                                </div>
                                <!-- last message and new messages number -->
                                <div class="bottom">
                                    <span>Wow that looks amazing</span>
                                    <span>2</span>
                                </div>
                            </div>
                        </li>

                        <li>
                            <!-- profile pic -->
                            <img src="freelancer_dashboard_assets/images/Ely.jpg" alt="">
                            <div class="info">
                                <!-- name and last message hour -->
                                <div class="up">
                                    <p>Ehouman Ivan</p>
                                    <span class="translate">10:53 am</span>
                                </div>
                                <!-- last message and new messages number -->
                                <div class="bottom">
                                    <span>Wow that looks amazing</span>
                                    <span>2</span>
                                </div>
                            </div>
                        </li>

                        <li>
                            <!-- profile pic -->
                            <img src="freelancer_dashboard_assets/images/Ely.jpg" alt="">
                            <div class="info">
                                <!-- name and last message hour -->
                                <div class="up">
                                    <p>Ehouman Ivan</p>
                                    <span class="translate">10:53 am</span>
                                </div>
                                <!-- last message and new messages number -->
                                <div class="bottom">
                                    <span>Wow that looks amazing</span>
                                    <span>2</span>
                                </div>
                            </div>
                        </li>



                    </ul>
                </div>
            </div>

            <div class="right">
                <!-- actual chat details -->
                <div class="up">
                    <!-- person profile -->
                    <div class="info">
                        <img src="freelancer_dashboard_assets/images/Ely.jpg" alt="">
                        <div class="name_status">
                            <p>Ehouman Koua Ely</p>
                            <div class="status">
                                <i class="ai-circle-fill"></i>
                                <span class="translate">en ligne</span>
                            </div>
                        </div>
                    </div>

                    <div class="action">
                        <!-- video call -->
                        <i class='bx bx-video'></i>

                        <!-- upload contrat  for comp-->
                        <!-- <i class='bx bx-upload'></i> -->


                        <!-- Chercher dans la conversion-->
                        <i class="ai-search"></i>
                    </div>

                </div>

                <div class="down">
                    <div class="message_box">
                        <!-- serch message -->
                        <div class="search_message_popup">
                            <div class="input_container">
                                <div class="input_field">
                                    <input type="text" name="search_text" placeholder="chercher">
                                    <div class="found">
                                        <span>3</span>
                                        <span>sur</span>
                                        <span>3</span>
                                    </div>
                                </div>
                            </div>

                            <div class="options">
                                <i class="ai-chevron-up"></i>
                                <i class="ai-chevron-down"></i>
                                <i class="ai-cross"></i>
                            </div>


                        </div>




                        <!-- day divider -->
                        <div class="divider">
                            <div class="line"></div>
                            <p>May 3 , 2024</p>
                            <div class="line"></div>
                        </div>

                        <div class="msg_text incoming">
                            <p>Message entrant </p>
                            <div class="details">
                                <span>15:53 am</span>
                                <i class="ai-double-check"></i>
                            </div>
                        </div>
                        <div class="msg_text outgoing">
                            <p>Message entrant</p>
                            <div class="details">
                                <span>15:53 am</span>
                                <i class="ai-double-check"></i>
                            </div>
                        </div>



                        <div class="msg_file incoming">
                            <div class="double_layer">
                                <div class="up">
                                    <img src="freelancer_dashboard_assets/images/other/rar.png" alt="">
                                    <div class="file_info">
                                        <p>prototype de methodes</p>
                                        <span>51 ko, Document PDF</span>
                                    </div>
                                </div>
                                <div class="action">
                                    <button class="translate">Ouvrir</button>
                                    <button class="translate">Enregistrer sous</button>
                                </div>
                            </div>
                            <div class="down">
                                <p>Message entrant</p>
                                <div class="details">
                                    <span>15:53 am</span>
                                    <i class="ai-double-check"></i>
                                </div>
                            </div>

                        </div>

                        <div class="msg_file outgoing">
                            <div class="double_layer">
                                <div class="up">
                                    <img src="freelancer_dashboard_assets/images/other/rar.png" alt="">
                                    <div class="file_info">
                                        <p>prototype de methodes</p>
                                        <span>51 ko, Document PDF</span>
                                    </div>
                                </div>
                                <div class="action">
                                    <button class="translate">Ouvrir</button>
                                    <button class="translate">Enregistrer sous</button>
                                </div>
                            </div>
                            <div class="down">
                                <p>Message entrant</p>
                                <div class="details">
                                    <span>15:53 am</span>
                                    <i class="ai-double-check"></i>
                                </div>
                            </div>

                        </div>


                        <div class="msg_contract incoming">
                            <div class="double_layer">
                                <div class="up">
                                    <img src="freelancer_dashboard_assets/images/other/briefcase.png" alt="">
                                    <div class="file_info">
                                        <p>Contract #CTC120624WD</p>
                                        <span class="translate">offre d'emploi</span>
                                    </div>
                                </div>
                                <div class="action">
                                    <button>Ouvrir</button>
                                    <button>Enregistrer sous</button>
                                </div>
                            </div>
                            <div class="details">
                                <span>15:53 am</span>
                                <i class="ai-double-check"></i>
                            </div>
                        </div>

                        <div class="msg_contract accepted incoming">
                            <div class="double_layer">

                                <img src="freelancer_dashboard_assets/images/other/briefcase.png" alt="">
                                <div class="file_info">
                                    <p>Contract #CTC120624WD</p>
                                    <span>Accepté le 4 Mai 2024</span>
                                </div>

                            </div>
                            <div class="details">
                                <span>15:53 am</span>
                                <i class="ai-double-check"></i>
                            </div>
                        </div>


                        <!-- goDown button -->
                        <button class="goDown"><i class="ai-arrow-down"></i></button>
                    </div>
                    <div class="send">
                        <!-- upload file -->
                        <i class="ai-attach"></i>
                        <input type="file" name="" id="" hidden>
                        <textarea name="" placeholder="Saisissez quelque chose"></textarea>
                        <i class='bx bx-send'></i>
                    </div>


                    <!-- file popup -->
                    <div class="file_popup">
                        <div class="preview">
                            <img src="freelancer_dashboard_assets/images/other/word.png" alt="">
                            <p>Document title</p>
                            <p class="weight"> 52ko, pdf</p>
                        </div>
                        <div class="options">
                            <textarea name="" placeholder="Légende (Facultatif)"></textarea>
                            <i class='bx bx-send'></i>
                        </div>
                    </div>


                    <!-- contract acceptance popup -->
                    <div class="contract_popup" style="display: none;">
                        <div class="preview">

                        </div>
                        <div class="options">
                            <button class="translate">Accepter l'offre</button>
                            <button class="translate">Decliner l'offre</button>
                        </div>
                    </div>



                </div>
            </div>
        </div>
        <!-- quitter le file_popup -->
        <div class="quit_file_popup">
            <div class="info">
                <h3>Abandonner le media</h3>
                <p>Si vous quittez cet écran , le média ne sera pas envoyé</p>
            </div>
            <div class="options">
                <button class="translate quit">Abandonner</button>
                <button class="translate back">Revenir au media</button>
            </div>
        </div>

    </div>



    <!-- Custom js -->
    <script src="https://unpkg.com/akar-icons-fonts"></script>
    <script src="freelancer_dashboard_assets/js/full_chat.js"></script>
    <script src="freelancer_dashboard_assets/js/translate.js"></script>

</body>

</html>