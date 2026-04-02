<?php
include('../includes/connect.php');

if (isset($_POST['orderid'])) {
    $orderid = (int)$_POST['orderid'];
    mysqli_query($con, "DELETE FROM order_table WHERE orderid='$orderid'");
}

header('location: check_order.php');
exit;
?>
