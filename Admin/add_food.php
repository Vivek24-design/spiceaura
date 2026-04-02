
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
<?php
include("admin.php");
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
                margin-top: 40px;
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
                <tr>
                <td>foodname</td>
                <td><input type="text" name="text2"></td>
                </tr>
                <tr>
                <td>Description</td>
                <td><input type="text" name="text3"></td>
                </tr>
                <tr>
                <td>Price</td>
                <td><input type="text" name="text4"></td>
                </tr>
                <tr>
                <td>mrp</td>
                <td><input type="text" name="text5"></td>
                </tr>
                <tr>
                <td>Status</td>
                <td><input type="text" name="text6"></td>
                </tr>
                <tr>
                <td>classification</td>
                <td><input type="text" name="text7"></td>
                </tr>
                <tr>
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