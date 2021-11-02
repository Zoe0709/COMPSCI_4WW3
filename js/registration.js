function validatereg(form) {

    valid_form = true;
    orignalbgcolor = "white";
    bgcolor = "#b38f8f";

    if (!(validateName(form.firstname.value))) {
        window.alert("incorrect name, can only contain letters or white space");
        form.firstname.style.backgroundColor = bgcolor;
        valid_form = false;
    } else {
        form.firstname.style.backgroundColor = orignalbgcolor;
    }

    if (!(validateName(form.lastname.value))) {
        window.alert("incorrect name, can only contain letters or white space");
        form.lastname.style.background = bgcolor;
        valid_form = false;
    } else {
        form.lastname.style.background = orignalbgcolor;
    }

    if (!(validateUserName(form.username.value))) {
        window.alert("incorrect username, can only contain letters, white space, or numbers");
        form.username.style.background = bgcolor;
        valid_form = false;
    } else {
        form.username.style.background = orignalbgcolor;
    }

    if (!(validatePassword(form.password.value))) {
        window.alert("password must contain at least 8 characters");
        form.password.style.background = bgcolor;
        valid_form = false;
    } else {
        form.password.style.background = orignalbgcolor;
    }


    if (!(validateEmail(form.email.value))) {
        window.alert("Email has an incorrect form, please check again.");
        form.email.style.background = bgcolor;
        valid_form = false;
    } else {
        form.email.style.background = orignalbgcolor;
    }

    if (!form.terms.checked) {
        window.alert("You need to agree to the terms and conditions");
        valid_form = false;
    }
    return valid_form;

}

function validateName(x) {
    rexp = /^[a-zA-Z\s]*$/;
    if (rexp.test(x)) {
        return true;
    } else {
        return false;
    }
}

function validateUserName(x) {
    rexp = /^[a-zA-Z\s0-9]*$/;
    if (rexp.test(x)) {
        return true;
    } else {
        return false;
    }
}

function validatePassword(x) {
    if (x.length < 8) {
        return false;
    } else {
        return true;
    }

}

function validateEmail(x) {
    if (!(/^[^@]+@[^@]+\.[a-zA-Z]{2,}$/.test(x))) {
        return false;
    } else {
        return true;
    }
}