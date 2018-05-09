<?php
    function createTable($name, $query)
    {
        queryMysql("CREATE TABLE IF NOT EXISTS $name($query)");
        echo "Table '$name' created or already exists.<br>";
    }

    function queryMysql($query)
    {
        global $connection;
        $result = $connection->query($query);
        if (!$result) {
            die($connection->error);
        }

        return $result;
    }

    function destroySession()
    {
        $_SESSION = array();

        if (session_id() != '' || isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time() - 2592000, '/');
        }

        session_destroy();
    }

    function sanitizeString($var)
    {
        global $connection;
        $var = strip_tags($var);
        $var = htmlentities($var);
        $var = stripslashes($var);

        return $connection->real_escape_string($var);
    }

    function showProfile($user)
    {
        global $home_url;
        $pic_url = $home_url."/uploads/$user.jpg";
        $pic_path = __DIR__."/uploads/$user.jpg";
        if (file_exists($pic_path)) {
            echo "<img src='$pic_url' style='float:left;'>";
        }

        $result = queryMysql("SELECT * FROM profiles WHERE user='$user'");

        if ($result->num_rows) {
            $row = $result->fetch_array(MYSQLI_ASSOC);
            echo stripslashes($row['text'])."<br style='clear:left;'><br>";
        }
    }
