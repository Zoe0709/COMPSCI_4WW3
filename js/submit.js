// Gets user's current location, if supported by their browser
function getLocation() {
    if (navigator.geolocation) {
        // Get current position, send it to the getResults function
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
    // retrieved in getLocation()
    long.value = position.coords.longitude;
    lat.value = position.coords.latitude;
}
// fall back js validation
function validate(form) {
    valid_form = true;
    orignalbgcolor = "white";
    bgcolor = "#b38f8f";


    if (!(validateName(form.musName.value))) {
        window.alert("incorrect name, can only contain letters, white space, or numbers");
        form.musName.style.backgroundColor = bgcolor;
        return false;
    } else {
        form.musName.style.backgroundColor = orignalbgcolor;
    }

    if (!(validateLocation(form.musCountry.value))) {
        window.alert("incorrect country name, can only contain letters or white space");
        form.musCountry.style.backgroundColor = bgcolor;
        return false;
    } else {
        form.musCountry.style.backgroundColor = orignalbgcolor;
    }

    if (!(validateLocation(form.musCity.value))) {
        window.alert("incorrect city name, can only contain letters or white space");
        form.musCity.style.backgroundColor = bgcolor;
        return false;
    } else {
        form.musCity.style.backgroundColor = orignalbgcolor;
    }

    if ((!(validatePostalCode(form.musPostal.value))) && (form.musPostal.length > 0)) {
        window.alert("incorrect postal code, can only contain letters or digits");
        form.musPostal.style.backgroundColor = bgcolor;
        return false;
    } else {
        form.musPostal.style.backgroundColor = orignalbgcolor;
    }
    return valid_form;

}

function validateName(x) {
    rexp = /^[a-zA-Z\s0-9]*$/;
    if (rexp.test(x)) {
        return true;
    } else {
        return false;
    }
}

function validateLocation(x) {
    rexp = /^[a-zA-Z\s]*$/;
    if (rexp.test(x)) {
        return true;
    } else {
        return false;
    }
}

function validatePostalCode(x) {
    rexp = /^[A-Za-z]\d[A-Za-z]\d[A-Za-z]\d$/;
    if (rexp.test(x)) {
        return true;
    } else {
        return false;
    }
}