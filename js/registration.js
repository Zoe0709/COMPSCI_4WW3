// js function for validation
function validatereg(form) {

    valid_form = true;
    orignalbgcolor = "white";
    bgcolor = "#b38f8f";

    // check if the provided first name is valid
    if (!(validateName(form.firstname.value))) {
        // if it is not a valid first name, alert the user
        window.alert("incorrect name, can only contain letters or white space");
        form.firstname.style.backgroundColor = bgcolor;
        valid_form = false;
    } else {
        form.firstname.style.backgroundColor = orignalbgcolor;
    }

    // check if the provided last name is valid
    if (!(validateName(form.lastname.value))) {
        // if it is not a valid last name, alert the user
        window.alert("incorrect name, can only contain letters or white space");
        form.lastname.style.background = bgcolor;
        valid_form = false;
    } else {
        form.lastname.style.background = orignalbgcolor;
    }

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

    // check if the provided email is valid
    if (!(validateEmail(form.email.value))) {
        // if it is not a valid email, alert the user
        window.alert("Email has an incorrect form, please check again.");
        form.email.style.background = bgcolor;
        valid_form = false;
    } else {
        form.email.style.background = orignalbgcolor;
    }

    // check if the user agrees to the terms and conditions
    if (!form.terms.checked) {
        // Alert the user to agree to the terms and conditions
        window.alert("You need to agree to the terms and conditions");
        valid_form = false;
    }
    return valid_form;

}

// The function that validates a given firstname or lastname
function validateName(x) {
    // the regular expression to be used to validate the name
    rexp = /^[a-zA-Z\s]*$/;

    // if the name is indeed valid, return true
    if (rexp.test(x)) {
        return true;
    } else {
        return false;
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

// The function that validates a given email
function validateEmail(x) {
    // validate if the email is valid using a regular expression
    if (!(/^[^@]+@[^@]+\.[a-zA-Z]{2,}$/.test(x))) {
        return false;
    } else {
        return true;
    }
}


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