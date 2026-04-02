<?php
include 'includes/connect.php';
session_start();
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <?php include('includes/toast.php'); ?>
</head>
<style>
    body {
        position: relative;

    }

    .swiper {
        width: 100%;
        height: 100vh;
        position: absolute;
    }

    .swiper-slide {
        text-align: center;
        font-size: 18px;
        background: #fff;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .swiper-slide img {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .slide2 {
        background-image: url(images/5e4a3e5c417e2f442978eeb9_1581923932454.jpg);
        background-size: 100% 100%;
        background-attachment: fixed;
    }

    .slide3 {
        background-image: url(images/16dbebbff2e04e0d984f4ed83be93b97.jpg);
        background-size: 100% 100%;
        /* background-attachment: fixed; */
    }

    .slide1 video {
        width: 100%;
        height: 100%;
        object-fit: cover;
        position: absolute;
    }

    .slide1 h1 {
        z-index: 100;
        position: relative;
    }

    span.swiper-pagination-bullet.swiper-pagination-bullet-active.swiper-pagination-bullet-active-main {
        color: white;
        background-color: white;
    }

    .swiper-slide {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .swiper-slide a {
        z-index: 100;
        text-decoration: none;
        padding: 15px;
        border-radius: 10px;
        border: 1px solid white;
        color: white;
        position: relative;
        overflow: hidden;
    }

    .swiper-slide a::before {
        position: absolute;
        content: '';
        top: 0%;
        left: 0%;
        width: 0%;
        height: 100%;
        background-color: white;
        transition: .3s ease-in;
        transform: translateY(120deg);
    }

    .swiper-slide a:hover::before {
        transition: .4s ease-out;
        left: 100%;
        width: 50%;

    }

    .swiper-button-prev,
    .swiper-button-next {
        color: white;
    }

    .cursor {
        width: 100px;
        height: 100px;
        background-color: white;
        border-radius: 50%;
        position: absolute;
        transition: all linear .2s;
        mix-blend-mode: difference;
        opacity: 0;
        scale: 0;
        z-index: 90;
    }

    .main {
        width: 100%;
        height: 100vh;

        position: absolute;
        z-index: 100;
        margin-top: 50%;
    }

    .card img {
        width: 100%;
        height: 300px;

    }

    /* Navbar Styling */
    .wrapper {
        background: rgba(196, 10, 10, 0.41);
    }

    .navbar {
        position: fixed;
        margin: 0;
        top: 0;
        width: 100%;
        z-index: 1000;
        background: #c0392b;
        box-shadow: 0 4px 15px rgba(192, 57, 43, 0.45);
        padding: 15px 0;
        transition: background 0.35s ease, box-shadow 0.35s ease, padding 0.35s ease;
    }

    ul li a {
        color: yellow;
    }

    /* Navbar Brand */
    .navbar-brand {
        font-size: 24px;
        font-weight: 700;
        color: #fff;
        transition: color 0.3s ease;
    }

    .navbar-brand:hover {
        color: #ffcc00;
    }

    /* Navbar Links */
    .navbar-nav .nav-link {
        font-size: 16px;
        font-weight: 600;
        color: white;
        text-transform: uppercase;
        padding: 10px 15px;
        transition: all 0.3s ease-in-out;
        position: relative;
    }

    .navbar-nav .nav-link {
        color: #ffcc00;
    }

    /* Hover Effect */
    .navbar-nav .nav-link:hover {
        color: #ffcc00;
    }

    /* Underline Effect on Hover */
    .navbar-nav .nav-link::after {
        content: "";
        position: absolute;
        left: 50%;
        bottom: -2px;
        width: 0;
        height: 2px;
        background: #ffcc00;
        transition: all 0.3s ease-in-out;
    }

    .navbar-nav .nav-link:hover::after {
        width: 100%;
        left: 0;
    }

    /* Dropdown Styling */
    .nav-item.dropdown:hover .dropdown-menu {
        display: block;
        opacity: 1;
        transform: translateY(0);
    }

    .dropdown-menu {
        background: rgba(0, 0, 0, 0.7);
        border: none;
        backdrop-filter: blur(10px);
        transition: all 0.3s ease-in-out;
        transform: translateY(10px);
        opacity: 0;
    }

    .dropdown-menu a {
        color: white !important;
        padding: 10px 20px;
        font-weight: 600;
        transition: all 0.3s ease-in-out;
    }

    .dropdown-menu a:hover {
        background: rgba(255, 255, 255, 0.2);
        color: #ffcc00 !important;
    }

    /* Mobile Navbar */
    .navbar-toggler {
        border: none;
        outline: none;
    }

    .navbar-toggler-icon {
        background: white;
        border-radius: 5px;
    }

    /* Sticky Navbar on Scroll */
    .navbar.scrolled {
        background: #a93226;
        box-shadow: 0 4px 20px rgba(169, 50, 38, 0.6);
        padding: 10px 0;
    }

    /* Profile Circle & Dropdown */
    .profile-circle {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        background-color: transparent;
        color: #ffcc00;
        display: flex;
        justify-content: center;
        align-items: center;
        font-weight: 700;
        font-size: 18px;
        cursor: pointer;
        border: 2px solid #ffcc00;
        text-transform: uppercase;
        margin-left: 15px;
        transition: all 0.2s;
    }

    .profile-circle:hover,
    .profile-circle[aria-expanded="true"] {
        background-color: rgba(255, 204, 0, 0.2);
        box-shadow: 0 0 10px rgba(255, 204, 0, 0.5);
        color: #fff;
    }

    .profile-dropdown {
        position: relative;
        margin-right: 15px;
    }

    .profile-dropdown-menu {
        display: none;
        flex-direction: column;
        position: absolute;
        top: calc(100% + 10px);
        right: 0;
        background: rgba(0, 0, 0, 0.88);
        backdrop-filter: blur(10px);
        border-radius: 8px;
        min-width: 220px;
        padding: 5px 0;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.5);
        border: 1px solid rgba(255, 204, 0, 0.3);
        z-index: 99999;
    }

    .profile-dropdown-menu.show-flex {
        display: flex !important;
    }

    .profile-header {
        padding: 12px 20px;
    }

    .profile-header .name {
        color: #fff;
        font-weight: 700;
        font-size: 16px;
        margin: 0;
    }

    .profile-header .email {
        color: #aaa;
        font-size: 13px;
        margin: 4px 0 0 0;
        font-family: monospace;
    }

    .profile-menu-item {
        padding: 12px 20px;
        color: #ddd;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 15px;
        transition: background 0.2s, color 0.2s;
    }

    .profile-menu-item:hover {
        background: rgba(255, 255, 255, 0.1);
        color: #ffcc00;
    }

    .profile-menu-item.logout {
        color: #ff5722;
    }

    .profile-menu-item.logout:hover {
        color: #ff9800;
    }

    .profile-divider {
        height: 1px;
        background: rgba(255, 255, 255, 0.15);
        margin: 4px 0;
    }

    .navbar-brand {
        font-size: 28px;
        font-weight: 800;
        letter-spacing: 2px;
        background: linear-gradient(90deg, #ff9800, #ff5722);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        text-decoration: none;
        text-transform: uppercase;
        transition: all 0.3s ease;
        filter: drop-shadow(0 0 8px rgba(255, 152, 0, 0.6));
    }

    .navbar-brand:hover {
        filter: drop-shadow(0 0 14px rgba(255, 87, 34, 0.9));
        transform: scale(1.05);
        -webkit-text-fill-color: transparent;
    }

    .navbar-brand span {
        -webkit-text-fill-color: white;
        opacity: 0.85;
        font-weight: 300;
        font-size: 18px;
        letter-spacing: 4px;
    }
</style>

<body>
    <div class="wrapper">
        <!-- NAV_START -->
        <div class="container-fluid nav-body">
            <nav class="navbar navbar-expand-lg navbar-dark">
                <div class="container-fluid">
                    <a class="navbar-brand" href="home.php">🌶️ SpiceAura<span> | Restaurant</span></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                            <li class="nav-item"><a class="nav-link active" href="home.php">Home</a></li>
                            <li class="nav-item"><a class="nav-link active" href="about.php">About</a></li>
                            <li class="nav-item"><a class="nav-link active" href="home.php#our-menu">Our Menu</a></li>
                            <li class="nav-item"><a class="nav-link active" href="feedback.php">Feedback</a></li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#">More</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="Gourmet.php">Gourmet</a></li>
                                    <li><a class="dropdown-item" href="main.php">Main</a></li>
                                    <li><a class="dropdown-item" href="Ambiance.php">Ambiance</a></li>
                                </ul>
                            </li>
                        </ul>

                        <div class="d-flex align-items-center">
                            <?php
                            $count = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
                            ?>
                            <a href="cart.php" class="cart-icon-link me-3" title="My Cart"
                                style="position:relative; display:inline-flex; align-items:center; text-decoration:none;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="none"
                                    viewBox="0 0 24 24" stroke="white" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <circle cx="9" cy="21" r="1"></circle>
                                    <circle cx="20" cy="21" r="1"></circle>
                                    <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                                </svg>
                                <?php if ($count > 0): ?>
                                    <span
                                        style="position:absolute; top:-8px; right:-10px; background:#ffcc00; color:#111; font-size:11px; font-weight:800; border-radius:50%; width:18px; height:18px; display:flex; align-items:center; justify-content:center; line-height:1; box-shadow:0 2px 6px rgba(0,0,0,0.3);"><?php echo $count; ?></span>
                                <?php endif; ?>
                            </a>

                            <?php
                            $name = isset($_SESSION['name']) && !empty($_SESSION['name']) ? $_SESSION['name'] : 'User';
                            $initials = strtoupper(substr($name, 0, 2));
                            ?>
                            <div class="profile-dropdown">
                                <div class="profile-circle" id="profileDropdown" onclick="toggleProfileDropdown(event)">
                                    <?php echo $initials; ?></div>
                                <ul class="profile-dropdown-menu" id="profileDropdownMenu">
                                    <li>
                                        <div class="profile-header">
                                            <p class="name"><?php echo htmlspecialchars($name); ?></p>
                                            <p class="email">user@example.com</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="profile-divider"></div>
                                    </li>
                                    <li>
                                        <a class="dropdown-item profile-menu-item" href="User_dashboard.php">
                                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2">
                                                <rect x="3" y="3" width="7" height="7"></rect>
                                                <rect x="14" y="3" width="7" height="7"></rect>
                                                <rect x="14" y="14" width="7" height="7"></rect>
                                                <rect x="3" y="14" width="7" height="7"></rect>
                                            </svg>
                                            Dashboard
                                        </a>
                                    </li>
                                    <li>
                                        <div class="profile-divider"></div>
                                    </li>
                                    <li>
                                        <a class="dropdown-item profile-menu-item logout" href="User_login.php">
                                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2">
                                                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                                <polyline points="16 17 21 12 16 7"></polyline>
                                                <line x1="21" y1="12" x2="9" y2="12"></line>
                                            </svg>
                                            Log out
                                        </a>
                                    </li>
                                </ul>
                                <script>
                                    function toggleProfileDropdown(e) {
                                        e.stopPropagation();
                                        e.preventDefault();
                                        document.getElementById('profileDropdownMenu').classList.toggle('show-flex');
                                    }
                                    window.addEventListener('click', function (e) {
                                        var menu = document.getElementById('profileDropdownMenu');
                                        var circle = document.getElementById('profileDropdown');
                                        if (menu && menu.classList.contains('show-flex') && !menu.contains(e.target) && !circle.contains(e.target)) {
                                            menu.classList.remove('show-flex');
                                        }
                                    });

                                    // Navbar scroll effect
                                    window.addEventListener('scroll', function () {
                                        var navbar = document.querySelector('.navbar');
                                        if (navbar) {
                                            if (window.scrollY > 50) {
                                                navbar.classList.add('scrolled');
                                            } else {
                                                navbar.classList.remove('scrolled');
                                            }
                                        }
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        <!-- NAV_END -->
    </div>
</body>

</html>