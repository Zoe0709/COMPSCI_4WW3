<?php include 'php/header.php' ?>

<body>

    <!-- Page header to contain the navigation bar -->
    <?php include 'php/navbar.inc.php' ?>
<!-- Retrieve data from database -->
<?php
    if(isset($_GET['get-mus'])){
        // Database connection
        require 'php/db_connection.php';
        // Get result museum id
        $musId = $_GET['id'];
        // Empty result check
        if(empty($musId)){
            echo '<p class="notFound">Sorry, museum table is empty.</p>';
            require "php/footer.inc.php";
            exit();
        }
        // If result is not empty
        else{
            // Query to get data from database
            $sql = "SELECT mus_id, mus_name, lat, lon, avg_rate, mus_addr, mus_desp, img, vid FROM museums WHERE mus_id = ?";
            // Prepare
            $stmt = $conn -> prepare($sql);
            if(!($stmt)){
                echo '<p class="notFound">Sorry, something about DB went wrong.</p>';
                require "php/footer.inc.php";
                exit();
            }
            else{
                // Execute the statement with positional parameter
                $stmt -> execute([$musId]);
                // Bind result variables
                $stmt->bindColumn('mus_id', $musId);
                $stmt->bindColumn('mus_name', $musName);
                $stmt->bindColumn('lat', $musLat);
                $stmt->bindColumn('lon', $musLong);
                $stmt->bindColumn('avg_rate', $avgRate);
                $stmt->bindColumn('mus_addr', $musAddr);
                $stmt->bindColumn('mus_desp', $musDesp);
                $stmt->bindColumn('img', $musImg);
                $stmt->bindColumn('vid', $musVid);
                // Get the number of eligible museums
                $rowNum = $stmt -> rowCount();
                // Check if eligible museums exist
                if ($rowNum > 0) {
                    // Fetch values
                    while ($row = $stmt -> fetch(PDO::FETCH_OBJ)) {
                        // Get the museum reviews
                        $sql_review = "SELECT re_id, re_rate, re_desp, re_username FROM reviews
                                INNER JOIN museums ON reviews.mus_id = museums.mus_id
                                INNER JOIN users ON reviews.user_id = users.user_id
                                WHERE museums.mus_id = ? ORDER BY reviews.re_rate DESC";
                        $stmt_review = $conn -> prepare($sql_review);
                        if (!($stmt_review)) {
                            echo '<p class="notFound">Sorry, something about DB went wrong.</p>';
                            require "php/footer.inc.php";
                            exit();
                        } else {
                            // Bind parameter into query
                            $stmt_review -> bindParam(1, $musId);
                            // Execute the query
                            $stmt_review -> execute();
                            // Bind result variables
                            $stmt_review->bindColumn('re_id', $reviewId);
                            $stmt_review->bindColumn('re_rate', $reviewRating);
                            $stmt_review->bindColumn('re_desp', $reviewDesp);
                            $stmt_review->bindColumn('re_username', $reviewUsername);
                        }
                    }
                }
                // Nothing found with museum id
                else{
                    echo '<p class="notFound">The museum you are looking for does not exist.</p>';
                    require "php/footer.inc.php";
                    exit();
                }
            }
        }
    } else {
        // If access individual sample page directly through link
        echo '<p class="notFound">Unauthorized access.</p><br/>';
        require "php/footer.inc.php";
        exit();
    }
?>

<!-- Main content of the page -->

