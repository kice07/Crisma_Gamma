<?php
include("../config.php");
session_start();

$cat_query = mysqli_query($conn, 'SELECT * FROM job_category');
if (isset($_GET['job_id'])) {
    $job_id = $_GET['job_id'];
    $job_query = mysqli_query($conn, "SELECT * FROM jobs WHERE id='$job_id'");
    $job_row = mysqli_fetch_assoc($job_query);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin_dashboard_assets/css/create_jobs.css">
    <link rel="stylesheet" href="admin_dashboard_assets/css/navbar.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css'>

    <link rel="icon" href="admin_dashboard_assets/images/crislogo.png" type="image/png">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <title>CrismaWork | Dashboard | Admin | job_creation</title>

</head>

<body>


    <!-- Navbar -->
    <?php include("navbar.php") ?>
    <div class="banner">
        <h3>Créez une nouvelle offre</h3>
    </div>

    <div class="blured"></div>
    <!-- main -->
    <div class="main_content">
        <p class="error"></p>
        <p class="success"></p>
        <div class="job">
            <div class="left_details">

                <!-- cats-->
                <div class="section">
                    <div class="title_part">
                        <h3 class="translate">Categorie de l'offre</h3>
                        <span class="translate">Definissez la categorie d'offre proposé</span>
                    </div>
                    <div class="job_cat_input">
                        <input type="text" class="job_cat changingValue" placeholder="developement" value="<?php if (isset($_GET['job_id'])) echo $job_row['job_category']; ?>" readonly>
                        <i class="ai-chevron-down" onclick="showPopup(this)"></i>
                    </div>

                    <ul class="job_cat_options">
                        <?php
                        while ($row = mysqli_fetch_assoc($cat_query)) {
                        ?>
                            <li onclick="popupTakenChoice(this)" id="<?php echo $row['id'] ?>"><?php echo $row['label'] ?></li>
                        <?php
                        }

                        ?>
                    </ul>
                </div>

                <!-- sub_cats-->
                <div class="section subs">
                    <div class="title_part">
                        <h3 class="translate">Sous categorie</h3>
                        <span class="translate">Definissez la sous categorie de l'offre</span>
                    </div>
                    <div class="job_sub_cat_input">
                        <input type="text" class="job_sub_cat changingValue" placeholder="..." value="<?php if (isset($_GET['job_id'])) echo $job_row['job_sub_category']; ?>" readonly>
                        <i class="ai-chevron-down" onclick="showPopup(this)"></i>
                    </div>

                    <ul class="job_sub_cat_options">

                    </ul>
                </div>

                <!-- job title-->
                <div class="section">
                    <div class="title_part">
                        <h3 class="translate">Libélé</h3>
                        <span class="translate">Le Libélé doit definir précisement la position à occuper</span>
                    </div>
                    <input type="text" class="job_title" placeholder="ex : software developer" value="<?php if (isset($_GET['job_id'])) echo $job_row['title']; ?>">
                </div>

                <!-- job_description-->
                <div class="section">
                    <div class="title_part">
                        <h3 class="translate">Description</h3>
                        <span class="translate">Decrivez avec précison votre offre</span>
                    </div>

                    <div class="job_description_container">
                        <div class="toolbar">
                            <div class="head">

                                <select onchange="formatDoc('formatBlock', this.value); this.selectedIndex=0;">
                                    <option value="" selected="" hidden="" disabled="">Format</option>
                                    <option value="h1">Heading 1</option>
                                    <option value="h2">Heading 2</option>
                                    <option value="h3">Heading 3</option>
                                    <option value="h4">Heading 4</option>
                                    <option value="h5">Heading 5</option>
                                    <option value="h6">Heading 6</option>
                                    <option value="p">Paragraph</option>
                                </select>
                                <select onchange="formatDoc('fontSize', this.value); this.selectedIndex=0;">
                                    <option value="" selected="" hidden="" disabled="">Font size</option>
                                    <option value="1">Extra small</option>
                                    <option value="2">Small</option>
                                    <option value="3">Regular</option>
                                    <option value="4">Medium</option>
                                    <option value="5">Large</option>
                                    <option value="6">Extra Large</option>
                                    <option value="7">Big</option>
                                </select>
                                <div class="color">
                                    <span>Color</span>
                                    <input type="color" oninput="formatDoc('foreColor', this.value); this.value='#000000';">
                                </div>
                                <div class="color">
                                    <span>Background</span>
                                    <input type="color" oninput="formatDoc('hiliteColor', this.value); this.value='#000000';">
                                </div>
                            </div>
                            <div class="btn-toolbar">
                                <button onclick="formatDoc('undo')"><i class='bx bx-undo'></i></button>
                                <button onclick="formatDoc('redo')"><i class='bx bx-redo'></i></button>
                                <button onclick="formatDoc('bold')"><i class='bx bx-bold'></i></button>
                                <button onclick="formatDoc('underline')"><i class='bx bx-underline'></i></button>
                                <button onclick="formatDoc('italic')"><i class='bx bx-italic'></i></button>
                                <button onclick="formatDoc('justifyLeft')"><i class='bx bx-align-left'></i></button>
                                <button onclick="formatDoc('justifyCenter')"><i class='bx bx-align-middle'></i></button>
                                <button onclick="formatDoc('justifyRight')"><i class='bx bx-align-right'></i></button>
                                <button onclick="formatDoc('justifyFull')"><i class='bx bx-align-justify'></i></button>
                                <button onclick="formatDoc('insertOrderedList')"><i class='bx bx-list-ol'></i></button>
                                <button onclick="formatDoc('insertUnorderedList')"><i class='bx bx-list-ul'></i></button>
                            </div>
                        </div>
                        <div id="content" contenteditable="true" spellcheck="false">
                            <?php if (isset($_GET['job_id'])) echo $job_row['content']; ?>
                        </div>
                    </div>
                </div>

                <!-- skills -->
                <div class="section">
                    <div class="title_part">
                        <h3 class="translate">Compétences</h3>
                        <span class="translate">Donnez les compétences requises pour votre offre</span>
                    </div>
                    <input type="text" class="skills" placeholder="'ex : HTML'  puis appuyer sur la touche entrée" onkeydown="addSkills(this)">

                    <div class="skills_bloc"></div>
                </div>


            </div>

            <div class="right_details">

                <!-- ending_date-->
                <div class="section">

                    <div class="title_part">
                        <h3 class="translate">Fin de l'offre</h3>
                        <span class="translate">Date d'expiration de votre offre</span>
                    </div>
                    <div class="datepicker">
                        <input type="text" class="ending_date" placeholder="dd/mm/yyyy" value="<?php if (isset($_GET['job_id'])) echo $job_row['expire_date']; ?>" readonly>
                        <i class="ai-calendar" onclick="showPopup(this)"></i>
                    </div>

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
                </div>


                <!-- applicants -->
                <div class="section">
                    <div class="title_part">
                        <h3 class="translate">Nombre de potulant</h3>
                        <span class="translate">Definissez le nombre de personnes
                            dont vous avez besoin</span>
                    </div>
                    <input type="text" class="job_applicants" placeholder="ex : 15" value="<?php if (isset($_GET['job_id'])) echo $job_row['applicants']; ?>">
                </div>

                <!-- job_type -->
                <div class="section">
                    <div class="title_part">
                        <h3 class="translate">Type</h3>
                        <span class="translate">Definissez le type d'offre proposé</span>
                    </div>
                    <div class="job_type_input">
                        <input type="text" class="job_type changingValue" placeholder="temps partiel" value="<?php if (isset($_GET['job_id'])) echo $job_row['job_type']; ?>" readonly>
                        <i class="ai-chevron-down" onclick="showPopup(this)"></i>
                    </div>

                    <ul class="job_type_options">
                        <li onclick="popupTakenChoice(this)">temps partiel</li>
                        <li onclick="popupTakenChoice(this)">temps plein</li>
                        <li onclick="popupTakenChoice(this)">contract</li>
                    </ul>
                </div>


                <!-- Experience -->
                <div class="section">
                    <div class="title_part">
                        <h3 class="translate">Année d'experience</h3>
                        <span class="translate">Le Libélé doit definir précisement la position à occuper</span>
                    </div>
                    <input type="text" class="experience_years" placeholder="ex : 5 ans" value="<?php if (isset($_GET['job_id'])) echo $job_row['experience']; ?>">
                </div>


                <!-- salary -->
                <div class="section">
                    <div class="title_part">
                        <h3 class="translate">Salaire</h3>
                        <span class="translate">La frequence et le montant de rémunération</span>
                    </div>

                    <div class="inputs_part">
                        <div class="frequency">
                            <div class="bloc" onclick="selectBloc(this)">
                                <div class="circle"></div>
                                <i class="ai-clock"></i>
                                <p>Par mois</p>
                            </div>
                            <div class="bloc" onclick="selectBloc(this)">
                                <div class="circle"></div>
                                <i class="ai-money"></i>
                                <p>Autre</p>
                            </div>
                        </div>
                        <div class="AmoutnFrequency">
                            <div class="amount">
                                <div class="currency">
                                    <span class="changingValue"><?php if (isset($_GET['job_id'])) echo $job_row['currency']; ?></span>
                                    <i class="ai-chevron-down" onclick="showPopup(this)"></i>
                                </div>
                                <input type="text" class="salary" value="<?php if (isset($_GET['job_id'])) echo $job_row['salary']; ?>">

                                <ul class="currency_options">
                                    <li onclick="popupTakenChoice(this)">Euro</li>
                                    <li onclick="popupTakenChoice(this)">USD</li>
                                    <li onclick="popupTakenChoice(this)">CAD</li>
                                </ul>

                            </div>
                            <div class="rfrequency">
                                <div class="rcurrency">
                                    <input type="text" class="frequency_value changingValue" placeholder="heure" value="<?php if (isset($_GET['job_id']) && $job_row['frequence'] !== "Par mois") echo $job_row['frequence']; ?>">
                                    <i class="ai-chevron-down" onclick="showPopup(this)"></i>
                                </div>

                                <ul class="frequency_options">
                                    <li class="translate" onclick="popupTakenChoice(this)">heure</li>
                                    <li class="translate" onclick="popupTakenChoice(this)">jour</li>
                                    <li class="translate" onclick="popupTakenChoice(this)">semaine</li>
                                    <li class="translate" onclick="popupTakenChoice(this)">Contract</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
        <?php
        if (isset($_GET['job_id'])) {
        ?>
            <button class="translate confirm" onclick="sendForm()">Actualiser</button>
        <?php
        }
        ?>


    </div>



    <!-- Custom js -->
    <script src="https://unpkg.com/akar-icons-fonts"></script>

    <!-- //upate_section -->
    <script>
        var skillList = []
        // isediting = false;
        
        var job_id = " <?php echo $_GET['job_id'] ?> ";
        if (job_id !== "") {

            var frequency = "<?php echo $job_row['frequence'] ?>";
            if (frequency == 'Par mois') {
                document.querySelector('.frequency .bloc:first-child').style.transition = "all .3s ease-in-out";
                document.querySelector('.frequency .bloc:first-child').classList.toggle("selected");
                document.querySelector(".AmoutnFrequency .amount").style.opacity = "1";
                document.querySelector(".AmoutnFrequency .rfrequency").style.opacity = "0";
            }else{
                document.querySelector('.frequency .bloc:last-child').style.transition = "all .3s ease-in-out";
                document.querySelector('.frequency .bloc:last-child').classList.toggle("selected");
                document.querySelector(".AmoutnFrequency .amount").style.opacity = "1";
                document.querySelector(".AmoutnFrequency .rfrequency").style.opacity = "1";
            }
                

            //display skill  
            var skills = "<?php echo $job_row['skills'] ?>";
            var skill_tab = skills.split(";")
            skill_tab.forEach(skill => {
                skillList.push(skill);
                var skillsBloc = document.querySelector(".skills_bloc");
                var newSkillItem = document.createElement('span');
                newSkillItem.textContent = skill;
                skillsBloc.appendChild(newSkillItem);
            })



        }
    </script>

    <!-- main script -->
    <script>
        //INPUTS 
        var error = document.querySelector(".error");
        var success = document.querySelector(".success");
        var job_cat = document.querySelector(".job_cat");
        var job_sub_cat = document.querySelector(".job_sub_cat");
        var jobTitle = document.querySelector(".job_title");
        var jobDescription = document.getElementById("content");

        var endingDate = (job_id=="")?"":"<?php echo $job_row['expire_date']?>";
        var applicants = document.querySelector(".job_applicants");
        var jobType = (job_id=="")?"":"<?php echo $job_row['job_type']?>";
        var experienceYears = document.querySelector(".experience_years");
        var frequency = (job_id=="")?"":"<?php echo $job_row['frequence']?>";
        var currency = (job_id=="")?"Euro":"<?php echo $job_row['currency']?>";
        var salary = document.querySelector(".salary");


        function loadSubCat(element) {
            let xhr = new XMLHttpRequest();
            let loadSub = new FormData();
            loadSub.append('action', "loadSub");
            loadSub.append('cat_id', element);
            xhr.open("POST", "admin_dashboard_assets/php_checking/save_job.php", true);
            xhr.onload = () => {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        let data = xhr.response;
                        // console.log(data);
                        document.querySelector(".job_sub_cat_options").innerHTML = '';
                        var inner = "";
                        var dataArray = (data.split("/"));
                        for (var i = 0; i < dataArray.length - 1; i++)
                            inner += `<li onclick="popupTakenChoice(this)">` + dataArray[i] + `</li>`;

                        document.querySelector(".job_sub_cat_options").innerHTML = inner;
                    }
                }
            }
            xhr.send(loadSub);
        }

        function checkvalue(a) {
            return (a == "") ? false : true;
        }

        function formatDoc(cmd, value = null) {
            if (value) {
                document.execCommand(cmd, false, value);
            } else {
                document.execCommand(cmd);
            }
        }

        function addLink() {
            const url = prompt('Insert url');
            formatDoc('createLink', url);
        }



        const content = document.getElementById('content');

        content.addEventListener('mouseenter', function() {
            const a = content.querySelectorAll('a');
            a.forEach(item => {
                item.addEventListener('mouseenter', function() {
                    content.setAttribute('contenteditable', false);
                    item.target = '_blank';
                })
                item.addEventListener('mouseleave', function() {
                    content.setAttribute('contenteditable', true);
                })
            })
        })

        // calendar
        // ================================ Calendar
        let date = new Date();
        let year = date.getFullYear();
        let month = date.getMonth();

        const day = document.querySelector(".calendar-dates");
        var weeksDay;

        const currdate = document.querySelector(".calendar-current-date");

        const prenexIcons = document.querySelectorAll(".calendar-navigation span");

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

            const dates = day.querySelectorAll("li");
            dates.forEach(date => {
                date.addEventListener("click", () => {

                    const dayClicked = date.textContent;
                    var calendar = document.querySelector(".calendar-container");
                    var input = document.querySelector(".datepicker .ending_date");

                    input.value = `${dayClicked} / ${month} / ${year}`;
                    endingDate = `${dayClicked} / ${month} / ${year}`;
                    // input.value = `${dayClicked} / ${months[month]} / ${year}`;
                    calendar.style.display = "none";

                });
            });


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



        //====changement de style lors de la selection d'une fréquence de paiement
        function selectBloc(element) {
            var blocs = document.querySelectorAll(".bloc");
            blocs.forEach(bloc => {
                bloc.classList.remove("selected")
            });
            element.style.transition = "all .3s ease-in-out";
            element.classList.toggle("selected");
            frequency = element.lastElementChild.textContent;

            if (element.lastElementChild.textContent == "Autre") {
                document.querySelector(".AmoutnFrequency .amount").style.opacity = "1";
                document.querySelector(".AmoutnFrequency .rfrequency").style.opacity = "1";
            } else {

                document.querySelector(".AmoutnFrequency .amount").style.opacity = "1";
                document.querySelector(".AmoutnFrequency .rfrequency").style.opacity = "0";
            }

        }

        // ======= Ajouter les competences requises
        function addSkills(inputElement) {
            inputElement.addEventListener('keydown', function(event) {
                if (event.key === 'Enter') {
                    // Empêcher la soumission du formulaire si l'input est dans un formulaire
                    event.preventDefault();

                    // Récupérer la valeur de l'input
                    var skill = inputElement.value.trim();


                    // Vérifier si l'input n'est pas vide
                    if (skill !== '') {
                        skillList.push(skill);
                        // Ajouter la compétence à la liste
                        var skillsList = document.querySelector(".skills_bloc");
                        var newSkillItem = document.createElement('span');
                        newSkillItem.textContent = skill;
                        skillsList.appendChild(newSkillItem);

                        // Vider l'input après ajout
                        inputElement.value = '';
                    }
                }
            });
        }

        //==== Affichage des popups quand les elements i sont cliqué
        function showPopup(element) {
            var popup = element.parentElement.parentElement.lastElementChild;
            (popup.style.display == "block") ?
            popup.style.display = "none":
                popup.style.display = "block";

        }

        // ===== changer le text present par celui selectioné dans la liste non ordonné
        function popupTakenChoice(element) {
            var value = element.textContent;
            var displayer = element.parentElement.parentElement.querySelector(".changingValue");
            if (displayer.tagName.toLowerCase() === 'input') {
                displayer.value = value;
                element.parentElement.style.display = "none";

                if (displayer.classList.contains("job_type")) {
                    jobType = value;
                } else if (displayer.classList.contains("job_cat")) {
                    loadSubCat(element.getAttribute('id'));
                } else if (displayer.classList.contains("frequency_value")) {
                    frequency = value;

                }
            } else {
                displayer.textContent = value;
                currency = value;
                element.parentElement.style.display = "none";
            }
        }

        // ============== sendMessage
        function sendData() {
            if (job_id) {
                skillList.push(job_id);
            }

            // console.log('cat :'+ job_cat.value);
            // console.log('sub_cat :'+ job_sub_cat.value);
            // console.log('title :'+ jobTitle.value);
            // console.log('description :'+ jobDescription.innerHTML);
            // console.log('skill_tab :'+ JSON.stringify(skillList));
            // console.log('ending_date :'+ endingDate);
            // console.log('applicants :'+ applicants.value);
            // console.log('type :'+ jobType);
            // console.log('experience :'+ experienceYears.value);
            // console.log('frequency :'+ frequency);
            // console.log('currency :'+ currency);
            // console.log('amount :' + salary.value);

            let xhr = new XMLHttpRequest();
            let jobForm = new FormData();
            jobForm.append('action', (job_id == "") ? 'insertJob' : 'unpdateJob');
            jobForm.append('cat', job_cat.value);
            jobForm.append('sub_cat', job_sub_cat.value);
            jobForm.append('title', jobTitle.value);
            jobForm.append('description', jobDescription.innerHTML);
            jobForm.append('skill_tab', JSON.stringify(skillList));
            jobForm.append('ending_date', endingDate);
            jobForm.append('applicants', applicants.value);
            jobForm.append('type', jobType);
            jobForm.append('experience', experienceYears.value);
            jobForm.append('frequency', frequency);
            jobForm.append('currency', currency);
            jobForm.append('amount', salary.value);
            xhr.open("POST", "admin_dashboard_assets/php_checking/save_job.php", true);
            xhr.onload = () => {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        let data = xhr.response;
                        if (data == "success") {
                            window.scrollTo({
                                top: 0,
                                behavior: 'smooth'
                            });

                            success.style.display = "block";
                            success.textContent = (job_id == "") ? "offre créee avec success" :
                                "offre acualisée avec success";
                        } else {
                            console.log(data);
                        }

                    }
                }
            }
            xhr.send(jobForm);
        }

        function sendForm() {
            if (checkvalue(job_cat.value)) {

                if (checkvalue(job_cat.value)) {

                    if (checkvalue(jobTitle.value)) {
                        if (checkvalue(jobDescription.innerHTML) && jobDescription.innerHTML !== "...") {
                            if (skillList.length != 0) {
                                if (checkvalue(endingDate)) {
                                    if (checkvalue(applicants.value)) {
                                        if (checkvalue(jobType)) {
                                            if (checkvalue(experienceYears)) {
                                                if (checkvalue(frequency)) {

                                                    if (frequency !== "Autre") {

                                                        if (checkvalue(salary)) {

                                                            sendData();

                                                        } else {
                                                            window.scrollTo({
                                                                top: 0,
                                                                behavior: 'smooth'
                                                            });
                                                            error.style.display = "block";
                                                            error.textContent = "veuillez entrer le montant du salaire"
                                                        }

                                                    } else {

                                                        window.scrollTo({
                                                            top: 0,
                                                            behavior: 'smooth'
                                                        });
                                                        error.style.display = "block";
                                                        error.textContent = "veuillez choisir la fréquence de paiement"
                                                    }
                                                } else {
                                                    window.scrollTo({
                                                        top: 0,
                                                        behavior: 'smooth'
                                                    });
                                                    error.style.display = "block";
                                                    error.textContent = "veuillez rajouter une frequence de paiement"
                                                }

                                            } else {
                                                window.scrollTo({
                                                    top: 0,
                                                    behavior: 'smooth'
                                                });
                                                error.style.display = "block";
                                                error.textContent = "veuillez rajouter le nombre d'année requise"
                                            }

                                        } else {
                                            window.scrollTo({
                                                top: 0,
                                                behavior: 'smooth'
                                            });
                                            error.style.display = "block";
                                            error.textContent = "veuillez rajouter un type à votre offre"
                                        }

                                    } else {
                                        window.scrollTo({
                                            top: 0,
                                            behavior: 'smooth'
                                        });
                                        error.style.display = "block";
                                        error.textContent = "veuillez rajouter un nombre limite de postulants"
                                    }

                                } else {
                                    window.scrollTo({
                                        top: 0,
                                        behavior: 'smooth'
                                    });
                                    error.style.display = "block";
                                    error.textContent = "veuillez rajouter une date de fin de visibilité de votre offre"
                                }
                            } else {
                                window.scrollTo({
                                    top: 0,
                                    behavior: 'smooth'
                                });
                                error.style.display = "block";
                                error.textContent = "veuillez rajouter les skills nécéssaire"
                            }

                        } else {

                            window.scrollTo({
                                top: 0,
                                behavior: 'smooth'
                            });
                            error.style.display = "block";
                            error.textContent = "veuillez rajouter une description"
                        }

                    } else {
                        window.scrollTo({
                            top: 0,
                            behavior: 'smooth'
                        });
                        error.style.display = "block";
                        error.textContent = "veuillez donner un titre au poste"
                    }

                } else {
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                    error.style.display = "block";
                    error.textContent = "veuillez choisir une sous categorie"
                }
            } else {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
                error.style.display = "block";
                error.textContent = "veuillez choisir une categorie"
            }

        }
    </script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- <script src="admin_dashboard_assets/js/translate.js"></script> -->

</body>

</html>