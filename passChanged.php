<?php
/**
 * Created by PhpStorm.
 * User: crector
 * Date: 4/11/18
 * Time: 4:25 PM
 */

session_start();



$page_title="Password Changed!";
include('includes/header.php');


echo "<div class='allGood'><h2>Success!</h2><p>Your password has been updated.</p></div>";

include('includes/footer.php');