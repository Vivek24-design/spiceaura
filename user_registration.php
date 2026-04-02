<?php
include("includes/connect.php");
if (isset($_POST['click'])) {

    $username = $_POST['text1'];
    $email = $_POST['text2'];
    $password = $_POST['text3'];

    $insert_query = "insert into user_registration (username,email,password) 
    values ('$username','$email','$password')";

    
    $insert_query1 =  "insert into user_login (username,password) 
    values ('$username','$password')";

    if ($insert_query && $insert_query1) {
        echo "<script>alert ('FOUND')</script>";
    }
    $result = mysqli_query($con, $insert_query);
    $result1 = mysqli_query($con, $insert_query1);
    if ($result && $result1) {
        echo "<script>alert ('Added')</script>";
    }
}
?>
<form action="" method="post" class="mb-2" enctype="multipart/form-data">

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User Registration</title>
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
                height: 40vh;
                width: 100%;
                max-width: 400px;
                margin: 0 auto;
                border-collapse: collapse;
                background-color: gray;
                border-radius: 8px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }

            td {
                padding: 9px;
                text-align: left;
                color: white;
            }

            td input {
                color: red;
                width: 100%;
                padding: 8px;
                margin-top: 14px;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-sizing: border-box;
            }

            input:focus {
                border-color: #007bff;
                outline: none;
            }

            button {
                padding: 10px 20px;
                background-color:rgb(245, 9, 33);
                color: white;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                font-size: 16px;
                margin-left: 50px;
                transition: background-color 0.3s;
            }

            button:hover {
                background-color:rgb(94, 6, 7);
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
        <h1>USER REGISTRATION</h1>
        <table>
            <td>User_name</td>
            <td><input type="text" name="text1"></td>
            </tr>
            <tr>
                <td>E-mail</td>
                <td><input type="text" name="text2"></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input type="text" name="text3"></td>
            </tr>
            <tr>
                <td></td>
                <td><button name="click">Submit  <a href="User_login.php">Alreday Exist?</a></button></td>
            </tr>
        </table>
    </body>

    </html>
</form>