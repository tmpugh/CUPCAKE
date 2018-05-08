<?php
/**
 * Created by PhpStorm.
 * User: crector
 * Date: 3/17/18
 * Time: 2:50 PM
 */

function redirect_user($page="accountCreated.php") {
    $url = $page;
    //Redirect the user and complete the function
    header("Location: $url");
    //Quit the script
//    exit();
}

function checkLogin($dbc, $fName='', $lName='', $email='', $login='', $pass='', $pass2='')
{
    $errors = array();
    if (empty($fName)) {
        $errors[] = "You forgot to enter your first name.";
    }

    if (empty($lName)) {
        $errors[] = "You forgot to enter your last name.";
    }

    if (empty($email)) {
        $errors[] = "You forgot to enter your email.";
    }

    if (empty($login)) {
        $errors[] = "You forgot to enter your username.";
    }

    if (empty($pass)) {
        $errors[] = "You forgot to enter your password.";
    }

    if (empty($pass2)) {
        $errors[] = "You forgot to re-enter you password.";
    }


    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }

    if ($_POST['pass'] != $_POST['pass2']) {
        $errors[] = "Your passwords don't match.";
    }

    if (strlen($pass) < 6) {
        $errors[] = "Your password must be at least 6 characters.";
    }

    if (strlen($pass) > 12) {
        $errors[] = "Your password must be no longer than 12 characters.";
    }


    if (empty($errors)) {
        $ul = mysqli_real_escape_string($dbc, $login);

        $q = "SELECT user_id, first_name from registration WHERE user_login='$ul'";

        $r = mysqli_query($dbc, $q);

        if (mysqli_num_rows($r) > 0) {
            $errors[] = "That username already exists.";
        }
    }


    if (empty($errors)) {
        return array(true, "");
    } else {
        return array(false, $errors);
    }
}

?>
