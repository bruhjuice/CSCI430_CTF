<?php

    function initSQL() {
        $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if($mysqli->connect_errno) {
            logInfo('ERROR', $mysqli->connect_error);
            exit();
        }
        return $mysqli;
    }
    

    function createNewUser($username, $password) {
        $mysqli = initSQL();

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
        $mysqli->close();
    }

    function checkPassword($username, $password) {
        $mysqli = initSQL();
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
        $mysqli->close();

        if (hash("sha256", $password . $salt) === $hashed_password) {
            return true;
        }
        return false;
    }
    
    function getBalance($username) {
        $mysqli = initSQL();
        $stmt = $mysqli->prepare("SELECT balance FROM users WHERE username = ?");
    
        // Bind the parameters and execute the statement
        $stmt->bind_param("s", $username);
        $stmt->execute();
        
        // Bind the results to a variable
        $stmt->bind_result($balance);
        $stmt->fetch();
        
        // Close the statement
        $stmt->close();
        $mysqli->close();
        return $balance;
    }

    function closeAccount($username) {
        $mysqli = initSQL();
        // Set the closed flag to true
        $stmt = $mysqli->prepare("UPDATE users SET closed = 1 WHERE DB_USER = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->close();
        $mysqli->close();
    }

    function updateBalance($username, $new_balance) {
        $mysqli = initSQL();
        // Prepare the update statement to update the user's balance
        $stmt = $mysqli->prepare("UPDATE users SET balance = ? WHERE username = ?");
        $stmt->bind_param("ds", $new_balance, $username);
        $stmt->execute();
        $stmt->close();
        $mysqli->close();
    }

    function checkUsernameAvailable($username) {
        $mysqli = initSQL();
        $stmt= $mysqli->prepare("SELECT * from users WHERE username=?;");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();
        $num_rows = $stmt->num_rows;
        $stmt->close();
        $mysqli->close();
        return $num_rows === 0;
    }

?>