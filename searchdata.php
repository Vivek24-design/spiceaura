<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<style>
    .container{
margin-top: 8vw;
    }
.red{
    font-style: italic;
}
</style>
<body>
<?php
include('includes/connect.php');
$data = $_GET['data'];
$sql = "SELECT * FROM order_table   WHERE orderid= $data";
$result = mysqli_query($con, $sql);
if($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    echo '<div class="container">
    <div class="jumbotron">
      <h1 class="display-4 text-center text-success">Welcome '.$row['name'].'</h1>
      <div style="display:flex;flex-direction:row;justify-content:space-between;align-item:center;">
      <p class=" red text-danger">Your  Order Id is:  '.$row['orderid'].'</p>
      <p class=" text-danger"style="margin-left:-5%;">Your Status is:  '.$row['status'].'</p>
      <button class="btn btn-primary"><a href="cancel.php?deleteid='.$data.'" class="text-light">Cancel Your Booking</a>
      </button>
      </div>
      
     
     
      <hr class="my-4">
      <p class="lead"></p>
      <a class="btn btn-dark btn-lg" href="home.php" role="button"> Back</a>
    </div>
    </div>';
}
?>

</body>
</html>