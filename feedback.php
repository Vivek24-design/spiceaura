<?php
include('menu_bar.php');
include("includes/connect.php");
if (isset($_POST['click'])) {
    $first_name = $_POST['text1'];
    $mobile_no = $_POST['text2'];
    $email_address = $_POST['text3'];
    $comment = $_POST['text4'];
    $insert_query = "INSERT INTO feedback_table(`first_name`, `mobile_no`, `email_address`, `comment`) 
VALUES ('$first_name','$mobile_no','$email_address','$comment')";
    if ($insert_query) {
        echo "<script>alert ('FOUND')</script>";
    }
    $result = mysqli_query($con, $insert_query);
    if ($result) {
        echo "<script>alert ('Review Added')</script>";
    }
}
?>


<form action="" method="post">
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                height: 100vh;
                background-image: url(images/new/pexels-ivan-samkov-7213436.jpg);
                background-size: 70% 100%;
            }

            .container {
                height: 100vh;
                width: 100%;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: end;
            }

            h1 {
                font-family: cursive;
                color: red;
                text-shadow: 2px 4px 5px rgba(0, 0, 0, 0.5);
                margin-right: 45px;
            }

            table {
                height: 60vh;
                width: 100%;
                max-width: 400px;
                border-collapse: collapse;
                background-color: whitesmoke;
                border-radius: 8px;
                box-shadow: 2px 8px 16px black;
                border: 2px solid red;
            }

            td {
                padding: 12px;
                text-align: left;
            }

            td input {
                width: 100%;
                padding: 8px;
                margin-top: 4px;
                border: 2px solid black;
                border-radius: 4px;
                box-sizing: border-box;
                background: transparent;
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
    </head>

    <body>
        <div class="container">
            
            <table>
            <h1>Feedback Table</h1>
                <tr>
                    <td>First name</td>
                    <td><input type="text" name="text1"></td>
                </tr>
                <tr>
                    <td>Mobile no</td>
                    <td><input type="text" name="text2"></td>
                </tr>
                <tr>
                    <td>Email address</td>
                    <td><input type="textarea" name="text3"></td>
                </tr>
                <tr>
                    <td>Comment</td>
                    <td><input name="text4"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><button name="click">Submit</button></td>
                </tr>
            </table>
        </div>
        <?php include 'footer.php'; ?>
    </body>

    </html>
</form>