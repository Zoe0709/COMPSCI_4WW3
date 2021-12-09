<?php include 'php/header.php' ?>

<body>

    <!-- Page header to contain the navigation bar -->
    <?php include 'php/navbar.inc.php' ?>

    <!-- Main content of the page -->

    <main class='main-section'>
        <div class='content'>

            <!-- The header of the page -->
            <h1 class='heading'>Signed In</h1>


            <!-- The form that will take the account information about the user -->
            <form class="wrapper" method="post" action="php/sign_out.php">

                <div class="form">

                    <!-- The tittle for the form -->
                    <div class="title animate__animated animate__fadeIn animate__delay-1s">
                        Profile
                    </div>

                    <div class="inputfield animate__animated animate__fadeIn animate__delay-1s">
                        <label for="pass"> <?php echo "userId:".$_SESSION['userId']; ?>   </label>
                    </div>

                    <div class="inputfield animate__animated animate__fadeIn animate__delay-2s">
                        <label for="uname"> <?php echo "username:".$_SESSION['username']; ?></label>
                    </div>


                    <div class="inputfield animate__animated animate__fadeIn animate__delay-3s">
                        <label for="pass"> <?php echo "Email:".$_SESSION['email']; ?>   </label>
                    </div>

                    <!-- The submit button -->
                    <div class="inputfield animate__animated animate__fadeIn animate__delay-4s">
                        <input type="submit" value="Sign Out" class="btn">
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