
// ========= job_title=======
var inputJobTitle = document.querySelector(".job_title");
inputJobTitle.addEventListener("input", () => {
    document.querySelector(".cv_file .top .position").textContent = inputJobTitle.value;
})
//======================bio counter =========================

var container = document.querySelector(".textarea_field .checker .limit");
var bio = document.querySelector(".textarea_field textarea");
var wordCount = document.querySelector(".checker .limit .counter");
var emoji = document.querySelector(".checker .limit i");

var previewBio = document.querySelector(".preview_about p:nth-child(2)")
// Écouter l'événement de saisie dans le textarea
bio.addEventListener('input', function () {
    previewBio.textContent = bio.value;
    // Séparer le contenu du textarea par les espaces pour compter les mots
    const words = this.value.split(/\s+/);
    // Compter le nombre de mots
    const numWords = words.length;
    // Afficher le nombre de mots
    wordCount.textContent = numWords;

    // Vérifier si 200 mots sont atteints
    if (numWords > 200) {
        var monEmoji = document.createElement("i");
        monEmoji.classList.add("em");
        monEmoji.classList.add("em-disappointed");
        container.removeChild(container.lastElementChild);
        container.appendChild(monEmoji);
    } else {
        var monEmoji = document.createElement("i");
        monEmoji.classList.add("em");
        monEmoji.classList.add("em-slightly_smiling_face");
        container.removeChild(container.lastElementChild);
        container.appendChild(monEmoji)
    }
});

bio.addEventListener("click", function () {
    this.selectionStart = 0; // Déplace le curseur au début de la première ligne
    this.selectionEnd = 0;
});

// ========================Exp and Edu ==========================


//***** slow Motion

var experiences_list = [];
var educations_list = [];



// add cat
var addButton = document.querySelectorAll(".add");
var ActualExperiences;
var indexE = 0;

var indexS = 0;
var container;


function AddPreview(container, side, index) {
    var Actual_bloc = container.lastElementChild;
    if (side == "experience") {
        var inside = ` <div class="exp" rank="` + index + `">
                        <div class="head">
                           <div class="titles">
                                <span></span>
                                <span></span>
                           </div>
                            <div class="dates">
                                <span></span>
                                <span></span>
                            </div>
                        </div>
                        <p class="description"></p>
                   </div>`;
        Actual_bloc.innerHTML += inside;
    } else if (side == "school") {
        var inside = `<div class="sch" rank="` + index + `">
                    <div class="titles">
                        <span></span>
                        <span></span>
                    </div>
                    <div class="dates">
                        <span></span>
                        <span></span>
                    </div>
        
                  </div>`;
        Actual_bloc.innerHTML += inside;
    } else if (side == "skill") {
        var inside = ` <div rank="` + index + `">
                            <span></span>
                            <span></span>
                        </div>`;
        Actual_bloc.innerHTML += inside;
    } else {
        var inside = ` <div rank="` + index + `">
                            <span></span>
                            <span></span>
                        </div>`;
        Actual_bloc.innerHTML += inside;
    }

}

function createPreviewBloc(container, side, index) {
    if (side == "experience") {
        // container.firstElementChild
        var exp_bloc = document.createElement("div");
        exp_bloc.classList.add("exp_bloc")
        container.appendChild(exp_bloc)
        AddPreview(container, side, index)
    } else if (side == "school") {
        var sch_bloc = document.createElement("div");
        sch_bloc.classList.add("sch_bloc")
        container.appendChild(sch_bloc)
        AddPreview(container, side, index)
    } else if (side == "skill") {
        var skl_bloc = document.createElement("div");
        skl_bloc.classList.add("skill_bloc");
        container.appendChild(skl_bloc);
        AddPreview(container, side, index)
    } else {
        var lang_bloc = document.createElement("div");
        lang_bloc.classList.add("lang_bloc");
        container.appendChild(lang_bloc);
        AddPreview(container, side, index)
    }
}
function createObject(part, index) {
    if (part == "employment_history") {
        var object = {
            rank: index,
            side: "experience",
            position: "",
            company: "",
            startingDate: "",
            endingDate: "",
            ville: "",
            description: "",
        };

        return object;
    } else {
        var object = {
            rank: index,
            side: "education",
            school: "",
            degree: "",
            startingDate: "",
            endingDate: "",
            ville: "",
            description: "",
        };

        return object;
    }

}

