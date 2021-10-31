// Initialize and add the map
function initMap() {

	// Hardcoded the location of three museums in latitude and longitude respectively
	var aga = { lat: 43.726, lng: -79.332 };
	var bata = { lat: 43.667, lng: -79.400 };
	var canoe = { lat: 44.288, lng: -78.330 };

	// Create a map centered at Aga Khan Museum location
	var map = new google.maps.Map(document.getElementById("map"), {
		// Specify zoom level
		zoom: 8,
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

	// Create markers positioned at each museum respectively
	var marker1 = new google.maps.Marker({
		position: aga,
		map: map,
	});
	var marker2 = new google.maps.Marker({
		position: bata,
		map: map,
	});
	var marker3 = new google.maps.Marker({
		position: canoe,
		map: map,
	});

	// Aga Khan Museum Info Window content
	var aga_info = '<div id="content">' + 
		'<h1 id="firstHeading" class="firstHeading">Aga Khan Museum</h1>' +
		'<div id="bodyContent">' + 
		'<p>A museum of Islamic art, Iranian art and Muslim culture</p>' +
		'<p>Located at 77 Wynford Drive, Toronto, ON</p>' +
		'<p>Rated 4.6<i class="material-icons" style="font-size:16px;">star</i></p>' +
		'<a href="./individual_sample.html">Learn More</a>' + 
		'</div>' +
		'</div>'
	;
	// Bata Shoe Museum Info Window content
	var bata_info = '<div id="content">' + 
		'<h1 id="firstHeading" class="firstHeading">Bata Shoe Museum</h1>' +
		'<div id="bodyContent">' + 
		'<p>A museum of footwear and calceology</p>' +
		'<p>Located at 327 Bloor St W, Toronto, ON</p>' +
		'<p>Rated 4.3<i class="material-icons" style="font-size:16px;">star</i></p>' +
		'<a href="./individual_sample.html">Learn More</a>' + 
		'</div>' +
		'</div>'
	;
	// Canadian Canoe Museum Info Window content
	var canoe_info = '<div id="content">' + 
		'<h1 id="firstHeading" class="firstHeading">Canadian Canoe Museum</h1>' +
		'<div id="bodyContent">' + 
		'<p>A museum dedicated to canoes</p>' +
		'<p>Located at 910 Monaghan Rd, Peterborough, ON</p>' +
		'<p>Rated 4.1<i class="material-icons" style="font-size:16px;">star</i></p>' +
		'<a href="./individual_sample.html">Learn More</a>' + 
		'</div>' +
		'</div>'
	;

	// Create InfoWindows for each museum
	var aga_info_window = new google.maps.InfoWindow({
		content: aga_info
	});
	var bata_info_window = new google.maps.InfoWindow({
		content: bata_info
	});
	var canoe_info_window = new google.maps.InfoWindow({
		content: canoe_info
	});

	// Create click listeners for all markers so that when users click a marker, a label appears
	marker1.addListener('click', function() {
		aga_info_window.open(map, marker1);
	});
	marker2.addListener('click', function() {
		bata_info_window.open(map, marker2);
	});
	marker3.addListener('click', function() {
		canoe_info_window.open(map, marker3);
	});

}
