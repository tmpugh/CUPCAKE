<?php
/**
 * Created by PhpStorm.
 * User: crector
 * Date: 3/17/18
 * Time: 1:58 PM
 */


if($_SERVER['REQUEST_METHOD']=='POST') {
    require('includes/admin_loginFns.inc.php');
    require('db_connect.php');

    //check login
    list($check, $data)=checklogin($dbc, $_POST['adminLogin'], $_POST['adminPass']);

    if($check) {
        session_start();
        $_SESSION['adminID'] = $data['admin_id'];
        $_SESSION['firstName'] = $data['firstName'];


        redirect_user('loggedinAdmin.php');
    } else {
        $errors= $data;
    }

    mysqli_close($dbc);
}

include('admin_login.php');

?>
