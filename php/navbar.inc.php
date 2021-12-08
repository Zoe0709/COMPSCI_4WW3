<!-- Page header to contain the navigation bar -->
<?php 
    // if session has not started, then start/continue it
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    // check if the user is singed in
    if (isset($_SESSION['signedin'])) {
        if(!empty($_SESSION['signedin']) && ($_SESSION['signedin'])){
            // if the user is signed in
            include 'php/sign_nav.inc.php';
        }
        else{
            // if the user is not signed in (signed out)
            include 'php/sout_nav.inc.php';
        }
            
    }
    // user is not signed in
    else{
        include 'php/sout_nav.inc.php'; 
    }
    
?>