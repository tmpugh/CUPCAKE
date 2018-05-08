<?php
/**
 * Created by PhpStorm.
 * User: crector
 * Date: 3/17/18
 * Time: 1:58 PM
 */


if($_SERVER['REQUEST_METHOD']=='POST') {
    require('includes/passwordFns.inc.php');
    require('db_connect.php');

    //check login
    list($check, $data)=checklogin($dbc, $_POST['username'], $_POST['pass'], $_POST['pass2']);

    if($check) {
        $ul=mysqli_real_escape_string($dbc, $_POST['username']);

        $up = mysqli_real_escape_string($dbc, $_POST['pass']);

        $q="UPDATE registration SET user_pass='$up' WHERE user_login ='$ul'";

        $r=mysqli_query($dbc, $q);



        session_start();
        $_SESSION['firstName'] = $data['first_name'];
        $_SESSION['lastName'] = $data['last_name'];
        $_SESSION['email'] = $data['email'];


        redirect_user('passChanged.php');
    } else {
        $errors= $data;
    }

    mysqli_close($dbc);
}

include('changePass.php');

?>
