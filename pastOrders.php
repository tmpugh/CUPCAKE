<?php
/**
 * Created by PhpStorm.
 * User: Taylor
 * Date: 5/4/18
 * Time: 6:31 PM
 */

$page_title="Past Orders";
include('includes/header.php');

require('db_connect.php');

date("d-m-Y");



$q="SELECT order_id, orderDate FROM cupcakeOrder WHERE user_id=" . $_SESSION['userID'];


$r=mysqli_query($dbc, $q);

//$orderDate = $row['orderDate'];

if($r) {
    echo "<div id='pastOrders'><h2>Past Orders</h2><table>";
    while($row=mysqli_fetch_array($r, MYSQLI_ASSOC)) {
        echo "<tr>";
//         echo "<th>" . $row['total']. "</th>";
         echo "<th colspan='2'>" . date("F d, Y", strtotime($row['orderDate'])) . "</th>";
         echo "</tr>";


        $q2="SELECT cupcake_name, quantity FROM orderContent INNER JOIN cupcakes
              USING(cupcake_id) WHERE order_id=" . $row['order_id'] . " AND orderContent.cupcake_id=cupcakes.cupcake_id";



        $r2=mysqli_query($dbc, $q2);

        if($r2) {
            while($row2=mysqli_fetch_array($r2, MYSQLI_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $row2['cupcake_name'] . "</td>";
                echo "<td>" . $row2['quantity'] . "</td><br/>";
                echo "</tr>";
//                echo $row2['cupcake_name'] . " "  . $row2['quantity'];
            }
        }
    }
    echo "</table></div>";
}



include('includes/footer.php');

?>