<?php
// require("../connection.php");


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.css" rel="stylesheet" />
    <!-- custom css link -->
    <link rel="stylesheet" href="seller_style.css">
    <!-- <link rel="stylesheet" href="admin_style.css"> -->
</head>

<body>
    <header class="header">
        <div class="flex">
            <a href="#" class="logo"></a>
            <nav class="navbar">
                <a href="selle_page.php">Home</a>
                <a href="seller_product.php">Product</a>
                <a href="seller_order.php">Order</a>
                <a href="Seller_message.php">Message</a>
            </nav>

            <div class="icon">
                <i class="ri-menu-line" id="menu-btn"></i>
                <i class="ri-account-circle-line" id="user-btn"></i>
               <a href="home.php"> <i class="ri-home-2-line"></i></a>
            </div>



            <div class="account_box">
                <p>Name : <span><?php echo $_SESSION["name"]; ?></span></p>
                <p>Email : <span><?php echo $_SESSION["email"]; ?></span></p>
                <a href="logout.php" class="delete_btn">Logout</a>
            </div>
        </div>
    </header>


</body>

</html>