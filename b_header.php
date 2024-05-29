<?php
include 'connection.php';
$user_id = $_SESSION['user_id'];



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="icon" href="/img/old_book__2_-removebg-preview.png" type="image/jpeg">

    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.css" rel="stylesheet" />

    <!-- custome csss -->
    <!-- <link rel="stylesheet" href="mainpage.css"> -->

    <link rel="stylesheet" href="b_header.css">

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

        account
        <i class="ri-account-circle-line"></i>
        <i class="ri-account-pin-box-line"></i>

        <i class="ri-arrow-left-line"></i>
        <i class="ri-arrow-left-fill"></i>
     -->

</head>

<body>
    <div class="header">
        <div class="flex">
            <div class="logo">
                <a href="home.php"><img src="./img/old_book__2_-removebg-preview.png" alt=""></a>
            </div>
            <?php
            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                echo '<div class="account_box">
            <p>Name : <span>' . $_SESSION["name"] . '</span></p>
            <p>Email : <span>' . $_SESSION["email"] . '</span></p>
            <a href="logout.php" class="delete_btn">Logout</a>
        </div>';
            } else {
                echo '<div class="log-reg-btn">
            <button class="l_btn bu"><a href="login.php">Login</a></button>
            <button class="c_btn bu"><a href="account.php">Register</a> </button>
        </div>';
            }
            ?>


            <div class="search">
                <input type="text" name="" placeholder="Search Books...">
                <a href="search_page.php"><i class="ri-search-eye-line"></i></a>
            </div>

            <div class="seller">
                <button class="sell_btn"><a href="selle_page.php">Sell</a></button>
            </div>


            <div class="icons">


                <!-- <a href="search_page.php" class="fas fa-search"></a> -->
                <i class="ri-account-circle-line" id="user-btn"></i>

                <?php
                $select_cart_number = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
                $cart_rows_number = mysqli_num_rows($select_cart_number);
                ?>
                <a href="cart.php"><i class="ri-shopping-cart-line"></i> <span>(<?php echo $cart_rows_number; ?>)</span> </a>
                <i class="ri-menu-line" id="menu-btn"></i>
            </div>

            



            <div class="sidebar">
                <a href="about.php">About</a>
                <a href="shop.php">shop</a>
                <a href="contact.php">contact</a>
                <a href="orders.php">orders</a>
            </div>
        </div>
    </div>

















    <!-- js -->
    <script>
        let accountBox = document.querySelector('.header .account_box');

        let sidebar = document.querySelector('.header .sidebar');



        document.querySelector('#user-btn').onclick = () => {

            accountBox.classList.toggle('active');
            sidebar.classList.remove('active');

        }

        document.querySelector('#menu-btn').onclick = () => {

            sidebar.classList.toggle('active');
            accountBox.classList.remove('active');

        }

        window.onscroll = () => {

            accountBox.classList.remove('active');
            sidebar.classList.remove('active');


        }
    </script>
</body>

</html>