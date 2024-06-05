<?php
session_start();
include("../config.php");

if (isset($_GET['resumeId'])) {
    $resume_id = $_GET['resumeId'];
    $freelancer_id = $_GET['freeId'];
    $resume = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM resume WHERE id ='{$resume_id}'"));
    $experiences = mysqli_query($conn, "SELECT * FROM resume_experience WHERE resume_id ='{$resume_id}'");
    $educations = mysqli_query($conn, "SELECT * FROM resume_education WHERE resume_id ='{$resume_id}'");
    $skills = mysqli_query($conn, "SELECT * FROM resume_skill WHERE resume_id ='{$resume_id}'");
    $languages = mysqli_query($conn, "SELECT * FROM resume_language WHERE resume_id ='{$resume_id}'");
    $freelancer = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM freelancer WHERE id ='{$freelancer_id}'"));

    $contract_query = mysqli_query($conn, "SELECT * FROM contrat WHERE free_id='$freelancer_id");
    if ($contract_query) {
        $contract = mysqli_num_rows($contract_query);
    } else {
        $contract = 0;
    }
}


?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin_dashboard_assets/css/Freelancer_details.css">
    <link rel="stylesheet" href="admin_dashboard_assets/css/navbar.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css'>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <link rel="icon" href="admin_dashboard_assets/images/crislogo.png" type="image/png">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <title>CrismaWork | Dashboard | Freelancer_details</title>
</head>

