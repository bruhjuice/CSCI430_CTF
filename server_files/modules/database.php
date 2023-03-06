<?php
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if($mysqli->connect_errno) {
        echo $mysqli->connect_error; //TODO replace echo with logging 
        exit();
    }

    function createNewUser($username, $password, &$salt) {
        //Insert statement
        $stmt = $mysqli->prepare("INSERT INTO users (username, password, salt, balance, closed) VALUES (?, ?, ?, 0, 0)");
        
        //Salt generation
        $salt = rand();
        
        //Hashing
        $hashed_password = hash("sha256", $password . $salt);
        
        //Execute
        $stmt->bind_param("ssi", $username, $hashed_password, $salt);
        $stmt->execute();
        
        // Database connection
        $stmt->close();
    }

    function checkPassword($username, $password) {
        //Retrieve the user's salt and hashed password
        $stmt = $mysqli->prepare("SELECT salt, password FROM users WHERE username = ?");

        // Bind the parameters and execute the statement
        $stmt->bind_param("s", $username);
        $stmt->execute();

        // Bind the results to variables
        $stmt->bind_result($salt, $hashed_password);
        $stmt->fetch();
        
        // Close statementt
        $stmt->close();

        if (hash("sha256", $password . $salt) === $hashed_password) {
            return true;
        }
        return false;
    }
    
    function getBalance($username) {
        $stmt = $mysqli->prepare("SELECT balance FROM users WHERE username = ?");
    
        // Bind the parameters and execute the statement
        $stmt->bind_param("s", $username);
        $stmt->execute();
        
        // Bind the results to a variable
        $stmt->bind_result($balance);
        $stmt->fetch();
        
        // Close the statement
        $stmt->close();
        return $balance;
    }

    function closeAccount($username) {
        // Set the closed flag to true
        $stmt = $mysqli->prepare("UPDATE users SET closed = 1 WHERE DB_USER = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
    }

    function updateBalance($username, $new_balance) {
        // Prepare the update statement to update the user's balance
        $stmt = $mysqli->prepare("UPDATE users SET balance = ? WHERE username = ?");
        $stmt->bind_param("is", $new_balance, $username);
        $stmt->execute();
    }

    function checkUsernameAvaliable($username) {
        $stmt= $mysql->prepare("SELECT * from users WHERE username=?;");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->fetch();
        return $stmt->num_rows === 0;
    }

?>