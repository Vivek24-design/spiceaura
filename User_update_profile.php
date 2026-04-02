<?php
session_start();
include('includes/connect.php');

if (!isset($_SESSION['name'])) {
    header('location: User_login.php');
    exit;
}

if (isset($_POST['save_profile'])) {
    $old_username = mysqli_real_escape_string($con, $_SESSION['name']);
    $new_username = mysqli_real_escape_string($con, $_POST['username']);
    $new_email    = mysqli_real_escape_string($con, $_POST['email']);
    $new_password = mysqli_real_escape_string($con, $_POST['password']);

    // Update user_registration table
    $sql1 = "UPDATE user_registration SET 
                username = '$new_username',
                email    = '$new_email',
                password = '$new_password'
              WHERE username = '$old_username'";

    // Update user_login table
    $sql2 = "UPDATE user_login SET 
                username = '$new_username',
                password = '$new_password'
              WHERE username = '$old_username'";

    mysqli_query($con, $sql1);
    mysqli_query($con, $sql2);

    // Update the session name
    $_SESSION['name'] = $new_username;
}

header('location: User_dashboard.php?section=profile&saved=1');
exit;
?>
