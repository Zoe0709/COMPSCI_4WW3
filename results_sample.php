<?php include 'php/header.php' ?>

<body>

    <!-- Page header to contain the navigation bar -->
    <?php include 'php/navbar.inc.php' ?>

<!-- Retrieve data from database -->
<?php
    if (isset($_GET['get-results'])) {
        // Database connection
        require 'php/db_connection.php';
        // Get result museum ids
        $searchResult = $_GET['result'];
        // Empty result check
        if (empty($searchResult)) {
            echo '<p class="notFound">Sorry, search result is empty.</p>'; 
            require "php/footer.inc.php";
            exit();
        }    
        // If result is not empty
        else {
            // Convert comma seperated string to array
            $musIdArray = explode(',', $searchResult);
            // Get array size
            $musIdArraySize = count($musIdArray);
            // Convert array to SQL IN array containing array size number of '?'
            $in = join(',', array_fill(0, $musIdArraySize, '?'));
            // Query WHERE mus_id IN ?, ?, ?, ?, ?, ?
            $sql = "SELECT mus_id, mus_name, lat, lon, avg_rate, mus_addr FROM museums WHERE mus_id IN (".$in.") ORDER BY mus_name";
            $stmt = $conn -> prepare($sql);
            if(!($stmt)){
                echo '<p class="notFound">Sorry, something about DB went wrong.</p>';
                require "php/footer.inc.php";
                exit();
            }
            else {
                // Bind parameters for execution 
                for ($x = 1; $x <= $musIdArraySize; $x++) {
                    $stmt->bindParam($x, $musIdArray[$x - 1]);
                }
                // Execute the statement
                $stmt -> execute();
                // Bind result variables
                $stmt->bindColumn('mus_id', $musId);
                $stmt->bindColumn('mus_name', $musName);
                $stmt->bindColumn('lat', $musLat);
                $stmt->bindColumn('lon', $musLong);
                $stmt->bindColumn('avg_rate', $avgRate);
                $stmt->bindColumn('mus_addr', $musAddr);
            }
        }
    }
    else {
        // If access results sample page directly through link
        echo '<p class="notFound" style="text-align: center;color: yellow;">Unauthorized access.</p>'; 
        require "php/footer.inc.php";
        exit();
    }
?>

<!-- Main content of the page -->

    <main class='main-section'>
        <div class='content'>

            <!-- Header that indicates content of this page -->
            <h1 class='heading'>Search Results</h1>

            <div class='result-container animate__animated animate__fadeIn'>

                <?php
                    // Get the number of eligible museums
                    $rowNum = $stmt -> rowCount();
                    // Check if eligible museums exist
                    if ($rowNum > 0) {
                        // Index variable i, museum name array musNameArr, museum coordinates array musLocArr
                        $i = 0;
                        $musNameArr = array();
                        $musLocArr = array();
                        // Fetch values
                        while ($row = $stmt -> fetch(PDO::FETCH_OBJ)) {
                            // Append name and coordinates to arrays
                            array_push($musNameArr, $musName);
                            array_push($musLocArr, array($musLat, $musLong));
                            // Text displayed
                            echo '<!-- Basic information of the museum -->
                                <div style="color:#fff;text-shadow: #000 0px 0px 1px;">
                                    <hr />
                                    <h2 id="musName'.$i.'">'.$musName.'</h2>
                                    <p>Rating: '.$avgRate.'<i class="material-icons" style="font-size: 20px;">star</i></p>
                                    <p>Address: '.$musAddr.'</p>
                                    <span id="latitude'.$i.'" hidden>'.$musLat.'</span>
                                    <span id="longitude'.$i.'" hidden>'.$musLong.'</span>
                                    <span id="musId'.$i.'" hidden>'.$musId.'</span>
                                    <!-- Link to individual page -->
                                    <a href="./individual_sample.php?get-mus&id='.$musId.'" style="color:#B68973">Detailed info</a>
                                    <hr />
                                </div>';
                            $i++;
                        }
                        // Map
                        echo '<div id="map" style="height: 450px;width: 100%;"></div>
                            <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyARy_62bIYsiS3Ossb4DN8C-Dso2qq0RM0&callback=initMap"></script>';
                    } else { // No museum found with user input
                        echo '<p class="notFound">We could not find a museum with your input.</p>'; 
                        require "php/footer.inc.php";
                        exit();
                    } 
                ?>
                <script type='text/javascript'>
                    // Convert php arrays to JavaScript arrays
                    var nameArr = <?php echo json_encode($musNameArr); ?>;
                    var locArr = <?php echo json_encode($musLocArr); ?>;
                    // Initialize the google map
                    function initMap() {
                        var map = new google.maps.Map(document.getElementById("map"), {
                            // Specify zoom level
                            zoom: 8,
                            center: {lat: 43.726, lng: -79.332},
                        });
                        // Loop to create all markers
                        for (i = 0; i < nameArr.length; i++) {
                            var musLocation = new google.maps.LatLng(locArr[i][0], locArr[i][1]);
                            addMarker(musLocation, nameArr[i], map);
                        }
                    }
                    // Create markers, info windows and listeners
                    function addMarker(location, name, map) {
                        var marker = new google.maps.Marker({
                            position: location,
                            map: map,
                        });
                        var mus_info = '<div id="content">' + 
                            '<h1 id="firstHeading" class="firstHeading">' + name + '</h1>' +
                            '</div>'
                        ;
                        var mus_info_window = new google.maps.InfoWindow({
                            content: mus_info
                        });
                        marker.addListener('click', function() {
                            mus_info_window.open(map, marker);
                        });
                    }
                </script>
            </div>
        </div>
    </main>
</body>

<?php include "php/footer.inc.php" ?>