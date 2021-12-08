<?php
    // request has to be post
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $uname = $_POST['username'];
        $pw = $_POST['password'];
        $email = $_POST['email'];



        // appropriate validation
        if(isset($uname) && isset($pw) && isset($email)){

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
                /* *** Ignore /unsecure/ ***
                $hashedPassword = password_hash($pw, PASSWORD_DEFAULT);
    
                $sql = "INSERT INTO users (username, password, email) VALUES ('$uname','$hashedPassword','$email')";
                if($conne->query($sql) ===TRUE){
                    echo "yes";
                }
                else{
                    echo "no";
                }*/


                // hash the password to be stored in the database
                $hashedPassword = password_hash($pw, PASSWORD_DEFAULT);

                // start a new PDO object to interface with the database
                $dbh = new PDO('mysql:host=localhost;dbname=proj_db', $username, $password);

                // the query to be executed to check if the user name already exists in the database
                $valsql = "SELECT username FROM users WHERE username = :uname";
                // prepare the pdo command
                $valstmt = $dbh->prepare($valsql);
                $val = TRUE;

                // check if the user name is already in the database
                if ($valstmt) {
                    // bind the value to avoid malcious activities
                    $valstmt->bindValue(":uname", $uname);
                    if ($valstmt->execute()){
                        // if the username already exists
                        if($valstmt->rowCount() == 1){
                            $val = FALSE;
                        }
                    } 
                    // unable to execute the command
                    else {
                        echo "unable to execute the command";
                    }
                
                }
                else{
                    echo "unable to execute the command";
                }

                // If the user already exists, then notify the user
                if($val == FALSE){
                    header("location: ../notify.php?head=Unable to sign up&body=This username is Already Registered.");
                    unset($valstmt);
                    
                    // Close the connection
                    $conne->close();
                    // exit if the user already exists in the database
                    exit();
                }



                /*****************************************************
                 ***** If the user doesn't exist in the database: ****
                 *****************************************************/

                // start/continue the session
                session_start();

                // prepare the sql command to insert a new user into the database
                $sql = "INSERT INTO users (username, password, email) VALUES (:uname, :hpass, :email)";
                $stmt = $dbh->prepare($sql);

                if ($stmt) {
                    // bind the values to avoid malcious activities
                    $stmt->bindValue(":uname", $uname);
                    $stmt->bindValue(":hpass", $hashedPassword);
                    $stmt->bindValue(":email", $email);
                    if ($stmt->execute()){
                        $_SESSION["signedin"] = true;
                        $_SESSION['username'] = $uname;
                        $_SESSION['email'] = $email;
                    } 

                    // unable to execute the command
                    else {
                        echo "Something Went Wrong";
                    }
                
                }
                // unable to execute the command
                else{
                    echo "Something went wrong";
                }                


            }

            // close the connection
            $conne->close();
        }

        // validation for data is not sucessful
        else{
            echo 'Some inputs are empty';
        }

        // if the session didn't start
        if(isset($_SESSION)){
            if($_SESSION["signedin"] != true){
                // sign up was not sucessful, so notify the user
                header("location: ../notify.php?head=Unable to sign up&body=This username is Already Registered.");
            }
            else{
                // if the sign up was sucessful, then the user will logged in, so take them to the profile page 
                header("location: ../profile.php");
            }
        }
        // if the session didn't start, then notify the user that we are unable to sign up with the given username
        else{
            header("location: ../notify.php?head=Unable to sign up&body=This username is Already Registered.");
        }



    }
    // user didn't use post request
    else{
        header("location: ../notify.php?head=Unable to sign up&body=Something Went wrong.");
    }
?>