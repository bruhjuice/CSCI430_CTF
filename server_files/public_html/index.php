<?php

switch ($_GET['filename']) {
    case 'login.php':
        require '../src/login.php';     // your news functions
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