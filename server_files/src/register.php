<?php

    //Start session
    require './config.php';

    //Check for if username already exists and active

    //Prepare SQL statement (Prevents SQL injection attacks)
    $stmt = $conn->prepare("INSERT INTO users (username, password, salt, balance, closed) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssdi", $_GET['user'], $password, $salt, 0, false);

    //Excute SQL statement
    $executed = $stmt->execute();
    if(!$executed) {
        echo $mysqli->error;
    }


    echo "Registration Successful";
?>