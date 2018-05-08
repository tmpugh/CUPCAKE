<?php
/**
 * Created by PhpStorm.
 * User: crector
 * Date: 3/17/18
 * Time: 1:58 PM
 */
$page_title="Admin Login";
include('includes/header.php');


if(isset($errors) && !empty($errors)) {
    echo "<h1>Error!</h1>";
    echo "<p>The following error(s) occurred:<br/>";
    foreach($errors as $msg) {
        echo "- $msg<br/>";
    }
    echo "</p><p>Please try again.</p>";
}


if(!isset($_SESSION['adminID'])) {
    echo "
<div id='adminLogin'>

<h2>Admin Login</h2>
        <form action='admin_loginCk.php' method='POST'>
        <label for='adminLogin'>Login:</label>
        <input type='text' name='adminLogin' id='adminLogin'/><br/>
        <label for='adminPass'>Password:</label>
        <input type='password' name='adminPass' id='adminPass'/><br/>
        <input id='aLogin' type='submit' value='Login' name='login'/>
        </form>
    </div>";
} else {
    echo "<div class='addCupcake'><h2>Welcome, " . $_SESSION['firstName'] . "!</h2></div>";
}


if (isset($_SESSION['adminID'])) {
    echo "<div class='addCupcake'><a href='addCupcake.php'>Add Cupcake</a></div>";
}

include('includes/footer.php');

?>