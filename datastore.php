<?php
  include("connection.php");

  if(isset($_POST['signup']))
  {
    //user check already exist in the database
    $check = "SELECT * FROM `signuptable` WHERE username = '$_POST[username]' OR email = '$_POST[email]'";

    $result = mysqli_query($conn, $check);
    if($result)
    {
       if(mysqli_num_rows($result) > 0) //if any user found in the db
       {
        $fetch = mysqli_fetch_assoc($result);
        if($fetch['username'] == $_POST['username']) //if username match
        {
            echo "<script> alert('Username is already taken')</script>";
        }
        else //if email match
        {
            echo "<script> alert('Email is already registered')</script>";
        }
       }
        else // if any user not found
        {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $mobile = $_POST['mobile'];
            $password = $_POST['password'];
            $confirmpassword = $_POST['confirmpassword'];

            // Check if passwords match
            if($password != $confirmpassword) {
                echo "<script> alert('Passwords do not match')</script>";
            } else {
                // Encrypt password before storing it
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

                $sql = "INSERT INTO `signuptable`(`username`, `email`, `mobile`, `password`) VALUES ('$username','$email','$mobile','$hashedPassword')";

                if(mysqli_query($conn, $sql))
                {
                    echo "<script> alert('Account Created')</script>";
                    // Redirect to login page after signup
                    echo "<script> window.location.href='login.php';</script>";
                }
                else
                {
                    echo "<script> alert('Query Failed.....!')</script>";
                }
            }
        }
    }
    else
    {
        echo "<script> alert('Query Failed.....!')</script>";
    }
  }
  ?>