<?php
$events = [
    ["image" => "images/ambiance/pexels-cottonbro-6848271.jpg", "title" => "🌟 Private Dinners", "description" => "Experience fine dining with exclusive menus and ambiance."],
    ["image" => "images/ambiance/pexels-jakubzerdzicki-30892434.jpg", "title" => "🏢 Corporate Events", "description" => "Host your business gatherings with a professional setup."],
    ["image" => "images/ambiance/pexels-mastercowley-1128782.jpg", "title" => "💍 Wedding Catering", "description" => "Elegant catering solutions for your dream wedding."]
];

// Define loyalty plans
$loyalty_plans = [
    ["name" => " Gold Member", "benefits" => ["10% off on all dine-in orders", "Free dessert on birthdays"]],
    ["name" => " Platinum Member", "benefits" => ["15% off on orders", "Early access to new menus"]],
    ["name" => " VIP Elite", "benefits" => ["20% off, free priority reservations", "Invitation to private tastings"]]
];

// Define blog posts
$blog_posts = [
    ["image" => "images/ambiance/pexels-shay-gordon-793310637-30650166.jpg", "title" => "🌿 Our New Seasonal Menu", "description" => "Explore our latest dishes made with farm-fresh ingredients."],
    ["image" => "images/ambiance/pexels-rdne-5737464.jpg", "title" => "🍳 Chef's Secret Recipes", "description" => "Learn exclusive recipes from our head chef."]
];

// Define FAQs
$faqs = [
    ["question" => " What are your restaurant timings?", "answer" => "We are open from 11 AM - 11 PM daily."],
    ["question" => " Do you offer delivery?", "answer" => "Yes, we offer home delivery within a 10 km radius."],
    ["question" => " How can I book a table?", "answer" => "Call us at +123-456-7890 or use our online reservation system."]
];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Special Sections</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <a href="main.php" style="text-decoration: none;">
        <i class="fa fa-home" style="font-size: 20px; color :black;  float:left;"></i>
    </a>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* General Styles */
        body {
            font-family: sans-serif;
            background: linear-gradient(45deg, #d9f0ff, #ffe5c5);
            text-align: center;
            margin: 0;
            padding: 0;
            color: #333;
            
        }

        .container {
            max-width: 1100px;
            margin: auto;
            padding: 40px 20px;
        }

        /* Header */
        header {
            background: #5e81ac;
            color: white;
            padding: 30px 0;
        }

        h1 {
            font-size: 2.5em;
        }

        /* Buttons */
        .btn {
            padding: 12px 25px;
            background: #5e81ac;
            color: #fff;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.3s;
            text-decoration: none;
        }

        .btn:hover {
            background: #e67e22;
        }

        /* Sections */
        .events,
        .loyalty,
        .blog,
        .faq {
            background: #ffffff;
            padding: 50px 0;
            margin: 20px 0;
            border-radius: 15px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
        }

        /* Events */
        .event-box {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
        }

        .event-card {
            width: 30%;
            border-radius: 10px;
            overflow: hidden;
        }

        .event-card img {
            width: 100%;
            height: 200px;
        }

        /* Loyalty */
        .loyalty-box {
            display: flex;
            justify-content: space-around;
        }

        .loyalty-card {
            background: #f7f7f7;
            padding: 20px;
            border-radius: 10px;
            width: 30%;
        }

        /* Blog */
        .blog-posts {
            display: flex;
            justify-content: center;
            gap: 20px;
        }
        .blog-posts img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .post {
            width: 45%;
            border-radius: 10px;
        }

        /* FAQs */
        .faq-box {
            max-width: 700px;
            margin: auto;
        }

        .faq-item {
            background: #f4f4f4;
            padding: 15px;
            border-left: 5px solid #d35400;
            border-radius: 5px;
        }

        /* Responsive */
        @media (max-width: 768px) {

            .event-box,
            .loyalty-box,
            .blog-posts {
                flex-direction: column;
            }

            .event-card,
            .loyalty-card,
            .post {
                width: 100%;
            }
        }
    </style>
</head>

<body>

    <!-- HEADER -->
    <header>
        <h1>🍽️ Welcome to Gourmet Delights</h1>
        <p>Discover the finest dining experiences with us</p>
    </header>

    <!-- Events & Catering Section -->
    <section class="events">
        <div class="container">
            <h2>🎉 Events & Catering</h2>
            <p>We host unforgettable experiences, from elegant private dinners to large-scale corporate events.</p>
            <div class="event-box">
                <?php foreach ($events as $event) : ?>
                    <div class="event-card">
                        <img src="<?php echo $event['image']; ?>" alt="<?php echo $event['title']; ?>">
                        <h3><?php echo $event['title']; ?></h3>
                        <p><?php echo $event['description']; ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
            <a href="reservations.php" class="btn">Book an Event</a>
        </div>
    </section>

    <!-- Loyalty & Offers Section -->
    <section class="loyalty">
        <div class="container">
            <h2>🎁 Loyalty & Offers</h2>
            <p>Join our rewards program and unlock exclusive discounts.</p>
            <div class="loyalty-box">
                <?php foreach ($loyalty_plans as $plan) : ?>
                    <div class="loyalty-card">
                        <h3><?php echo $plan['name']; ?></h3>
                        <?php foreach ($plan['benefits'] as $benefit) : ?>
                            <p>✔ <?php echo $benefit; ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            </div>
            <button class="btn">Join Now</button>
        </div>
    </section>

    <!-- Blog / News Section -->
    <section class="blog">
        <div class="container">
            <h2>📝 Latest News & Blog</h2>
            <div class="blog-posts">
                <?php foreach ($blog_posts as $post) : ?>
                    <div class="post">
                        <img src="<?php echo $post['image']; ?>" alt="<?php echo $post['title']; ?>">
                        <h3><?php echo $post['title']; ?></h3>
                        <p><?php echo $post['description']; ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
            <button class="btn">Read More</button>
        </div>
    </section>

    <!-- FAQs Section -->
    <section class="faq">
        <div class="container">
            <h2>❓ Frequently Asked Questions</h2>
            <div class="faq-box">
                <?php foreach ($faqs as $faq) : ?>
                    <div class="faq-item">
                        <h3><?php echo $faq['question']; ?></h3>
                        <p><?php echo $faq['answer']; ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <?php include 'footer.php'; ?>
</body>

</html>