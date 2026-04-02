<?php
include('menu_bar.php');
?>
<?php

include('includes/connect.php');


if (isset($_POST['click'])) {
  $Person_name = $_POST['text1'];
  $Mobile = $_POST['text2'];
  $Address = $_POST['text3'];
  $amount = $_POST['text4'];
  // Do NOT overwrite $_SESSION['name'] – it holds the logged-in username.
  // Store delivery name separately if needed.
  $_SESSION["delivery_name"] = $_POST['text1'];
  $_SESSION["amount"] = $_POST['text4'];

  // ── Save updated quantities back to session ─────────────────────────────
  if (isset($_POST['quantities']) && is_array($_POST['quantities'])) {
    foreach ($_POST['quantities'] as $key => $qty) {
      if (isset($_SESSION['cart'][$key])) {
        $_SESSION['cart'][$key]['Quantity'] = max(1, intval($qty));
      }
    }
  }

  $logged_in_user = mysqli_real_escape_string($con, $_SESSION['name']);
  $insert_query = "INSERT INTO order_table(name, username, mobile, address, totalamount, status) 
  VALUES('$Person_name','$logged_in_user','$Mobile','$Address','$amount','Pending')";

  $show = mysqli_query($con, $insert_query);
  if ($show) {
    echo "<script>alert ('Order Saved Successfully')
    window.open('paymentmode.php','_self');
    </script>";

  }
}


?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bootstrap demo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
    crossorigin="anonymous"></script>
</head>
<style>
  * {
    font-family: system-ui;
  }
</style>

<body>
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center border rounded bg-light my-5">
        <h1>Cart </h1>

      </div>
      <div class="col-lg-8">
        <table class="table">
          <thead class="text-center">
            <tr>
              <th scope="col">Serial Number</th>
              <th scope="col">Item Name</th>
              <th scope="col">Price</th>
              <th scope="col">Quantity</th>
              <th scope="col">Total</th>
              <th scope="col"></th>

            </tr>
          </thead>
          <tbody class="text-center">
            <?php
            $total = 0;
            if (isset($_SESSION['cart'])) {
              foreach ($_SESSION['cart'] as $key => $value) {
                $sr = $key + 1;

                // print_r($value);
                echo "
    <tr>
      <td>$sr</td>
      <td>$value[Item_Name]</td>
      <td>$value[Price]<input type='hidden' class='iprice' value='$value[Price]'></td>
    <td>
      <input type='number' class='iquantity' onchange='subtotal()' data-key='$key' value='$value[Quantity]' min='1' max='10'>
    </td>
    <td class='itotal'>0</td>
    <td>
    <form action='managecard.php' method='POST'>
    <button name='Remove_Item' class='btn btn-sm btn-outline-danger'>Remove </button>
    <input type='hidden' name='Item_Name' value='$value[Item_Name]'>
    </form>
    </tr>
    ";
              }
            }
            ?>

          </tbody>
        </table>
      </div>
      <div class="col-lg-3">
        <div class="border bg-light rounded p-4">

          <h5>Grand Total:</h5>
          <h5 class="text-right" id="gtotal"></h5>
          <br>
          <?php
          if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {


            ?>

            <form action="" method="POST">
              <div class="mb-3">
                <label>Full Name</label>
                <input type="text" name="text1" class="form-control">
              </div>
              <div class="mb-3">
                <label>Phone Number</label>
                <input type="tel" name="text2" class="form-control" maxlength="10" required>
              </div>
              <div class="mb-3">
                <label>Address</label>
                <input type="text" name="text3" class="form-control" required>
              </div>
              <div class="mb-3">
                <label>Amount</label>
                <input type="text" name="text4" id="amount" class="form-control" required readonly>
              </div>
              <!-- <div class="form-check">
  <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
  <label class="form-check-label" for="flexRadioDefault2">
     Cash On Delivery 
  </label>
</div> -->
              <br>
              <!-- Hidden quantity inputs – synced by JS so session gets updated values -->
              <div id="quantity-hidden-inputs"></div>
              <button class="btn btn-primary btn-block" name="click">Make Purchase</button>
            </form>
            <?php
          }
          ?>
        </div>
      </div>
    </div>
    <script>
      var gt = 0;

      var iprice = document.getElementsByClassName('iprice');
      var iquantity = document.getElementsByClassName('iquantity');
      var itotal = document.getElementsByClassName('itotal');
      var gtotal = document.getElementById('gtotal');


      function subtotal() {
        gt = 0;
        var hiddenContainer = document.getElementById('quantity-hidden-inputs');
        hiddenContainer.innerHTML = ''; // clear old hidden inputs

        for (i = 0; i < iprice.length; i++) {
          var qty = parseInt(iquantity[i].value) || 1;
          var price = parseFloat(iprice[i].value) || 0;
          itotal[i].innerText = (price * qty).toFixed(0);
          gt = gt + (price * qty);

          // Create hidden input with the cart key so PHP can update session
          var cartKey = iquantity[i].getAttribute('data-key');
          var hidden = document.createElement('input');
          hidden.type = 'hidden';
          hidden.name = 'quantities[' + cartKey + ']';
          hidden.value = qty;
          hiddenContainer.appendChild(hidden);
        }

        gtotal.innerText = gt.toFixed(0);
        document.getElementById("amount").value = gt.toFixed(0);
      }
      subtotal();

    </script>

    
</body>

</html>