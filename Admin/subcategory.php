<?php
include("../includes/connect.php");
if (isset($_POST['click'])) {

    $subcategory = $_POST['text1'];
    $category_name = $_POST['category'];

    if(isset($_FILES['image']))
  { 

     $file_name=$_FILES['image']['name'];
     $file_size=$_FILES['image']['size'];
     $file_tmp=$_FILES['image']['tmp_name'];
     $file_type=$_FILES['image']['type'];
    move_uploaded_file($file_tmp,"../images/". $file_name);
  }


    $insert_query = "INSERT INTO subcategory (subcategory,category_name,image) 
    VALUES ('$subcategory','$category_name', '$file_name')";

    if ($insert_query) {
        echo "<script>alert ('FOUND')</script>";
    }
    $result = mysqli_query($con, $insert_query);
    if ($result) {
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
    <title>Document</title>
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
</head>

<body>
    <h1>SUBCATEGORY</h1>
    <table>
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
            <td>SubCategory</td>
            <td><input type="text" name="text1"></td>
        </tr>

        <tr>
            <td>Image</td>
            <td><input type="file" name="image"></td>
        </tr>
        <tr>
            <td></td>"
            <td><button name="click">Submit</button></td>
        </tr>
    </table>
</body>

</html>
</form>