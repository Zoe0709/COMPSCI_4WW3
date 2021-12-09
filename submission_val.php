<?php

    // request has to be post to submit a new page 
    if($_SERVER["REQUEST_METHOD"] == "POST"){

        // The passed post variables
        $musName = $_POST['musName'];

        $musAddr = $_POST['musAddr'];
        $musDesc = $_POST['musDesc'];
        $longitude = $_POST['longitude'];
        $latitude = $_POST['latitude'];



        // initial avg rate is 0
        $avgr = 0;

        // start the session to check if the user is logged in
        session_start();
        if (isset($_SESSION['signedin'])) {
            // if the user is not logged in, then notify them
            if($_SESSION['signedin'] != true){
                header("location: notify.php?head=Log In Required&body=Only logged in users can submit new museums.");
                exit();
            }
                
        }
        // if the user is not logged in, then notify them
        else{
            header("location: notify.php?head=Log In Required&body=Only logged in users can submit new museums.");
            exit();

        }


        // appropriate validation
        if(isset($musName)&& isset($longitude)&& isset($latitude)){

            //start doing the connection (actual data is on the server)
            $servername = "";
            $username = "";
            $password = "";
            $dbname = "";
            
            // try to connect
            $conne = new mysqli($servername, $username, $password, $dbname);
    
            // if unable to connect, print the error
            if($conne->connect_error){
                die("connection failed while inserting data: ".$conne->connect_error);
            }

            // connection is sucessful
            else{


                // start a new PDO object to interface with the database
                $dbh = new PDO('mysql:host=localhost;dbname=proj_db', $username, $password);

                // the query to be executed to check if the museum name already exists in the database
                $valsql = "SELECT mus_name FROM museums WHERE mus_name = :m_name";

                // prepare the pdo command
                $valstmt = $dbh->prepare($valsql);
                $val = TRUE;

                // check if the museum name is already in the database
                if ($valstmt) {
                    // bind the value to avoid malcious activities
                    $valstmt->bindValue(":m_name", $musName);
                    if ($valstmt->execute()){
                        // if the museum name already exists
                        if($valstmt->rowCount() == 1){
                            $val = FALSE;
                        }
                    } 
                    // unable to execute the command
                    else {
                        echo "Something Went Wrong";
                    }
                
                }
                else{
                    echo "Something went wrong";
                }

                // If the museum already exists, then notify the user
                if($val == FALSE){
                    header("location: notify.php?head=Failed&body=Meusum has already been added before");
                    unset($valstmt);
                    // Close the connection
                    $conne->close();
                    // exit if the musuem already exists in the database
                    exit();
                }

                // The passed post variables
                $_SESSION['musName'] = $musName;
                $_SESSION['musAddr'] = $musAddr;
                $_SESSION['musDesc'] = $musDesc;


                
                $_SESSION['longitude'] = $longitude;
                $_SESSION['latitude'] = $latitude;

                // The passed image to be stored in s3 bucket
                $_SESSION['imgfile'] = $_FILES['musImage']['name'];
                $_SESSION['imgtemp'] = $_FILES['musImage']['tmp_name'];

                // The passed video to be stored in s3 bucket
                $_SESSION['vidfile'] = $_FILES['musVid']['name'];
                $_SESSION['vidtemp'] = $_FILES['musVid']['tmp_name'];


                // a php script that will insert the data including the image into the data base
                // please note that this script resides on the server as it contains the private keys
                include 'php/inc/s3bucketInsert.php';

                // successful insertion
                $val = true;



                

            }
            // close the connection
            $conne->close();
        }
        // validation for data is not sucessful
        else{
            echo 'Some inputs are empty';
        }

        if($val != true){
            // if the museum was not inserted in the database because it already exists, then notify the user
            header("location: notify.php?head=Failed&body=Meusum has already been added before");
        }
        else{
            // if the museum was inserted in the database, then notify the user
            header("location: notify.php?head=successful&body=Meusum has been added <br> Thank you!");
        }


    }
    // user didn't use post request
    else{
        header("location: index.php");
    }
?>