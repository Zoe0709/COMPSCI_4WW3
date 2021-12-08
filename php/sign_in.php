<?php
    // request has to be post
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $uname = $_POST['username'];
        $pw = $_POST['password'];


        // appropriate validation
        if(isset($uname) && isset($pw)){
            //start doing the connection (actual data is on the server)
            $servername = "";
            $username = "";
            $password = "";
            $dbname = "";
            
            // try to connect
            $conne = new mysqli($servername, $username, $password, $dbname);
    
            // if unable to connect print the error
            if($conne->connect_error){
                die("connection failed while inserting data: ".$conne->connect_error);
            }

            // connection is sucessful
            else{
                // start a new PDO object to interface with the database
                $dbh = new PDO('mysql:host=localhost;dbname=proj_db', $username, $password);

                // prepare the query to be executed to log in the user
                $stmt = $dbh ->prepare("SELECT username,password,email FROM users WHERE username=:uname");



                if ($stmt){
                    // Binding
                    $stmt->bindValue(':uname',$uname);
                    // Check if the user exists in the database
                    if ($stmt->execute()){
                        // We have to have exactly 1 user with same username
                        // This is exepected as registration doesn't allow for duplicate usernames
                        if ($stmt->rowCount() == 1){
                            $row = $stmt->fetch();
                            if ($row){
                                $usname = $row["username"];
                                $pass = $row["password"];
                                $em = $row["email"];
                                // Since the password is hassed, then we verify the hashed one against the entered Password in this way:
                                if (password_verify($pw, $pass)){
                                    // if the password is correct, update the session
                                    session_start();
                                    $_SESSION["signedin"] = true;
                                    $_SESSION["username"] = $usname;
                                    $_SESSION["email"] = $em;
                                    // take the user to their profile page
                                    header("location: ../profile.php");
                                    
                                }
                                // Credentials are invalide
                            }
                        }
                    }
                // stmt has been executed
                unset($stmt);
                }
 
            }
            // close the connection
            $conne->close();
        }

        // passed information doesn't pass validation
        else{
            echo 'Some inputs are empty';
        }

        // start the session if it was not started
        if(!isset($_SESSION)){
            session_start();
        }

        // check if the user is logged in
        if($_SESSION["signedin"] != true){
            // if the user wasn't logged in, then they have input wrong Credentials
            header("location: ../notify.php?head=Unable to log in&body=Invalid Credentials, Please Try Again.");
        }
        // otherwise the user is logged in, so that them to their profile page
        else{
            header("location: ../profile.php");
        }


    }
    // passed request is not post, so check if the user is logged in
    else{
        // start the session if it was not started
        if(!isset($_SESSION)){
            session_start();
        }
        // if the user is not signed in, then notify them that something went wrong
        if($_SESSION["signedin"] != true){
            header("location: ../notify.php?head=Unable to log in&body=Something Went Wrong.");
        }
        else{
            // if ther user is logged in, take them to their profile page
            header("location: ../profile.php");
        }

    }
?>