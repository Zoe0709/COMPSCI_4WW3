<?php include 'php/header.php' ?>
<body>
    <!-- Page header to contain the navigation bar -->
    <?php include 'php/navbar.inc.php' ?>
    <!-- Main content of the page -->

    <main class='main-section'>
        <div class='content'>

            <!-- The header of the page -->
            <h1 class='heading'>Submit a New Museum</h1>

            <!-- The form that will take the information about the Museum
            (A temporary URI to submit the form information ) -->
            <form class="wrapper animate__animated animate__fadeIn" onsubmit="return validate(this)" method="post" action="submission_val.php">

                <!-- The form is divided into 2 parts -->
                <div class="form">

                    <!-- 
                        
                        Part 1 of the form (museum information)
                    
                        -->

                    <!-- The tittle for the first part in the form -->
                    <div class="title animate__animated animate__fadeIn animate__delay-1s">
                        Museum Info
                    </div>

                    <!-- **REQUIRED** The name of the museum **REQUIRED** -->
                    <div class="inputfield animate__animated animate__fadeIn animate__delay-2s">
                        <label>Museum Name *:</label>
                        <input type="text" pattern="^[a-zA-Z\s0-9]*$" class="input" name="musName" placeholder='Museum name here (letters, spaces, or numbers only)' required>
                    </div>

                    <!-- The country of the museum -->
                    <div class="inputfield animate__animated animate__fadeIn animate__delay-2s">
                        <label>Museum Country *:</label>
                        <input type="text" pattern="^[a-zA-Z\s]*$" class="input" name="musCountry" placeholder='Museum country here (letters or spaces only)' >
                    </div>

                    <!-- The city of the museum -->
                    <div class="inputfield animate__animated animate__fadeIn animate__delay-2s">
                        <label>Museum City *:</label>
                        <input type="text" pattern="^[a-zA-Z\s]*$" class="input" name="musCity" placeholder='Museum city here (letters or spaces only)' >
                    </div>

                    <!-- The open hours of the museum -->
                    <div class="inputfield animate__animated animate__fadeIn animate__delay-2s">
                        <label>Museum Postal Code:</label>
                        <input type="text" pattern="^[A-Za-z]\d[A-Za-z]\d[A-Za-z]\d$" class="input" name="musPostal" placeholder='Postal code here (canadian postal code format)'>
                    </div>


                    <!-- A brief description the museum -->
                    <div class="inputfield animate__animated animate__fadeIn animate__delay-3s">
                        <label>Museum Description:</label>

                        <!--
                            we are going to use textarea instead as it makes the description box look better 
                            <input type="text" class="input" placeholder='Museum description here'> 
                        -->
                        <textarea class="textarea" name="musDesc" placeholder='Description (max 200 charcters)' maxlength="200"></textarea>
                    </div>


                    <div class="inputfield animate__animated animate__fadeIn animate__delay-3s">

                        <label>Museum Image</label>
                        <!-- Choosing an image for the museum -->
                        <label class="custom-file-upload">
                                <input type="file" name="musImage" accept="image/*" class="custom-file-upload">
                                Choose Image
                        </label>
                    </div>

                    <div class="inputfield animate__animated animate__fadeIn animate__delay-3s">

                        <label>Museum Video</label>
                        <!-- Choosing a video for the museum -->
                        <label class="custom-file-upload">
                                <input type="file" name="musVid" accept="video/*" class="custom-file-upload">
                                Choose Video
                        </label>
                    </div>

                    <!-- 
                        
                            Part 2 of the form (museum information)
                    
                        -->



                    <!-- The tittle for the second part in the form -->
                    <div class="title animate__animated animate__fadeIn animate__delay-4s" style="margin-top: 40px;">
                        Museum Location
                    </div>

                    <!-- The get my location button -->
                    <div class="inputfield animate__animated animate__fadeIn animate__delay-4s">
                        <input onclick='getLocation()' type="button" value="My Location" style="height: 92%; margin-top: 2%;margin-left: 25%;width: 50%;" class="btn">
                    </div>

                    <!-- **REQUIRED** The longitude of the musuem -->
                    <div class="inputfield animate__animated animate__fadeIn animate__delay-4s">
                        <label>Longitude:</label>
                        <input required id='longitude' type="number" step='0.001' name='longitude' placeholder='long (-90 ~ 90)' min='-90' max='90' class="input">
                    </div>

                    <!-- **REQUIRED** The latitude of the musuem -->
                    <div class="inputfield animate__animated animate__fadeIn animate__delay-4s">
                        <label>Latitude:</label>
                        <input required id='latitude' type="number" step='0.001' name='latitude' placeholder='lat (-180 ~ 180)' min='-180' max='180' class="input">
                    </div>


                    <!-- 
                        
                            The submit button
                    
                        -->
                    <div class="inputfield animate__animated animate__fadeIn animate__delay-4s">
                        <input type="submit" value="Submit" class="btn">
                    </div>

                </div>
            </form>
        </div>
    </main>
</body>

<!-- Footer of the page -->
<?php include 'php/footer.inc.php' ?>

<!-- End of submission page -->

</html>