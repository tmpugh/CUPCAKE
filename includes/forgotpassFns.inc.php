<?php
/**
 * Created by PhpStorm.
 * User: crector
 * Date: 3/17/18
 * Time: 2:50 PM
 */

function redirect_user($page="changePass.php") {
    $url=$page;
    header("Location: $url");

    exit();
}

function checkLogin($dbc, $fName='', $lName='', $email='') {
    $errors=array();


    if(!empty($fName)) {
        $fn=mysqli_real_escape_string($dbc, $fName);
    } else {
        $errors[]="You forgot to enter your first name.";
    }

    if(!empty($lName)) {
        $ln=mysqli_real_escape_string($dbc, $lName);
    } else {
        $errors[]="You forgot to enter your last name.";
    }

    if(!empty($email)) {
        $em=mysqli_real_escape_string($dbc, $email);
    } else {
        $errors[]="You forgot to enter your email.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }




    if(empty($errors)) {
        $q="SELECT user_id FROM registration WHERE first_name='$fn' && last_name='$ln' && email='$em'";

        $r=mysqli_query($dbc, $q);


        if(mysqli_num_rows($r)==1) {
            $row=mysqli_fetch_array($r, MYSQLI_ASSOC);
            return array(true, $row);
        } else {
            $errors[]="Your information does not match those on file.";
        }
    }
        return array(false, $errors);


}
