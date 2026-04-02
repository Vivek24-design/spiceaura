<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Order Confirmation</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    background:#f5f7fb;
    font-family:system-ui;
}

.container{
    max-width:900px;
}

.card{
    border-radius:10px;
    box-shadow:0px 5px 20px rgba(0,0,0,0.1);
}

.card-header{
    font-size:22px;
    font-weight:600;
}

.table th{
    text-align:center;
}

.table td{
    vertical-align:middle;
}

tfoot{
    font-weight:bold;
    background:#f1f1f1;
}

.success-message{
    margin-top:20px;
}

.card{
    margin-left:20%;
}
</style>

</head>

<body>

<div class="container mt-5">
<div class="card">

<div class="card-header bg-success text-white text-center">
<h3>Order Confirmation</h3>
</div>

<div class="card-body">

<h5>Customer Details</h5>

<table class="table table-bordered">
<tr>
<th>Customer Name</th>
<td><?php echo isset($_SESSION['delivery_name']) ? $_SESSION['delivery_name'] : $_SESSION['name']; ?></td>
</tr>

<tr>
<th>Total Amount</th>
<td>₹ <?php echo $_SESSION['amount']; ?></td>
</tr>
</table>


<h5 class="mt-4">Order Details</h5>

<table class="table table-striped text-center">

<thead class="table-dark">
<tr>
<th>Serial No</th>
<th>Item Name</th>
<th>Price</th>
<th>Quantity</th>
<th>Total</th>
</tr>
</thead>

<tbody>

<?php

$total=0;

if(isset($_SESSION['cart']))
{
foreach($_SESSION['cart'] as $key => $value)
{
$sr=$key+1;
$item_total=$value['Price']*$value['Quantity'];
$total+=$item_total;

echo "
<tr>
<td>$sr</td>
<td>$value[Item_Name]</td>
<td>₹ $value[Price]</td>
<td>$value[Quantity]</td>
<td>₹ $item_total</td>
</tr>
";
}
}

?>

</tbody>

<tfoot>
<tr>
<th colspan='4' class='text-end'>Grand Total</th>
<th>₹ <?php echo $total; ?></th>
</tr>
</tfoot>

</table>

<div class="text-center success-message">
<h4 class="text-success">Your Order Has Been Placed Successfully!</h4>
<p>Thank you for shopping with us.</p>

<a href="home.php" class="btn btn-primary">Continue Shopping</a>
</div>

</div>
</div>
</div>

</body>
</html>