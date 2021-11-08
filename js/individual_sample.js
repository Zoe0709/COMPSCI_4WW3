// Initialize and add the map
function initMap() {

	// Hardcoded the location of Aga Khan Museum in latitude and longitude 
	var aga = { lat: 43.726, lng: -79.332 };

	// Create a map centered at Aga Khan Museum location
	var map = new google.maps.Map(document.getElementById("map"), {
		// Specify zoom level
		zoom: 14,
		center: aga,
		// Restrict the map to a particular lat and long bounds
		restriction: {
		    latLngBounds: {
				north: 60,
				south: 20,
				east: -60,
				west: -100,
		    },
		},
	});

	// Create a marker positioned at the museum 
	var marker = new google.maps.Marker({
		position: aga,
		map: map,
	});
	
	// Aga Khan Museum Info Window content
	var aga_info = '<div id="content">' + 
		'<h1 id="firstHeading" class="firstHeading">Aga Khan Museum</h1>' +
		'<div id="bodyContent">' + 
		'<p>A museum of Islamic art, Iranian art and Muslim culture</p>' +
		'<p>Rated 4.6<i class="material-icons" style="font-size:16px;">star</i></p>' + 
		'</div>' +
		'</div>'
	;

	// Create InfoWindows for the museum
	var aga_info_window = new google.maps.InfoWindow({
		content: aga_info
	});

	// Create a click listener for the marker so that when users click it, a label appears
	marker.addListener('click', function() {
		aga_info_window.open(map, marker);
	});
	
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






