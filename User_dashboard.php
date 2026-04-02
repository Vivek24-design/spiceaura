<?php
session_start();
include('includes/connect.php');

if (!isset($_SESSION['name'])) {
    header('location: User_login.php');
    exit;
}

$username = $_SESSION['name'];
$section = isset($_GET['section']) ? $_GET['section'] : 'orders';

// ── Fetch profile info ──────────────────────────────────────────────────────
$esc_user = mysqli_real_escape_string($con, $username);
$prof_query = mysqli_query($con, "SELECT * FROM user_registration WHERE username='$esc_user' LIMIT 1");
$profile = mysqli_fetch_assoc($prof_query);
$user_email = $profile ? ($profile['email'] ?? '') : '';

// ── Fetch orders for this user (matched by name = username) ─────────────────
$orders = [];
$ord_q = mysqli_query($con, "SELECT * FROM order_table WHERE username='$esc_user' ORDER BY orderid DESC");
if ($ord_q) {
    while ($row = mysqli_fetch_assoc($ord_q)) {
        $orders[] = $row;
    }
}

// Helper: status badge CSS class (case-insensitive)
function statusClass($s)
{
    $s = ucwords(strtolower($s));
    $map = ['Pending' => 'badge bg-warning text-dark', 'In Progress' => 'badge bg-info text-dark', 'Delivered' => 'badge bg-success', 'Cancelled' => 'badge bg-danger'];
    return $map[$s] ?? 'badge bg-warning text-dark';
}

