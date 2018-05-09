<?php
    // Based on http://lpmj.net/4thedition/

    require_once __DIR__.'/init.php';
    require_once __DIR__.'/functions.php';

    $page = isset($_GET['page']) ? $_GET['page'] : null;

    $protected_page = in_array($page, ['profile', 'friends', 'members', 'messages']);

    require_once __DIR__.'/header.php';

    if ($page === null) {
        echo "<br><span class='main'>Welcome to $appname,";
        if ($loggedin) {
            echo " $user, you are logged in.";
        } else {
            echo ' please sign up and/or log in to join in.';
        }
        echo '</span>';
    } else {
        if ($protected_page === false || ($protected_page === true && $loggedin === true)) {
            require_once __DIR__."/pages/$page.php";
        }
    }

    require_once __DIR__.'/footer.php';
