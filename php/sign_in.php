<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $uname = $_POST['username'];
        $pw = $_POST['password'];


        // Empty inputs validation
        if(isset($uname) && isset($pw)){
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "proj_db";
            
            
            $conne = new mysqli($servername, $username, $password, $dbname);
    
            if($conne->connect_error){
                die("connection failed while inserting data: ".$conne->connect_error);
            }
            else{
                // $hashedPassword = password_hash($pw, PASSWORD_DEFAULT);
                $dbh = new PDO('mysql:host=localhost;dbname=proj_db', $username, $password);
                $stmt = $dbh ->prepare("SELECT username,password,email FROM users WHERE username=:uname");



                if ($stmt){
                    // Binding
                    $stmt->bindValue(':uname',$uname);
                    // First we check if the user even exists in our DB
                    if ($stmt->execute()){
                        // Check if we have exactly 1 user with same email
                        if ($stmt->rowCount() == 1){
                            $row = $stmt->fetch();
                            if ($row){
                                $usname = $row["username"];
                                $pass = $row["password"];
                                $em = $row["email"];
                                // Verify Hashed Password against entered Password
                                if (password_verify($pw, $pass)){
                                    // Since Password is correct, we update the session
                                    session_start();
                                    $_SESSION["signedin"] = true;
                                    $_SESSION["username"] = $usname;
                                    $_SESSION["email"] = $em;
                                    header("location: ../profile.php");
                                    
                                } 
                                else {
                                    $signin_err = "Invalid Credentials, Please Try Again";
                                }
                            }
                        }
                        else {
                            $general_err = "Invalid Credentials, Please Try Again";
                        }
                    } 
                    else {
                        $general_err = "Something Went Wrong, Please Try Again";
                    }
                unset($stmt);
                }
 
            }

            $conne->close();
        }
        else{
            echo 'Some inputs are empty';
        }

        if($_SESSION["signedin"] != true){
            header("location: ../notify.php?head=Unable to log in&body=Invalid Credentials, Please Try Again.");
        }
        else{
            header("location: ../profile.php");
        }


    }
    else{
        session_start();
        if($_SESSION["signedin"] != true){
            header("location: ../notify.php?head=Unable to log in&body=Invalid Credentials, Please Try Again.");
        }
        else{
            header("location: ../profile.php");
        }

    }
?>