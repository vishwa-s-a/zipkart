<?php
include('../includes/connect.php');
include('../functions/common_function.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zipkart-admin_registration</title>
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
        <h3 class="text-center mb-4">Admin Registration</h3>
        <div class="row d-flex justify-content-center">
            <div class="col-lg-6 col-xl-5">
                <img src="../images/admin_reg.jpg" alt="admin_reg_image" class="img-fluid">
            </div>

            <div class="col-lg-6 col-xl-5">
                <form action="" method="post">
                    <div class="form-outline mt-4 mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" id="username" class="form-control w-50" name="username" placeholder="Enter your username" required>
                    </div>
                    <div class="form-outline mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" class="form-control w-50" name="email" placeholder="Enter your email" required>
                    </div>
                    <div class="form-outline mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" class="form-control w-50" name="password" placeholder="Enter your password" required>
                    </div>
                    <div class="form-outline mb-3">
                        <label for="confirm_password" class="form-label">Confirm Password</label>
                        <input type="password" id="confirm_password" class="form-control w-50" name="confirm_password" placeholder="Confirm password" required>
                    </div>
                    <div class="form-outline mb-3">
                        <input type="submit" class="btn btn-primary" value="Register" name="admin_register">
                        <p class="small fw-bold pt-2">Already have an account? <a href="admin_login.php" class="link-danger"> Login</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

<?php
if(isset($_POST['admin_register']))
{
    session_start();
    $name=$_POST['username'];
    $mail=$_POST['email'];
    $password=$_POST['password'];
    $confirm_password=$_POST['confirm_password'];

    //hashing the password to store it in database
    $hash_password = password_hash($password, PASSWORD_DEFAULT);


    //to check whether the entered user name is available or not
    $check_query = "select * from `admin_table` where admin_email='$mail'";
    $check_result = mysqli_query($con, $check_query);

    $check_num_rows = mysqli_num_rows($check_result);
    if ($check_num_rows > 0) {
        echo "<script>alert('Entered email already exists, give different email')</script>";

    } elseif ($password != $confirm_password) {
        echo "<script>alert('confirm password did not match')</script>";

    } else {
        //insert query
        $insert_query = "insert into `admin_table` (admin_name,admin_email,admin_password) values ('$name','$mail','$hash_password')";
        $insert_result = mysqli_query($con, $insert_query);
        if ($insert_result) {
            $_SESSION['admin_email'] = $mail;
            $_SESSION['admin_name'] = $name;
            echo "<script>alert('Admin registered successfully')</script>";
            echo "<script>window.open('index.php','_self')</script>";
        } else {
            die(mysqli_error($con));
        }

    }
}

?>