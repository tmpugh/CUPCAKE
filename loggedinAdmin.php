<?php
/**
 * Created by PhpStorm.
 * User: crector
 * Date: 4/11/18
 * Time: 4:25 PM
 */

session_start();



$page_title="Logged In!";
include('includes/header.php');


if(!isset($_SESSION['adminID'])) {
    require('includes/admin_loginFns.inc.php');
    redirect_user();
}
echo "<div class='allGood'><h2>You are logged in!</h2><p>You are now logged in, " . $_SESSION['firstName'] . "!</p></div>";

include('includes/footer.php');