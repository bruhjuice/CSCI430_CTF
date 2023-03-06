<?php

    require '../modules/config.php';
    require '../modules/database.php';




    
    if(isset($_GET['user']) && isset($_GET['pass'])) {
        //TODO Check if username is already in use
        if (checkUsernameAvaliable($_GET['user']) === false){
            echo "Username Already in Use";
            exit();
        }
        else{
            createNewUser($_GET['user'], $_GET['pass']);
            echo "Registration Successful";
            exit();
        }
    }
    echo "Missing username and password";
    
?>