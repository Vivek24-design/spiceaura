<?php
include('menu.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant | About Us</title>
    <style>
        /* General Styles */
        body {
            font-family: sans-serif;
            margin: 0;
            padding: 0;
            background: #f8f8f8;
            text-align: center;
            color: #333;
        }

        /* Header Section */
        header {
            background: url('https://source.unsplash.com/1600x900/?restaurant,food') no-repeat center center/cover;
            color: white;
            padding: 80px 20px;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.7);
        }

        header h1 {
            font-size: 3rem;
            margin-bottom: 10px;
        }

        header span {
            color: #ff9800;
        }

        header p {
            font-size: 1.5rem;
        }

        /* About Section */
        .about {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
            padding: 60px 10%;
            background: white;
            gap: 20px;
        }

        .about-content {
            flex: 1;
            min-width: 300px;
            text-align: left;
        }

        .about-content h2 {
            font-size: 2.5rem;
            color: #ff9800;
        }

        .about-content p {
            font-size: 1.2rem;
            margin: 10px 0;
        }

        .about-image img {
            width: 100%;
            max-width: 500px;
            border-radius: 10px;
        }

        /* Mission Section */
        .mission {
            padding: 60px 10%;
            background: #ff9800;
            color: white;
        }

        .mission h2 {
            font-size: 2.5rem;
        }

        .mission p {
            font-size: 1.2rem;
        }

        /* Team Section */
        .team {
            padding: 60px 10%;
            background: white;
        }

        .team h2 {
            font-size: 2.5rem;
            color: #ff9800;
        }

        .team-members {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }

        .member {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            text-align: center;
            width: 280px;
        }

        .member img {
            border-radius: 50%;
            width: 150px;
            height: 150px;
        }

        .member h3 {
            margin-top: 10px;
            font-size: 1.5rem;
        }

        .member p {
            font-size: 1.1rem;
            color: #666;
        }

        /* Footer Section */
        footer {
            background: #222;
            color: white;
            padding: 50px 10%;
            text-align: center;
        }

        /* Footer Container */
        .footer-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 20px;
        }

        .footer-section {
            flex: 1;
            min-width: 250px;
            text-align: left;
        }

        .footer-section h3 {
            font-size: 1.5rem;
            margin-bottom: 10px;
            color: #ff9800;
        }

        .footer-section p {
            font-size: 1rem;
        }

        .footer-section ul {
            list-style: none;
            padding: 0;
        }

        .footer-section ul li {
            margin: 8px 0;
        }

        .footer-section ul li a {
            color: white;
            text-decoration: none;
            transition: 0.3s;
        }

        .footer-section ul li a:hover {
            color: #ff9800;
        }

        /* Social Media Icons */
        .social-icons {
            display: flex;
            gap: 10px;
            justify-content: center;
        }

        .social-icons a img {
            width: 35px;
            transition: transform 0.3s;
        }

        .social-icons a img:hover {
            transform: scale(1.2);
        }

        /* Newsletter Section */
        .newsletter form {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .newsletter input {
            padding: 10px;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            width: 100%;
        }

        .newsletter button {
            padding: 10px;
            background: #ff9800;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            color: white;
            cursor: pointer;
            transition: 0.3s;
        }

        .newsletter button:hover {
            background: #e68900;
        }

        /* Footer Bottom */
        .footer-bottom {
            margin-top: 30px;
            border-top: 1px solid #444;
            padding-top: 15px;
            font-size: 1rem;
        }

        /* -------- RESPONSIVE STYLES -------- */

        /* Medium Screens (Tablets) */
        @media (max-width: 1024px) {
            .about {
                flex-direction: column;
                text-align: center;
            }

            .about-content {
                text-align: center;
            }

            .team-members {
                flex-wrap: wrap;
                justify-content: center;
            }

            .footer-container {
                flex-wrap: wrap;
                text-align: center;
            }

            .footer-section {
                text-align: center;
            }
        }

        /* Small Screens (Mobile) */
        @media (max-width: 768px) {
            header {
                padding: 50px 20px;
            }

            header h1 {
                font-size: 2.5rem;
            }

            header p {
                font-size: 1.2rem;
            }

            .about {
                flex-direction: column;
                padding: 40px 5%;
                text-align: center;
            }

            .about-content {
                text-align: center;
            }

            .team {
                padding: 40px 5%;
            }

            .team-members {
                flex-direction: column;
                align-items: center;
            }

            .mission {
                padding: 40px 5%;
            }

            .footer-container {
                flex-direction: column;
                text-align: center;
            }

            .footer-section {
                text-align: center;
            }

            .social-icons {
                justify-content: center;
            }

            .social-icons a img {
                width: 30px;
            }
        }

        /* Extra Small Screens (Phones) */
        @media (max-width: 480px) {
            header h1 {
                font-size: 2rem;
            }

            header p {
                font-size: 1rem;
            }

            .about-content h2,
            .mission h2,
            .team h2 {
                font-size: 2rem;
            }

            .about-content p,
            .mission p,
            .team p {
                font-size: 1rem;
            }

            .about {
                padding: 30px 5%;
            }

            .team {
                padding: 30px 5%;
            }

            .mission {
                padding: 30px 5%;
            }

            .footer-container {
                flex-direction: column;
                text-align: center;
            }

            .footer-section {
                text-align: center;
            }
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <a href="Home.php" style="text-decoration: none;">
        <i class="fa fa-home" style="font-size: 24px; color:  #5e81ac;  float:left"></i>
    </a>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<style>
    header
    {
        height:3vh ;
    }
</style>
</head>

<body>

    <!-- Header Section -->
    <header>
        <h1>About <span>Our Restaurant</span></h1>
        
    </header>

    <!-- About Us Section -->
    <section class="about">
        <div class="about-content">
            <h2>Welcome to Our Culinary World</h2>
            <p>
                At our restaurant, we bring you the finest flavors, carefully crafted with passion and authenticity.
                Our chefs use the freshest ingredients to create mouth-watering dishes that take you on a journey
                of taste and tradition.
            </p>
            <p>
                Whether it's a family dinner, a romantic evening, or a casual meal, we offer an unforgettable
                dining experience with warm hospitality and a delightful ambiance.
            </p>
        </div>
        <div class="about-image">
            <img src="images/ambiance/pexels-elletakesphotos-2696064.jpg" alt="Restaurant Ambiance">
        </div>
    </section>

    <!-- Our Mission Section -->
    <section class="mission">
        <h2>Our Mission</h2>
        <p>To serve exceptional food with a touch of elegance, creating memorable dining experiences for our guests.</p>
    </section>

    <!-- Meet the Team Section -->
    <section class="team">
        <h2>Meet Our Team</h2>
        <div class="team-members">
            <?php
            $team = [
                ["name" => "Chef John Doe", "role" => "Executive Chef", "image" => "images/about/pexels-gustavo-fring-6050329.jpg"],
                ["name" => "Sarah Smith", "role" => "Head of Hospitality", "image" => "images/about/pexels-cottonbro-4040907.jpg"],
                ["name" => "Mark Wilson", "role" => "Restaurant Manager", "image" => "images/about/pexels-pavel-danilyuk-7518949.jpg"]
            ];
            foreach ($team as $member) {
                echo "
            <div class='member'>
                <img src='{$member['image']}' alt='{$member['name']}'>
                <h3>{$member['name']}</h3>
                <p>{$member['role']}</p>
            </div>
            ";
            }
            ?>
        </div>
    </section>
</body>

    <?php include 'footer.php'; ?>
<!-- <footer>
    <div class="footer-container">
        <!-- Contact Info -->
        <div class="footer-section">
            <h3>Contact Us</h3>
            <p><strong>Address:</strong> 0111 Golden CoSta, Amritsar, Punjab</p> 
            <p><strong>Phone:</strong> +91 0000 010 111</p>
            <p><strong>Email:</strong> contact@ourrestaurant.com</p>
        </div>

        <!-- Quick Links -->
        <div class="footer-section">
            <h3>Quick Links</h3>
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="menu.php">Menu</a></li>
                <li><a href="reservations.php">Reservations</a></li>
                <li><a href="ambiance.php">Gallery</a></li>
                <li><a href="about.php">About</a></li>
            </ul>
        </div>

        <!-- Social Media -->
        <div class="footer-section">
            <h3>Follow Us</h3>
            <div class="social-icons">
                <a href="#"><img src="https://img.icons8.com/ios-filled/50/ffffff/facebook--v1.png"
                        alt="Facebook"></a>
                <a href="#"><img src="https://img.icons8.com/ios-filled/50/ffffff/instagram-new.png"
                        alt="Instagram"></a>
                <a href="#"><img src="https://img.icons8.com/ios-filled/50/ffffff/twitterx.png" alt="Twitter"></a>
                <a href="#"><img src="https://img.icons8.com/ios-filled/50/ffffff/youtube-play.png"
                        alt="YouTube"></a>
            </div>
        </div>

        <!-- Newsletter Subscription -->
        <div class="footer-section newsletter">
            <h3>Subscribe to Our Newsletter</h3>
            <form action="subscribe.php" method="post">
                <input type="email" name="email" placeholder="Enter your email" required>
                <button type="submit">Subscribe</button>
            </form>
        </div>
    </div>

    <!-- Copyright & Branding -->
    <div class="footer-bottom">
        <p>&copy; <?php echo date("Y"); ?> Our Restaurant | Designed with by Our Team</p>
    </div>
</footer> -->
</body>

</html>

?>