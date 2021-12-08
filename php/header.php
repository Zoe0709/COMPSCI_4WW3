<?php
    session_start();
?>

<!DOCTYPE html>
<!-- Specify the language code as English -->
<html lang='en'>

<head>
    <meta charset="UTF-8">
    <!-- The viewport meta tag for the responsiveness and scale -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="author" content="Abdullah and Zoe" />
    <meta name="keywords" content="Museum, search, rate, review" />

    <meta name="Description" content="A website to search museum" />

    <meta name="viewport" content="width = device-width, initial-scale = 1, minimum-scale = 1, maximum-scale = 5" />

    <!-- Referencing the css library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <!-- google icons for the navigation bar and footer -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <!-- Referencing styling files -->
    <?php
        require "styles.php";
    ?>

    <!-- icon for homescreens -->
    <link rel="apple-touch-icon" sizes="180x180" href="../img/logo-180x180.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../img/logo-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../img/logo-16x16.png">
</head>