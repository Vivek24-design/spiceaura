<?php
session_start();
include('includes/connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['Cart'])) {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        $myitems = array_column($_SESSION['cart'], 'Item_Name');
        if (in_array($_POST['Item_Name'], $myitems)) {
            echo "<script>document.addEventListener('DOMContentLoaded',function(){showToast('Item already in cart','warning',2500,function(){window.location.href='';});});</script>";
        } else {
            $_SESSION['cart'][] = [
                'Item_Name' => $_POST['Item_Name'],
                'Price' => $_POST['Price'],
                'Quantity' => 1
            ];
            echo "<script>document.addEventListener('DOMContentLoaded',function(){showToast('Item added to cart!','success',2000,function(){window.location.href='';});});</script>";
        }
    }

    if (isset($_POST['Remove_Item'])) {
        foreach ($_SESSION['cart'] as $key => $value) {
            if ($value['Item_Name'] == $_POST['Item_Name']) {
                unset($_SESSION['cart'][$key]);
                $_SESSION['cart'] = array_values($_SESSION['cart']);
                echo "<script>document.addEventListener('DOMContentLoaded',function(){showToast('Item removed from cart','info',2000,function(){window.location.href='My_Cart.php';});});</script>";
                break;
            }
        }
    }

    if (isset($_POST['click'])) {
        $name = mysqli_real_escape_string($con, $_POST['text1']);
        $mobile = mysqli_real_escape_string($con, $_POST['text2']);
        $address = mysqli_real_escape_string($con, $_POST['text3']);
        $amount = mysqli_real_escape_string($con, $_POST['text4']);

        // Do NOT overwrite $_SESSION['name'] – it holds the logged-in username.
        // Store delivery/customer name separately.
        $_SESSION["delivery_name"] = $name;
        $_SESSION["amount"] = $amount;

        $logged_in_user = mysqli_real_escape_string($con, $_SESSION['name']);
        $insert_query = "INSERT INTO order_table(name, username, mobile, address, totalamount, status) VALUES ('$name','$logged_in_user','$mobile','$address','$amount','Pending')";

        if (mysqli_query($con, $insert_query)) {
            echo "<script>
            (function(){
                function tryToast(){
                    if(typeof showToast === 'function'){
                        showToast('🎉 Order placed successfully! Redirecting to payment...', 'success', 2200, function(){ window.location.href='payment.php'; });
                    } else {
                        setTimeout(tryToast, 50);
                    }
                }
                document.addEventListener('DOMContentLoaded', tryToast);
            })();
            </script>";
        } else {
            echo "<script>
            (function(){
                function tryToast(){
                    if(typeof showToast === 'function'){
                        showToast('❌ Error: " . addslashes(mysqli_error($con)) . "', 'error', 5000);
                    } else {
                        setTimeout(tryToast, 50);
                    }
                }
                document.addEventListener('DOMContentLoaded', tryToast);
            })();
            </script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Shopping Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <?php include('includes/toast.php'); ?>
    <style>
        * {
            font-family: system-ui;
        }

        .container-fluid {
            background-color: blue;
            width: 7%;
            height: 5vh;
            margin-left: 85%;
        }

        .nav-item {
            padding: 0px 10px;
        }

        .nav-link {
            color: white;
            font-weight: 600;
            font-size: 18px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a href="My_Cart.php" class="button text-light">My
                Cart(<?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>)</a>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center border rounded bg-light my-5">
                <h1>Cart</h1>
            </div>

            <div class="col-lg-8">
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th>Serial Number</th>
                            <th>Item Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
                            foreach ($_SESSION['cart'] as $key => $value) {
                                $sr = $key + 1;
                                echo "
                            <tr>
                                <td>$sr</td>
                                <td>$value[Item_Name]</td>
                                <td>$value[Price] <input type='hidden' class='iprice' value='$value[Price]'></td>
                                <td>
                                    <input type='number' class='iquantity' onchange='subtotal()' value='$value[Quantity]' min='1' max='10'>
                                </td>
                                <td class='itotal'>0</td>
                                <td>
                                    <form action='' method='POST'>
                                        <button name='Remove_Item' class='btn btn-sm btn-outline-danger'>Remove</button>
                                        <input type='hidden' name='Item_Name' value='$value[Item_Name]'>
                                    </form>
                                </td>
                            </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6'>Your cart is empty</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <div class="col-lg-3">
                <div class="border bg-light rounded p-4">
                    <h5>Grand Total: <span id="gtotal">0</span></h5>
                    <br>
                    <form action="" method="POST" id="purchase-form">
                        <div class="mb-3">
                            <label>Full Name</label>
                            <input type="text" name="text1" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Phone Number</label>
                            <input type="number" name="text2" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Address</label>
                            <input type="text" name="text3" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Amount</label>
                            <input type="text" name="text4" id="amount" class="form-control" required readonly>
                        </div>
                        <button class="btn btn-primary btn-block w-100" name="click" id="purchase-btn">🛒 Make
                            Purchase</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function subtotal() {
            let gt = 0;
            let iprice = document.getElementsByClassName('iprice');
            let iquantity = document.getElementsByClassName('iquantity');
            let itotal = document.getElementsByClassName('itotal');
            let gtotal = document.getElementById('gtotal');

            for (let i = 0; i < iprice.length; i++) {
                let total = parseFloat(iprice[i].value) * parseInt(iquantity[i].value);
                itotal[i].innerText = total.toFixed(2);
                gt += total;
            }

            gtotal.innerText = gt.toFixed(2);
            document.getElementById("amount").value = gt.toFixed(2);
        }

        document.addEventListener("DOMContentLoaded", function () {
            subtotal();
            document.querySelectorAll('.iquantity').forEach(item => {
                item.addEventListener('change', subtotal);
            });

            // Make Purchase — show instant toast on submit
            var purchaseForm = document.getElementById('purchase-form');
            if (purchaseForm) {
                purchaseForm.addEventListener('submit', function (e) {
                    var btn = document.getElementById('purchase-btn');
                    if (btn) {
                        btn.disabled = true;
                        btn.innerHTML = '⏳ Placing Order...';
                    }
                    showToast('Placing your order, please wait...', 'info', 3000);
                });
            }
        });
    </script>
</body>

</html>

</html>