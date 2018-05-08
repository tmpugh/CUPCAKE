<?php
/**
 * Created by PhpStorm.
 * User: Taylor
 * Date: 4/19/18
 * Time: 11:29 AM
 */

$page_title='Add to Cart';
include ('includes/header.php');

if($_SERVER['REQUEST_METHOD']=="POST") {

    //Was ID passed?
    if(isset($_POST['ccID'])) {
        $ccID = $_POST['ccID'];
        $ccSize = $_POST['ccSize'];
        $ccQuantity = $_POST['ccQuantity'];
        $indexKey = $ccID.$ccSize;
        //result: 1mini  4regualar-GF
        $addMore=false;

        require('db_connect.php');
        $q = "SELECT cupcake_name FROM cupcakes WHERE cupcake_id='$ccID'";
        $r = mysqli_query($dbc, $q);

        if($r) {
            $row=mysqli_fetch_array($r, MYSQLI_ASSOC);
            $ccName=$row['cupcake_name'];
        }

        //Check cart for cupcake type and size
        foreach($_SESSION['cart'] as $key => $value) {
            if($key==$indexKey) {
                $addMore=true;
                break;
            } // ends if statement

        } // ends foreach statement

        // Add to current product in cart
        if($addMore) {
            if($ccQuantity==1) {
                $_SESSION['cart'][$indexKey] ['quantity']++;
                echo "<p>" . $ccQuantity . " more " . $ccName . " " . $ccSize .
                    "cupcake has been added to your shopping cart. </p>";
            } elseif($ccQuantity>1) {
                $_SESSION['cart'][$indexKey]['quantity']+=$ccQuantity;
                echo "<p>" . $ccQuantity . " more " . $ccName . " " . $ccSize .
                    " cupcakes have been added to your shopping cart. </p>";
            }
        } else { //new product added to your shopping cart
            $q2="SELECT price FROM price INNER JOIN size USING(size_id) WHERE 
                  size.cupcake_id='$ccID' && price.size_id='$ccSize'";

            $r2=mysqli_query($dbc, $q2);

            if($r2) {
                $row2=mysqli_fetch_array($r2, MYSQLI_ASSOC);
                $ccPrice=$row2['price'];

                $_SESSION['cart'][$indexKey]=array(
                    'id' => $ccID,
                    'quantity' => $ccQuantity,
                    'price' => $ccPrice,
                    'size' => $ccSize
                );

                if($ccQuantity==1) {

                    echo "<div class='addtocart'><p>" . $ccQuantity . " " . $ccName . " " . $ccSize .
                        "cupcake has been added to your shopping cart.</p></div>";
                } elseif($ccQuantity>1) {

                    echo "<div class='addtocart'><p>" . $ccQuantity . " " . $ccName . " " . $ccSize .
                        "cupcakes have been added to your shopping cart.</p></div>";
                } //end of else if
            } else {
                echo "<p>This page has been accessed in error.</p>";
            } //end of if($r2)
            mysqli_close($dbc);
        } // closes add new product to cart


    } else {
        echo "<p>There has been an error.</p>";
    }



}
 include ('includes/footer.php');

?>