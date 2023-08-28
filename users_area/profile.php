<?php
include('includes/connect.php');
include('../functions/common_function.php');
session_start();
?>

<?php
//logic to check whether the user is logged in or not to give him access of this page
if(!isset($_SESSION['user_email'])  && !isset($_SESSION['username']))
{
    echo "<script>window.open('user_login.php','_self')</script>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZipKart-Profile</title>
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
        .user_image {
            width: 100%;
            height: 120px;
            object-fit: contain;
        }
        body{
            overflow-x: hidden;
        }
    </style>
</head>

<body>

    
    <div class="container-fluid p-0 ">
        <!-- first child -->
        <!-- navbar -->
        <?php
        include('includes/header.php');
        ?>
       
        <!-- third child -->
        <div class="bg-light">
            <h3 class="text-center">
                ZipKart
            </h3>
            <p class="text-center">
                Buy your happiness at best cost
            </p>
        </div>

        <div class="row px-2 ">
            <div class="col-md-2  p-0 ">
                <ul class="navbar-nav text-center bg-secondary">
                    <li class="nav-item bg-primary text-light ">
                        <a class="nav-link" href="profile.php">
                            <h4>Your profile</h4>
                        </a>
                    </li>
                    <?php
                    error_reporting(E_ALL);
                    ini_set('display_errors', 1);
                    $user_email=$_SESSION['user_email'];
                    $user_query="select * from `user_table` where user_email='$user_email'";
                    $user_query_result=mysqli_query($con,$user_query);
                    $user=mysqli_fetch_assoc($user_query_result);
                    $user_image=$user['user_image'];
                    echo "<li class='nav-item bg-secondary '>
                        <img src='user_images/$user_image' class='user_image mt-2' alt='profile pic'>
                        </li>";

                    ?>
                    <li class="nav-item bg-secondary text-light ">
                        <a class="nav-link" href="profile.php?pending_orders">
                            <h6>Pending orders</h6>
                        </a>
                    </li>
                    <li class="nav-item bg-secondary text-light ">
                        <a class="nav-link" href="profile.php?edit_account">
                            <h6>Edit account</h6>
                        </a>
                    </li>
                    <li class="nav-item bg-secondary text-light ">
                        <a class="nav-link" href="profile.php?change_password">
                            <h6>Change Password</h6>
                        </a>
                    </li>
                    <li class="nav-item bg-secondary text-light ">
                        <a class="nav-link" href="profile.php?my_orders">
                            <h6>My orders</h6>
                        </a>
                    </li>
                    <li class="nav-item bg-secondary text-light ">
                        <a class="nav-link" href="profile.php?delete_account">
                            <h6>Delete Account</h6>
                        </a>
                    </li>
                    <li class="nav-item bg-secondary text-light ">
                        <a class="nav-link" href="user_logout.php">
                            <h6>Logout</h6>
                        </a>
                    </li>
                </ul>

            </div>
            <div class="col-md-10 table-responsive">
                <?php
                get_order_details();
                if(isset($_GET['edit_account']))
                {
                    include('edit_account.php');
                }
                if(isset($_GET['my_orders']))
                {
                    include('my_orders.php');

                }
                if(isset($_GET['delete_account']))
                {
                    include('delete_account.php');
                }
                if(isset($_GET['change_password']))
                {
                    include('change_password.php');
                }
                ?>
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