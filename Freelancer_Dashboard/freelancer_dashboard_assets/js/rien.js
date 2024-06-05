const sideLinks = document.querySelectorAll('.sidebar .nav-links li a:not(.log_out)');

let sidebar = document.querySelector(".sidebar");
let sidebarBtn = document.querySelector(".bx-chevron-right");

// window.addEventListener('load', function() {
//     sidebar.classList.remove('close');
// });



window.addEventListener("scroll", function () {

    var nav = document.querySelector("nav");
    // HeroHeigth.offsetHeight
    nav.classList.add("Fix", window.scrollY > 0)

});
sideLinks.forEach((item, pos) => {
    const li = item.parentElement;
    item.addEventListener('click', () => {
        sideLinks.forEach(i => {

            i.parentElement.classList.remove('active');
        })
        li.classList.add('active');
    })
});

const sideSubLinks = document.querySelectorAll('.sidebar .nav-links li .sub-menu li a');

sideSubLinks.forEach(item => {
    const li = item.parentElement;
    item.addEventListener('click', () => {
        sideSubLinks.forEach(i => {
            i.parentElement.classList.remove('activesub');
        })
        li.classList.add('activesub');
    })
});





let arrow = document.querySelectorAll(".arrow");
for (var i = 0; i < arrow.length; i++) {
    arrow[i].addEventListener("click", (e) => {
        let arrowParent = e.target.parentElement.parentElement;//selecting main parent of arrow
        arrowParent.classList.toggle("showMenu");

    });
}


console.log(sidebarBtn);
sidebarBtn.addEventListener("click", () => {
    sidebar.classList.toggle("close");
    if (sidebarBtn.classList.contains("rotate")) {
        sidebarBtn.classList.remove("rotate");
    } else {
        sidebarBtn.classList.add("rotate");
    }
    //   
});


const searchBtn = document.querySelector('.content nav form .form-input button');
const searchInput = document.querySelector('.content nav form .form-input input');
const searchForm = document.querySelector('.content nav form');

searchBtn.addEventListener('click', function (e) {
    // if (window.innerWidth < 576) {
    //     e.preventDefault;
    //     searchForm.classList.toggle('show');
    //     if (searchForm.classList.contains('show')) {
    //         searchBtnIcon.classList.replace('bx-search', 'bx-x');
    //     } else {
    //         searchBtnIcon.classList.replace('bx-x', 'bx-search');
    //     }
    // }
    searchInput.style.display = "none";


});

window.addEventListener('resize', () => {
    if (window.innerWidth < 768) {
        sidebar.classList.add('close');
    } else {
        sidebar.classList.remove('close');
    }
    // if (window.innerWidth > 576) {
    //     searchBtnIcon.classList.replace('bx-x', 'bx-search');
    //     searchForm.classList.remove('show');
    // }  
});


//====================MAIN================

var inputs = document.querySelectorAll(".select_input .head input");
var Bottom = document.querySelectorAll(".select_input ul");
var firstBottomOptions = document.querySelectorAll(".select_input .cat li");
var secondBottomOptions = document.querySelectorAll(".select_input .sub_cat li");
var isClicked = true;

//Display sublist
inputs.forEach((element, index) => {
    element.addEventListener("click", () => {

        // console.log(containerBottom.offsetHeight);
        if (isClicked) {
            // containerBottom.style.height = containerBottom.offsetHeight + "px";
            Bottom[index].style.height = "100px";
            Bottom[index].style.opacity = "1";
            Bottom[index].style.transition = " height .3s ease-in-out,opacity .3s ease-in-out";
            isClicked = false;

        } else {
            Bottom[index].style.height = "0";
            Bottom[index].style.opacity = "0";
            Bottom[index].style.transition = " height .3s ease-in-out,opacity .3s ease-in-out";
            isClicked = true;
        }

    });
});

//select sublist value
firstBottomOptions.forEach(element => {
    element.addEventListener("click", () => {
        inputs[0].value = element.textContent;
        Bottom[0].style.height = "0";
        Bottom[0].style.opacity = "0";
        Bottom[0].style.transition = " height .3s ease-in-out,opacity .3s ease-in-out";
    });
});

