
var checkImg = document.querySelector(".navbar .end img"),
    translateFrom = "fr",
    translateTo,
    isTranslated = false,

    toTranslate = document.querySelectorAll(".translate");




// "fr-FR": "French"
// "en-GB": "English"




function translate(toTranslate, From, translateTo) {
    toTranslate.forEach(element => {
        const url = `https://translate.googleapis.com/translate_a/single?client=gtx&sl=${From}&tl=${translateTo}&dt=t&q=${encodeURI(
            element.textContent
        )}`;
        fetch(url)
            .then((response) => response.json())
            .then((json) => {
                // console.log(json);
                element.textContent = json[0].map((item) => item[0]).join("");
            })
            .catch((error) => {
                console.log(error);
            });

    });

   translateFrom = (translateFrom =="fr") ? "en" : "fr";

}


checkImg.addEventListener("click", () => {
    isTranslated = true;
    if (translateFrom == "fr") {
        checkImg.src = "https://www.worldometers.info/img/flags/us-flag.gif"
        translateTo = "en";
    } else {
        translateTo = "fr";
        checkImg.src = "https://www.worldometers.info/img/flags/fr-flag.gif"
    }

    translate(toTranslate, translateFrom, translateTo)

    // if (isTranslated) {
    //     From = translateTo;
    //     translate(toTranslate, translateFrom, translateTo)

    // }

});






