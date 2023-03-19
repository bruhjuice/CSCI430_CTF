<?php
require '../modules/logging.php';
logInfo("INFO", "Recieved Request: ". $_SERVER['REQUEST_URI']);

switch ($_GET['filename']) {
    case 'login.php':
        require '../src/login.php';
        break;

    case 'logout.php':
        require '../src/lougout.php';
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