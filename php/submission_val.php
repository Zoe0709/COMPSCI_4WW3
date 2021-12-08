<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){

        $musName = $_POST['musName'];

        $musCountry = $_POST['musCountry'];
        $musCity = $_POST['musCity'];
        $musPostal = $_POST['musPostal'];
        $musDesc = $_POST['musDesc'];
        $longitude = $_POST['longitude'];
        $latitude = $_POST['latitude'];

        $musImage = $_POST['musImage'];
        $musVid = $_POST['musVid'];
        $avgr = 0;

        session_start();
        if (isset($_SESSION['signedin'])) {
            if($_SESSION['signedin'] != true){
                header("location: ../notify.php?head=Log In Required&body=Only logged in users can submit new museums.");
                exit();
            }
                
        }
        else{
            header("location: ../notify.php?head=Log In Required&body=Only logged in users can submit new museums.");
            exit();

        }


        // appropriate validation
        if(isset($musName)&& isset($longitude)&& isset($latitude)){

            //start doing the connection
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "proj_db";
            
            
            $conne = new mysqli($servername, $username, $password, $dbname);
    
            if($conne->connect_error){
                die("connection failed while inserting data: ".$conne->connect_error);
            }

            // connection is sucessful
            else{
                /*
                $hashedPassword = password_hash($pw, PASSWORD_DEFAULT);
    
                $sql = "INSERT INTO users (username, password, email) VALUES ('$uname','$hashedPassword','$email')";
                if($conne->query($sql) ===TRUE){
                    echo "yea";
                }
                else{
                    echo "no";
                }*/


                $dbh = new PDO('mysql:host=localhost;dbname=proj_db', $username, $password);

                $valsql = "SELECT mus_name FROM museums WHERE mus_name = :m_name";
                $valstmt = $dbh->prepare($valsql);
                $val = TRUE;

                if ($valstmt) {
                    $valstmt->bindValue(":m_name", $musName);
                    if ($valstmt->execute()){
                        if($valstmt->rowCount() == 1){
                            $val = FALSE;
                        }
                    } 
                    else {
                        echo "Something Went Wrong";
                    }
                
                }
                else{
                    echo "Something went wrong";
                }
                if($val == FALSE){
                    // Close the connection
                    header("location: ../notify.php?head=Failed&body=Meusum has already been added before");
                    unset($valstmt);
                    $conne->close();
                    exit();
                }






                ////////////////////////////////////////////////////////////////////////////
                //////////////////////////////////////Include images////////////////////////
                ////////////////////////////////////////////////////////////////////////////


                
                $sql = "INSERT INTO museums (mus_name, lat, lon, avg_rate, mus_desp) VALUES (:mname, :lati, :long, :avg_rate, :mdesc)";
                $stmt = $dbh->prepare($sql);

                $val = false;

                if ($stmt) {
                    $stmt->bindValue(":mname", $musName);
                    $stmt->bindValue(":lati", $latitude);
                    $stmt->bindValue(":long", $longitude);
                    $stmt->bindValue(":avg_rate", $avgr);
                    $stmt->bindValue(":mdesc", $musDesc);
                    if ($stmt->execute()){
                        $val = true;
                    } 
                    else {
                        echo "Something Went Wrong";
                    }
                
                }
                else{
                    echo "Something went wrong";
                }                


            }

            $conne->close();
        }
        else{
            echo 'Some inputs are empty';
        }

        if($val != true){
            header("location: ../notify.php?head=Failed&body=Meusum has already been added before");
        }
        else{
            header("location: ../notify.php?head=successful&body=Meusum has been added <br> Thank you!");
        }


    }
    else{
        header("location: ../index.php");
    }
?>