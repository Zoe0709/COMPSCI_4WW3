// Gets user's current location, if supported by their browser
function getLocation() {
    if (navigator.geolocation) {
        // Get current position, and call showPosition function
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        // If not supported by browser, send an alert to their screen
        alert('Geolocation is not supported.');
    }
}

// Handles the position retrieved in getLocation()
function showPosition(position) {
    // Get longitude and latitude input boxes from html
    var long = document.getElementById('longitude');
    var lat = document.getElementById('latitude');

    // Change values in long/lat boxes to the position
    // retrieved in getLocation(), accurate to 3 decimal places
    long.value = Math.round(position.coords.longitude * 1000) / 1000;
    lat.value = Math.round(position.coords.latitude * 1000) / 1000;
}


// if the search button in the form that search BY LOCATION is clicked
function submitPosition() {
    valid_form = true;
    orignalbgcolor = "white";
    bgcolor = "#b38f8f";

    // set the colors for the musName to default
    // just in case it was clicked before
    var musName = document.getElementById('musName');
    musName.style.backgroundColor = orignalbgcolor;

    // Get long and latitude input boxes from html
    var long = document.getElementById('longitude');
    var lat = document.getElementById('latitude');

    // validate longitude
    if ((long.value.length == 0) || (!long.checkValidity())) {
        window.alert("Please insert a correct longitude accurate to 3 decimal places.");
        long.style.backgroundColor = bgcolor;
        valid_form = false;
    } else {
        long.style.backgroundColor = orignalbgcolor;
    }

    // validate latitude
    if ((lat.value.length == 0) || (!lat.checkValidity())) {
        window.alert("Please insert a correct latitude accurate to 3 decimal places.");
        lat.style.backgroundColor = bgcolor;
        valid_form = false;
    } else {
        lat.style.backgroundColor = orignalbgcolor;
    }

    // // if the entered values are valid, then the user can move to the results_sample page
    // if (valid_form) {
    //     window.location.href = "./results_sample.html";
    // }
}

// if the search button in the form that searches BY NAME is clicked
function submitName() {
    orignalbgcolor = "white";
    bgcolor = "#b38f8f";

    // set the colors for the longitude and latitude to default
    // just in case it was clicked before
    var long = document.getElementById('longitude');
    var lat = document.getElementById('latitude');
    long.style.backgroundColor = orignalbgcolor;
    lat.style.backgroundColor = orignalbgcolor;

    // Get musName input box from html
    var musName = document.getElementById('musName');

    // check if musName contains a correct name 
    if (!(validateName(musName.value))) {
        window.alert("Please insert a correct name. A museum name can only contain letters, white space, or numbers.");
        musName.style.backgroundColor = bgcolor;
        return false;
    } else if (!(ifOnlySpace(musName.value))) {
        window.alert("White space only is not allowed.");
        musName.style.backgroundColor = bgcolor;
        return false;
    } else {
        musName.style.backgroundColor = orignalbgcolor;
    }

    // if the function didn't return,
    // which means that the museum name is valid, 
    // move the user to the results_sample page
    // window.location.href = "./results_sample.html";

}

// The function that validates a given name
function validateName(x) {
    // the regular expression to be used to validate the name
    rexp = /^[a-zA-Z\s0-9]*$/;

    // if the name is indeed valid, return true
    if (rexp.test(x) && musName.value.length != 0) {
        return true;
    } else {
        return false;
    }
}

// The function that checks if input string only contains space
function ifOnlySpace(x) {
    // Use trim() to remove all whitespace from both sides of a string
    if (x.trim().length == 0) {
        return false;
    }
    else {
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