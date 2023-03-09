<?php
    //Start session
    require '../modules/config.php';
    require '../modules/database.php';
    require '../modules/session.php';

    //If someone is already logged in, log them out and try login flow
    if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
        endSession();
    }

    startSession();

    //store current session id, once the new session is initialised for the user trying to login.
    $old_session_id = session_id()

    if(isset($_GET['user']) && isset($_GET['pass'])) {
        if(checkPassword($_GET['user'], $_GET['pass'])) {
            //resetting session ID post confirmation of login to prevent session hijacking
            session_regenerate_id();
            //the new session id is propagated to user through cookies. 
            
            $new_session_id = session_id();

            // Set session information
            $_SESSION["logged_in"] = true;
            $_SESSION["username"] = $_GET["username"];
        }
        else {
            echo "Invalid Username or Password\n";
            exit();
        }
    }
    else {
        echo  "Missing Username or Password\n";
        exit();
    }
    echo "Login successful\n";