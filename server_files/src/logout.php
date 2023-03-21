<?php
    require_once("../modules/session.php");
    
    logInfo('INFO', 'Logout Successful');
    endSession();

    echo "Logout Successful\n";
?>

