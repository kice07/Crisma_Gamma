// counter
var back = document.querySelector(".counter .ai-arrow-left");
var forth = document.querySelector(".counter a");
var mids = document.querySelectorAll(".counter .numbers .mid");


back.addEventListener("click", () => {
    if (mids[0].textContent == "2") {
        mids.forEach(mid => {
            mid.classList.add("hide")
        })
    } else {
        mids[0].textContent = parseInt(mids[0].textContent) - 1;
    }
})

forth.addEventListener("click", () => {
    if (mids[0].classList.contains("hide")) {
        mids.forEach(mid => {
            mid.classList.remove("hide")
        })
    } else {
        mids[0].textContent = parseInt(mids[0].textContent) + 1;
    }
})

//==============create_invoices

//display_invoices
var sidebarTrigger = document.querySelector(".banner .content button");
var sidebarCloserTrigger = document.querySelector(".create_invoice .head i");
var sidebar = document.querySelector(".create_invoice");
var blured = document.querySelector(".blured");

sidebarTrigger.addEventListener("click", () => {
    blured.style.display = "block";
    setTimeout(function () {
        sidebar.style.marginRight = "0";
        sidebar.style.transition = "margin .3s ease-in-out";
    }, 50);


})

sidebarCloserTrigger.addEventListener("click", () => {

    sidebar.style.marginRight = "-35%";
    sidebar.style.transition = "margin .3s ease-in-out";
    setTimeout(function () {
        blured.style.display = "none";
    }, 500);


})



//process
var elementList = [];
indexE = 0;
function createObjectElement(index) {
    var object = {
        rank: index,
        label: "",
        price: "",
        qte: "",
        total: "",
    };
    return object;
}

function createInvoiceElement(parent, dernier, index) {
    var dataDiv = document.createElement('div');
    dataDiv.classList.add("data");
    dataDiv.setAttribute("rank", index)

    inner = `       <div class="input_field high">
                        <span>Element</span><br>
                        <input type="text" name="element" class="element"rank="`+ index + `">
                    </div>
                    <div class="input_field medium">
                        <span>Prix</span><br>
                        <input type="text" name="price" class="price" rank="`+ index + `">
                    </div>
                    <div class="input_field low">
                        <span>Qte</span><br>
                        <input type="text" name="qte" class="qte" rank="`+ index + `">
                    </div>
                    <div class="input_field medium">
                        <span>Total</span><br>
                        <input type="text" name="total" class="total" rank="`+ index + `">
                    </div>

                    <i class="ai-trash-can" onClick="deleteObjectElement(this)"></i>`;
    dataDiv.innerHTML = inner;

    parent.insertBefore(dataDiv, dernier);
}

function deleteObjectElement(element) {
    var databloc = element.parentElement;
    var rank = databloc.getAttribute("rank");
    var parent = databloc.parentElement;

    //delete the object
    elementList.forEach((obj, index) => {
        if (obj.rank == rank) {
            elementList.slice(index, 1)
        }
    })

    //delete the actual bloc
    parent.removeChild(databloc);
}

var addElement = document.querySelector(".invoice_item a");
var elementBloc = document.querySelector(".invoice_item");

addElement.addEventListener("click", () => {
    var elementObject = createObjectElement(indexE);
    elementList.push(elementObject);
    createInvoiceElement(elementBloc, addElement, indexE);
    indexE++;

    //Gestion des inputs


    //Element label
    var elementLabels = document.querySelectorAll(".invoice_item .data .element");

    elementLabels.forEach(label => {
        label.addEventListener("input", () => {
            for (var i = 0; i < elementList.length; i++) {
                if (label.getAttribute("rank") == elementList[i].rank) {
                    elementList[i].label = label.value;
                }
            }
        })
    })

    //Element price
    var elementPrices = document.querySelectorAll(".invoice_item .data .price");
    elementPrices.forEach(price => {
        price.addEventListener("input", () => {
            for (var i = 0; i < elementList.length; i++) {
                if (price.getAttribute("rank") == elementList[i].rank) {
                    elementList[i].price = price.value;
                }
            }
        })
    })

    //Element qte and total
    var elementQtes = document.querySelectorAll(".invoice_item .data .qte");


    elementQtes.forEach(qte => {
        qte.addEventListener("click", () => {
            var matchingPrice = (qte.parentElement.previousElementSibling).lastElementChild;
            if (matchingPrice.value != "") {
                qte.readOnly = false;
            } else {
                qte.readOnly = true;
            }

        })
        qte.addEventListener("input", () => {

            var matchingPrice = (qte.parentElement.previousElementSibling).lastElementChild;
            var matchingTotal = (qte.parentElement.nextElementSibling).lastElementChild;

            for (var i = 0; i < elementList.length; i++) {
                if (qte.getAttribute("rank") == elementList[i].rank) {
                    elementList[i].qte = qte.value;
                    if (qte.value != "") {
                        matchingTotal.value = parseFloat(elementList[i].price) * parseInt(qte.value);
                        elementList[i].total = parseFloat(elementList[i].price) * parseInt(qte.value);
                    } else {
                        matchingTotal.value = "0";
                    }
                }
            }


        })
    })





})


//Send Element
var sendButton = document.querySelector(".create_invoice .send");
sendButton.addEventListener("click", () => {
    console.log(elementList)
    var invoices_id = document.querySelector(".create_invoice .invoice_titles p").textContent;
    var invoice_receiver = document.querySelector(".create_invoice .receiver").value;
    var invoice_project = document.querySelector(".create_invoice .project_job").value;
    var invoice_add = document.querySelector(".create_invoice textarea").value;

    //check
    if (invoice_receiver != "") {
        if (invoice_project != "") {
            var success = document.querySelector(".success");
            success.style.display = "block"
            setTimeout(function () {
                success.style.display = "none"
                sidebar.style.marginRight = "-35%";
                sidebar.style.transition = "margin .3s ease-in-out";
                setTimeout(function () {
                    blured.style.display = "none";
                }, 500);
            }, 1000);
          
        }
    }
})