secondBottomOptions.forEach(element => {
    element.addEventListener("click", () => {
        inputs[1].value = element.textContent;

        Bottom[1].style.height = "0";
        Bottom[1].style.opacity = "0";
        Bottom[1].style.transition = " height .3s ease-in-out,opacity .3s ease-in-out";
    });
});


//======================bio counter =========================

var container = document.querySelector(".textarea_field .checker .limit");
var bio = document.querySelector(".textarea_field textarea");
var wordCount = document.querySelector(".checker .limit .counter");
var emoji = document.querySelector(".checker .limit i");
// Écouter l'événement de saisie dans le textarea
bio.addEventListener('input', function () {

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


// ========================Exp and Edu ==========================


//***** slow Motion

var experiences_list = [];
var educations_list = [];



// add cat
var addButton = document.querySelectorAll(".add");
var indexE = 0;
var indexS = 0;
var container;

function createObject(part, index) {
    if (part == "employment_history") {
        var object = {
            rank: index,
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

function createExperience(container, expContainer) {
    expInner = `    <div class="input">
                        <div class="head">
                            <p class="employment_title">( indefini )</p>
                            <span><i class='bx bx-chevron-down'></i></span>
                        </div>

                        <div class="bottom">
                        
                            <div class="field">
                                <div class="left">
                                    <span class="label">Titre du poste</span><br>
                                    <input type="text" name="experience_job_title" 
                                      class="experience_job_title"
                                        placeholder="ex: Web Designer">

                                </div>
                            
                                <div class="right">
                                    <span class="label">Employeur</span><br>
                                    <input type="text" name="experience_job_company"
                                    class="experience_job_company" placeholder="ex: Google">
                                </div>

                            </div>

                            <div class="field">
                                <div class="left">
                                    
                                    <div class="date">
                                        
                                        <div class="start">
                                            <span class="label">Date de début</span>
                                            <input type="text" name="starting_exp_date"
                                            class="inputDateExp startDate" placeholder="ex: MM/YYYY"readonly >
                                            
                                        </div>

                                        <div class="ending">
                                            <span class="label">Date de fin</span>
                                            <input type="text" name="ending_exp_date" 
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
                                    <input type="text" name="experience_job_city"
                                     class="experience_job_city" placeholder="ex: Web Designer">
                                </div>
                                
                            </div>

                            <span>Description</span>
                            <textarea id="story"  class="experience_description" name="story" rows="15" cols="93" >

                            </textarea><br>

                            <span class="tips">Conseil: écrivez 50 à 200 caractères pour augmenter
                            les chances d'entretien.</span><br><br>

                        </div>

                    </div>
                    <i class='bx bx-trash'></i>`;

    expContainer.innerHTML = expInner;

    const dernierEnfant = container.lastElementChild;

    container.insertBefore(expContainer, dernierEnfant);


    var trigger = expContainer.querySelector(".input .head span .bx");
    var box = expContainer.querySelector(".input .bottom");
    console.log(trigger + " " + box)
    // triggers.push(trigger)
    // boxs.push(box)

}

function createEducation(container, schoolContainer) {
    schoolInner = `    <div class="input">
                        <div class="head">
                            <p class="school_name_title">( indefini )</p>
                            <span><i class='bx bx-chevron-down'></i></span>
                        </div>

                        <div class="bottom">
                        
                            <div class="field">
                                <div class="left">
                                    <span class="label">Nom de l'école</span><br>
                                    <input type="text" name="school_name" 
                                      class="school_name"
                                        placeholder="ex: Université de Calgary">

                                </div>
                            
                                <div class="right">
                                    <span class="label">Diplome</span><br>
                                    <input type="text" name="school_degree"
                                    class="school_degree" placeholder="ex: Bachelor">
                                </div>

                            </div>

                            <div class="field">
                                <div class="left">
                                    
                                    <div class="date">
                                        
                                        <div class="start">
                                            <span class="label">Date de début</span>
                                            <input type="text" name="starting_degree_date"
                                            class="inputDateSch startDate" placeholder="ex: MM/YYYY" readonly>
                                            
                                        </div>

                                        <div class="ending">
                                            <span class="label">Date de fin</span>
                                            <input type="text" name="ending_degree_date" 
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
                                    <input type="text" name="school_city"
                                     class="school_city" placeholder="ex: Calgary">
                                </div>
                                
                            </div>

                            <span>Description</span>
                            <textarea id="story" class="school_description" name="story" rows="15" cols="93" >

                            </textarea><br>

                            <span class="tips">Conseil: écrivez 50 à 200 caractères pour augmenter
                            les chances d'entretien.</span><br><br>

                        </div>

                    </div>
                    <i class='bx bx-trash'></i>`;

    schoolContainer.innerHTML = schoolInner;

    const dernierEnfant = container.lastElementChild;

    container.insertBefore(schoolContainer, dernierEnfant);


    var trigger = schoolContainer.querySelector(".input .head span .bx");
    var box = schoolContainer.querySelector(".input .bottom");
    console.log(trigger + " " + box)
    // triggers.push(trigger)
    // boxs.push(box)
}

addButton.forEach(button => {
    button.addEventListener("click", () => {
        var object;
    
        // create the box
        var objContainer = document.createElement("div");
        objContainer.classList.add("input_field");

        if (button.parentElement.className == "employment_history") {
            object = createObject("employment_history", indexE)
            createExperience(button.parentElement, objContainer);
            experiences_list.push(object);
            objContainer.setAttribute("position", indexE);
            indexE++;
        } else {
            object = createObject("education_history", indexS)
            createEducation(button.parentElement, objContainer);
            educations_list.push(object);
            objContainer.setAttribute("position", indexS);
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
        var title = objContainer.querySelector(".input .head p");

        if (button.parentElement.className == "employment_history") {

            var experience_job_titles = document.querySelectorAll(".experience_job_title");
            experience_job_titles.forEach((job_title, index) => {
                job_title.addEventListener("input", () => {
                    experiences_list[index].position = job_title.value;
                    title.textContent = job_title.value;
                })
            })

            var experience_job_companies = document.querySelectorAll(".experience_job_company");
            experience_job_companies.forEach((job_company, index) => {
                job_company.addEventListener("input", () => {
                    experiences_list[index].company = job_company.value;
                })
            })


            var experience_job_cities = document.querySelectorAll(".experience_job_city");
            experience_job_cities.forEach((job_city, index) => {
                job_city.addEventListener("input", () => {
                    experiences_list[index].ville = job_city.value;
                })
            })

            var experience_descriptions = document.querySelectorAll(".experience_description");
            experience_descriptions.forEach((experience_description, index) => {
                experience_description.addEventListener("input", () => {
                    experiences_list[index].description = experience_description.value;
                })
            })

        } else {

            var school_names = document.querySelectorAll(".school_name");
            school_names.forEach((school_name, index) => {
                school_name.addEventListener("input", () => {
                    educations_list[index].school = school_name.value;
                    title.textContent = school_name.value;
                })
            })

            var school_degrees = document.querySelectorAll(".school_degree");
            school_degrees.forEach((school_degree, index) => {
                school_degree.addEventListener("input", () => {
                    educations_list[index].degree = school_degree.value;
                })
            })


            var school_cities = document.querySelectorAll(".school_city");
            school_cities.forEach((school_city, index) => {
                school_city.addEventListener("input", () => {
                    educations_list[index].ville = school_city.value;
                })
            })

            var school_descriptions = document.querySelectorAll(".school_description");
            school_descriptions.forEach((school_description, index) => {
                school_description.addEventListener("input", () => {
                    educations_list[index].description = school_description.value;
                })
            })

        }



        // calendar
        var calendars = objContainer.querySelector(".calendar");
        var inputDates;
        if (button.parentElement.className == "employment_history") {
            inputDates = document.querySelectorAll(".inputDateExp");
        } else {
            inputDates = document.querySelectorAll(".inputDateSch");
        }

        var addOrRemove,
            year,
            months;

        inputDates.forEach((element, index) => {
            var check;
            element.addEventListener("click", () => {
                check = element;
                // console.log(index);
                calendars.style.display = "block";
                addOrRemove = calendars.querySelectorAll(".head i");
                year = calendars.querySelector(".head .year");
                months = calendars.querySelectorAll(".bottom p");

                //change year
                addOrRemove.forEach((side, rang) => {
                    side.addEventListener("click", () => {
                        if (rang == 0) {
                            year.textContent = parseInt(year.textContent) - 1;
                        } else {
                            year.textContent = parseInt(year.textContent) + 1;
                        }
                    })
                })

                //select month 
                months.forEach(month => {
                    month.addEventListener("click", () => {

                        check.value = month.textContent + " " + year.textContent;

                        if (button.parentElement.className == "employment_history") {
                            if (check.classList.contains("startDate")) {
                                experiences_list[Math.floor(index / 2)].startingDate = element.value;
                            } else {
                                experiences_list[Math.floor(index / 2)].endingDate = element.value;
                            }
                        } else {
                            if (check.classList.contains("startDate")) {
                                educations_list[Math.floor(index / 2)].startingDate = element.value;
                            } else {
                                educations_list[Math.floor(index / 2)].endingDate = element.value;
                            }
                        }



                        check = "";
                        calendars.style.display = "none";
                    })
                })

            });

            element.addEventListener("input", (event) => {
                event.preventDefault();
            })
        });



        //Delete container
        var delButton = objContainer.querySelector(".bx-trash");

        delButton.addEventListener("click", () => {
            var bigContainer = objContainer.parentElement;

            if (button.parentElement.className == "employment_history") {

                for (var i = 0; i < experiences_list.length; i++) {
                    if (experiences_list[i].rank = objContainer.getAttribute("position"))
                        experiences_list.splice(i, 1);
                }

            } else {
                for (var i = 0; i < educations_list.length; i++) {
                    if (educations_list[i].rank = objContainer.getAttribute("position"))
                        educations_list.splice(i, 1);
                }

            }

            bigContainer.removeChild(objContainer);

        });



    })
})




//==================== skills et language ===============


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

function secondCreateObject(part, index) {
    if (part == "skills") {
        var object = {
            rank: index,
            label: "",
            level: "",
        };

        return object;
    } else {
        var object = {
            rank: index,
            language: "",
            level: "",
        };

        return object;
    }

}

function createSkill(container, skillContainer) {
    skillInner = `   <div class="input">
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


    var trigger = skillContainer.querySelector(".input .head span .bx");
    var box = skillContainer.querySelector(".input .bottom");
    console.log(trigger + " " + box)
    // triggers.push(trigger)
    // boxs.push(box)

}

function createLanguage(container, LangContainer) {
    LangInner = `   <div class="input">
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


    var trigger = LangContainer.querySelector(".input .head span .bx");
    var box = LangContainer.querySelector(".input .bottom");
    console.log(trigger + " " + box)
    // triggers.push(trigger)
    // boxs.push(box)
}

function deleteBloc(element) {

    var bigContainer = element.parentElement.parentElement;
    var objContainer = element.parentElement
    if (objContainer.getAttribute("section") == "skill") {

        for (var i = 0; i < skills.length; i++) {
            if (skills[i].rank == objContainer.getAttribute("position"))
                skills.splice(i, 1);
        }
    } else {
        for (var i = 0; i < languages.length; i++) {
            if (languages[i].rank == objContainer.getAttribute("position"))
                languages.splice(i, 1);
        }

    }

    bigContainer.removeChild(objContainer);
}

function slidingBox(element) {

    // Récupérer la liste des enfants de la div
    var enfants = Array.from(element.parentElement.children);
    // Trouver l'index du paragraphe dans la liste des enfants
    var position = enfants.indexOf(element);
    var bigParent = element.parentElement.parentElement.parentElement.parentElement.parentElement;
    var levelLabel = bigParent.querySelector(".level_title");
    var rank = bigParent.getAttribute("position");

    element.style.backgroundColor = mainColor[position];
    element.addEventListener("mouseenter", () => {
        element.style.backgroundColor = mainColor[position];

    });

    element.addEventListener("mouseleave", () => {
        element.style.backgroundColor = mainColor[position];
    });

    var pos = position;
    if (bigParent.getAttribute("section") == "skill") {
        levelLabel.textContent = skillLevel[pos];
        levelLabel.style.color = mainColor[pos];
        skills[rank].level = skillLevel[pos];
    } else {
        levelLabel.textContent = languageLevel[pos];
        levelLabel.style.color = mainColor[pos];
        languages[rank].level = languageLevel[pos];
    }

    enfants.forEach((sub_element, index2) => {

        sub_element.style.borderLeftColor = mainColor[pos];
        sub_element.style.borderRightColor = mainColor[pos];

        if (!(index2 == pos)) {
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
        console.log(object);

        // create the box
        var objContainer = document.createElement("div");
        objContainer.classList.add("input_field");


        if (button.parentElement.className == "skills") {
            object = secondCreateObject("skills", indexK)
            createSkill(button.parentElement, objContainer);
            skills.push(object);
            objContainer.setAttribute("position", indexK);
            objContainer.setAttribute("section", "skill");
            indexK++;
        } else {
            object = secondCreateObject("languages", indexL)
            createLanguage(button.parentElement, objContainer);
            languages.push(object);
            objContainer.setAttribute("position", indexL);
            objContainer.setAttribute("section", "language");
            indexL++;
        }


        //shrink action
        var trigger = objContainer.querySelector(".input .head span .bx");
        var box = objContainer.querySelector(".input .bottom");
        var isClicked = false;
        trigger.addEventListener("click", () => {
            console.log(trigger);
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

        if (button.parentElement.className == "skills") {
            var skills_titles = document.querySelectorAll(".skill_name");
            skills_titles.forEach((skill_title, index) => {
                skill_title.addEventListener("input", () => {
                    skills[index].label = skill_title.value;
                    title.textContent = skill_title.value;
                })
            })
        } else {
            var languages_titles = document.querySelectorAll(".language_name");
            languages_titles.forEach((language_title, index) => {
                language_title.addEventListener("input", () => {
                    languages[index].language = language_title.value;
                    title.textContent = language_title.value;
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
    var hasError = false
    var job_title = document.querySelector(".job_title").value;

    var error = document.querySelector(".error");
    window.scrollTo(0,0);

    console.log("Experience \n");
    for (var i = 0; i <= experiences_list.length; i++) {
        if(isEmpty(experiences_list[i])){
            hasError = true;
            error.textContent = "l'experience "+i+" a des elements manquants";
            error.style.display = "block";
            window.scrollTo(0,0);
        }
        console.log(experiences_list[i]);
    }


    console.log("Education \n");
    for (var i = 0; i <= educations_list.length; i++) {
        if(isEmpty(educations_list[i])){
            hasError = true;
            error.textContent = "le diplome "+i+" a des elements manquants";
            error.style.display = "block";
            window.scrollTo(0,0);
        }
        console.log(educations_list[i]);
    }

    console.log("competences \n");
    for (var i = 0; i <= skills.length; i++) {

        if(isEmpty(skills[i])){
            hasError = true;
            error.textContent = "la competence "+i+" a des elements manquants";
            error.style.display = "block";
            window.scrollTo(0,0);
        }
        console.log(skills[i]);
    }



    console.log("Langue \n");
    for (var i = 0; i <= languages.length; i++) {
        if(isEmpty(languages[i])){
            hasError = true;
            error.textContent = "la langue "+i+" a des elements manquants";
            error.style.display = "block";
            window.scrollTo(0,0);
        }
        console.log(languages[i]);
    }
})