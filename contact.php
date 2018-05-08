<?php
/**
 * Created by PhpStorm.
 * User: Taylor
 * Date: 5/3/18
 * Time: 5:56 PM
 */

$page_title="Contact Us ";
include('includes/header.php');

require('db_connect.php');


    if($_SERVER['REQUEST_METHOD']=='POST') {



    if (!empty($_POST['fName'])) {

    $fName = $_POST['fName'];
    } else {
    echo "<p>You did not enter a first name.</p>";
    }

    if (!empty($_POST['lName'])) {

    $lName = $_POST['lName'];
    } else {
    echo "<p>You did not enter a last name.</p>";
    }

    if (!empty($_POST['email'])) {

    $email = $_POST['email'];
    } else {
    echo "<p>You did not enter an email.</p>";
    }

    if (!empty($_POST['comment'])) {

        $comment = $_POST['comment'];
    } else {
        echo "<p>You did not enter a comment.</p>";
    }

    }

    ?>

<div class="contactBox">

    <h2>Contact Us</h2>

    <form action="contact.php" method="post">
        <label for="fName">First Name:</label>
        <input type="text" id="fName" name="fName"/><br/>
        <label for="lName">Last Name:</label>
        <input type="text" id="lName" name="lName"/><br/>
        <label for="email">Email:</label>
        <input type="text" id="email" name="email"/><br/>
        <label for="comment">Comments:</label>
        <textarea id="comment" name="comment"></textarea><br/>
        <input id="submit" type="submit" name="sumbit" value="Submit Form"/>



    </form>

</div>

<?php


$to="tmpugh@butler.edu";
$subject="Contact Form";
$body="First Name: $fName\n";
$body.="Last Name: $lName\n";
$body.="Email: $email\n";
$body.="Comment: $comment\n";



if($fName && $lName && $email && $comment) {
    $sendMail=mail($to, $subject, $body);
    echo "<div id='contact'><p>Thank you, " . $fName . ". We have received your information.<p/></div>";


}



include('includes/footer.php');

?>