function createExperience(container, expContainer, index) {
    expInner = `    <div class="input" rank="` + index + `">
                        <div class="head">
                            <p class="employment_title" rank="`+ index + `">( indefini )</p>
                            <span><i class='bx bx-chevron-down'></i></span>
                        </div>

                        <div class="bottom">
                        
                            <div class="field">
                                <div class="left">
                                    <span class="label">Titre du poste</span><br>
                                    <input type="text" name="experience_job_title" 
                                      class="experience_job_title" rank="`+ index + `"
                                        placeholder="ex: Web Designer">

                                </div>
                            
                                <div class="right">
                                    <span class="label">Employeur</span><br>
                                    <input type="text" rank="`+ index + `" name="experience_job_company"
                                    class="experience_job_company"  placeholder="ex: Google">
                                </div>

                            </div>

                            <div class="field">
                                <div class="left">
                                    
                                    <div class="date">
                                        
                                        <div class="start">
                                            <span class="label">Date de début</span>
                                            <input type="text" rank="`+ index + `" name="starting_exp_date"
                                            class="inputDateExp startDate" placeholder="ex: MM/YYYY"readonly >
                                            
                                        </div>

                                        <div class="ending">
                                            <span class="label">Date de fin</span>
                                            <input type="text" rank="`+ index + `" name="ending_exp_date" 
                                                placeholder="ex: MM/YYYY" class="inputDateExp endDate" readonly>
                                        </div>
                                
                                    </div>

                                    <div class="calendar">
                                        <div class="head">
                                            <span><i class='bx bx-chevron-left'></i></span>
                                            <p class="year">2024</p>
                                            <span><i class='bx bx-chevron-right'></i></span>
                                        </div>
                                        <div class="bottom">
                                            <p>Janv</p>
                                            <p>Fev</p>
                                            <p>Mar</p>
                                            <p>Avr</p>
                                            <p>Mai</p>
                                            <p>Jui</p>
                                            <p>Jul</p>
                                            <p>Août</p>
                                            <p>Sep</p>
                                            <p>Oct</p>
                                            <p>Nov</p>
                                            <p>Dec</p>
                                        </div>
                                    </div>

                                </div>
                                
                                <div class="right">
                                    <span class="label">ville</span><br>
                                    <input type="text" rank="`+ index + `" name="experience_job_city"
                                     class="experience_job_city" placeholder="ex: Web Designer">
                                </div>
                                
                            </div>

                            <span>Description</span>
                            <textarea id="story" rank="`+ index + `"  class="experience_description" name="story" rows="13" cols="70" >

                            </textarea><br>

                            <span class="tips">Conseil: écrivez 50 à 200 caractères pour augmenter
                            les chances d'entretien.</span><br><br>

                        </div>

                    </div>
                    <i class='bx bx-trash'></i>`;

    expContainer.innerHTML = expInner;

    const dernierEnfant = container.lastElementChild;

    container.insertBefore(expContainer, dernierEnfant);


    // var trigger = expContainer.querySelector(".input .head span .bx");
    // var box = expContainer.querySelector(".input .bottom");
    // console.log(trigger + " " + box)

    // triggers.push(trigger)
    // boxs.push(box)

}

function createEducation(container, schoolContainer, index) {
    schoolInner = `    <div class="input" rank="` + index + `">
                        <div class="head">
                            <p class="school_name_title" rank="`+ index + `">( indefini )</p>
                            <span><i class='bx bx-chevron-down'></i></span>
                        </div>

                        <div class="bottom">
                        
                            <div class="field">
                                <div class="left">
                                    <span class="label">Nom de l'école</span><br>
                                    <input type="text" name="school_name" 
                                      class="school_name" rank="` + index + `"
                                        placeholder="ex: Université de Calgary">

                                </div>
                            
                                <div class="right">
                                    <span class="label">Diplome</span><br>
                                    <input type="text" name="school_degree" rank="` + index + `"
                                    class="school_degree" placeholder="ex: Bachelor">
                                </div>

                            </div>

                            <div class="field">
                                <div class="left">
                                    
                                    <div class="date">
                                        
                                        <div class="start">
                                            <span class="label">Date de début</span>
                                            <input type="text" name="starting_degree_date" rank="` + index + `"
                                            class="inputDateSch startDate" placeholder="ex: MM/YYYY" readonly>
                                            
                                        </div>

                                        <div class="ending">
                                            <span class="label">Date de fin</span>
                                            <input type="text" name="ending_degree_date" rank="` + index + `"
                                                placeholder="ex: MM/YYYY" class="inputDateSch endDate" readonly>
                                        </div>
                                        
                                    </div>

                                    <div class="calendar">
                                        <div class="head">
                                            <span><i class='bx bx-chevron-left'></i></span>
                                            <p class="year">2024</p>
                                            <span><i class='bx bx-chevron-right'></i></span>
                                        </div>
                                        <div class="bottom">
                                            <p>Janv</p>
                                            <p>Fev</p>
                                            <p>Mar</p>
                                            <p>Avr</p>
                                            <p>Mai</p>
                                            <p>Jui</p>
                                            <p>Jul</p>
                                            <p>Août</p>
                                            <p>Sep</p>
                                            <p>Oct</p>
                                            <p>Nov</p>
                                            <p>Dec</p>
                                        </div>
                                    </div>

                                </div>
                                
                                <div class="right">
                                    <span class="label">ville</span><br>
                                    <input type="text" name="school_city" rank="` + index + `"
                                     class="school_city" placeholder="ex: Calgary">
                                </div>
                                
                            </div>

                            <span>Description</span>
                            <textarea id="story" rank="` + index + `" class="school_description" name="story"  rows="13" cols="70"  >

                            </textarea><br>

                            <span class="tips">Conseil: écrivez 50 à 200 caractères pour augmenter
                            les chances d'entretien.</span><br><br>

                        </div>

                    </div>
                    <i class='bx bx-trash'></i>`;

    schoolContainer.innerHTML = schoolInner;

    const dernierEnfant = container.lastElementChild;

    container.insertBefore(schoolContainer, dernierEnfant);


    // var trigger = schoolContainer.querySelector(".input .head span .bx");
    // var box = schoolContainer.querySelector(".input .bottom");

    // triggers.push(trigger)
    // boxs.push(box)
}

