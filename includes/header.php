<?php

session_id('cart');
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $page_title; ?></title>
    <link href="includes/cupcakeStyles.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<header>
    <img id="logo" src="images/Logo.png" alt="Sweet Serendipity Logo" width="225" height="105"/>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="cupcakeList.php">Cupcakes</a></li>
            <li><a href="viewCart.php">Order</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li><a href="admin_login.php">Admin</a></li>
            <?php
            if(!isset($_SESSION['userID']) && !isset($_SESSION['adminID'])) {
                echo "<li><a href='user_login.php'>Login</a></li>";
            } else {
                echo "<li><a href='logout.php'>Logout</a></li>";
            }

//            error_reporting(0);

            ?>

        </ul>
    </nav>
</header>
<main>