$initials = strtoupper(substr($username, 0, 2));
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Dashboard – SpiceAura</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', system-ui, sans-serif;
            background: #fdfbf7;
            /* Sleek light warm background */
            color: #333;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ════ Navbar (Matches Main Site) ════ */
        .navbar {
            background: rgba(196, 10, 10, 0.9);
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            padding: 12px 0;
            z-index: 1050;
        }

        .navbar-brand {
            font-size: 24px;
            font-weight: 800;
            letter-spacing: 1px;
            background: linear-gradient(90deg, #ffcc00, #ff9800);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-decoration: none;
            text-transform: uppercase;
        }

        .navbar-brand span {
            -webkit-text-fill-color: white;
            font-weight: 300;
            font-size: 16px;
            letter-spacing: 2px;
        }

        .nav-link {
            color: #fff !important;
            font-weight: 600;
            text-transform: uppercase;
        }

        .nav-link:hover {
            color: #ffcc00 !important;
        }

        .profile-circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 2px solid #ffcc00;
            color: #ffcc00;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        .profile-circle:hover {
            background: rgba(255, 204, 0, 0.15);
            color: #fff;
            box-shadow: 0 0 10px rgba(255, 204, 0, 0.5);
        }

        /* ════ Layout ════ */
        .dash-container {
            flex: 1;
            padding-top: 100px;
            padding-bottom: 60px;
            max-width: 1300px;
        }

        /* ════ Sidebar ════ */
        .sidebar-card {
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.04);
            padding: 24px;
            border: 1px solid rgba(0, 0, 0, 0.03);
        }

        .sidebar-avatar {
            text-align: center;
            margin-bottom: 20px;
        }

        .sidebar-avatar .circle {
            width: 65px;
            height: 65px;
            border-radius: 50%;
            background: rgba(196, 10, 10, 0.05);
            color: #c40a0a;
            font-size: 20px;
            font-weight: 800;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 12px;
            border: 2px solid #c40a0a;
        }

        .sidebar-avatar .uname {
            font-weight: 800;
            font-size: 17px;
            color: #333;
        }

        .sidebar-avatar .uemail {
            font-size: 13px;
            color: #777;
            word-break: break-all;
        }

        .nav-item-btn {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            color: #555;
            background: transparent;
            width: 100%;
            border: none;
            text-align: left;
            transition: all 0.2s;
        }

        .nav-item-btn:hover {
            background: #fff4e5;
            color: #ff5722;
        }

        .nav-item-btn.active {
            background: linear-gradient(90deg, #ff9800, #ff5722);
            color: #fff;
            box-shadow: 0 4px 10px rgba(255, 87, 34, 0.25);
        }

        .logout-btn {
            color: #dc3545;
            margin-top: 20px;
        }

        .logout-btn:hover {
            background: #ffeded;
            color: #dc3545;
        }

        /* ════ Content Panels ════ */
        .section-panel {
            display: none;
            animation: fadeIn 0.3s ease;
        }

        .section-panel.active {
            display: block;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: none;
            }
        }

        .page-title {
            font-size: 26px;
            font-weight: 800;
            color: #333;
            margin-bottom: 26px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .page-title span.accent {
            color: #ff5722;
        }

        /* Order Cards */
        .order-card {
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
            padding: 24px;
            margin-bottom: 20px;
            border: 1px solid #eaeaea;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .order-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
            border-color: #ffd0b0;
        }

        .order-header {
            display: flex;
            justify-content: space-between;
            border-bottom: 1px solid #f0f0f0;
            padding-bottom: 14px;
            margin-bottom: 16px;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
        }

        .order-id {
            font-size: 15px;
            font-weight: 700;
            color: #333;
        }

        .order-date {
            font-size: 13px;
            color: #888;
            display: block;
            margin-top: 4px;
            font-weight: 500;
        }

        .order-info {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            gap: 16px;
            margin-bottom: 20px;
        }

        .info-label {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: #888;
            margin-bottom: 4px;
            display: block;
            font-weight: 700;
        }

        .info-val {
            font-size: 15px;
            font-weight: 600;
            color: #444;
        }

        .info-amt {
            font-size: 17px;
            font-weight: 800;
            color: #c40a0a;
        }

        /* Buttons */
        .btn-brand-outline {
            border: 2px solid #ff9800;
            color: #ff9800;
            background: transparent;
            font-weight: 700;
            padding: 6px 16px;
            border-radius: 8px;
            font-size: 13px;
            transition: 0.2s;
        }

        .btn-brand-outline:hover {
            background: #ff9800;
            color: #fff;
        }

        .btn-danger-outline {
            border: 2px solid #dc3545;
            color: #dc3545;
            background: transparent;
            font-weight: 700;
            padding: 6px 16px;
            border-radius: 8px;
            font-size: 13px;
            transition: 0.2s;
        }

        .btn-danger-outline:hover {
            background: #dc3545;
            color: #fff;
        }

        .btn-brand {
            background: linear-gradient(90deg, #ff9800, #ff5722);
            color: #fff;
            border: none;
            padding: 10px 24px;
            border-radius: 8px;
            font-weight: 800;
            transition: box-shadow 0.2s;
        }

        .btn-brand:hover {
            box-shadow: 0 4px 12px rgba(255, 87, 34, 0.3);
            color: #fff;
        }

        /* Edit Form */
        .edit-form {
            display: none;
            background: #fafafa;
            border: 1px solid #eee;
            border-radius: 10px;
            padding: 20px;
            margin-top: 16px;
        }

        .edit-form.open {
            display: block;
        }

        .form-control:focus {
            border-color: #ff9800;
            box-shadow: 0 0 0 0.25rem rgba(255, 152, 0, 0.25);
        }

        /* Profile Details */
        .profile-card {
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.04);
            padding: 32px;
            max-width: 550px;
            border: 1px solid rgba(0, 0, 0, 0.03);
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #777;
            background: #fff;
            border-radius: 14px;
            border: 1px dashed #ccc;
        }

        .footer-wrapper {
            margin-top: auto;
            width: 100%;
            border-top: 1px solid #eee;
            background: #fff;
        }
    </style>
</head>

<body>

    <!-- Global Navbar Overlay Match -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container-fluid px-4">
            <a class="navbar-brand" href="home.php">🌶️ SpiceAura<span> | Restaurant</span></a>
            <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse"
                data-bs-target="#navContent" style="border-color: rgba(255,255,255,0.5);">
                <svg viewBox="0 0 30 30" width="30" height="30" fill="white">
                    <path d="M4 7h22M4 15h22M4 23h22" stroke="white" stroke-width="2" stroke-linecap="round" />
                </svg>
            </button>
            <div class="collapse navbar-collapse" id="navContent">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="home.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="home.php#our-menu">Our Menu</a></li>
                    <li class="nav-item"><a class="nav-link" href="feedback.php">Feedback</a></li>
                </ul>
                <div class="d-flex align-items-center">
                    <?php $cart_count = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>
                    <a href="cart.php" title="My Cart"
                        style="position:relative; display:inline-flex; align-items:center; text-decoration:none; margin-right:20px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="none" viewBox="0 0 24 24"
                            stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="9" cy="21" r="1"></circle>
                            <circle cx="20" cy="21" r="1"></circle>
                            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                        </svg>
                        <?php if ($cart_count > 0): ?>
                            <span
                                style="position:absolute; top:-8px; right:-10px; background:#ffcc00; color:#111; font-size:11px; font-weight:800; border-radius:50%; width:18px; height:18px; display:flex; align-items:center; justify-content:center; line-height:1; box-shadow:0 2px 6px rgba(0,0,0,0.3);"><?php echo $cart_count; ?></span>
                        <?php endif; ?>
                    </a>
                    <div class="profile-circle" title="Dashboard"><?php echo $initials; ?></div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Container -->
    <div class="container dash-container">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-lg-3 mb-4">
                <div class="sidebar-card sticky-top" style="top: 100px;">
                    <div class="sidebar-avatar">
                        <div class="circle"><?php echo $initials; ?></div>
                        <div class="uname"><?php echo htmlspecialchars($username); ?></div>
                        <div class="uemail"><?php echo htmlspecialchars($user_email ?: 'No Email Provided'); ?></div>
                    </div>
                    <hr class="text-muted opacity-25 mb-4">

                    <button class="nav-item-btn <?php echo $section === 'orders' ? 'active' : ''; ?>"
                        onclick="switchSection('orders', this)">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" class="me-1" stroke="currentColor"
                            stroke-width="2.5">
                            <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                            <line x1="3" y1="6" x2="21" y2="6"></line>
                            <path d="M16 10a4 4 0 0 1-8 0"></path>
                        </svg>
                        My Orders
                    </button>
                    <button class="nav-item-btn mt-2 <?php echo $section === 'profile' ? 'active' : ''; ?>"
                        onclick="switchSection('profile', this)">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" class="me-1" stroke="currentColor"
                            stroke-width="2.5">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        Profile Details
                    </button>

                    <a href="User_login.php" class="nav-item-btn logout-btn text-decoration-none">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" class="me-1" stroke="currentColor"
                            stroke-width="2.5">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                            <polyline points="16 17 21 12 16 7"></polyline>
                            <line x1="21" y1="12" x2="9" y2="12"></line>
                        </svg>
                        Log Out
                    </a>
                </div>
            </div>

            <!-- Content Area -->
            <div class="col-lg-9">
                <!-- ████████ ORDERS PANEL ████████ -->
                <div class="section-panel <?php echo $section === 'orders' ? 'active' : ''; ?>" id="panel-orders">
                    <h2 class="page-title">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#ff5722" stroke-width="2.5">
                            <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                            <line x1="3" y1="6" x2="21" y2="6"></line>
                            <path d="M16 10a4 4 0 0 1-8 0"></path>
                        </svg>
                        My <span class="accent">Orders</span>
                    </h2>

                    <?php if (empty($orders)): ?>
                        <div class="empty-state">
                            <svg width="60" height="60" viewBox="0 0 24 24" fill="none" class="mb-3" stroke="#ccc"
                                stroke-width="1.5">
                                <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                                <line x1="3" y1="6" x2="21" y2="6"></line>
                                <path d="M16 10a4 4 0 0 1-8 0"></path>
                            </svg>
                            <h5 class="text-secondary fw-bold">No orders found yet.</h5>
                            <p class="mb-3 text-muted">Looks like you haven't placed an order.</p>
                            <a href="Beverages.php" class="btn btn-brand mt-2">Start shopping</a>
                        </div>
                    <?php else: ?>
                        <?php foreach ($orders as $i => $order):
                            $status_norm = ucwords(strtolower($order['status']));
                            $editable = in_array($status_norm, ['Pending', 'In Progress']);
                            $cancellable = !in_array($status_norm, ['Delivered', 'Cancelled']);
                            $scls = statusClass($order['status']);
                            $oid = isset($order['orderid']) ? $order['orderid'] : $i;
                            ?>
                            <div class="order-card">
                                <div class="order-header">
                                    <div>
                                        <span class="order-id">Order #<?php echo $oid; ?></span>
                                        <span class="order-date">
                                            <?php
                                            echo isset($order['orderdate']) && $order['orderdate'] ? htmlspecialchars($order['orderdate']) : '—';
                                            echo ' ';
                                            echo isset($order['ordertime']) && $order['ordertime'] ? htmlspecialchars($order['ordertime']) : '';
                                            ?>
                                        </span>
                                    </div>
                                    <span class="<?php echo $scls; ?> px-3 py-2 rounded-pill shadow-sm"
                                        style="font-size: 13px; font-weight: 700; letter-spacing: 0.5px;">
                                        <?php echo htmlspecialchars($order['status']); ?>
                                    </span>
                                </div>

                                <div class="order-info">
                                    <div><span class="info-label">Name</span><span
                                            class="info-val"><?php echo htmlspecialchars($order['name']); ?></span></div>
                                    <div><span class="info-label">Mobile</span><span
                                            class="info-val"><?php echo htmlspecialchars($order['mobile']); ?></span></div>
                                    <div style="grid-column: span 2;"><span class="info-label">Address</span><span
                                            class="info-val"><?php echo htmlspecialchars($order['address']); ?></span></div>
                                    <div><span class="info-label">Total Amount</span><span class="info-amt">RS.
                                            <?php echo htmlspecialchars($order['totalamount']); ?></span></div>
                                </div>

                                <?php if ($editable || $cancellable): ?>
                                    <div class="d-flex gap-2 flex-wrap mt-2">
                                        <?php if ($editable): ?>
                                            <button class="btn-brand-outline" onclick="toggleEditForm('edit-<?php echo $oid; ?>')">✏️
                                                Edit Details</button>
                                        <?php endif; ?>
                                        <?php if ($cancellable): ?>
                                            <form method="POST" action="User_cancel_order.php" class="m-0">
                                                <input type="hidden" name="orderid" value="<?php echo $oid; ?>">
                                                <button type="submit" class="btn-danger-outline">❌ Cancel Order</button>
                                            </form>
                                        <?php else: ?>
                                            <button class="btn-danger-outline" style="opacity:0.4; pointer-events:none;">❌
                                                Cancelled</button>
                                        <?php endif; ?>
                                    </div>

                                    <?php if ($editable): ?>
                                        <!-- Inline Edit Form -->
                                        <div class="edit-form" id="edit-<?php echo $oid; ?>">
                                            <h6 class="fw-bold mb-3"><span style="color:#ff9800;">✏️ Edit Delivery Details</span></h6>
                                            <form method="POST" action="User_update_order.php">
                                                <input type="hidden" name="orderid" value="<?php echo $oid; ?>">
                                                <div class="row g-3">
                                                    <div class="col-md-5">
                                                        <label class="form-label text-secondary small fw-bold">Mobile</label>
                                                        <input type="text" class="form-control bg-white" name="mobile"
                                                            value="<?php echo htmlspecialchars($order['mobile']); ?>" required>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <label class="form-label text-secondary small fw-bold">Address</label>
                                                        <input type="text" class="form-control bg-white" name="address"
                                                            value="<?php echo htmlspecialchars($order['address']); ?>" required>
                                                    </div>
                                                    <div class="col-12 mt-3">
                                                        <button type="submit" class="btn btn-brand btn-sm px-4 py-2 me-2">Save
                                                            Changes</button>
                                                        <button type="button"
                                                            class="btn btn-light btn-sm border px-3 py-2 fw-bold text-secondary"
                                                            onclick="toggleEditForm('edit-<?php echo $oid; ?>')">Discard</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <!-- ████████ PROFILE PANEL ████████ -->
                <div class="section-panel <?php echo $section === 'profile' ? 'active' : ''; ?>" id="panel-profile">
                    <h2 class="page-title">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#ff5722" stroke-width="2.5">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        My <span class="accent">Profile</span>
                    </h2>

                    <?php if (isset($_GET['saved']) && $_GET['saved'] == 1): ?>
                        <div class="alert alert-success d-flex align-items-center fw-bold shadow-sm" role="alert"
                            style="max-width: 550px;">
                            <svg width="24" height="24" class="me-2" fill="none" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Profile updated successfully!
                        </div>
                    <?php endif; ?>

                    <div class="profile-card">
                        <form method="POST" action="User_update_profile.php">
                            <div class="mb-4">
                                <label class="form-label fw-bold text-secondary text-uppercase"
                                    style="font-size:12px; letter-spacing:0.8px;">Username</label>
                                <input type="text" class="form-control form-control-lg bg-light border-0"
                                    name="username"
                                    value="<?php echo htmlspecialchars($profile['username'] ?? $username); ?>" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label fw-bold text-secondary text-uppercase"
                                    style="font-size:12px; letter-spacing:0.8px;">Email Address</label>
                                <input type="email" class="form-control form-control-lg bg-light border-0" name="email"
                                    value="<?php echo htmlspecialchars($profile['email'] ?? ''); ?>" required
                                    placeholder="user@example.com">
                            </div>
                            <div class="mb-4">
                                <label class="form-label fw-bold text-secondary text-uppercase"
                                    style="font-size:12px; letter-spacing:0.8px;">Change Password</label>
                                <input type="password" class="form-control form-control-lg bg-light border-0"
                                    name="password" placeholder="Leave blank to keep current">
                            </div>
                            <button type="submit" name="save_profile" class="btn btn-brand w-100 py-3 fs-6 mt-2">Save
                                Profile Details</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function switchSection(section, btn) {
            // Hide all panels
            document.querySelectorAll('.section-panel').forEach(p => p.classList.remove('active'));
            // Show selected panel
            document.getElementById('panel-' + section).classList.add('active');
            // Update button states
            document.querySelectorAll('.nav-item-btn:not(.logout-btn)').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            // Update URL quietly
            history.replaceState(null, '', '?section=' + section);
        }

        function toggleEditForm(id) {
            var el = document.getElementById(id);
            el.classList.toggle('open');
        }
    </script>

</body>

</html>