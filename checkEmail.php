<?php
/**
 * Created by PhpStorm.
 * User: crector
 * Date: 4/11/18
 * Time: 4:25 PM
 */

session_start();



$page_title="Check Email";
include('includes/header.php');



echo "<div class='allGood'><h2>Check your email!</h2><p>A link to reset your password has been sent to your email.</p></div>";

include('includes/footer.php');