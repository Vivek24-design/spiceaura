<?php
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bonlicious</title>
    <script src="script.js" defer></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            height: 100vh;
            background: linear-gradient(45deg, #e3f2fd, #ffedd5);
            transition: background 0.3s ease;
            font-family: 'Poppins', sans-serif;
            color: #4a4e69;
            font-size: 24px;
            position: relative;
            overflow: hidden;
        }

        body:hover {
            background: linear-gradient(45deg, #d9f0ff, #ffe5c5);
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 30px;
            background: #5e81ac;
            color: white;
            position: fixed;
            width: 100%;
            z-index: 999;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .menu {
            display: flex;
            list-style: none;
        }

        .menu li {
            margin: 0 20px;
            font-family: serif;
            font-size: 20px;
            font-weight: 600;
            position: relative;
        }

        .menu a {
            text-decoration: none;
            color: #fff;
            transition: color 0.3s;
            position: relative;
        }

        .menu a::after {
            content: "";
            display: block;
            width: 0;
            height: 2px;
            background:rgb(48, 57, 68);
            transition: width 0.3s ease-in-out;
            position: absolute;
            bottom: -5px;
            left: 50%;
            transform: translateX(-50%);
        }

        .menu a:hover {
            color:rgb(255, 231, 180);
        }

        .menu a:hover::after {
            width: 100%;
        }

        .menu-toggle {
            display: none;
            cursor: pointer;
            font-size: 26px;
            color: white;
        }

        .logo {
            font-family: serif;
            font-size: 28px;
            font-weight: 700;
            letter-spacing: 2px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
            transition: color 0.3s ease, transform 0.3s ease;
            cursor: pointer;
        }

        .logo:hover {
            color:rgb(180, 206, 255);
            transform: scale(1.1);
        }


        @media screen and (max-width: 768px) {
            .menu {
                display: none;
                flex-direction: column;
                position: absolute;
                top: 60px;
                left: 0;
                width: 100%;
                background: #5e81ac;
                padding: 10px 0;
            }

            .menu li {
                margin-top: 20px;
                text-align: center;
                padding: 10px 0;
            }

            .menu-toggle {
                display: block;
            }
            
        }
    </style>
</head>

<body>
    <div class="container">
    <nav>
        <div class="logo">Bonlicious</div>
        <div class="menu-toggle">☰</div>
        <ul class="menu">
            <li><a href="#">Home</a></li>
            <li><a href="#">Menu</a></li>
            <li><a href="#">About</a></li>
            <li><a href="gourmet.php">Gourmet</a></li>
            <li><a href="ambiance.php">Our-Ambiance</a></li>
        </ul>
    </nav>
    </div>
</body>

</html>
