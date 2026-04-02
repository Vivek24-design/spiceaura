<?php
// Start session
session_start();
$_SESSION['username'] = "JohnDoe"; // Example session variable

// Function to load the requested page
function loadPage($page)
{
    $allowed_pages = ['Beverages', 'Bread', 'Breakfast', 'maincrouse', 'Salads', 'SandvichWrap', 'sides'];
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
    <title>Menu</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }

        nav {
            margin-bottom: 20px;
            display: flex;
            justify-content: center;
            gap: 40px;
        }

        nav a {
            text-decoration: none;
            color: black;
            font-weight: bold;
            display: flex;
            flex-direction: column;
            align-items: center;
            font-size: 16px;
        }

        nav img {
            width: 100px;
            /* Adjust for bigger images */
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            transition: transform 0.3s ease-in-out;
        }

        nav img:hover {
            transform: scale(1.1);
        }

        footer {
            margin-top: 20px;
            font-size: 14px;
            color: gray;
        }
    </style>
</head>

<body>

    <!-- Navigation Menu with Images -->
    <nav>
        <a href="Beverages.php?page=Beverages">
            <img src="images/png/Drinks-PNG-Isolated-Photo.png" alt="Beverages"> Beverages
        </a>
        <a href="salads.php?page=salads">
            <img src="images/png/OIP.jpg" alt="About"> Salads
        </a>
        <a href="maincrouse.php">
            <img src="images/png/restaurant-food-restaurant-food-top-view-ai-generative-free-png.webp" alt="Services"> Main Crouses
        </a>
        <a href="Sides.php?page=sides">
            <img src="images/png/OIP (3).jpg" alt="Contact"> Sides
        </a>
        <a href="Desserts.php?page=Desserts">
            <img src="images/png/OIP (2).jpg" alt="About"> Desserts
        </a>
        <a href="Starters.php?page=Starters">
            <img src="images/png/pngtree-plate-food-dish-appetizer-png-image_11389511.png" alt="Services"> Starters
        </a>
        <a href="Breakfast.php?page=Breakfast">
            <img src="images/png/restaurant-food-restaurant-food-top-view-ai-generative-free-png.webp" alt="Contact"> Breakfast
        </a>
        <a href="SandvichWrap.php?page=SandvichWrap">
            <img src="images/png/OIP1.jpg" alt="About"> SandvichWrap
        </a>
    </nav>

    <!-- Dynamic Content Section -->
    <div>
        <?php
        $page = isset($_GET['page']) ? $_GET['page'] : 'home';
        loadPage($page);
        ?>
    </div>


    <?php include 'footer.php'; ?>
</body>

</html>