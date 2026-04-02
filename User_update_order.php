<?php
session_start();
include('includes/connect.php');

if (!isset($_SESSION['name'])) {
    header('location: User_login.php');
    exit;
}

if (isset($_POST['orderid'])) {
    $orderid = (int)$_POST['orderid'];
    $address = mysqli_real_escape_string($con, $_POST['address']);
    $mobile  = mysqli_real_escape_string($con, $_POST['mobile']);

    mysqli_query($con, "UPDATE order_table SET address='$address', mobile='$mobile' WHERE orderid='$orderid'");
}

header('location: User_dashboard.php?section=orders');
exit;
?>
