<?php

$_SESSION['username'] = "JohnDoe"; // Example sessioN

// Allowed pages
$allowed_pages = ['Beverages', 'Bread', 'Breakfast', 'maincrouse', 'Salads', 'SandvichWrap', 'sides', 'Desserts', 'Starters', 'liquor'];

// Function to load the page
function loadPage($page)
{
    global $allowed_pages;
    if (in_array($page, $allowed_pages)) {
        include($page . ".php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bonlicious</title>
    <script src="script.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        ::-webkit-scrollbar {
            background-color: #5e81ac;

        }

        ::-webkit-scrollbar-thumb {
            background-color: white;
            border: 5px solid #5e81ac;
            border-radius: 10px;
        }

        body {
            background: linear-gradient(45deg, #e3f2fd, #ffedd5);
            font-family: 'Poppins', sans-serif;
            color: #4a4e69;
            font-size: 24px;
        }

        /* NAVIGATION BAR */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 30px;
            background: #5e81ac;
            color: white;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 999;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .menu {
            display: flex;
            list-style: none;
        }

        .menu li {
            margin: 0 20px;
            font-size: 20px;
            font-weight: 600;
        }

        .menu a {
            text-decoration: none;
            color: #fff;
            transition: color 0.3s;
        }

        .menu a:hover {
            color: rgb(255, 231, 180);
        }

        .menu-toggle {
            display: none;
            font-size: 26px;
            cursor: pointer;
        }

        .logo {
            font-size: 28px;
            font-weight: 700;
            letter-spacing: 2px;
            cursor: pointer;
            transition: color 0.3s ease, transform 0.3s ease;
        }

        .logo:hover {
            color: rgb(180, 206, 255);
            transform: scale(1.1);
        }

        /* MENU SECTION */
        .menu-section {
            margin-top: 90px;
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 35px;
            margin-top: 25vh;
        }

        .menu-section a {
            text-decoration: none;
            color: black;
            font-weight: bold;
            display: flex;
            flex-direction: column;
            align-items: center;
            font-size: 18px;
        }

        .menu-section img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            transition: transform 0.3s ease-in-out;
        }

        .menu-section img:hover {
            transform: scale(1.1);
        }

        .content-section {
            text-align: center;
            padding: 30px;
        }

        /* General Styles */
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background: #f8f8f8;
            text-align: center;
            color: #333;
        }

        /* Discount Section */
        .discount-container {
            background: linear-gradient(135deg, rgb(142, 162, 186), #5e81ac);
            color: white;
            padding: 50px 10%;
            text-align: center;
            border-radius: 10px;
            margin: 40px auto;
            max-width: 1200px;
        }

        .discount-container h2 {
            font-size: 2.5rem;
            margin-bottom: 10px;
        }

        .discount-container p {
            font-size: 1.2rem;
            margin-bottom: 20px;
        }

        .discount-btn {
            background: white;
            color: #ff5722;
            border: none;
            padding: 12px 24px;
            font-size: 1.2rem;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .discount-btn:hover {
            background: #ffcc80;
            color: #fff;
        }

        /* Advertisement Section */
        .ad-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            padding: 50px 10%;
            max-width: 1200px;
            margin: auto;
        }

        .ad-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            width: 350px;
            text-align: center;
        }

        .ad-card img {
            width: 100%;
            height: auto;
        }

        .ad-card .ad-content {
            padding: 20px;
        }

        .ad-card h3 {
            font-size: 1.5rem;
            color: #ff9800;
            margin-bottom: 10px;
        }

        .ad-card p {
            font-size: 1.1rem;
            color: #666;
            margin-bottom: 15px;
        }

        .ad-btn {
            background: #ff9800;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 1rem;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .ad-btn:hover {
            background: #e68900;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .discount-container {
                padding: 40px 5%;
            }

            .discount-container h2 {
                font-size: 2rem;
            }

            .discount-container p {
                font-size: 1rem;
            }

            .discount-btn {
                font-size: 1rem;
                padding: 10px 20px;
            }

            .ad-container {
                flex-direction: column;
                align-items: center;
                padding: 30px 5%;
            }

            .ad-card {
                width: 100%;
                max-width: 350px;
            }
        }

        /* Responsive Menu */
        @media screen and (max-width: 768px) {
            .menu {
                display: none;
                flex-direction: column;
                text-align: center;
                position: absolute;
                top: 60px;
                left: 0;
                width: 100%;
                background: #5e81ac;
                padding: 10px 0;
                gap: 20px;
            }


            .menu-toggle {
                display: block;
            }
        }
    </style>
