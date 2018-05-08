<?php
$row=false;  //Track problems on our page

if(isset($_GET['cupcake_id']) && filter_var($_GET['cupcake_id'], FILTER_VALIDATE_INT,
        array('min_range' => 1))  ) {
    $ccID=$_GET['cupcake_id'];
}


require('db_connect.php');

$q="SELECT cupcake_id, cupcake_name, cupcake_desc, cupcake_img FROM cupcakes WHERE cupcake_id='$ccID'";

$r=mysqli_query($dbc, $q);

if($r) {
    $row=mysqli_fetch_array($r, MYSQLI_ASSOC);
    $page_title=$row['cupcake_name'];  //Name appears on tab
    include('includes/header.php');
    echo '<div class="iCupcake"><h1>' . $row['cupcake_name'] . '</h1>';
    echo '<img src="cupcakes/' . $row['cupcake_img'] . '" alt="' . $row['cupcake_name'] . '"/>';
    echo '<div class="cDesc"><p>' . $row['cupcake_desc'] . '</p>';
    echo '<form action="addtocart.php" method="post"><input type="hidden" name="ccID" value="' . $ccID . '"/>';

    //Query to get cupcake size
    $q2 = "SELECT size_id, price FROM price AS p INNER JOIN size AS s USING(size_id) WHERE s.cupcake_id='$ccID'";

    $r2=mysqli_query($dbc, $q2);

    if($r2) {
        echo '<label for="ccSize">Cupcake Size:</label>';
        echo '<select name="ccSize" id="ccSize">';
        while($row2=mysqli_fetch_array($r2, MYSQLI_ASSOC)) {
            echo '<option value="' . $row2['size_id'] . '">' . $row2['size_id'] . ' - ' . $row2["price"] . '</option>';
        }
        echo '</select><br/>';
    } else {
        echo "This cupcake is not available."; //Size query failed
    } //This ends the $r2 if statement
    echo '<label for="ccQuantity">Quantity:</label><input type="number" min="1" name="ccQuantity" id="ccQuantity"/><br/>';
    echo '<input type="submit" value="Add to Cart" name="submit"/></form></div></div>';
} else {

    echo "Sorry - this information is not available.";  //$r query failed
}

include('includes/footer.php');

?>