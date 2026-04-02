<?php
 session_start();
 include('includes/connect.php');

 // Handle User Login
 if(isset($_POST['user_click']))
 {
    if(!empty($_POST['user_name']) && !empty($_POST['password']))
    {
        $get_username=mysqli_real_escape_string($con,$_POST['user_name']);
        $get_password=mysqli_real_escape_string($con,$_POST['password']);
        $sql="SELECT * FROM user_login WHERE username= '$get_username' AND password = '$get_password' ";

        if($result=mysqli_query($con,$sql)){
         if(mysqli_num_rows($result)==1)
            {
              $_SESSION['name'] = $get_username;
              header('location:home.php');
            }
            else
            {
              $login_error = 'Invalid username or password';
            }               
        }
      }
 }

 // Handle Admin Login
 if(isset($_POST['admin_click']))
 {
    if(!empty($_POST['admin_name']) && !empty($_POST['admin_password']))
    {
        $get_username=mysqli_real_escape_string($con,$_POST['admin_name']);
        $get_password=mysqli_real_escape_string($con,$_POST['admin_password']);
        $sql="SELECT * FROM adminlogintable WHERE user= '$get_username' AND password = '$get_password' ";

        if($result=mysqli_query($con,$sql)){
         if(mysqli_num_rows($result)==1)
            {
              $_SESSION['name'] = $get_username;
              header('location:Admin/admin.php');
            }
            else
            {
              $login_error = 'Invalid admin username or password';
            }               
        }
      }
 }
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bonilicious – Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<style>
  /* ===== Layout ===== */
  .form-body {
    width: 100%;
    min-height: 100vh;
    background-image: url(bg1.jpg);
    background-size: cover;
    background-position: center;
    position: absolute;
    top: 0;
    left: 0;
    margin: 0;
  }
  .main { width: 100%; padding: 0; margin: 0; }

  /* ===== Card ===== */
  .form_main {
    width: 400px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    background-color: transparent;
    padding: 30px;
    backdrop-filter: blur(3px);
    box-shadow: 0px 0px 13px black;
    position: relative;
    overflow: hidden;
    margin-left: 150px;
    border-radius: 20px;
    margin-top: 120px;
  }

  /* ===== Toggle Tabs ===== */
  .login-tabs {
    display: flex;
    width: 100%;
    margin-bottom: 20px;
    border-radius: 30px;
    overflow: hidden;
    border: 2px solid rgba(255,255,255,0.25);
  }
  .tab-btn {
    flex: 1;
    padding: 8px 0;
    border: none;
    background: transparent;
    color: rgba(255,255,255,0.55);
    font-size: .85em;
    font-weight: 600;
    letter-spacing: 1px;
    cursor: pointer;
    transition: all .25s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
  }
  .tab-btn.active {
    background: #385A64;
    color: #FFD95A;
    border-radius: 28px;
  }
  .tab-btn:hover:not(.active) {
    background: rgba(255,255,255,0.08);
    color: #fff;
  }
  .tab-btn svg { flex-shrink: 0; }

  /* ===== Heading ===== */
  .heading {
    font-size: 1.8em;
    color: wheat;
    font-weight: 700;
    margin: 0 0 12px 0;
    z-index: 2;
    text-align: center;
  }

  /* ===== Inputs ===== */
  .inputContainer {
    width: 100%;
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 2;
  }
  .inputIcon { position: absolute; left: 3px; }
  .inputField {
    width: 100%;
    height: 30px;
    background-color: transparent;
    border: none;
    border-bottom: 2px solid rgb(173, 173, 173);
    margin: 10px 0;
    color: white;
    font-size: .8em;
    font-weight: 500;
    box-sizing: border-box;
    padding-left: 30px;
  }
  .inputField:focus { outline: none; border-bottom: 2px solid rgb(199, 114, 255); }
  .inputField::placeholder { font-size: 1em; font-weight: 600; color: rgba(255,255,255,0.5); }

  /* ===== Submit button ===== */
  #user-button, #admin-button {
    z-index: 2;
    position: relative;
    width: 35%;
    border: none;
    background-color: #385A64;
    height: 32px;
    color: white;
    font-size: .8em;
    font-weight: 600;
    letter-spacing: 1px;
    margin: 14px auto 4px;
    cursor: pointer;
    border-radius: 5px;
    transition: .2s ease all;
    display: block;
  }
  #user-button:hover  { background-color: #FFD95A; color: #222; }
  #admin-button:hover { background-color: #FFD95A; color: #222; }

  /* ===== Links row ===== */
  .link-row {
    width: 100%;
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    z-index: 2;
    margin-top: 4px;
  }
  .link-row h6 { margin: 0; }
  .link-row a  { color: white; text-decoration: none; }
  .link-row a:hover { color: #FFD95A; }

  /* ===== Panel visibility ===== */
  .login-panel { width: 100%; }
  .login-panel.hidden { display: none; }

  /* ===== Admin badge accent ===== */
  .admin-badge {
    font-size: .65em;
    background: #FFD95A;
    color: #222;
    padding: 2px 8px;
    border-radius: 20px;
    font-weight: 700;
    letter-spacing: .5px;
    margin-bottom: 8px;
    display: inline-block;
  }
</style>

<body>
  <div class="container-fluid main">
    <div class="row form-body d-flex justify-content-end align-items-center">
      <div class="col-md-6">

        <!-- Single card containing both forms -->
        <div class="form_main">

          <!-- ===== Toggle Tabs ===== -->
          <div class="login-tabs">
            <button class="tab-btn active" id="tab-user" onclick="switchTab('user')">
              <!-- user icon -->
              <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.025 10 8 10c-2.026 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
              </svg>
              User
            </button>
            <button class="tab-btn" id="tab-admin" onclick="switchTab('admin')">
              <!-- shield icon -->
              <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/>
              </svg>
              Admin
            </button>
          </div>

          <!-- ===== USER Login Panel ===== -->
          <div class="login-panel" id="panel-user">
            <p class="heading">Ready, set, Login!</p>
            <form action="" method="post">
              <div class="inputContainer">
                <svg class="inputIcon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#fff" viewBox="0 0 16 16">
                  <path d="M13.106 7.222c0-2.967-2.249-5.032-5.482-5.032-3.35 0-5.646 2.318-5.646 5.702 0 3.493 2.235 5.708 5.762 5.708.862 0 1.689-.123 2.304-.335v-.862c-.43.199-1.354.328-2.29.328-2.926 0-4.813-1.88-4.813-4.798 0-2.844 1.921-4.881 4.594-4.881 2.735 0 4.608 1.688 4.608 4.156 0 1.682-.554 2.769-1.416 2.769-.492 0-.772-.28-.772-.76V5.206H8.923v.834h-.11c-.266-.595-.881-.964-1.6-.964-1.4 0-2.378 1.162-2.378 2.823 0 1.737.957 2.906 2.379 2.906.8 0 1.415-.39 1.709-1.087h.11c.081.67.703 1.148 1.503 1.148 1.572 0 2.57-1.415 2.57-3.643zm-7.177.704c0-1.197.54-1.907 1.456-1.907.93 0 1.524.738 1.524 1.907S8.308 9.84 7.371 9.84c-.895 0-1.442-.725-1.442-1.914z"/>
                </svg>
                <input type="text" style="color:white;" class="inputField" placeholder="Username" name="user_name" required>
              </div>

              <div class="inputContainer">
                <svg class="inputIcon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#fff" viewBox="0 0 16 16">
                  <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/>
                </svg>
                <input type="password" class="inputField" name="password" placeholder="Password" required>
              </div>

              <div class="link-row">
                <h6><a href="forgetpswd.php">Forgot password</a></h6>
              </div>
              <div class="link-row" style="margin-top:6px;">
                <h6 style="color:white;">Not registered..?</h6>
                <h6><a href="User_Registration.php">Sign up</a></h6>
              </div>

              <input id="user-button" type="submit" name="user_click" value="Login">
            </form>
          </div>

          <!-- ===== ADMIN Login Panel ===== -->
          <div class="login-panel hidden" id="panel-admin">
            <span class="admin-badge">🔐 Admin Access</span>
            <p class="heading" style="color:#FFD95A;">Admin Login</p>
            <form action="" method="post">
              <div class="inputContainer">
                <svg class="inputIcon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#FFD95A" viewBox="0 0 16 16">
                  <path d="M13.106 7.222c0-2.967-2.249-5.032-5.482-5.032-3.35 0-5.646 2.318-5.646 5.702 0 3.493 2.235 5.708 5.762 5.708.862 0 1.689-.123 2.304-.335v-.862c-.43.199-1.354.328-2.29.328-2.926 0-4.813-1.88-4.813-4.798 0-2.844 1.921-4.881 4.594-4.881 2.735 0 4.608 1.688 4.608 4.156 0 1.682-.554 2.769-1.416 2.769-.492 0-.772-.28-.772-.76V5.206H8.923v.834h-.11c-.266-.595-.881-.964-1.6-.964-1.4 0-2.378 1.162-2.378 2.823 0 1.737.957 2.906 2.379 2.906.8 0 1.415-.39 1.709-1.087h.11c.081.67.703 1.148 1.503 1.148 1.572 0 2.57-1.415 2.57-3.643zm-7.177.704c0-1.197.54-1.907 1.456-1.907.93 0 1.524.738 1.524 1.907S8.308 9.84 7.371 9.84c-.895 0-1.442-.725-1.442-1.914z"/>
                </svg>
                <input type="text" style="color:white;" class="inputField" placeholder="Admin Username" name="admin_name" required>
              </div>

              <div class="inputContainer">
                <svg class="inputIcon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#FFD95A" viewBox="0 0 16 16">
                  <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/>
                </svg>
                <input type="password" class="inputField" name="admin_password" placeholder="Admin Password" required>
              </div>

              <div class="link-row" style="margin-top:6px;">
                <h6 style="color:rgba(255,255,255,0.6); font-size:.72em;">Authorized personnel only</h6>
              </div>

              <input id="admin-button" type="submit" name="admin_click" value="Login as Admin">
            </form>
          </div>

        </div><!-- /form_main -->
      </div>
    </div>
  </div>

  <script>
    function switchTab(role) {
      // Update tab button states
      document.getElementById('tab-user').classList.toggle('active', role === 'user');
      document.getElementById('tab-admin').classList.toggle('active', role === 'admin');

      // Show/hide panels
      document.getElementById('panel-user').classList.toggle('hidden', role !== 'user');
      document.getElementById('panel-admin').classList.toggle('hidden', role !== 'admin');
    }

    // If a POST with admin_click came back (e.g. invalid password), keep admin tab active
    <?php if(isset($_POST['admin_click'])): ?>
    switchTab('admin');
    <?php endif; ?>
  </script>

  <?php include('includes/toast.php'); ?>
  <?php if (!empty($login_error)): ?>
  <script>document.addEventListener('DOMContentLoaded', function(){ showToast(<?php echo json_encode($login_error); ?>, 'error', 4000); });</script>
  <?php endif; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
</body>

</html>