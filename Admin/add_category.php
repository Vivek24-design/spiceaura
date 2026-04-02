<?php
include("../includes/connect.php");
if (isset($_POST['click'])) {
    $categoryname = $_POST['text1'];

    if (isset($_FILES['image'])) {
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_type = $_FILES['image']['type'];
        move_uploaded_file($file_tmp, "../images/" . $file_name);
    }
    $insert_query = "insert into category_table(categoryname,image)values ('$categoryname','$file_name')";

    if ($insert_query) {
        echo "<script>alert ('FOUND')</script>";
    }
    $result = mysqli_query($con, $insert_query);
    if ($result) {
        echo "<script>alert ('Added')</script>";
    }
}
?>
<?php
include("admin.php");
?>

<form action="" method="post" enctype="multipart/form-data">
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <style>
     
                body{
    background:linear-gradient(rgba(0, 0, 0, 0.5),rgba(0, 0, 0, 0.2),rgba(0, 0, 0, 0.5)), url(../images/new/pexels-ella-olsson-572949-1640777.jpg);
    background-position: center;
    background-size: cover;
background-repeat: no-repeat;
}
            

            h1 {
                text-align: center;
                color: #ffff;
                text-shadow: 1px 1px 5px #004085;
                margin-top: 130px;
                font-size: 3rem;
                margin-inline: auto;
                font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;

            }

            table {
                margin-top: 20px;
                margin-inline: auto;
                height: 200px;
                width: 500px;
                border-collapse: collapse;
                font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;

                backdrop-filter: blur(20px);
                border-radius: 8px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }

            td {
                padding: 20px 20px;
                text-align: left;
                font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;

            }

            td input {
                width: 100%;
                padding: 12px;
                margin-top: 4px;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-sizing: border-box;
                font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
                font-weight: 100;
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
        <table>
            <h1>CATEGORY TABLE</h1>
            <tr>
                <td>Category Name</td>
                <td><input type="text" name="text1"></td>
            </tr>
            <tr>
                <td>Image</td>
                <td><input type="file" name="image"></td>
            </tr>
            <tr>
                <td></td>
                <td><button name="click">Submit</button></td>
            </tr>
        </table>
    </body>

    </html>
</form>