<?php include 'php/header.php' ?>

<body>

    <!-- Page header to contain the navigation bar -->
    <?php include 'php/navbar.inc.php' ?>

    <!-- Main content of the page -->

    <main class='main-section'>
        <div class='content'>

            <!-- The header of the page -->
            <h1 class='heading'><?php
                if($_GET){
                    echo $_GET['head']; // print_r($_GET); //remember to add semicolon      
                }
            ?></h1>


            <!-- The form that will take the account information about the user -->
            <form class="wrapper" method="post" action="index.php">

                <div class="form">

                    <!-- The tittle for the form -->
                    <div class="title animate__animated animate__fadeIn animate__delay-1s">
                    <?php
                        if($_GET){
                            echo $_GET['body']; // print_r($_GET); //remember to add semicolon      
                        }
                    ?>
                    </div>



                    <!-- The submit button -->
                    <div class="inputfield animate__animated animate__fadeIn animate__delay-2s">
                        <input type="submit" value="Ok" class="btn">
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