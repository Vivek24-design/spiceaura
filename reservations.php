<?php
include("includes/connect.php");
if (isset($_POST['click'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $Sort = $_POST['Sort'];
    $reservation_date = $_POST['reservation_date'];
    $reservation_time = $_POST['reservation_time'];
    $guests = $_POST['guests'];

    $insert_query = "INSERT INTO reservations (name, email, phone, Sort, reservation_date, reservation_time, guests) 
        VALUES ('$name', '$email', '$phone', '$Sort', '$reservation_date', '$reservation_time', '$guests')";

    if ($insert_query) {
        $toast_msg = 'Processing reservation...';
        $toast_type = 'info';
    }
    $result = mysqli_query($con, $insert_query);
    if ($result) {
        $toast_msg = 'Reservation submitted successfully!';
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
        <title>Reservation</title>
    </head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            height: 100vh;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-left: 20px;
        }

        table {
            width: 100%;
            max-width: 400px;
            margin: 0 auto;
            border-collapse: collapse;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        td {
            padding: 12px;
            text-align: left;
        }

        td input {
            width: 100%;
            padding: 8px;
            margin-top: 4px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        td input:focus {
            border-color: #007bff;
            outline: none;
        }

        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-left: 50px;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }

        button:active {
            background-color: #004085;
        }

        @media (max-width: 480px) {
            table {
                width: 90%;
            }
        }
    </style>

    <body>
        <table>
        <h1>Reservations</h1>
        <tr>
            <td>Name</td>
            <td><input type="text" name="name"></td>
        </tr>
        <tr>
            <td>Email</td>
            <td><input type="text" name="email"></td>
        </tr>
        <tr>
            <td>Phone</td>
            <td><input type="text" name="phone"></td>
        </tr>
        <tr>
            <td>Phone</td>
            <td><input type="text" name="phone"></td>
        </tr>
        <tr>
            <td>Sort</td>
            <td><input type="text" name="Sort">
        </td>
        </tr>
        <tr>
            <td>reservation_date</td>
            <td><input type="date" name="reservation_date"></td>
        </tr>
        <tr>
            <td>reservation_time</td>
            <td><input type="time" name="reservation_time"></td>
        </tr>
        <tr>
            <td>guests</td>
            <td><input type="number" name="guests"></td>
        </tr>
        <tr>
            <td></td>
            <td><button name="click">Submit</button></td>
        </tr>
        </table>
        <?php include 'includes/toast.php'; ?>
        <?php if (!empty($toast_msg)): ?>
        <script>document.addEventListener('DOMContentLoaded',function(){showToast(<?php echo json_encode($toast_msg); ?>,<?php echo json_encode($toast_type); ?>,3000);});</script>
        <?php endif; ?>
        <?php include 'footer.php'; ?>
    </body>
    </html>
    </form>