<body>

    <?php include('navbar.php') ?>


    <div class="main_content">
        <div class="banner">
            <h3 class="translate"><?php echo $freelancer['nom'] . " " . $freelancer['prenom'] ?></h3>
            <span class="translate"><?php echo (isset($freelancer['availability'])) ? $freelancer['availability'] : "indisponible" ?></span>
        </div>
        <div class="freelancer_details">
            <div class="left">

                <div class="infos">

                    <!-- <div class="item">
                        <i class="fa-solid fa-bullseye"></i>
                        <div class="left_side">
                            <span class="translate">Taux de reussite</span>
                            <span class="candidate">98%</span>
                        </div>

                    </div> -->

                    <div class="item">
                        <i class="fa-solid fa-signal"></i>
                        <div class="left_side">
                            <span class="translate">contrats</span>
                            <span class="translate"><?php echo $contract ?></span>
                        </div>

                    </div>



                    <div class="item">
                        <i class="fa-solid fa-language"></i>
                        <div class="left_side">
                            <span class="translate">Langue</span>
                            <span class="translate">
                                <?php
                                while ($language = mysqli_fetch_assoc($languages)) {
                                    echo $language['label'] . " ";
                                }

                                ?>

                            </span>

                        </div>

                    </div>

                    <div class="item">
                        <i class="fa-solid fa-location-dot"></i>
                        <div class="left_side">
                            <span class="translate"><?php echo $freelancer['pays'] ?></span>
                            <span class="translate"><?php echo $resume['position'] ?></span>
                        </div>

                    </div>
                </div>

                <div class="text">

                    <!-- ======== Description -->
                    <div class="part one">
                        <h3 class="translate">Description</h3>
                        <p class="translate">
                            <?php echo $resume['bio'] ?><br>
                            ROME, 26 janvier (Reuters) - L'organisme italien de protection de la vie privée a infligé une amende à la ville de Trente, dans le nord du pays, pour avoir enfreint les règles de protection des données dans la manière dont elle a utilisé l'intelligence artificielle (IA) dans des projets de surveillance des rues.
                            Trento a été condamné à une amende de 50 000 euros (54 225 dollars) et à supprimer toutes les données collectées dans le cadre de deux projets financés par l'Union européenne. Il s'agit de la première administration locale en Italie à être sanctionnée par l'organisme de surveillance du GPDP pour l'utilisation des données provenant d'outils d'IA.
                            L'autorité - l'une des plus proactives de l'UE dans l'évaluation de la conformité des plateformes d'IA avec le régime de confidentialité des données du bloc - a brièvement interdit l'année dernière le chatbot populaire ChatGPT en Italie.
                            En 2021, il a également déclaré qu’un système de reconnaissance faciale testé par le ministère italien de l’Intérieur n’était pas conforme aux lois sur la protection de la vie privée.

                            Les progrès rapides de l’IA dans plusieurs secteurs ont soulevé des questions sur le droit à la vie privée et la sécurité des données personnelles.
                            Après une enquête approfondie sur les projets de Trente, le GPDP a constaté "de multiples violations des règles de confidentialité", a-t-il déclaré dans un communiqué, tout en reconnaissant que la municipalité avait agi de bonne foi.

                            Elle a déclaré que les données collectées n'étaient pas suffisamment anonymes et qu'elles étaient partagées à tort avec des tiers.
                            La municipalité a indiqué qu'elle envisageait de faire appel de cette décision.

                            "La décision du régulateur met en évidence à quel point la législation actuelle est totalement insuffisante pour réglementer l'utilisation de l'IA pour analyser de grandes quantités de données et améliorer la sécurité des villes", a-t-il déclaré dans un communiqué.

                            Le gouvernement italien dirigé par la Première ministre Giorgia Meloni a déclaré qu'il mettrait en lumière la révolution de l'IA lors de sa présidence du Groupe des Sept grandes démocraties (G7).
                            En décembre, les législateurs et les gouvernements de l’UE ont convenu de conditions provisoires pour réglementer les systèmes d’IA comme ChatGPT, faisant ainsi un pas de plus vers l’établissement de règles régissant cette technologie. Un point de friction critique concernait l’utilisation de l’IA dans la surveillance biométrique.

                            ministère des Affaires étrangères, du Commerce et du Développement

                            OTTAWA, 30 janvier (Reuters) - Le gouvernement canadien a déclaré mardi que son département des affaires mondiales avait subi une violation de données et qu'il y avait eu un accès non autorisé aux informations personnelles des utilisateurs, y compris des employés.
                            Affaires mondiales Canada (AMC), dans un communiqué, a déclaré avoir activé une panne informatique imprévue le 24 janvier pour « faire face à la découverte d'une cyberactivité malveillante ».
                            Le ministère, qui comprend les ministères canadiens du Commerce et des Affaires étrangères, n'a pas précisé quand la violation de données s'est produite. Les médias canadiens, citant des sources anonymes, avaient rapporté plus tôt que les systèmes internes étaient vulnérables entre le 20 décembre et le 24 janvier.
                            GAC a déclaré que ses services critiques et ses canaux de communication externes étaient accessibles et opérationnels et que les équipes informatiques travaillaient pour restaurer la connectivité complète.
                            Le ministère a déclaré qu'il contactait les personnes touchées par la violation avec des mesures d'atténuation et que les employés travaillant à distance au Canada avaient reçu des solutions de contournement pour poursuivre leurs fonctions.

                            Reportage d'Ismail Shakil à Ottawa Rédaction par Matthew Lewis

                        </p>
                    </div>


                    <!-- ========= Education -->
                    <div class="part two">
                        <h3 class="translate">Educations</h3>
                        <div class="timeline">
                            <?php
                            while ($education = mysqli_fetch_assoc($educations)) {
                            ?>
                                <div class="date">
                                    <i class="fa-solid fa-circle"></i>
                                    <span>
                                        <?php echo $education['starting_date'] ?> -
                                        <?php echo $education['ending_date'] ?>
                                    </span>
                                </div>
                                <div class="event">
                                    <h4 class="translate">
                                        <?php echo $education['degree'] ?>
                                    </h4>
                                    <span class="translate">
                                        <?php echo $education['name'] ?>
                                    </span>
                                    <p class="translate">
                                        <?php echo $education['description'] ?>
                                    </p>
                                </div>

                            <?php }
                            ?>


                        </div>
                    </div>


                    <!-- ==========experiences -->

                    <div class="part two">
                        <h3 class="translate">Experiences</h3>
                        <div class="timeline">
                            <?php
                            while ($experience = mysqli_fetch_assoc($experiences)) {
                            ?>
                                <div class="date">
                                    <i class="fa-solid fa-circle"></i>
                                    <span>
                                        <?php echo $experience['starting_date'] ?> -
                                        <?php echo $experience['ending_date'] ?>
                                    </span>
                                </div>
                                <div class="event">
                                    <h4 class="translate">
                                        <?php echo $experience['position'] ?>
                                    </h4>
                                    <span class="translate">
                                        <?php echo $experience['company'] ?>
                                    </span>
                                    <p class="translate">
                                        <?php echo $experience['description'] ?>
                                    </p>
                                </div>

                            <?php }
                            ?>



                        </div>
                    </div>


                    <!-- ==========experiences -->

                    <div class="part two">
                        <h3 class="translate">Certifications</h3>
                        <div class="timeline">
                            <div class="date">
                                <i class="fa-solid fa-circle"></i>
                                <span>2014 - 2016</span>
                            </div>
                            <div class="event">
                                <h4 class="translate">Django beginner</h4>
                                <span class="translate">Open Classroom</span>
                                <p class="translate">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                    Dolorem consequuntur nam beatae, ad dolores odio accusantium alias.
                                    aperiam nulla mollitia a quibusdam voluptatum illum est doloribus
                                    tempore? Tempora, officiis debitis!
                                </p>
                            </div>

                            <div class="date">
                                <i class="fa-solid fa-circle"></i>
                                <span>2012 - 2014</span>
                            </div>
                            <div class="event">
                                <h4 class="translate">Dev Front eend</h4>
                                <span class="translate">Meta</span>
                                <p class="translate">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                    Dolorem consequuntur nam beatae, ad dolores odio accusantium alias.
                                    aperiam nulla mollitia a quibusdam voluptatum illum est doloribus
                                    tempore? Tempora, officiis debitis!
                                </p>
                            </div>
                        </div>
                    </div>


                </div>

            </div>

            <div class="right">
                <h4 class="translate">A propos</h4>
                <div class="head">
                    <img src="../Freelancer_Dashboard/freelancer_dashboard_assets/images/freelancer/<?php echo $freelancer['image'] ?>" alt="">
                    <div class="description">
                        <p class="name translate">
                            <?php echo $freelancer['nom'] . " " . $freelancer['prenom'] ?>
                        </p>
                        <p class="specialisation translate">
                            <?php echo $resume['sous_category'] ?>
                        </p>
                    </div>
                </div>
                <div class="part three">

                    <div class="skills_item">

                        <?php
                        while ($skill = mysqli_fetch_assoc($skills)) {
                        ?>
                            <p class="translate">
                                <?php echo $skill['label'] ?>
                            </p>
                        <?php }
                        ?>

                    </div>
                </div>

                <!-- <a href="chat.php" class="translate sender">Contactez moi</a> -->

                <button class="translate sender"><a href="">Contactez moi</a></button>
            </div>

        </div>

    </div>





    <!-- Custom js -->
    <!-- <script src="admin_dashboard_assets/js/admin_dashboard.js"></script>
    <script src="admin_dashboard_assets/js/freelancer.js"></script> -->
    <!-- <script src="admin_dashboard_assets/js/translate.js"></script> -->

</body>

</html>