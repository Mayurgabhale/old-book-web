<?php
// Start session and include connection file
include 'connection.php';
session_start();

// Check if user is logged in
$user_id = $_SESSION['user_id'];
if (!isset($user_id)) {
    header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Old Book Store</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        .container {
            max-width: 800px;
            margin: 8rem auto;
            padding: 20px;
            background-color: skyblue;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        p {
            color: #666;
            line-height: 1.6;
            margin-bottom: 10px;
        }

        .video {
            text-align: center;
            margin-top: 50px;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        video {
            width: 100%;
            max-width: 600px;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 20px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>

<body>
    <?php include 'b_header.php'; ?>

    <!-- Main content -->
    <div class="container">
        <h1>Welcome to the Old Book Store!</h1>
        <p>We specialize in rare and vintage books, offering a treasure trove of literary gems waiting to be discovered.</p>
        <p>Our collection includes books from various genres and time periods, ranging from classic literature to obscure manuscripts.</p>
        <p>Whether you're a seasoned collector or just starting your journey into the world of vintage books, we have something for everyone.</p>
        <p>Visit us today and embark on an adventure through time and imagination!</p>
    </div>

    <!-- Video section -->
    <div class="video">
        <h2 style="color: #333;">Take a Virtual Tour</h2>
        <video controls>
            <source src="./img/video.mp4" type="video/mp4">
        </video>
    </div>

    <!-- Footer -->
    <?php include 'footer.php' ?>
    

</body>

</html>
