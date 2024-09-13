<?php
include ("connection.php"); 
?>
<?php
include("datastore.php"); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign-Up</title>
    <link rel="stylesheet" href="">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="signup">
         <form action="" method="POST">
            <h1>Sign <span>Up</span></h1>
         <p>Create Your New Account</p>
            <label>Username</label>
            <input type="text" name="username" id="username" placeholder="Enter Your Username">
            <label>Email</label>
            <input type="email" name="email" id="email" placeholder="Enter Your Email">
            <label>Mobile.No</label>
            <input type="number" name="mobile" id="mobile" placeholder="Enter Your Mobile">
            <label>Password</label>
            <input type="password" name="password" id="password" placeholder="Enter Your Password">
            <label>Confirm.Password</label>
            <input type="password" name="confirmpassword" id="confirmpassword" placeholder="Confirm Your Password">
            <button type="submit" name="signup" id="signup">Sign Up</button>
            <button type="reset" name="reset" id="reset">Reset Fill Data</button>
         </form>
         <div class="footer">
         <p>By Clicking The Sign-Up Button, <br><br> You Agree To Our
           <a href="termsandcondition.html">Terms And Condition</a> And <a href="privacypolicy.html">Privacy Policy</a></p>
         <p>Already Have An Account ? <a href="login.php">Login Here</a></p>
        </div>
    </div>
</body>
</html>