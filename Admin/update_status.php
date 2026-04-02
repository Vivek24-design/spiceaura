<?php
include('../includes/connect.php');

if (isset($_POST['update_status']) && isset($_POST['orderid']) && isset($_POST['status'])) {
    $orderid = (int) $_POST['orderid'];
    $status  = mysqli_real_escape_string($con, $_POST['status']);

    // Only allow valid statuses
    $allowed = ['Pending', 'In Progress', 'Delivered', 'Cancelled'];
    if (in_array($status, $allowed)) {
        $sql = "UPDATE order_table SET status = '$status' WHERE orderid = $orderid";
        mysqli_query($con, $sql);
    }
}

header('location:check_order.php');
exit;
?>
