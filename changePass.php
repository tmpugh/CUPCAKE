<?php
/**
 * Created by PhpStorm.
 * User: Taylor
 * Date: 5/7/18
 * Time: 8:26 PM
 */

$page_title="Change Password";
include('includes/header.php');

if(isset($errors) && !empty($errors)) {
    echo "<h1>Error!</h1>";
    echo "<p>The following error(s) occurred:<br/>";
    foreach($errors as $msg) {
        echo "- $msg<br/>";
    }
    echo "</p><p>Please try again.</p>";
}

?>

<div id="changePass">

    <h2>Change Password</h2>

<form action="changePassCk.php" method="POST">
    <label for="username">Username:</label>
    <input type="text" name="username" id="username"/><br/>
    <label for="pass">New Password:</label>
    <input type="password" name="pass" id="pass"/><br/>
    <label for="pass2">Re-type Password:</label>
    <input type="password" name="pass2" id="pass2"/><br/>
    <input id="change" type="submit" name="submit" value="Change Password"/>
</form>

    </div>

<?php

include('includes/footer.php');

?>