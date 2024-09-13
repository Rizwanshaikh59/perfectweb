<?php
session_start();
include("connection.php");

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$fetch = mysqli_query($conn, "SELECT * FROM `signuptable` WHERE id = '$user_id'");
$user = mysqli_fetch_assoc($fetch);

if (isset($_POST['update_profile'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    
    // Update user profile
    $update = "UPDATE `signuptable` SET username = '$username', email = '$email', mobile = '$mobile' WHERE id = '$user_id'";
    mysqli_query($conn, $update);

    // Update session data
    $_SESSION['username'] = $username;
    $_SESSION['email'] = $email;

    echo "<script>alert('Profile Updated Successfully');</script>";
}

if (isset($_POST['change_password'])) {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    
    if (password_verify($current_password, $user['password'])) {
        if ($new_password === $confirm_password) {
            // Update password
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $update_password = "UPDATE `signuptable` SET password = '$hashed_password' WHERE id = '$user_id'";
            mysqli_query($conn, $update_password);

            echo "<script>alert('Password Changed Successfully');</script>";
        } else {
            echo "<script>alert('New passwords do not match');</script>";
        }
    } else {
        echo "<script>alert('Current password is incorrect');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <div class="dashboard">
        <header>
            <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></h1>
            <nav>
                <a href="login.php">Logout</a>
            </nav>
        </header>
        <main>
            <h2>Your Profile</h2>
            <form action="" method="POST">
                <label>Username</label>
                <input type="text" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
                <label>Email</label>
                <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                <label>Mobile Number</label>
                <input type="text" name="mobile" value="<?php echo htmlspecialchars($user['mobile']); ?>" required>
                <button type="submit" name="update_profile">Update Profile</button>
            </form>
            
            <h2>Change Password</h2>
            <form action="" method="POST">
                <label>Current Password</label>
                <input type="password" name="current_password" required>
                <label>New Password</label>
                <input type="password" name="new_password" required>
                <label>Confirm New Password</label>
                <input type="password" name="confirm_password" required>
                <button type="submit" name="change_password">Change Password</button>
            </form>
        </main>
    </div>
</body>
</html>
