// Gets user's current location, if supported by their browser
function getLocation() {
    if (navigator.geolocation) {
        // Get current position, send it to the showPosition function
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        // If not supported by browser, send an alert to their screen
        alert('Geolocation is not supported.');
    }
}

// Handles the position retrieved in getLocation()
function showPosition(position) {
    // Get long and latitude input boxes from html
    var long = document.getElementById('longitude');
    var lat = document.getElementById('latitude');

    // Change values in long/lat boxes to the position
    // retrieved in getLocation(), accurate to 3 decimal places
    long.value = Math.round(position.coords.longitude * 1000) / 1000;
    lat.value = Math.round(position.coords.latitude * 1000) / 1000;
}
// js function for validation
function validate(form) {
    // variable that holds the validity of the form
    valid_form = true;
    orignalbgcolor = "white";
    bgcolor = "#b38f8f";

    // check if the provided museum name is valid
    if (!(validateName(form.musName.value))) {
        // if the museum name is not valid alert the user
        window.alert("incorrect name, can only contain letters, white space, or numbers");
        form.musName.style.backgroundColor = bgcolor;
        return false;
    } else {
        form.musName.style.backgroundColor = orignalbgcolor;
    }

    // check if the provided name of the country is possible/ valid
    if (!(validateLocation(form.musCountry.value))) {
        // if the country name is not valid alert the user
        window.alert("incorrect country name, can only contain letters or white space");
        form.musCountry.style.backgroundColor = bgcolor;
        return false;
    } else {
        form.musCountry.style.backgroundColor = orignalbgcolor;
    }

    // check if the provided name of the city is possible/ valid
    if (!(validateLocation(form.musCity.value))) {
        // if the city name is not valid alert the user
        window.alert("incorrect city name, can only contain letters or white space");
        form.musCity.style.backgroundColor = bgcolor;
        return false;
    } else {
        form.musCity.style.backgroundColor = orignalbgcolor;
    }

    // check if the postal code is valid
    if ((!(validatePostalCode(form.musPostal.value))) && (form.musPostal.length > 0)) {
        // if the postal code is not valid alert the
        window.alert("incorrect postal code, can only contain letters or digits");
        form.musPostal.style.backgroundColor = bgcolor;
        return false;
    } else {
        form.musPostal.style.backgroundColor = orignalbgcolor;
    }
    return valid_form;

}

// The function that validates a given museum name
function validateName(x) {
    // the regular expression to be used to validate the name
    rexp = /^[a-zA-Z\s0-9]*$/;

    // if the name is indeed valid, return true
    if (rexp.test(x)) {
        return true;
    } else {
        return false;
    }
}

// The function that validates a given country or city
function validateLocation(x) {
    // the regular expression to be used to validate the location
    rexp = /^[a-zA-Z\s]*$/;

    // if the name is valid, return true
    if (rexp.test(x)) {
        return true;
    } else {
        return false;
    }
}

// The function that validates the postal code
function validatePostalCode(x) {
    // the regular expression to be used to validate the code
    rexp = /^[A-Za-z]\d[A-Za-z]\d[A-Za-z]\d$/;

    // if the code is valid, return true
    if (rexp.test(x)) {
        return true;
    } else {
        return false;
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