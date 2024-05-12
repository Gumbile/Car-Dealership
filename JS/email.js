//#################### Input Fields ####################//
const inputEmail = document.getElementById("InputEmail");

//#################### Errors ####################//
const emptyEmail = document.getElementById("emptyEmail");
const emailFormat = document.getElementById("emailFormat");

//#################### Buttons ####################//
const emailButton = document.getElementById("myForm");


//#################### Functions ####################//
emailButton.addEventListener("submit", (event) => {
    let regex = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|.(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
    if (inputEmail.value == "") {
        emptyEmail.classList.remove("visually-hidden");
        event.preventDefault();
    } else {
        emptyEmail.classList.add("visually-hidden");
    } if (!String(inputEmail.value).toLowerCase().match(regex) && inputEmail.value != "") {
        emailFormat.classList.remove("visually-hidden");
        event.preventDefault();
    } else {
        emailFormat.classList.add("visually-hidden");
    }
})
