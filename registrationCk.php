<?php
/**
 * Created by PhpStorm.
 * User: Taylor
 * Date: 5/4/18
 * Time: 10:29 PM
 */
if($_SERVER['REQUEST_METHOD']=='POST') {
    require('includes/registrationFns.inc.php');
    require('db_connect.php');

    //check login
    list($check, $data) = checklogin($dbc, $_POST['firstName'], $_POST['lastName'],
        $_POST['email'], $_POST['username'], $_POST['pass'], $_POST['pass2']);


    if ($check) {

        $fn = mysqli_real_escape_string($dbc, $_POST['firstName']);

        $ln = mysqli_real_escape_string($dbc, $_POST['lastName']);

        $em = mysqli_real_escape_string($dbc, $_POST['email']);

        $ul = mysqli_real_escape_string($dbc, $_POST['username']);

        $up = mysqli_real_escape_string($dbc, $_POST['pass']);


        //create account in registration table
        $q = "INSERT INTO registration (first_name, last_name, email, user_login, user_pass)
            VALUES ('$fn', '$ln', '$em', '$ul', '$up')";


        $r=mysqli_query($dbc, $q);


        //start a valid session for new user
        session_start();
        $_SESSION['userID'] = $_POST['username'];
        $_SESSION['firstName'] = $_POST['firstName'];

        redirect_user('accountCreated.php');
    } else {
        $errors = $data;
    }
    mysqli_close($dbc);
}

include('registration.php');

?>