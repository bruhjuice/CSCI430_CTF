<?php

   //Start session
   require '../modules/config.php';
   require '../modules/database.php';
   require '../modules/session.php'

   startSession();

    // Get the action and amount from the URL
    $action = $_GET['action'];
    $amount = isset($_GET['amount']) ? $_GET['amount'] : null;
    
    // Checks if user is logged in
    if (!isset($_SESSION['loggedin'])) {
        // Redirect to the login page
        header("Location: login.php");
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
            echo "Insufficient funds!";
            exit();
        }
    } elseif ($action === "balance") {
        echo "Balance: " . $balance;
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
    echo "New balance: " . $new_balance;

?>