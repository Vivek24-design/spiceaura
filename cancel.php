<?php
include('includes/connect.php');
if(isset($_GET['deleteid']))
{
    $id=$_GET['deleteid'];
    $sql="Update  order_table  set status='Cancelled' where orderid=$id";
    $result=mysqli_query($con,$sql);
    if($result)
    {
        echo"<script>
        document.addEventListener('DOMContentLoaded',function(){ showToast('Your food order has been cancelled','success',2500,function(){ window.location.href='checkorder.php'; }); });
        </script>";
        echo '<!DOCTYPE html><html><head></head><body>';
        include('includes/toast.php');
        echo '</body></html>';
        exit;
    }
    else{
        die(mysqli_error($con));
    }
}
?>