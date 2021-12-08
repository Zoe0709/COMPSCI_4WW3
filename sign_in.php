<?php include 'php/header.php' ?>

<body>

    <!-- Page header to contain the navigation bar -->
    <?php include 'php/navbar.inc.php' ?>

    <!-- Main content of the page -->

    <main class='main-section'>
        <div class='content'>

            <!-- The header of the page -->
            <h1 class='heading'>Sign In</h1>


            <!-- The form that will take the account information about the user -->
            <form class="wrapper" method="post" action="php/sign_in.php">

                <div class="form">

                    <!-- The tittle for the form -->
                    <div class="title animate__animated animate__fadeIn animate__delay-1s">
                        Log In
                    </div>

                    <!-- **REQUIRED** The username of the user **REQUIRED** -->
                    <div class="inputfield animate__animated animate__fadeIn animate__delay-2s">
                        <label for="uname">Username *:</label>
                        <input type="text" id="uname" name="username" class="input" placeholder='Username here' pattern="^[a-zA-Z\s0-9]*$" required>
                    </div>

                    <!-- **REQUIRED** The password of the user **REQUIRED** -->
                    <div class="inputfield animate__animated animate__fadeIn animate__delay-3s">
                        <label for="pass">Password *:</label>
                        <input type="password" id="pass" name="password" class="input" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{3,}" placeholder='Password here' required>
                    </div>

                    <!-- The submit button -->
                    <div class="inputfield animate__animated animate__fadeIn animate__delay-4s">
                        <input type="submit" value="Sign In" class="btn">
                    </div>
                </div>
            </form>
        </div>
    </main>
</body>


<!-- Footer of the page -->
<?php include 'php/footer.inc.php' ?>

<!-- End of sign in page -->

</html>