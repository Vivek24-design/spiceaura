<?php
include('../includes/connect.php');

if (isset($_POST['update'])) {
    $foodid = $_POST['foodid'];
    $new_price = $_POST['new_price'];
    $image_name = $_FILES['food_image']['name'];
    $image_tmp = $_FILES['food_image']['tmp_name'];

    if (!empty($image_name)) {
        $target_directory = "../images/";
        $target_file = $target_directory . basename($image_name);
        move_uploaded_file($image_tmp, $target_file);

        $update_sql = "UPDATE food_table SET image='$image_name', price='$new_price' WHERE foodid='$foodid'";
    } else {
        $update_sql = "UPDATE food_table SET price='$new_price' WHERE foodid='$foodid'";
    }

    mysqli_query($con, $update_sql);
}

$sql = "SELECT * FROM food_table";
$result = mysqli_query($con, $sql);
?>
<?php
include("admin.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Edit Food Details</title>
</head>
<style>
    .main {
        height: 100vh;
        width: 100%;
        background-image: url(../images/pexels-ella-olsson-572949-1640777.jpg);
        background-size: 100% 100%;
        background: repeat;
        position: relative;
    }
</style>

<body>
    <div class="main">
    <div class="container mt-4">
        <h1 class="text-center">Edit Food Details</h1>
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Food Name</th>
                    <th>Price</th>
                    <th>Current Image</th>
                    <th>Update Details</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $row['foodid']; ?></td>
                        <td><?php echo $row['foodname']; ?></td>
                        <td><?php echo $row['price']; ?></td>
                        <td><img src="../images/<?php echo $row['image']; ?>" width="100px"></td>
                        <td>
                            <form action="" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="foodid" value="<?php echo $row['foodid']; ?>">
                                <input type="text" name="new_price" class="form-control mb-2" placeholder="Enter new price" required>
                                <input type="file" name="food_image" class="form-control mb-2">
                                <button type="submit" name="update" class="btn btn-success">Update</button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>