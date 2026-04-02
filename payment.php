<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    <style>

   body
   {
    background-image: url(images/payment.avif);
    background-size: cover;
    height: 100vh;
    width: 
    border:2px solid red;
   }
   .container{
    margin-left: -10%;
    margin-top: 3%;
   }
h1{
      text-align: center;
    }
   
</style>

</head>

<?php
session_start();
?>
<?php


include('includes/connect.php');
if(isset($_POST['click']))
{
    echo" hello";

 $name= $_POST['text1'];
  $Card_type = $_POST['card'];

 
  $Name_on_card = $_POST['text3'];
  $amount = $_POST['text4'];

  $Expdate = $_POST['text5'];
  $cano=$_POST['text6'];
  $cvv= $_POST['text7'];
  echo $name, $Card_type,$Name_on_card,$amount,$Expdate,$cano,$cvv;
 
  $insert_query = "insert into payment(name,cardtype,amount,cardno,nameoncard,expdate,cvs) values ('$name',
  'Credit','$amount','$cano','$Name_on_card','$Expdate','$cvv')";
  if($insert_query)

  {
    // echo"<script> alert('found')</script>";
  }
  $result = mysqli_query($con,$insert_query);
 if ($result) {

        $order_id = mysqli_insert_id($con); // auto increment id

        header("Location: thanks.php?order_id=$order_id");
        exit();
    }

}

?> 

   

<form action="" method="post" enctype="multipart/form-data">
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        *
        {
            font-family: system-ui;
        }
        table,tr,td
        {
            border:2px solid orangered;
            border-collapse: collapse;
            padding:15px;
        }
        h1
        {
            text-align:center;
            color:orangered;
            
        }
        .container
        {
            
            width: 100%;
            height: 75vh;
            display:flex;
            justify-content:center;
            align-items:center;
            flex-direction:column;
        }
        td
        {
            text-align:center;
            font-weight:600;
            
        }
        input, select
        {
            width: 80%;
            height: 4vh;
        }
    
        button
        {
            padding: 5px;
            font-size: 15px;
             background-color: orangered;
            color: white;
             border: none;
             outline: 2px solid black;
             cursor: pointer;
        }
    </style>
</head>
<body>
    
    <div class="container">
    <h1>Payment</h1>
    <table>
       
        <tr>
            <td> Name</td>
            <td><input type="text" name="text1" value="<?php echo isset($_SESSION['delivery_name']) ? $_SESSION['delivery_name'] : $_SESSION['name']; ?>"></td>
        </tr>
        <tr>
            <td>Card Type</td>
            <td><select name="card">
              <option value="">Credit Card</option>
              <option value="">Debit Card</option>
              <option value="">Master Card</option>
            
            </select></td>
        </tr>
        <tr>
            <td>Name on Card</td>
            <td><input type="text" name="text3"></td>
        </tr>
        <tr>
            <td>Card Number</td>
            <td><input type="Password" name="text6" maxlength="16"></td>
        </tr>
        <tr>
            <td>Total Amount</td>
            <td><input type="text" name="text4" value="<?php echo   $_SESSION["amount"]?> " readonly></td>
        </tr>
        <tr>
            <td>Expire Date</td>
            <td>
              <input type="date" name="text5" id="">
        </tr>
        <tr>
            <td>Cvv Code</td>
            <td>
              <input type="password" name="text7" id="" maxlength="3">
        </tr>
        <tr>
            <td></td>
            <td><button name="click">Pay Now</button>
            </td>
        </tr>

    </table>
    </div>
</body>
</html>
</form>
