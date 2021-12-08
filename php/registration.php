<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        //$first = $_POST['firstname'];
        //$last = $_POST['lastname'];
        $uname = $_POST['username'];
        $pw = $_POST['password'];
        $email = $_POST['email'];



        // appropriate validation
        if(isset($uname) && isset($pw) && isset($email)){

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


                $hashedPassword = password_hash($pw, PASSWORD_DEFAULT);
                $dbh = new PDO('mysql:host=localhost;dbname=proj_db', $username, $password);

                $valsql = "SELECT username FROM users WHERE username = :uname";
                $valstmt = $dbh->prepare($valsql);
                $val = TRUE;

                if ($valstmt) {
                    $valstmt->bindValue(":uname", $uname);
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
                    header("location: ../notify.php?head=Unable to sign up&body=This username is Already Registered.");
                    unset($valstmt);
                    $conne->close();
                    exit();
                }







                session_start();

                $sql = "INSERT INTO users (username, password, email) VALUES (:uname, :hpass, :email)";
                $stmt = $dbh->prepare($sql);

                if ($stmt) {
                    $stmt->bindValue(":uname", $uname);
                    $stmt->bindValue(":hpass", $hashedPassword);
                    $stmt->bindValue(":email", $email);
                    if ($stmt->execute()){
                        $_SESSION["signedin"] = true;
                        $_SESSION['username'] = $uname;
                        $_SESSION['email'] = $email;
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

        if(isset($_SESSION)){
            if($_SESSION["signedin"] != true){
                header("location: ../notify.php?head=Unable to sign up&body=This username is Already Registered.");
            }
            else{
                header("location: ../profile.php");
            }
        }
        else{
            header("location: ../notify.php?head=Unable to sign up&body=This username is Already Registered.");
        }



    }
    else{
        header("location: ../notify.php?head=Unable to sign up&body=This username is Already Registered.");
    }
?>