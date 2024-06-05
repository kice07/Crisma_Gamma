<?php
include("../config.php");
session_start();
if (isset($_GET['job_id'])) {
    $job_id = $_GET['job_id'];
    $freelancer_id_query = mysqli_query($conn, "SELECT freelancer_id, date, freelancer_cv_id, state  FROM application WHERE job_id='$job_id'");

    $total_row = mysqli_num_rows($freelancer_id_query);
    $page_number = ceil($total_row / 5);
    $starter = 1;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin_dashboard_assets/css/Applicants.css">
    <link rel="stylesheet" href="admin_dashboard_assets/css/navbar.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css'>

    <link rel="icon" href="admin_dashboard_assets/images/crislogo.png" type="image/png">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <title>CrismaWork | Dashboard | Admin | Applicants</title>


</head>

<body>


    <!-- Navbar -->
    <?php include("navbar.php") ?>




    <!-- main -->
    <div class="main_content">
        <div class="banner">
            <h3>Retrouvez candidatures</h3>
        </div>


        <div class="container">
            <div class="tab_box">
                <button class="tab_btn translate active">En attente</button>
                <button class="tab_btn translate">Candidatures acceptée</button>
                <button class="tab_btn translate">Refusées</button>

                <div class="line"></div>
            </div>
        </div>
        <div class="blured"></div>

        <div class="content_box">

            <!-- candidature en attente -->
            <div class="content active">

                <div class="filter">
                    <div class="label"><span class="translate">Flitre</span></div>
                    <div class="input_field">
                        <i class="ai-search"></i>
                        <input type="text" placeholder="Nom du freelancer..." onkeyup="lookFor(this)">
                    </div>
                </div>


                <p class="none">Auncun freelancer trouvé</p>

                <table>
                    <tr>
                        <th class="translate">Freelancer</th>
                        <th class="translate">Note</th>
                        <th class="translate">Niveau</th>
                        <th class="translate">Date</th>
                        <th class="translate">Action</th>

                    </tr>
                    <?php


                    while ($row = mysqli_fetch_assoc($freelancer_id_query)) {
                        $application_id = $row['freelancer_id'];
                        $application_date = $row['date'];
                        $application_state = $row['state'];
                        $application_cv = $row['freelancer_cv_id'];
                        $freelancer_q = mysqli_query($conn, "SELECT * FROM freelancer WHERE id=$application_id");
                        $freelancer = mysqli_fetch_assoc($freelancer_q);
                        if ($application_state == "ongoing") {



                    ?>
                            <tr>
                                <td>
                                    <img src="../Freelancer_Dashboard/freelancer_dashboard_assets/images/freelancer/<?php echo (!isset($freelancer['image'])) ? "no_user.png" : $freelancer['image'] ?>" alt="">
                                    <div class="about">
                                        <p class="freelancer"><?php echo $freelancer['nom'] . " " . $freelancer['prenom'] ?></p>
                                        <p class="translate"><?php echo $freelancer['pays'] ?></p>
                                    </div>
                                </td>
                                <td class="ongoing">
                                    <p class="translate"><?php echo (!isset($freelancer['rate'])) ? "aucun commentaire" : $freelancer['rate'] . "/5" ?></p>
                                </td>
                                <td class="translate"><?php echo $freelancer['nom'] . " " . $freelancer['prenom'] ?></td>
                                <td class="translate"><?php echo $application_date ?></td>
                                <td class="translate">
                                    <div free_id="<?php echo $application_id ?>" id="<?php echo $application_cv ?>" onclick="displayCv(this)">
                                        <span>Revoir le cv</span>
                                        <i class="ai-arrow-up-right"></i>
                                    </div>

                                </td>


                            </tr>
                    <?php
                        }
                    }

                    ?>

                </table>




                <div class="counter">
                    <i class="ai-arrow-left" onclick="counter(this,'back')"></i>

                    <div class="numbers">
                        <span>1</span>
                        <span>...</span>
                        <span class="mid number hide">2</span>
                        <span class="mid hide">...</span>
                        <span><?php echo $page_number ?></span>
                    </div>

                    <a href="#" onclick="counter(this,'forth')">
                        <span class="translate">suivant</span>
                        <i class="ai-arrow-right"></i>
                    </a>
                </div>

            </div>

            <!-- candidature acceptée -->
            <div class="content">
                <div class="filter">
                    <div class="label"><span class="translate">Flitre</span></div>
                    <div class="input_field">
                        <i class="ai-search"></i>
                        <input type="text" placeholder="Nom de l'offre...">
                    </div>
                </div>


                <p class="none">Auncun freelancer trouvé</p>
                <table>
                    <tr>
                        <th class="translate">Freelancer</th>
                        <th class="translate">Note</th>
                        <th class="translate">Niveau</th>
                        <th class="translate">Date</th>
                        <th class="translate">Action</th>

                    </tr>
                    <?php


                    while ($row = mysqli_fetch_assoc($freelancer_id_query)) {
                        $application_id = $row['freelancer_id'];
                        $application_date = $row['date'];
                        $application_state = $row['state'];
                        $application_cv = $row['freelancer_cv_id'];
                        $freelancer_q = mysqli_query($conn, "SELECT * FROM freelancer WHERE id=$application_id");
                        $freelancer = mysqli_fetch_assoc($freelancer_q);
                        if ($application_state == "accepted") {



                    ?>
                            <tr>
                                <td>
                                    <img src="../Freelancer_Dashboard/freelancer_dashboard_assets/images/freelancer/<?php echo (!isset($freelancer['image'])) ? "no_user.png" : $freelancer['image'] ?>" alt="">
                                    <div class="about">
                                        <p class="freelancer"><?php echo $freelancer['nom'] . " " . $freelancer['prenom'] ?></p>
                                        <p class="translate"><?php echo $freelancer['pays'] ?></p>
                                    </div>
                                </td>
                                <td class="ongoing">
                                    <p class="translate"><?php echo (!isset($freelancer['rate'])) ? "aucun commentaire" : $freelancer['rate'] . "/5" ?></p>
                                </td>
                                <td class="translate"><?php echo $freelancer['nom'] . " " . $freelancer['prenom'] ?></td>
                                <td class="translate"><?php echo $application_date ?></td>
                                <td class="translate">
                                    <div free_id="<?php echo $application_id ?>" id="<?php echo $application_cv ?>" onclick="displayCv(this)">
                                        <span>Revoir le cv</span>
                                        <i class="ai-arrow-up-right"></i>
                                    </div>

                                </td>


                            </tr>
                    <?php
                        }
                    }

                    ?>

                </table>


                <div class="counter">
                    <i class="ai-arrow-left" onclick="counter(this,'back')"></i>

                    <div class="numbers">
                        <span>1</span>
                        <span>...</span>
                        <span class="mid number hide">2</span>
                        <span class="mid hide">...</span>
                        <span><?php echo $page_number ?></span>
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

                <p class="none">Auncun freelancer trouvé</p>
                <table>
                    <tr>
                        <th class="translate">Freelancer</th>
                        <th class="translate">Note</th>
                        <th class="translate">Niveau</th>
                        <th class="translate">Date</th>
                        <th class="translate">Action</th>

                    </tr>
                    <?php


                    while ($row = mysqli_fetch_assoc($freelancer_id_query)) {
                        $application_id = $row['freelancer_id'];
                        $application_date = $row['date'];
                        $application_state = $row['state'];
                        $application_cv = $row['freelancer_cv_id'];
                        $freelancer_q = mysqli_query($conn, "SELECT * FROM freelancer WHERE id=$application_id");
                        $freelancer = mysqli_fetch_assoc($freelancer_q);
                        if ($application_state == "declined") {



                    ?>
                            <tr>
                                <td>
                                    <img src="../Freelancer_Dashboard/freelancer_dashboard_assets/images/freelancer/<?php echo (!isset($freelancer['image'])) ? "no_user.png" : $freelancer['image'] ?>" alt="">
                                    <div class="about">
                                        <p class="freelancer"><?php echo $freelancer['nom'] . " " . $freelancer['prenom'] ?></p>
                                        <p class="translate"><?php echo $freelancer['pays'] ?></p>
                                    </div>
                                </td>
                                <td class="ongoing">
                                    <p class="translate"><?php echo (!isset($freelancer['rate'])) ? "aucun commentaire" : $freelancer['rate'] . "/5" ?></p>
                                </td>
                                <td class="translate"><?php echo $freelancer['nom'] . " " . $freelancer['prenom'] ?></td>
                                <td class="translate"><?php echo $application_date ?></td>
                                <td class="translate">
                                    <div free_id="<?php echo $application_id ?>" id="<?php echo $application_cv ?>" onclick="displayCv(this)">
                                        <span>Revoir le cv</span>
                                        <i class="ai-arrow-up-right"></i>
                                    </div>

                                </td>


                            </tr>
                    <?php
                        }
                    }

                    ?>

                </table>




                <div class="counter">
                    <i class="ai-arrow-left" onclick="counter(this,'back')"></i>

                    <div class="numbers">
                        <span>1</span>
                        <span>...</span>
                        <span class="mid number hide">2</span>
                        <span class="mid hide">...</span>
                        <span><?php echo $page_number ?></span>
                    </div>

                    <a href="#" onclick="counter(this,'forth')">
                        <span class="translate">suivant</span>
                        <i class="ai-arrow-right"></i>
                    </a>
                </div>

            </div>

            <!-- display_cv -->

        </div>
        <div class="cv_file">

        </div>
    </div>



    <!-- Custom js -->
    <script src="https://unpkg.com/akar-icons-fonts"></script>
    <script>
        var counter = 0;

        function displayRow(counter, table) {
            var allRows = table.querySelectorAll("tr:not(:first-of-type)");
            allRows.forEach(row => {
                row.style.display = "none";
            })
            for (var i = counter * 5; i < (counter + 1) * 5; i++) {
                allRows[i].style.display = "block";
            }
        }
        //==================== counter
        function counter(element, side) {
            var pageNumber = "<?php echo $page_number ?>";
            table = element.parentElement.previousElementSiblings;
            var mids = element.parentElement.querySelectorAll(" .numbers .mid");
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

        //searchBox
        function lookFor(element) {

            var match = false;
            var searchText = element.value;
            const regex = new RegExp(searchText)
            var table = element.parentElement.parentElement.nextElementSibling.nextElementSibling;
            if (searchText == "") {
                table.style.opacity = "1";

                document.querySelector(".none").style.display = "none";
            } else {
                var allFirstRows = table.querySelectorAll("tr:not(:first-of-type) td:first-child .about .freelancer");
                // allFirstRows.forEach(row => {row.parentElement.parentElement.parentElement.style.opacity = "0"})
                allFirstRows.forEach(row => {
                    if (regex.test(row.textContent)) {
                        document.querySelector(".none").style.display = "none";
                        row.parentElement.parentElement.parentElement.style.opacity = "1"
                        match = true;
                    }
                })

                if (!match) {
                    table.style.opacity = "0";
                    document.querySelector(".none").style.display = "block";
                }
            }



        }

        function displayCv(element) {
            var cv = document.querySelector(".cv_file");
            var resumeId = element.getAttribute("id");
            var freeId = element.getAttribute("free_id");
            let xhr = new XMLHttpRequest();
            let getResume = new FormData();
            getResume.append('resumeid', resumeId);
            getResume.append('freeid', freeId);
            xhr.open("POST", "admin_dashboard_assets/php_checking/get_applicant_resume.php", true);
            xhr.onload = () => {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {

                        let data = xhr.response;

                        document.querySelector(".blured").style.display = "block";
                        setTimeout(function() {
                            cv.style.display = 'block';
                            cv.innerHTML = data;

                        }, 100);

                        document.addEventListener("click", (e) => {
                            if (!cv.contains(e.target)) {
                                cv.style.display = 'none';
                                document.querySelector(".blured").style.display = "none";

                            }
                        })

                    }
                }
            }
            xhr.send(getResume);

        }
    </script>
    <script src="admin_dashboard_assets/js/applicant.js"></script>
    <!-- <script src="admin_dashboard_assets/js/translate.js"></script> -->

</body>

</html>