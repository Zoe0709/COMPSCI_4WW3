<?php

// Search by location
if (isset($_POST['location-submit'])) {
    // Database connection
    require '../db_connection.php';
    // Get latitude and longitude from the search page form
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $maxLat = $latitude + 0.1;
    $minLat = $latitude - 0.1;
    $maxLong = $longitude + 0.1;
    $minLong = $longitude - 0.1;

    // Empty search field check
    // If empty
    if (empty($latitude) || empty($longitude)) {
        header("Location: ../search.php?error=emptyfield");
        exit();
    }
    // If not empty
    else {
        // Search between +- 0.1 latitude and longitude
        $sql = "SELECT mus_id FROM museums WHERE lat BETWEEN ? AND ? AND lon BETWEEN ? AND ?";
        if(!($stmt = $conn -> prepare($sql))){
            header("Location: ../search.php?error=sqlerror");
            exit();
        }
        else {
            // Execute the statement with positional parameters
            $stmt -> execute([$minLat, $maxLat, $minLong, $maxLong]);
            fetchResult($stmt);
        }
    }
    // Close the connection
    $conn = null;
}

// Search by name
else if (isset($_POST['name-submit'])) {
    // Database connection
    require '../db_connection.php';
    // Get name keyword from the search page form
    $musName = $_POST['musName'];

    // Empty search field check
    // If empty
    if (empty($musName)) {
        header("Location: ../search.php?error=emptyfield");
        exit();
    }    
    // If not empty
    else {
        // Get all museum ids that the corresponding museum name is similar to user input
        $sql = "SELECT mus_id FROM museums WHERE mus_name LIKE ?";
        if(!($stmt = $conn -> prepare($sql))){
            header("Location: ../search.php?error=sqlerror");
            exit();
        }
        else {
            // Prepare parameter for LIKE search
            $param = '%'.$musName.'%';
            // Execute the statement with positional parameters 
            $stmt -> execute([$param]);
            fetchResult($stmt);
        }

    }
    // Close the connection
    $conn = null;

}

// Search by rating
else if (isset($_POST['rating-submit'])) {
    // Database connection
    require '../db_connection.php';
    // Get museum rating from the search page form
    $musRating = $_POST['selectrating'];
    // Ratings might not be round numbers so an upper bound is required 
    $maxRating = $musRating + 1;

    // Empty search field check
    // If empty
    if (empty($musRating)) {
        header("Location: ../search.php?error=emptyfield");
        exit();
    }    
    // If not empty
    else {
        // Search museum ids that the corresponding museum rating is in the certain range
        $sql = "SELECT mus_id FROM museums WHERE avg_rate < ? AND avg_rate >= ?";
        if (!($stmt = $conn -> prepare($sql))) {
            header("Location: ../search.php?error=sqlerror");
            exit();
        }
        else {
            // Execute the statement with positional parameters 
            $stmt -> execute([$maxRating, $musRating]);
            fetchResult($stmt);
        }

    }
    // Close the connection
    $conn = null;
}

// If the request coming from outside of the login page form
else {
    header("Location: ../index.php");
    exit();
}

// Count rows and do fetch for results sample page
function fetchResult($stmt) {
    // Get the number of eligible museums
    $rowNum = $stmt -> rowCount();
    // Check if eligible museums exist
    if ($rowNum > 0) {
        $musIds = NULL;
        // Fetch museum ids
        while ($row = $stmt -> fetch(PDO::FETCH_OBJ)) {
            $musIds = $musIds . $row -> mus_id . ",";
        }
        // Remove the last comma
        $musIds = rtrim($musIds, ", ");
        header("Location: ../results_sample.php?get-results&result=".$musIds);
        exit();
    }
    // If no museum found with user input
    else {
        header("Location: ../search.php?error=nothingfound");
        exit();
    }
}

