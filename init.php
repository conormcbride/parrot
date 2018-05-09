<?php
    require_once __DIR__.'/config.php';

    session_start();

    $connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
    if ($connection->connect_error) {
        die($connection->connect_error);
    }

    if (isset($_SESSION['user'])) {
        $user = $_SESSION['user'];
        $loggedin = true;
        $userstr = "($user)";
    } else {
        $loggedin = false;
        $userstr = '(Guest)';
    }
