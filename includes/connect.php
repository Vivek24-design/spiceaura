<?php
$con = mysqli_connect('localhost','root','','resdb');
if($con){
// echo"Connect Found";
}
else{
    echo"failed to connect";
}
?>