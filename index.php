<?php include 'php/header.php' ?>

<body class='backImg' style="background-image: url(./img/img0.jpeg);">
    <div class="overlay"></div>
</body>

<body onload="init()">
    <!-- Page header to contain the navigation bar -->
    <?php include 'php/navbar.inc.php' ?>
    
    <!-- Main content of the page -->

    <main class='main-section'>
        <div class='content'>

            <!-- The first header (name of our project) -->
            <h1 id="main-header" class="animate__animated animate__fadeIn">MuseuMaster</h1>

            <!-- The secondary header (description of our project) -->
            <h2 id="secondary-header" class="animate__animated animate__fadeIn">Discover Museums around the world. </h2>

            <!-- Museum logo -->
            <picture style="display: block;margin-left: auto;margin-right: auto">
                <!-- When screen width is at least 600px, display high resolution museum logo -->
                <source type="image/png" media="(min-width: 600px)" srcset="./img/logo-ani.gif">
                <!-- When screen width is at least 450px, either standard resolution or low resolution  logo is used depending on the device resolution -->
                <source type="image/png" media="(min-width: 450px)" srcset="./img/logo-ani.gif">
                <!-- When screen width less than 450px, display low resolution museum logo -->
                <img src="./img/logo-ani.gif" alt="Museum Logo" style="width:auto;">
            </picture>
        </div>
    </main>

</body>

<!-- Footer of the page -->
<?php include 'php/footer.inc.php' ?>



<!-- End of index home page -->

</html>