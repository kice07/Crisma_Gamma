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
	// console.log(weeksDay);
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



var previousTask;
var isedited = false; // variable servant adtecter si la fonction edit est appelée 

function createTask(parent, enfant, annee) {
	var task = document.createElement("div");
	task.classList.add("task");
	inner = `<div class="infos">
				<p class="date">` + enfant.textContent + " " + annee.textContent + `</p>
				<textarea placeholder="Entrez votre tache"></textarea>
			</div>
			<div class="options">
				<i class='bx bx-pencil'onclick="editTask(this)"></i>
				<i class='bx bx-trash'onclick="deleteTask(this)"></i>
			</div>`;
	task.innerHTML = inner;
	var addtask = document.createElement("p");
	addtask.classList.add("translate", "add_task");
	addtask.textContent = "+ prochaine tâche";
	addtask.onclick = function() {
		addTask(this); // Supposons que addTask est votre fonction de gestionnaire d'événements
	};


	parent.appendChild(task);
	parent.appendChild(addtask);

}

//modifier une tâche
function editTask(trigger) {
	trigger.parentElement.previousElementSibling.lastElementChild.readOnly = false;
	trigger.parentElement.previousElementSibling.lastElementChild.focus();

	isedited = true;
	previousTask = trigger.parentElement.previousElementSibling.lastElementChild.value;
	console.log(previousTask)

}

//supprimer une tâche
function deleteTask(trigger) {

	//supprimer la tache dans la base de données 
	var date = trigger.parentElement.previousElementSibling.querySelector(".date").textContent;
	var task = trigger.parentElement.previousElementSibling.querySelector("textarea").value;


	let xhr = new XMLHttpRequest();
	let dTask = new FormData();
	dTask.append('action', "delete");
	dTask.append('date', date);
	dTask.append('task', task);

	xhr.open("POST", "admin_dashboard_assets/php_checking/Check_admin_dashboard.php", true);
	xhr.onload = () => {
		if (xhr.readyState === XMLHttpRequest.DONE) {
			if (xhr.status === 200) {
				let data = xhr.response;

				if (data == "success") {
					var task = trigger.parentElement.parentElement;
					var parent = task.parentElement;
					//recuperer le jour de la date correspondate au cas ou elle devrait etre deselectionnée
					var taskp = task.querySelector("p").textContent.split(" ")[0];
					console.log(taskp);
					if (parent.children.length == 2) {
						//vider la task_box
						while (parent.firstChild) {
							parent.removeChild(parent.firstChild);
						}

						//deselectionner la date en question
						for (var i = 0; i < weeksDay.length; i++) {
							if (weeksDay[i].textContent == taskp)
								weeksDay[i].classList.remove("chosen");
						}

					} else {
						parent.removeChild(task);

					}
				}

			}
		}
	}
	xhr.send(dTask);

}

//ajouter une autre tâche le même jour
function addTask(trigger) {
	var task_bloc = trigger.parentElement;
	var clonedTask = trigger.previousElementSibling.cloneNode(true);
	clonedTask.firstElementChild.lastElementChild.value = "";
	task_bloc.insertBefore(clonedTask, trigger);
}



// console.table(weeksDay);

window.addEventListener("DOMContentLoaded", () => {

	var date = document.querySelector(".calendar-dates li.active").textContent + " " + document.querySelector(".calendar-current-date").textContent;
	// console.log(date);
	let xhr = new XMLHttpRequest();
	let gDay = new FormData();
	gDay.append('action', "getDays");
	gDay.append('date', date);
	xhr.open("POST", "admin_dashboard_assets/php_checking/Check_admin_dashboard.php", true);
	xhr.onload = () => {
		if (xhr.readyState === XMLHttpRequest.DONE) {
			if (xhr.status === 200) {
				let data = xhr.response;
				if (data !== "nothing") {

					//recuperer la liste de task et date evoyé depuis php
					let adataArray = data.split("/");
					let dataArray = adataArray.slice(0, -1);

					//appliquer le style chosen au dates correspondantes
					dataArray.forEach(Element => {
						var day = Element.split(" ");
						// console.log(day);
						for (var i = 0; i < weeksDay.length; i++) {
							if (weeksDay[i].textContent == day[0])
								weeksDay[i].classList.add("chosen");
						}

					})
				}

			}
		}
	}
	xhr.send(gDay);
})

