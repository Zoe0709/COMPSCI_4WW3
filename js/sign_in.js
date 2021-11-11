// Function that displays content of the dropdown
function dropthebox() {
    document.getElementById("userdropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(e) {
    if (!e.target.matches('.dropbtn')) {
    var myDropdown = document.getElementById("myDropdown");
        if (myDropdown.classList.contains('show')) {
            myDropdown.classList.remove('show');
        }
    }
}

function validatereg(form) {

    valid_form = true;
    orignalbgcolor = "white";
    bgcolor = "#b38f8f";

    // check if the provided username is valid
    if (!(validateUserName(form.username.value))) {
        // if it is not a valid username, alert the user
        window.alert("incorrect username, can only contain letters, white space, or numbers");
        form.username.style.background = bgcolor;
        valid_form = false;
    } else {
        form.username.style.background = orignalbgcolor;
    }

    // check if the provided password is valid and has a length of at least 3 characters
    if (!(validatePassword(form.password.value))) {
        // if it is not a valid password, alert the user
        window.alert("password must contain 8 or more characters. Password must contain at least one number, one uppercase letter, and one lowercase letter");
        form.password.style.background = bgcolor;
        valid_form = false;
    } else {
        form.password.style.background = orignalbgcolor;
    }

}

// The function that validates a given username
function validateUserName(x) {
    // the regular expression to be used to validate the username
    rexp = /^[a-zA-Z\s0-9]*$/;

    // if the username is valid, return true
    if (rexp.test(x)) {
        return true;
    } else {
        return false;
    }
}

// The function that validates a given password
function validatePassword(x) {
    // the regular expression to be used to validate the password
    rexp = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{3,}/;

    // if the password is valid, return true
    if (rexp.test(x)) {
        return true;
    } else {
        return false;
    }

}