addButton.forEach(button => {
    button.addEventListener("click", () => {


        // create the box
        var objContainer = document.createElement("div");
        objContainer.classList.add("input_field");

        if (button.parentElement.className == "employment_history") {
            object = createObject("employment_history", indexE)
            createExperience(button.parentElement, objContainer, indexE);
            experiences_list.push(object);

            objContainer.setAttribute("position", indexE);


            if (indexE == 0) {
                // Apparition progressive du titre de la section
                document.querySelector(".preview_experience .title").style.opacity = "1";
                document.querySelector(".preview_experience .title").style.transition = "opacity .3s ease-in-out"

                //creation effective du bloc dans le DOM HTML
                var Previewcontainer = document.querySelector(".preview_experience");
                createPreviewBloc(Previewcontainer, "experience", indexE);
            } else {
                AddPreview(document.querySelector(".preview_experience"), "experience", indexE)
            }

            indexE++;
        } else {
            object = createObject("education_history", indexS)
            createEducation(button.parentElement, objContainer, indexS);
            educations_list.push(object);
            objContainer.setAttribute("position", indexS);


            if (indexS == 0) {
                // Apparition progressive du titre de la section
                document.querySelector(".preview_school .title").style.opacity = "1";
                document.querySelector(".preview_school .title").style.transition = "opacity .3s ease-in-out"

                //creation effective du bloc dans le DOM HTML
                var PreviewContainer = document.querySelector(".preview_school");
                createPreviewBloc(PreviewContainer, "school", indexS);
            } else {
                AddPreview(document.querySelector(".preview_school"), "school", indexS)
            }

            indexS++;
        }


        //shrink action
        var trigger = objContainer.querySelector(".input .head span .bx");
        var box = objContainer.querySelector(".input .bottom");
        var isClicked = false;
        trigger.addEventListener("click", () => {
            // console.log(trigger);
            if (!isClicked) {
                box.style.height = "536px";
                box.style.opacity = "1";
                box.style.transition = " height .3s ease-in-out";
                isClicked = true;

            } else {
                box.style.height = "0";
                box.style.opacity = "0";
                box.style.transition = " height .3s ease-in-out";
                isClicked = false;
            }

        });


        //Gestion des inputs


        // preview_

        if (button.parentElement.className == "employment_history") {
            var Titles = document.querySelectorAll(".employment_title");

            ActualExperiences = document.querySelectorAll(".exp_bloc .exp");
            var experience_job_titles = document.querySelectorAll(".experience_job_title");


            experience_job_titles.forEach(job_title => {

                job_title.addEventListener("input", () => {
                    var rank = parseInt(job_title.getAttribute("rank"));

                    for (var i = 0; i < experiences_list.length; i++) {
                        //update experience object
                        if (experiences_list[i].rank == rank) {
                            experiences_list[i].position = job_title.value;
                        }

                        //update form_input preview 
                        if (Titles[i].getAttribute("rank") == rank) {
                            Titles[i].textContent = job_title.value;
                        }

                        //display and update form_actual_preview 
                        if (ActualExperiences[i].getAttribute("rank") == rank) {
                            (ActualExperiences[i].querySelector(".titles span:nth-child(1)")).textContent = job_title.value;
                        }
                    }

                })
            })

            var experience_job_companies = document.querySelectorAll(".experience_job_company");
            experience_job_companies.forEach((job_company) => {
                job_company.addEventListener("input", () => {
                    var rank = parseInt(job_company.getAttribute("rank"));

                    for (var i = 0; i < experiences_list.length; i++) {
                        //update experience object
                        if (experiences_list[i].rank == rank) {
                            experiences_list[i].company = job_company.value;

                        }

                        //display and update form_actual_preview 
                        if (ActualExperiences[i].getAttribute("rank") == rank) {
                            ActualExperiences[i].querySelector(".titles span:nth-child(2)").textContent = "(" + job_company.value + ")";
                        }
                    }
                })
            })


            var experience_job_cities = document.querySelectorAll(".experience_job_city");
            experience_job_cities.forEach((job_city, index) => {
                job_city.addEventListener("input", () => {
                    experiences_list[index].ville = job_city.value;
                })
            })

            var experience_descriptions = document.querySelectorAll(".experience_description");
            experience_descriptions.forEach((experience_description) => {
                experience_description.addEventListener("input", () => {
                    var rank = parseInt(experience_description.getAttribute("rank"));

                    for (var i = 0; i < experiences_list.length; i++) {
                        //update experience object
                        if (experiences_list[i].rank == rank) {
                            experiences_list[i].description = experience_description.value;

                        }

                        //display and update form_actual_preview 
                        if (ActualExperiences[i].getAttribute("rank") == rank) {
                            ActualExperiences[i].querySelector(".description").textContent = experience_description.value;
                        }
                    }

                })
            })

            // style textarea
            experience_descriptions.forEach(textarea => {
                textarea.addEventListener("click", function () {
                    textarea.focus(); // Assure que le focus est sur le textarea
                    textarea.setSelectionRange(0, 0);
                });


            })


        } else {

            var Titles = document.querySelectorAll(".school_name_title");

            var everySchool = document.querySelectorAll(".sch_bloc .sch");
            var school_names = document.querySelectorAll(".school_name");

            school_names.forEach((school_name) => {
                school_name.addEventListener("input", () => {
                    var rank = parseInt(school_name.getAttribute("rank"));

                    for (var i = 0; i < educations_list.length; i++) {
                        //update school object
                        if (educations_list[i].rank == rank) {
                            educations_list[i].school = school_name.value;
                        }

                        //update form_input preview 
                        if (Titles[i].getAttribute("rank") == rank) {
                            Titles[i].textContent = school_name.value;
                        }

                        //display and update form_actual_preview 
                        if (everySchool[i].getAttribute("rank") == rank) {
                            everySchool[i].querySelector(".titles span:nth-child(2)").textContent = "(" + school_name.value + ")";
                        }
                    }

                })
            })

            var school_degrees = document.querySelectorAll(".school_degree");
            school_degrees.forEach((school_degree) => {
                school_degree.addEventListener("input", () => {

                    var rank = parseInt(school_degree.getAttribute("rank"));

                    for (var i = 0; i < educations_list.length; i++) {
                        //update school object
                        if (educations_list[i].rank == rank) {
                            educations_list[i].degree = school_degree.value;
                        }

                        //display and update form_actual_preview 
                        if (everySchool[i].getAttribute("rank") == rank) {
                            everySchool[i].querySelector(".titles span:nth-child(1)").textContent = school_degree.value;
                        }
                    }

                })
            })

            var school_cities = document.querySelectorAll(".school_city");
            school_cities.forEach((school_city, index) => {
                school_city.addEventListener("input", () => {
                    educations_list[index].ville = school_city.value;
                })
            })

            var school_descriptions = document.querySelectorAll(".school_description");
            school_descriptions.forEach((school_description) => {
                school_description.addEventListener("input", () => {

                    var rank = parseInt(school_description.getAttribute("rank"));

                    for (var i = 0; i < educations_list.length; i++) {
                        //update school object
                        if (educations_list[i].rank == rank) {
                            educations_list[i].degree = school_description.value;
                        }

                        //display and update form_actual_preview 
                        if (everySchool[i].getAttribute("rank") == rank) {
                            educations_list[i].description = school_description.value;
                        }
                    }

                })
            })

            school_descriptions.forEach(textarea => {
                textarea.addEventListener("click", function () {
                    textarea.focus(); // Assure que le focus est sur le textarea
                    textarea.setSelectionRange(0, 0);
                });
            })


        }



        // -------------- calendar
        // Sélectionner le conteneur du calendrier et les éléments d'entrée de date
        var calendars = objContainer.querySelector(".calendar");
        var inputDates, everyLilBloc;

        if (button.parentElement.className === "employment_history") {
            inputDates = document.querySelectorAll(".inputDateExp");
            everyLilBloc = document.querySelectorAll(".exp_bloc .exp");
        } else {
            inputDates = document.querySelectorAll(".inputDateSch");
            everyLilBloc = document.querySelectorAll(".sch_bloc .sch");
        }

        var addOrRemove = calendars.querySelectorAll(".head i");
        var year = calendars.querySelector(".head .year");
        var months = calendars.querySelectorAll(".bottom p");

        inputDates.forEach((element, index) => {
            element.addEventListener("click", (event) => {
                event.stopPropagation();

                // Positionner le calendrier
                if ((index % 2) !== 0) {
                    calendars.style.marginLeft = "11.5%";
                } else {
                    calendars.style.marginLeft = "0";
                }
                calendars.style.display = "block";

                // Préserver l'élément actuellement sélectionné
                let currentElement = element;

                // Gestion des clics sur les flèches pour changer l'année
                addOrRemove.forEach((side, rang) => {
                    side.onclick = () => {
                        year.textContent = rang === 0 ? parseInt(year.textContent) - 1 : parseInt(year.textContent) + 1;
                    };
                });


                // Gestion des clics sur les mois
                months.forEach(month => {
                    month.onclick = () => {
                        if (currentElement !== null) {
                            var value = month.textContent + " " + year.textContent;
                            currentElement.value = value;

                            var rank = parseInt(currentElement.getAttribute("rank"));
                            if (button.parentElement.className === "employment_history") {
                                if (currentElement.classList.contains("startDate")) {

                                    experiences_list[rank].startingDate = currentElement.value;
                                    everyLilBloc[rank].querySelector(".dates span:nth-child(1)").textContent = currentElement.value;

                                } else {
                                    experiences_list[rank].endingDate = currentElement.value;
                                    everyLilBloc[rank].querySelector(".dates span:nth-child(2)").textContent = "-" + currentElement.value;
                                }
                            } else {
                                if (currentElement.classList.contains("startDate")) {
                                    educations_list[rank].startingDate = currentElement.value;
                                    everyLilBloc[rank].querySelector(".dates span:nth-child(1)").textContent = currentElement.value;
                                } else {
                                    educations_list[rank].endingDate = currentElement.value;
                                    everyLilBloc[rank].querySelector(".dates span:nth-child(2)").textContent = "-" + currentElement.value;
                                }
                            }
                            currentElement = null;
                            calendars.style.display = "none";
                        }
                    };
                });
            });
        });

        // Masquer le calendrier lorsque l'on clique en dehors
        document.addEventListener("click", (e) => {
            if (!calendars.contains(e.target)) {
                calendars.style.display = "none";
            }
        });


        //Delete container
        var delButton = objContainer.querySelector(".bx-trash");

        //Deplacer  les elements a supprimer en fin de liste et copier le tableau des elements 
        // a conserver avant la requete d'envoi

        delButton.addEventListener("click", () => {
            var bigContainer = objContainer.parentElement;
            var position = parseInt(delButton.previousElementSibling.getAttribute("rank"));
            if (button.parentElement.className == "employment_history") {
                var exp_bloc = document.querySelector(".exp_bloc");
                var exps = exp_bloc.querySelectorAll(".exp");


                experiences_list.forEach((oneExperience, index) => {
                    if (oneExperience.rank == position) {
                        console.log("selected - oneExperience : " + oneExperience.position)
                        experiences_list.splice(index, 1);
                        exp_bloc.removeChild(exps[index]);
                    }
                })

                if (experiences_list.length == 0) {
                    (exp_bloc.parentElement).removeChild(exp_bloc);
                    document.querySelector(".preview_experience .title").style.opacity = "0";
                    document.querySelector(".preview_experience .title").style.transition = "opacity .3s ease-in-out"
                }
                ActualExperiences = document.querySelectorAll(".exp_bloc .exp");
                console.log("end");
                console.table(experiences_list);

            } else {
                var sch_bloc = document.querySelector(".sch_bloc");
                var schs = sch_bloc.querySelectorAll(".sch");

                console.log("Todelete: " + position)
                educations_list.forEach((oneEducation, index) => {
                    if (oneEducation.rank == position) {
                        educations_list.splice(index, 1);
                        sch_bloc.removeChild(schs[index]);
                    }
                })


                if (educations_list.length == 0) {
                    (sch_bloc.parentElement).removeChild(sch_bloc);
                    document.querySelector(".preview_school .title").style.opacity = "0";
                    document.querySelector(".preview_school .title").style.transition = "opacity .3s ease-in-out"
                }

                ActualExperiences = document.querySelectorAll(".sch_bloc .sch");
                console.log("end");
                console.table(educations_list);

            }

            bigContainer.removeChild(objContainer);

        });



    })
})


