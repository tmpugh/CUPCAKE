<?php
/**
 * Created by PhpStorm.
 * User: Taylor
 * Date: 5/3/18
 * Time: 11:08 AM
 */
if($_SERVER['REQUEST_METHOD']=='POST') {
    require('includes/loginFns.inc.php');
    require('db_connect.php');

    //check login
    list($check, $data)=checklogin($dbc, $_POST['userLogin'], $_POST['userPass']);

    if($check) {
        session_start();
        $_SESSION['userID'] = $data['user_id'];
        $_SESSION['firstName'] = $data['first_name'];

        redirect_user('loggedin.php');
    } else {
        $errors= $data;
    }
    mysqli_close($dbc);
}

include('user_login.php');

?>
