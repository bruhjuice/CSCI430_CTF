<?php

   //Start session
   require '../modules/config.php';
   require '../modules/database.php';
   require '../modules/session.php';

   startSession();

    //store current session id, once the new session is initialised for the user trying to login.
    $old_session_id = session_id()
   
   //resetting session ID post confirmation of login to prevent session hijacking
    session_regenerate_id();
    
    //the new session id is propagated to user through cookies. 
    $new_session_id = session_id();

    // Get the action and amount from the URL
    $action = $_GET['action'];
    $amount = isset($_GET['amount']) ? $_GET['amount'] : null;
    
    // Checks if user is logged in
    if (!isset($_SESSION['logged_in'])) {
        echo "You are not logged in\n";
        exit();
    }

    $balance = getBalance($_SESSION['username']);
    
    // Perform the action and update the balance
    if ($action === "deposit") {
        $new_balance = $balance + $amount;
    } elseif ($action === "withdraw") {
        if ($balance >= $amount) {
            $new_balance = $balance - $amount;
        } else {
            // Displays an error message
            echo "Insufficient funds!\n";
            exit();
        }
    } elseif ($action === "balance") {
        echo "Balance: $balance\n";
        exit();
    } elseif ($action === "close") {
        closeAccount($_SESSION['username']);
        endSession();
        exit();
    }
    
    updateBalance($_SESSION['username'], $new_balance);
    
    // Close the statement and database connection
    $stmt->close();
    $mysqli->close();
    
    // Display the updated balance
    echo "New balance: $new_balance\n";

?>