<?php
    require_once '../modules/database.php';
    if(isset($_GET['user']) && isset($_GET['pass']) && $_GET['user'].trim() == '' && $_GET['pass'].trim() == '') {
        //Check if username is already in use       
        if (checkUsernameAvailable($_GET['user']) == 1){
            echo "Username already in use\n";
            logInfo('WARNING', 'Registration Not Successful, Username in use: '. $_GET['user']);
            updateIpFailure($_SERVER['REMOTE_ADDR']);
            exit();
        }
        else{
            createNewUser($_GET['user'], $_GET['pass']);
            echo "Registration successful\n";
            logInfo('INFO', 'Registration Successful');
            updateIpSuccess($_SERVER['REMOTE_ADDR']);
            exit();
        }
    }
    echo "Missing username/password\n";
    logInfo('WARNING', 'Registration Missing username/password');
    updateIpFailure($_SERVER['REMOTE_ADDR']);
    exit();
?>