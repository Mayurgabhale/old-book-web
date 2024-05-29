<?php
include 'connection.php';
session_start();
$seller_id = $_SESSION["user_id"];


if (!isset($seller_id)) {
    header('location:login.php');
};


if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `message` WHERE id ='$delete_id' ") or die('query failed');
    header('location: seller_message.php');
}
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message</title>
    <link rel="stylesheet" href="seller_massage.css">
</head>

<body>


    <?php include 'seller_header.php'; ?>




    <section class="message">
        <h1 class="title">Message</h1>

        <div class="box-container">
            <?php
            $select_message = mysqli_query($conn, "SELECT * FROM `message`") or die('query failed');
            if (mysqli_num_rows($select_message) > 0) {
                while ($fetch_message = mysqli_fetch_assoc($select_message)) {


            ?>
                    <div class="box">
                        <span class="box_un">
                        <p>Name : <span><?php echo $fetch_message['name']; ?></span></p>
                        <p>Email : <span><?php echo $fetch_message['email']; ?></span></p>
                        <p>Number : <span><?php echo $fetch_message['number']; ?></span></p>
                        <p class="delete">Message : <span><?php echo $fetch_message['message']; ?></span></p>
                        </span>
                        <a href="Seller_message.php?delete=<?php echo $fetch_message['id'];?>" onclick="return confirm('Delete This messsage ?');" class="">Delete Message</a>
                    </div>
            <?php

                };
            }else{
               echo ' <p class="empty">You Have No Message Yet !</p>';
            }
            ?>
        </div>


    </section>






























































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

        document.querySelector('#close-update').onclick = () => {
            document.querySelector('.edit-product-form').style.display = 'none';
            window.location.href = 'seller_product.php';
        }
    </script>
</body>

</html>