<?php

if (isset($_POST['review-submit'])) {
    // Database connection
    require '../db_connection.php';
    session_start();
    // Get values
    $reviewRating = $_POST['review-rating'];
    $reviewDesp = $_POST['review-desp'];
    $musId = $_POST['museum-id'];
    $musName = $_POST['museum-name'];
    $username = $_SESSION['username'];
    $userId = $_SESSION['userId'];

    // Check if empty
    if (empty($reviewRating) || empty($musId)) {
        echo '<h2 class="error">Please fill all the required field.</h2>';
    }       
    else if (empty($username) || empty($userId)) {
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
                echo '<h2 class="error">You\'ve already reviewed this museum.</h2>';
            }
            // No review found with museum id
            else {
                // Save review to DB
                $sql = "INSERT INTO reviews (mus_id, user_id, re_username, re_rate, re_desp) VALUES (?, ?, ?, ?, ?)";
                $stmt = $conn -> prepare($sql);
                if (!($stmt)) {
                    echo '<h2 class="error">Sorry, something about DB went wrong.</h2>';
                }
                else {
                    // Execute sql statement with positional parameters
                    $stmt -> execute([$musId, $userId, $username, $reviewRating, $reviewDesp]);
                    if ($stmt -> rowCount() > 0) {
                        echo '<h2 class="error">Sorry, something about DB went wrong.</h2>';
                    } else {
                        // Review the museum successfully
                        echo '<li class="result-table center animate__animated animate__fadeIn">
                                <div itemscope itemtype="http://schema.org/Review">
                                    <p>
                                        <h2 itemprop="author">'.$reviewUsername.'</h2>
                                        <h3 itemprop="reviewRating">Rating: '.$reviewRating.'<i class="material-icons">star</i></h3>
                                    </p>
                                    <div><h4 itemprop="reviewBody">'.$reviewDesp.'</h4></div>
                                </div>
                            </li>
                            <!--Line between each review-->
                            <hr>';
                    }
                }
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