</head>

<body>

    <!-- NAVIGATION SECTION -->
    <nav class="navbar">
        <div class="logo">Bonlicious</div>
        <div class="menu-toggle">☰</div>
        <ul class="menu">
            <li><a href="home.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="gourmet.php">Gourmet</a></li>
            <li><a href="ambiance.php">Our Ambiance</a></li>
            <li class="cart" style="list-style: none"> <a href="My_Cart.php"><i class="fa-solid fa-cart-shopping"></i></a></li>
        </ul>
    </nav>

    <!-- MENU SECTION -->
    <div class="menu-section">
        <a href="?page=Beverages">
            <img src="images/png/Drinks-PNG-Isolated-Photo.png" alt="Beverages"> Beverages
        </a>
        <a href="?page=Salads">
            <img src="images/png/OIP.jpg" alt="Salads"> Salads
        </a>
        <a href="?page=maincrouse">
            <img src="images/png/restaurant-food-restaurant-food-top-view-ai-generative-free-png.webp" alt="Main Courses"> Main Courses
        </a>
        <a href="?page=sides">
            <img src="images/png/OIP (3).jpg" alt="Sides"> Sides
        </a>
        <a href="?page=Desserts" target="_blank">
            <img src="images/png/OIP (2).jpg" alt="Desserts"> Desserts
        </a>
        <a href="?page=Bread">
            <img src="images/png/OIPo.jpeg" alt="Bread"> Bread
        </a>
        <a href="?page=Starters">
            <img src="images/png/pngtree-plate-food-dish-appetizer-png-image_11389511.png" alt="Starters"> Starters
        </a>
        <a href="?page=Breakfast">
            <img src="images/png/restaurant-food-restaurant-food-top-view-ai-generative-free-png.webp" alt="Breakfast"> Breakfast
        </a>
        <a href="?page=SandvichWrap">
            <img src="images/png/OIP1.jpg" alt="Sandwich Wrap"> Sandwich Wrap
        </a>
        <a href="?page=liquor">
            <img src="images/png/liquor_bottles.png" alt="liquor"> Liquor
        </a>
    </div>

    <!-- CONTENT SECTION -->
    <div class="content-section">
        <?php
        if (isset($_GET['page']) && in_array($_GET['page'], $allowed_pages)) {
            loadPage($_GET['page']);
        } else {
            echo "<h2>Welcome to Our Menu</h2>";
        }
        ?>
    </div>
    <!-- Discount Section -->
    <section class="discount-container">
        <h2>Limited Time Offer!</h2>
        <p>Get **20% OFF** on all orders above $50. Hurry up, offer ends soon!</p>
        <a href="menu.php" class="discount-btn">Order Now</a>
    </section>

    <!-- Advertisement Section -->
    <section class="ad-container">
        <div class="ad-card">
            <img src="images/Dis&ad/pexels-anil-sharma-2149101452-30622217.jpg" alt="Delicious Food">
            <div class="ad-content">
                <h3>Try Our Special Dish</h3>
                <p>Enjoy our chef's signature dish with amazing flavors.</p>
                <a href="menu.php" class="ad-btn">View Menu</a>
            </div>
        </div>

        <div class="ad-card">
            <img src="images/Dis&ad/pexels-cristian-rojas-8459364.jpg" alt="Happy Hours">
            <div class="ad-content">
                <h3>Happy Hours</h3>
                <p>Buy 1 Get 1 Free on all beverages from 4 PM - 7 PM.</p>
                <a href="gourmet.php" class="ad-btn">Check Offers</a>
            </div>
        </div>

        <div class="ad-card">
            <img src="images/Dis&ad/pexels-mike-jones-9461804.jpg" alt="Fast Delivery">
            <div class="ad-content">
                <h3>Free Home Delivery</h3>
                <p>Order now and get your food delivered in just 30 minutes!</p>
                <a href="order_table.php" class="ad-btn">Order Now</a>
            </div>
        </div>
    </section>

    <?php include 'footer.php'; ?>
</body>

</html>