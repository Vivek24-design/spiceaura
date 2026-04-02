<?php
include('includes/connect.php');
$result = mysqli_query($con, "DESCRIBE order_table");
echo "<pre>";
while($row = mysqli_fetch_assoc($result)) {
    print_r($row);
}
echo "</pre>";
?>
