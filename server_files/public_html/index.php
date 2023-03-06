<?php

switch ($_GET['filename']) {
    case 'login':
        require '../src/login.php';     // your news functions
        break;

    case 'logout':
        require '../src/lougout.php';
        break;

    case 'manage':
        require '../src/manage.php';
        break;

    case 'register':
        require '../src/register.php';
        break;

    default:
        header('HTTP/1.0 404 Not Found');
        include 'tpl/page_not_found.tpl.php';
    break;
}

?>