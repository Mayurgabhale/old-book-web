<?php
include 'connection.php';
session_start();
$user_id = $_SESSION["user_id"];



if (!isset($user_id)) {
    header('location:login.php');
}

if(isset($_POST['update_order'])){
    $order_update_id = $_POST['order_id'];
    $update_payment = $_POST['update_payment'];
    mysqli_query($conn, "UPDATE `orders` SET payment_status = '$update_payment'WHERE id = '$order_update_id' ") or die('query failed');
    echo " <script>alert(' Payment Status Has been Updated')</script> ";
}

if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `orders` WHERE id ='$delete_id' ") or die('query failed');
    header('location: seller_order.php');
}
    

?>












<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>

    <!-- custom css link -->
    <!-- <link rel="stylesheet" href="seller_style.css"> -->
    <link rel="stylesheet" href="seller_order.css">
</head>

<body>
    <?php
    include 'seller_header.php';
    ?>

    <section class="orders">
        <h1 class="title">Our Orders</h1>
        <div class="box-container">
            <?php

            $select_orders = mysqli_query($conn, "SELECT * FROM `orders` WHERE user_id = '$user_id' AND id ") or die('query failed');
             
            $book_id = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
   
            if (mysqli_num_rows($select_orders) > 0 ) {
                while ($fetch_orders = mysqli_fetch_assoc($select_orders) AND $fetch_book = mysqli_fetch_assoc($book_id)) {
 
            ?>
                    <div class="box">
                    <p>Order Id: <span><?php echo $fetch_book['id']; ?></span></p>
                    <p>Book Id: <span><?php echo $fetch_book['id']; ?></span></p>
                    <p>User Id : <span><?php echo $fetch_orders['user_id'];?></span></p>
                    <p>Placed ON: <span><?php echo $fetch_orders['placed_on'];?></span></p>
                    <p>name: <span><?php echo $fetch_orders['name'];?></span></p>
                    <p>number: <span><?php echo $fetch_orders['number'];?></span></p>
                    <p>email: <span><?php echo $fetch_orders['email'];?></span></p>
                    <p>address: <span><?php echo $fetch_orders['address'];?></span></p>
                    <p>total products: <span><?php echo $fetch_orders['total_products'];?></span></p>
                    <p>total pirce: <span>&#x20B9;<?php echo $fetch_orders['total_price'];?></span>/-</p>
                    <p>Payment Method: <span><?php echo $fetch_orders['method'];?></span></p>
 
                    <form action="" method="post">
                        <input type="hidden" name="order_id" value="<?php echo $fetch_orders['id'];?>">

                        <select name="update_payment">
                            <option value=""><?php echo $fetch_orders['payment_status'];?></option>
                            <option value="pending">pending</option>
                            <option value="completed">completed</option>
                        </select>
                        <input type="submit" value="update" name="update_order" class="option-btn">
                        <a href="seller_order.php?delete=<?php echo $fetch_orders['id'];?>" onclick="return confirm('Delete This Orders ?');" class="delete-btn">Delete</a>
                    </form>
                    </div>

            <?php

                }
            } else {
                echo '<p class="empty">No Orders Placed Yet !</p>';
            }
            ?>
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