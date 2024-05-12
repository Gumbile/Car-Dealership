//#################### Input Fields ####################//
const inputUsername = document.getElementById("Username");

//#################### Errors ####################//
const usernameEmpty = document.getElementById("usernameEmpty");

//#################### Buttons ####################//
const usernameButton = document.getElementById("myForm");

//#################### Functions ####################//
usernameButton.addEventListener("submit", (event) => {
    if (inputUsername.value == "") {
        usernameEmpty.classList.remove("visually-hidden");
        event.preventDefault();
    } else {
        usernameEmpty.classList.add("visually-hidden");
    }
})

