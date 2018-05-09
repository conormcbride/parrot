<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?="$appname $userstr"?></title>
        
        <script src="js-ext/jquery-1.11.3.js"></script>
        <link rel='stylesheet' href='css/styles.css' type='text/css'>
    </head>
    <body>
        <center>
            <canvas id='logo' width='624' height='96'>$appname</canvas>
        </center>
        <div class='appname'><?="$appname $userstr"?></div> 
        <script src='js/javascript.js'></script>
<?php 
    if ($loggedin) {
        echo "<br><ul class='menu'>".
                  "<li><a href='index.php?page=members&view=$user'>Home</a></li>".
                  "<li><a href='index.php?page=members'>Members</a></li>".
                  "<li><a href='index.php?page=friends'>Friends</a></li>".
                  "<li><a href='index.php?page=messages'>Messages</a></li>".
                  "<li><a href='index.php?page=profile'>Edit Profile</a></li>".
                  "<li><a href='index.php?page=logout'>Log out</a></li></ul><br>";
    } else {
        echo "<br><ul class='menu'>".
                    "<li><a href='index.php'>Home</a></li>".
                    "<li><a href='index.php?page=signup'>Sign up</a></li>".
                    "<li><a href='index.php?page=login'>Log in</a></li></ul><br>";

        if ($protected_page) {
            echo "<span class='info'>&#8658; You must be logged in to view this page.</span><br><br>";
        }
    }
