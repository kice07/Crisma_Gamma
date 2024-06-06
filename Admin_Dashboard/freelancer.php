<?php
include("../config.php");
session_start();
$freelancer_query = mysqli_query($conn, "SELECT * FROM freelancer");
$cat_query = mysqli_query($conn, "SELECT * FROM job_category");
$all_resume_skill = mysqli_query($conn, "SELECT DISTINCT label AS skLabel FROM resume_skill");

$total_row = mysqli_num_rows($freelancer_query);
$page_number = ceil($total_row / 5);
$starter = 1;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin_dashboard_assets/css/Freelancer.css">
    <link rel="stylesheet" href="admin_dashboard_assets/css/navbar.css">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css'>

    <link rel="icon" href="admin_dashboard_assets/images/crislogo.png" type="image/png">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <title>CrismaWork | Dashboard | Admin | freelancer_list</title>

</head>

<body>


    <!-- Navbar -->
    <?php include("navbar.php") ?>
    <div class="big_container">

        <!-- banner -->
        <div class="banner">

            <h3 class="translate">Trouvez le freelancer qu'il vous faut</h3>
            <div class="search_bar">

                <i class="ai-search"></i>
                <input type="text" name="job-title" class="job-title"
                placeholder="Nom du freelancer" onkeyup="searchName(this)"
                style="background-color: #29303b;">
                <!-- <span class="translate"></span> -->


            </div>


            <!-- <img src="freelancer_dashboard_assets/images/other/sparkle.png" alt=""> -->
        </div>




        <!-- Categories -->
        <ul class="categories">
            <?php
            while ($row = mysqli_fetch_assoc($cat_query)) {
            ?>
                <li class="translate" id="<?php echo $row['id'] ?>" onclick="getSubCat(this)" style="font-size: .9em;"><?php echo $row['label'] ?></li>
            <?php
            }
            ?>
        </ul>




        <!-- main -->
        <div class="main_content">

            <!-- ======LEFT======= -->
            <div class="left">
                <div class="head">
                    <h3 class="translate">Filtre</h3>
                    <span class="translate">Effacer</span>
                </div>

                <!-- features -->
                <div class="feature subcat">
                    <p>sous categorie</p>

                </div>

                <div class="feature">
                    <p class="translate">Type</p>
                    <div class="box">
                        <div class="check type" onclick="toggleCheckbox(this)"><i class='bx bx-check'></i></div>
                        <span class="translate"> Tepms plein </label><br>
                    </div>

                    <div class="box">
                        <div class="check type" onclick="toggleCheckbox(this)"><i class='bx bx-check'></i></div>
                        <span class="translate">Temps partiel</span>
                    </div>

                    <div class="box">
                        <div class="check type" onclick="toggleCheckbox(this)"><i class='bx bx-check'></i></div>
                        <span class="translate">Contrat</span>
                    </div>
                </div>

                <div class="feature">
                    <div class="skills">
                        <p class="title translate">Compétences</p>

                        <input type="text" name="skill" id="skills" placeholder="saisissez la compétence recherchée">
                        <div class="search_results">
                            <?php
                            while ($skill_list = mysqli_fetch_assoc($all_resume_skill)) {
                            ?>
                                <div class="item">
                                    <p><?php echo $skill_list['skLabel'] ?></p>
                                </div>
                            <?php
                            }

                            ?>


                        </div>

                        <div class="selected_skills">

                        </div>
                    </div>

                </div>


                <button class="translate apply" onclick="ApplyFilter(this)">Appliquer</button>

                <div class="call_to_action">
                    <img src="admin_dashboard_assets/images/other/logo_strokes.png" alt="">
                    <p>Trouvez des freelancers compétent en créant des offres</p>
                    <a href="#">
                        <span>vos offres</span>
                        <i class="ai-arrow-right"></i>
                    </a>
                </div>

            </div>



            <!-- ====== RIGHT====== -->
            <div class="right">
                <div class="head">
                    <p> <strong class="translate">Résultats trouvés</strong> (<?php echo mysqli_num_rows($freelancer_query) ?>)</p>
                    <div class="sort">
                        <p class="translate">rangée par</p>
                        <span class="translate">date de publication</span>
                        <i class="ai-settings-horizontal"></i>
                    </div>

                </div>

                <p class="none">Aucun resultat trouvé</p>
                <!-- freelancer bloc -->
                <div class="freelancer_bloc">
                    <?php
                    while ($freelancer = mysqli_fetch_assoc($freelancer_query)) {
                        $id = $freelancer['id'];
                        $last_cv_query = mysqli_query($conn, "SELECT id, position, sous_category FROM resume WHERE user_id='$id' ORDER BY STR_TO_DATE(date, '%d/%m/%Y') DESC
                        LIMIT 1 ");
                        $last_cv_data = mysqli_fetch_assoc($last_cv_query);
                        $last_cv_id = $last_cv_data['id'];
                        $last_cv_position = $last_cv_data['position'];
                        $last_cv_skills_query = mysqli_query($conn, "SELECT * FROM resume_skill WHERE resume_id='$last_cv_id'");


                    ?>
                        <div class="freelancer" type="<?php echo $freelancer['availability']; ?>" subCat="<?php echo $last_cv_data['sous_category']; ?>">
                            <div class="left">
                                <img src="../Freelancer_Dashboard/freelancer_dashboard_assets/images/freelancer/<?php echo (!isset($freelancer['image'])) ? "no_user.png" : $freelancer['image'] ?>" alt="">
                                <div class="freelancer_detail">
                                    <p class="name"><?php echo $freelancer['nom'] . " " . $freelancer['prenom'] ?></p>
                                    <span><?php echo $last_cv_position; ?></span>
                                    <p class="rate"><i class="fa-solid fa-star"></i> <?php echo (isset($freelancer['rate'])) ? (((float)$freelancer['rate']) * 100) / 5 . "%" : "aucun retour" ?></p>
                                    <div class="skills_row">
                                        <?php
                                        while ($last_cv_skills = mysqli_fetch_assoc($last_cv_skills_query)) {
                                        ?>
                                            <span><?php echo $last_cv_skills['label'] ?></span>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="right">
                                <div class="more_detail">
                                    <div class="bloc">
                                        <p>Pays</p>
                                        <p><?php echo $freelancer['pays'] ?></p>
                                    </div>
                                    <div class="bloc">
                                        <p>Langue</p>
                                        <p><?php echo ($freelancer['langage'] == "en") ? "anglais" : $freelancer['langage'] ?></p>
                                    </div>
                                    <div class="bloc">
                                        <p>Performance</p>
                                        <p><?php echo (isset($freelancer['rate'])) ? (((float)$freelancer['rate']) * 100) / 5 . "%" : "aucun contrat" ?></p>
                                    </div>
                                </div>
                                <a class="check_profile" href="freelancer_details.php?freeId=<?php echo $freelancer['id'] ?>&resumeId=<?php echo $last_cv_id ?>">
                                    <p>Voir le profil</p>
                                    <i class="fa-solid fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>

                    <?php
                    }
                    ?>

                </div>


                <div class="more">
                    <i class="ai-arrow-left" onclick="counter(this,'back')"></i>

                    <div class="numbers">
                        <span>1</span>
                        <span>...</span>
                        <span class="mid number hide">2</span>
                        <span class="mid hide">...</span>
                        <span><?php echo $page_number ?></span>
                    </div>

                    <button onclick="counter(this,'forth')">
                        <span class="translate">suivant</span>
                        <i class="ai-arrow-right"></i>
                        </a>
                </div>

            </div>


        </div>



    </div>



    <!-- Custom js -->
    <script src="https://unpkg.com/akar-icons-fonts"></script>
    <script>
        // =============== search bar
        function searchName(element) {
            var match = false;
            var searchText = element.value;
            const regex = new RegExp(searchText);

            var free = document.querySelector(".freelancer_bloc");
            var freebloc = document.querySelectorAll(".freelancer_bloc .freelancer");
            var freeNames = free.querySelectorAll(".freelancer .name");

            freebloc.forEach(free => {
                free.style.opacity = "0";
            })

            if (searchText == "") {
                free.style.opacity = "1";
                freebloc.forEach(free => {
                    free.style.opacity = "1";
                })

                document.querySelector(".none").style.display = "none";
            } else {
                // allFirstRows.forEach(row => {row.parentElement.parentElement.parentElement.style.opacity = "0"})
                freeNames.forEach((free, index) => {
                    if (regex.test(free.textContent)) {
                        document.querySelector(".none").style.display = "none";
                        freebloc[index].style.opacity = "1";
                        match = true;
                    }
                })

                if (!match) {
                    free.style.opacity = "0";
                    document.querySelector(".none").style.display = "block";
                }
            }


        }

        function displayRow(counter, table) {
            var allRows = table.querySelectorAll(".job_bloc .job");
            allRows.forEach(row => {
                row.style.display = "none";
            })
            for (var i = counter * 5; i < (counter + 1) * 5; i++) {
                if(i == <?php echo $total_row?>)
                    break;
                else    
                    allRows[i].style.display = "block";
            }
        }
        //==================== counter
        function counter(element, side) {
            var pageNumber = "<?php echo $page_number ?>";
            table = element.previousElementSiblings;
            var mids = element.parentElement.querySelectorAll(".numbers .mid");
            if (side == "back") {
                if (counter > 0) {
                    counter--;
                    if (mids[0].textContent == "2") {
                        mids.forEach(mid => {
                            mid.classList.add("hide");
                            displayRow(counter, table);
                        })
                    } else {
                        mids[0].textContent = parseInt(mids[0].textContent) - 1;
                        displayRow(counter, table);
                    }
                }

            } else {
                if (counter++ < pageNumber) {
                    counter++;
                    if (mids[0].classList.contains("hide")) {
                        mids.forEach(mid => {
                            mid.classList.remove("hide");
                            displayRow(counter, table);
                        })
                    } else {
                        displayRow(counter, table);
                        mids[0].textContent = parseInt(mids[0].textContent) + 1;
                    }
                }

            }
        }
        var starter= "<?php $starter?>";
        displayRow(starter,document.querySelector("frelancer_bloc"));

    </script>
    <script src="admin_dashboard_assets/js/Freelancer.js"></script>
    <!-- <script src="freelancer_dashboard_assets/js/translate.js"></script> -->

</body>


</html>