<?Php
include("../config.php");
session_start();
// session value
$company_id = $_SESSION['unique_company_id'];
$get_freelancer_data = mysqli_query($conn, "SELECT * FROM company WHERE id='{$company_id}'");

$company_row = mysqli_fetch_assoc($get_freelancer_data);
$_SESSION['name'] = $company_row['name'];
$_SESSION['email'] = $company_row['email'];
$_SESSION['location'] = $company_row['location'];
$_SESSION['language'] = $company_row['language'];
$_SESSION['pass'] = $company_row['pass'];
$_SESSION['status'] = $company_row['status'];
$_SESSION['picture'] = $company_row['picture'];
$_SESSION['employe'] = $company_row['employe'];


//contract information
$contract_query = mysqli_query($conn, "SELECT free_id, ending, state FROM contrat WHERE comp_id='$company_id'");


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="admin_dashboard_assets/css/Admin_dashboard.css">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css'>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <link rel="icon" href="admin_dashboard_assets/images/crislogo.png" type="image/png">

    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <title>CrismaWork | Dashboard | Admin</title>
</head>

<body>


    <div class="topNav">
        <img src="admin_dashboard_assets/images/other/logo_strokes.png" class="stroke" alt="">
        <!-- navbar -->
        <?php include("navbar.php") ?>

        <!-- banner -->
        <div class="banner">
            <div class="content">
                <h3 class="translate">Bienvenu Kice Corp</h3>
                <div class="options">
                    <a class="resume" href="offer_list.php">
                        <p class="translate">Vos offes</p>
                        <i class='bx bx-right-arrow-alt'></i>
                    </a>
                    <a href="freelancer.php" class="translate">Freelancers</a>
                </div>
            </div>
        </div>
    </div>

    <!-- main -->
    <div class="main_content">

        <!-- ======LEFT======= -->
        <div class="left">
            <div class="bloc">
                <h3 class="translate">Vue d'ensemble</h3>
                <div class="stats">

                    <div class="stat">
                        <div class="line">
                            <i class='bx bx-file'></i>
                            <i class='bx bx-dots-vertical-rounded'></i>
                        </div>
                        <p class="translate label">contrat en cours</p>
                        <div class="line">
                            <p>10</p>
                            <div class="comparison">
                                <i class='bx bx-up-arrow-alt'></i>
                                <span>20%</span>
                            </div>
                        </div>
                    </div>


                    <div class="stat">
                        <div class="line">
                            <i class='bx bx-briefcase-alt-2'></i>
                            <i class='bx bx-dots-vertical-rounded'></i>
                        </div>
                        <p class="translate label"> vos offres</p>
                        <div class="line">
                            <p>30</p>
                            <div class="comparison">
                                <i class='bx bx-up-arrow-alt'></i>
                                <span>20%</span>
                            </div>
                        </div>
                    </div>

                    <div class="Add_stat">
                        <a href="#">+</a>
                        <p class="translate">Ajouter</p>
                    </div>

                </div>
            </div>

            <div class="bloc">
                <div class="head">
                    <h3 class="translate">Contrats</h3>
                    <a class="download">
                        <i class='bx bx-cloud-download'></i>
                        <p>Rapport</p>
                    </a>
                </div>

                <table>
                    <tr>
                        <th class="translate">Freelancer</th>
                        <th class="translate">Statut</th>
                        <th class="translate">Type</th>
                        <th class="translate">Debut</th>
                        <th class="translate">Fin</th>
                        <th class="translate" colspan="2">Action</th>

                    </tr>

                    <?php
                    while ($contract = mysqli_fetch_assoc($contract_query)) {
                        $actual_free_id = $contract['free_id'];
                        $free_info_query = mysqli_query($conn, "SELECT nom, image FROM freelancer WHERE id='$actual_free_id'");
                        $actual_free = mysqli_fetch_assoc($free_info_query);
                    ?>
                        <tr>
                            <td>
                                <img src="../Freelancer_Dashboard/freelancer_dashboard_assets/images/freelancer/<?php echo $actual_free['image']?>" alt="">
                                <div class="about">
                                    <p><?php echo $actual_free['nom']?></p>
                                    <p class="translate">Freelancer</p>
                                </div>
                            </td>
                            <td class="ongoing">
                                <p class="translate"><?php echo $contract['state']?></p>
                            </td>
                            <td class="translate">contrat</td>
                            <td class="translate"><?php echo $contract['state']?></td>
                            <td class="translate"><?php echo $contract['ending']?></td>
                            <td>
                                <a href=""><i class='bx bx-pencil'></i></a>
                                <a href=""><i class='bx bx-trash'></i></a>
                            </td>

                        </tr>
                    <?php
                    }

                    ?>





                </table>


            </div>
        </div>

        <!-- ====== RIGHT====== -->
        <div class="right">

            <!-- calendar -->
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

            <!-- task -->
            <div class="task-box" tabindex="0">

            </div>

        </div>


    </div>







    <!-- Custom js -->
    <script src="admin_dashboard_assets/js/Admin_dashboard.js"></script>
    <!-- <script src="freelancer_dashboard_assets/js/translate.js"></script> -->

</body>

</html>