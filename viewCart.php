<?php
/**
 * Created by PhpStorm.
 * User: Taylor
 * Date: 4/24/18
 * Time: 11:36 AM
 */

$page_title="Shopping Cart";
include ('includes/header.php');

if($_SERVER['REQUEST_METHOD']=='POST') {

    foreach($_POST['qty'] as $k => $v) {
        $postedKey = $k;
        $postedQuantity = $v;

        foreach($_SESSION['cart'] as $keyValue => $valueKey) {
            if($postedKey==$keyValue) {
                if($postedQuantity==0) {
                    unset($_SESSION['cart'][$keyValue]);
                } elseif($postedQuantity>0) {
                    $_SESSION['cart'][$keyValue]['quantity']= $postedQuantity;
                } //ends else if
            } //ends if
        } //ends foreach
    } //ends foreach posted qty
} //ends server request

echo '<form action="viewCart.php" method="post">';
echo '<table><tr>
<th>Cupcake Name</th>
<th>Size</th>
<th>Price</th>
<th>Quantity</th>
<th>Total</th>
</tr>';

$total=0; //Holds grand total

//print_r($_SESSION['cart']);
require ('db_connect.php');

foreach($_SESSION['cart'] as $key => $value) {
    $cup_key=$key;
    $cup_id=$value['id'];
    $cup_size=$value['size'];
    $cup_quantity=$value['quantity'];




$q = "SELECT c.cupcake_id, c.cupcake_name, s.size_id, p.price FROM 
      cupcakes AS c INNER JOIN size AS s USING(cupcake_id) INNER JOIN
      price AS p USING(size_id) WHERE c.cupcake_id='$cup_id' && 
      s.size_id='$cup_size'";

$r=mysqli_query($dbc, $q);

if($r) {
    $row=mysqli_fetch_array($r, MYSQLI_ASSOC);
    $queryID=$row['cupcake_id'].$row['size_id'];

    $subtotal=$row['price'] * $cup_quantity;
    $subtotal=number_format($subtotal, 2); //qty[1mini]
    $total+=$subtotal;
    $total=number_format($total, 2);

    //show item in table row
    echo '<tr><td>' . $row['cupcake_name'] . '</td><td>' . ucfirst($row['size_id']) .
            '</td><td>' . $row['price'] . '</td><td><input type="number" name="qty[' . $queryID . ']"
            value="' . $cup_quantity . '"/></td><td>$' . $subtotal . '</td>';
} else {
    echo "<p>The query did not run successfully.</p>";
}

}//end of foreach

echo "<tr><td colspan='4'>TOTAL</td><td>$" . $total . "</td></tr></table>";
echo '<input id="update" type="submit" name="submit" value="Update Cart" /></form>';
echo '<a href="checkout_student.php?total=' . $total . '"><input id="checkout" type="button" value="Checkout" name="Checkout"/></a>';

include ('includes/footer.php');