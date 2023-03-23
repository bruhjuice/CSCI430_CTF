<?php

    require_once '../modules/database.php';
    require_once '../modules/session.php';
    require_once '../modules/logging.php';

    // Checks if user is logged in
    if (!isset($_SESSION['logged_in'])) {
        echo "You are not logged in\n";
        logInfo('ERROR', 'Manage request while not logged in');
        updateIpFailure($_SERVER['REMOTE_ADDR']);
        exit();
    }

    //Check for request parameters
    if(!isset($_GET['action'])) {
        echo "Missing action";
        logInfo('ERROR', 'Missing Action in Request');
        updateIpFailure($_SERVER['REMOTE_ADDR']);
        exit();
    }
    if(!in_array($_GET['action'], array('deposit', 'withdraw', 'balance', 'close'))) {
        echo "Invalid Action";
        logInfo('ERROR', 'Invalid Action: ' . $action);
        updateIpFailure($_SERVER['REMOTE_ADDR']);
        exit();
    }
    if($_GET['action'] !== "close" && $_GET['action'] !== "balance" && !is_numeric($_GET['amount'])) {
        echo "Invalid Amount";
        logInfo('ERROR', 'Invalid Amount: ' . $amount);
        updateIpFailure($_SERVER['REMOTE_ADDR']);
        exit();
    }
    
    if(time() > ($_SESSION['lastaccess']+600)){
        endSession();
        echo "Session Timed out\n";
        logInfo('WARNING', 'Session Time Out');
        updateIpFailure($_SERVER['REMOTE_ADDR']);
        exit();
    }
    else{

        $_SESSION['lastaccess'] = time();
        //store current session id, once the new session is initialised for the user trying to login.
        $old_session_id = session_id();
        session_regenerate_id();
        
        //the new session id is propagated to user through cookies. 
        $new_session_id = session_id();

        // Get the action and amount from the URL
        $action = $_GET['action'];
        $amount = isset($_GET['amount']) ? (int)$_GET['amount'] : null;

        $balance = (int)getBalance($_SESSION['username']);
        
        // Perform the action and update the balance
        if ($action === "deposit") {
            $new_balance = $balance + $amount;
            updateBalance($_SESSION['username'], $new_balance);
            echo 'balnce=' . $new_balance;
            logInfo('INFO', 'Deposit: ' . $amount);
            updateIpSuccess($_SERVER['REMOTE_ADDR']);
            exit();
        } elseif ($action === "withdraw") {
            if ($balance >= $amount) {
                $new_balance = $balance - $amount;
                updateBalance($_SESSION['username'], $new_balance);
                echo 'balance=' . $new_balance;
                logInfo('INFO', 'Withdrew: ' . $amount);
            } else {
                // Displays an error message
                echo "Insufficient funds!\n";
                logInfo('WARNING', 'Insufficient funds for withdraw!');
                updateIpFailure($_SERVER['REMOTE_ADDR']);
                exit();
            }
        } elseif ($action === "balance") {
            echo 'balance' . $balance;
            logInfo('INFO', "Query Balance: " . $balance);
            updateIpSuccess($_SERVER['REMOTE_ADDR']);
            exit();
        } elseif ($action === "close") {
            closeAccount($_SESSION['username']);
            echo 'Your account has been closed.';
            logInfo('INFO', 'Account Closed');
            updateIpSuccess($_SERVER['REMOTE_ADDR']);
            endSession();
            exit();
        } else {
            echo "Invalid Action";
            logInfo('ERROR', 'Invalid Action: ' . $action);
            updateIpFailure($_SERVER['REMOTE_ADDR']);
            exit();
        }
    }
    

?>