<?php
/**
 * Created by PhpStorm.
 * User: Taylor
 * Date: 5/3/18
 * Time: 11:28 PM
 */

$page_title="Forgot Password";
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

<div id="forgotPass">

    <h2>Forgot Password</h2>

<form action="forgotPassCk.php" method="post">
    <label for="fName">First Name:</label>
    <input type="text" id="fName" name="fName"/><br/>
    <label for="lName">Last Name:</label>
    <input type="text" id="lName" name="lName"/><br/>
    <label for="email">Email:</label>
    <input type="text" id="email" name="email"/><br/>
    <input id="forgot" id="submit" type="submit" name="sumbit" value="Change Password"/>
</form>

</div>

<?php

include('includes/footer.php');

?>
