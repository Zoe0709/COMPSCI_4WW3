<?php

    // Start/continue the session
    session_start();

    // unset all the values in the session
    session_unset();

    // Destroy the session
    session_destroy();

    // move the user to the index page
    header("location: ../index.php");
    exit;
?>