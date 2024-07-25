<?php
include("../config.php");
session_start();

if (isset($_GET['jobId'])) {
    $id = $_GET['jobId'];
    $jobs_query = mysqli_query($conn, "SELECT * FROM jobs WHERE id='$id'");
    $row = mysqli_fetch_assoc($jobs_query);
    $cat = $row['job_category'];
    $sub_cat = $row['job_sub_category'];
    $title = $row['title'];
}

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
    <link rel="stylesheet" href="freelancer_dashboard_assets/css/Job_details.css">
    <link rel="stylesheet" href="freelancer_dashboard_assets/css/navbar.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css'>

    <link rel="icon" href="freelancer_dashboard_assets/images/crislogo.png" type="image/png">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <title>CrismaWork | Dashboard | Freelancer | job-details</title>

</head>

<body>


    <!-- Navbar -->
    <?php include('navbar.php') ?>

    <div class="big_container">
        <div class="veil"></div>
        <div class="cv_popup">
            <div class="head">
                <p class="translate">Choisissez un cv</p>
                <i class="ai-cross" onclick="closePopup()"></i>
            </div>
            <div class="mid">
                <ul>
                    <li>Un cv</li>
                    <li>Un cv</li>
                    <li>Un cv</li>
                    <li>Un cv</li>
                    <li>Un cv</li>
                    <li>Un cv</li>
                    <li>Un cv</li>
                    <li>Un cv</li>
                    <li>Un cv</li>
                    <li>Un cv</li>
                    <li>Un cv</li>
                    <li>Un cv</li>
                    <li>Un cv</li>
                    <li>Un cv</li>
                    <li>Un cv</li>
                    <li>Un cv</li>
                    <li>Un cv</li>
                    <li>Un cv</li>
                    <li>Un cv</li>
                    <li>Un cv</li>
                    <li>Un cv</li>
                    <li>Un cv</li>
                    <li>Un cv</li>
                    <li>Un cv</li>
                    <li>Un cv</li>
                    <li>Un cv</li>
                    <li>Un cv</li>
                    <li>Un cv</li>
                    <li>Un cv</li>

                </ul>
            </div>
            <div class="bottom">
                <span class="translate">Choisir</span>
            </div>
        </div>
        <!-- banner -->
        <div class="banner">

            <h3 class="translate"><?php echo $row['title'] ?></h3>
            <div class="job_details">
                <div class="bloc">
                    <div class="part">
                        <i class="ai-briefcase"></i>
                        <span class="translate"><?php echo $row['job_type'] ?></span>
                    </div>
                    <div class="part">
                        <i class="ai-person"></i>
                        <span><?php echo $row['experience'] ?></span>
                    </div>
                    <div class="part">
                        <i class='bx bx-money'></i>
                        <div class="rate">
                            <span><?php echo $row['salary'] . " " . $row['currency'] ?></span>
                            <span>/</span>
                            <span class="translate">
                                <?php
                                $freq_tab = explode(" ", $row['frequence']);
                                echo $freq_tab[1];
                                ?>
                            </span>
                        </div>

                    </div>
                </div>
                <div class="bloc">
                    <p class="translate apply" onclick="openPopup()">Postuler</p>
                    <i class="ai-ribbon" id="<?php echo $id ?>" onclick="secondAddWhishlist(this)"></i>
                    <i class='bx bxs-bookmark'></i>
                </div>
            </div>

        </div>


        <!-- main -->
        <div class="main_content">

            <!-- ======LEFT======= -->
            <div class="left">
                <div class="part">
                    <h3 class="translate">Description</h3>
                    <div class="content">
                        <p>
                            <?php echo $row['content'] ?>
                        </p>
                    </div>

                </div>

            </div>


            <!-- ====== RIGHT====== -->
            <div class="right">

                <h3 class="title">Offres similaires</h3>
                <div class="job_bloc">
                    <?php
                    $other_query = mysqli_query($conn, "SELECT * FROM jobs WHERE job_category='$cat' AND job_sub_category='$sub_cat' AND title !='$title' LIMIT 4");
                    if (mysqli_num_rows($other_query) > 0) {

                        while ($other_row = mysqli_fetch_assoc($other_query)) {
                            $id = $other_row['id'];
                            $idFree = $_SESSION['unique_freelancer_id'];

                    ?>
                            <div class="job" $id="<?php echo $id ?>" cat="<?php echo $row['job_category'] ?>" sub="<?php echo $row['job_sub_category'] ?>">
                                <!-- up job -->
                                <div class="top">
                                    <div class="row first">
                                        <h3 class="name"><?php echo $other_row['title'] ?></h3>
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
                                            $dateToCheck = $other_row['expire_date'];
                                            $parsedDate = parseDate($dateToCheck);
                                            $currentDate = new DateTime();

                                            if ($parsedDate > $currentDate) {
                                                echo " Disponible jusqu'au" . " " . $other_row['expire_date'];
                                            } else {
                                                echo "offre indisponible ";
                                            }

                                            ?></span>
                                        <div class="job_detail">
                                            <span class="translate"><?php echo $other_row['job_type'] ?></span>
                                            <span class="translate"><?php echo $other_row['experience'] ?></span>
                                            <span class="translate">Un details</span>
                                        </div>
                                        <span class="translate delay">
                                            <?php
                                            $dateToCheck = $other_row['post_date'];
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
                                        <span class="applier translate"><i class='bx bxs-circle'></i> <?php echo $other_row['applicants'] ?> postulants</span>
                                    </div>
                                </div>

                                <!-- bottom job -->
                                <div class="bottom">
                                    <div class="salary">
                                        <span><?php echo $other_row['salary'] . " " . $other_row['currency'] ?></span>
                                        <!-- <span>/mois</span> -->
                                    </div>
                                    <a href="job_details.php?jobId=<?php echo $other_row['id'] ?>" class="translate"> plus de details</a>
                                </div>
                            </div>
                    <?php
                        }
                    } ?>

                </div>
            </div>

        </div>



    </div>



    <!-- Custom js -->
    <script src="https://unpkg.com/akar-icons-fonts"></script>
    <script src="freelancer_dashboard_assets/js/Job_details.js"></script>
    <script src="freelancer_dashboard_assets/js/translate.js"></script>

</body>

</html>