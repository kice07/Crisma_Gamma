<?php
include("../config.php");
session_start();

$jobs_query = mysqli_query($conn, "SELECT * FROM jobs");
$cat_query = mysqli_query($conn, "SELECT * FROM job_category");

$total_row = mysqli_num_rows($jobs_query);
$page_number = ceil($total_row / 9);
$starter = 1;

function parseDate($dateString)
{
    $dateParts = explode('/', $dateString);
    $day = $dateParts[0];
    $month = $dateParts[1];
    $year = $dateParts[2];
    return DateTime::createFromFormat('d/m/Y', "$day/$month/$year");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="freelancer_dashboard_assets/css/Job.css">
    <link rel="stylesheet" href="freelancer_dashboard_assets/css/navbar.css">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css'>

    <link rel="icon" href="freelancer_dashboard_assets/images/crislogo.png" type="image/png">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <title>CrismaWork | Dashboard | Freelancer | job list</title>

</head>

<body>


    <!-- Navbar -->
    <?php include('navbar.php') ?>

    <div class="big_container">

        <!-- banner -->
        <div class="banner">

            <h3 class="translate">Trouvez l'offre de vos rêves</h3>
            <div class="search_bar">

                <i class="ai-search"></i>
                <input type="text" name="job-title" placeholder="Titre de l'offre" onkeyup="searchName(this)">
                <!-- <span class="translate"></span> -->


            </div>


            <!-- <img src="freelancer_dashboard_assets/images/other/sparkle.png" alt=""> -->
        </div>


        <!-- Categories -->
        <ul class="categories">
            <?php
            while ($row = mysqli_fetch_assoc($cat_query)) {
            ?>
                <li class="translate" id="<?php echo $row['id'] ?>" onclick="getSubCat(this)"><?php echo $row['label'] ?></li>
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
                    <p class="translate">Salaire</p>
                    <div class="box">
                        <div class="check" onclick="toggleCheckbox(this)"><i class='bx bx-check'></i></div>
                        <span class="translate"> temps plein</span>
                    </div>

                    <div class="box">
                        <div class="check" onclick="toggleCheckbox(this)"><i class='bx bx-check'></i></div>
                        <span class="translate">temps partiel</span>
                    </div>

                    <div class="box">
                        <div class="check" onclick="toggleCheckbox(this)"><i class='bx bx-check'></i></div>
                        <span class="translate">contrat</span>
                    </div>

                </div>

                <div class="feature">
                    <p class="translate">Experience</p>
                    <div class="box">
                        <div class="check" onclick="toggleCheckbox(this)"><i class='bx bx-check'></i></div>
                        <span class="translate"> moins 1ans </label><br>
                    </div>

                    <div class="box">
                        <div class="check" onclick="toggleCheckbox(this)"><i class='bx bx-check'></i></div>
                        <span class="translate">entre 1 et 5ans</span>
                    </div>

                    <div class="box">
                        <div class="check" onclick="toggleCheckbox(this)"><i class='bx bx-check'></i></div>
                        <span class="translate">Plus de 5ans</span>
                    </div>
                </div>

                <div class="feature">
                    <p class="translate">Salaire</p>
                    <div class="box">
                        <div class="check" onclick="toggleCheckbox(this)"><i class='bx bx-check'></i></div>
                        <span class="translate"> moins de 1700 $</span>
                    </div>

                    <div class="box">
                        <div class="check" onclick="toggleCheckbox(this)"><i class='bx bx-check'></i></div>
                        <span class="translate">entre 1700 et 5000$</span>
                    </div>

                    <div class="box">
                        <div class="check" onclick="toggleCheckbox(this)"><i class='bx bx-check'></i></div>
                        <span class="translate">entre 5000 et 10000$</span>
                    </div>

                    <div class="box">
                        <div class="check" onclick="toggleCheckbox(this)"><i class='bx bx-check'></i></div>
                        <span class="translate">Plus de 10000$</span>
                    </div>
                </div>



                <button class="translate apply" onclick="ApplyFilter(this)">Appliquer</button>
                <div class="call_to_action">
                    <img src="freelancer_dashboard_assets/images/other/logo_strokes.png" alt="">
                    <p>Mutipliez vos opportunités en créeant plus de cv</p>
                    <a href="#">
                        <span>Vos cv</span>
                        <i class="ai-arrow-right"></i>
                    </a>
                </div>

            </div>



            <!-- ====== RIGHT====== -->
            <div class="right">
                <div class="head">
                    <p> <strong class="translate">Résultats trouvés</strong> (<?php echo mysqli_num_rows($jobs_query) ?>)</p>
                    <div class="sort">
                        <p class="translate">rangée par</p>
                        <span class="translate">date de publication</span>
                        <i class="ai-settings-horizontal"></i>
                    </div>

                </div>
                <p class="none">Aucun resultat trouvé</p>
                <div class="job_bloc">

                    <!-- job bloc -->
                    <?php
                    while ($row = mysqli_fetch_assoc($jobs_query)) {
                        $id = $row['id'];
                        $idFree = $_SESSION['unique_freelancer_id'];
                    ?>
                        <div class="job" $id="<?php echo $id ?>" cat="<?php echo $row['job_category'] ?>" sub="<?php echo $row['job_sub_category'] ?>">
                            <!-- up job -->
                            <div class="top">
                                <div class="row first">
                                    <h3 class="name"><?php echo $row['title'] ?></h3>
                                    <?php
                                    $select_query = mysqli_query($conn, "SELECT * FROM whishlist WHERE job_id='$id' AND free_id='$idFree'");
                                    if (mysqli_num_rows($select_query) > 0) {
                                    ?>
                                        <i class="bx bxs-bookmark" onclick="addWhishlist(this)"></i>
                                    <?php
                                    } else {
                                    ?>
                                        <i class="ai-ribbon" onclick="addWhishlist(this)"></i>
                                    <?php
                                    }

                                    ?>


                                </div>
                                <div class="row second">
                                    <span class="translate match">
                                        <?php
                                        $dateToCheck = $row['expire_date'];
                                        $parsedDate = parseDate($dateToCheck);
                                        $currentDate = new DateTime();

                                        if ($parsedDate > $currentDate) {
                                            echo " Disponible jusqu'au" . " " . $row['expire_date'];
                                        } else {
                                            echo "offre indisponible ";
                                        }

                                        ?></span>
                                    <div class="job_detail">
                                        <span class="translate"><?php echo $row['job_type'] ?></span>
                                        <span class="translate"><?php echo $row['experience'] ?></span>
                                        <span class="translate">Un details</span>
                                    </div>
                                    <span class="translate delay">
                                        <?php
                                        $dateToCheck = $row['post_date'];
                                        $parsedDate = parseDate($dateToCheck);
                                        $currentDate = new DateTime();
                                        $interval = $currentDate->diff($parsedDate);

                                        $daysDifference = (int)$interval->format('%a'); // %r est pour le signe (positif ou négatif), %a est pour les jours absolus
                                        $newdate =  $daysDifference - 1;
                                        if ($daysDifference === 0) {
                                            echo "Aujourd'hui";
                                        } else {
                                            echo "Il y a $daysDifference jour(s)";
                                        }

                                        ?>
                                    </span>
                                    <span class="applier translate"><i class='bx bxs-circle'></i> <?php echo $row['applicants'] ?> postulants</span>
                                </div>
                            </div>

                            <!-- bottom job -->
                            <div class="bottom">
                                <div class="salary">
                                    <span><?php echo $row['salary'] . " " . $row['currency'] ?></span>
                                    <!-- <span>/mois</span> -->
                                </div>
                                <a href="job_details.php?jobId=<?php echo $row['id'] ?>" class="translate"> plus de details</a>
                            </div>
                        </div>


                    <?php
                    }

                    ?>

                </div>

                <div class="more">
                    <i class="ai-arrow-left"></i>

                    <div class="numbers">
                        <span>1</span>
                        <span>...</span>
                        <span class="mid">2</span>
                        <span class="mid">...</span>
                        <span><?php echo $page_number ?></span>
                    </div>

                    <a href="#">
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
        function searchName(element) {
            var match = false;
            var searchText = element.value;
            const regex = new RegExp(searchText);

            var free = document.querySelector(".job_bloc");
            var freebloc = document.querySelectorAll(".job_bloc .job");
            var freeNames = free.querySelectorAll(".job .name");

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
            for (var i = counter * 9; i < (counter + 1) * 9; i++) {
                if (i == <?php echo $total_row ?>)
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



        var starter = "<?php $starter ?>";
        displayRow(starter, document.querySelector(".job_bloc"));
    </script>
    <script src="freelancer_dashboard_assets/js/Job_browsing.js"></script>
    <!-- <script src="freelancer_dashboard_assets/js/translate.js"></script> -->

</body>


</html>