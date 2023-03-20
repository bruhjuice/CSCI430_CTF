<?php

   //Start session
   require '../modules/config.php';
   require '../modules/database.php';
   require '../modules/session.php';

    // Get the action and amount from the URL
    $action = $_GET['action'];
    $amount = isset($_GET['amount']) ? $_GET['amount'] : null;
    
    // Checks if user is logged in
    if (!isset($_SESSION['logged_in'])) {
        logInfo('ERROR', 'User Not Logged In');
        echo "You are not logged in";
        exit();
    }

    $balance = getBalance($_SESSION['username']);
    
    // Perform the action and update the balance
    if ($action === "deposit") {
        $new_balance = $balance + $amount;
        logInfo('INFO', 'Deposit:' . $amount);
    } elseif ($action === "withdraw") {
        if ($balance >= $amount) {
            $new_balance = $balance - $amount;
            logInfo('INFO', 'New Balance:' . $new_balance);
        } else {
            // Displays an error message
            logInfo('INFO', 'Insufficient funds!');
            exit();
        }
    } elseif ($action === "balance") {
        logInfo('INFO', "Balance: " . $balance);
        exit();
    } elseif ($action === "close") {
        closeAccount($_SESSION['username']);
        logInfo('INFO', 'Account Closed');
        endSession();
        exit();
    }
    
    updateBalance($_SESSION['username'], $new_balance);
    
    // Display the updated balance
    echo "New balance: " . $new_balance;

?>