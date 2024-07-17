<?Php
include("../config.php");
session_start();

$freelancer_id = $_SESSION['unique_freelancer_id'];
$get_freelancer_data = mysqli_query($conn, "SELECT * FROM freelancer WHERE id='{$freelancer_id}'");

$freelancer_row = mysqli_fetch_assoc($get_freelancer_data);
$_SESSION['nom'] = $freelancer_row['nom'];
$_SESSION['prenom'] = $freelancer_row['prenom'];
$_SESSION['age'] = $freelancer_row['age'];
$_SESSION['email'] = $freelancer_row['email'];
$_SESSION['pays'] = $freelancer_row['pays'];
$_SESSION['language'] = $freelancer_row['langage'];
$_SESSION['password'] = $freelancer_row['password'];
$_SESSION['image'] = $freelancer_row['image'];
$_SESSION['plan'] = $freelancer_row['plan'];
$_SESSION['availability'] = $freelancer_row['availability'];


?>



<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="freelancer_dashboard_assets/css/navbar.css">
    <link rel="stylesheet" href="freelancer_dashboard_assets/css/Freelancer_dashboard.css">
    <!-- <link rel="stylesheet" href="freelancer_dashboard_assets/css/index.css"> -->
    <style>
        .nothing {
            display: flex;
            flex-direction: column;
            gap: 3%;
            justify-content: center;
            align-items: center;

        }

        .nothing img {
            height: 600px;
            width: 600px;
        }

        .nothing p {
            font-weight: bold;
            font-size: 1.3em;
        }
    </style>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css'>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <link rel="icon" href="freelancer_dashboard_assets/images/crislogo.png" type="image/png">

    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <title>CrismaWork | Dashboard | Freelancer</title>
</head>