//========================================== skills et language ===============


//***** slow Motion
var skills = [];
var languages = [];
var mainColor = ["#fe7d8b", "#f68559", "#ec930c", "#48ba75", "#9ba1fb"],
    hoverColor = ["#ffd0d5", "#fdd2c0", "#fddb8c", "#c6e4d2", "#dbdeff"],
    otherColor = ["#ffeaec", "#feebe3", "#fff2cc", "#e7f4ed", "#f1f2ff"],
    skillLevel = ["Novice", "Debutant", "Competent", "Experimenté", "Expert"],
    languageLevel = ["Debutant", "intermédiaire", "Avancé", "Fluent(Oral et écrit)", "Native"];


// add cat
var secondAddButton = document.querySelectorAll(".secondAdd");

var indexK = 0;
var indexL = 0;
var container;

//preview


function secondCreateObject(part, index) {
    if (part == "skills") {
        var object = {
            rank: index,
            side: "skill",
            label: "",
            level: "",
        };

        return object;
    } else {
        var object = {
            rank: index,
            side: "language",
            language: "",
            level: "",
        };

        return object;
    }

}

function createSkill(container, skillContainer, index) {
    skillInner = `   <div class="input" rank="` + index + `">
                        <div class="head">
                            <p class="employment_title">( indefini )</p>
                            <span><i class='bx bx-chevron-down'></i></span>
                        </div>

                        <div class="bottom">

                            <div class="field">
                                <span class="label">Label</span>
                                <input type="text" name="skill_name" class="skill_name">
                            </div>
                            <div class="field">
                                <div>
                                    <span class="label">Level - </span> <span
                                    class="level_title">Debutant</span><br>
                                </div>
                                <div class="levels">
                                    <div class="bloc" onclick="slidingBox(this)"></div>
                                    <div class="bloc" onclick="slidingBox(this)"></div>
                                    <div class="bloc" onclick="slidingBox(this)"></div>
                                    <div class="bloc" onclick="slidingBox(this)"></div>
                                    <div class="bloc" onclick="slidingBox(this)"></div>
                                </div>
                            </div>

                        </div>

                    </div>
                    <i class='bx bx-trash' onclick="deleteBloc(this)"></i>`;

    skillContainer.innerHTML = skillInner;

    const dernierEnfant = container.lastElementChild;

    container.insertBefore(skillContainer, dernierEnfant);


    // var trigger = skillContainer.querySelector(".input .head span .bx");
    // var box = skillContainer.querySelector(".input .bottom");
    // console.log(trigger + " " + box)
    // triggers.push(trigger)
    // boxs.push(box)

}

