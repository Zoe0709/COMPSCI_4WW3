<?php include 'php/header.php' ?>

<body>

    <!-- Page header to contain the navigation bar -->
    <?php include 'php/navbar.inc.php' ?>
<!-- Main content of the page -->

    <main class='main-section'>
        <!-- Search errors -->
        <?php
            // Empty search field
            if(isset($_GET['error']) && $_GET['error'] == "emptyfield"){
                echo '<p class="error">Please fill the search field.</p>';
            }
            // SQL error
            else if(isset($_GET['error']) && $_GET['error'] == "sqlerror"){
                echo '<p class="notFound">Sorry, something about DB went wrong.</p>';
            }
            // Nothing found
            else if(isset($_GET['error']) && $_GET['error'] == "nothingfound"){
                echo '<p class="error">Sorry, we couldn\'t find any museums.</p>';
            }
        ?>

        <div class='content'>

            <!-- Header that indicates content of this page -->
            <h1 class='heading'>Search for Museums</h1>
            <fieldset class='formentry animate__animated animate__fadeIn'>

                <!-- Caption of the fieldset grouping -->
                <legend class='legend'>YOU CAN ...</legend>

                <!-- The form that will search and filter museums by location -->
                <div class="wrapper animate__animated animate__fadeIn animate__delay-1s">

                    <!-- The tittle for the form -->
                    <div class="title">
                        SEARCH BY LOCATION
                    </div>
                    <form class="form" name="location-search" id="locatSearch" action="php/inc/search.inc.php" method="POST">

                        <div class="inputfield">
                            <!-- The search button, click to jump to results sample page -->
                            <a class="btn" style="padding: 0;width: 40%;margin-left: 30%;" onclick="getLocation()">
                                <input type="submit" value="My Location" class="btn" onclick="getLocation()">
                                <p id="locationError" class="error"></p>
                            </a>
                        </div>
                        <div class="inputfield">
                            <!-- The input element that contains the longitude value -->
                            <input id='longitude' style="width: 60%;margin-left:7%;" type="number" step='0.001' name='longitude' placeholder='long (-90 ~ 90)' min='-90' max='90' class="input" value="<?php if(isset($_REQUEST['longitude'])) echo $_REQUEST['longitude'];?>">
                            <!-- The input element that contains the latitude value -->
                            <input id='latitude' style="width: 60%;margin-left: 7%;" type="number" step='0.001' name='latitude' placeholder='lat (-180 ~ 180)' min='-180' max='180' class="input" value="<?php if(isset($_REQUEST['latitude'])) echo $_REQUEST['latitude'];?>">

                        </div>
                        <div class="inputfield">
                            <!-- The search button, click to jump to results sample page -->
                            <a class="btn" style="padding: 0;width: 40%;margin-left: 30%;">
                                <input type="submit" name="location-submit" value="Search by location" class="btn" onclick="submitPosition()">
                            </a>
                        </div>
                    </form>
                </div>


                <!-- The form that will search and filter museums by name -->
                <div class="wrapper animate__animated animate__fadeIn animate__delay-2s">

                    <!-- The tittle for the form -->
                    <div class="title">
                        SEARCH BY NAME
                    </div>
                    <form class="form" name="name-search" action="php/inc/search.inc.php" method="POST">

                        <div class="inputfield">
                            <label>Name:</label>

                            <!-- Text box for museum name -->
                            <input type="text" name="musName" pattern="^[a-zA-Z\s0-9]*$" class="input" placeholder='Museum name here'>

                            <!-- The search button, click to jump to results sample page -->
                            <a class="btn" style="padding: 0;">
                                <input type="submit" name="name-submit" value="Search by name" class="btn" onclick="submitName()">
                            </a>
                        </div>
                    </form>
                </div>

                <!-- The form that will search and filter museums by rating -->
                <div class="wrapper animate__animated animate__fadeIn animate__delay-3s">

                    <!-- The tittle for the form -->
                    <div class="title">
                        SEARCH BY RATING
                    </div>

                    <form class="form" name="rate-search" action="php/inc/search.inc.php" method="POST">

                        <div class="inputfield">
                            <label>Rating:</label>

                            <!-- Drop down box for museum rating -->
                            <div class="custom_select" name='rating'>

                                <!-- Five options to select -->
                                <select name="selectrating">
                                    <option value="5">5 stars</option>
                                    <option value="4">4 stars</option>
                                    <option value="3">3 stars</option>
                                    <option value="2">2 stars</option>
                                    <option value="1">1 star</option>
                                </select>
                            </div>

                            <!-- The submit button, click to jump to results sample page -->
                            <a class="btn" style="padding: 0;">
                                <input type="submit" name="rating-submit" value="Search by rating" class="btn">
                            </a>

                        </div>
                    </form>
                </div>
            </fieldset>
        </div>
    </main>
</body>

<?php include 'php/footer.inc.php' ?>
