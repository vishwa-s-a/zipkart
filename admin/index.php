<?php
include('../includes/connect.php');
include('../functions/common_function.php');
session_start();
?>


<?php
//logic to check whether the admin is logged in or not to give him access of the admin dashboard
if (!isset($_SESSION['admin_name']) && !isset($_SESSION['admin_email'])) {
    echo "<script>window.open('admin_login.php','_self')</script>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- bootstrap link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <!-- custom stylesheet -->
    <link rel="stylesheet" href="../styles.css">
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

        body {
            overflow-x: hidden;
        }
    </style>

</head>

<body>
    <!-- navbar -->
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg navbar-light bg-primary">
            <div class="container-fluid ">
                <img src="images/zipkart-logo.png" class="logo" alt="logo">
                <nav class="navbar navbar-expand-lg ">
                    <ul class="navbar-nav ">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <?php $name = $_SESSION['admin_name'];echo "Welcome $name";?>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="admin_registration.php">Add Admin</a></li>
                                <li><a class="dropdown-item" href="index.php?view_admin">View Admins </a></li>
                                <li><a class="dropdown-item" href="index.php?change_password">Change Password </a></li>
                            </ul>
                        </div>

                    </ul>
                </nav>
            </div>
        </nav>
        <!-- second child -->
        <div class="bg-light">
            <h4 class="text-center p-2">Manage details</h4>
        </div>

        <!-- third child -->
        <div class="row py-2">
            <div class="col-md-12 bg-secondary p-1 d-flex align-items-center">
                <div class="px-2 ">
                    <a href="#"><img src="images/admin.png" class="profile " alt="admin images"></a>
                    <p class="text-center text-light"><?php $name = $_SESSION['admin_name'];echo "$name";?></p>
                </div>
                <div class="text-center">
                    <button class="btn btn-primary my-3"><a href="index.php?view_products" class="nav-link ">View
                            Products</a></button>
                    <button class="btn btn-primary"><a href="insert_products.php" class="nav-link ">Insert
                            Products</a></button>
                    <button class="btn btn-primary"><a href="index.php?view_category" class="nav-link ">View
                            Categories</a></button>
                    <button class="btn btn-primary"><a href="index.php?insert_categories" class="nav-link ">Insert
                            Categories</a></button>
                    <button class="btn btn-primary"><a href="index.php?view_brand" class="nav-link ">View
                            Brands</a></button>
                    <button class="btn btn-primary my-3"><a href="index.php?insert_brands" class="nav-link ">Insert
                            Brands</a></button>
                    <button class="btn btn-primary"><a href="index.php?view_orders" class="nav-link ">View
                            Orders</a></button>
                    <button class="btn btn-primary"><a href="index.php?view_payments" class="nav-link ">View
                            Payments</a></button>
                    <button class="btn btn-primary"><a href="index.php?view_users" class="nav-link ">View
                            Users</a></button>
                    <button class="btn btn-primary my-3"><a href="admin_logout.php"
                            class="nav-link ">Logout</a></button>
                </div>
            </div>
        </div>

        <!-- fourth child -->
        <!-- this is mainly for loading the insert_categories file here -->
        <div class="container my-4">
            <?php
            if (isset($_GET['insert_categories'])) {
                include('insert_categories.php');
            }
            if (isset($_GET['insert_brands'])) {
                # code...
                include('insert_brands.php');
            }
            if (isset($_GET['view_products'])) {
                include('view_products.php');
            }
            if (isset($_GET['edit_products'])) {
                include('edit_products.php');
            }
            if (isset($_GET['delete_products'])) {
                include('delete_products.php');
            }
            if (isset($_GET['view_category'])) {
                include('view_category.php');
            }
            if (isset($_GET['view_brand'])) {
                include('view_brand.php');
            }
            if (isset($_GET['edit_category'])) {
                include('edit_category.php');
            }
            if (isset($_GET['edit_brand'])) {
                include('edit_brand.php');
            }
            if (isset($_GET['delete_category'])) {
                include('delete_category.php');
            }
            if (isset($_GET['delete_brand'])) {
                include('delete_brand.php');
            }
            if (isset($_GET['view_orders'])) {
                include('view_orders.php');
            }
            if (isset($_GET['delete_order'])) {
                include('delete_order.php');
            }
            if (isset($_GET['view_payments'])) {
                include('view_payments.php');
            }
            if (isset($_GET['delete_payment'])) {
                include('delete_payment.php');
            }
            if (isset($_GET['view_users'])) {
                include('view_users.php');
            }
            if (isset($_GET['delete_user'])) {
                include('delete_user.php');
            }
            if (isset($_GET['view_admin'])) {
                include('view_admin.php');
            }
            if (isset($_GET['delete_admin'])) {
                include('delete_admin.php');
            }
            if (isset($_GET['change_password'])) {
                include('change_password.php');
            }
            ?>

        </div>

        <!-- footer section -->
        <div class="bg-primary p-2 text-center text-light  ">
            <div class="row">
                <div class="col-md-3">

                </div>
                <div class="col-md-6 py-2 px-1">
                    <a href="../index.php"><img src="../images/zipkart-logo.png" class="profile" alt="admin images"></a>
                    <p class="fw-lighter">Your Ultimate Destination for Online Shopping. Explore our vast collection of
                        quality products,
                        ranging from electronics and fashion to home essentials. Experience seamless shopping with fast
                        delivery and secure payments.</p>
                    <a href="#" class="mx-2"><i class="fa-brands fa-facebook fa-xl" style="color: #f0f2f5;"></i></i></a>
                    <a href="#" class="mx-2"><i class="fa-brands fa-instagram fa-xl"
                            style="color: #f0f2f5;"></i></i></a>
                    <a href="#" class="mx-2"><i class="fa-brands fa-twitter fa-xl" style="color: #f0f2f5;"></i></i></a>


                </div>

            </div>
            <p>Copyright &copy 2023 All Rights Reserved by Vishwa </p>
        </div>
    </div>
    <!-- bootstrap javascript link -->

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa"
        crossorigin="anonymous"></script>
</body>

</html>