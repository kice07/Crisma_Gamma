<?php
include("../config.php");
session_start();
$id = $_SESSION['unique_company_id'];
$jobs_query = mysqli_query($conn, "SELECT * FROM jobs WHERE company_id='$id'");
$counter=1;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin_dashboard_assets/css/offers_list.css">
    <link rel="stylesheet" href="admin_dashboard_assets/css/navbar.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css'>

    <link rel="icon" href="admin_dashboard_assets/images/crislogo.png" type="image/png">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <title>CrismaWork | Dashboard | Admin | offer_list </title>

</head>

<body>


    <!-- Navbar -->
    <?php include("navbar.php") ?>



    <div class="big_container">
        <div class="veil"></div>
        <!-- banner -->
        <div class="banner">

            <h3 class="translate">Une revue de toutes vos offres jusqu'à présent</h3>
            <img src="admin_dashboard_assets/images/other/file.png" alt="">
        </div>


        <!-- main -->
        <div class="main_content">

            <!-- ======LEFT======= -->
            <div class="left">
                <table>
                    <tr>
                        <th></th>
                        <th class="translate">Numéro</th>
                        <th class="translate">Poste</th>
                        <th class="translate">Catégories</th>
                        <th class="translate">Sous catégories</th>
                        <th class="translate">Candidatures</th>
                        <th class="translate" colspan="2">Action</th>

                    </tr>
                    <?php
                    while ($row = mysqli_fetch_assoc($jobs_query)) {
                    ?>
                        <tr>

                            <td>
                                <div class="check" onclick="toggleCheckbox(this)" id="<?php echo $row['id']?>"><i class='bx bx-check'></i></div>
                            </td>
                            <td class="ongoing"><?php echo $counter++; ?></td>
                            <td class="translate"><?php echo $row['title']?></td>
                            <td class="translate"><?php echo $row['job_category']?></td>
                            <td class="translate"><?php echo $row['job_sub_category']?></td>
                            <td class="translate"><a href="applicants.php?job_id=<?php echo $row['id']?>">Les postuants</a></td>
                            <td>
                                <div class="options">
                                    <a href="edit_job.php?job_id=<?php echo $row['id']?>"><i class='bx bx-pencil'></i></a>
                                    <i class='bx bx-trash'id="<?php echo $row['id']?>" onclick="deleteRow(this)"></i>
                                </div>

                            </td>

                        </tr>
                    <?php
                    }

                    ?>





                </table>

            </div>


            <!-- ====== RIGHT====== -->
            <div class="right">
                <p class="none">Aucune offre selectionée</p>
                <div class="job_file">
                    <img src="admin_dashboard_assets/images/crislogo.png" alt="" class="watermark">




                </div>
            </div>

        </div>



    </div>



    <!-- Custom js -->
    <script src="https://unpkg.com/akar-icons-fonts"></script>
    <script src="admin_dashboard_assets/js/offers_list.js"></script>
    <!-- <script src="admin_dashboard_assets/js/translate.js"></script> -->

</body>

</html>