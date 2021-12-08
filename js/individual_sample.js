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

// AJAX post and showing the new review
function newReviewHandler() {
	var rating = $("#reviewRating").val();
	// Check if user selected the rating
	if (rating == "") {
		return;
	}
  
	// jQuery request variable
	var request;
  
	// Get review form and bind it
	$("#reviewForm").submit(function(event) {
		// Not default form --> error check
		event.preventDefault();

		// Abort any pending request
		if (request) {
			request.abort();
		}
  
		// Get form data and assign it to form variable
		var $form = $(this);

		// Get all fields and button for disabiling
		var $inputs = $form.find("input, textarea, select, button");

		// Serialize the data in the form
		var serializedData = $form.serialize();

		// Disable all fields during AJAX request
		$inputs.prop("disabled", true);

		// Send request to server w/ seriliazed data
		request = $.ajax({
			url: "inc/review.inc.php",
			type: "post",
			data: serializedData
		});
  
		// Get server's response and handle it
		request.done(function(response, textStatus, jqXHR) {
			// Success response
			if (textStatus == "success") {
				// Hide "no review" text
				$("#hideWithNewReview").hide(1);
				// Error while inserting to DB
				if (response[2] == "h") {
					$("#newReviewError").show(1);
					$("#newReviewError").html(response);
				}
				// Succesfully inserted into DB
				else {
					$("#usersNewReview").show(1);
					$("#usersNewReview").html(response);
				}
			}
			// Response error
			else {
				$("#newReviewError").show(1);
				$("#newReviewError").html('<p class="error">AJAX error!</p>');
			}
		});
  
		// Server failure response
		request.fail(function(jqXHR, textStatus, errorThrown) {
			console.error("AJAX error: " + textStatus, errorThrown);
			$("#newReviewError").show(1);
			$("#newReviewError").html('<p class="error">AJAX error!</p>');
		});

		// Always promise --> success or fail
		request.always(function() {
			// Reenable the inputs
			$inputs.prop("disabled", false);
			// Fide new review submission form
			hideNewReview();
		});
	});
  }

// Show new review div and cancel button
function showNewReview() {
	// Get session username
	var sessionUsername = $("#sessionUsername").val();
	// Check if user logged in
	if (sessionUsername !== "") {
		$(".newReview").show(1);
		$("#hideButton").show(1);
		$("#showLoginError").hide(1);
	} else {
		$("#showLoginError").show(1);
		// Not logged in --> Redirect to login page in 2 sec
		setTimeout(function() {
			window.location.href = "login.php";
		}, 2000);
	}
}
// Hide new review div and cancel button
function hideNewReview() {
	$(".newReview").hide(1);
	$("#hideButton").hide(1);
	$("#showLoginError").hide(1);
}


