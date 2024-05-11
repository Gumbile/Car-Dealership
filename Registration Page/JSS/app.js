//#################### Input Fields ####################//
const inputEmail = document.getElementById("InputEmail");
const inputPassword = document.getElementById("InputPassword1");
const confirmPassword = document.getElementById("InputPassword2");
const inputUsername = document.getElementById("Username");

//#################### Errors ####################//
//Email
const emptyEmail = document.getElementById("emptyEmail");
const emailFormat = document.getElementById("emailFormat");
//Password
const passwordMatch = document.getElementById("match");
const passwordEmpty = document.getElementById("passwordEmpty");
//Username
const usernameEmpty = document.getElementById("usernameEmpty");

//#################### Buttons ####################//
//Email
const emailButton = document.getElementById("emailButton");
const emailNext = document.getElementById("emailNext");
//Password
const passwordButton = document.getElementById("passwordButton");
const passwordNext = document.getElementById("passwordNext");
//Username
const usernameButton = document.getElementById("usernameButton");
const usernameNext = document.getElementById("usernameNext");

//#################### Functions ####################//
emailButton.addEventListener("click", () => {
    let emptyFlag = false;
    let formatFlag = false;
    let regex = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|.(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
    if (inputEmail.value == "") {
        emptyEmail.classList.remove("visually-hidden");
        emptyFlag = true
    } else {
        emptyEmail.classList.add("visually-hidden");
    } if (!String(inputEmail.value).toLowerCase().match(regex) && inputEmail.value != "") {
        emailFormat.classList.remove("visually-hidden");
        formatFlag = true
    } else {
        emailFormat.classList.add("visually-hidden");
    }
    if (!formatFlag && !emptyFlag) {
        emailNext.setAttribute("href", "Username.html");
    }

})

passwordButton.addEventListener("click", () => {
    if (inputPassword.value == "") {
        passwordEmpty.classList.remove("visually-hidden");
    } else {
        passwordEmpty.classList.add("visually-hidden");
        passwordNext.setAttribute("href", "#");
    }
})

passwordButton.addEventListener("keyup", () => {
    if (inputPassword != confirmPassword && passwordNext.value != "") {
        passwordMatch.classList.remove("visually-hidden");
    } else {
        passwordMatch.classList.add("visually-hidden");
        passwordNext.setAttribute("href", "#");
    }
})

usernameButton.addEventListener("click", () => {
    if (inputUsername.value == "") {
        usernameEmpty.classList.remove("visually-hidden");
    } else {
        usernameEmpty.classList.add("visually-hidden");
        usernameNext.setAttribute("href", "Password.html");
    }
})