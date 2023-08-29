<?php
include('../includes/connect.php');
include('../functions/common_function.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zipkart-admin_login</title>
    <!-- bootstrap link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <!-- custom stylesheet -->
    <link rel="stylesheet" href="../styles.css">

    <style>
        body {
            overflow-x: hidden;
        }
    </style>
</head>
<body>
    <div class="container-fluid m-3">
        <h3 class="text-center mb-4">Admin Login</h3>
        <div class="row d-flex justify-content-center">
            <div class="col-lg-6 col-xl-5">
                <img src="../images/admin_login.jpg" alt="admin_reg_image" class="img-fluid">
            </div>

            <div class="col-lg-6 col-xl-5 pt-4">
                <form action="" method="post">    
                    <div class="form-outline mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" class="form-control w-50" name="email" placeholder="Enter your email" required>
                    </div>
                    <div class="form-outline mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" class="form-control w-50" name="password" placeholder="Enter your password" required>
                    </div>
                    
                    <div class="form-outline mb-3">
                        <input type="submit" class="btn btn-primary" value="Login" name="admin_login">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

<?php
if(isset($_POST['admin_login']))
{
    session_start();
    $mail=$_POST['email'];
    $password=$_POST['password'];

     //now to check whether user email exists or not
     $mail_query="select * from `admin_table` where admin_email='$mail'";
     $mail_result=mysqli_query($con,$mail_query);
     $mail_rows=mysqli_num_rows($mail_result);
     $row_data=mysqli_fetch_assoc($mail_result);
     if($mail_rows>0)
     {
         if(password_verify($password,$row_data['admin_password']))
         {
                $_SESSION['admin_email'] = $mail;
                $_SESSION['admin_name'] = $row_data['admin_name'];
                echo "<script>alert('Login successful')</script>";
                echo "<script>window.open('index.php','_self')</script>";
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