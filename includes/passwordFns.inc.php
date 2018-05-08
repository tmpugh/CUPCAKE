<?php
/**
 * Created by PhpStorm.
 * User: crector
 * Date: 3/17/18
 * Time: 2:50 PM
 */

function redirect_user($page="passChanged.php") {
    $url=$page;
    header("Location: $url");
    exit();
}

function checkLogin($dbc, $login='', $pass='', $pass2='')
{
    $errors = array();
    if (!empty($login)) {
        $ul = mysqli_real_escape_string($dbc, $login);
    } else {
        $errors[] = "You forgot to enter your username.";
    }

    if (empty($pass)) {
        $errors[] = "You forgot to enter your password.";
    }

    if ($pass != $pass2) {
        $errors[] = "Your passwords don't match.";
    }

    if (strlen($pass) < 6) {
        $errors[] = "Your password must be at least 6 characters.";
    }

    if (strlen($pass) > 12) {
        $errors[] = "Your password must be no longer than 12 characters.";
    }


    if (empty($errors)) {
        $q = "SELECT user_id FROM registration WHERE user_login='$ul'";

        $r = mysqli_query($dbc, $q);

        if(mysqli_num_rows($r)==1) {
            $row=mysqli_fetch_array($r, MYSQLI_ASSOC);
            return array(true, $row);
        } else {
            $errors[] = "Your username was not found.";
        }
    }
    return array(false, $errors);

}

?>