<?php
include 'connection.php';
session_start();
$user_id = $_SESSION['user_id'];
// error_reporting(0);

if (!isset($user_id)) {
    header('location:login.php');
}


?>








<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Old Book </title>
    <link rel="stylesheet" href="heading.css">
    <link rel="stylesheet" href="orders.css">
</head>

<body>
    <?php include 'b_header.php' ?>
    <div class="heading">
        <h3>Placed Orders</h3>
        <p><a href="mainpage.php">Home</a>/Orders</p>
    </div>

    <section class="placed-orders">
        <h1 class="title">Placed Order</h1>

        <div class="box-container">
            <?php
            $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE user_id ='$user_id' ") or die('query failed');

            if (mysqli_num_rows($order_query) > 0) {
                while ($fetch_orders = mysqli_fetch_assoc($order_query)) {


            ?>
                    <div class="box">
                        <p>Placed On: <span><?php echo $fetch_orders['placed_on']; ?></span></p>
                        <p>Name: <span><?php echo $fetch_orders['name']; ?></span></p>
                        <p>Number: <span><?php echo $fetch_orders['number']; ?></span></p>
                        <p>E-mail: <span><?php echo $fetch_orders['email']; ?></span></p>
                        <p>Address: <span><?php echo $fetch_orders['address']; ?></span></p>
                        <p>Payment Method: <span><?php echo $fetch_orders['method']; ?></span></p>
                        
                        <p>Your Orders: <span><?php echo $fetch_orders['total_products']; ?></span></p>
                        <p>Total Price: <span><?php echo $fetch_orders['total_price']; ?></span></p>
                        <p>Payment Status: <span style="color: <?php if ($fetch_orders['payment_status'] == 'pending') {
                                                                    echo 'red';
                                                                } else {
                                                                    echo 'green';
                                                                } ?>;"><?php echo $fetch_orders['payment_status']; ?></span></p>
                    </div>

            <?php

                }
            } else {
                echo ' <p class="empty">No Orders Placed Yet..!</p>';
            }
            ?>
        </div>
    </section>
































    <!-- FOOTER -->

    <?php include 'footer.php' ?>

</body>

</html>