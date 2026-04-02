<?php
session_start();
include('includes/connect.php');

$step = 1; // 1 = verify identity, 2 = set new password
$error_msg = '';
$success_msg = '';

// Step 1: Verify username + email
if (isset($_POST['verify_identity'])) {
  $username = mysqli_real_escape_string($con, $_POST['username']);
  $email = mysqli_real_escape_string($con, $_POST['email']);

  $sql = "SELECT * FROM user_registration WHERE username='$username' AND email='$email'";
  $result = mysqli_query($con, $sql);

  if ($result && mysqli_num_rows($result) == 1) {
    // Identity verified — move to step 2
    $step = 2;
    $_SESSION['reset_user'] = $username;
    $_SESSION['reset_email'] = $email;
  } else {
    $error_msg = 'No account found with that username and email combination.';
    $step = 1;
  }
}

// Step 2: Reset password
if (isset($_POST['reset_password'])) {
  $new_password = mysqli_real_escape_string($con, $_POST['new_password']);
  $confirm_password = mysqli_real_escape_string($con, $_POST['confirm_password']);

  if (empty($new_password) || empty($confirm_password)) {
    $error_msg = 'Please fill in both password fields.';
    $step = 2;
  } elseif ($new_password !== $confirm_password) {
    $error_msg = 'Passwords do not match.';
    $step = 2;
  } elseif (strlen($new_password) < 4) {
    $error_msg = 'Password must be at least 4 characters.';
    $step = 2;
  } else {
    $username = $_SESSION['reset_user'] ?? '';
    $email = $_SESSION['reset_email'] ?? '';

    if (empty($username) || empty($email)) {
      $error_msg = 'Session expired. Please start over.';
      $step = 1;
    } else {
      // Update password in both tables
      $sql1 = "UPDATE user_registration SET password='$new_password' WHERE username='$username' AND email='$email'";
      $sql2 = "UPDATE user_login SET password='$new_password' WHERE username='$username'";

      $r1 = mysqli_query($con, $sql1);
      $r2 = mysqli_query($con, $sql2);

      if ($r1 && $r2) {
        $success_msg = 'Password reset successful! Redirecting to login…';
        // Clear reset session
        unset($_SESSION['reset_user']);
        unset($_SESSION['reset_email']);
        $step = 3; // success state
      } else {
        $error_msg = 'Something went wrong. Please try again.';
        $step = 2;
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
  <title>SpiceAura – Reset Password</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<style>
  /* ===== Layout ===== */
  * {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
  }

  body {
    font-family: 'Inter', 'Segoe UI', system-ui, sans-serif;
  }

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

  .main {
    width: 100%;
    padding: 0;
    margin: 0;
  }

  /* ===== Card ===== */
  .form_main {
    width: 430px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    background-color: rgba(15, 25, 35, 0.65);
    padding: 40px 35px;
    backdrop-filter: blur(16px);
    -webkit-backdrop-filter: blur(16px);
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.4), inset 0 1px 0 rgba(255, 255, 255, 0.08);
    border: 1px solid rgba(255, 255, 255, 0.08);
    position: relative;
    overflow: hidden;
    margin-left: 150px;
    border-radius: 24px;
    margin-top: 100px;
  }

  /* ===== Step indicator ===== */
  .step-indicator {
    display: flex;
    align-items: center;
    gap: 0;
    margin-bottom: 24px;
    width: 100%;
    justify-content: center;
  }

  .step-dot {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    font-weight: 700;
    color: rgba(255, 255, 255, 0.35);
    background: rgba(255, 255, 255, 0.06);
    border: 2px solid rgba(255, 255, 255, 0.12);
    transition: all 0.3s ease;
    position: relative;
    z-index: 2;
  }

  .step-dot.active {
    color: #0f1923;
    background: #FFD95A;
    border-color: #FFD95A;
    box-shadow: 0 0 18px rgba(255, 217, 90, 0.35);
  }

  .step-dot.done {
    color: #fff;
    background: #07bc0c;
    border-color: #07bc0c;
  }

  .step-line {
    width: 60px;
    height: 2px;
    background: rgba(255, 255, 255, 0.12);
    position: relative;
    z-index: 1;
  }

  .step-line.active {
    background: #FFD95A;
  }

  /* ===== Heading ===== */
  .heading {
    font-size: 1.6em;
    color: wheat;
    font-weight: 700;
    margin: 0 0 6px 0;
    z-index: 2;
    text-align: center;
  }

  .sub-heading {
    color: rgba(255, 255, 255, 0.5);
    font-size: 0.85em;
    text-align: center;
    margin-bottom: 22px;
    line-height: 1.5;
  }

  /* ===== Lock icon animation ===== */
  .lock-icon {
    width: 64px;
    height: 64px;
    margin-bottom: 16px;
    background: linear-gradient(135deg, #FFD95A 0%, #e6b800 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 20px rgba(255, 217, 90, 0.3);
    animation: pulse-glow 2s ease-in-out infinite;
  }

  .lock-icon svg {
    color: #0f1923;
  }

  @keyframes pulse-glow {

    0%,
    100% {
      box-shadow: 0 4px 20px rgba(255, 217, 90, 0.3);
    }

    50% {
      box-shadow: 0 4px 30px rgba(255, 217, 90, 0.55);
    }
  }

  /* ===== Inputs ===== */
  .inputContainer {
    width: 100%;
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 2;
    margin-bottom: 4px;
  }

  .inputIcon {
    position: absolute;
    left: 3px;
  }

  .inputField {
    width: 100%;
    height: 44px;
    background-color: rgba(255, 255, 255, 0.05);
    border: none;
    border-bottom: 2px solid rgba(173, 173, 173, 0.4);
    border-radius: 6px 6px 0 0;
    margin: 8px 0;
    color: white;
    font-size: .9em;
    font-weight: 500;
    box-sizing: border-box;
    padding-left: 36px;
    padding-right: 12px;
    transition: all 0.25s ease;
  }

  .inputField:focus {
    outline: none;
    border-bottom: 2px solid #FFD95A;
    background-color: rgba(255, 255, 255, 0.08);
  }

  .inputField::placeholder {
    font-size: .92em;
    font-weight: 500;
    color: rgba(255, 255, 255, 0.4);
  }

  /* ===== Submit button ===== */
  .submit-btn {
    z-index: 2;
    position: relative;
    width: 100%;
    border: none;
    background: linear-gradient(135deg, #385A64 0%, #2d4a53 100%);
    height: 44px;
    color: white;
    font-size: .9em;
    font-weight: 600;
    letter-spacing: 0.5px;
    margin: 18px auto 4px;
    cursor: pointer;
    border-radius: 10px;
    transition: all .25s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
  }

  .submit-btn:hover {
    background: linear-gradient(135deg, #FFD95A 0%, #e6b800 100%);
    color: #1a1a1a;
    transform: translateY(-1px);
    box-shadow: 0 4px 16px rgba(255, 217, 90, 0.3);
  }

  .submit-btn:active {
    transform: translateY(0);
  }

  /* ===== Back link ===== */
  .back-link {
    display: flex;
    align-items: center;
    gap: 6px;
    color: rgba(255, 255, 255, 0.55);
    text-decoration: none;
    font-size: 0.82em;
    font-weight: 500;
    margin-top: 16px;
    z-index: 2;
    transition: all 0.2s ease;
  }

  .back-link:hover {
    color: #FFD95A;
  }

  /* ===== Success state ===== */
  .success-icon {
    width: 72px;
    height: 72px;
    margin-bottom: 16px;
    background: linear-gradient(135deg, #07bc0c 0%, #059709 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    animation: success-pop 0.5s cubic-bezier(0.21, 1.02, 0.73, 1);
  }

  @keyframes success-pop {
    0% {
      transform: scale(0);
      opacity: 0;
    }

    60% {
      transform: scale(1.15);
    }

    100% {
      transform: scale(1);
      opacity: 1;
    }
  }

  /* ===== Password strength indicator ===== */
  .password-strength {
    width: 100%;
    height: 3px;
    background: rgba(255, 255, 255, 0.08);
    border-radius: 2px;
    margin-top: 2px;
    margin-bottom: 6px;
    overflow: hidden;
  }

  .password-strength-bar {
    height: 100%;
    width: 0%;
    border-radius: 2px;
    transition: all 0.3s ease;
  }

  .strength-weak {
    width: 33%;
    background: #e74c3c;
  }

  .strength-medium {
    width: 66%;
    background: #f1c40f;
  }

  .strength-strong {
    width: 100%;
    background: #07bc0c;
  }

  .strength-label {
    font-size: 0.72em;
    color: rgba(255, 255, 255, 0.4);
    text-align: right;
    margin-bottom: 4px;
  }

  /* ===== Toggle password visibility ===== */
  .toggle-password {
    position: absolute;
    right: 10px;
    background: none;
    border: none;
    color: rgba(255, 255, 255, 0.4);
    cursor: pointer;
    padding: 4px;
    transition: color 0.2s;
    z-index: 3;
  }

  .toggle-password:hover {
    color: #FFD95A;
  }

  /* ===== Responsive ===== */
  @media (max-width: 768px) {
    .form_main {
      width: 92%;
      margin: 60px auto;
      padding: 30px 24px;
    }
  }
</style>

<body>
  <div class="container-fluid main">
    <div class="row form-body d-flex justify-content-end align-items-center">
      <div class="col-md-6">

        <div class="form_main">

          <!-- Lock Icon -->
          <div class="lock-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" viewBox="0 0 16 16">
              <path
                d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2zM5 9h6a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-5a1 1 0 0 1 1-1z" />
            </svg>
          </div>

          <!-- Step Indicator -->
          <div class="step-indicator">
            <div class="step-dot <?php echo ($step >= 2 || $step == 3) ? 'done' : 'active'; ?>">
              <?php echo ($step >= 2 || $step == 3) ? '✓' : '1'; ?>
            </div>
            <div class="step-line <?php echo ($step >= 2) ? 'active' : ''; ?>"></div>
            <div class="step-dot <?php echo ($step == 3) ? 'done' : (($step == 2) ? 'active' : ''); ?>">
              <?php echo ($step == 3) ? '✓' : '2'; ?>
            </div>
          </div>

          <?php if ($step == 1): ?>
            <!-- ===== STEP 1: Verify Identity ===== -->
            <p class="heading">Forgot Password?</p>
            <p class="sub-heading">Don't worry! Enter your username and email<br>to verify your identity.</p>

            <form action="" method="post" style="width:100%;">
              <div class="inputContainer">
                <svg class="inputIcon" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                  fill="rgba(255,255,255,0.6)" viewBox="0 0 16 16">
                  <path
                    d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.025 10 8 10c-2.026 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                </svg>
                <input type="text" class="inputField" placeholder="Username" name="username" id="username" required>
              </div>

              <div class="inputContainer">
                <svg class="inputIcon" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                  fill="rgba(255,255,255,0.6)" viewBox="0 0 16 16">
                  <path
                    d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555ZM0 4.697v7.104l5.803-3.558L0 4.697ZM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757ZM16 11.801V4.697l-5.803 3.546L16 11.801Z" />
                </svg>
                <input type="email" class="inputField" placeholder="Registered Email" name="email" id="email" required>
              </div>

              <button type="submit" name="verify_identity" class="submit-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                  <path
                    d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 2.354 7.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z" />
                </svg>
                Verify Identity
              </button>
            </form>

            <a href="User_login.php" class="back-link">
              <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                  d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
              </svg>
              Back to Login
            </a>

          <?php elseif ($step == 2): ?>
            <!-- ===== STEP 2: Set New Password ===== -->
            <p class="heading">Set New Password</p>
            <p class="sub-heading">Create a strong new password for your account.</p>

            <form action="" method="post" style="width:100%;">
              <div class="inputContainer">
                <svg class="inputIcon" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                  fill="rgba(255,255,255,0.6)" viewBox="0 0 16 16">
                  <path
                    d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2zM5 9h6a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-5a1 1 0 0 1 1-1z" />
                </svg>
                <input type="password" class="inputField" placeholder="New Password" name="new_password" id="new_password"
                  required>
                <button type="button" class="toggle-password" onclick="toggleVis('new_password', this)">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path
                      d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                  </svg>
                </button>
              </div>

              <!-- Password strength bar -->
              <div class="password-strength">
                <div class="password-strength-bar" id="strength-bar"></div>
              </div>
              <div class="strength-label" id="strength-label"></div>

              <div class="inputContainer">
                <svg class="inputIcon" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                  fill="rgba(255,255,255,0.6)" viewBox="0 0 16 16">
                  <path
                    d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 2.354 7.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z" />
                </svg>
                <input type="password" class="inputField" placeholder="Confirm New Password" name="confirm_password"
                  id="confirm_password" required>
                <button type="button" class="toggle-password" onclick="toggleVis('confirm_password', this)">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path
                      d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                  </svg>
                </button>
              </div>

              <button type="submit" name="reset_password" class="submit-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                  <path
                    d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z" />
                  <path fill-rule="evenodd"
                    d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z" />
                </svg>
                Reset Password
              </button>
            </form>

            <a href="forgetpswd.php" class="back-link">
              <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                  d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
              </svg>
              Start Over
            </a>

          <?php elseif ($step == 3): ?>
            <!-- ===== SUCCESS ===== -->
            <div class="success-icon">
              <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="#fff" viewBox="0 0 16 16">
                <path
                  d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 2.354 7.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z" />
              </svg>
            </div>
            <p class="heading" style="color:#07bc0c;">Password Reset!</p>
            <p class="sub-heading">Your password has been successfully updated.<br>You can now log in with your new
              password.</p>

            <a href="User_login.php" class="submit-btn" style="text-decoration:none; text-align:center;">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                  d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z" />
                <path fill-rule="evenodd"
                  d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z" />
              </svg>
              Go to Login
            </a>
          <?php endif; ?>

        </div><!-- /form_main -->
      </div>
    </div>
  </div>

  <?php include('includes/toast.php'); ?>

  <?php if (!empty($error_msg)): ?>
    <script>document.addEventListener('DOMContentLoaded', function () { showToast(<?php echo json_encode($error_msg); ?>, 'error', 4000); });</script>
  <?php endif; ?>

  <?php if (!empty($success_msg)): ?>
    <script>document.addEventListener('DOMContentLoaded', function () { showToast(<?php echo json_encode($success_msg); ?>, 'success', 3000); });</script>
  <?php endif; ?>

  <script>
    // Toggle password visibility
    function toggleVis(fieldId, btn) {
      var field = document.getElementById(fieldId);
      if (field.type === 'password') {
        field.type = 'text';
        btn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7.028 7.028 0 0 0-2.79.588l.77.771A5.944 5.944 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.134 13.134 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755-.165.165-.337.328-.517.486l.708.709z"/><path d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829l.822.822zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829z"/><path d="M3.35 5.47c-.18.16-.353.322-.518.487A13.134 13.134 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7.029 7.029 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12-.708.708z"/></svg>';
      } else {
        field.type = 'password';
        btn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/><path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/></svg>';
      }
    }

    // Password strength checker
    var pwField = document.getElementById('new_password');
    if (pwField) {
      pwField.addEventListener('input', function () {
        var val = this.value;
        var bar = document.getElementById('strength-bar');
        var label = document.getElementById('strength-label');

        bar.className = 'password-strength-bar';

        if (val.length === 0) {
          bar.className = 'password-strength-bar';
          label.textContent = '';
          return;
        }

        var score = 0;
        if (val.length >= 4) score++;
        if (val.length >= 8) score++;
        if (/[A-Z]/.test(val)) score++;
        if (/[0-9]/.test(val)) score++;
        if (/[^A-Za-z0-9]/.test(val)) score++;

        if (score <= 2) {
          bar.classList.add('strength-weak');
          label.textContent = 'Weak';
          label.style.color = '#e74c3c';
        } else if (score <= 3) {
          bar.classList.add('strength-medium');
          label.textContent = 'Medium';
          label.style.color = '#f1c40f';
        } else {
          bar.classList.add('strength-strong');
          label.textContent = 'Strong';
          label.style.color = '#07bc0c';
        }
      });
    }
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
</body>

</html>