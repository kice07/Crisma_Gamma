<?php
include("../config.php");
session_start();

$cat_query = mysqli_query($conn, 'SELECT * FROM job_category');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin_dashboard_assets/css/create_jobs.css">
    <link rel="stylesheet" href="admin_dashboard_assets/css/navbar.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css'>

    <link rel="icon" href="admin_dashboard_assets/images/crislogo.png" type="image/png">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <title>CrismaWork | Dashboard | Admin | job_creation</title>

</head>

<body>


    <!-- Navbar -->
    <?php include("navbar.php") ?>
    <div class="banner">
        <h3>Créez une nouvelle offre</h3>
    </div>

    <div class="blured"></div>
    <!-- main -->
    <div class="main_content">
        <p class="error"></p>
        <p class="success"></p>
        <div class="job">
            <div class="left_details">

                <!-- cats-->
                <div class="section">
                    <div class="title_part">
                        <h3 class="translate">Categorie de l'offre</h3>
                        <span class="translate">Definissez la categorie d'offre proposé</span>
                    </div>
                    <div class="job_cat_input">
                        <input type="text" class="job_cat changingValue" placeholder="developement" readonly>
                        <i class="ai-chevron-down" onclick="showPopup(this)"></i>
                    </div>

                    <ul class="job_cat_options">
                        <?php
                        while ($row = mysqli_fetch_assoc($cat_query)) {
                        ?>
                            <li onclick="popupTakenChoice(this)" id="<?php echo $row['id'] ?>"><?php echo $row['label'] ?></li>
                        <?php
                        }

                        ?>
                    </ul>
                </div>

                <!-- sub_cats-->
                <div class="section subs">
                    <div class="title_part">
                        <h3 class="translate">Sous categorie</h3>
                        <span class="translate">Definissez la sous categorie de l'offre</span>
                    </div>
                    <div class="job_sub_cat_input">
                        <input type="text" class="job_sub_cat changingValue" placeholder="..." readonly>
                        <i class="ai-chevron-down" onclick="showPopup(this)"></i>
                    </div>

                    <ul class="job_sub_cat_options">

                    </ul>
                </div>

                <!-- job title-->
                <div class="section">
                    <div class="title_part">
                        <h3 class="translate">Libélé</h3>
                        <span class="translate">Le Libélé doit definir précisement la position à occuper</span>
                    </div>
                    <input type="text" class="job_title" placeholder="ex : software developer">
                </div>

                <!-- job_description-->
                <div class="section">
                    <div class="title_part">
                        <h3 class="translate">Description</h3>
                        <span class="translate">Decrivez avec précison votre offre</span>
                    </div>

                    <div class="job_description_container">
                        <div class="toolbar">
                            <div class="head">

                                <select onchange="formatDoc('formatBlock', this.value); this.selectedIndex=0;">
                                    <option value="" selected="" hidden="" disabled="">Format</option>
                                    <option value="h1">Heading 1</option>
                                    <option value="h2">Heading 2</option>
                                    <option value="h3">Heading 3</option>
                                    <option value="h4">Heading 4</option>
                                    <option value="h5">Heading 5</option>
                                    <option value="h6">Heading 6</option>
                                    <option value="p">Paragraph</option>
                                </select>
                                <select onchange="formatDoc('fontSize', this.value); this.selectedIndex=0;">
                                    <option value="" selected="" hidden="" disabled="">Font size</option>
                                    <option value="1">Extra small</option>
                                    <option value="2">Small</option>
                                    <option value="3">Regular</option>
                                    <option value="4">Medium</option>
                                    <option value="5">Large</option>
                                    <option value="6">Extra Large</option>
                                    <option value="7">Big</option>
                                </select>
                                <div class="color">
                                    <span>Color</span>
                                    <input type="color" oninput="formatDoc('foreColor', this.value); this.value='#000000';">
                                </div>
                                <div class="color">
                                    <span>Background</span>
                                    <input type="color" oninput="formatDoc('hiliteColor', this.value); this.value='#000000';">
                                </div>
                            </div>
                            <div class="btn-toolbar">
                                <button onclick="formatDoc('undo')"><i class='bx bx-undo'></i></button>
                                <button onclick="formatDoc('redo')"><i class='bx bx-redo'></i></button>
                                <button onclick="formatDoc('bold')"><i class='bx bx-bold'></i></button>
                                <button onclick="formatDoc('underline')"><i class='bx bx-underline'></i></button>
                                <button onclick="formatDoc('italic')"><i class='bx bx-italic'></i></button>
                                <button onclick="formatDoc('justifyLeft')"><i class='bx bx-align-left'></i></button>
                                <button onclick="formatDoc('justifyCenter')"><i class='bx bx-align-middle'></i></button>
                                <button onclick="formatDoc('justifyRight')"><i class='bx bx-align-right'></i></button>
                                <button onclick="formatDoc('justifyFull')"><i class='bx bx-align-justify'></i></button>
                                <button onclick="formatDoc('insertOrderedList')"><i class='bx bx-list-ol'></i></button>
                                <button onclick="formatDoc('insertUnorderedList')"><i class='bx bx-list-ul'></i></button>
                            </div>
                        </div>
                        <div id="content" contenteditable="true" spellcheck="false">
                            <?php if (isset($_GET['job_id'])) echo $job_row['content']; ?>
                        </div>
                    </div>
                </div>

                <!-- skills -->
                <div class="section">
                    <div class="title_part">
                        <h3 class="translate">Compétences</h3>
                        <span class="translate">Donnez les compétences requises pour votre offre</span>
                    </div>
                    <input type="text" class="skills" placeholder="'ex : HTML'  puis appuyer sur la touche entrée" onkeydown="addSkills(this)">

                    <div class="skills_bloc"></div>
                </div>


            </div>

            <div class="right_details">

                <!-- ending_date-->
                <div class="section">

                    <div class="title_part">
                        <h3 class="translate">Fin de l'offre</h3>
                        <span class="translate">Date d'expiration de votre offre</span>
                    </div>
                    <div class="datepicker">
                        <input type="text" class="ending_date" placeholder="dd/mm/yyyy"  readonly>
                        <i class="ai-calendar" onclick="showPopup(this)"></i>
                    </div>

                    <div class="calendar-container">
                        <header class="calendar-header">
                            <p class="calendar-current-date"></p>
                            <div class="calendar-navigation">
                                <span id="calendar-prev" class="material-symbols-rounded">
                                    <i class='bx bx-left-arrow-alt'></i>
                                </span>
                                <span id="calendar-next" class="material-symbols-rounded">
                                    <i class='bx bx-right-arrow-alt'></i>
                                </span>
                            </div>
                        </header>

                        <div class="calendar-body">
                            <ul class="calendar-weekdays">
                                <li>Sun</li>
                                <li>Mon</li>
                                <li>Tue</li>
                                <li>Wed</li>
                                <li>Thu</li>
                                <li>Fri</li>
                                <li>Sat</li>
                            </ul>
                            <ul class="calendar-dates"></ul>
                        </div>
                    </div>
                </div>


                <!-- applicants -->
                <div class="section">
                    <div class="title_part">
                        <h3 class="translate">Nombre de potulant</h3>
                        <span class="translate">Definissez le nombre de personnes
                            dont vous avez besoin</span>
                    </div>
                    <input type="text" class="job_applicants" placeholder="ex : 15" >
                </div>

                <!-- job_type -->
                <div class="section">
                    <div class="title_part">
                        <h3 class="translate">Type</h3>
                        <span class="translate">Definissez le type d'offre proposé</span>
                    </div>
                    <div class="job_type_input">
                        <input type="text" class="job_type changingValue" placeholder="temps partiel"readonly>
                        <i class="ai-chevron-down" onclick="showPopup(this)"></i>
                    </div>

                    <ul class="job_type_options">
                        <li onclick="popupTakenChoice(this)">temps partiel</li>
                        <li onclick="popupTakenChoice(this)">temps plein</li>
                        <li onclick="popupTakenChoice(this)">contract</li>
                    </ul>
                </div>


                <!-- Experience -->
                <div class="section">
                    <div class="title_part">
                        <h3 class="translate">Année d'experience</h3>
                        <span class="translate">Le Libélé doit definir précisement la position à occuper</span>
                    </div>
                    <input type="text" class="experience_years" placeholder="ex : 5 ans" >
                </div>


                <!-- salary -->
                <div class="section">
                    <div class="title_part">
                        <h3 class="translate">Salaire</h3>
                        <span class="translate">La frequence et le montant de rémunération</span>
                    </div>

                    <div class="inputs_part">
                        <div class="frequency">
                            <div class="bloc" onclick="selectBloc(this)">
                                <div class="circle"></div>
                                <i class="ai-clock"></i>
                                <p>Par mois</p>
                            </div>
                            <div class="bloc" onclick="selectBloc(this)">
                                <div class="circle"></div>
                                <i class="ai-money"></i>
                                <p>Autre</p>
                            </div>
                        </div>
                        <div class="AmoutnFrequency">
                            <div class="amount">
                                <div class="currency">
                                    <span class="changingValue">Euro</span>
                                    <i class="ai-chevron-down" onclick="showPopup(this)"></i>
                                </div>
                                <input type="text" class="salary">

                                <ul class="currency_options">
                                    <li onclick="popupTakenChoice(this)">Euro</li>
                                    <li onclick="popupTakenChoice(this)">USD</li>
                                    <li onclick="popupTakenChoice(this)">CAD</li>
                                </ul>

                            </div>
                            <div class="rfrequency">
                                <div class="rcurrency">
                                    <input type="text" class="frequency_value changingValue" placeholder="heure">
                                    <i class="ai-chevron-down" onclick="showPopup(this)"></i>
                                </div>

                                <ul class="frequency_options">
                                    <li class="translate" onclick="popupTakenChoice(this)">heure</li>
                                    <li class="translate" onclick="popupTakenChoice(this)">jour</li>
                                    <li class="translate" onclick="popupTakenChoice(this)">semaine</li>
                                    <li class="translate" onclick="popupTakenChoice(this)">Contract</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>


        <button class="translate confirm" onclick="sendForm()">Poster</button>



    </div>



    <!-- Custom js -->
    <script src="https://unpkg.com/akar-icons-fonts"></script>

    <script src="admin_dashboard_assets/js/create_jobs.js"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- <script src="admin_dashboard_assets/js/translate.js"></script> -->

</body>

</html>