<?php

include("../config.php");
session_start();
$id = $_SESSION['unique_company_id'];
$thumbnail_query = mysqli_query($conn, "SELECT picture FROM company WHERE id = '{$id}'");
$thumbnail = mysqli_fetch_assoc($thumbnail_query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin_dashboard_assets/css/chat_company.css">
    <link rel="stylesheet" href="admin_dashboard_assets/css/navbar.css">
    <link rel="stylesheet" href="../main_assets/css/video_call_both_UI.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.6.0/uicons-thin-rounded/css/uicons-thin-rounded.css'>

    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <title>CrismaWork | Dashboard | Admin | Chat</title>

</head>

<body>


    <!-- Navbar -->
    <div class="topNav">
        <img src="admin_dashboard_assets/images/other/logo_strokes.png" class="stroke" alt="">
        <?php include("navbar.php") ?>
        <div class="banner">
            <h3>Discutez avec de potentiels employé</h3>
        </div>

    </div>

    <!-- main -->
    <div class="main_content">
        <div class="veil"></div>

        <!-- Le chat est fait du point de vu de l'utilisateur connecté
        d'ou ses messages sont des outgoing et ceux de celui aui lui ecrit, des incoming -->
        <div class="chat_bloc"
            myId="<?php echo $id ?>"
            myPic="<?php echo $thumbnail['picture'] ?>">
            <div class="left">
                <!-- choisir entre les discussions et le journal d'appel -->
                <div class="chat_side">

                    <!-- discusission -->
                    <div class="side active">
                        <i class='bx bxs-message-dots'></i>
                        <p class="translate">Discussions</p>
                    </div>
                    <!-- journal d'apel -->
                    <div class="side">
                        <i class='bx bxs-phone'></i>
                        <p class="translate">Journal d'appels</p>
                    </div>
                </div>

                <!-- Listes des users  -->
                <div class="users_list">
                    <!-- chercher un nom ou message en particulier -->
                    <div class="search_bar">
                        <input type="text" placeholder="Chercher">
                        <i class="ai-search"></i>
                    </div>

                    <ul>

                    </ul>
                </div>

                <!-- call logs preview -->
                <div class="calls_logs_preview">
                    <div class="search_bar">
                        <input type="text" placeholder="Chercher">
                        <i class="ai-search"></i>
                    </div>
                    <ul>

                    </ul>
                </div>
            </div>

            <div class="right">

                <div class="no_content">
                    <p>Choisissez une conversation</p>
                </div>
                <div class="call_log_detail">
                </div>
                <!-- actual chat details -->
                <div class="up">
                    <!-- person profile -->
                    <div class="info">
                        <img src="admin_dashboard_assets/images/Ely.jpg" alt="">
                        <div class="name_status">
                            <p>Ehouman Koua Ely</p>
                            <div class="status">
                                <i class="ai-circle-fill"></i>
                                <span class="translate">en ligne</span>
                            </div>
                        </div>
                    </div>

                    <div class="action">
                        <!-- video call -->
                        <i class='bx bx-video' onclick="videoCall(this)"></i>

                        <!-- upload contrat  for comp-->
                        <i class='bx bx-upload' onclick="createContract()"></i>


                        <!-- Chercher dans la conversion-->
                        <i class="ai-search"></i>
                    </div>

                </div>

                <div class="down">
                    <div class="message_box">
                        <!-- serch message -->
                        <div class="search_message_popup">
                            <div class="search_message_popup">
                                <div class="input_container">
                                    <div class="input_field">
                                        <input type="text" name="search_text" placeholder="chercher">
                                        <div class="found">
                                            <span>3</span>
                                            <span>sur</span>
                                            <span>3</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="options">
                                    <i class="ai-chevron-up"></i>
                                    <i class="ai-chevron-down"></i>
                                    <i class="ai-cross"></i>
                                </div>

                            </div>
                        </div>


                        <!-- goDown button -->
                        <button class="goDown"><i class="ai-arrow-down"></i></button>
                    </div>
                    <div class="send">
                        <!-- upload file -->
                        <i class="ai-attach"></i>

                        <input type="file" class="fileInput" accept=".pdf,.doc,.docx,.xlsx" hidden>
                        <textarea placeholder="Saisissez quelque chose"></textarea>
                        <i class='bx bx-send'></i>
                    </div>


                    <!-- file popup -->
                    <div class="file_popup">
                        <div class="file_popup_container">
                            <div class="preview">
                                <img src="admin_dashboard_assets/images/other/word.png" alt="">
                                <p class="title">Document title</p>
                                <p class="weight"> 52ko, pdf</p>
                            </div>
                            <div class="options">
                                <textarea name="" placeholder="Légende (Facultatif)"></textarea>
                                <i class='bx bx-send' onclick="sendFile(this)"></i>
                            </div>
                        </div>

                    </div>


                    <!-- contract acceptance popup -->
                    <div class="contract_popup" style="display: none;">
                        <div class="preview">

                        </div>
                        <div class="options">
                            <button class="translate">Accepter l'offre</button>
                            <button class="translate">Decliner l'offre</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>


        <!-- quitter le file_popup -->
        <div class="quit_file_popup">
            <div class="quit_file_popup_container">
                <div class="info">
                    <h3>Abandonner le media</h3>
                    <p>Si vous quittez cet écran , le média ne sera pas envoyé</p>
                </div>
                <div class="options">
                    <button class="translate quit">Abandonner</button>
                    <button class="translate back">Revenir au media</button>
                </div>
            </div>

        </div>

        <!-- create contract -->
        <div class="create_offer_popup">
            <!-- defilement -->
            <div class="up">
                <div class="left">
                    <p class="translate">Etape</p>
                    <div class="number">
                        <span class="counter">1</span>
                        <span>/7</span>
                    </div>

                </div>
                <div class="right">
                    <i class="ai-chevron-left"></i>
                    <i class="ai-chevron-right"></i>
                </div>
            </div>

            <div class="down">
                <!-- 1. Selection de l'offre -->
                <div class="slide active">
                    <p class="title translate">1. Selection de l'offre</p>
                    <div class="input_field">
                        <input type="text" class="offer_name">
                        <i class="ai-chevron-down" onclick="displaySub(this)"></i>
                    </div>

                    <ul>
                        <li onclick="fillInput(this)">Web design</li>
                        <li onclick="fillInput(this)">Hacking</li>
                        <li onclick="fillInput(this)">Mansion</li>
                        <li onclick="fillInput(this)">CyberSec</li>
                    </ul>
                </div>

                <!-- 2. Période de travail -->
                <div class="slide ">
                    <p class="title translate">2. Période de travail</p>
                    <div class="content">
                        L’emploi de l’employé en vertu
                        du présent accord commencera le
                        <input type="text" class="startingDate" placeholder="( jj/mm/yyyy )">. Et prendra fin
                        le <input type="text" class="EndingDate" placeholder="( jj/mm/yyyy )">
                    </div>
                </div>


                <!--3. Non concurrence -->
                <div class="slide">
                    <p class="title translate">3. Non concurrence</p>
                    <div class="content">
                        L'employé accepte et s'engage pendant la durée du présent accord. <br><br>

                        <div class="choice">
                            <input type="checkbox" name="concurrence" class="concurrence">
                            <span>
                                Fournir des biens ou des services qui
                                concurrencent directement ou indirectement la société.
                            </span>
                        </div>

                        <div class="choice">
                            <input type="checkbox" name="concurrence" class="concurrence">
                            <span>
                                Investir directement ou indirectement dans une entreprise
                                qui concurrence directement ou indirectement la Société.
                            </span>
                        </div>

                        <div class="choice">
                            <input type="checkbox" name="concurrence" class="concurrence">
                            <span>
                                Solliciter les salariés de l'entreprise
                                pour qu'ils quittent leur emploi.
                            </span>
                        </div>

                        <div class="choice">
                            <input type="checkbox" name="concurrence" class="concurrence">
                            <span>
                                S'engager dans toute autre
                                activité entraînant des blessures à l'entreprise.
                            </span>
                        </div>

                    </div>
                </div>

                <!--4. Confidentialité -->
                <div class="slide">
                    <p class="title translate">8. Confidentialité</p>
                    <div class="content">
                        <strong>A. Informations confidentielles et exclusives</strong><br>
                        Au cours de son emploi, l'employé sera
                        exposé à des informations confidentielles et exclusives de l’Employeur. Confidentiel et
                        propriétaire
                        information désigne toute donnée ou information qui constitue un élément sensible sur le plan
                        concurrentiel et qui n'est pas
                        généralement connues du public, y compris, mais sans s'y limiter, les informations relatives au
                        développement et
                        plans, stratégies marketing, finances, opérations, systèmes, concepts propriétaires,
                        documentation,
                        rapports, données, spécifications, logiciels informatiques, code source, code objet,
                        organigrammes, données,
                        bases de données, inventions, savoir-faire, secrets commerciaux, listes de clients, relations
                        clients, client
                        profils, listes de fournisseurs, relations avec les fournisseurs, profils de fournisseurs,
                        tarification, estimations de ventes, plans d'affaires
                        et les résultats de performance interne relatifs aux activités commerciales passées, présentes
                        ou futures, techniques
                        informations, conception, processus, procédure, formule ou amélioration, que l'Employeur
                        considère
                        Confidentiel et propriétaire. L'employé reconnaît et accepte que les informations
                        confidentielles et exclusives
                        l'information est une propriété précieuse de l'Employeur, développée sur une longue période et à
                        un coût substantiel.
                        dépense et qu’il mérite d’être protégé. <br><br>

                        <strong>B. Obligations de confidentialité. </strong><br>
                        Sauf autorisation expresse contraire dans le présent Contrat,
                        L'employé ne doit pas divulguer ni utiliser de quelque manière que ce soit, directement ou
                        indirectement, des informations confidentielles et
                        informations exclusives pendant la durée du présent Contrat ou à tout moment par la suite, sauf
                        si
                        requis pour exercer leurs fonctions et responsabilités ou avec le consentement écrit préalable
                        de l’Employeur.<br><br>

                        <strong>C. Droits sur les informations confidentielles et exclusives.</strong><br>
                        Toutes les idées, concepts, produits du travail,
                        informations, documents écrits ou autres informations confidentielles et exclusives divulguées à
                        l'employé par
                        L'Employeur (i) sont et resteront la propriété unique et exclusive de l'Employeur, et (ii) sont
                        divulgués
                        ou autorisés à être acquis par l’Employé uniquement sur la base de l’accord de l’Employé pour
                        les conserver
                        en toute confidentialité et de ne pas les utiliser ou les divulguer à quiconque, sauf dans le
                        cadre des objectifs de l’Employeur.
                        entreprise. Sauf disposition expresse des présentes, le présent Contrat ne confère aucun droit,
                        licence,
                        propriété ou autre intérêt ou titre dans, sur ou sous les informations confidentielles et
                        exclusives à
                        Employé.<br><br>


                        <strong>D. Préjudice irréparable.</strong><br>
                        L'employé reconnaît que l'utilisation ou la divulgation de tout renseignement confidentiel et
                        des informations exclusives d'une manière incompatible avec le présent accord entraîneront un
                        préjudice irréparable
                        pour lequel des dommages et intérêts ne constitueraient pas une réparation adéquate. En
                        conséquence, en plus de toute autre mesure légale
                        recours qui peuvent être disponibles en droit ou en équité, l'Employeur aura droit à des
                        réparations équitables ou
                        mesure d'injonction contre l'utilisation ou la divulgation non autorisée d'informations
                        confidentielles et exclusives.
                        L'employeur aura le droit d'exercer tout autre recours légalement autorisé disponible à la suite
                        d'une telle
                        violation, y compris, mais sans s'y limiter, les dommages, directs et consécutifs. Dans toute
                        action intentée par
                        Employeur en vertu du présent article, l'employeur aura le droit de récupérer ses honoraires et
                        frais d'avocat auprès de
                        Employé.<br><br>


                    </div>
                </div>


                <!--5. Fin de contrat -->
                <div class="slide">
                    <p class="title translate">5. Fin de contrat.</p>
                    <div class="content">
                        Au moment du licenciement ou de fin de contrat, l'employé s'engage à restituer tous les biens
                        de l'employeur, y compris, mais sans s'y limiter, ordinateurs, téléphones
                        portables et tout autre appareil électronique. L'employé doit rembourser à
                        l'employeur tout biens de l'employeur perdus ou endommagés pour un montant
                        égal au prix du marché de ces biens. Les droits et obligations des parties
                        énoncés dans la propriété des produits de travail, la résiliation et divers
                        sont destinés à survivre à la résiliation et survivront résiliation du présent accord.
                    </div>
                </div>

                <!--6. Divers -->
                <div class="slide">
                    <p class="title translate">6. Divers</p>
                    <div class="content">
                        <strong>A. Pouvoir de contracter.</strong><br>
                        L'employé reconnaît et accepte qu'il n'a pas
                        autorité pour conclure des contrats ou des
                        engagements contraignants pour ou au nom de l’Employeur
                        sans avoir obtenu au préalable le consentement
                        écrit préalable de l’Employeur. <br><br>

                        <strong>B. Intégralité de l'accord et modification.. </strong><br>
                        Le présent accord constitue l’intégralité de l’accord entre
                        les Parties et remplace tous les accords antérieurs des Parties.
                        Aucun supplément, modification ou La modification du présent accord
                        sera contraignante à moins qu'elle ne soit exécutée par écrit
                        par les deux parties.<br><br>

                        <strong>C. Droits sur les informations confidentielles et exclusives.</strong><br>
                        Toutes les idées, concepts, produits du travail,
                        informations, documents écrits ou autres informations confidentielles et exclusives divulguées à
                        l'employé par
                        L'Employeur (i) sont et resteront la propriété unique et exclusive de l'Employeur, et (ii) sont
                        divulgués
                        ou autorisés à être acquis par l’Employé uniquement sur la base de l’accord de l’Employé pour
                        les conserver
                        en toute confidentialité et de ne pas les utiliser ou les divulguer à quiconque, sauf dans le
                        cadre des objectifs de l’Employeur.
                        entreprise. Sauf disposition expresse des présentes, le présent Contrat ne confère aucun droit,
                        licence,
                        propriété ou autre intérêt ou titre dans, sur ou sous les informations confidentielles et
                        exclusives à
                        Employé.<br><br>


                        <strong>D. Aucune affectation..</strong><br>
                        Les intérêts de l’Employé lui sont personnels et ne peuvent être cédés.<br><br>
                    </div>
                </div>

                <!--7. signature -->
                <div class="slide">
                    <div class="container">
                        <div class="left">
                            <p class="translate">Signature de l'employeur</p>
                            <span>Google</span>
                        </div>

                        <div class="right">
                            <p class="translate">Signature de l'employe</p>
                            <span>Lu et approuvé</span>
                            <span>....................</span>
                        </div>
                    </div>

                    <button onclick="previewContract(this)">Previsualiser</button>

                </div>
            </div>
        </div>

        <!-- preview full offer -->
        <div class="preview_full_offer">

            <div class="scrollable">
                <div class="top">
                    <img src="admin_dashboard_assets/images/google.png" alt="">
                    <span>google</span>
                </div>

                <div class="section">
                    Le présent Contrat de Travail (l'« Accord ») est conclu à compter de ce jour du 04/02/2023 par
                    et
                    entre <strong>Goole</strong> et <strong>Ehouman Ivan</strong> , (chacun, un
                    « Partie » et collectivement, les « Parties ».) Les parties conviennent et s'engagent à être
                    liées
                    par les conditions énoncées
                    dans le présent Accord comme suit :

                </div>

                <!-- 1. Emploi -->
                <div class="section">
                    <p class="title translate">1. Emploi.</p>
                    <div class="content">

                        L'employeur doit employer l'employé en tant que <strong></strong> développeur Web à temps
                        plein dans le cadre
                        du présent accord.
                        L'employé doit effectuer les tâches mentionnées dans l'offre et toutes autres tâches qui
                        sont
                        habituellement effectué par d'autres personnes dans des tâches similaires
                        postes, y compris d'autres tâches qui peuvent survenir de temps à autre et qui peuvent être
                        assignées.
                    </div>
                </div>

                <!-- 2. Période de travail -->
                <div class="section ">
                    <p class="title translate">2. Période de travail</p>
                    <div class="content">
                        L’emploi de l’employé en vertu
                        du présent accord commencera le <strong class="actualdate">10/04/20</strong>. Et prendra fin
                        le <strong class="actualdate">10/08/20</strong>
                    </div>
                </div>

                <!--3. salaire -->
                <div class="section">
                    <p class="title translate">3. salaire</p>
                    <div class="content">
                        En compensation des services fournis par l'employé en vertu du présent accord, l'employeur
                        paiera à l'employé <strong>25 $</strong> de l'heure. Le
                        le montant sera versé à l’employé. <strong>Une fois par semaine, le premier jour de chaque
                            semaine</strong> .

                    </div>
                </div>

                <!-- 4. Invalidité -->
                <div class="section">
                    <p class="title translate">4. Invalidité</p>
                    <div class="content">
                        Si l'employé ne peut pas accomplir les tâches
                        qui lui sont assignées en raison d'une maladie
                        ou d'une incapacité pendant plus de <strong>3</strong>, l'indemnité due
                        au cours de cette maladie ou capacité sera réduite de <strong>50%</strong>
                        Complet l’indemnisation sera rétablie au retour au travail de l’employé.
                    </div>
                </div>

                <!--5. Non concurrence -->
                <div class="section">
                    <p class="title translate">5. Non concurrence</p>
                    <div class="content actualConcurrence">
                        L'employé accepte et s'engage pendant la durée du présent accord. <br><br>


                    </div>
                </div>

                <!--6. Confidentialité -->
                <div class="section">
                    <p class="title translate">6. Confidentialité</p>
                    <div class="content">
                        <strong>A. Informations confidentielles et exclusives</strong><br>
                        Au cours de son emploi, l'employé sera
                        exposé à des informations confidentielles et exclusives de l’Employeur. Confidentiel et
                        propriétaire
                        information désigne toute donnée ou information qui constitue un élément sensible sur le
                        plan
                        concurrentiel et qui n'est pas
                        généralement connues du public, y compris, mais sans s'y limiter, les informations relatives
                        au
                        développement et
                        plans, stratégies marketing, finances, opérations, systèmes, concepts propriétaires,
                        documentation,
                        rapports, données, spécifications, logiciels informatiques, code source, code objet,
                        organigrammes, données,
                        bases de données, inventions, savoir-faire, secrets commerciaux, listes de clients,
                        relations
                        clients, client
                        profils, listes de fournisseurs, relations avec les fournisseurs, profils de fournisseurs,
                        tarification, estimations de ventes, plans d'affaires
                        et les résultats de performance interne relatifs aux activités commerciales passées,
                        présentes
                        ou futures, techniques
                        informations, conception, processus, procédure, formule ou amélioration, que l'Employeur
                        considère
                        Confidentiel et propriétaire. L'employé reconnaît et accepte que les informations
                        confidentielles et exclusives
                        l'information est une propriété précieuse de l'Employeur, développée sur une longue période
                        et à
                        un coût substantiel.
                        dépense et qu’il mérite d’être protégé. <br><br>

                        <strong>B. Obligations de confidentialité. </strong><br>
                        Sauf autorisation expresse contraire dans le présent Contrat,
                        L'employé ne doit pas divulguer ni utiliser de quelque manière que ce soit, directement ou
                        indirectement, des informations confidentielles et
                        informations exclusives pendant la durée du présent Contrat ou à tout moment par la suite,
                        sauf
                        si
                        requis pour exercer leurs fonctions et responsabilités ou avec le consentement écrit
                        préalable
                        de l’Employeur.<br><br>

                        <strong>C. Droits sur les informations confidentielles et exclusives.</strong><br>
                        Toutes les idées, concepts, produits du travail,
                        informations, documents écrits ou autres informations confidentielles et exclusives
                        divulguées à
                        l'employé par
                        L'Employeur (i) sont et resteront la propriété unique et exclusive de l'Employeur, et (ii)
                        sont
                        divulgués
                        ou autorisés à être acquis par l’Employé uniquement sur la base de l’accord de l’Employé
                        pour
                        les conserver
                        en toute confidentialité et de ne pas les utiliser ou les divulguer à quiconque, sauf dans
                        le
                        cadre des objectifs de l’Employeur.
                        entreprise. Sauf disposition expresse des présentes, le présent Contrat ne confère aucun
                        droit,
                        licence,
                        propriété ou autre intérêt ou titre dans, sur ou sous les informations confidentielles et
                        exclusives à
                        Employé.<br><br>


                        <strong>D. Préjudice irréparable.</strong><br>
                        L'employé reconnaît que l'utilisation ou la divulgation de tout renseignement confidentiel
                        et
                        des informations exclusives d'une manière incompatible avec le présent accord entraîneront
                        un
                        préjudice irréparable
                        pour lequel des dommages et intérêts ne constitueraient pas une réparation adéquate. En
                        conséquence, en plus de toute autre mesure légale
                        recours qui peuvent être disponibles en droit ou en équité, l'Employeur aura droit à des
                        réparations équitables ou
                        mesure d'injonction contre l'utilisation ou la divulgation non autorisée d'informations
                        confidentielles et exclusives.
                        L'employeur aura le droit d'exercer tout autre recours légalement autorisé disponible à la
                        suite
                        d'une telle
                        violation, y compris, mais sans s'y limiter, les dommages, directs et consécutifs. Dans
                        toute
                        action intentée par
                        Employeur en vertu du présent article, l'employeur aura le droit de récupérer ses honoraires
                        et
                        frais d'avocat auprès de
                        Employé.<br><br>


                    </div>
                </div>


                <!--7. Fin de contrat -->
                <div class="section">
                    <p class="title translate">7. Fin de contrat.</p>
                    <div class="content">
                        Au moment du licenciement ou de fin de contrat, l'employé s'engage à restituer tous les
                        biens
                        de l'employeur, y compris, mais sans s'y limiter, ordinateurs, téléphones
                        portables et tout autre appareil électronique. L'employé doit rembourser à
                        l'employeur tout biens de l'employeur perdus ou endommagés pour un montant
                        égal au prix du marché de ces biens. Les droits et obligations des parties
                        énoncés dans la propriété des produits de travail, la résiliation et divers
                        sont destinés à survivre à la résiliation et survivront résiliation du présent accord.
                    </div>
                </div>

                <!--8. Divers -->
                <div class="section">
                    <p class="title translate">8. Divers</p>
                    <div class="content">
                        <strong>A. Pouvoir de contracter.</strong><br>
                        L'employé reconnaît et accepte qu'il n'a pas
                        autorité pour conclure des contrats ou des
                        engagements contraignants pour ou au nom de l’Employeur
                        sans avoir obtenu au préalable le consentement
                        écrit préalable de l’Employeur. <br><br>

                        <strong>B. Intégralité de l'accord et modification.. </strong><br>
                        Le présent accord constitue l’intégralité de l’accord entre
                        les Parties et remplace tous les accords antérieurs des Parties.
                        Aucun supplément, modification ou La modification du présent accord
                        sera contraignante à moins qu'elle ne soit exécutée par écrit
                        par les deux parties.<br><br>

                        <strong>C. Droits sur les informations confidentielles et exclusives.</strong><br>
                        Toutes les idées, concepts, produits du travail,
                        informations, documents écrits ou autres informations confidentielles et exclusives
                        divulguées à
                        l'employé par
                        L'Employeur (i) sont et resteront la propriété unique et exclusive de l'Employeur, et (ii)
                        sont
                        divulgués
                        ou autorisés à être acquis par l’Employé uniquement sur la base de l’accord de l’Employé
                        pour
                        les conserver
                        en toute confidentialité et de ne pas les utiliser ou les divulguer à quiconque, sauf dans
                        le
                        cadre des objectifs de l’Employeur.
                        entreprise. Sauf disposition expresse des présentes, le présent Contrat ne confère aucun
                        droit,
                        licence,
                        propriété ou autre intérêt ou titre dans, sur ou sous les informations confidentielles et
                        exclusives à
                        Employé.<br><br>


                        <strong>D. Aucune affectation..</strong><br>
                        Les intérêts de l’Employé lui sont personnels et ne peuvent être cédés.<br><br>
                    </div>
                </div>

                <!--10. signature -->
                <div class="section">
                    <div class="container">
                        <div class="left">
                            <p class="translate">Signature de l'employeur</p>
                            <span>Google</span>
                        </div>

                        <div class="right">
                            <p class="translate">Signature de l'employe</p>
                            <span>Lu et approuvé</span>
                            <span>....................</span>
                        </div>
                    </div>
                </div>

            </div>
            <div class="bottom">
                <button onclick="returnCreateContract(this)">Retour au modification</button>
                <button onclick="closePreview(this)">envoyer</button>
            </div>
        </div>

        <!-- video_call_interface -->


    </div>



    <!-- Custom js -->
    <script src="https://unpkg.com/akar-icons-fonts"></script>
    <!-- 
    <script src="../main_assets/js/video_call.js"></script> -->
    <script src="admin_dashboard_assets/js/chat.js"></script>
    <script src="https://cdn.socket.io/4.7.5/socket.io.min.js"
        integrity="sha384-2huaZvOR9iDzHqslqwpR87isEmrfxqyWOF7hr7BY6KG0+hVKLoEXMPUJw3ynWuhO"
        crossorigin="anonymous"></script>
    <script src='../main_assets/js/agora-rtm-sdk-1.4.4.js'></script>
    <script src="admin_dashboard_assets/js/chat_video_manage_company.js"></script>
</body>

</html>