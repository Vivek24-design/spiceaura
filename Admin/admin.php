<?php
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin</title>
  <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">

</head>
<style>
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Oswald', sans-serif;
  }
  body{
    height: 100vh;
    width: 100%;
    background-image: url(../images/new/pexels-ella-olsson-572949-1640777.jpg);
    background-size: 100% 100%;
  }

  header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 10%;
    background: transparent;
  }

  header ul {
    display: flex;
    list-style: none;
    border: 1px solid #ffcc00;
    background-color: #ffcc00;
    border-radius: 5px 40px;
  }

  header ul li {
    position: relative;
    margin: 0 20px;
    
  }

  header ul li a {
    text-decoration: none;
    color: black;
    font-weight: bold;
    font-size: 15px;
    padding: 10px 10px;
    display: block;
    transition: 0.3s ease-in-out;
    text-shadow:rgb(255, 89, 0) .5px .5px 0px;
  }

  header ul li a:hover {
    transform: scale(1.2);
  }

  .submenu {
    display: flex;
    flex-direction: column;
    position: absolute;
    width: 180px;
    background: wheat;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
    opacity: 0;
    visibility: hidden;
    transition: 0.3s ease-in-out;
  }

  header ul li:hover .submenu {
    opacity: 1;
    visibility: visible;
  }

  .submenu li {
    width: 90%;
  }

  .submenu li a {
    padding: 20px 15px;
    display: block;
    transition: 0.5s ease-in-out;
  }

  .submenu li a:hover {
    color: black;
  }
</style>

<body>
  <div class="container">
    <header>
      <div class="logo">
        <a href=""></a>
      </div>
      <nav>
        <ul>
          <li><a href="admin.php">Admin</a></li>
          <li><a href="">Add Detail</a>
            <ul class="submenu">

              <li><a href="add_Category.php">Add Category</a></li>

              <li><a href="add_food.php">Add Food</a></li>
            </ul>
          </li>
          <li><a href="">Edit Detail</a>
            <ul class="submenu">
            <li><a href="edit_category.php">Edit Food Category </a></li>
              <li><a href="edit_food.php">Edit food</a></li>

            </ul>
          </li>
          <li><a href="">Check Request</a>
            <ul class="submenu">
              <li><a href="Check_feedback.php">Check Feedback</a></li>
              <li><a href="check_order.php">Check Order</a></li>
              <li><a href="Check_payment.php">Check Payment</a></li>
            </ul>
          </li>
          <li><a href="">Setting</a>
            <ul class="submenu">
              <li><a href="../home.php">Logout</a></li>
            </ul>
        </ul>
        </li>
        </ul>
      </nav>
    </header>

  </div>


  <!-- <header>
  <div class="logo">
    <a href="#"></a>
  </div>
    <nav>
      
        <ul >
        <li><a href="admin.php">Admin</a></li>
          <li>
            <a href="#" >Add Detail</a>
            
            <ul class="submenu">
           
            </ul>
          </li>
          <li>
            <a href="#" >Edit Detail</a>
          
            <ul class="submenu">
           </ul>
              </li>
           
          
              

              <li>
            <a href="#" >Check Booking Detail</a>
            
            <ul class="submenu">
             </li>

              <li>
            <a href="#" ></a>
           <ul class="submenu">
            </ul>
             </li>



             <li>
            <a href="#" >Setting</a>
            
            <ul class="submenu">
            
             </li>


        </ul>
     
     
    </nav>

  
   -->
  <!-- php -->

  <?php

  if (isset($_GET['insert_Category'])) {
    include('add_category.php');
  }

  if (isset($_GET['insert_food'])) {
    include('add_food.php');
  }
  if (isset($_GET['insert_edit_food'])) {
    include('edit_food.php');
  }
  if (isset($_GET['insert_Edit_Category'])) {
    include('Edit_Category.php');
  }

  if (isset($_GET['insert_Edit_Product'])) {
    include('Edit_Product.php');
  }
  if (isset($_GET['insert_feedback'])) {
    include('feedback.php');
  }

  ?>



</body>

</html>