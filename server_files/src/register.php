<?php
    require '../modules/config.php';
    require '../modules/database.php';
    if(isset($_GET['user']) && isset($_GET['pass'])) {
        //Checks if username is empty
        if($_GET['user'] == ''){
            echo "Username cannot be empty\n";
            logInfo('INFO', 'Registration Not Successful');
            exit();
        }
        //Checks if password is empty
        if($_GET['pass'] == ''){
         echo "Password cannot be empty\n";
         logInfo('INFO', 'Registration Not Successful');
         exit();
        }
        //Check if username is already in use       
        if (checkUsernameAvailable($_GET['user']) == 1){
            echo "Username already in use\n";
            logInfo('INFO', 'Registration Not Successful');
            exit();
        }
        else{
            createNewUser($_GET['user'], $_GET['pass']);
            echo "Registration successful\n";
            logInfo('INFO', 'Registration Successful');
            exit();
        }
    }
    echo "Missing username/password\n";
?>