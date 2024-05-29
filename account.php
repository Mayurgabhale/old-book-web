<?php
include("connection.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creat Account</title>
    <link rel="stylesheet" href="style.css">
    <!--  -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.css" rel="stylesheet" />
    <!-- 
        cart
        <i class="ri-shopping-cart-line"></i>
        <i class="ri-shopping-cart-2-line"></i>
        <i class="ri-shopping-cart-fill"></i>
        <i class="ri-shopping-cart-2-fill"></i>

        close
        <i class="ri-close-circle-line"></i>
        <i class="ri-close-fill"></i>

        search
        <i class="ri-search-eye-line"></i>

        menu
        <i class="ri-menu-line"></i>
     -->
</head>

<body>
    <div class="acc_logo">
        <img src="./img/old_book__2_-removebg-preview.png" alt="">

    </div>


    <div class="container">
        <form action="#" method="POST"  autocomplete="FALSE">
            <div class="title">
                Creat Account
            </div>

            <div class="from">


                <div class="input_field">
                    <input type="text" class="input" name="fname" required placeholder="Full Name">
                </div>


                <div class="input_field">
                    <input type="email" class="input" name="email" required placeholder="Email Address">
                </div>

                <div class="input_field">
                    <input type="number" class="input" name="phone" required placeholder="Phone Number">
                </div>

                <div class="input_field">
                    <input type="password" class="input" name="password" required placeholder="Password">
                </div>

                <div class="input_field">
                    <input type="password" class="input" name="conpassword" required placeholder="Confirm Password">
                </div>



                <div class="sub_btn">
                    <input type="submit" value="Register" class="" name="register">
                </div>

                <div>
                    <p>Alerady have an account <a href="login.php">Login </a></p>
                </div>

            </div>
        </form>


    </div>
</body>

</html>
















<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname   = $_POST['fname'];
    $email   = $_POST['email'];
    $phone   = $_POST['phone'];
    $pwd     = $_POST['password'];
    $cpwd    = $_POST['conpassword'];



    $select = "SELECT * FROM `books_acc` WHERE email='$email'";

    $result = mysqli_query($conn, $select);
    $row = mysqli_num_rows($result);

    if ($row > 0) {

        echo " <script> alert('User Alerady Exit ') </script>";
    } else {

        if ($pwd == $cpwd) {
            $hash = password_hash($pwd, PASSWORD_DEFAULT);
            $insert = "INSERT INTO `books_acc`(fname, email, phone, password) VALUES('$fname','$email','$phone','$hash')";
            $result = mysqli_query($conn, $insert);
            header('location:login.php');
            if ($result) {
                
                echo " <script> alert('Your Registraction Successfully') </script>";
            }
        } else {

            echo " <script> alert('password Not matched') </script>";
        }
    }
};





?>