function createLanguage(container, LangContainer, index) {
    LangInner = `   <div class="input" rank="` + index + `">
                        <div class="head">
                            <p class="employment_title">( indefini )</p>
                            <span><i class='bx bx-chevron-down'></i></span>
                        </div>

                        <div class="bottom">

                            <div class="field">
                                <span class="label">Label</span>
                                <input type="text" name="language_name" class="language_name">
                            </div>
                            <div class="field">
                                <div>
                                    <span class="label">Level - </span> <span
                                    class="level_title">Debutant</span><br>
                                </div>
                                <div class="levels">
                                    <div class="bloc" onclick="slidingBox(this)"></div>
                                    <div class="bloc" onclick="slidingBox(this)"></div>
                                    <div class="bloc" onclick="slidingBox(this)"></div>
                                    <div class="bloc" onclick="slidingBox(this)"></div>
                                    <div class="bloc" onclick="slidingBox(this)"></div>
                                </div>
                            </div>

                        </div>

                    </div>
                    <i class='bx bx-trash' onclick="deleteBloc(this)"></i>`;

    LangContainer.innerHTML = LangInner;

    const dernierEnfant = container.lastElementChild;

    container.insertBefore(LangContainer, dernierEnfant);


    // var trigger = LangContainer.querySelector(".input .head span .bx");
    // var box = LangContainer.querySelector(".input .bottom");
    // console.log(trigger + " " + box)

    // triggers.push(trigger)
    // boxs.push(box)
}

