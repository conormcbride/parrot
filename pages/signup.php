<div class='main'>
<h3>Please enter your details to sign up</h3>

<?php
    $account_created = false;
    $error = $user = $pass = '';

    if (isset($_SESSION['user'])) {
        destroySession();
    }

    if (isset($_POST['user'])) {
        $user = sanitizeString($_POST['user']);
        $pass = sanitizeString($_POST['pass']);

        if ($user == '' || $pass == '') {
            $error = 'Not all fields were entered<br><br>';
        } else {
            $result = queryMysql("SELECT * FROM members WHERE user='$user'");

            if ($result->num_rows) {
                $error = 'That username already exists<br><br>';
            } else {
                queryMysql("INSERT INTO members VALUES('$user', '$pass')");
                echo '<h4>Account created</h4>Please Log in.<br><br>';
                $account_created = true;
            }
        }
    }

    if ($account_created === false) {
        ?>
    <form method='post' action='index.php?page=signup'><?="$error"?>
        <span class='fieldname'>Username</span>
        <input type='text' maxlength='16' name='user' value='<?=$user?>' onBlur='checkUser(this)'><span id='info'></span>
        <br>
        <span class='fieldname'>Password</span><input type='text' maxlength='16' name='pass' value='<?=$pass?>'>
        <br>
        <span class='fieldname'>&nbsp;</span>
        <input type='submit' value='Sign up'>
    </form>
<?php 
    } ?>

</div>
