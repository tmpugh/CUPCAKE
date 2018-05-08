<?php
/**
 * Created by PhpStorm.
 * User: Taylor
 * Date: 5/3/18
 * Time: 11:06 AM
 */

$page_title="User Login";
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
<div id="userLogin">

    <h2>User Login</h2>

    <form action="user_loginCk.php" method="POST">
        <label for="userLogin">Login:</label>
        <input type="text" name="userLogin" id="userLogin"/><br/>
        <label for="userPass">Password:</label>
        <input type="password" name="userPass" id="userPass"/><br/>
        <input id="login" type="submit" value="Login" name="login"/>
    </form>

<a href="registration.php">Create Account</a><br/>
<a href="forgotPass.php">Forgot Password</a>

</div>

<?php
include('includes/footer.php');
?>