function deleteBloc(element) {

    var bigContainer = element.parentElement.parentElement;
    var objContainer = element.parentElement

    if (objContainer.getAttribute("section") == "skill") {

        var skl_bloc = document.querySelector(".skill_bloc");
        var skls = skl_bloc.querySelectorAll("div");
        console.log(skls.length);
        for (var i = 0; i < skills.length; i++) {
            if (skills[i].rank == objContainer.getAttribute("position")) {

                //delete the object
                skills.splice(i, 1);
                console.log(skls[i].textContent);

                //remove preview
                skl_bloc.removeChild(skls[i]);

                var skls = skl_bloc.querySelectorAll("div");
            }
        }

        indexK--;


        if (skls.length == 0) {
            document.querySelector(".preview_skill .title").style.opacity = "0";
            document.querySelector(".preview_skill .title").style.transition = "opacity .3s ease-in-out";
            document.querySelector(".preview_skill").removeChild(document.querySelector(".preview_skill .skill_bloc"));
        }



    } else {
        var langs_bloc = document.querySelector(".lang_bloc");
        var langs = langs_bloc.querySelectorAll("div");
        for (var i = 0; i < languages.length; i++) {
            if (languages[i].rank == objContainer.getAttribute("position")) {

                //delete the object
                languages.splice(i, 1);

                //remove preview
                langs_bloc.removeChild(langs[i]);

                langs = langs_bloc.querySelectorAll("div");
            }

        }

        indexL--;
        if (langs.length == 0) {
            document.querySelector(".preview_language .title").style.opacity = "0";
            document.querySelector(".preview_language .title").style.transition = "opacity .3s ease-in-out"
            document.querySelector(".preview_language").removeChild(document.querySelector(".preview_language .lang_bloc"));
        }

    }

    bigContainer.removeChild(objContainer);
}

