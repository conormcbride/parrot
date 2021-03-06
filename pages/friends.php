<?php
    if (!$loggedin) {
        die('Please login.');
    }

    if (isset($_GET['view'])) {
        $view = sanitizeString($_GET['view']);
    } else {
        $view = $user;
    }

    if ($view == $user) {
        $name1 = $name2 = 'Your';
        $name3 = 'You are';
    } else {
        $name1 = "<a href='index.php?page=members&view=$view'>$view</a>'s";
        $name2 = "$view's";
        $name3 = "$view is";
    }

    echo "<div class='main'>";

    // Uncomment this line if you wish the user's profile to show here
    // showProfile($view);

    $followers = array();
    $following = array();

    $result = queryMysql("SELECT * FROM friends WHERE user='$view'");
    $num = $result->num_rows;

    for ($j = 0; $j < $num; ++$j) {
        $row = $result->fetch_array(MYSQLI_ASSOC);
        $followers[$j] = $row['friend'];
    }

    $result = queryMysql("SELECT * FROM friends WHERE friend='$view'");
    $num = $result->num_rows;

    for ($j = 0; $j < $num; ++$j) {
        $row = $result->fetch_array(MYSQLI_ASSOC);
        $following[$j] = $row['user'];
    }

    $mutual = array_intersect($followers, $following);
    $followers = array_diff($followers, $mutual);
    $following = array_diff($following, $mutual);
    $friends = false;

    if (sizeof($mutual)) {
        echo "<span class='subhead'>$name2 mutual friends</span><ul>";
        foreach ($mutual as $friend) {
            echo "<li><a href='index.php?page=members&view=$friend'>$friend</a>";
        }
        echo '</ul>';
        $friends = true;
    }

    if (sizeof($followers)) {
        echo "<span class='subhead'>$name2 followers</span><ul>";
        foreach ($followers as $friend) {
            echo "<li><a href='index.php?page=members&view=$friend'>$friend</a>";
        }
        echo '</ul>';
        $friends = true;
    }

    if (sizeof($following)) {
        echo "<span class='subhead'>$name3 following</span><ul>";
        foreach ($following as $friend) {
            echo "<li><a href='index.php?page=members&view=$friend'>$friend</a>";
        }
        echo '</ul>';
        $friends = true;
    }

    if (!$friends) {
        echo "<br>You don't have any friends yet.<br><br>";
    }

    echo "<a class='button' href='index.php?page=messages&view=$view'> View $name2 messages</a>";
    echo '</div>';
