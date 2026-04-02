<?php
session_start();
include('includes/connect.php');

// Debug output (remove after testing)
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION['name'])) {
    header('location: User_login.php');
    exit;
}

if (isset($_POST['orderid'])) {
    $orderid = (int)$_POST['orderid'];
    
    if ($orderid > 0) {
        $sql = "UPDATE order_table SET status='Cancelled' WHERE orderid = $orderid";
        $result = mysqli_query($con, $sql);
        
        if (!$result) {
            // Log the error (you can remove this later)
            error_log("Cancel order failed: " . mysqli_error($con));
        }
    }
}

header('location: User_dashboard.php?section=orders');
exit;
?>
