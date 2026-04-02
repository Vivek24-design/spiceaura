<?php
session_start();
include("includes/connect.php");

if(isset($_POST['click']))
{

$name = $_POST['name'];
$payment_mode = $_POST['payment_mode'];
$amount = $_POST['amount'];

$cardtype = $_POST['card'];
$nameoncard = $_POST['nameoncard'];
$cardno = $_POST['cardno'];
$expdate = $_POST['expdate'];
$cvv = $_POST['cvv'];

if($payment_mode == "COD")
{

$insert_query = "INSERT INTO payment(name,cardtype,amount,cardno,nameoncard,expdate,cvs)
VALUES('$name','Cash On Delivery','$amount','','','','')";

}
else
{

$insert_query = "INSERT INTO payment(name,cardtype,amount,cardno,nameoncard,expdate,cvs)
VALUES('$name','$cardtype','$amount','$cardno','$nameoncard','$expdate','$cvv')";

}

$result = mysqli_query($con,$insert_query);

if($result)
{

$order_id = mysqli_insert_id($con);

header("Location: thanks.php?order_id=$order_id");
exit();

}

}
?>

<!DOCTYPE html>
<html>
<head>

<title>Payment Mode</title>

<style>

body{
background-image:url(images/payment.avif);
background-size:cover;
font-family:Arial;
}

.container{
width:450px;
margin:60px auto;
background:white;
padding:30px;
border-radius:10px;
box-shadow:0 5px 10px rgba(0,0,0,0.2);
}

h2{
text-align:center;
color:orangered;
}

label{
font-weight:bold;
}

input,select{
width:100%;
padding:8px;
margin-top:5px;
margin-bottom:10px;
}

button{
width:100%;
padding:10px;
background:orangered;
color:white;
border:none;
font-size:16px;
cursor:pointer;
}

button:hover{
background:red;
}

</style>

<script>

function showCard(){
document.getElementById("cardSection").style.display="block";
}

function hideCard(){
document.getElementById("cardSection").style.display="none";
}

</script>

</head>

<body>

<div class="container">

<h2>Payment Mode</h2>

<form method="post">

<label>Name</label>
<input type="text" name="name" value="<?php echo $_SESSION['name']; ?>">

<label>Payment Method</label>

<br>

<input type="radio" name="payment_mode" value="COD" checked onclick="hideCard()"> Cash on Delivery

<br>

<input type="radio" name="payment_mode" value="Card" onclick="showCard()"> Card Payment

<br><br>

<div id="cardSection" style="display:none;">

<label>Card Type</label>
<select name="card">
<option value="Credit Card">Credit Card</option>
<option value="Debit Card">Debit Card</option>
<option value="Master Card">Master Card</option>
</select>

<label>Name on Card</label>
<input type="text" name="nameoncard">

<label>Card Number</label>
<input type="password" name="cardno">

<label>Expire Date</label>
<input type="date" name="expdate">

<label>CVV</label>
<input type="password" name="cvv">

</div>

<label>Total Amount</label>
<input type="text" name="amount" value="<?php echo $_SESSION['amount']; ?>" readonly>

<button name="click">Place Order</button>

</form>

</div>

</body>
</html>