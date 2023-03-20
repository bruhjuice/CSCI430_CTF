<?php
    require("../modules/config.php");
    require("../modules/session.php");
    
    logInfo('INFO', 'Logout Successful');
    endSession();

    echo "Logout Successful\n";
?>

