<?php
include('includes/connect.php');
include('functions/common_function.php');
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZipKart-Buy happiness</title>
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
        .product{
            height: 400px;
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


        <!-- third child -->
        <div class="bg-light">
            <h3 class="text-center text-primary">
                Product details
            </h3>
        </div>

        <!-- fourth child -->
        <div class="row px-2">
            <div class="col-md-10">
                <div class="row">
                    <!-- fetching the products to display dynamically -->
                    <?php

                    get_product_details();
                    get_unique_category();
                    get_unique_brand();
                    cart();
                    ?>
                    

                </div>
            </div>
            <div class="col-md-2 bg-secondary p-0">
                <!-- categories to be displayed -->
                <ul class="navbar-nav me-auto text-center">
                    <li class="nav-item bg-primary text-light ">
                        <a class="nav-link" href="#">
                            <h4>Categories</h4>
                        </a>
                    </li>
                    <?php
                    getcategories();

                    ?>

                    <li class="nav-item bg-primary text-light ">
                        <a class="nav-link" href="#">
                            <h4>Brands</h4>
                        </a>
                    </li>
                    <!-- dynamically arrange the brands -->
                    <?php
                    getbrands();

                    ?>

                </ul>
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