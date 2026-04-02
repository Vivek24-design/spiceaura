<?php
include("../includes/connect.php");
if (isset($_POST['click'])) {

    $category_name = $_POST['category'];
    $foodname = $_POST['text2'];
    $price = $_POST['text4'];
    $description = $_POST['text3'];
    $mrp = $_POST['text5'];
    $status = $_POST['text6'];
    $classification = $_POST['text7'];

    if (isset($_FILES['image'])) {

        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_type = $_FILES['image']['type'];

        move_uploaded_file($file_tmp, "../images/" . $file_name);
    }
    $insert_query = "INSERT INTO food_table(category_name,foodname,description,mrp, price,status,image,classification) 
  VALUES ('$category_name','$foodname','$description','$mrp','$price','$status','$file_name','$classification')";

    if ($insert_query) {
        $toast_msg = 'Processing...';
        $toast_type = 'info';
    }
    $result = mysqli_query($con, $insert_query);
    if ($result) {
        $toast_msg = 'Food item added successfully!';
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
        <title>Restaurant Menu</title>
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

        input, textarea {
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
            <h1>Restaurant Menu</h1>
            <table class="menu-table">
                <tr>
                    <td>image</td>
                    <td><input type="file" name="image"></td>
                <tr>
                    <td>Select-Category
                        <?php
                        $query = ("select * from category_table");
                        $run = mysqli_query($con, $query);
                        $rowcount = mysqli_num_rows($run);
                        ?>

                    <td> <select name="category">
                            <option selected>Select Food type</option>
                            <?php
                            for ($i = 1; $i <= $rowcount; $i++) {
                                $row = mysqli_fetch_array($run);
                            ?>

                                <option value="<?php echo  $row["categoryname"] ?>"> <?php echo  $row["categoryname"] ?> </option>
                            <?php
                            }
                            ?>
                        </select></td>
                </tr>
                <td>foodname</td>
                <td><input type="text" name="text2"></td>
                <td>Description</td>
                <td><input type="text" name="text3"></td>
                <td>Price</td>
                <td><input type="text" name="text4"></td>
                <td>mrp</td>
                <td><input type="text" name="text5"></td>
                <td>Status</td>
                <td><input type="text" name="text6"></td>
                <td>classification</td>
                <td><input type="text" name="text7"></td>
                <td></td>
                <td><button name="click">Submit</button></td>

                </tr>
            </table>
        </div>
        <?php include '../includes/toast.php'; ?>
        <?php if (!empty($toast_msg)): ?>
        <script>document.addEventListener('DOMContentLoaded',function(){showToast(<?php echo json_encode($toast_msg); ?>,<?php echo json_encode($toast_type); ?>,3000);});</script>
        <?php endif; ?>
    </body>

    </html>