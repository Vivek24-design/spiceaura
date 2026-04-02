<?php
session_start();
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bootstrap demo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  <?php include('includes/toast.php'); ?>
</head>
<style>
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

<body>
  <nav class="navbar navbar-expand-lg">
    <div class="container-fluid">

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav m-auto">
        </ul>
      </div>
      <?php
      $count = 0;
      if (isset($_SESSION['cart'])) {
        $count = count($_SESSION['cart']);
      }

      ?>


      <a href="My_Cart.php" class="button text-light">My Cart(<?php echo $count; ?>)</a>
    </div>
    </div>
  </nav>


</body>

</html>