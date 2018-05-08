<?php
/**
 * Created by PhpStorm.
 * User: crector
 * Date: 3/17/18
 * Time: 2:50 PM
 */

function redirect_user($page="loggedinAdmin.php") {
    $url=$page;

    header("Location: $url");

    exit();
}

function checkLogin($dbc, $login='', $pass='') {
    $errors=array();
    if(!empty($login)) {
        $al=mysqli_real_escape_string($dbc, $login);
    } else {
        $errors[]="You forgot to enter your username.";
    }

    if(!empty($pass)) {
        $ap=mysqli_real_escape_string($dbc, $pass);
    } else {
        $errors[]="You forgot to enter your password.";
    }


    if(empty($errors)) {
        $q="SELECT admin_id, firstName from admin WHERE admin_login='$al' && admin_pass='$ap'";

        $r=mysqli_query($dbc, $q);


        if(mysqli_num_rows($r)==1) {
            $row=mysqli_fetch_array($r, MYSQLI_ASSOC);
            return array(true, $row);
        } else {
            $errors[]="The login information does not match those on file.";
        }
    }
        return array(false, $errors);


}
