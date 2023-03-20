<?php
    require '../modules/config.php';
    require '../modules/database.php';
    if(isset($_GET['user']) && isset($_GET['pass'])) {
        //Checks if username is empty
        if($_GET['user'] == ''){
            echo "Username cannot be empty\n";
            exit();
        }
        //Checks if password is empty
        if($_GET['pass'] == ''){
         echo "Password cannot be empty\n";
         exit();
        }
        //Check if username is already in use       
        if (checkUsernameAvailable($_GET['user']) == 1){
            echo "Username already in use\n";
            exit();
        }
        else{
            createNewUser($_GET['user'], $_GET['pass']);
            echo "Registration successful\n";
            exit();
        }
    }
    echo "Missing username/password\n";
?>