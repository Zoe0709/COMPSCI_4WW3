// Gets user's current location, if supported by their browser
function getLocation() {
    if (navigator.geolocation) {
        // Get current position, send it to the getResults function
        navigator.geolocation.getCurrentPosition(showPosition);
        //window.location.href = "./results_sample.html";
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