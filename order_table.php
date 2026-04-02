<?php
include("includes/connect.php");
if (isset($_POST['click'])) {

    $name = $_POST['text3'];
    $mobile = $_POST['text4'];
    $address = $_POST['text5'];
    $email = $_POST['text6'];
    $city = $_POST['text7'];
    $pincode = $_POST['text8'];
    $status = $_POST['text9'];
    $totalquantity = $_POST['text10'];
    $totalamount = $_POST['text11'];
    $orderdate = $_POST['text12'];
    $ordertime = $_POST['text13'];


    $insert_query = "INSERT INTO order_table(`name`, `mobile`, `address`, `email`, `city`, `pincode`, `status`, `totalquantity`, `totalamount`, `orderdate`, `ordertime`) 
    VALUES ('$name','$mobile','$address','$email','$city','$pincode','$status','$totalquantity','$totalamount','$orderdate','$ordertime')";

    if ($insert_query) {
        $toast_msg = 'Processing order...';
        $toast_type = 'info';
    }
    $result = mysqli_query($con, $insert_query);
    if ($result) {
        $toast_msg = 'Order added successfully!';
        $toast_type = 'success';
    }
}
?>
<form action="" method="post" class="mb-2" enctype="multipart/form-data">


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Order Table</title>
    </head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: white;
            color: gray;
        }

        .container {
            width: 100%;
            margin: auto;
            display: flex;
            flex-direction: column;
            padding: 10px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .menu-table {
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease-in-out;
        }

        table {
            width: 100%;
            max-width: 400px;
            margin: 0 auto;
            border-collapse: collapse;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        td {
            padding: 12px;
            text-align: left;
            display: flex;
            flex-direction: column;
        }

        td input {
            width: 100%;
            padding: 8px;
            margin-top: 4px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            transition: border-color 0.3s ease;
        }

        td input:focus {
            border-color: #007bff;
            outline: none;
        }

        .menu-table tr:nth-child(even) {
            background-color: #f9f9f9;
            color: black;
        }

        .menu-table tr:hover {
            background-color: #e0e0e0;
            cursor: pointer;
        }

        button {
            font-size: 14px;
            width: 90px;
            padding: 10px;
            border-radius: 10px;
            background-color: white;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        button:hover {
            background-color: blue;
            color: white;
            transform: scale(1.3);
        }

        input,
        textarea {
            align-content: center;
            height: 50px;
            width: 200px;
            font-size: 15px;
            margin-bottom: 10px;
        }

        .notification {
            display: none;
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            margin-top: 20px;
        }
    </style>

    <body>
        <div class="container">
            <h1>Order Table</h1>
            <table class="menu-table">
                <td>Name</td>
                <td><input type="text" name="text3"></td>
                <td>Mobile</td>
                <td><input type="text" name="text4"></td>
                <td>Address</td>
                <td><input type="text" name="text5"></td>
                <td>E-mail</td>
                <td><input type="text" name="text6"></td>
                <td>City</td>
                <td><input type="text" name="text7"></td>
                <td>Pincode</td>
                <td><input type="text" name="text8"></td>
                <td>Status</td>
                <td><input type="text" name="text9"></td>
                <td>totalquantity</td>
                <td><input type="number" name="text10"></td>
                <td>totalamount</td>
                <td><input type="number" name="text11"></td>
                <td>orderdate</td>
                <td><input type="date" name="text12"></td>
                <td>ordertime</td>
                <td><input type="time" name="text13"></td>
                <td></td>
                <td><button name="click">Submit</button></td>

                </tr>
            </table>
        </div>
        <?php include 'includes/toast.php'; ?>
        <?php if (!empty($toast_msg)): ?>
        <script>document.addEventListener('DOMContentLoaded',function(){showToast(<?php echo json_encode($toast_msg); ?>,<?php echo json_encode($toast_type); ?>,3000);});</script>
        <?php endif; ?>
    </body>

    </html>