function slidingBox(element) {

    var skills_preview = document.querySelectorAll(".skill_bloc div");
    var langs_preview = document.querySelectorAll(".lang_bloc div");

    // Récupérer la liste des blocs
    var enfants = Array.from(element.parentElement.children);

    var rank = (element.parentElement).getAttribute("rank");

    // Trouver l'index du paragraphe dans la liste des blocs
    var position = enfants.indexOf(element);
    var bigParent = element.parentElement.parentElement.parentElement.parentElement.parentElement;
    var levelLabel = bigParent.querySelector(".level_title");
    var rank = bigParent.getAttribute("position");

    // box
    element.style.backgroundColor = mainColor[position];
    element.addEventListener("mouseenter", () => {
        element.style.backgroundColor = mainColor[position];

    });

    element.addEventListener("mouseleave", () => {
        element.style.backgroundColor = mainColor[position];
    });


    // Label
    var pos = position;
    if (bigParent.getAttribute("section") == "skill") {
        levelLabel.textContent = skillLevel[pos];
        levelLabel.style.color = mainColor[pos];
        skills[rank].level = skillLevel[pos];

        for (var i = 0; i < skills_preview.length; i++) {
            if (skills_preview[i].getAttribute("rank") == rank) {
                skills_preview[i].querySelector("span:nth-child(2)").textContent = "(" + skillLevel[pos] + ")";
            }
        }
    } else {
        levelLabel.textContent = languageLevel[pos];
        levelLabel.style.color = mainColor[pos];
        languages[rank].level = languageLevel[pos];
        for (var i = 0; i < langs_preview.length; i++) {
            if (langs_preview[i].getAttribute("rank") == rank) {
                langs_preview[i].querySelector("span:nth-child(2)").textContent = "(" + languageLevel[pos] + ")";
            }
        }
    }

    enfants.forEach((sub_element, index2) => {

        sub_element.style.borderLeftColor = mainColor[pos];
        sub_element.style.borderRightColor = mainColor[pos];

        if (!(index2 === pos)) {
            sub_element.style.backgroundColor = otherColor[pos];
            sub_element.addEventListener("mouseenter", () => {
                sub_element.style.backgroundColor = hoverColor[pos];

            });

            sub_element.addEventListener("mouseleave", () => {
                sub_element.style.backgroundColor = otherColor[pos];
            });
        }



    })

}

secondAddButton.forEach(button => {
    button.addEventListener("click", () => {
        var object;
        // console.log(object);

        // create the box
        var objContainer = document.createElement("div");
        objContainer.classList.add("input_field");


        if (button.parentElement.className == "skills") {
            object = secondCreateObject("skills", indexK)
            createSkill(button.parentElement, objContainer, indexK);
            skills.push(object);
            objContainer.setAttribute("position", indexK);
            objContainer.setAttribute("section", "skill");


            //preview
            if (indexK == 0) {
                // Apparition progressive du titre de la section
                document.querySelector(".preview_skill .title").style.opacity = "1";
                document.querySelector(".preview_skill .title").style.transition = "opacity .3s ease-in-out"

                //creation effective du bloc dans le DOM HTML
                var Previewcontainer = document.querySelector(".preview_skill");
                createPreviewBloc(Previewcontainer, "skill", indexK);
            } else {
                AddPreview(document.querySelector(".preview_skill"), "skill", indexK)
            }

            indexK++;

        } else {
            object = secondCreateObject("languages", indexL)
            createLanguage(button.parentElement, objContainer, indexL);
            languages.push(object);
            objContainer.setAttribute("position", indexL);
            objContainer.setAttribute("section", "language");


            if (indexL == 0) {
                // Apparition progressive du titre de la section
                document.querySelector(".preview_language .title").style.opacity = "1";
                document.querySelector(".preview_language .title").style.transition = "opacity .3s ease-in-out"

                //creation effective du bloc dans le DOM HTML
                var Previewcontainer = document.querySelector(".preview_language");
                createPreviewBloc(Previewcontainer, "lang", indexL);
            } else {
                AddPreview(document.querySelector(".preview_language"), "lang", indexL)
            }

            indexL++;
        }


        //shrink action
        var trigger = objContainer.querySelector(".input .head span .bx");
        var box = objContainer.querySelector(".input .bottom");
        var isClicked = false;
        trigger.addEventListener("click", () => {
            // console.log(trigger);
            if (!isClicked) {
                box.style.height = "100px";
                box.style.opacity = "1";
                box.style.transition = " height .3s ease-in-out";
                isClicked = true;

            } else {
                box.style.height = "0";
                box.style.opacity = "0";
                box.style.transition = " height .3s ease-in-out";
                isClicked = false;
            }

        });



        //Gestion des inputs
        var title = objContainer.querySelector(".input .head p");
        var skills_preview = document.querySelectorAll(".skill_bloc div");
        var langs_preview = document.querySelectorAll(".lang_bloc div");


        if (button.parentElement.className == "skills") {
            var skills_titles = document.querySelectorAll(".skill_name");

            skills_titles.forEach((skill_title, index) => {
                skill_title.addEventListener("input", () => {
                    skills[index].label = skill_title.value;
                    title.textContent = skill_title.value;

                    //preview
                    skills_preview[index].querySelector("span:nth-child(1)").textContent = skill_title.value;
                })
            })
        } else {
            var languages_titles = document.querySelectorAll(".language_name");
            languages_titles.forEach((language_title, index) => {
                language_title.addEventListener("input", () => {
                    languages[index].language = language_title.value;
                    title.textContent = language_title.value;

                    //preview
                    langs_preview[index].querySelector("span:nth-child(1)").textContent = language_title.value;;
                })
            })


        }

    })
})



