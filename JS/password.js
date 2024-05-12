//#################### Input Fields ####################//
const inputPassword = document.getElementById("InputPassword1");
const confirmPassword = document.getElementById("InputPassword2");
const passwordsArea = document.getElementById("passwordsField");

//#################### Errors ####################//
const passwordMatch = document.getElementById("match");
const passwordEmpty = document.getElementById("passwordEmpty");
const passwordEmpty2 = document.getElementById("passwordEmpty2");

//#################### Buttons ####################//
const passwordButton = document.getElementById("myForm");

//#################### Functions ####################//

passwordButton.addEventListener("submit", (event) => {
    if (inputPassword.value == confirmPassword.value) {
        if (inputPassword.value == "" && confirmPassword.value == "") {
            passwordEmpty.classList.remove("visually-hidden");
            passwordEmpty2.classList.remove("visually-hidden");
            event.preventDefault();
        } else if (confirmPassword.value == "") {
            passwordEmpty2.classList.remove("visually-hidden");
            event.preventDefault();
        } else if (inputPassword.value == "") {
            passwordEmpty.classList.remove("visually-hidden");
            event.preventDefault();
        } else {
            passwordEmpty.classList.add("visually-hidden");
            passwordEmpty2.classList.add("visually-hidden");
        }
    } else {
        event.preventDefault();
    }
})



passwordsArea.addEventListener("keyup", () => {
    if (inputPassword.value == "" && confirmPassword.value == "") {
        passwordEmpty.classList.remove("visually-hidden");
        passwordEmpty2.classList.remove("visually-hidden");
    } else if (confirmPassword.value == "") {
        passwordEmpty2.classList.remove("visually-hidden");
        passwordEmpty.classList.add("visually-hidden");
    } else if (inputPassword.value == "") {
        passwordEmpty.classList.remove("visually-hidden");
        passwordEmpty2.classList.add("visually-hidden");
    } else {
        passwordEmpty.classList.add("visually-hidden");
        passwordEmpty2.classList.add("visually-hidden");
    }
    if (inputPassword.value != confirmPassword.value) {
        passwordMatch.classList.remove("visually-hidden");
    } else {
        passwordMatch.classList.add("visually-hidden");
    }
})