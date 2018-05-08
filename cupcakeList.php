<?php
/**
 * Created by PhpStorm.
 * User: Taylor
 * Date: 3/27/18
 * Time: 12:06 PM
 */

$page_title="Cupcake List";
include('includes/header.php');

require('db_connect.php');

$q="SELECT cupcake_id, cupcake_name, cupcake_img FROM cupcakes";

$r=mysqli_query($dbc, $q);  //Connects to database and runs query

if($r) {
    echo "<article>";
    while($row=mysqli_fetch_array($r, MYSQLI_ASSOC)) {
//    print_r($row);
        echo '<div class="cBox"><a href="viewCupcake.php?cupcake_id=' . $row['cupcake_id']
            . '"><img src="cupcakes/' . $row['cupcake_img'] . '" alt="' . $row['cupcake_name']
            . '"/> <h3>' . $row['cupcake_name'] . '</h3></a></div>';

    }
    echo '</article>';
} else {
    echo "Sorry. We were unable to run the query.";
}

include ('includes/footer.php');

?>