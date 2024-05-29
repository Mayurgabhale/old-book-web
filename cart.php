<?php
include 'connection.php';
session_start();
$user_id = $_SESSION['user_id'];
// error_reporting(0);

if (!isset($user_id)) {
    header('location:login.php');
}

if (isset($_POST['update_cart'])) {

    $cart_id = $_POST['cart_id'];
    $cart_quantity = $_POST['cart_quantity'];

    mysqli_query($conn, "UPDATE `cart` SET quantity = '$cart_quantity' WHERE id = '$cart_id'") or die('query failed');

    // echo "<script>alert('Cart Quantity Updated..!')</script>";

}

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$delete_id'") or die('query failed');
    header('location:cart.php');
}

if (isset($_GET['delete_all'])) {
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
    header('location:cart.php');
}

?>








<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Old Book </title>
    <link rel="stylesheet" href="heading.css">
    <link rel="stylesheet" href="cart.css">
    <link rel="stylesheet" href="mainpage.css">
</head>

<body>
    <?php include 'b_header.php' ?>
    <div class="heading">
        <h3>Shoping Cart</h3>
        <p><a href="mainpage.php">Home</a>/Caet</p>
    </div>


    <section class="shoping-cart">
        <h1 class="title">Products Added</h1>

        <div class="box-container">
            <?php
            $grand_total = 0;
            $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('qiery faile');
            if (mysqli_num_rows($select_cart) > 0) {

                while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {

            ?>
                    <div class="box">
                        <!-- <i class="ri-close-fill"></i> -->

                        <a href="cart.php?delete =<?php echo $fetch_cart['id']; ?>" class="ri-close-fill" onclick="return confirm ('Delete This From Cart ?');"></a>
                        <img src="uploaded_img/<?php echo $fetch_cart['image']; ?>" alt="">
                        <div class="name"><?php echo $fetch_cart['name']; ?></div>
                        <div class="price">&#x20B9;<?php echo $fetch_cart['price']; ?></div>
                        <form action="" method="post">
                            <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['id']; ?>">
                            <input type="number" min="1" name="cart_quantity" value="<?php echo $fetch_cart['quantity']; ?>">
                            <input type="submit" name="update_cart" value="Update" class="btn">
                        </form>

                        <div class="sub-total"> Sub Total
                            :<span>&#x20B9;<?php echo $sub_total = ($fetch_cart['quantity'] * $fetch_cart['price']) ?>/-</span>
                        </div>

                    </div>
            <?php
                    $grand_total += $sub_total;
                }
            } else {
                echo ' <p class="empty">Your Cart Is Empty...!</p>';
            }
            ?>
        </div>

        <div style="margin-top: 2rem; margin-bottom:2rem; text-align:center;">
            <a href="cart.php?delete_all" class="btn <?php echo ($grand_total > 1) ? '' : 'disabled'; ?>" onclick="return confirm ('delete all from cart?');">Delete
                All</a>
        </div>

        <div class="cart_total">
            <p>Grand Total : <span>&#x20B9;<?php echo $grand_total; ?>/-</span></p>
            <div class="flex">
                <a href="shop.php" class="btn shop">Continue Shopping </a>
                <a href="checkout.php" class="btn check <?php echo ($grand_total > 1) ? '' : 'disabled'; ?>">Proceed To checkout </a>
            </div>
        </div>

    </section>









    <!-- FOOTER -->

    <?php include 'footer.php' ?>

</body>

</html>