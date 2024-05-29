<?php
include 'connection.php';
session_start();
$user_id = $_SESSION['user_id'];
// error_reporting(0);

if (!isset($user_id)) {
    header('location:login.php');
}


if (isset($_POST['order-btn'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $number =  $_POST['number'];
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $method = mysqli_real_escape_string($conn, $_POST['method']);
    $address = mysqli_real_escape_string($conn, 'flat no.' . $_POST['flat'] . ',' . $_POST['street'] . ',' . $_POST['city'] . ',' . $_POST['state'] . ',' . $_POST['country'] . '-' . $_POST['pin_code']);

    $placed_on = date('d-M-Y');

    $cart_total = 0;

    $cart_products[] = '';

    $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = ' $user_id' ") or die('query failed');

    if (mysqli_num_rows($cart_query) > 0) {
        while ($cart_item = mysqli_fetch_assoc($cart_query)) {
            $cart_products[] = $cart_item['name'] . ' (' . $cart_item['quantity'] . ')';

            $sub_total = ($cart_item['price'] * $cart_item['quantity']);
            $cart_total += $sub_total;
        }
    }

    $total_products = implode(', ', $cart_products);

    $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE name = '$name' AND number = '$number' AND email = '$email' AND method = '$method' AND  address = '$address' AND total_products = '$total_products' AND total_price = '$cart_total' ") or die('query failed');

    if ($cart_total == 0) {
        echo "<script> alert('Your Cart Is Empty !') </script>";
    } else {
        if (mysqli_num_rows($order_query) > 0) {
            echo "<script> alert('Order Already Placed!') </script>";
        } else {
            mysqli_query($conn, "INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price, placed_on) VALUES('$user_id', '$name', '$number', '$email', '$method', '$address', '$total_products', '$cart_total', '$placed_on')") or die('query failed');

            echo "<script> alert('Order Placed Successfully...!') </script>";

            mysqli_query($conn, "DELETE FROM `cart` WHERE user_id='$user_id'") or die('query failed');
        }
        
    }
}


?>








<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Old Book </title>
    <link rel="stylesheet" href="heading.css">
    <link rel="stylesheet" href="checkout.css">
</head>

<body>
    <?php include 'b_header.php' ?>

    <div class="heading">
        <h3>CheckOut</h3>
        <p><a href="mainpage.php">Home</a>/Checkout</p>
    </div>


    <section class="display-order">
        <?php
        $grand_total = 0;
        $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id='$user_id'") or die('query failed');

        if (mysqli_num_rows($select_cart) > 0) {
            while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
                $total_price = ($fetch_cart['price'] * $fetch_cart['quantity']);
                $grand_total += $total_price;

        ?>
                <p><?php echo $fetch_cart['name'] ?> <span>(<?php echo '&#x20B9;' . $fetch_cart['price'] . '/-' . ' x '  . $fetch_cart['quantity'] ?>)</span></p>

        <?php
            }
        } else {

            echo ' <p class="empty">Your Cart Is Empty...!</p>';
        }
        ?>
        <div class="grand-total"> Grand Total : <span> &#x20B9;<?php echo $grand_total ?>/-</span></div>
    </section>

    <section class="checkout">
        <form action="" method="post">
            <h3>Place Your Order</h3>

            <div class="flex">
                <div class="inputbox">
                    <span>Your Name : </span>
                    <input type="text" name="name" required placeholder="Enter Your Name">
                </div>

                <div class="inputbox">
                    <span>Your Number : </span>
                    <input type="text" name="number" required placeholder="Enter Your Number">
                </div>

                <div class="inputbox">
                    <span>Your E-mail : </span>
                    <input type="text" name="email" required placeholder="Enter Your Email">
                </div>

                <div class="inputbox">
                    <span>Payment Method : </span>
                    <select name="method">
                        <option value="cash on delivery"> Cash On Delivery</option>
                        <option value="credit cart"> Credit Cart</option>
                        <option value="Online"> Online</option>
                    </select>
                </div>

                <div class="inputbox">
                    <span>Address Line 01 : </span>
                    <input type="text" min="0" name="flat" required placeholder="e.g. flat no.">
                </div>

                <div class="inputbox">
                    <span>Address Line 01 : </span>
                    <input type="text" name="street" required placeholder="e.g. street name">
                </div>

                <div class="inputbox">
                    <span>City: </span>
                    <input type="text" name="city" required placeholder="e.g. pune">
                </div>

                <div class="inputbox">
                    <span>State : </span>
                    <input type="text" name="state" required placeholder="e.g. maharashtra">
                </div>

                <div class="inputbox">
                    <span>Country : </span>
                    <input type="text" name="country" required placeholder="e.g. india">
                </div>

                <div class="inputbox">
                    <span>Pin Code : </span>
                    <input type="number" name="pin_code" required placeholder="e.g. 411001">
                </div>
            </div>
            <input type="submit" name="order-btn" value="Order Now" class="btn">
        </form>
    </section>




























    <!-- FOOTER -->

    <?php include 'footer.php' ?>

</body>

</html>