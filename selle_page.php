<?php
include 'connection.php';
session_start();
$user_id = $_SESSION["user_id"];



if (!isset($user_id)) {
    header('location:login.php');
}
?>













<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Page</title>

    <!-- custom css link -->
    <link rel="stylesheet" href="seller_style.css">
</head>

<body>
    <?php
    include 'seller_header.php';
    ?>

    <section class="dashboard">
        <h1 class="title">Dashboard</h1>

        <div class="box-continer">

            <div class="box">
                <?php
                $total_pendings = 0;
                $select_pending = mysqli_query($conn, "SELECT total_price FROM `orders` WHERE payment_status  = 'pending' AND user_id = '$user_id'") or die('query failed');

                if (mysqli_num_rows($select_pending) > 0) {
                    while ($fetch_pendings = mysqli_fetch_assoc($select_pending)) {
                        $total_price = $fetch_pendings['total_price'];
                        $total_pendings += $total_price;
                    };
                };

                ?>
                <h3><?php echo  $total_pendings; ?></h3>
                <p>Total Pendings</p>
            </div>

            <div class="box">
                <?php
                $total_completed = 0;
                $select_completed = mysqli_query($conn, "SELECT total_price FROM `orders` WHERE payment_status  = 'completed' AND user_id = '$user_id'") or die('query failed');

                if (mysqli_num_rows($select_completed) > 0) {
                    while ($fetch_completed = mysqli_fetch_assoc($select_completed)) {
                        $total_price = $fetch_completed['total_price'];
                        $total_completed += $total_price;
                    };
                };

                ?>
                <h3><?php echo  $total_completed; ?></h3>
                <p>Completed Payments</p>
            </div>

            <div class="box">
                <?php
                    $select_orders = mysqli_query($conn, "SELECT * FROM `orders` WHERE user_id = '$user_id' ") or die('query failed');
                    $number_of_orders = mysqli_num_rows($select_orders);
                ?>
                <h3><?php echo $number_of_orders; ?></h3>
                <p>Order Placed</p>
            </div>

            <div class="box">
                <?php
                    $select_products = mysqli_query($conn, "SELECT * FROM `products` WHERE user_id = '$user_id'") or die('query failed');
                    $number_of_products = mysqli_num_rows($select_products);
                ?>
                <h3><?php echo $number_of_products; ?></h3>
                <p>Products Added</p>
            </div>

            <!-- <div class="box">
                <?php
                    // $select_users = mysqli_query($conn, "SELECT * FROM `books_acc` ") or die('query failed');
                    // $number_of_users = mysqli_num_rows($select_users);
                ?>
                <h3>
                    <?php
                    //  echo $number_of_users; 
                     ?>
                </h3>
                <p>Buyer</p>
            </div> -->

            <div class="box">
                <?php
                    $select_messages = mysqli_query($conn, "SELECT * FROM `message` WHERE user_id = '$user_id' ") or die('query failed');
                    $number_of_messages = mysqli_num_rows($select_messages);
                ?>
                <h3><?php echo $number_of_messages; ?></h3>
                <p>New Massage</p>
            </div>

        </div>
    </section>
            

            



            





<!-- js -->

<script>
        let navbar = document.querySelector('.header .navbar');
        let accountBox = document.querySelector('.header .account_box');



        document.querySelector('#menu-btn').onclick = () => {

            navbar.classList.toggle('active');
            accountBox.classList.remove('active');

        }
        // document.querySelector('#menu-btn').onclick = () => {

        //     navbar.classList.toggle('active');
        //     accountBox.classList.remove('active');

        // }


        document.querySelector('#user-btn').onclick = () => {

            accountBox.classList.toggle('active');
            navbar.classList.remove('active');

        }

        window.onscroll = () => {
            navbar.classList.remove('active');
            accountBox.classList.remove('active');

        }
    </script>

</body>

</html>