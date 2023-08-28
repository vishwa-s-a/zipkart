<?php

include('functions/common_function.php');
include('includes/connect.php');
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

?>

<?php
//logic to check whether the user is logged in or not to give him access of this page
if(!isset($_SESSION['user_email'])  && !isset($_SESSION['username']))
{
    echo "<script>window.open('index.php','_self')</script>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zipkart-Checkout</title>
    <!-- bootstrap link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <!-- custom stylesheet -->
    <link rel="stylesheet" href="styles.css">
    <!-- fontawesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .profile {
            width: 100%;
            height: 100px;
            object-fit: contain;
        }

        .product_image {
            width: 100%;
            height: 100px;
            object-fit: contain;
        }
        body{
            overflow-x: hidden;
        }
    </style>
</head>

<body>


    <div class="container-fluid p-0">
        <!-- first child -->
        <!-- navbar -->
        <?php
        include('includes/header.php');
        ?>

        <!-- fourth child -->
        <div class="row px-2">
            <div class="col-md-12">
                <div class="row">

                <?php
                if(!isset($_SESSION['user_email']))
                {
                    include('user_login.php');
                }
                else{
                    include('payment.php');
                }
                ?>
                </div>
            </div>
        </div>
        <!-- footer section -->
        <?php
        include('includes/footer.php');
        ?>

    </div>
    <!-- bootstrap javascript link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>
</body>

</html>