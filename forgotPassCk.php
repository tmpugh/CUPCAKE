<?php
/**
 * Created by PhpStorm.
 * User: crector
 * Date: 3/17/18
 * Time: 1:58 PM
 */


if($_SERVER['REQUEST_METHOD']=='POST') {
    require('includes/forgotpassFns.inc.php');
    require('db_connect.php');

    //check login
    list($check, $data)=checklogin($dbc, $_POST['fName'], $_POST['lName'], $_POST['email']);

    if($check) {

        $to=$_POST['email'];
        $subject="Reset Password";
        $body.="First Name: $fName\n";
        $body.="Last Name: $lName\n";
        $body.="Reset Link: https://blue.butler.edu/~tmpugh/CME419/htdocs/CUPCAKES/changePass.php\n";

        $sendMail=mail($to, $subject, $body);

        redirect_user('checkEmail.php');

    } else {
        $errors= $data;
    }



    mysqli_close($dbc);
}

include('forgotPass.php');

?>
