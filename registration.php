<?php
/**
 * Created by PhpStorm.
 * User: Taylor
 * Date: 5/3/18
 * Time: 11:19 AM
 */

$page_Title="Register";
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

<div id="newAccount">

    <h2>Create Account</h2>

    <form action="registrationCk.php" method="POST">
        <label for="firstName">First Name:</label>
        <input type="text" name="firstName" id="firstName"/><br/>
        <label for="lastName">Last Name:</label>
        <input type="text" name="lastName" id="lastName"/><br/>
        <label for="email">Email:</label>
        <input type="text" name="email" id="email"/><br/>
        <label for="username">Username:</label>
        <input type="text" name="username" id="username"/><br/>
        <label for="pass">Password:</label>
        <input type="password" name="pass" id="pass"/><br/>
        <label for="pass2">Re-enter Password:</label>
        <input type="password" name="pass2" id="pass2"/><br/>
        <input type="hidden" name="regDate" id="regDate"/><br/>
        <input id="register" type="submit" value="Create Account" name="create"/>
    </form>

</div>

<?php

include('includes/footer.php');
?>