<main class='main-section'>
        <div class='content'>

            <!-- Header that indicates content of this page -->
            <h1 class='heading'>Museum Infomation</h1>

            <!-- Embed a map using Google Map API -->
            <div id="map" style="height: 450px;width: 100%;"></div>
            <!-- Load the Maps JavaScript API -->
            <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyARy_62bIYsiS3Ossb4DN8C-Dso2qq0RM0&callback=initMap"></script>
            <!-- JavaScript for map initialization -->
            <script type='text/javascript'>
                function initMap() {
                    // Convert museum latitude and longitude to JavaScript variables
                    var myLat = "<?php echo $musLat; ?>";
                    var myLong = "<?php echo $musLong; ?>";
                    var theMus = new google.maps.LatLng(myLat, myLong);
                    // Initialize the google map
                    var map = new google.maps.Map(document.getElementById("map"), {
                        // Specify zoom level
                        zoom: 14,
                        center: theMus,
                    });
                    // Create a marker positioned at the museum
                    var marker = new google.maps.Marker({
                        position: theMus,
                        map: map,
                    });
                    // Museum info window content
                    var mus_info = '<div id="content">' +
                        '<h1 id="firstHeading" class="firstHeading"><?php echo $musName; ?></h1>' +
                        '<div id="bodyContent">' +
                        '<p>Rated <?php echo $avgRate; ?><i class="material-icons" style="font-size:16px;">star</i></p>' +
                        '</div>' +
                        '</div>'
                    ;
                    // Museum info window
                    var musinfo_window = new google.maps.InfoWindow({
                        content: mus_info
                    });
                    // info window listener
                    marker.addListener('click', function() {
                        musinfo_window.open(map, marker);
                    });
                }
            </script>

            <!-- The sample video of museum -->
            <p><video style="float:right;width:50%;margin-top:5em;" controls>
                    <source src="../img/AgaKhanM.mp4" type="video/mp4">
                </video>

                <!-- Detailed information of museum -->
                <div class='museum-info animate__animated animate__fadeIn' itemscope itemtype="http://schema.org/Place">

                    <!-- Name of museum -->
                    <h2 itemprop="name" class='heading'><?php echo $musName; ?></h2>
                    <!-- Rating -->
                    <p itemprop="aggregateRating" class='subheading-t'>Average Rating: </p>
                    <p itemprop="aggregateRating" class='subheading-p'><?php echo $avgRate; ?><i class="material-icons">star</i></p>
                    <!-- Address of museum -->
                    <p itemprop="address" class='subheading-t'>Address: </p>
                    <p itemprop="address" class='subheading-p'><?php echo $musAddr; ?></p>
                    <!-- Brief description of museum -->
                    <p itemprop="description" class='subheading-t'>Description: </p>
                    <p itemprop="description" class='subheading-p'>
                        <?php if (!empty($musDesp))
                                echo $musDesp;
                            else
                                echo 'N/A';
                        ?>
                    </p>
                </div>
            </p>
        </div>

        <!-- Display all reviews of the museum -->
        <div style="clear:both;" class='content animate__animated animate__fadeIn animate__delay-1s'>
            <h1 class='heading'>All Reviews</h1>

            <ul style="margin-bottom: 80px;color:#fff;text-shadow: #000 0px 0px 1px;" class='result-table center animate__animated animate__fadeIn'>
            
                <?php                         
                    // Check if eligible museums exist
                    if($stmt_review -> rowCount() > 0){
                        // Fetch values
                        while ($row = $stmt_review -> fetch(PDO::FETCH_OBJ)) {
                            // Content displayed
                            echo '<li>
                                    <div itemprop="review" itemscope itemtype="http://schema.org/Review" >
                                        <meta itemprop="name" content='.$musName.' />
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
                    // No review found with museum id
                    else{
                        echo '<li>
                        <p class="success" id="hideWithNewReview">This museum does not have any reviews.</p>
                        </li>';
                    }
                
                ?>
            </ul>
        </div>

        <input type="hidden" id="sessionUsername" style="display:none" 
            value="<?php if (isset($_SESSION['username'])){
                echo $_SESSION['username'];} 
                else{
                    echo NULL;
                }?>"/>

        <div style="clear:both;" class='content animate__animated animate__fadeIn animate__delay-1s'>

            <!-- The header of the page -->
            <h1 class='heading'>Leave a Review</h1>

            <!-- <span class="error" id='showLoginError'>Please log in to write a review!
                <br/>
                Redirecting to log in page...
            </span> -->

            <!-- The form that will take the review information from the user -->
            <form class="wrapper" name="review-form" id="myReview" method="post" action="php/inc/review.inc.php">

                <div class="form">
                    <input value="" name="review-submit" hidden/>
                    <input value="<?php echo $musId; ?>" name="museum-id" hidden/>
                    <input value="<?php echo $musName; ?>" name="museum-name" hidden/>

                    <!-- The tittle for the form -->
                    <div class="title">
                        Review and Rating
                    </div>

                    <!-- Rating selection -->
                    <div class="inputfield">
                        <label>Rating:</label>

                        <!-- Drop down box for museum rating -->
                        <div class="custom_select" name='rating'>

                            <!-- Five options to select -->
                            <select name="review-rating" id="reviewRating">
                                <option value="5">5 stars</option>
                                <option value="4">4 stars</option>
                                <option value="3">3 stars</option>
                                <option value="2">2 stars</option>
                                <option value="1">1 star</option>
                            </select>
                        </div>

                    </div>

                    <!-- A brief comment of the museum -->
                    <div class="inputfield">
                        <label>Museum Review:</label>
                        <textarea class="textarea" name="review-desp" placeholder='Description (max 500 charcters)' maxlength="200"></textarea>
                    </div>

                    <!-- The submit button -->
                    <div class="inputfield">
                        <input type="submit" value="Submit" class="btn" onclick="newReviewHandler()">
                    </div>
                </div>
            </form>
        </div>

        <!-- Add-on Task 2.2 of Part 1 -->
        <div class="animate__animated animate__fadeIn animate__delay-1s">
            <p class='subheading-t'>Add-on Task 2.2 of Part 1: Use the HTML5 picture and source tags to provide images customized to the screen size.</p>
            <p class='subheading-p'>Image displaying below differs when screen size changes.</p>
            <!-- picture and source tag part -->
            <picture>
                <!-- When screen width >= 800px, image aga_khan shows up -->
                <source type="image/webp" media="(min-width: 800px)" srcset="../img/aga_khan.webp">
                <source media="(min-width: 800px)" srcset="../img/aga_khan.jpeg">
                <!-- When screen width >= 450px, image aga_khan2 shows up -->
                <source type="image/webp" media="(min-width: 450px)" srcset="../img/aga_khan2.webp">
                <source media="(min-width: 450px)" srcset="../img/aga_khan2.jpeg">
                <!-- When screen width < 450px, image aga_khan3 shows up -->
                <img src="../img/aga_khan3.jpeg" alt="Aga Khan Museum Outlook" style="width:auto;">
            </picture>
        </div>
    </main>
</body>



<?php include 'php/footer.inc.php' ?>