var taskBox = document.querySelector(".task-box");

weeksDay.forEach(day => {
	day.addEventListener("click", () => {

		var year = document.querySelector(".calendar-current-date");

		if (day.classList.contains("chosen")) {

			var date = day.textContent + " " + day.parentElement.parentElement.previousElementSibling.querySelector(".calendar-current-date").textContent;
			console.log(date);
			let xhr = new XMLHttpRequest();
			let gTask = new FormData();
			gTask.append('action', "getDaynTask");
			gTask.append('date', date);

			xhr.open("POST", "admin_dashboard_assets/php_checking/Check_admin_dashboard.php", true);
			xhr.onload = () => {
				if (xhr.readyState === XMLHttpRequest.DONE) {
					if (xhr.status === 200) {
						let data = xhr.response;

						//recuperer la lliste de task et date evoyé depuis php
						var firstDataArray = data.split("/");
						var secondDataArray = firstDataArray.slice(0, -1);
						secondDataArray.forEach(Element => {
							var littleArray = Element.split("_");
							var task = document.createElement("div");
							task.classList.add("task");
							inner = `<div class="infos">
										<p class="date">` + littleArray[0] + `</p>
										<textarea placeholder="Entrez votre tache">` + littleArray[1] + `</textarea>
									</div>
									<div class="options">
										<i class='bx bx-pencil'onclick="editTask(this)"></i>
										<i class='bx bx-trash'onclick="deleteTask(this)"></i>
									</div>`;
							task.innerHTML = inner;
							taskBox.appendChild(task);
							// taskBox.innerHTML += task;
						});

						var addtask = document.createElement("p");
						addtask.classList.add("translate", "add_task");
						addtask.textContent = "+ prochaine tâche";
						addtask.onclick = function() {
							addTask(this); // Supposons que addTask est votre fonction de gestionnaire d'événements
						};
						taskBox.appendChild(addtask);

					}
				}
			}
			xhr.send(gTask);
		} else {
			//Changer de task-box en supprimmant les anciennes tâches
			while (taskBox.firstChild) {
				taskBox.removeChild(taskBox.firstChild);
			}

			//ajouter la première tâche
			day.classList.add("chosen");

			taskBox.scrollTo({
				top: taskBox.scrollHeight,
				behavior: 'smooth' // Défilement fluide
			});

			createTask(taskBox, day, year);

			//Gestion du textarea
			var textareas = document.querySelectorAll("textarea");

			textareas.forEach(text => {
				text.addEventListener("keydown", e => {
					if (e.key === "Enter") {

						if (isedited) {
							e.preventDefault();
							e.stopPropagation();

							let xhr = new XMLHttpRequest();
							let eTask = new FormData();
							eTask.append('action', "update");
							eTask.append('date', text.previousElementSibling.textContent);
							eTask.append('newtask', text.value);
							eTask.append('pretask', previousTask);
							xhr.open("POST", "admin_dashboard_assets/php_checking/Check_admin_dashboard.php", true);
							xhr.onload = () => {
								if (xhr.readyState === XMLHttpRequest.DONE) {
									if (xhr.status === 200) {
										let data = xhr.response;

										if (data == "success") {
											text.readOnly = true;

										}

									}
								}
							}
							xhr.send(eTask);
							isedited = false;

						} else {

							e.preventDefault();
							e.stopPropagation();
							// console.log("cration");
							let xhr = new XMLHttpRequest();
							let aTask = new FormData();
							aTask.append('action', "insert");
							aTask.append('date', text.previousElementSibling.textContent);
							aTask.append('task', text.value);

							xhr.open("POST", "admin_dashboard_assets/php_checking/Check_admin_dashboard.php", true);
							xhr.onload = () => {
								if (xhr.readyState === XMLHttpRequest.DONE) {
									if (xhr.status === 200) {
										let data = xhr.response;

										if (data == "success") {

											text.readOnly = true;
											// e.preventDefault();


										} else {
											console.log(data);
										}

									}
								}
							}
							xhr.send(aTask);

						}


					}
					text.style.height = "20px";
					let scHeight = e.target.scrollHeight;
					text.style.height = `${scHeight}px`;

				})
			})

		}

	})
})