// ============== sendForm ================

//    
//   

function isEmpty(objet) {
    for (let key in objet) {
        if (objet.hasOwnProperty(key)) {
            if (objet[key] === "" || objet[key] === null || objet[key] === undefined) {
                return true; // L'attribut est vide
            }
        }
    }
    return false; // Aucun attribut vide trouvé
}

const sendForm = document.querySelector(".sendButton");

sendForm.addEventListener("click", () => {
    var bio = document.querySelector(".textarea_field textarea");
    var job_title = (document.querySelector(".job_title")).value;
    var resume_category = document.querySelector(".resume_category").value;
    var resume_sub_category = document.querySelector(".resume_sub_category").value;
    var resume_name = document.querySelector(".first_name").value;
    var resume_second_name = document.querySelector(".second_name").value;


    var hasError = false
    var error = document.querySelector(".error");

    if (job_title == "") {
        hasError = true;
        error.textContent = "Veuillez rajouter un titre a votre cv";
        error.style.display = "block";
        window.scrollTo(0, 0);
    } else if (resume_category == "") {
        hasError = true;
        error.textContent = "Veuillez selectionner une categorie pour votre cv";
        error.style.display = "block";
        window.scrollTo(0, 0);
    }
    else if (resume_sub_category = "") {
        hasError = true;
        error.textContent = "Veuillez selectionner une sous categorie pour votre cv";
        error.style.display = "block";
    }
    else if (bio.value == "") {
        hasError = true;
        error.textContent = "Veuillez remplir  votre bio , elle aidera les récruteurs à avoir un aperçu de la personne que vous êtes";
        error.style.display = "block";
    }


    for (var i = 0; i <= experiences_list.length; i++) {
        if (isEmpty(experiences_list[i])) {
            hasError = true;
            error.textContent = "l'experience " + (i + 1) + " a des elements manquants";
            error.style.display = "block";
            window.scrollTo(0, 0);
        }

    }


    for (var i = 0; i <= educations_list.length; i++) {
        if (isEmpty(educations_list[i])) {
            hasError = true;
            error.textContent = "le diplome " + (i + 1) + " a des elements manquants";
            error.style.display = "block";
            window.scrollTo(0, 0);
        }

    }


    for (var i = 0; i <= skills.length; i++) {

        if (isEmpty(skills[i])) {
            hasError = true;
            error.textContent = "la competence " + (i + 1) + " a des elements manquants";
            error.style.display = "block";
            window.scrollTo(0, 0);
        }

    }


    for (var i = 0; i <= languages.length; i++) {
        if (isEmpty(languages[i])) {
            hasError = true;
            error.textContent = "la langue " + (i + 1) + " a des elements manquants";
            error.style.display = "block";
            window.scrollTo(0, 0);
        }

    }

    if (!hasError) {

        var job_title = (document.querySelector(".job_title")).value;
        var resume_category = document.querySelector(".resume_category").value;
        var resume_sub_category = document.querySelector(".resume_sub_category").value;
        var resume_name = document.querySelector(".first_name").value;
        var resume_second_name = document.querySelector(".second_name").value;

        var bio = document.querySelector(".story").value;
        var donneeExp = JSON.stringify(experiences_list);
        var donneeEdu = JSON.stringify(educations_list);
        var donneeSkill = JSON.stringify(skills);
        var donneeLang = JSON.stringify(languages);

        // console.log("========= NEW_LINE ======S");
        // console.log("bio");
        // console.log(bio);
        // console.log("experiences_list");
        // console.log(experiences_list);
        // console.log("educations_list");
        // console.log(educations_list);
        // console.log("skills");
        // console.log(skills);
        // console.log("languages");
        // console.log(languages);


        let xhr = new XMLHttpRequest();

        let resume_form = new FormData();
        resume_form.append("purpose", "save");
        resume_form.append("job_title", job_title);
        resume_form.append("name", resume_name);
        resume_form.append("second_name", resume_second_name);
        resume_form.append("category", resume_category);
        resume_form.append("sub_category", resume_sub_category);
        resume_form.append("bio", bio);
        resume_form.append("experiences", donneeExp);
        resume_form.append("educations", donneeEdu);
        resume_form.append("skills", donneeSkill);
        resume_form.append("languages", donneeLang);

        xhr.open("POST", "freelancer_dashboard_assets/php_checking/cv_treatment.php", true);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    if (data == "success") {
                        window.scrollTo(0, 0);
                        document.querySelector(".blured").style.display = "block";
                        document.querySelector(".success").style.display = "block";
                    } else {
                        console.log(data);
                    }


                }
            }
        }

        xhr.send(resume_form);
    }


    document.addEventListener("click", () => {
        if (window.getComputedStyle(document.querySelector(".success")).display == "block") {

            document.querySelector(".success").style.display = "none";
            document.querySelector(".blured").style.display = "none";
          

        }
    })


})



