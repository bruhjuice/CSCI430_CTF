<?php
    require("../modules/config.php");
    require("../modules/session.php");
    
    logInfo('INFO', 'Logout Successful');
    endSession();

    //TODO Secure against session hijacking https://stackoverflow.com/questions/5081025/php-session-fixation-hijacking

    echo "Logout Successful";
?>

