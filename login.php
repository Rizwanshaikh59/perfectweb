<?php
include("connection.php");
use PHPMailer\PHPMailer\PHPMailer;

require 'phpmailer/vendor/autoload.php';

if(isset($_POST['login'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $check = "SELECT * FROM `signuptable` WHERE username = '$username' AND email = '$email'";
    $result = mysqli_query($conn, $check);

    if($result && mysqli_num_rows($result) > 0) {
        $fetch = mysqli_fetch_assoc($result);
        if(password_verify($password, $fetch['password'])) {
            // Start session and store user details
            session_start();
            $_SESSION['user_id'] = $fetch['id'];
            $_SESSION['username'] = $fetch['username'];
            $_SESSION['email'] = $fetch['email'];
            echo "<script> alert('Login Successful'); window.location.href='welcome.php';</script>";
        } else {
            echo "<script> alert('Incorrect Password');</script>";
        }
    } else {
        echo "<script> alert('Invalid Username or Email');</script>";
    }
}

if(isset($_POST['forgot'])) {
    $email = $_POST['email'];
    $check = "SELECT * FROM `signuptable` WHERE email = '$email'";
    $result = mysqli_query($conn, $check);

    if($result && mysqli_num_rows($result) > 0) {
        $otp = rand(100000, 999999);
        $update = "UPDATE `signuptable` SET otp = '$otp' WHERE email = '$email'";
        mysqli_query($conn, $update);

        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'rockstargamingr2@gmail.com';
            $mail->Password = 'lopmvwxqzmyharso';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('rockstargamingr2@gmail.com', 'Authorised Web');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'Your OTP Code:';
            $mail->Body = "<h2>Your OTP Code: <strong>$otp</strong></h2>
    <p>Hello,</p>
    <p>Thank you for using our services. Please use the OTP code mentioned above to verify your identity.</p>
    <p>Best Regards,</p>
    <p><strong>Rizwan Shaikh</strong></p>";

            $mail->send();
            echo "<script>alert('OTP Sent to Your Email'); window.location.href='otp.php?email=$email';</script>";
        
        } catch (Exception $e) {
            echo "<script>alert('Failed to Send OTP: {$mail->ErrorInfo}');</script>";
        }
    } else {
        echo "<script> alert('Email Not Found');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
<div class="login">
         <form action="" method="POST">
            <h1>Log<span>In</span></h1>
         <p>Login Your Registered Account</p>
            <label>Username</label>
            <input type="text" name="username" id="username" placeholder="Enter Your Username">
            <label>Email</label>
            <input type="email" name="email" id="email" placeholder="Enter Your Email">
            <label>Password</label>
            <input type="password" name="password" id="password" placeholder="Enter Your Password">
            <button type="submit" name="login" id="login">Login</button>
            <button type="reset" name="reset" id="reset">Reset Fill Data</button>
            <button type="submit" name="forgot" id="forgot">Forgot Password</button>
         </form>
         <div class="footer">
         <p>By Clicking The Sign-Up Button, <br><br> You Agree To Our
           <a href="termsandcondition.html">Terms And Condition</a> And <a href="privacypolicy.html">Privacy Policy</a></p>
         <p>Create New Account ? <a href="signup.php">Signup Here</a></p>
        </div>
    </div>
</body>
</html>
