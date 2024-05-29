<?php
session_start();
include("connection.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="log_logo">
        <img src="./img/old_book__2_-removebg-preview.png" alt="">

    </div>
    <div class="container">

        <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
            <div class="title">
                Creat Account
            </div>

            <div class="from">
                <div class="input_field">
                    <input type="email" class="input" name="email" required placeholder="Email Address">
                </div>

                <div class="input_field">
                    <input type="password" class="input" name="password" required placeholder="Password">
                </div>

                <div class="sub_btn">
                    <input type="submit" value="Login" class="" name="register">
                </div>
                <div>
                    <p>Don't have an account <a href="account.php">Creat Account</a></p>
                </div>


            </div>
        </form>


    </div>

    


</body>

</html>



<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email   = $_POST['email'];
    $pwd     = $_POST['password'];


    $select = "SELECT * FROM `books_acc` WHERE email='$email'";

    $result = mysqli_query($conn, $select);
    $num = mysqli_num_rows($result);

    if ($num == 1) {
        $row = mysqli_fetch_assoc($result);

        $hash = $row['password'];
        $verify = password_verify($pwd, $hash);
        if ($verify) {
            $_SESSION['loggedin'] = true; //.....
            $_SESSION["name"] = $row['fname'];
            $_SESSION["phone"] = $row['phone'];
            $_SESSION["email"] = $row['email'];
            $_SESSION["user_id"] = $row['id'];
            header("location:home.php");
        } else {
            echo "<script> alert('Invalid Password!')</script>";
        }
    } else {
        echo "<script> alert('Invalid Email!')</script>";
    }
};





?>