<?php
    //Start session
    require '../modules/config.php';
    require '../modules/database.php';
    require '../modules/session.php';

    //If someone is already logged in, log them out and try login flow
    if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
        endSession();
        startSession();
    }

    if(isset($_GET['user']) && isset($_GET['pass'])) {
        if(checkPassword($_GET['user'], $_GET['pass'])) {
            // Set session information
            $_SESSION["logged_in"] = true;
            $_SESSION["username"] = $_GET["user"];
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