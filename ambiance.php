<?php
$image_dir = "images/ambiance/";

$images = glob($image_dir . "*.{jpg,png,jpeg,webp}", GLOB_BRACE);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Luxury Restaurant Ambiance</title>

    <style>
        /* General Styles */
        body {
            font-family: sans-serif;
            background: linear-gradient(45deg, #d9f0ff, #ffe5c5);
            text-align: center;
            margin: 0;
            padding: 0;

        }

        /* Section Title */
        h2 {
            font-size: 2.8em;
            color: #5e81ac;
            margin-top: 40px;
            text-shadow: 2px 2px 8px rgba(255, 207, 129, 0.14);
        }

        /* Image Gallery Container */
        .gallery-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            padding: 40px;
            max-width: 1400px;
            margin: auto;
        }

        /* Image Styling */
        .gallery-container img {
            width: 100%;
            height: 270px;
            object-fit: contain;
            border-radius: 15px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.5);
            transition: transform 0.4s ease, box-shadow 0.4s ease, filter 0.4s ease;
        }

        .gallery-container img:hover{
            box-shadow: 5px 12px 3px 3px rgba(67, 128, 220, 0.77);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .gallery-container {
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            }

            .gallery-container img {
                height: 200px;
            }

            .fa fa-home{
                margin-left: -15%;
            }
        }
    </style>
</head>

<body>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <a href="main.php" style="text-decoration: none;">
        <i class="fa fa-home" style="font-size: 24px; color:  #5e81ac;  float:left"></i>
    </a>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <br>
    <h2>Stunning Restaurant Ambiance</h2>

    <!-- Gallery -->
    <div class="gallery-container">
        <?php
        if (!empty($images)) {
            foreach ($images as $image) {
                echo "<img src='$image' alt='Ambiance'>";
            }
        } else {
            echo "<p>No images found in the ambiance folder.</p>";
        }
        ?>
    </div>

    <?php include 'footer.php'; ?>
</body>

</html>