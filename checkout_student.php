<?php
/**
 * Created by PhpStorm.
 * User: crector
 * Date: 4/1/18
 * Time: 8:37 PM
 */


/*
 * Redirect to a different page in the current directory that was requested
 */
//if(isset($_SESSION['user_id'])) {
    $page_title="Order Confirmation";
    require('db_connect.php');

    include('includes/header.php');

    error_reporting(0);

    // If user is logged in, grab the customer id from your registration table to populate the variable below:



    if(!isset($_SESSION['userID'])) {
        echo "<div class='allGood'><p>Please login to continue checking out.</p></div>";
    } else {

        $cid = $_SESSION['userID'];



//Receive the order total
        $total = $_GET['total'];
        echo "<div class='allGood'>Your total is $" . $total . ".</div>";


//Turn autocommit off
        mysqli_autocommit($dbc, false);

        /*Automatically sets the pickup date to a week after the current date
         *In reality, there would be a field on the order form that would ask them when they wanted to pick up their order.
          *This then would be passed to this page and set in the $pickUpDate variable.
             * */

        $pickupDate = date("Y-m-d H:i:s", strtotime("+1 week"));


//add the order to the orders table
        $q = "INSERT INTO cupcakeOrder(user_id, total) VALUES ($cid, $total)";
        $r = mysqli_query($dbc, $q);
        if (mysqli_affected_rows($dbc) == 1) {
            $q2 = "SELECT order_id FROM cupcakeOrder WHERE user_id='$cid'";
            //Need the order id:
            $orderID = mysqli_insert_id($dbc);


            //Insert order into database
            //Query is a statement template
            $q2 = "INSERT INTO orderContent(order_id, cupcake_id, size_id, quantity, price, pickupDate) VALUES (?,?,?,?,?,?)";
            $stmt = mysqli_prepare($dbc, $q2);
//        echo "error" . mysqli_error($dbc);
            if (!$stmt) {
                die('mysqli error: ' . mysqli_error($dbc));
            } else {
//            echo "here it is: " . print_r($q2);
            }

            //Parses, compiles, and performs query & stores results without executing it
            mysqli_stmt_bind_param($stmt, 'iisids', $orderID, $cup_id, $cup_size, $cup_quant, $cup_price, $pickupDate);


//        //Execute each query; count the total affected
            $affected = 0;
            foreach ($_SESSION['cart'] as $key => $cupID) {
                $cup_id = $cupID['id'];
                $cup_size = $cupID['size'];
                $cup_quant = $cupID['quantity'];
                $cup_price = $cupID['price'];
                mysqli_stmt_execute($stmt);
                $affected += mysqli_stmt_affected_rows($stmt);
                //print "<p> ID: " . $cup_id . "<br/>Size:  " . $cup_size . "<br/>Quant:  " . $cup_quant . "<br/>Price:  " . $cup_price . "</p><hr/>";
            }

            //print "Affected: " . $affected;

            mysqli_stmt_close($stmt);

            //report on the success
            if ($affected == count($_SESSION['cart'])) {
                //commit transaction
                mysqli_commit($dbc);
//
//            //clear the cart
                unset($_SESSION['cart']);

//
//            //Message to the customer
                echo "<div class='allGood'><p>Thank  you for your order. You will be notified when your item(s) are ready
                    to be picked up.</p></div>";
            } else {
//            //Rollback and report errors
                mysqli_rollback($dbc);

                echo "<p>Your order could not be processed due to a system error. You will be
                    contacted in order to have the problem fixed. We apologize for the
                    inconvenience.</p>";
//
            }
        } else {
            // Rollback and report problem
            mysqli_rollback($dbc);

            echo "<p>Your order could not be processed due to a system error. You will be
                    contacted in order to have the problem fixed. We apologize for the inconvenience. :) </p>";
        }
        mysqli_close($dbc);

    }

 include ('includes/footer.php');







