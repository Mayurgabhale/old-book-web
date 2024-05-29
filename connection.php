<?php

// error_reporting(0);
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "old_book_web";

$conn =mysqli_connect($servername,$username,$password,$dbname);

if($conn)
{
    
    // echo "<script> alert(' Connection Ok!') </script>";
}
else
{
    echo "Connection Failed".mysqli_connect_error();
}
?>