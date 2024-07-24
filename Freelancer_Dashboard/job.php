<?php
include("../config.php");
session_start();

$cat_query = mysqli_query($conn, "SELECT * FROM job_category");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="freelancer_dashboard_assets/css/Job.css">
    <link rel="stylesheet" href="freelancer_dashboard_assets/css/navbar.css">

    <style>
        .main_content .left::-webkit-scrollbar {
            width: 5px;
        }

        .main_content .left::-webkit-scrollbar-track {
            background-color: transparent;
        }

        .main_content .left::-webkit-scrollbar-thumb {
            background: var(--main-grey);

            cursor: pointer;
        }
    </style>


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
        <ul class="categories" style="justify-content: space-evenly; gap:1em">
            <?php
            while ($row = mysqli_fetch_assoc($cat_query)) {
            ?>
                <li class="translate" id="<?php echo $row['id'] ?>" onclick="getSubCat(this)"><?php echo $row['label'] ?></li>
            <?php
            }
            ?>
        </ul>



        <!-- main -->
        <div class="main_content" style="height: 920px;">

            <!-- ======LEFT======= -->
            <div class="left" style="overflow-y:scroll;">
                <div class="head">
                    <h3 class="translate">Filtre</h3>
                    <span class="translate" onclick="resetFilter()">Effacer</span>
                </div>

                <!-- features -->
                <div class="feature subcat">
                    <p>Sous categorie</p>

                </div>
                <div class="feature">
                    <p class="translate">Type</p>
                    <div class="box">
                        <div class="check" onclick="toggleCheckbox(this);setFeature(this)"><i class='bx bx-check'></i></div>
                        <span class="translate">temps plein</span>
                    </div>

                    <div class="box">
                        <div class="check" onclick="toggleCheckbox(this);setFeature(this)"><i class='bx bx-check'></i></div>
                        <span class="translate">temps partiel</span>
                    </div>

                    <div class="box">
                        <div class="check" onclick="toggleCheckbox(this);setFeature(this)"><i class='bx bx-check'></i></div>
                        <span class="translate">contrat</span>
                    </div>

                </div>

                <div class="feature">
                    <p class="translate">Experience</p>
                    <div class="box">
                        <div class="check" onclick="toggleCheckbox(this);setFeature(this)"><i class='bx bx-check'></i></div>
                        <span class="translate"> moins 1 ans </label><br>
                    </div>

                    <div class="box">
                        <div class="check" onclick="toggleCheckbox(this);setFeature(this)"><i class='bx bx-check'></i></div>
                        <span class="translate">entre 1 et 5 ans</span>
                    </div>

                    <div class="box">
                        <div class="check" onclick="toggleCheckbox(this);setFeature(this)"><i class='bx bx-check'></i></div>
                        <span class=" translate">plus de 5 ans</span>
                    </div>
                </div>

                <div class="feature">
                    <p class="translate">Salaire</p>
                    <div class="box">
                        <div class="check" onclick="toggleCheckbox(this);setFeature(this)"><i class='bx bx-check'></i></div>
                        <span class="translate"> moins de 1700 $</span>
                    </div>

                    <div class="box">
                        <div class="check" onclick="toggleCheckbox(this);setFeature(this)"><i class='bx bx-check'></i></div>
                        <span class="translate">entre 1700 et 5000 $</span>
                    </div>

                    <div class="box">
                        <div class="check" onclick="toggleCheckbox(this);setFeature(this)"><i class='bx bx-check'></i></div>
                        <span class="translate">entre 5000 et 10000 $</span>
                    </div>

                    <div class="box">
                        <div class="check" onclick="toggleCheckbox(this);setFeature(this)"><i class='bx bx-check'></i></div>
                        <span class="translate">plus de 10000 $</span>
                    </div>
                </div>



                <button class="translate apply" style="margin-top:20%" onclick="applyFilter()">Appliquer</button>


            </div>



            <!-- ====== RIGHT====== -->
            <div class="right">
                <div class="head">
                    <p class="found"> </p>
                    <div class="sort">
                        <p class="translate">rangée par</p>
                        <span class="translate">date de publication</span>
                        <i class="ai-settings-horizontal"></i>
                    </div>

                </div>
                <p class="none">Aucun resultat trouvé</p>
                <div class="job_bloc">



                </div>

                <div class="more" style="width: 100%; left:2%">
                    <i class="ai-arrow-left" onclick="counter(this,'back')"></i>

                    <div class="numbers">
                        <span class="currentPage" style="color: #fe6c4c;">1</span>
                        <span>/</span>
                        <span class="pageNumber"></span>
                    </div>

                    <a onclick="counter(this,'forth')">
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
        var matchElement = document.querySelector(".found");
        var dataList = [];
        var actualData = [];
        var featureList = [];
        var pageNumber;
        var Ncounter = 1;

        function searchName(element) {
            var match = false;
            var found = 0;
            var searchText = element.value;
            const regex = new RegExp(searchText, 'i');

            var free = document.querySelector(".job_bloc");
            var freebloc = document.querySelectorAll(".job_bloc .job");
            var freeNames = free.querySelectorAll(".job .name");

            freebloc.forEach(free => {
                // free.style.opacity = "0";
                free.style.display = "none";
            })

            if (searchText == "") {
                matchElement.innerHTML = '<strong class="translate">Résultats trouvés</strong> (' + dataList.length + ')'
                free.style.opacity = "1";
                freebloc.forEach(free => {
                    // free.style.opacity = "1";
                    free.style.display = "block";
                })

                document.querySelector(".none").style.display = "none";
            } else {
                // allFirstRows.forEach(row => {row.parentElement.parentElement.parentElement.style.opacity = "0"})
                freeNames.forEach((free, index) => {
                    if (regex.test(free.textContent)) {
                        document.querySelector(".none").style.display = "none";
                        // freebloc[index].style.opacity = "1";
                        freebloc[index].style.display = "block";
                        match = true;
                        found++;
                    }
                })

                if (!match) {
                    // free.style.opacity = "0";
                    free.style.display = "none";
                    document.querySelector(".none").style.display = "block";
                } else {
                    matchElement.innerHTML = '<strong class="translate">Résultats trouvés</strong> (' + found + ')'
                }
            }


        }

        //==================== counter
        function counter(element,side) {
            var current = document.querySelector(".currentPage");
         
            if (side == "back") {
                if (Ncounter > 1) {
                    Ncounter--;
                    current.textContent = parseInt(current.textContent)--;
                    displayData(actualData, Ncounter);
                }else{
                    element.style.borderColor="#ffbeb0";
                    element.style.color="#ffbeb0";
                }

            } else {
                if (Ncounter < pageNumber) {
                   
                    Ncounter++;
                    current.textContent = parseInt(current.textContent)++;
                    console.log(Ncounter);
                    displayData(actualData, Ncounter);
                }else{
                    element.style.backgroundColor ="#ffbeb0";
                    element.style.color="#fff";
                }

            }
        }

        window.addEventListener('load', fetchData)

        function fetchData() {
            let xhr = new XMLHttpRequest();

            let filterForm = new FormData();
            filterForm.append("action", "retrieve");
            xhr.open("POST", "freelancer_dashboard_assets/php_checking/get-job-api.php", true);
            xhr.onload = () => {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        let data = xhr.response;
                        dataList = JSON.parse(data);
                        actualData = JSON.parse(data);
                        displayData(dataList, Ncounter);
                        var pageNumber = Math.ceil(dataList.length / 6);
                        document.querySelector(".pageNumber").textContent = pageNumber;

                    }
                }
            }

            xhr.send(filterForm);
        }

        function parseDate(dateString) {
            const parts = dateString.split('/');
            const day = parseInt(parts[0], 10);
            const month = parseInt(parts[1], 10) - 1; // Les mois sont de 0 à 11
            const year = parseInt(parts[2], 10);
            return new Date(year, month, day);
        }

        function displayData(dataArray, start) {
            const jobBloc = document.querySelector(".job_bloc");
            var inner = ``;
            var counter = (start - 1) * 6;
            while (counter < (start * 6)) {
                if (counter == dataArray.length)
                    break;
                inner += ` <div class="job" id="${dataArray[counter].id}" cat="${dataArray[counter].job_category}" sub="${dataArray[counter].job_sub_category}">
                            <!-- up job -->
                            <div class="top">
                                <div class="row first">
                                    <h3 class="name">${dataArray[counter].title}</h3>`;


                if (dataArray[counter].whishlisted) {

                    inner += `<i class="bx bxs-bookmark" onclick="addWhishlist(this)"></i>`;

                } else {

                    inner += `<i class="ai-ribbon" onclick="addWhishlist(this)"></i>`;

                }

                inner += `</div>
                                <div class="row second">`;


                // Récupérer la date d'expiration à partir de row
                const dateToCheck = dataArray[counter].expire_date;
                const parsedDate = new parseDate(dateToCheck);
                const currentDate = new Date();

                if (parsedDate > currentDate) {
                    inner += `<span class="translate match">Disponible jusqu'au  ${dataArray[counter].expire_date}</span>`;
                } else {
                    inner += `<span class="translate match">offre indisponible</span>`
                }
                inner += `
                                    <div class="job_detail">
                                        <span class="translate"> ${dataArray[counter].job_type}</span>
                                        <span class="translate"> ${dataArray[counter].experience}</span>
                                        <span class="translate">Un details</span>
                                    </div>`;



                // Convertir la date à vérifier
                var parsedDate2 = parseDate(dataArray[counter].post_date);

                // Obtenir la date actuelle
                var currentDate2 = new Date();

                // Calculer la différence en millisecondes
                let diffInMs = Math.abs(currentDate2 - parsedDate2);

                // Convertir la différence en jours
                let diffInDays = Math.floor(diffInMs / (1000 * 60 * 60 * 24));

                // $newdate =  daysDifference - 1;
                if (diffInDays == 0) {
                    inner += `<span class="translate delay">Aujourd'hui</span>`;
                } else {
                    inner += `<span class="translate delay">Il y a ${diffInDays} jour(s)</span>`;

                }
                inner += `
                                    <span class="applier translate"><i class='bx bxs-circle'></i>  ${dataArray[counter].applicants} postulants</span>
                                </div>
                            </div>

                            <!-- bottom job -->
                            <div class="bottom">
                                <div class="salary">
                                    <span>${dataArray[counter].salary}  ${dataArray[counter].currency}</span>
                                    <!-- <span>/mois</span> -->
                                </div>
                                <a href="job_details.php?jobId=${dataArray[counter].id}" class="translate"> plus de details</a>
                            </div>
                        </div>`;
                counter++;
            }

            jobBloc.innerHTML = inner;
            var found = document.querySelector(".right .head .found");
            found.innerHTML = ` <strong class="translate">Résultats trouvés</strong> (${dataArray.length})`;
        
            scrollToSection(".categories")
        }

        function setFeature(element) {
            var isChecked = element.classList.contains("checked");
            // console.log(isChecked);
            var sectionName = element.parentElement.parentElement.querySelector("p").textContent;
            // console.log(sectionName);
            var featureLabel = element.nextElementSibling.textContent;
            // console.log(featureLabel);
            if (!isChecked) {
                const index = featureList.indexOf(sectionName + "_" + featureLabel);
                if (index > -1) {
                    featureList.splice(index, 1);
                }
            } else {
                featureList.push(sectionName + "_" + featureLabel)
            }

            console.log("Feature_List :")
            featureList.forEach(item => {
                console.log(item)
            })
        }

        function scrollToSection(sectionId) {
            let section = document.querySelector(sectionId);
            section.scrollIntoView({
                behavior: 'smooth'
            });
        }

        function applyFilter() {

            if (featureList.length > 0) {
                scrollToSection(".categories")
                for (let i = 0; i < featureList.length; i++) {
                    let params = featureList[i].split("_");
                    let paramText;
                    console.log(params[0] + " " + params[1])
                    switch (params[0]) {
                        case "Type":
                            console.log("entered type");
                            console.table(actualData);
                            actualData = actualData.filter(item => item.job_type === params[1]);
                            console.table(actualData);
                            break;

                        case "Experience":
                            console.log("entered exp");
                            paramText = params[1].split(" ");
                            switch (paramText[0]) {
                                case "moins":
                                case "less":
                                    actualData = actualData.filter(item => parseInt(item.experience.split(" ")[0]) < parseInt(paramText[1]));
                                    break;
                                case "entre":
                                case "between":
                                    actualData = actualData.filter(item => {
                                        let experience = parseInt(item.experience.split(" ")[0]);
                                        return experience >= parseInt(paramText[1]) && experience <= parseInt(paramText[3]);
                                    });
                                    break;
                                case "plus":
                                case "more":
                                    actualData = actualData.filter(item => parseInt(item.experience.split(" ")[0]) > parseInt(paramText[2]));
                                    break;
                            }

                            console.table(actualData);
                            break;

                        case "Salaire":
                        case "Salary":
                            console.log("entered salary")
                            paramText = params[1].split(" ");
                            switch (paramText[0]) {
                                case "moins":
                                case "less":
                                    actualData = actualData.filter(item => parseInt(item.salary.split(" ")[0]) < parseInt(paramText[2]));
                                    break;
                                case "entre":
                                case "between":
                                    actualData = actualData.filter(item => {
                                        let salary = parseInt(item.salary.split(" ")[0]);
                                        return salary >= parseInt(paramText[1]) && salary <= parseInt(paramText[3]);
                                    });
                                    break;
                                case "plus":
                                case "more":
                                    actualData = actualData.filter(item => parseInt(item.salary.split(" ")[0]) > parseInt(paramText[2]));
                                    break;
                            }

                            console.table(actualData);
                            break;

                        case "Sous categorie":
                        case "Sub category":
                            console.log("entered sub vat")
                            actualData = actualData.filter(item => item.job_sub_category === params[1]);

                            console.table(actualData);
                            break;
                    }

                    if (actualData.length === 0) {
                        break;
                    }
                }

                if (actualData.length === 0) {
                    let jobBloc = document.querySelector(".job_bloc");
                    jobBloc.style.display = "none";
                    jobBloc.previousElementSibling.style.display = "block";
                } else {
                    displayData(actualData, Ncounter);
                }
            }
        }

        function resetFilter() {

            if (featureList.length > 0) {
                var jobBloc = document.querySelector(".job_bloc");
                jobBloc.innerHTML = '';
                var checkboxes = document.querySelectorAll(".check");

                checkboxes.forEach(checkbox => {
                    if (checkbox.classList.contains("checked")) {
                        checkbox.classList.remove("checked");
                        checkbox.nextElementSibling.style.color = "#19202b";
                        checkbox.nextElementSibling.style.fontWeight = "normal";
                    }
                })

                Ncounter = 1;

                displayData(dataList, Ncounter)


                var noneText = jobBloc.previousElementSibling.style.display = "none";
            }


        }
    </script>
    <script src="freelancer_dashboard_assets/js/Job_browsing.js"></script>
    <!-- <script src="freelancer_dashboard_assets/js/translate.js"></script> -->

</body>


</html>