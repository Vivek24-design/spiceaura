<?php
$order_id = $_GET['order_id'];
?>

<!DOCTYPE html>
<html>
<head>
<title>Thank You</title>

<style>

body{
font-family: Arial;
background:#f5f5f5;
text-align:center;
padding-top:100px;
}

.box{
background:white;
width:400px;
margin:auto;
padding:40px;
border-radius:10px;
box-shadow:0 4px 10px rgba(0,0,0,0.1);
}

h1{
color:green;
}

.order{
font-size:20px;
margin-top:20px;
color:#333;
}

button{
margin-top:30px;
padding:10px 20px;
font-size:16px;
background:blue;
color:white;
border:none;
border-radius:5px;
cursor:pointer;
}

button:hover{
background:darkblue;
}

</style>

</head>

<body>

<div class="box">

<h1>✅ Thank You For Your Order!</h1>

<p>Your order has been placed successfully.</p>

<div class="order">
Your Order ID is <b>#<?php echo $order_id; ?></b>
</div>

<a href="home.php">
<button>Back to Home</button>
</a>
<a href="checkorder.php">
<button>Check Order</button>
</a>

</div>

</body>
</html>