<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "usersignup";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if ($conn) 
{  
     echo "";
}
else
{
    echo "Not Connected";
}
?>