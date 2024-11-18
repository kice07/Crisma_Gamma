<?php

include("../config.php");
session_start();
$id = $_SESSION['unique_freelancer_id'];
$thumbnail_query = mysqli_query($conn, "SELECT image FROM freelancer WHERE id=$id");
$thumbnail = mysqli_fetch_assoc($thumbnail_query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="freelancer_dashboard_assets/css/final_vers_chat_free.css">
    <link rel="stylesheet" href="freelancer_dashboard_assets/css/navbar.css">
    <link rel="stylesheet" href="../main_assets/css/video_call_both_UI.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.6.0/uicons-thin-rounded/css/uicons-thin-rounded.css'>
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
        <div class="chat_bloc"
            myId="<?php echo $id ?>"
            myPic="<?php echo $thumbnail['image'] ?>">
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

                    </ul>
                </div>

                 <!-- call logs preview -->
                <div class="calls_logs_preview">
                    <div class="search_bar">
                        <input type="text" placeholder="Chercher">
                        <i class="ai-search"></i>
                    </div>
                    <ul>

                    </ul>
                </div>
            </div>

            <div class="right">
                <div class="no_content">
                    <p>Choisissez une conversation</p>
                </div>

                <div class="call_log_detail">
                </div>
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

         <!-- video_call_interface -->
      
    </div>





    <!-- Custom js -->
    <script src="https://unpkg.com/akar-icons-fonts"></script>
    <script src="freelancer_dashboard_assets/js/full_chat.js"></script>
    <script src="freelancer_dashboard_assets/js/translate.js"></script>
    <script src="https://cdn.socket.io/4.7.5/socket.io.min.js"
        integrity="sha384-2huaZvOR9iDzHqslqwpR87isEmrfxqyWOF7hr7BY6KG0+hVKLoEXMPUJw3ynWuhO"
        crossorigin="anonymous"></script>
    <script src='../main_assets/js/agora-rtm-sdk-1.4.4.js'></script>
    <script src="freelancer_dashboard_assets/js/chat_video_manage_freelancer.js"></script>

</body>

</html>