
//INPUTS 
var error = document.querySelector(".error");
var success = document.querySelector(".success");
var job_cat = document.querySelector(".job_cat");
var job_sub_cat = document.querySelector(".job_sub_cat");
var jobTitle = document.querySelector(".job_title");
var jobDescription = document.getElementById("content");
var skillList = [];
var endingDate = "";
var applicants = document.querySelector(".job_applicants");
var jobType = "";
var experienceYears = document.querySelector(".experience_years");
var frequency = "";
var currency = "Euro";
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
                var inner ="";
			    var dataArray = (data.split("/"));
				for(var i = 0;i<dataArray.length -1;i++)
				    inner += `<li onclick="popupTakenChoice(this)">`+dataArray[i]+`</li>`;

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

content.addEventListener('mouseenter', function () {
	const a = content.querySelectorAll('a');
	a.forEach(item => {
		item.addEventListener('mouseenter', function () {
			content.setAttribute('contenteditable', false);
			item.target = '_blank';
		})
		item.addEventListener('mouseleave', function () {
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
		let isToday = i === date.getDate()
			&& month === new Date().getMonth()
			&& year === new Date().getFullYear()
			? "active"
			: "";
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
		}

		else {

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
	element.style.transition="all .3s ease-in-out";
	element.classList.toggle("selected");
	frequency = element.lastElementChild.textContent;

	if(element.lastElementChild.textContent == "Autre"){
		document.querySelector(".AmoutnFrequency .amount").style.opacity ="1";
		document.querySelector(".AmoutnFrequency .rfrequency").style.opacity ="1";
	}else{

		document.querySelector(".AmoutnFrequency .amount").style.opacity ="1";
		document.querySelector(".AmoutnFrequency .rfrequency").style.opacity ="0";
	}

}

// ======= Ajouter les competences requises
function addSkills(inputElement) {
	inputElement.addEventListener('keydown', function (event) {
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
		popup.style.display = "none" :
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
		}
		else if(displayer.classList.contains("frequency_value")){
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
	jobForm.append('action', 'insertJob');
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
					success.textContent = "offre créee avec success";
				}else{
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