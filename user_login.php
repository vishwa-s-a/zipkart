<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zipkart-User Login</title>
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
        body{
            overflow-x: hidden;
        }
    </style>
</head>
<body>
    <div class="container-fluid my-3">
        <h3 class="text-center">
            User login
        </h3>
        <div class="row d-flex align-items-center justify-content-center ">
            <div class="col-lg-12 col-xl-6">
                <form action="" method="post" enctype="multipart/form-data">
                    <!-- user email -->
                    <div class="form-outline mt-4 mb-2">
                        <label for="user_email" class="form-label">Email</label>
                        <input type="text" id="user_email" class="form-control" name="user_email" placeholder="Enter your email" autocomplete="off" required="required">
                    </div>

                    <!-- user password -->
                    <div class="form-outline my-2">
                        <label for="user_password" class="form-label">Password</label>
                        <input type="password" id="user_password" class="form-control" name="user_password" placeholder="Enter your password" autocomplete="off" required="required">
                    </div>
                    
                    <div class="mt-2 pt-2">
                    <p class="small fw-bold"><a href="user_registration.php" class="link-primary">Forgot password</a></p>
                        <input type="submit" value="Login" class="btn btn-primary px-3 py-2 mt-3" name="user_login">
                        <p class="mt-2 pt-1 small fw-bold">Don't have an account ?<a href="users_area/user_registration.php" class="link-danger"> Register</a></p>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <!-- bootstrap javascript link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>
</body>
</html>

<?php
if(isset($_POST['user_login']))
{
    session_start();

    $user_email=$_POST['user_email'];
    $user_password=$_POST['user_password'];

    $user_ip=getIPAddress();

    //now to check whether user email exists or not
    $mail_query="select * from user_table where user_email='$user_email'";
    $mail_result=mysqli_query($con,$mail_query);
    $mail_rows=mysqli_num_rows($mail_result);
    $row_data=mysqli_fetch_assoc($mail_result);
    if($mail_rows>0)
    {
        
        if(password_verify($user_password,$row_data['user_password']))
        {
            $_SESSION['user_email'] = $user_email;
            //selecting cart items and asking user to check out
            $select_cart_items = "select * from `cart_details` where ip_address='$user_ip'";
            $result_cart = mysqli_query($con, $select_cart_items);
            $rows_count = mysqli_num_rows($result_cart);
            $_SESSION['username'] = $row_data['username'];
            if($rows_count==0 and $mail_rows==1)
            {
                //echo "<script>alert('Login successful ".$_SESSION['username']."')</script>";
                echo "<script>alert('Login successful')</script>";
                echo "<script>window.open('users_area/profile.php','_self')</script>";
            }
            else{

                echo "<script>alert('Login successful')</script>";
                echo "<script>window.open('checkout.php?payment','_self')</script>";
            }

        }
        else{
        echo "<script>alert('Invalid password')</script>";

        }
    }
    else{
        echo "<script>alert('Invalid email')</script>";
    }

    
}

?>