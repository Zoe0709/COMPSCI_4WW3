<?php

// Request method must be post
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection, please note this file resides on the server only
    require '../db_connection.php';
    session_start();
    // Get values
    $reviewRating = $_POST['review-rating'];
    $reviewDesp = $_POST['review-desp'];
    $musId = $_POST['museum-id'];
    $musName = $_POST['museum-name'];
    $username = $_SESSION['username'];
    $userId = $_SESSION['userId'];




    // check if the user is logged in
    if (isset($_SESSION['signedin'])) {
        // if the user is not logged in, then notify them
        if($_SESSION['signedin'] != true){
            header("location: ../../notify.php?head=Log In Required&body=Only logged in users can submit reviews.");
            exit();
        }
            
    }
    // if the user is not logged in, then notify them
    else{
        header("location: ../../notify.php?head=Log In Required&body=Only logged in users can submit reviews.");
        exit();

    }

    // data validation
    if (empty($reviewRating) || empty($musId)) {
        echo '<h2 class="error">Please fill all the required field.</h2>';
    }       
    else if (empty($username)) {
        echo '<h2 class="error">Please log in to continue.</h2>';
    }     
    // If not empty
    else {
        // Query to get review ids
        $sql = "SELECT re_id FROM reviews WHERE user_id = ? AND mus_id = ?";
        $stmt = $conn -> prepare($sql);
        if (!($stmt)) {
            echo '<h2 class="error">Sorry, something about DB went wrong.</h2>';
        } else {
            // Bind user id and museum id parameter into query
            $stmt -> bindParam(1, $userId);
            $stmt -> bindParam(2, $musId);
            // Execute sql query
            $stmt -> execute();
            // Bind result variable
            $stmt -> bindColumn('re_id', $reviewId);
            // Check if reviews from the same user exist
            if ($stmt -> rowCount() > 0) {
                // If yes, then the user has already reviewed the this museum
                header("location: ../notify.php?head=Failed Review&body=You have already reviewed this museum.");
            }
            // No review found with museum id
            else {
                // Save review to DB
                $sql = "INSERT INTO reviews (mus_id, user_id, re_username, re_rate, re_desp) VALUES (?, ?, ?, ?, ?)";
                $stmt = $conn -> prepare($sql);

                // Execute sql statement with positional parameters to insert the data
                $stmt -> execute([$musId, $userId, $username, $reviewRating, $reviewDesp]);
                header("location: ../notify.php?head=Successful Review&body=Thank you for submitting a review.");
            
            }
        }
    }
    // Close the connection
    $conn = null;
}
// If access is not from review submit
else {
    echo '<h2 class="error">Unauthorized access!</h2>';
}