<?php
// jo_i
include ('config.php');

function dateDiff($date) {
    $datePassee = new DateTime($date);
    
    // Obtenir la date actuelle
    $dateActuelle = new DateTime();
    
    // Calculer la différence entre les deux dates
    $difference = $dateActuelle->diff($datePassee);
    
    // Retourner la différence en jours
    return $difference->days;
}
if(isset($_GET['jo_i'])){
    $id = $_GET['jo_i'];
    $job = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM jobs WHERE id ='{$id}'"));
    $company_id = $job['company_id'];

    $employe = mysqli_fetch_assoc(mysqli_query($conn,"SELECT employe FROM company WHERE id ='{$company_id}'"))['employe'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets2/css/job_details.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css'>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <title>CrismaWork | Job browsing</title>
</head>

<body>

    <!-- ============HEADER============ -->
    <nav class="nav">
        <div class="logo">
            <img src="assets2/images/other/CrisLogoBlack.png" alt="">
        </div>

        <div class="mid">
            <a href="#" class="text translate">Tutoriel</a>
            <a href="#" class="text translate">Offres disponibles</a>
            <div class="lang">

                <img src="https://flagcdn.com/fr.svg" width="30" alt="France">
                <!-- usa--<img src="https://flagcdn.com/um.svg" width="30" alt="Îles mineures éloignées des États-Unis"> -->
                <a href="" class="text">Fr</a>
                <i class='bx bx-chevron-down'></i>

            </div>
        </div>

        <div class="end">
            <a href="#" class="text translate">Devenir une entreprise</a>
            <a href="#" class="text translate">Connexion</a>
            <a href="#" class="sign translate">Inscription</a>
        </div>

    </nav>

    <div class="categories">
        <p class="translate">Gaming</p>
        <p class="translate">Developement</p>
        <p class="translate">Musique</p>
        <p class="translate">Transcription</p>
        <p class="translate">Dev Perso</p>
        <p class="translate">Design</p>
        <p class="translate">Marketing</p>
        <p class="translate">Business</p>
        <p class="translate">Autres</p>
    </div>

    <!--=========JOB_DETAIL_BLOC=========-->

    <div class="main_part">
        <div class="left">
            <div class="up">
                <div class="mirror">
                    <p class="translate"><?php echo $job['title']?></p>
                    <span class="translate">Il y a <?php echo dateDiff($job['post_date']) ?> jours</span>
                </div>

            </div>


            <div class="down">
                <div class="infos">

                    <div class="item">
                        <i class='bx bxs-group'></i>
                        <div class="left_side">
                            <span class="translate">Postulant</span>
                            <span class="candidate">3 postulants</span>
                        </div>

                    </div>

                    <div class="item">
                        <i class='bx bxs-briefcase-alt-2'></i>
                        <div class="left_side">
                            <span class="translate">Experience</span>
                            <span class="translate"><?php echo $job['experience']?></span>
                        </div>

                    </div>

                    <div class="item">
                        <i class='bx bx-money'></i>
                        <div class="left_side">
                            <span class="translate">Salaire</span>
                            <span class="translate"> <?php echo $job['salary_amount']?> $</span>
                        </div>

                    </div>

                    <div class="item">
                        <i class='bx bxs-time-five'></i>
                        <div class="left_side">
                            <span class="translate">Type</span>
                            <span class="translate"><?php echo $job['job_type']?></span>
                        </div>

                    </div>

                    <div class="item">
                        <i class='bx bxs-user'></i>
                        <div class="left_side">
                            <span class="translate">Poste</span>
                            <span class="translate"><?php echo $job['title']?></span>
                        </div>

                    </div>
                </div>

                <div class="text">

                    <!-- ======== Description -->
                    <div class="part one">
                        <h3 class="translate">Description</h3>
                        <p class="translate"><?php echo $job['content']?></p>
                        

                       
                    </div>


                    <!-- ========= Atteachement -->
                    <div class="part two">
                        <h3 class="translate">Fichiers annexe</h3>
                        <div class="attachement_files">

                            <div class="files">
                                <p class="translate">Project Brief</p>
                                <span class="translate">PDF</span>
                                <i class='bx bx-download'></i>
                            </div>

                            <div class="files">
                                <p class="translate">Something else</p>
                                <span class="translate">PDF</span>
                                <i class='bx bx-download'></i>
                            </div>
                        </div>
                    </div>


                    <!-- ==========Skills -->
                    <div class="part three">
                        <h3 class="translate">Compétences requises</h3>
                        <div class="skills_item">
                            <?php
                             foreach(explode(" ",$job['skills']) as $skill){
                              ?>
                                 <p class="translate"><?php echo $skill?></p>
                              
                            <?php }?>
                        </div>
                    </div>

                </div>

            </div>

        </div>

        <div class="right">
            <h4 class="translate">Entreprise</h4>
            <!-- <div class="head">
                <img src="assets2/images/Google_ logo.png" alt="">
                <div class="description">
                    <p class="name translate">Google</p>
                    <p class="specialisation translate">Technologie</p>
                </div>
            </div> -->
            <div class="stats">
                <div class="stat">
                    <p class="translate">Employé</p>
                    <span><?php echo $employe?></span>
                </div>
                <div class="stat">
                    <p class="translate">Departement</p>
                    <span class="translate"><?php echo $job['job_category']?></span>
                </div>
            </div>

            <button class="translate">Postuler</button>
        </div>
    </div>

    <div class="footer">
        <div class="row">
            <div class="upper">
                <div class="left">
                    <img src="assets2/images/other/CrisLogoWhite.png" alt="" class="logo">
                    <div class="socials">
                        <i class='bx bxl-instagram'></i>
                        <i class='bx bxl-facebook-circle'></i>
                        <i class='bx bxl-linkedin-square'></i>
                    </div>
                    <p class="catchphrase translate">Avec CrismaWork pouvez vivre pleinement vos rêves</p>
                </div>
                <div class="right">
                    <p class="translate">Grand Bassam , Côte d'Ivoire</p>
                    <p class="email translate">Contact : CrismaWork@gmail.com</p>

                </div>
            </div>
            <div class="down">
                <a href="#" class="translate">Tutoriel</a>
                <a href="job_browsing.html" class="translate">offres</a>
                <a href="login_registration.php" class="translate">Devenir une entreprise</a>
                <a href="login_registration.php" class="translate">Connexion</a>
                <a href="#" class="translate">Inscription</a>

            </div>

        </div>

        <div class="row">
            <p class="title translate">A l'affût</p>
            <p class="translate">Souscrivez à notre newsletter pour être aux aguêts de nouvelles offres</p>
            <div class="newsletter_bar">
                <input type="text" id="subscription" placeholder="Email">
                <button class="translate">Souscrire</button>
            </div>
            <p class="copyright translate">© 2023 CrismaWork. Tous droits reservés</p>

        </div>
    </div>

    <script src="assets2/js/job_details.js"></script>

</body>

</html>