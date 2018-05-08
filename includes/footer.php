</main>
<footer>
    <?php
    if(!isset($_SESSION['userID'])) {
        echo "<ul>
        <li><a href=\"index.php\">Home</a></li>
        <li><a href=\"cupcakeList.php\">Cupcakes</a></li>
        <li><a href=\"viewCart.php\">Order</a></li>
        <li><a href=\"contact.php\">Contact</a></li>
        <li><a href=\"admin_login.php\">Admin</a></li>
        </ul>";
    } else {
        echo "<ul>
        <li><a href=\"viewCart.php\">Order</a></li>
        <li><a href=\"pastOrders.php\">Past Orders</a></li>
        <li><a href=\"changePass.php\">Change Password</a></li>
        <li><a href=\"contact.php\">Contact</a></li>
        <li><a href=\"logout.php\">Logout</a></li>
        </ul>";
    }
    ?>

</footer>

</body>
</html>