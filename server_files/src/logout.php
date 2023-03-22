<?php
    require_once '../modules/session.php';
    require_once '../modules/logging.php';
    
    logInfo('INFO', 'Logout Successful');
    endSession();

    echo "Logout Successful\n";
?>

