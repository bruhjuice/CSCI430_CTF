<?php

require_once '../modules/logging.php';
require_once '../modules/session.php';
require_once '../modules/database.php';

startSession();
logInfo("INFO", "Recieved Request: ". $_SERVER['REQUEST_URI']);

//Check IP info
$ip = $_SERVER['REMOTE_ADDR'];
if(isset($_SESSION["ip"]) && $ip !== $_SESSION["ip"]) {
    logInfo("ERROR", "Mismatch IPs: " . $ip . " and " . $_SESSION["ip"]);
}
if(!checkIP($ip)) {
    insertNewIP($ip);
}
if(isBlockedIP($ip)) {
    updateLastAttempted($ip);
    echo "Rate Limit Exceeded";
    exit();
}


switch ($_GET['filename']) {
    case 'login.php':
        require '../src/login.php';
        break;

    case 'logout.php':
        require '../src/logout.php';
        break;

    case 'manage.php':
        require '../src/manage.php';
        break;

    case 'register.php':
        require '../src/register.php';
        break;

    default:
        echo "Page not found";
        break;
}

?>