<body>

    <!--Navbar -->
    <?php include('navbar.php') ?>

    <!-- Big Content -->
    <div class="big_container">

        <!-- banner -->
        <div class="banner">
            <div class="content">
                <h3 class="translate">Bienvenu Ehouman Ivan</h3>
                <div class="options">
                    <a class="resume">
                        <p class="translate">Vos cv</p>
                        <i class='bx bx-right-arrow-alt'></i>
                    </a>

                    <a href="" class="translate">Offres disponibles</a>
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
                            <p class="translate label"> vos cv</p>
                            <div class="line">
                                <p>
                                    <?php
                                    $resumeNumber = mysqli_query($conn, "SELECT COUNT(*) AS resume_number FROM resume");
                                    echo mysqli_fetch_assoc($resumeNumber)['resume_number'];
                                    ?>
                                </p>
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
                            <th class="translate">Compagnie</th>
                            <th class="translate">Statut</th>
                            <th class="translate">Type</th>
                            <th class="translate">Debut</th>
                            <th class="translate">Fin</th>
                            <th class="translate" colspan="2">Action</th>

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
                                <p class="translate">en cours</p>
                            </td>
                            <td class="translate">contrat</td>
                            <td class="translate">11/10/23</td>
                            <td class="translate">02/04/25</td>
                            <td>
                                <a href=""><i class='bx bx-pencil'></i></a>
                                <a href=""><i class='bx bx-trash'></i></a>
                            </td>

                        </tr>

                        <tr>
                            <td>
                                <img src="freelancer_dashboard_assets/images/Google_ logo.png" alt="">
                                <div class="about">
                                    <p>Google</p>
                                    <p class="translate">Technologie et Ia</p>
                                </div>
                            </td>
                            <td class="ended">
                                <p class="translate">Terminé</p>
                            </td>
                            <td class="translate">contrat</td>
                            <td class="translate">11/10/23</td>
                            <td class="translate">02/04/25</td>
                            <td>
                                <a href=""><i class='bx bx-pencil'></i></a>
                                <a href=""><i class='bx bx-trash'></i></a>
                            </td>

                        </tr>

                        <tr>
                            <td>
                                <img src="freelancer_dashboard_assets/images/Google_ logo.png" alt="">
                                <div class="about">
                                    <p>Google</p>
                                    <p class="translate">Technologie et Ia</p>
                                </div>
                            </td>
                            <td class="failed">
                                <p class="translate">Annulé</p>
                            </td>
                            <td class="translate">contrat</td>
                            <td class="translate">11/10/23</td>
                            <td class="translate">02/04/25</td>
                            <td>
                                <a href=""><i class='bx bx-pencil'></i></a>
                                <a href=""><i class='bx bx-trash'></i></a>
                            </td>

                        </tr>


                    </table>

                    <div class="nothing">
                        <img src="freelancer_dashboard_assets/images/no-file.png" alt="">
                        <p>Aucun contrats pour l'instant</p>
                    </div>

                </div>
            </div>

            <!-- ====== RIGHT====== -->
            <div class="right">

                <!-- card -->
                <div class="card">
                    <img class="card_background" src="freelancer_dashboard_assets/images/other/wm2.png" alt="">
                    <div class="line">
                        <i class='bx bx-wifi'></i>
                        <img src="freelancer_dashboard_assets/images/crislogo2.png" alt="">
                    </div>
                    <p class="label">7,247.23</p>
                    <div class="line">
                        <div class="details">
                            <div class="part">
                                <p class="translate">Propriétaire</p>
                                <p><?php echo $_SESSION['nom'] ?></p>
                            </div>
                            <div class="part">
                                <p class="translate">Devise</p>
                                <p>USD</p>
                            </div>
                        </div>
                        <img src="freelancer_dashboard_assets/images/other/chip.png" alt="">
                    </div>
                </div>

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

    </div>




    <!-- <script src="freelancer_dashboard_assets/js/freelancer.js"></script> -->

    <!-- Calendar -->
    <script>
        let date = new Date();
        let year = date.getFullYear();
        let month = date.getMonth();

        const day = document.querySelector(".calendar-dates");
        var weeksDay;

        const currdate = document
            .querySelector(".calendar-current-date");

        const prenexIcons = document
            .querySelectorAll(".calendar-navigation span");

        // Array of month names
        const months = [
            "January",
            "February",
            "March",
            "April",
            "May",
            "June",
            "July",
            "August",
            "September",
            "October",
            "November",
            "December"
        ];

        // Function to generate the calendar
        const manipulate = () => {

            // Get the first day of the month
            let dayone = new Date(year, month, 1).getDay();

            // Get the last date of the month
            let lastdate = new Date(year, month + 1, 0).getDate();

            // Get the day of the last date of the month
            let dayend = new Date(year, month, lastdate).getDay();

            // Get the last date of the previous month
            let monthlastdate = new Date(year, month, 0).getDate();

            // Variable to store the generated calendar HTML
            let lit = "";

            // Loop to add the last dates of the previous month
            for (let i = dayone; i > 0; i--) {
                lit +=
                    `<li class="inactive">${monthlastdate - i + 1}</li>`;
            }

            // Loop to add the dates of the current month
            for (let i = 1; i <= lastdate; i++) {

                // Check if the current date is today
                let isToday = i === date.getDate() &&
                    month === new Date().getMonth() &&
                    year === new Date().getFullYear() ?
                    "active" :
                    "";
                lit += `<li class="${isToday}">${i}</li>`;
            }

            // Loop to add the first dates of the next month
            for (let i = dayend; i < 6; i++) {
                lit += `<li class="inactive">${i - dayend + 1}</li>`
            }

            // Update the text of the current date element 
            // with the formatted current month and year
            currdate.innerText = `${months[month]} ${year}`;

            // update the HTML of the dates element 
            // with the generated calendar
            day.innerHTML = lit;
            weeksDay = day.querySelectorAll("li"); // Pour trigger les task

        }

        manipulate();

        // Attach a click event listener to each icon
        prenexIcons.forEach(icon => {

            // When an icon is clicked
            icon.addEventListener("click", () => {

                // Check if the icon is "calendar-prev"
                // or "calendar-next"
                month = icon.id === "calendar-prev" ? month - 1 : month + 1;

                // Check if the month is out of range
                if (month < 0 || month > 11) {

                    // Set the date to the first day of the 
                    // month with the new year
                    date = new Date(year, month, new Date().getDate());

                    // Set the year to the new year
                    year = date.getFullYear();

                    // Set the month to the new month
                    month = date.getMonth();
                } else {

                    // Set the date to the current date
                    date = new Date();
                }

                // Call the manipulate function to 
                // update the calendar display

                manipulate();
            });
        });
    </script>

    <!-- Task manager  -->


    <!-- Custom js -->

    <!-- <script src="freelancer_dashboard_assets/js/translate.js"></script> -->

</body>

</html>