<?php
include 'connection.php';
session_start();
$user_id = $_SESSION['user_id'];
// error_reporting(0);

if (!isset($user_id)) {
    header('location:login.php');
}
if(isset($_POST['add_to_cart'])){

    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = $_POST['product_quantity'];
 
    $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');
 
    if(mysqli_num_rows($check_cart_numbers) > 0){
        echo "<script>alert('Already Added To Cart')</script>";

    }else{
       mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, quantity, image) VALUES('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
       echo "<script>alert('Product Added To Cart')</script>";
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
    <link rel="stylesheet" href="orders.css">
    <link rel="stylesheet" href="mainpage.css">


    <style>
        .ser{
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <?php include 'b_header.php' ?>

    <div class="heading">
        <h3>Search Page</h3>
        <p><a href="mainpage.php">Home</a>/ Search</p>
    </div>


    <section class="search-form">
        <form action="" method="post">
            <input type="text" name="search" placeholder="search books..." class="box">
            <input type="submit" name="submit" value="search" class="btn">
        </form>
    </section>


    <section class="products">
        <div class="box-container">

            <?php
            if (isset($_POST['submit'])) {
                $search_item = $_POST['search'];
                $selcet_products = mysqli_query($conn, "SELECT * FROM `products` WHERE name LIKE '%{$search_item}%'") or die('query failed');
                if (mysqli_num_rows($selcet_products) > 0) {
                    while ($fetch_products = mysqli_fetch_assoc($selcet_products)) {

            ?>
                        <form action="" method="post" class="box">
                            <img src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
                            <div class="name"><?php echo $fetch_products['name']; ?></div>
                            <div class="price">&#x20B9;<?php echo $fetch_products['price']; ?>/-</div>
                            <input type="number" min="1" name="product_quantity" value="1" class="qty">
                            <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
                            <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
                            <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
                            <input type="submit" value="Add To Cart" name="add_to_cart" class="btn">

                        </form>

            <?php
                    }
                } else {
                    echo '<p class="empty"> No Result Found !</p>';
                }
            } else {
                echo '<p class="new ser">search somethig !</p>';
            }
            ?>
        </div>

    </section>






























    <!-- FOOTER -->

    <?php include 'footer.php' ?>

</body>

</html>