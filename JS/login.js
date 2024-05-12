const email = document.getElementById("InputEmail");
const password = document.getElementById("InputPassword");
const submitButton = document.getElementById('submit');
const emailEmpty = document.getElementById("emptyEmail");
const passwordEmpty = document.getElementById("emptyPassword");
const form = document.getElementById('myForm');


form.addEventListener("submit", (event) => {
    if (email.value == "") {
        emailEmpty.classList.remove("visually-hidden");
        event.preventDefault();
    } else {
        emailEmpty.classList.add("visually-hidden");
    }
    if (password.value == "") {
        passwordEmpty.classList.remove("visually-hidden");
        event.preventDefault();
    } else {
        passwordEmpty.classList.add("visually-hidden");
    }
})