<!-- Page header to contain the navigation bar -->
<?php 
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    if (isset($_SESSION['signedin'])) {
        if(!empty($_SESSION['signedin']) && ($_SESSION['signedin'])){
            include 'php/sign_nav.inc.php';
        }
        else{
            include 'php/sout_nav.inc.php';
        }
            
    }
    else{
        include 'php/sout_nav.inc.php'; 
    }
    
    ?>