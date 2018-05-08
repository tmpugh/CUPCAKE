<?php
/**
 * Created by PhpStorm.
 * User: crector
 * Date: 4/11/18
 * Time: 4:25 PM
 */

$page_title="Logging Out";
include('includes/header.php');
if(!isset($_SESSION['adminID']) && !isset($_SESSION['userID']) ) {
    require('includes/loginFns.inc.php');
    redirect_user('cupcakeList.php');
} elseif (isset($_SESSION['adminID']))  {
    unset($_SESSION['adminID']);
    echo "<div class='allGood'><h2>You are logged out.</h2><p>Thank you, " . $_SESSION['firstName'] . ", for visiting. Please come back soon!</p></div>";
} elseif(isset($_SESSION['userID'])) {
    session_unset();
    session_destroy();
    echo "<div class='allGood'><h2>You are logged out.</h2><p>Thank you, for visiting. Please come back soon!</p></div>";
}

include('includes/footer.php');